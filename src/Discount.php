<?php

namespace Smartbees;

class Discount
{
    private $dbConnection;

    public function __construct($dbConn) {
        $this->dbConnection = $dbConn;
    }

    public function getActiveDiscountCodes() {
        $sql = 'SELECT * FROM discount_codes WHERE status = :status';
        $status = 'active';

        $statement = $this->dbConnection->prepare($sql);
        $statement->bindParam(':status', $status);
        $statement->execute();
        
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}