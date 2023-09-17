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

/* 	This class is the wrapper class of osDate for accessing Database using the choice
	of the DB Access class. Now, this will support PEAR::DB and ADODB. THe selection of
	class is defined in /myconfigs/config.php (DEFINE ('DB_CLASS', 'PEAR_DB' or 'ADODB');)
	We will add MDB2 and other DB classes later.

	Vijay Nair
*/

/* 	Include the class file as per selection given in config.php */


class osDateDB {

	var $osDB = ''; // This is the connection to DB

	var $newParams = '';

	var $config = '';

	var $configs = '';

	var $cacheMe = '';

	function osDateDB($dbtype='', $dbuser='', $dbpass='', $dbhost='', $dbname='', $forum='N') {
		if ($dbtype=='') {
			$dbtype=DB_TYPE;
			$dbuser = DB_USER;
			$dbpass=DB_PASS;
			$dbhost = DB_HOST;
			$dbname = DB_NAME;
			$dsn = DB_TYPE . '://' . DB_USER . ':' . DB_PASS . '@' . DB_HOST . '/' . DB_NAME;
		} else {
			$dsn = $dbtype . '://' . $dbuser . ':' . $dbpass . '@' . $dbhost . '/' . $dbname;
		}
		/* Instantiate with new connection */
		if(!function_exists('errhndl')) {
			function errhndl ( $err ) {
			echo '<pre>' . $err->message;
				print_r( $err );

				return ('Database error occured. Check the query and/or DB connection');
			}
		}

		if (DB_CLASS == 'PEAR_DB') {
			require_once PEAR_DIR . 'DB.php';
			$osDB_options = array('persistent' => TRUE );
			$this->osDB = @DB::connect( $dsn, $osDB_options );
			PEAR::setErrorHandling( PEAR_ERROR_CALLBACK, 'errhndl' );
			if (PEAR::isError($this->osDB)) {
				die($osDB->getMessage());
			}
			$this->osDB->setFetchMode( DB_FETCHMODE_ASSOC );

		} elseif (DB_CLASS == 'ADODB') {
			require_once ADODB_DIR.'adodb.inc.php';
			if (DB_TYPE == 'mysql') {
				$dsn = $dsn.'?persist';
			}
			$this->osDB = NewADOConnection( $dbtype );
			$this->osDB->PConnect($dbhost, $dbuser, $dbpass, $dbname);
			$this->osDB->SetFetchMode( ADODB_FETCH_ASSOC );
		}
		$this->query("SET NAMES 'UTF8'");
		if ($forum == 'N')  {
			/* Now get configuration data */
			$this->configs = $this->getAll( 'SELECT * from !',array( CONFIG_TABLE ) );
			$this->config = array();

			foreach( $this->configs as $index => $row ) {

				$row['config_value'] = str_replace('#CRYEAR#',date('Y'),$row['config_value']);

				$this->config[ $row['config_variable'] ] = $row['config_value'];
				if ($row['config_variable'] == 'watermark_snaps' || ($row['config_variable'] == 'watermark_image') && $row['config_value'] != '' ) {
					$this->config['watermark_time'] = $row['update_time'];
				}
			}

			if ($this->config['disable_cache'] == 'N' || $this->config['disable_cache'] == '0') {
				$this->cacheMe = 'Y';
			}

			/* Now set mysql caching if caching is enabled */
			if (DB_TYPE == 'mysql' && $dbuser == 'root') {
				/* enable mysql query cache */
					$this->query('set global query_cache_size = 16779216'); //16MB
					$this->query('set global query_cache_type = 1');
			}

			$GLOBALS['config'] =& $this->config;
		}
	}

	function disconnect() {
		if (DB_CLASS == 'PEAR_DB') {
			$this->osDB->disconnect();
		} elseif (DB_CLASS == 'ADODB') {
			$this->osDB->Disconnect();
		}
	}

	function getOne($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->getOne($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->GetOne($this->modifyQuery($sql, $params),$this->newParams);
		}
	}

	function getRow($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->getRow($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->GetRow($this->modifyQuery($sql, $params), $this->newParams);
		}
	}

	function query($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->query($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->Query($this->modifyQuery($sql, $params), $this->newParams);
		}
	}

	function getCol($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->getCol($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->GetCol($this->modifyQuery($sql, $params), $this->newParams);
		}
	}

	function getAll($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->getAll($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
 	      if($params === null)
 	       {
 	           return $this->osDB->GetAll($sql,$params);
 	       }
 	       else
 	       {

				return  $this->osDB->GetAll($this->modifyQuery($sql, $params), $this->newParams);
			}
		}
	}

	function getAssoc($sql, $params=array()) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->getAssoc($sql, $params);
		} elseif (DB_CLASS == 'ADODB') {
			return  $this->osDB->GetAssoc($this->modifyQuery($sql, $params), $this->newParams);
		}
	}

	function autoExecute($table, $data, $method, $search=false) {
		if (DB_CLASS == 'PEAR_DB') {
			if ($method == 'INSERT') {
				$method='1';
			} else {$method='2';}
			return $this->osDB->autoExecute($table, $data, $method, $search);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->AutoExecute($table, $data, $method, $search);
		}
	}
	function affectedRows() {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->affectedRows();
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->Affected_rows();
		}
	}

	function numRows () {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->numRows();
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->NumRows();
		}
	}
	function numCols () {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->numCols();
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->NumCols();
		}
	}

	function fetchRow () {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->fetchRow();
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->FetchRow();
		}
	}

	function free() {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->free();
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->Free();
		}
	}

	function tableInfo ($table) {
		if (DB_CLASS == 'PEAR_DB') {
			return $this->osDB->tableInfo($table);
		} elseif (DB_CLASS == 'ADODB') {
			return $this->osDB->TableInfo($table);
		}
	}

	function modifyQuery($sql, $params=array()) {
		$tokens   = preg_split('/((?<!\\\)[&?!])/', $sql, -1,
							   PREG_SPLIT_DELIM_CAPTURE);
		$newSql='';
		$x=0;
		$this->newParams=array();
		foreach ($tokens as $val) {
			if ($val == '?') {
				$newSql .= '?';
				if (count($params)>0) {
					if (isset($params[$x]) ) $this->newParams[]=$params[$x];
					$x++;
				}
			} elseif ($val == '!') {
				if (count($params)>0) {
					if (isset($params[$x]) ) $newSql .= $params[$x];
					$x++;
				}
			} else {
				$newSql .= $val;
			}
		}
		return $newSql;
	}


    function isManip($query)
    {
		/* Check if the query is a DML one */
        $manips = 'INSERT|UPDATE|DELETE|LOAD DATA|'.'REPLACE|CREATE|DROP|'.
                  'ALTER|GRANT|REVOKE|'.'LOCK|UNLOCK';
        if (preg_match('/^\s*"?('.$manips.')\s+/i', $query)) {
            return true;
        }
        return false;
    }

	/* This function is an emulation of Query for Caching mechanism  --  Vijay Nair */
	function ADODB_cacheQuery($sql, $inputarr=false)
	{
		$rs = $this->osDB->CacheExecute($sql, $inputarr);
		if (!$rs && defined('ADODB_PEAR')) return $this->osDB->ADODB_PEAR_Error();
		return $rs;
	}

}

?>