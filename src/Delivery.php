<?php

namespace Smartbees;

class Delivery
{
    public function testInputData($inputData)
    {
        $inputData = trim($inputData);
        $inputData = stripslashes($inputData);
        $inputData = htmlspecialchars($inputData);
        return $inputData;
    }

    public function validateDeliveryInfo($postData)
    {
        $deliveryData = [];

        $deliveryData['firstName'] = $this->testInputData($postData['firstName']);
        $deliveryData['lastName'] = $this->testInputData($postData['lastName']);
        $deliveryData['country'] = $this->testInputData($postData['country']);
        $deliveryData['address'] = $this->testInputData($postData['address']);
        $deliveryData['postCode'] = $this->testInputData($postData['postCode']);
        $deliveryData['city'] = $this->testInputData($postData['city']);
        $deliveryData['phoneNumber'] = $this->testInputData($postData['phoneNumber']);  

        $onlyLettersRegex = "/^\p{L}+$/ui";
        $properNamesRegex = "/^[-\p{L}0-9 ,\/.]*$/ui";

        $formValidStatus = true;

        if (empty($deliveryData['firstName'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyLettersRegex, $deliveryData['firstName'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['lastName'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyLettersRegex, $deliveryData['lastName'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['country'])) {
            $formValidStatus = false;
        } elseif (!preg_match($properNamesRegex, $deliveryData['country'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['address'])) {
            $formValidStatus = false;
        } elseif (!preg_match($properNamesRegex, $deliveryData['address'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['postCode'])) {
            $formValidStatus = false;
        } elseif (!preg_match('/^[-0-9]*$/', $deliveryData['postCode'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['city'])) {
            $formValidStatus = false;
        } elseif (!preg_match($onlyLettersRegex, $deliveryData['city'])) {
            $formValidStatus = false;
        }

        if (empty($deliveryData['phoneNumber'])) {
            $formValidStatus = false;
        } elseif (!preg_match('/^[+0-9 ]*$/', $deliveryData['phoneNumber'])) {
            $formValidStatus = false;
        }

        if ($formValidStatus) {
            return $deliveryData;
        }

    }
}