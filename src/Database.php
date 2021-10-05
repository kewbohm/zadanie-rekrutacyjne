<?php

namespace Smartbees;

class Database
{
	private $dbHost = DB_HOST;
	private $dbName = DB_NAME;
	private $dbUser = DB_USER;
	private $dbPassword = DB_PASS; 
    private $dbConnection;

    public function __construct()
    {
        try {
            $this->dbConnection = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS,
            [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\'']);
        } catch (PDOException $e) {
            exit('Błąd połączenia z bazą danych: ' . $e->getMessage());

        }
    }

    public function getLastInsertId()
    {
        return $this->dbConnection->lastInsertId();
    }

    public function getConnection() 
    {
        return $this->dbConnection;
    }

    public function closeConnection() 
    {
        $this->dbConnection = null;
    }

}