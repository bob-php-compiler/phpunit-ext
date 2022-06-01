<?php

abstract class PHPUnit_DbUnit_TestCase extends PHPUnit_Extensions_Database_TestCase
{
    protected static $connection;
    protected static $pdo;

    public function getConnection()
    {
        if (self::$connection == null) {
            $config = $this->getPDOConfig();
            self::$pdo = new PDO($config['dsn'], $config['username'], $config['passwd']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $this->createDefaultDBConnection(self::$pdo, $config['dbname']);
        }
        return self::$connection;
    }

    /**
     * return array(
     *     'dsn'      => '',
     *     'username' => '',
     *     'passwd'   => '',
     *     'dbname'   => ''
     * );
     */
    protected function getPDOConfig()
    {
        throw new Exception('you should override this method in a subclass');
    }
}
