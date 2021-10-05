<?php

namespace Smartbees;

class OrderItem
{
    private $dbConnection;

    public function __construct($dbConn) {
        $this->dbConnection = $dbConn;
    }

    public function addOrderItem($orderItemData) {
        $sql = 'INSERT INTO order_items (price, quantity, product_id, order_id) VALUES (:price, :quantity, :product_id, :order_id)';

        $statement = $this->dbConnection->prepare($sql);

        $statement->bindParam(':price', $orderItemData['price']);
        $statement->bindParam(':quantity', $orderItemData['quantity']);
        $statement->bindParam(':product_id', $orderItemData['productId']);
        $statement->bindParam(':order_id', $orderItemData['orderId']);
        
        if($statement->execute()) {
            return true;
        }
    }
}