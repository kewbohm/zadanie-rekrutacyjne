<?php

namespace Smartbees;

class User
{
    private $dbConnection;

    public function __construct($dbConn) {
        $this->dbConnection = $dbConn;
    }

    public function createUserAccount($data) {
        $sql = 'INSERT INTO users (username, password, first_name, last_name, address, city, post_code, country, phone_number, newsletter) VALUES (:username, :password, :first_name, :last_name, :address, :city, :post_code, :country, :phone_number, :newsletter)';

        $statement = $this->dbConnection->prepare($sql);

        $statement->bindParam(':username', $data['username']);
        $statement->bindParam(':password', $data['password']);
        $statement->bindParam(':first_name', $data['firstName']);
        $statement->bindParam(':last_name', $data['lastName']);
        $statement->bindParam(':address', $data['address']);
        $statement->bindParam(':city', $data['city']);
        $statement->bindParam(':post_code', $data['postCode']);
        $statement->bindParam(':country', $data['country']);
        $statement->bindParam(':phone_number', $data['phoneNumber']);
        $statement->bindParam(':newsletter', $data['newsletter']);

        if ($statement->execute()) {
            return true;
        }
    }

    public function getUsers() {
        $sql = 'SELECT * FROM users';
        
        $statement = $this->dbConnection->query($sql);

        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $users; 
    }
}