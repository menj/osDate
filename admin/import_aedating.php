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
***********************************************/

	//define( 'SRC_PHOTOS_URL', 'http://aedating.ilmat/id_img/' );
	define( 'IMPORT_MODULE', "aedating" );

	define( 'PAGE_ID', 'admin_mgt' );
	$messages=array();
	if ( !defined( 'SMARTY_DIR' ) ) {
		include_once( '../init.php' );
	}
	include ( 'sessioninc.php' );
	include("import_config.php");
	include("import_aedating_prof.php");

	// Save database and path configuration if coming from the config page
        save_config('');

	function errhndl_import ( $err )
	{	global $t;
		global $_SESSION;
		$message="Could not connect to database. Please enter valid connection settings below.";
		$t->assign("message",$message);
		$t->assign("db",$_SESSION[IMPORT_MODULE]);
		$t->assign('rendered_page', $t->fetch('admin/import_config_aedating.tpl'));
		$t->display ( 'admin/index.tpl' );
		die();
	}
	//PEAR::setErrorHandling( PEAR_ERROR_CALLBACK, 'errhndl_import' );

	$error=false;
	if(empty($_SESSION[IMPORT_MODULE])) $error=true;
	if(empty($_SESSION[IMPORT_MODULE]["db_name"]) ||
	   empty($_SESSION[IMPORT_MODULE]["db_host"]) ||
	   empty($_SESSION[IMPORT_MODULE]["ftp_username"]) ||
	   empty($_SESSION[IMPORT_MODULE]["ftp_password"]) ||
	   empty($_SESSION[IMPORT_MODULE]["ftp_hostname"]) ||
	   empty($_SESSION[IMPORT_MODULE]["ftp_path"]) ||
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
	{
		$t->assign("db",isset($_SESSION[IMPORT_MODULE])?$_SESSION[IMPORT_MODULE]:'');
		$t->assign('rendered_page', $t->fetch('admin/import_config_aedating.tpl'));
		$t->display ( 'admin/index.tpl' );
		exit;
	}

//debug($_SESSION[IMPORT_MODULE]);
//debug($db2);

	if($_REQUEST['action']=="section") {
		$query="select * from ".DB_PREFIX."_sections";
		$sections=$osDB->getAll($query);
		$t->assign("sections",$sections);
		$t->assign('rendered_page', $t->fetch('admin/import_section.tpl'));
		$t->display ( 'admin/index.tpl' );
		exit;
	}

	if($_REQUEST['action']=="config" && ! $_POST['db_config']) {

		$t->assign("db",$_SESSION[IMPORT_MODULE]);
		$t->assign('rendered_page', $t->fetch('admin/import_config_aedating.tpl'));
		$t->display ( 'admin/index.tpl' );
	}

	$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];

	// =================================================================================
	// IMPORTING USERS
	// =================================================================================
	if($_REQUEST['module']=="users") {
		// 1. DELETING PREVIOUS IMPORTS

		$query="select * from ".DB_PREFIX."_imported_users where module='aedating'";
		$result=$osDB->query($query);
		while(($data=$result->fetchRow()))
		{

			delete_user_records($data["user_id"]);
		}
		// 4. Deleting from imported_users
		$query="delete from ".DB_PREFIX."_imported_users where module='aedating'";
		$osDB->query($query);
		$messages[]="Deleting previous imported users... OK";

		if($_REQUEST['action']=="import") {
			// 2. IMPORTING NEW USERS
			// Importing new users
			$query="
                            SELECT p.*,NickName AS username,ID AS userid, z.County
                            FROM ".$prefix."Profiles p
                            LEFT JOIN ".$prefix."ZIPCodes z ON p.zip = z.ZIPCode
                        ";
			$result2=$db2->query($query);
			$imgerr = 0;
			$imgctr = 0;
			$albumerr = 0;
			$albumctr = 0;
			$blogctr = 0;
			while(($data=$result2->fetchRow()))
			{
                                // 2.1 IMPORTING SIGNUP INFORMATION
				$gendres=array("male"=>"M","female"=>"F","couple"=>"C");
				$statuses=array("Unconfirmed"=>"pending","Approval"=>"pending","Active"=>"active","Rejected"=>"reject","Suspended"=>"suspend");

				$fields=array();
                                $username = uniq_username($data);
				$fields["username"]=$username;
				$fields["password"]=md5($data["Password"]);
				$fields["firstname"]=$data["RealName"];
				$fields["lastname"]=$data["RealName2"];
				$fields["email"]=$data["Email"];
				$fields["gender"]=$gendres[$data["Sex"]];
				$fields["lookgender"]=$gendres[$data["LookingFor"]];
				$lookingage=explode("-",$data["LookingAge"]);
				$fields["lookagestart"]=$lookingage[0];
				$fields["lookageend"]=$lookingage[1];
				$fields["birth_date"]=$data["DateOfBirth"];
				if(!empty($data["Country"]))
				{	$src_country=$prof[countries][$data["Country"]];
					$fields["country"]=$osDB->getOne("select code from ".DB_PREFIX."_countries where name='".$src_country."'");
				}
				$fields["city"] = $data["City"];
				$fields["county"] = $data["County"];
				$fields["timezone"] = $data["GMTOffset"];
				$fields["state_province"] = $data["State"];
				$fields["zip"]=$data["zip"];
				$fields["active"]=($data["Status"]=="Active"?"1":"0");
				$fields["status"]=$statuses[$data["Status"]];

				// Inserting into osdate_user
				$query=insert_query(DB_PREFIX."_user",$fields);
				$result=$osDB->query($query);
				$imported_user_id=$osDB->getOne("select last_insert_id()");

				// Inserting into osdate_inserted_users
				$fields=array();
				$fields["source_id"]=$data["ID"];
				$fields["user_id"]=$imported_user_id;
				$fields["module"]="aedating";
				$query=insert_query(DB_PREFIX."_imported_users",$fields);
				$osDB->query($query);
//debug($imported_user_id);

				// 2.2 IMPORTING PHOTOS OF USER
                                $picno = 0;
				for($m=0;$m<=10;$m++) {
                                    if(!empty($data["Pic_".$m."_addon"]))
				{	// Creating new image
                                            $imgctr++;

                                            $filename=$_SESSION[IMPORT_MODULE]["photos_url"].'id_img/'.$data["ID"]."_".$m."_".$data["Pic_".$m."_addon"].".jpg";

                                            $result = add_image('0',$filename, 'Y');

                                            if ( ! $result ) {

                                              $imgerr++;
                                            }
                                    }
				}
				// Importing user albums
				//
				$album_id = false;
				$album_name = false;


				$query="
				SELECT
				  o.file_name,
				  o.type,
                                  o.approved,
				  o.approved,
				  CONCAT( c.name,  ' -> ', a.name )  AS name,
				  p.ID AS userid

                                  FROM
                                      ".$prefix.".gallery_objects o,
                                      ".$prefix.".gallery_categories c,
                                      ".$prefix.".Profiles p

                                  LEFT  JOIN ".$prefix.".gallery_alboms a ON o.id_gallery_alboms = a.id

                                  WHERE p.ID = c.id_profiles
                                    AND p.ID = '".$data['ID']."'
                                    AND a.id_gallery_categories = c.id

                                  ORDER BY c.name, a.name";

                                $upload_result = $db2->query($query);
				$actives = array("0"=>"N", "1"=>"Y");

				while(($upload_data = $upload_result->fetchRow()))
				{

				        if ( $upload_data['name'] != $album_name ) {

				            $album_name = $upload_data['name'];
                                            // Adds new album if this is the first photo
                                            $album_id = add_album($username, $upload_data['name'], $album_id);
					}
					// Creating new image
                                        $filename =  get_ftp_path($upload_data["file_name"],'/gallery/');

                                        $albumctr++;
                                        $result = add_image($album_id,$filename, $actives[$upload_data["approved"]]);

                                        if ( ! $result ) {

                                          $albumerr++;
                                        }
              			}
				$query="
				SELECT * FROM ".$prefix."Blog WHERE owner = '".$data['ID']."' ORDER by id";

                                $b_result = $db2->query($query);
                                $blogxref = array();

				while(($b_data = $b_result->fetchRow()))
				{
                                        if ( add_blog($b_data) ) {

                                          $blogctr++;
                                        }
              			}
				// Importing user questions
				//
				$prefix = $_SESSION[IMPORT_MODULE]["db_prefix"];
				$query="SELECT DISTINCT question_text FROM ! WHERE module = ? ";
				$questarry = $osDB->getAll($query,array(IMPORT_QUESTIONS_XREF,IMPORT_MODULE));
				$qctr = 0;
				foreach ( $questarry AS $q_text )
				{
                                    $text = $q_text['question_text'];
				    $q_data = array(
                                        'question_text' => $text,
                                        'answer_text' => $data[$text],
                                    );
				    if ( add_question($q_data) ) {

				        $qctr++;
				    }
				}
			}
			$messages[]="Importing signup information... OK";
                        if ( ! $imgerr ) {

			$messages[]="Importing users photos... OK";
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
                        elseif ( $albumerr == $albumctr && $albumerr > 0 ) {

			   $messages[]="Importing users album photos... ALL FAIL";
                        }
                        else  {

			   $messages[]="Importing album users photos... FAIL: " . $albumerr . " OK: " . ($albumctr - $albumerr);
                        }
			$messages[]="Importing blogs... OK: " . $blogctr;
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
				$query="SELECT ID AS userid, Profile AS ref_userid  FROM ".$prefix."HotList WHERE ID = '".$data["source_id"]."'";

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
				$query="SELECT ID AS userid, Profile AS ref_userid  FROM ".$prefix."BlockList WHERE ID = '".$data["source_id"]."'";

				$b_result=$db2->query($query);

				while(($b_data=$b_result->fetchRow()))
				{

				    $type = "B";
				    if ( add_buddy($b_data,$type) ) {

				        $budctr++;
				    }
			}
				// Importing friend budies
				//
				$query="SELECT ID AS userid, Profile AS ref_userid  FROM ".$prefix."FriendList WHERE ID = '".$data["source_id"]."'";

				$b_result=$db2->query($query);

				while(($b_data=$b_result->fetchRow()))
				{

				    $type = "F";
				    if ( add_buddy($b_data,$type) ) {

				        $budctr++;
				    }
	}
 				// Importing winks
				//
				$query="SELECT ID AS  userid, Member AS  ref_userid, Number  FROM ".$prefix."VKisses WHERE ID = '".$data["source_id"]."'";

				$w_result=$db2->query($query);

				while(($w_data=$w_result->fetchRow()))
				{

				    for ($m = 1; $m <= $w_data['Number']; $m++) {

                                        if ( add_wink($w_data) ) {

                                            $winkctr++;
                                        }
		}
	}
 				// Importing mailbox messages
				//
				$query="SELECT
                                    Recipient AS  touserid,
                                    Sender AS  fromuserid,
                                    'None' AS subject,
                                    Text AS message,
                                    UNIX_TIMESTAMP(Date) AS sendtime,
                                    IF(New='1',0,1) AS flagread,
                                    '0' AS todeleted,
                                    '0' AS fromdeleted

				FROM ".$prefix."Messages WHERE Recipient = '".$data["source_id"]."'";

				$m_result=$db2->query($query);

				while(($m_data=$m_result->fetchRow()))
				{

				    if ( add_message($m_data) ) {

				        $mailctr++;
		}
	}
 				// Importing Guestbook messages
				//
				$query="SELECT
                                    Recipient AS  touserid,
                                    Sender AS  fromuserid,
                                    'None' AS subject,
                                    Text AS message,
                                    UNIX_TIMESTAMP(Date) AS sendtime,
                                    IF(New='1',0,1) AS flagread,
                                    '0' AS todeleted,
                                    '0' AS fromdeleted

				FROM ".$prefix."Guestbook WHERE Recipient = '".$data["source_id"]."'";

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
	$imported["users"]=$osDB->getOne("select count(*) from ".DB_PREFIX."_imported_users where module='aedating' ");
	$t->assign("imported",$imported);

	$t->assign("messages",$messages);
	$t->assign('rendered_page', $t->fetch('admin/import_aedating.tpl'));
	$t->display ( 'admin/index.tpl' );
?>