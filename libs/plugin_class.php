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


class Plugin {

   var $osDB; // Database object
   var $errorMessage;

   function Plugin() {

      $this->osDB =& $GLOBALS['osDB'];

   }
  function editPlugin($name) {

   $data = array(
      'active'  => $_POST['active'],
   );

   $name = $_POST['name'];

   $this->osDB->autoExecute(PLUGIN_TABLE, $data, DB_AUTOQUERY_UPDATE, "name = '$name'");

   $this->updateAccess($name, $_POST['roleid']);

   $this->updateConfig($name);
   unset($data);

  }

  function addAccess($name) {

     // Convert the name to an id
     //
     $pluginid = $this->osDB->getOne( "SELECT id FROM ! WHERE name = ?", array( PLUGIN_TABLE, $name ) );

     $roles = $this->getPluginAccess($pluginid);

     foreach ( $roles AS $role ) {
		$this->osDB->query("insert into  ! (pluginid, roleid, access) values (?,?,?)", array( PLUGIN_ACCESS_TABLE, $pluginid, $role['roleid'], '1' ) );

     }
  }
  function updateAccess($name,$roleid) {

     // Convert the name to an id
     //
     $pluginid = $this->osDB->getOne( "SELECT id FROM ! WHERE name = ?", array( PLUGIN_TABLE, $name ) );

     foreach ( $roleid AS $key => $value ) {

        $accessid = $this->osDB->getOne( "SELECT id FROM ! WHERE roleid = ? AND pluginid = ?", array( PLUGIN_ACCESS_TABLE, $key, $pluginid ) );

        // If the record exists, update it
        if ( $accessid ) {
            $this->osDB->query("UPDATE ! SET access = ?  WHERE id = ?", array( PLUGIN_ACCESS_TABLE, $value, $accessid ) );
        }  else {
        // If the record doesn't exist, create it
            $this->osDB->query("insert into  ! (pluginid, roleid, access) values (?,?,?)", array( PLUGIN_ACCESS_TABLE, $pluginid, $key, $value ) );
        }
     }

  }
  function getPlugin($name) {

     return $this->osDB->getRow( "SELECT * FROM ! WHERE name = ?", array( PLUGIN_TABLE, $name ) );
   }
  function addPlugin() {

    $pluginname = $this->uploadPlugin();

    if ( ! $this->getErrorMessage() && $pluginname ) {

       $this->installPlugin($pluginname);
    }
    else {

      $this->setErrorMessage("Unknown error uploading plugin");
    }
  }
  function installPlugin($pluginname) {

      $found = $this->osDB->getOne("SELECT id FROM ! WHERE  name = ?", array(PLUGIN_TABLE , $pluginname ) );

      if ( ! $found ) {

         $this->osDB->query("INSERT INTO ! (name,active) VALUES (? , 1)", array(PLUGIN_TABLE,$pluginname));

         $this->addAccess($pluginname);

         $this->updateConfig($pluginname);

         $this->runInstallSql($pluginname);

		include_once(PLUGIN_DIR . $pluginname . '/libs/'. $pluginname . '.php');

		$pluginobject =& new $pluginname();

		$display_name = $pluginobject->display_name;

		$this->setErrorMessage($pluginobject->display_name . " plugin is installed");

      } else {

		include_once(PLUGIN_DIR . $pluginname . '/libs/'. $pluginname . '.php');

		$pluginobject =& new $pluginname();

		$display_name = $pluginobject->display_name;

		$this->setErrorMessage($pluginobject->display_name . " plugin is already installed");
      }
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

  function runInstallSql($pluginname) {

    $pluginid = $this->osDB->getOne("SELECT id FROM ! WHERE name = ?", array(PLUGIN_TABLE,$pluginname));

	if ($pluginname == 'langBanners') {
 		 $data['pluginid'] = $pluginid;
         $data['name']    = DB_PREFIX.'_banners';

         $this->osDB->autoExecute(PLUGIN_TABLES_TABLE, $data, DB_AUTOQUERY_INSERT);

    }elseif (is_readable(PLUGIN_DIR . $pluginname . '/sql/install.sql')){
	    $sql = file_get_contents ( PLUGIN_DIR . $pluginname . '/sql/install.sql');
		if ($sql != '') {
		    // Replace __DB_PREFIX__ with the real prefix
		    //
		    $sql = str_replace('__DB_PREFIX__', DB_PREFIX . '_', $sql);
		    $sql = str_replace('`', '', $sql);

		    $sql_array = $this->splitSql($sql);
		    foreach ( $sql_array AS $sql) {

		          $this->runSqlQuery($sql, $pluginid);
		    }
		    unset($sql_array);
		}
	}
  }
  function runRemoveSql($pluginid) {
     $tables = $this->osDB->getAll("SELECT * FROM ! WHERE pluginid = ?", array(PLUGIN_TABLES_TABLE, $pluginid));

    // Delete each table belonging to the plugin
    //

    foreach ( $tables AS $table ) {
        $this->osDB->query("DROP TABLE !", array($table['name']) );
    }
	unset($tables);
    $this->osDB->query("DELETE FROM ! WHERE pluginid = ?", array(PLUGIN_TABLES_TABLE, $pluginid));
  }

  function runSqlQuery($sql, $pluginid) {

      if ( preg_match('/\s*CREATE\s+TABLE\s+(\w+)\s+/im', $sql, $match ) ) {

         $data['pluginid'] = $pluginid;
         $data['name']    = $match[1];

         $this->osDB->query('insert into ! (pluginid, name) values (?,?)',array(PLUGIN_TABLES_TABLE, $data['pluginid'], $data['name']) );

         $this->osDB->query($sql);
      } elseif ( preg_match('/\s*INSERT\s+INTO\s+(\w+)\s+/im', $sql, $name ) ) {
      // If it's an insert, make sure the table is a plugin table
      //
            $this->osDB->query($sql);
      } elseif ( preg_match('/\s*UPDATE\s+(\w+)\s+SET/im', $sql, $name ) ) {
      // If it's an update, make sure the table is a plugin table
      //
              $this->osDB->query($sql);
      } else {

          // Sorry only updates or inserts allowed
      }

  }

  function uploadPlugin() {

      if (! is_uploaded_file($_FILES['plugin']['tmp_name'])) {

         $this->setErrorMessage("Error uploading plugin");
      }

      $pluginname = false;

      if ( ! $this->getErrorMessage() ) {

         $pluginname = $this->unzipFile();
      }

      return $pluginname;
  }
  function unzipFile() {

      require_once( PEAR_DIR . "File/Archive.php");

      $mvsrc = $_FILES['plugin']['tmp_name'];
      $mvdest = TEMP_DIR . $_FILES['plugin']['name'];

      if ( ! move_uploaded_file ( $mvsrc, $mvdest ) ) {

         $this->setErrorMessage("Error renaming file");
      }

      // Get plugin name
      //
      list($pluginname,$ext) = explode('.',$_FILES['plugin']['name']);

      $zipsrc = $mvdest . '/';
      $zipdest = PLUGIN_DIR;

      $zip =& new File_Archive();
      $zip->extract( $zipsrc, $zipdest );

     if ( ! file_exists(PLUGIN_DIR . $pluginname) ) {

         $this->setErrorMessage("Can't find plugin after unzipping");
     }

      if ( ! unlink($mvdest) ) {

         $this->setErrorMessage("Error cleaning up zip file");
      }
      return $pluginname;
  }
  function deletePlugin($name) {
    $pluginid = $this->osDB->getOne("SELECT id FROM ! WHERE name = ?", array(PLUGIN_TABLE,$name));

	if ($name != 'langBanners') {
		/* drop tables only for lang banners.. */
	    $this->runRemoveSql($pluginid);
	} else {
		$this->osDB->query("DELETE FROM ! WHERE pluginid = ?", array(PLUGIN_TABLES_TABLE, $pluginid));
	}
    $this->osDB->query("DELETE FROM ! WHERE name = ?", array(PLUGIN_TABLE,$name));
    $this->osDB->query("DELETE FROM ! WHERE pluginid = ?", array(PLUGIN_CONFIG_TABLE,$pluginid));
    $this->osDB->query("DELETE FROM ! WHERE pluginid = ?", array(PLUGIN_ACCESS_TABLE,$pluginid));

	// Just removing from DB should be enough. No n eed to remove al files from system.
	// Vijay Nair
    // $this->deletePluginFiles($name);
  }
  function deletePluginFiles($pluginname) {

      $this->recursiveDelete(PLUGIN_DIR . $pluginname);
  }
  function recursiveDelete($dirname) {

      // recursive function to delete
      // all subdirectories and contents:
      $dir_handle = opendir($dirname);

      while($file = readdir($dir_handle))
      {
         if($file!="." && $file!="..")
         {
            if( ! is_dir($dirname."/".$file) ) {

               $this->unlink ($dirname."/".$file) ;
            }
            else {

               $this->recursiveDelete($dirname."/".$file);
            }
         }
      }
      closedir($dir_handle);

      if ( ! $this->rmdir($dirname) ) {

           $this->setErrorMessage("Unable to completely remove plugin files");
      };

      return true;
  }
  function rmdir($dirname) {

      if ( ! $this->getErrorMessage() && ! is_writable($dirname) ) {

         $this->setErrorMessage("Unable to completely remove plugin files");
      }
      elseif ( ! $this->getErrorMessage() &&  ! rmdir ($dirname) ) {

         $this->setErrorMessage("Unable to completely remove plugin files");
      }
  }
  function unlink($filename) {

      if ( ! $this->getErrorMessage() &&  ! is_writable($filename) ) {

         $this->setErrorMessage("Unable to completely remove plugin files");
      }
      elseif ( ! $this->getErrorMessage() &&  ! unlink ($filename) ) {

         $this->setErrorMessage("Unable to completely remove plugin files");
      }
  }
  function multipleDeletePlugin($names) {

    foreach ( $names AS $key => $name ) {

        $this->deletePlugin($name);
    }
  }
  function getAllPlugins() {

      $names = array();
      // Read plugin directory
      //
      if ($dh = opendir(PLUGIN_DIR)) {

         while (($file = readdir($dh)) !== false) {

            if ($file != "." && $file != "..") {

               $names[] = $file;
            }
         }
         closedir($dh);
      }

      asort($names);
      $list = array();

      foreach ($names AS $name ) {

		if ($name != 'luckySpinGender') {
            $rec = $this->osDB->getRow("SELECT * FROM ! WHERE name = ?", array( PLUGIN_TABLE, $name ) );

            if ( isset($rec['id']) && $rec['active']== 0 ) {

               $active    = 'N';
               $installed = 'Y';
            }
            elseif ( isset($rec['id']) && $rec['active'] == 1 ) {

               $active    = 'Y';
               $installed = 'Y';
            }
            else {

               $active    = 'N';
               $installed = 'N';
            }
            // If it's a valid plugin, get the plugin name
            //
            if ( $name != 'pluginTemplate' && file_exists(PLUGIN_DIR . $name . '/libs/'. $name . '.php') ) {

                include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

                $pluginobject =& new $name();

                $list[] = array(
					'id' => (isset($rec['id'])?$rec['id']:''),
                    'display_name' => $pluginobject->display_name,
                    'name' => $name,
                    'active' => $active,
                    'installed' => $installed,
                );
				unset($pluginobject);
            }
		}
      }
      unset($names, $rec);

      return $list;
 }
 function getPluginAccess($pluginid) {
    $data =  $this->osDB->getAll("SELECT m.name, m.roleid,
          IF(a.access IS NULL,'1',a.access) AS access,
          a.id AS accessid,
          concat('roleid','[',m.roleid,']') radioname
        FROM ".MEMBERSHIP_TABLE." m
        LEFT JOIN ".PLUGIN_ACCESS_TABLE." a ON a.roleid = m.id AND a.pluginid = ?
        WHERE  enabled = 'Y'
     ", array($pluginid) );

    return $data;

 }
 function updateConfig($name) {
    $pluginid = $this->osDB->getOne("SELECT id FROM ! WHERE name = ?", array(PLUGIN_TABLE,$name));

    include(PLUGIN_DIR . $name . '/includes/default_config.php');

    if ( isset($config) && is_array($config) ) {

        foreach ( $config AS $name => $value ) {

            $row = $this->osDB->getRow("SELECT * FROM ! WHERE pluginid = ? AND name = ?", array(PLUGIN_CONFIG_TABLE, $pluginid, $name));

            $data['name']      = $name;
            $data['pluginid']  = $pluginid;
            // if it's an update from the form, use that value.  Otherwise use default
            if ( isset($_REQUEST['config_' . str_replace(' ','_',$name)]) ) {
              $data['value']     = $_REQUEST['config_' . str_replace(' ','_',$name)];

            } else {

              $data['value']     = $value;
            }
            // If in database update it, otherwise insert it
            if ( $row ) {

                $this->osDB->query('update ! set value=? where pluginid=? and name=?',array(PLUGIN_CONFIG_TABLE, $data['value'],$pluginid,$name) );
            }
            else {

                $this->osDB->query('insert into ! (pluginid, name, value) values(?,?,?)',array(PLUGIN_CONFIG_TABLE, $pluginid, $name, $data['value']) );
            }
        }
     }
	 unset($config);
 }
 function getPluginConfig($pluginid) {

    $data = array();

    $name = $this->osDB->getOne("SELECT name FROM ! WHERE id = ?", array(PLUGIN_TABLE,$pluginid));

    include(PLUGIN_DIR . $name . '/includes/default_config.php');

    $ctr = 0;

    if (isset($config) && count($config)>0) {
		foreach ( $config AS $name => $value ) {

			$row = $this->osDB->getRow("SELECT * FROM ! WHERE pluginid = ? AND name = ?", array(PLUGIN_CONFIG_TABLE, $pluginid, $name));

			// If in database use that value, otherwise use the default
			if ( $row ) {

			  $data[$ctr]['display']  = ucfirst($row['name']);
			  $data[$ctr]['name']  = $row['name'];
			  $data[$ctr]['value'] = $row['value'];
			}
			else {

			  $data[$ctr]['display']  = ucfirst($name);
			  $data[$ctr]['name']  = $name;
			  $data[$ctr]['value'] = $value;
			}
			$ctr++;
		}
	}
 	unset($config);
	 return $data;

 }
  function setErrorMessage($message) {

    $this->errorMessage = $message;
  }
  function getErrorMessage() {

    return $this->errorMessage;
  }


}

?>