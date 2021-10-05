<?php
    require_once('require.php');

    use Smartbees\{
        Database,
        User,
        UserController,
        Order,
        OrderController,
        OrderItem,
        OrderItemController,
        Product,
        Cart,
        Delivery
    };

    $dbConnection = new Database();

    $product = new Product($dbConnection->getConnection(), 1);

    $cart = new Cart();
    $cartItem1 = $cart->addProduct($product, 1);

    $userModel = new User($dbConnection->getConnection());
    $userController = new UserController($userModel);

    $orderModel = new Order($dbConnection->getConnection());
    $orderController = new OrderController($orderModel);

    $orderItemModel = new OrderItem($dbConnection->getConnection());
    $orderItemController = new OrderItemController($orderItemModel);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $validOrderStatus = true;

        if (isset($_POST['createAccount'])) {
            if (!$userController->createUserAccount($_POST)) {
                $validOrderStatus = false;
            }

            $_POST['userId'] = $dbConnection->getLastInsertId();
        }
        
        if (isset($_POST['differentDeliveryAddress'])) {
            $_POST['firstName'] = $_POST['firstNameDifferentDeliveryAddress'];
            $_POST['lastName'] = $_POST['lastNameDifferentDeliveryAddress'];
            $_POST['country'] = $_POST['countryDifferentDeliveryAddress'];
            $_POST['address'] = $_POST['addressDifferentDeliveryAddress'];
            $_POST['city'] = $_POST['cityDifferentDeliveryAddress'];
            $_POST['postCode'] = $_POST['postCodeDifferentDeliveryAddress'];
            $_POST['country'] = $_POST['countryDifferentDeliveryAddress'];
            $_POST['phoneNumber'] = $_POST['phoneNumberDifferentDeliveryAddress'];
        }

        if (!$orderController->addOrder($_POST)) {
            $validOrderStatus = false;
        }
        
        $orderId = $dbConnection->getLastInsertId();

        if (!$orderItemController->validateOrderItem($_POST, $orderId)) {
            $validOrderStatus = false;
        }

        if ($validOrderStatus) {
            echo '<div class="alert alert-success text-center my-3"><p>Dziękujemy za złożenie zamówienia</p><p class="m-0">Numer Twojego zamówienia to: ' . $orderId . '</p></div>';

            return;
        } else {
            die(header("HTTP/1.0 404 Not Found"));
        }
        
    }

    require_once('views/index.php');

    