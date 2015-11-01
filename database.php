<?php
class Database
{
	private static $dbName = 'CastelaniNewsletter' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'castelani';
	private static $dbUserPassword = 'x5x8k2';

	private static $connection  = null;

	public function __construct() {
		exit('Init function is not allowed');
	}

	public static function connect()
	{
	     // One connection through whole application
       if ( null == self::$connection )
       {
        try
        {
          self::$connection =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$connection;
	}

	public static function disconnect()
	{
		self::$connection = null;
	}
}
?>