<?php

namespace Smartbees;

class Order
{
    private $dbConnection;

    public function __construct($dbConn) {
        $this->dbConnection = $dbConn;
    }

    public function addOrder($orderData) {
        $sql = 'INSERT INTO orders (payment_method, delivery_method, shipping, price, discount, total_price, first_name, last_name, address, city, post_code, country, phone_number,comment, date, user_id) VALUES (:payment_method, :delivery_method, :shipping, :price, :discount, :total_price, :first_name, :last_name, :address, :city, :post_code, :country, :phone_number, :comment, NOW(), :user_id)';

        $statement = $this->dbConnection->prepare($sql);

        $statement->bindParam(':payment_method', $orderData['paymentMethod']);
        $statement->bindParam(':delivery_method', $orderData['deliveryMethod']);
        $statement->bindParam(':shipping', $orderData['shipping']);
        $statement->bindParam(':price', $orderData['price']);
        $statement->bindParam(':discount', $orderData['discount']);
        $statement->bindParam(':total_price', $orderData['totalPrice']);
        $statement->bindParam(':first_name', $orderData['firstName']);
        $statement->bindParam(':last_name', $orderData['lastName']);
        $statement->bindParam(':address', $orderData['address']);
        $statement->bindParam(':city', $orderData['city']);
        $statement->bindParam(':post_code', $orderData['postCode']);
        $statement->bindParam(':country', $orderData['country']);
        $statement->bindParam(':phone_number', $orderData['phoneNumber']);
        $statement->bindParam(':comment', $orderData['comment']);
        $statement->bindParam(':user_id', $orderData['userId']);
        
        if ($statement->execute()) {
            return true;
        }
    }
}