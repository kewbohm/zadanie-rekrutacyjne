<?php

namespace Smartbees;

class OrderItemController
{
    private $orderItemModel;

    public function __construct($model) 
    {
        $this->orderItemModel = $model;
    }

    public function validateOrderItem($postData, $orderId)
    {
        $orderItemData = [];
        
        foreach($_POST['productIds'] as $index => $product_id) {
            $orderItemData['productId'] = $product_id;
            $orderItemData['quantity'] = $postData['productQuantities'][$index];
            $orderItemData['price'] = $orderItemData['quantity'] * $postData['productPrices'][$index];
            $orderItemData['orderId'] = $orderId;

            if($this->orderItemModel->addOrderItem($orderItemData)) {
                return true;
            }
        }

        
    } 
}