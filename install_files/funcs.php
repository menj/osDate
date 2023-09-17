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


function parseCreateSql( $sql ) {

    preg_match( '/create\s+table\s+[`]?(\w+)[`]?\s*\((.*)\)/is', $sql, $matches );
    $fields = explode( ',', $matches[2] );
    $existingColumns = array();

    foreach( $fields as $num=>$f ) {

        $field .= $f;

        if ( substr_count( $field, '(' ) != substr_count( $field, ')' ) ) {
            $field .= ',';
            continue;
        }

        if ( preg_match( '/\s*[`]?(\w+)[`]?\s+(.*)/i', $field, $matches ) ) {

            if ( !preg_match( '/^\s*key/i', $matches[1]) && !preg_match( '/^\s*primary/i', $matches[1]) ) {
                $existingColumns[$matches[1]] = $matches[2];
            }
            else if ( preg_match( '/^\s*key\s+[`]?(\w+)[`]?\s+(.*)/i', $matches[0], $m) ) {
                $existingColumns['key'][$m[1]] = $m[2];
            }
            else if ( preg_match( '/^\s*primary\s+key\s+(.*)?/i', $matches[0], $m) ) {
                $existingColumns['primary key'] = $m[1];
            }
        }
        $field = '';
    }

    return array_keys($existingColumns);

}

/**
 * Splits set of sql queries into an array
 */
function splitSql($sql)
{
    $sql = preg_replace("/\r/s", "\n", $sql);
    $sql = preg_replace("/[\n]{2,}/s", "\n", $sql);
    $lines = explode("\n", $sql);
    $queries = array();
    $inQuery = 0;
    $i = 0;

    foreach ($lines as $line) {
        $line = trim($line);

        if (!$inQuery) {
            if (preg_match("/^CREATE/i", $line)) {
                $inQuery = 1;
                $queries[$i] = $line;
            }
            elseif (!empty($line) && $line[0] != "#") {
                $queries[$i] = preg_replace("/;$/i", "", $line);
                $i++;
            }
        }
        elseif ($inQuery) {
            if (preg_match("/^[\)]/", $line)) {
                $inQuery = 0;
                $queries[$i] .= preg_replace("/;$/i", "", $line);
                $i++;
            }
            elseif (!empty($line) && $line[0] != "#") {
                $queries[$i] .= $line;
            }
        }
    }

    return $queries;
}


function upgradeWithFile( $fileName ) {

    global $db, $t, $admin_name;

    @set_time_limit(6000);

    if ( $fd = @fopen ($fileName, 'r') ) {
        $data = @fread ($fd, filesize ($fileName));
        @fclose ($fd);
    } else {
         return false;
    }
	echo('<tr><td>Starting the database upgrade process...</td></tr>');flush();

    $tab = $db->getAll( 'show tables' );

	$diff_tables=array();
    $tables = array();
    foreach( $tab as $num=>$tbx ) {
		$tbl = array_values($tbx);

		// Skip tables with '_fc_ which is for flashchat.
		if (strpos($tbl[0],DB_PREFIX) !== false && !stristr($tbl[0],'_fc_')) {
			$tablename = $tbl[0];
			$flds=$db->getAll("describe ".$tablename);
			$fields=array();
			foreach($flds as $nm=>$fldx) {
				$fld = array_values($fldx);
				$fields[$fld[0]]=$fld[1];
			}
			$tables[$tablename]=$fields;
		}
	}
	$newtables = array();
    $queries = splitSql($data);
    foreach ($queries as $sql) {
        $sql = trim($sql);
       	$sql = str_replace ( '[prefix]', DB_PREFIX, $sql );
		$key_items = explode('`',$sql);
		$tbname=$key_items[1];
		if (!array_key_exists($tbname,$tables) ) {
			/* This is a new table. Create table. */
			$db->query($sql);
			echo('<tr><td><span style="margin-left: 12px;">New table '.$tbname.' is created.</span></td></tr>');flush();
		} else {
			$newtable = parseCreateSql($sql);
			$allok = 0;

			foreach($newtable as $k => $fld) {
				if (!array_key_exists($fld, $tables[$tbname]) && $fld != 'primary key' &&  $fld != 'key') {
					$allok=1;
				}
			}
			/* We need to force these control tables to be recreated to load new definition data */
			if (trim($tbname) == DB_PREFIX.'_glblsettings' || trim($tbname) == DB_PREFIX.'_admin_permissions' || trim($tbname) == DB_PREFIX.'_calendars' || trim($tbname) == DB_PREFIX.'_membership' || trim($tbname) == DB_PREFIX.'_payment_modules' || trim($tbname) == DB_PREFIX.'_ratings' || trim($tbname) == DB_PREFIX.'_import_questions_xref') $allok = 1;

			if ($allok == '1') {
				echo('<tr><td width=100%><span style="margin-left: 12px;">Table definition is changed for '.$tbname.'...</span><br />');flush();
				$db->query('rename table '.$tbname.' to '.$tbname.'_bkp');
				echo('<span style="margin-left: 24px;">Current table is renamed to '.$tbname.'_bkp...</span><br />');flush();
				$db->query($sql);
				echo('<span style="margin-left: 24px;">'.$tbname.' with new definition created...</span><br />');flush();
				$diff_tables[$tbname]=$tables[$tbname];
				/* Now check if this old table had any fields in addition to new definitions. If yes, add them to the table */
				foreach ($tables[$tbname] as $fld1 => $defs) {
					if (!in_array($fld1, $newtable)) {
						/* This field is additional in old table */

						$sq = 'alter table '.$tbname.' add ('.$fld1.' '.$defs.')';
						echo('<span style="margin-left: 24px;">Field '.$fld1.' in old table is added to new table</span><br />');
						$db->query($sq);
						$diff_tables[$tbname]=$tables[$tbname];
					}
				}
				echo('</td></tr>');flush();
			}
		}
    }

	echo('<tr><td>Inserting system data into newly created tables...');flush();

	$systemInserted = executeFromFile( SYSTEM_FILE , 'insert' ) ;

	if ($systemInserted !== false) {
		echo('Done.</td></tr>');
	} else {
		echo('<br /><span  style="margin-left: 12px;"><font color=red>Some error occured while inserting data into newly created tables. Please drop all original tables with "_bkp" extension (e.g. osdate_glblsettings_bkp means you should drop osdate_glblsettings). Then rename the "_bkp" tables back to original name (e.g. osdate_glblsettings_bkp to be renamed as osdate_glblsettings). Check the issue and <a href="install.php">restart installation process</a>. </font></span></td></tr>');
		exit;
	}
	echo('<tr><td>Copying back '.DB_PREFIX.'_glblsettings data into new table.. Done</td></tr>');flush();
	$glbldata = $db->getAll("select * from !",array(DB_PREFIX."_glblsettings_bkp") );

	foreach ($glbldata as $glbldt) {
		$db->query("update ! set config_value=? where config_variable=?", array(DB_PREFIX."_glblsettings", $glbldt['config_value'],  $glbldt['config_variable']) );
	}
	if (MAIL_FORMAT == '') {
		define('MAIL_FORMAT','html');
	}
	if (MAIL_TYPE=='') {
		define('MAIL_TYPE','mail');
	}

	/* Now update mail server settings, if available */
	$sql = 'update ! set config_value=? where config_variable=?';
	$db->query($sql,array(DB_PREFIX."_glblsettings",'MAIL_FORMAT',MAIL_FORMAT) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'MAIL_TYPE',MAIL_TYPE) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SMTP_HOST',SMTP_HOST) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SMTP_PORT',SMTP_PORT) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SMTP_AUTH',SMTP_AUTH) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SMTP_USER',SMTP_USER) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SMTP_PASS',SMTP_PASS) );
	$db->query($sql,array(DB_PREFIX."_glblsettings",'SM_PATH',SM_PATH) );

	$db->query('drop table '.DB_PREFIX.'_glblsettings_bkp');

	/* Now start copy of data into new tables */

	foreach($diff_tables as $tabname => $flds) {
		if ($tabname != DB_PREFIX."_glblsettings" ) {
			echo('<tr><td>Copying back data of '.$tabname.'...');flush();

			/* First check if the table is available. Otherwise, this table is not related to osdate but given the osdate prefix. Need to recreate the table */

			if ($tabname == DB_PREFIX.'_membership') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_membership');
			} elseif ($tabname == DB_PREFIX.'_calendars') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_calendars');
			} elseif ($tabname == DB_PREFIX.'_admin_permissions') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_admin_permissions');
			} elseif ($tabname == DB_PREFIX.'_payment_modules') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_payment_modules');
			} elseif ($tabname == DB_PREFIX.'_ratings') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_ratings');
			} elseif ($tabname == DB_PREFIX.'_import_questions_xref') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_import_questions_xref');
			} elseif ($tabname == DB_PREFIX.'_plugin') {
				/* delete all current records */
				$db->query('delete from '.DB_PREFIX.'_plugin');
			}

			$sql = "insert into ".$tabname." (";
			$fields="";
			foreach($flds as $n=>$fld){
				if ($fields !='') $fields.=",";
				$fields.=$n;
			}
			$sql .=$fields.") select ".$fields." from ".$tabname."_bkp";
			$db->query($sql);
			$db->query("drop table ".$tabname."_bkp");
			echo('Done.</td></tr>');flush();
		}

	}

	/* Now upgrade admin_permissions table with all enabled values */
	$db->query('delete from ! where adminid = ?', array(DB_PREFIX.'_admin_permissions', 1) );
	$db->query("INSERT INTO `".DB_PREFIX."_admin_permissions` (`id`, `adminid`, `site_stats`, `profie_approval`, `profile_mgt`, `section_mgt`, `affiliate_mgt`, `affiliate_stats`, `news_mgt`, `article_mgt`, `story_mgt`, `poll_mgt`, `search`, `ext_search`, `send_letter`, `pages_mgt`, `chat`, `chat_mgt`, `forum_mgt`, `mship_mgt`, `payment_mgt`, `banner_mgt`, `seo_mgt`, `admin_mgt`, `admin_permit_mgt`, `global_mgt`, `change_pwd`,`cntry_mgt`,`snaps_require_approval`,`featured_profiles_mgt`, `calendar_mgt`, `event_mgt`, `import_mgt`,`profile_ratings`, `plugin_mgt`,`promo_mgt`, `blog_mgt`    ) VALUES (1, 1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1','1','1','1','1','1','1','1', '1','1','1')");
	echo('<tr><td>Updating "admin" user with all privileges... Done</td></tr>');flush();

	$payment_modules = $db->getAll('select distinct module_key from '.DB_PREFIX.'_payment_config');
	foreach ($payment_modules as $key => $val) {
		$db->query('update '.DB_PREFIX.'_payment_modules set enabled="Y" where module_key="'.$val['module_key'].'"');
	}
	echo('<tr><td>Setting installed payment modules... Done</td></tr>');flush();

	echo("<tr><td>Loading language files...</td></tr>");flush();
	$loadlang[]='lang_english';
	if (count($loadlang) > 0) {
	/* we need to load language files. If the table is available, remove current data for the language

	This has to work in initial loading as well as upgrade
	*/
		foreach ($loadlang as $key => $lang) {
			$language= str_replace('lang_','',$lang);
			$db->query('delete from '.$prefix,"_languages where lang='".$language."'");

			$file = dirname(__FILE__) . '/language/'.$lang.'/lang_main.php';
			$file = str_replace( 'install_files/', '', $file );

			$lang = array();

			include $file;

			$sql = 'insert into ! (lang, mainkey, subkey, descr) values (?, ?, ?, ?)';
			foreach ($lang as $key => $val) {
				if (is_array($val)) {
					foreach ($val as $subkey => $descr) {
						$db->query($sql, array($prefix.'_languages', $language, $key, $subkey, htmlentities($descr)));
					}
				} else {
					$db->query($sql, array($prefix.'_languages', $language, $key, "", htmlentities($val)));
				}
			}
			echo('<tr><td><span style="margin-left:12px;">'.ucfirst($language).' language  is loaded...</span></td></tr>'); flush();
		}
	}

	update_pictures_loaded_counts();

	/* Update extsearchable flag to 'Y' to enable extended search for all items */
	$db->query('update ! set extsearchable=?',array(DB_PREFIX.'_questions', 'Y') );

	/* Update the questions table for making 'A' as default value for gender */
	$db->query("update ".DB_PREFIX."_questions set gender='A' where gender is null or gender = ''");

	/* Convert existing buddy_ban_table to user userid as key */

	$bbrecs = $db->getAll('select * from ! ',array(DB_PREFIX.'_buddy_ban_list') );
	foreach ($bbrecs as $bbrec) {
		if (is_int(trim($bbrec['userid']) ) ) {
			$userid = $bbrec['userid'];
		} else {
			$userid = $db->getOne('select id from ! where username = ?',array(DB_PREFIX.'_user', $bbrec['userid']) );
		}
		if (is_int(trim($bbrec['ref_userid'] )) ) {
			$ref_userid = $bbrec['ref_userid'];
		} else {
			$ref_userid = $db->getOne('select id from ! where username = ?',array(DB_PREFIX.'_user', $bbrec['ref_userid']) );
		}
		if ($userid > 0 and $ref_userid > 0) {
			$db->query('update ! set userid=?, ref_userid=? where id=?', array(DB_PREFIX.'_buddy_ban_list', $userid, $ref_userid, $bbrec['id']) );
		}
	}
	echo('<tr><td><span >Update process of buddy_ban_list table completed...</span></td></tr>'); flush();

	/* Check if luckySpinGender is installed or not. If not, add it as installed plugin. */
	$plugin_rec = $db->getRow('select * from ! where name=?',array(DB_PREFIX.'_plugin','luckySpinGender') );
	if (!isset($plugin_rec['name']) || $plugin_rec['name'] != 'luckySpinGender') {
		$db->query('insert into ! (name, active) values(?, ?)', array( DB_PREFIX.'_plugin','luckySpinGender', '1') );
	}
	echo('<tr><td><span >luckySpinGender installation completed...</span></td></tr>'); flush();

	return true;
}

/**
* Executes sql queries from the file
* $mode - 'insert' or 'create', to know at what stage we are ...
*/
function executeFromFile( $fileName , $mode = 'insert' )
{
    global $db;

	$errcnt = 0;
    @set_time_limit(1200);

    if ( $fd = @fopen ($fileName, 'r') ) {
        $data = @fread ($fd, filesize ($fileName));
        @fclose ($fd);
    } else {
         return false;
    }

    if (empty($data))
        return false;

    $queries = splitSql($data);

    foreach ($queries as $sql) {
        $sql = trim($sql);
        //echo $sql . "\n\n";

        if (empty($sql) || $sql[0] == '#')
            continue;

        $sql = str_replace ( '[prefix]', DB_PREFIX, $sql);
        $tbl = explode ( '`', $sql );

        if ( $mode == 'create' ) {
            $result = $db -> tableInfo ( $tbl[1] );

            if ( !$db->isError( $result ) ) {
				echo("<font color=red>".$tbl[1]." Already exists. Bypassed. </font><br />");
				$insertfailed=1;
            } else {
				print("&nbsp;&nbsp;&nbsp;&nbsp;Creating table : ".$tbl[1]." ...  ");
				$result = $db->query( $sql );

				if ( $db->isError( $result ) ) {
					// debug
					// print_r( $result );

					if ($mode=='create' ) {
						print("<font color=red>Failed</font><br />");flush();
					}
					$insertfailed=1;
				} else {
					if ($mode=='create' ) {
						print("done<br />");
					}
				}

			}
        } else {
			/* Insert data */
			if ($sql != '') {
				$result = $db->query( $sql );
				if ( $db->isError( $result ) ) {
					$insertfailed=1;
				}
			}
		}
    }

	if ($insertfailed=='1') return false;

    return true;
}

function changeConfigVariable( $line, $name, $value )
{
	if (!( strpos ($line , $name) === FALSE) && preg_match ('/\s*define\s*\(\s*\'\s*'. $name .'\'\s*,/', $line)) {
		if ( $name == 'DEFAULT_LANG' ) {
			$out = 'define( \''. $name .'\', '. $value .' );'. "\n";
		} else if ( $name == 'ADODB_DIR' ) {
			$out = 'define( \''. $name .'\', FULL_PATH.'."'". $value ."'".' );'. "\n";
		} else {
			$out = 'define( \''. $name .'\', \''. $value .'\' );'. "\n";
		}
        return $out;
    }
    else
        return false;
}


function getConfigData( $replace , $file=CONFIG_FILE)
{
    $line = file( $file );
    $s = '';

    foreach ( $line as $k => $v )
    {
        $replaced = 0;

        foreach ( $replace as $name=>$value ) {
            if ( $l = changeConfigVariable( $v, $name, $value) ) {
                $configData .= $l;
                $replaced = 1;
            }
        }
        if ( !$replaced )
            $configData .= $v;
    }

    return $configData;
}

function writeConfig( $configData )
{

   // Writing config file to the root directory
	$fp = @fopen( './temp/myconfigs/config.php', "wb" );

    if ( $fp ) {
        fwrite( $fp, $configData );
        fclose( $fp );
		return true;
    }  else {
        return false;
	}
}


//Forum Configuration changing

function f_changeConfigVariable( $line, $name, $value )
{
	if (!( strpos ($line , $name) === FALSE) ) {
			$out = '$'. $name .'= \''. $value .'\';'. "\n";
        return $out;
    }
    else
        return false;
}


function f_getConfigData( $replace )
{
    $line = file ( FORUM_CONFIG_FILE );

    $s = '';

    foreach ( $line as $k => $v )
    {
        $replaced = 0;

        foreach ( $replace as $name=>$value ) {
            if ( $l = f_changeConfigVariable( $v, $name, $value) ) {
                $configData .= $l;
                $replaced = 1;
            }
        }
        if ( !$replaced )
            $configData .= $v;
    }
    return $configData;
}

function f_writeConfig( $configData )
{
    // Writing config file to the root directory
    $fp = @fopen( FORUM_CONFIG_FILE, 'wb' );

    if ( $fp ) {
        fwrite( $fp, $configData );
        fclose( $fp );
        return true;
    }
    else
        return false;
}


function Message( $message, $good )
{
    if ( $good )
        $yesno = '<b><font color="green">Yes</font></b>';
    else
        $yesno = '<b><font color="red">No</font></b>';

    echo '<tr><td class="normal">'. $message .'</td><td>'. $yesno .'</td></tr>';
}

/**
 ** Check writeability of needed files and directories - used for step 1.
 **/

function isWriteable ( $canContinue, $file, $mode, $desc ) {
    @chmod( $file, $mode );
    $good = is_writable( $file ) ? 1 : 0;
    Message ( $desc.' is writable: ', $good );
    return ( $canContinue && $good );
}

function FTPerrhndl ( $error ) {
    global $FTPerr;

    if ( !$FTPerr ) {
        $FTPerr = true;
        $errmsg = $error;
        include 'step1.5.tpl';
    }
}

function errhndl ( $err ) {

    switch( $err->code ) {
        case -24:
            $msg = 'There was an error connecting to the database, please make sure it is running and that your login settings are correct.';
            break;

        default:
            $msg = 'The installer generated error code: ' . $err->code;
            break;
    }
    echo '<tr><td colspan=2 valign=top>';
    echo "<font face=Arial><h2>Unexpected Error</h2><font face=Arial size=2>$msg<br /><br /></font>

    Detailed error: ".$err->message."</td></tr></table>";

    die();
}

function copyToForum() {
	global $db;

	include_once(DOC_ROOT.'temp/myconfigs/config.php');

	$sql = 'SELECT id, username, password, email FROM !';

	$data = $db->getAll( $sql, array( USER_TABLE ) );

	$userid = $db->getOne('select max(user_id)+1 from !', array( 'phpbb_users' ) );

	foreach( $data as $index => $row ) {

		$db->query('delete from ! where username = ?', array('phpbb_users', $row['username']) );

		$sql = 'insert into ! ( user_id, username, user_password, user_email, user_active, user_level , user_regdate) values ( ?, ?, ?, ?, ?, ?, ? )';

		// md5( $row['password'] ) ?

		$db->query( $sql, array( 'phpbb_users', $userid, $row['username'], $row['password'], $row['email'], 1, 0, time() ) );

		$userid++;
	}

	$sql = 'SELECT id, username, password FROM !';

	$data = $db->getAll( $sql, array( ADMIN_TABLE ) );

	foreach( $data as $index => $row ) {

		$db->query('delete from ! where username = ?', array('phpbb_users', $row['username']) );

		$sql = 'insert into ! ( user_id, username, user_password, user_email, user_active, user_level, user_regdate ) values ( ?, ?, ?, ?, ?, ?, ? )';

		// md5( $row['password'] ) ?

		$db->query( $sql, array( 'phpbb_users', $userid, $row['username'], $row['password'], $row['email'], 1, 1 , time()) );

		$userid++;
	}
}

function DeleteFiles($fromdir, $recursed = 1 ) {
	if (isset($fromdir) && !is_dir($fromdir)) {
		echo ("Invalid directory $fromdir");
		return false;
	}

	$filelist = array();
	$dir = opendir($fromdir);

	while($file = readdir($dir)) {
		if($file == "." || $file == ".." || $file == 'readme.txt' || $file == 'index.html' || $file == 'index.htm') {
			continue;
		} elseif (is_dir($fromdir."/".$file)) {
			if ($recursed == 1) {
				$temp = DeleteFiles($fromdir."/".$file, $recursed);
			}
		} elseif (file_exists($fromdir."/".$file)) {
			/* copy($fromdir."/".$file, $todir.$file); */
			/* Trying to overcome the issue of installation on some systems
			   where copy command may be issuing some unwanted checks.  */
			unlink($fromdir."/".$file);
		}
	}

	closedir($dir);
	return true;
}

function update_pictures_loaded_counts() {

	global $db;

	$pics = $db->getAll('select userid, count(*) as cnt from ! group by userid', array(DB_PREFIX.'_usersnaps'));

	foreach ($pics as $pic) {
		$db->query('update ! set pictures_cnt=? where id=?', array(DB_PREFIX.'_user', $pic['cnt'], $pic['userid']));

	}

	$videos = $db->getAll('select userid, count(*) as cnt from ! group by userid', array(DB_PREFIX.'_uservideos'));

	foreach ($videos as $video) {
		$db->query('update ! set videos_cnt=? where id=?', array(DB_PREFIX.'_user', $video['cnt'], $video['userid']));

	}
}

?>