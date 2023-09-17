<?php
/***********************************************
osDate Open-Source Dating and Matchmaking Script

(c) 2009 TUFaT.com

osDate was created by Darren Gates and Vijay Nair,
and can be downloaded freely from www.TUFaT.com.
It is distributed under the LGPL license.

osDate is free for commercial and non-commercial
uses. You may modify, re-sell, and re-distribute
osDate. Links back to TUFaT.com are appreciated.

This program is distributed in the hope that it
will be useful, but without any warranty, and
without even the implied warranty of merchantability
or fitness for a particular purpose. While strong
efforts have been taken to ensure the reliability,
security, and stability of osDate, all software
carries risk. Your use of osDate means that you
understand and accept the risks of using osDate.

For osDate documentation, change log, community
forum, latest updates, and project details,
please go to www.TUFaT.com  The osDate project is
supported through the sale of skins and add-ons,
which are entirely optional but help with the
development and design effort.
**********************************************/

	//define( 'SRC_PHOTOS_URL', 'http://datingpro.ilmat/uploades/photos/' );
	define( 'IMPORT_MODULE', "datingpro" );

	define( 'PAGE_ID', 'admin_mgt' );
	$messages=array();
	if ( !defined( 'SMARTY_DIR' ) ) {
		include_once( '../init.php' );
	}
	include ( 'sessioninc.php' );
	include("import_config.php");

	// Save database and path configuration if coming from the config page
        save_config('/uploades/');

	function errhndl_import ( $err )
	{	global $t;
		global $_SESSION;
		$message="Could not connect to database. Please enter valid connection settings below.";
		$t->assign("message",$message);
		$t->assign("db",$_SESSION[IMPORT_MODULE]);
		$t->assign('rendered_page', $t->fetch('admin/import_db_config.tpl'));
		$t->display ( 'admin/index.tpl' );
		die();
	}

	include_once(PEAR_DIR.'pear.php');

	PEAR::setErrorHandling( PEAR_ERROR_CALLBACK, 'errhndl_import' );

	$error=false;
	if(empty($_SESSION[IMPORT_MODULE])) $error=true;
	if(empty($_SESSION[IMPORT_MODULE]["db_name"]) ||
	   empty($_SESSION[IMPORT_MODULE]["db_host"]) ||
	   empty($_SESSION[IMPORT_MODULE]["db_user"])) $error=true;
	if(!$error) {
		// Connecting to database
		$dsn2 = 'mysql://' . $_SESSION[IMPORT_MODULE]["db_user"] . ':' . $_SESSION[IMPORT_MODULE]["db_pass"] . '@' . $_SESSION[IMPORT_MODULE]["db_host"] . '/' . $_SESSION[IMPORT_MODULE]["db_name"];
		$db2 = @DB::connect( $dsn2 );
		if (DB::isError($db2)) {
			errhndl_import("");
			exit;
		}
		$db2->setFetchMode( DB_FETCHMODE_ASSOC );
	}
	if ($error)
	{	$t->assign("db",isset($_SESSION[IMPORT_MODULE])?$_SESSION[IMPORT_MODULE]:'');
		$t->assign('rendered_page', $t->fetch('admin/import_db_config.tpl'));
		$t->display ( 'admin/index.tpl' );
		exit;
	}

//debug($_SESSION[IMPORT_MODULE]);
//debug($db2);

	if($_REQUEST['action']=="section") {
		$query="select * from ".DB_PREFIX."_sections";
		$sections=$osDB->getAll($query,$dest_conn);
		$t->assign("sections",$sections);
		$t->assign('rendered_page', $t->fetch('admin/import_section.tpl'));
		$t->display ( 'admin/index.tpl' );
	}

	if($_REQUEST['action']=="config" && ! $_POST['db_config']) {

		$t->assign("db",$_SESSION[IMPORT_MODULE]);
		$t->assign('rendered_page', $t->fetch('admin/import_db_config.tpl'));
		$t->display ( 'admin/index.tpl' );
	}

	// =================================================================================
	// IMPORTING USERS
	// =================================================================================
	if($_REQUEST['module']=="users") {
		// 1. DELETING PREVIOUS IMPORTS
		$query="select * from ".IMPORTED_USERS." where module='datingpro'";
		$result=$osDB->query($query);

		while(($data=$result->fetchRow()))
		{

			delete_user_records($data["user_id"]);
		}
		// 4. Deleting from imported_users
		$query="delete from ".IMPORTED_USERS." where module='datingpro'";
		$osDB->query($query);
		$messages[]="Deleting previous imported users... OK";

		if($_REQUEST['action']=="import") {

			// 2. IMPORTING NEW USERS
			// Importing new users
			$query="select *, login AS username, id AS userid from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_user";
			$result2=$db2->query($query);

                        // Set image counters
                        $imgerr = 0;
                        $imgctr = 0;
                        $albumerr = 0;
                        $albumctr = 0;

			while(($data=$result2->fetchRow()))
			{	// 2.1 IMPORTING SIGNUP INFORMATION
				// Creating new record
				$query="select * from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_user_match where id_user=".$data["id"];
				$data_match=$db2->getRow($query);

				$gendres=array("1"=>"M","2"=>"F");
				$statuses=array("0"=>"pending","1"=>"active");

				$fields=array();
				$fields["username"]=uniq_username($data);
				$fields["password"]=$data["password"];
				$fields["firstname"]=$data["fname"];
				$fields["lastname"]=$data["sname"];
				$fields["email"]=$data["email"];
				$fields["gender"]=$gendres[$data["gender"]];
				$fields["lookgender"]=$gendres[$data_match["gender"]];
				$fields["lookagestart"]=$data_match["age_min"];
				$fields["lookageend"]=$data_match["age_max"];
				$fields["birth_date"]=$data["date_birthday"];
				if(!empty($data["id_country"]))
				{	$src_country=$db2->getOne("select name from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_country_spr where id=".$data["id_country"]);
					$fields["country"]=$osDB->getOne("select code from ".DB_PREFIX."_countries where name='".$src_country."'");
				}
				if(!empty($data["id_city"]))
					$fields["city"]=$db2->getOne("select name from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_city_spr where id=".$data["id_city"]);
				$fields["zip"]=$data["zipcode"];
				if(!empty($data_match["id_city"]))
					$fields["lookcity"]=$db2->getOne("select name from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_city_spr where id=".$data_match["id_city"]);
				$fields["active"]=$data["status"];
				$fields["status"]=$statuses[$data["status"]];

				// Inserting into osdate_user
				$query=insert_query(DB_PREFIX."_user",$fields);
				$osDB->query($query);
				$imported_user_id=$osDB->getOne("select last_insert_id()");

				// Inserting into osdate_inserted_users
				$fields=array();
				$fields["source_id"]=$data["id"];
				$fields["user_id"]=$imported_user_id;
				$fields["module"]="datingpro";
				$query=insert_query(DB_PREFIX."_imported_users",$fields);
				$osDB->query($query);
//debug($imported_user_id);

				// 2.2 IMPORTING PHOTOS OF USER
				$actives=array("0"=>"N","1"=>"Y");
				$picno=1;
				$query="select * from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_user_upload ".
					   "where id_user=".$data["id"]." and upload_type='f' ";
				$upload_result=$db2->query($query);
				while(($upload_data=$upload_result->fetchRow()))
				{

					// Creating new image
                                        $imgctr++;

					$filename=$_SESSION[IMPORT_MODULE]["photos_url"].'photos/'.$upload_data["upload_path"];
                                        $result = add_image('0',$filename, $actives[$upload_data["status"]]);

                                        if ( ! $result ) {

                                          $imgerr++;
                                        }
				}
				// Importing user albums
				//
				$album_id = false;

				$query="select * from ".$_SESSION[IMPORT_MODULE]["db_prefix"]."_gallary ".
					   "where id_user='".$data["id"]."'";
				$upload_result=$db2->query($query);
				while(($upload_data=$upload_result->fetchRow()))
				{
				        // Adds new album if this is the first photo
					$album_id = add_album($data["login"], 'Gallery', $album_id);

					// Creating new image
                                        $filename = $_SESSION[IMPORT_MODULE]["photos_url"].'gallary/'.$upload_data["file_path"];

                                        $albumctr++;
                                        $result = add_image($album_id,$filename, $actives[$upload_data["status"]]);

                                        if ( ! $result ) {

                                          $albumerr++;
                                        }
              			}
				// Importing user questions
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="
				SELECT
                                        d.name AS question_text,
                                        d.status,
                                        v.name AS answer_text,
                                        u.id_user

                                FROM pm_descr_spr_user u
                                LEFT JOIN pm_descr_spr_values v ON u.id_value = v.id
                                LEFT JOIN pm_descr_spr d        ON u.id_spr   = d.id
                                WHERE u.id_user = '".$data["id"]."'";
				$q_result=$db2->query($query);
				$qctr = 0;
				while(($q_data=$q_result->fetchRow()))
				{

				    if ( add_question($q_data) ) {

				        $qctr++;
				    }
				}
			}
			$messages[]="Importing signup information... OK";
                        if ( ! $imgerr ) {

			   $messages[]="Importing users photos... OK: " . $imgctr;
                        }
                        elseif ( $imgerr == $imgctr && $imgerr > 0) {

			   $messages[]="Importing users photos... ALL FAIL";
                        }
                        else  {

			   $messages[]="Importing users photos... FAIL: " . $imgerr . " OK: " . ($imgctr - $imgerr);
                        }
                        if ( ! $albumerr ) {

			   $messages[]="Importing users album photos... OK: " . $albumctr;
			}
                        elseif ( $albumerr == $albumctr && $albumerr > 0) {

			   $messages[]="Importing users album photos... ALL FAIL";
		}
                        else  {

			   $messages[]="Importing album users photos... FAIL: " . $albumerr . " OK: " . ($albumctr - $albumerr);
	}

			if ( $qctr ) {

			   $messages[]="Importing prefernces... OK: " . $qctr;
		}
			else {

			   $messages[]="Importing prefernces... FAIL";
	}


			// Now import things that need the user to already exists
			//
			$query="select * from ".IMPORTED_USERS." where module='datingpro'";
                        $result=$osDB->query($query);
			$budctr = 0;
			$winkctr = 0;
			$mailctr = 0;

                        while(($data=$result->fetchRow()))
                        {
				// Importing hotlist budies
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="SELECT id_user AS userid, id_friend AS ref_userid  FROM ".$prefix."_hotlist WHERE id_user = '".$data["source_id"]."'";

				$b_result=$db2->query($query);
				while(($b_data=$b_result->fetchRow()))
				{

				    $type = "H";
				    if ( add_buddy($b_data,$type) ) {

				        $budctr++;
		}
	}
				// Importing ban budies
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="SELECT id_to AS userid, id_from AS ref_userid  FROM ".$prefix."_mailbox_ignore WHERE id_to = '".$data["source_id"]."'";

				$b_result=$db2->query($query);

				while(($b_data=$b_result->fetchRow()))
				{

				    $type = "B";
				    if ( add_buddy($b_data,$type) ) {

				        $budctr++;
				    }
				}
 				// Importing winks
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="SELECT id_to AS  userid, id_from AS  ref_userid  FROM ".$prefix."_kisslist WHERE id_to = '".$data["source_id"]."'";

				$w_result=$db2->query($query);

				while(($w_data=$w_result->fetchRow()))
				{

				    if ( add_wink($w_data) ) {

				        $winkctr++;
				    }
		}
 				// Importing mailbox messages
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="SELECT
                                    id_to AS  touserid,
                                    id_from AS  fromuserid,
                                    subject,
                                    body AS message,
                                    UNIX_TIMESTAMP(date_creation) AS sendtime,
                                    was_read AS flagread,
                                    deleted_to AS todeleted,
                                    deleted_from AS fromdeleted

				FROM ".$prefix."_mailbox WHERE id_to = '".$data["source_id"]."'";

				$m_result=$db2->query($query);

				while(($m_data=$m_result->fetchRow()))
				{

				    if ( add_message($m_data) ) {

				        $mailctr++;
				    }
				}
                       }
		        $messages[]="Importing buddies... OK: " . $budctr;
		        $messages[]="Importing winks... OK: " . $winkctr;
		        $messages[]="Importing mail... OK: " . $mailctr;

		} // $_REQUEST['action']=="import"
		}



	// Calculating statistics
	$imported=array();
	$imported["users"]=$osDB->getOne("select count(*) from ".IMPORTED_USERS." where module='datingpro' ");
	$t->assign("imported",$imported);

	$t->assign("messages",$messages);
	$t->assign('rendered_page', $t->fetch('admin/import_datingpro.tpl'));
	$t->display ( 'admin/index.tpl' );
?>