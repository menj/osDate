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


/**
 * Class for caching files that are stored in DB
 */
class Cacher
{
    // Path where cached files are stored
    var $_docpath;
    var $_fullpath;
    var $_site;

    var $_db;
    
    // specifics about the image source
    var $_table;
    var $_field;
    var $_id;
    var $_skin;	// id of skin

    // Error during execution
    var $_error;

    function Cacher( $fullpath = '', $docpath = '', $site = '' ) {

    	// path relative to document root
        $this->_docpath = $docpath;

        // fully unqualified path on server
        $this->_fullpath = $fullpath;

        $this->_error = array('');

		// the current website key
        $this->_site = $site;
    }

	/**
	 * Retrieve either the path to the cached image, either as a fully unqualified path
	 * or relative to the document root
	 */
    function path( $type = 'full', $ext = '.jpg' ) {

    	if ( $type == 'full' )
			$path = $this->_fullpath;
    	else if ( $type == 'doc' )
    		$path = $this->_docpath;
    		
    	$skinSiteKey = $this->_db->getOne( 'select site_key from '.$this->_table." where id='{$this->_id}'" );

    	return $path . '/' . $skinSiteKey . '_' . $this->_table . '_' . $this->_field . '_' . $this->_id . '_' . $this->_skin . $ext;
    }

	/**
	 * Write the data to the cache
	 */
    function cache( $data ) {

    	if ( $data )
   			return fwrite( fopen( $this->path( 'full' ), 'wb' ), $data );

    	return false;
    }
    
    /**
     * Remove the specified image from the cache
     */
    function remove( $ext = '.jpg' ) {

		$file = $this->path( 'full' );

		if ( file_exists( $file ) )
			@unlink( $file );
    }

    /**
     * Clear all files from the cache directory. If $prefix is specified, then only
     * the cached files that begin with $prefix are removed. If $suffix is specified,
     * then only the cached files that end with $suffix are removed (good for
     * removing images associated with a particular skin.
     */
	function clear( $prefix = '', $suffix = '' ) {

		$dir = $this->_fullpath;

		if ( !$dir )
			$dir = 'temp';

		$fd = @opendir($dir);
		$file_array = array();

		while ( ( $part = @readdir($fd)) == true ) {
			if ( $part != "." && $part != ".." ) {

				// if the file prefix and suffix is specified, then the
				// file name must match both prefix & suffix to be removed

				if ( $prefix != '' ) {

					//echo substr( $part, 0, strlen( $prefix ) ) . ' =? ' . $prefix . "\n";

					if ( substr( $part, 0, strlen( $prefix ) ) != $prefix ) {
						continue;
					}
				}

				if ( $suffix != '' ) {

					//echo substr( $part, strlen( $part ) - strlen( $suffix ) ) . ' =? ' . $suffix . "\n";

					if ( substr( $part, strlen( $part ) - strlen( $suffix ) ) != $suffix ) {
						continue;
					}
				}

				$file_array[] = $part;
			}
		}

		if ( $fd == true )
			@closedir($fd);

		foreach( $file_array as $curfile ) {

			if ( file_exists( $dir . '/' . $curfile ) )
				@unlink( $dir . '/' . $curfile );
		}
	}


    function _dieError( $message ) {
        $this->_error = $message;
        return 0;
    }

	/**
	 * Determine if the image in question is cached or not
	 */
    function cached() {
    	return file_exists( $this->path( 'full' ) );
    }
}

?>