<?php

abstract class PHPUnit_DbUnit_Mysql_TestCase extends PHPUnit_DbUnit_TestCase
{
    protected $mysqlHost     = '127.0.0.1';
    protected $mysqlPort     = 3307;
    protected $mysqlDbname   = 'test';
    protected $mysqlCharset  = 'utf8';
    protected $mysqlUsername = 'root';
    protected $mysqlPasswd   = '123456';

    protected function getPDOConfig()
    {
        return array(
            'dsn'      => sprintf(
                            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                            $this->mysqlHost,
                            $this->mysqlPort,
                            $this->mysqlDbname,
                            $this->mysqlCharset
                          ),
            'username' => $this->mysqlUsername,
            'passwd'   => $this->mysqlPasswd,
            'dbname'   => $this->mysqlDbname
        );
    }
}
