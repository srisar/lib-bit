<?php

class Database
{

    private static $config = [
        "host" => null,
        "dbname" => null,
        "user" => null,
        "pass" => null,
        "options" => []
    ];

    /** @var PDO $pdo */
    private static $pdo;


    /**
     * Initialize database config and PDO connection
     * @param $config
     */
    public static function init($config)
    {
        self::$config = $config;

        try {

            $dsn = sprintf("mysql:host=%s;dbname=%s", self::$config['host'], self::$config['dbname']);

            /** @var PDO $pdo */
            self::$pdo = new PDO($dsn, self::$config['user'], self::$config['pass'], self::$config['options']);

        } catch (PDOException $exception) {
            die($exception->getMessage());
        }


    }


    /**
     * Returns the connected PDO instance
     * @return PDO
     */
    public static function getInstance()
    {
        if (empty(self::$pdo)) {
            self::init(self::$config);
            return self::$pdo;
        }
        return self::$pdo;
    }

    /**
     * Returns the last inserted id of the row
     * @return string
     */
    public static function getLastInsertedId()
    {
        return self::$pdo->lastInsertId();
    }

    /**
     * Close the database connection
     */
    public static function close()
    {
        self::$pdo = null;
    }


}