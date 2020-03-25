<?php

class DB {

    /**
     * @var PDO
     */
    protected static $conn;

    /**
     * @param $sql
     * @return bool|\PDOStatement
     *
     */
    public static function prepare($sql)
    {
        static::setConnection();
        return static::$conn->prepare($sql);
    }

    /**
     * @param $sql
     * @return false|\PDOStatement
     */
    public static function query($sql)
    {
        static::setConnection();
        return static::$conn->query($sql);
    }

    /**
     * @param $sql
     * @return false|\PDOStatement
     */
    public static function exec($sql)
    {
        static::setConnection();
        return static::$conn->exec($sql);
    }


    public static function setConnection()
    {
        if (empty(static::$conn)) {
            $options = include 'config/db_connection.php';
            static::$conn = new PDO($options['dsn'], $options['user'], $options['pass']);
            static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            static::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            static::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    }
    
}
