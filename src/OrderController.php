<?php

namespace Smartbees;

class OrderController extends Delivery
{
    private $orderModel;

    public function __construct($model) {
        $this->orderModel = $model;
    }

    public function validateOrderInfo($postData)
    {
        $orderData = [];

        $orderData['paymentMethod'] = $this->testInputData($postData['paymentMethodRadio']);
        switch ($this->testInputData($postData['deliveryMethodRadio'])) {
            case 10.99:
                $orderData['deliveryMethod'] = 'paczkomat';
                break;
            case 18.00:
                $orderData['deliveryMethod'] = 'kurier DPD';
                break;
            case 22.00:
                $orderData['deliveryMethod'] = 'kurier DPD pobranie';
                break;
            default:
                0;
        }
        $orderData['shipping'] = floatval($this->testInputData($postData['deliveryMethodRadio']));
        $orderData['price'] = floatval($this->testInputData($postData['cartTotalSum']));

        $orderData['discount'] = floatval($this->testInputData($postData['discount']));

        $orderData['totalPrice'] = $orderData['shipping'] + $orderData['price'] - $orderData['discount'];
        $orderData['comment'] = $this->testInputData($postData['comment']);

        if (isset($postData['userId'])) {
            $orderData['userId'] = $postData['userId'];
        } else {
            $orderData['userId'] = NULL;
        }

        $onlyLetters = '/^[\p{L} ]+$/u';
        $onlyFloat = '/^[0-9.]+$/';
        $formValidStatus = true;

        if (empty($orderData['paymentMethod'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyLetters, $orderData['paymentMethod'])) {
            $formValidStatus = false;
        }

        if (empty($orderData['deliveryMethod'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyLetters, $orderData['deliveryMethod'])) {
            $formValidStatus = false;
        }

        if (empty($orderData['shipping'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyFloat, $orderData['shipping'])) {
            $formValidStatus = false;
        }

        if (empty($orderData['price'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyFloat, $orderData['price'])) {
            $formValidStatus = false;
        }
        
        if (!preg_match($onlyFloat, $orderData['discount'])) {
            $formValidStatus = false;
        }

        if (empty($orderData['totalPrice'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyFloat, $orderData['totalPrice'])) {
            $formValidStatus = false;
        }

        if (!preg_match('/^[\p{L}0-9 .,?]*$/u', $orderData['comment'])) {
            $formValidStatus = false;
        }

        if ($formValidStatus) {
            return $orderData;
        }
    }

    public function addOrder($postData) 
    {
        $orderData = array_merge($this->validateOrderInfo($postData), $this->validateDeliveryInfo($postData));

        if ($this->orderModel->addOrder($orderData)) {
            return true;
        }
    }
}