<?php
/*
 * This is an extension to DB class given in DB.php
 * What we are doing is to have a cache mechanism built in
 *
 * This is the plan
 * Define the DB object in init.php without connecting to DB
 * This will give access to the DB class layer functions.
 * Let the process go through all evaluations and replacements
 * in the query and in the final stage, i.e. in simpleQuery, we check for cache
 * and if available return the cache result. Otherwise, process the query, save
 * in cache and return the result.
 *
 * This cache saving mechanism is done only in SELECT Queries
 *
 * For other queries, the involved tables are evaluated and if any table is
 * used in any cached query, that cached entry is removed, so that data can be
 * uptodate.
 *
 * To check tables update time, we are keeping a flat file with table names and
 * last update time. IF the time of the hash is earlier to this for the tables
 * involved in the hashed query, that hash is invalidated and fresh query is
 * provessed.
 *
 * THe default directory for this is DOC_ROOT/cache/ which should be writable.
 *
 * Vijay Nair
 *
 */
require_once PEAR_DIR . 'DB.php';

class cachedDB
{

	/* This is just a copy of conect function from DB.
	 * However, keeping a copy of the connect object in the class also
	 * for internal activities
	 */
    // {{{ &connect()

    /**
     * Create a new DB object.
     *
     * Example 1.
     * <code> <?php
     * require_once 'DB.php';
     *
     * $dsn = 'mysql://user:password@host/database'
     * $options = array(
     *     'debug'       => 2,
     *     'portability' => DB_PORTABILITY_ALL,
     * );
     *
     * $dbh =& DB::connect($dsn, $options);
     * if (DB::isError($dbh)) {
     *     die($dbh->getMessage());
     * }
     * ?></code>
     *
     * @param mixed $dsn      string "data source name" or an array in the
     *                        format returned by DB::parseDSN()
     *
     * @param array $options  an associative array of option names and
     *                        their values
     *
     * @return object  a newly created DB connection object, or a DB
     *                 error object on error
     *
     * @see DB::parseDSN(), DB_common::setOption(), DB::isError()
     * @access public
     */
    function &connect($dsn, $options = array())
    {

        $dsninfo = DB::parseDSN($dsn);
        $type = $dsninfo['phptype'];
		@$obj = DB::factory($type, $options);
		$obj->_dsninfo = $dsninfo;
		$obj->_dboptions = $options;

        return $obj;

    }

    // }}}

}

?>
