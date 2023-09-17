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

/*
*    Database abstraction, static object db interface
*    (C) "Alternatyvus Valdymas", 2001
*    http://www.cav.lt, info@cav.lt
*/
// dzhibas, 2001.07.09 - class correction
// js, 2001.07.09
//!! core lib
//! database abstraction, static object db interface
class myDb {
    /// the server to connect to
    var $server;
    /// the database to use
    var $osDBname;
    /// the username to use
    var $user;
    /// the password to use
    var $password;
    var $on_error = 'report';
    // If true, data retrieved will be in a html friedly format
    var $queryresult;
    var $debug = FALSE;
    var $_eof = true;
    var $sql;

    /*!
    Constructs a new Db object,
    */
    function myDb() {

    }
    // Good mysql, pg
    //
    // 8-1-05
    /*
    function insert_query($mas, $table, $print = 0) {

         $this->queryresult = $GLOBALS['osDB']->autoExecute($table, $mas, DB_AUTOQUERY_INSERT);

 		if (DB_CLASS == 'PEAR_DB') {
			 if (PEAR::isError($this->queryresult)) {
            $this->error("<b>bad SQL query</b>: ".htmlentities($q) ."<br><b>".$this->queryresult->getMessage() ."</b>");
	         }
		}
        $this->last_table = $table;


        // Reset incase a select had it true
        $this->_eof = true;

      return $this->affected_rows();
    }
*/
   function insert_query($mas, $table, $print = 0) {
	/* This function is modified to suit plugin */
		$flds = '';
		$insert_arr=array();
		$insert_arr[]=$table;
		$sql = 'insert into ! (';
		$fld_arr=' values (';
		$cnt=0;
		foreach($mas as $mas_k => $mas_v) {
			if ($cnt > 0) {
				$sql.=', ';
				$fld_arr .=', ';
			}
			$sql .= $mas_k;
			$insert_arr[] = $mas_v;
			$fld_arr.='?';
			$cnt=1;
		}
		$sql .= ') '.$fld_arr.') ';

		 $this->queryresult = $GLOBALS['osDB']->query($sql,$insert_arr);

 		if (DB_CLASS == 'PEAR_DB') {
			 if (PEAR::isError($this->queryresult)) {
            $this->error("<b>bad SQL query</b>: ".htmlentities($q) ."<br><b>".$this->queryresult->getMessage() ."</b>");
	         }
		}
        $this->last_table = $table;


        // Reset incase a select had it true
        $this->_eof = true;

      return $this->affected_rows();
    }

    // Good mysql, pg
    //
    //  executes query, returns query result handle
    //
    function query($q, $print = 0) {

        if ($this->debug || $print == 1) {
            echo "<br><b>query: </b>".htmlentities($q) ."<br>\n";
        }

				$this->_query($q);

		// Save the result of the last query

        // If it wasn't a select, it is eof
        if (!preg_match("/SELECT/i", $q)) {
            $this->_eof = true;
        }
        // If there was a result and it was a select, it's not eof
        elseif ($this->affected_rows()) {
            $this->_eof = false;
        }
        // No result means eof
        else {
            $this->_eof = true;
        }
    }
    // Good mysql, pg
    //
    function _query($q) {
        $this->sql = $q;

        $this->queryresult  = $GLOBALS['osDB']->query($q,'');

  		if (DB_CLASS == 'PEAR_DB') {
        if (PEAR::isError($this->queryresult)) {
            $this->error("<b>bad SQL query</b>: ".htmlentities($q) ."<br><b>".$this->queryresult->getMessage() ."</b>");
         }
	 }
    }
    // Good mysql, pg
    //
    function _escape_string($in) {

            $out = mysql_real_escape_string($in);

        return $out;
    }
    // Good mysql, pg
    //
    function affected_rows() {

        $rows = $GLOBALS['osDB']->affectedRows();

        if (!$rows) {
            $this->_eof = true;
        }
        return $rows;
    }
    // Works mysql, pg
    //
    // 8-1-05
    function get_insert_id($field = "") {
        if ($this->affected_rows() >0) {
            $id = $this->_insert_id($field);
        } else {
            $id = $false;
        }
        return $id;
    }
    // Works mysql, pg
    //
    function _insert_id($field) {

        $id = $GLOBALS['osDB']->getOne("SELECT LAST_INSERT_ID()" );

        return $id;
    }
    // Works mysql, pg
    //
    //
    //  \param $mas assiociative array, keys - column names
    //
    function update_query($mas, $table, $id, $print = 0) {
        $this->last_table = $table;
        // Only do this if there are values in mas
        //
        if (count($mas)) {
            while (list($k, $v) = each($mas)) {
                $v = $this->_escape_string($v);
                $k = $this->field_name($k);
                $to[] = "$k = '$v'";
            }
            $sql = "UPDATE $table SET ".implode(',', $to) .$this->where_statement($id);
            $this->query($sql, $print);
            // Reset incase a select had it true
            $this->_eof = true;
        }
    }
    // Works mysql, pg
    //
    function where_statement($id) {
        while (list($idn, $idv) = each($id)) {
            $idv = $this->_escape_string($idv);
            $idn = $this->field_name($idn);
            if ($idn == 'album_id' and $idv == '0') {
				$where [] = ' album_id is null or album_id = 0 ';
			} else {
	            $where[] = "$idn = '$idv' ";
			}
        }
        if (isset($where) && count($where) > 0) {
	        return " WHERE ".implode(' AND ', $where);
		} else {
			return ' ';
		}
    }
    //
    //  \param $mas assiociative array, keys - column names
    //
    /*!
    Prints the error message.
    */
    function error($errmsg) {
        echo "<br><font color='#CC0066'><b>db</b>: ".$errmsg."</font><br>";
        if ('halt' == $this->on_error) {
            exit;
        }
    }
    // This does a quick query and returns one row
    //
    function getOne($sql, $print = 0) {
        return $GLOBALS['osDB']->getOne($sql);
    }
    function getRow($sql, $print = 0) {
        return $GLOBALS['osDB']->getRow($sql,'');
    }
    function getAllRows($sql, $print = 0) {

        return $GLOBALS['osDB']->getAll($sql,'');
    }
    function get_row($sql, $print = 0) {
        return $GLOBALS['osDB']->getRow($sql,'');
    }
    function get_row_array() {

        return $this->queryresult->fetchRow();
    }
    // js, 2001.07.10, array -> assoc
    // Works mysql, pg
    //
    function replace_query($mas, $table, $idfield = "", $print = false) {
        $this->last_table = $table;
        while (list($k, $v) = each($mas)) {
            $to[] = $this->field_name($k);
            $val[] = $this->_escape_string($v);
        }
        $sql = "REPLACE INTO $table  (".implode(',', $to) .") VALUES
	('".implode("','", $val) ."')";
        $this->query($sql, $print);
        // Reset incase a select had it true
        $this->_eof = true;
    }
    // Works mysql, pg
    //
    // 8-1-05
    function num_rows() {

       $rows = $this->queryresult->numRows();

       if (!$rows) {
            $this->_eof = true;
        }
        return $rows;
    }
    function num_cols() {

       $cols = $this->queryresult->numCols();

        return $cols;
    }
    function table_info($table) {

        return $GLOBALS['osDB']->tableInfo($table);
    }
    // Works mysql, pg
    //
    // Puts all database contents in a two dimensional array.
    //
    function get_result_array($sql = '') {
        $this->_eof = true;

        return $GLOBALS['osDB']->getAll($sql);
    }
    // Works mysql, pg
    // Removes the padded spaces that some databases add to the end of a line.
    //
    function rtrim_array($data) {
        while (list($k, $v) = each($data)) {
            $data[$k] = rtrim($data[$k]);
        }
        return $data;
    }
    // Good mysql, pg
    //
    //  is query result set empty ?
    //
    // 8-1-05
    function is_empty($sql = '', $print = 0) {
        if ($sql) {
            $this->query($sql, $print);
        }
        if (0 == $this->num_rows()) {
            $result = true;
        } else {
            $result = false;
        }
        $this->_eof = $result;
        return $result;
    }
    // Good mysql, pg
    //
    //  is query result set valid ?
    //
    function not_empty($sql = '', $print = 0) {
        if ($sql) {
            $this->query($sql, $print);
        }
        if ($this->num_rows()) {
            $result = true;
            $this->_eof = false;
        } else {
            $result = false;
            $this->_eof = true;
        }
        return $result;
    }
    // Works mysql, pg
    //
    //    returns two dimensional assoc array
    //    frees mysql result
    //
    function get_result($sql = '') {
        return $this->get_result_array($sql);
    }
    // Good mysql, pg
    //
    function free_result() {

         $this->queryresult->free();
    }
    // Good mysql, pg
    //
    function close() {

         $GLOBALS['osDB']->disconnect();
    }
    // Gets the name of all tables and returns in an array
    function eof() {
        return $this->_eof;
    }
    function field_name($string) {

      return "`" . preg_replace("/[^A-Za-z0-9_\-]/",'',$string) . "`";
   }
}
?>