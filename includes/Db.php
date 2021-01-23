<?php


class Db
{
    private static $hostname = "localhost";
    private static $username = "root";
    private static $passwort = "";
    private static $dbname = "gummibaerbank";
    private static $conn = null;

    public static function connect()
    {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$hostname . ";" . "dbname=" . self::$dbname . ';charset=utf8mb4', self::$username, self::$passwort);
            } catch (PDOException $exc) {
                die($exc->getMessage());
            }
        }
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conn;
    }






/*
    public static function connect()
    {
        self::$hostname = "localhost";
        $this->username = "root";
        $this->passwort = "";
        $this->dbname = "gummibaerbank";

        try {
            $dsn = "mysql:host=".$this->hostname.";dbname=".$this->dbname;
            $pdo = new PDO($dsn, $this->username, $this->passwort);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e)
        {
            echo "Connection failed: ".$e->getMessage();
        }
    }
*/


}