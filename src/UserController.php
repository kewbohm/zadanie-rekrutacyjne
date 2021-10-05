<?php

namespace Smartbees;

class UserController extends Delivery
{
    private $userModel;

    public function __construct($model) {
        $this->userModel = $model;
    }

    public function validateUserInfo($postData)
    {
        $userData = [];

        $userData['username'] = $this->testInputData($postData['username']);
        $userData['password'] = $this->testInputData($postData['password']);
        $userData['confirmPassword'] = $this->testInputData($postData['confirmPassword']);
        if (isset($postData['newsletter'])) {
            $userData['newsletter'] = 1;
        } else {
            $userData['newsletter'] = 0;
        }

        $formValidStatus = true;

        if (empty($userData['username'])) {
            $formValidStatus = false;
        } elseif (!preg_match('/^[\p{L}0-9]+$/u', $userData['username'])) {
            $formValidStatus = false;
        }

        if (empty($userData['password'])) {
            $formValidStatus = false;
        } elseif (strlen($userData['password']) < 8) {
            $formValidStatus = false;
        } elseif (!preg_match('/^(?=.*\d).+$/', $userData['password'])) {
            $formValidStatus = false;
        }

        if (empty($userData['confirmPassword'])) {
            $formValidStatus = false;
        } else {
            if ($userData['password'] !== $userData['confirmPassword']) {
                $formValidStatus = false;
            }
        }

        if ($formValidStatus) {
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

            return $userData;
        }
    }

    public function createUserAccount($postData) 
    {
        $userData = array_merge($this->validateUserInfo($postData), $this->validateDeliveryInfo($postData));

        if ($this->userModel->createUserAccount($userData)) {
            return true;
        }
    }
}