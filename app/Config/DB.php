<?php

namespace App\Config;

use PDO;
use PDOException;

class DB {
	public static $db;
	public static $con;

	function connect(){
		$dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME;

		try {
		    if (DB_DRIVER != 'odbc')
                $con = new PDO($dsn, DB_USER, DB_PASS);
            else
    		    $con = new PDO("odbc:" . DB_NAME);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->query("SET CLIENT_ENCODING TO '" . DB_CHARSET . "'");
			$con->beginTransaction();
			//$con->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);

			return $con;
		} catch (PDOException $e) {
			echo 'Falló la conexión: ' . $e->getMessage();
		}
	}

    public static function getCon(){
        if(self::$con == null && self::$db == null){
            self::$db = new DB();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }

    public static function startTransaction(){
        if(self::$con == null && self::$db == null){
            self::$db = new DB();
            self::$con = self::$db->connect();
        }
        self::$con->commit();
        self::$con->beginTransaction();
    }

    public static function commit(){
        if(self::$con != null && self::$db != null && self::$con->inTransaction()){
            self::$con->commit();
        }
    }

    public static function rollback(){
        if(self::$con != null && self::$db != null && self::$con->inTransaction()){
            self::$con->rollback();
        }
    }
}