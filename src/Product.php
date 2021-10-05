<?php

namespace Smartbees;

class Product
{
    private $dbConnection;
    private $id;
    private $title;
    private $price;
    private $quantity;

    public function __construct($dbConn, $id) {
        $this->dbConnection = $dbConn;

        $sql = 'SELECT * FROM products WHERE id = :id';

        $statement = $this->dbConnection->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        $this->id = $id;
        $this->title = $result['title'];
        $this->price = $result['price'];
        $this->quantity = $result['quantity'];   
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }
}