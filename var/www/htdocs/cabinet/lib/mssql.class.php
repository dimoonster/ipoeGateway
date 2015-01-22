<?php
require_once(dirname(__FILE__)."/../config.php");

class DBException extends Exception {};
class DBFatalException extends Exception {};

class db {
    protected $dbh, $q_count;

    function __construct() {
	global $db;
        $this->dbh = mssql_connect($db["host"], $db["user"], $db["pass"]);
	if(!$this->dbh) {
            throw new DBFatalException(mssql_error());
        };

        mssql_select_db($db["name"], $this->dbh);
        $this->q_count=0;
    }

    function close() {
	@mssql_close($this->dbh);
    }

    function query($sql) {
        $this->q_count++;
        $result = mssql_query($sql, $this->dbh);
        if(!$result) throw new DBException(mssql_error());

        return $result;
    }

    function num_rows($sth) {
        return mssql_num_rows($sth);
    }
    
    function affected_rows() {
	return mssql_rows_affected($this->dbh);
    }

    function fetch_array($sth) {
        return mssql_fetch_array($sth);
    }

    function get_query_count() {
        return $this->q_count;
    }
}
?>
