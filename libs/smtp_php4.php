<?php
/*
	This is adapted for osDate.
	Desveloped by Vijay Nair by taking examples from various Public Sources


*/

define('SMTP_NOT_CONNECTED', 1, true);
define('SMTP_CONNECTED', 2, true);

/* smtp class  */
class smtp {
    var $authenticated;
    var $connection;
    var $recipients;
    var $headers;
    var $timeout;
    var $errors;
    var  $status;
    var $body;
    var $from;
    var $host;
    var $port;
    var $helo;
    var $auth;
    var $user;
    var $pass;

    function smtp($params = array()) {

        if(!defined('CRLF')) {
            define('CRLF', "\r\n", TRUE);
		}
        $this->authenticated = FALSE;
        $this->timeout       = 5;
        $this->status        = SMTP_NOT_CONNECTED;
        $this->host          = 'localhost';
        $this->port          = 25;
        $this->helo          = 'localhost';
        $this->auth          = FALSE;
        $this->user          = '';
        $this->pass          = '';
        $this->errors        = array();

        foreach($params as $key => $value){
            $this->$key = $value;
        }
    }

    function connect($params = array())
    {
		$errno = $errstr = '';

        if (!isset($this->status)) {
            $obj = new smtp($params);
            if($obj->connect()){
                $obj->status = SMTP_CONNECTED;
            }

            return $obj;

        } else {
            $this->connection = fsockopen($this->host, $this->port);
            if (function_exists('socket_set_timeout')) {
                @socket_set_timeout($this->connection, 5, 0);
            }

            $greeting = $this->get_data();
            if (is_resource($this->connection)) {
				$r = $this->auth ? $this->ehlo() : $this->helo();
				return $r;
            } else {
                $this->errors[] = 'Failed to connect to server: '.$errstr;
                return FALSE;
            }
        }
    }

    function send($params = array()){
        foreach ($params as $key => $value) {
            $this->set($key, $value);
        }

        if ($this->is_connected()) {
            if ($this->auth && !$this->authenticated) {
                if(!$this->auth())
                    return false;
            }

            $this->mail($this->from);

            if (is_array($this->recipients)) {
                foreach ($this->recipients as $value) {
                    $this->rcpt($value);
                }
            } else {
                $this->rcpt($this->recipients);
            }

            if (!$this->data()) {
                return false;
            }

            $headers = str_replace(CRLF.'.', CRLF.'..', trim(implode(CRLF, $this->headers)));
            $body    = str_replace(CRLF.'.', CRLF.'..', $this->body);
            $body    = substr($body, 0, 1) == '.' ? '.'.$body : $body;

            $this->send_data($headers);
            $this->send_data('');
            $this->send_data($body);
            $this->send_data('.');

            $result = (substr(trim($this->get_data()), 0, 3) === '250');
            return $result;
        } else {
            $this->errors[] = 'Not connected!';
            return FALSE;
        }
    }

    function helo()
    {

        if(is_resource($this->connection)
                && $this->send_data('HELO '.$this->helo)
                && substr(trim($error = $this->get_data()), 0, 3) === '250' ){

            return true;

        } else {
            $this->errors[] = 'HELO command failed, output: ' . trim(substr(trim($error),3));
            return false;
        }
    }

    /**
    * Function to implement EHLO cmd
    */
    function ehlo()
    {
        if (is_resource($this->connection)
                && $this->send_data('EHLO '.$this->helo)
                && substr(trim($error = $this->get_data()), 0, 3) === '250' ){

            return true;

        } else {
            $this->errors[] = 'EHLO command failed, output: ' . trim(substr(trim($error),3));
            return false;
        }
    }

    /**
    * Function to implement RSET cmd
    */
    function rset()
    {
        if (is_resource($this->connection)
                && $this->send_data('RSET')
                && substr(trim($error = $this->get_data()), 0, 3) === '250' ){

            return true;

        } else {
            $this->errors[] = 'RSET command failed, output: ' . trim(substr(trim($error),3));
            return false;
        }
    }

    /**
    * Function to implement QUIT cmd
    */
    function quit()
    {
        if(is_resource($this->connection)
                && $this->send_data('QUIT')
                && substr(trim($error = $this->get_data()), 0, 3) === '221' ){

            fclose($this->connection);
            $this->status = SMTP_NOT_CONNECTED;
            return true;

        } else {
            $this->errors[] = 'QUIT command failed, output: ' . trim(substr(trim($error),3));
            return false;
        }
    }

    /**
    * Function to implement AUTH cmd
    */
    function auth()
    {
        if (is_resource($this->connection)
                && $this->send_data('AUTH LOGIN')
                && substr(trim($error = $this->get_data()), 0, 3) === '334'
                && $this->send_data(base64_encode($this->user))			// Send username
                && substr(trim($error = $this->get_data()),0,3) === '334'
                && $this->send_data(base64_encode($this->pass))			// Send password
                && substr(trim($error = $this->get_data()),0,3) === '235' ){

            $this->authenticated = true;
            return true;

        } else {
            $this->errors[] = 'AUTH command failed: ' . trim(substr(trim($error),3));
            return false;
        }
    }

    /**
    * Function that handles the MAIL FROM: cmd
    */
    function mail($from)
    {
        if ($this->is_connected()
            && $this->send_data('MAIL FROM:<'.$from.'>')
            && substr(trim($this->get_data()), 0, 2) === '250' ) {

            return true;

        } else {
            return false;
        }
    }

    /**
    * Function that handles the RCPT TO: cmd
    */
    function rcpt($to)
    {
        if($this->is_connected()
            && $this->send_data('RCPT TO:<'.$to.'>')
            && substr(trim($error = $this->get_data()), 0, 2) === '25' ){

            return true;

        } else {
            $this->errors[] = trim(substr(trim($error), 3));
            return false;
        }
    }

    /**
    * Function that sends the DATA cmd
    */
    function data()
    {
        if($this->is_connected()
            && $this->send_data('DATA')
            && substr(trim($error = $this->get_data()), 0, 3) === '354' ) {

            return true;

        } else {
            $this->errors[] = trim(substr(trim($error), 3));
            return false;
        }
    }

    /**
    * Function to determine if this object
    * is connected to the server or not.
    */
    function is_connected()
    {
        return (is_resource($this->connection) && ($this->status === SMTP_CONNECTED));
    }

    /**
    * Function to send a bit of data
    */
    function send_data($data)
    {
        if(is_resource($this->connection)){
            return fwrite($this->connection, $data.CRLF, strlen($data)+2);

        } else {
            return false;
        }
    }

    /**
    * Function to get data.
    */
    function get_data()
    {
        $return = '';
        $line   = '';
        $loops  = 0;

        if(is_resource($this->connection)){
            while((strpos($return, CRLF) === FALSE OR substr($line,3,1) !== ' ') && $loops < 100){
                $line    = fgets($this->connection, 512);
                $return .= $line;
                $loops++;
            }
            return $return;

        }else
            return false;
    }

    /**
    * Sets a variable
    */
    function set($var, $value)
    {
        $this->$var = $value;
        return true;
    }

    /**
    * Function to return the errors array
    */
    function getErrors()
    {
        return $this->errors;
    }


}
?>