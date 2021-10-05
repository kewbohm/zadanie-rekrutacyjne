<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/icons/bootstrap-icons-1.5.0/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

    <title>Koszyk | Sklep online</title>
</head>
<body>

    <main>
    <div class="container">
        <section>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="orderForm">
                <div class="row pt-5">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-white bg-secondary">
                                <i class="bi bi-person-fill me-2"></i>
                                1. TWOJE DANE
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-danger mb-2 w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Logowanie
                            </button>
                            <p>Masz już konto? Kliknij żeby się zalogować.</p>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="createAccountCheck" name="createAccount" onclick="toggleDivVisibility('createAccountForm')">
                                <label class="form-check-label" for="createAccountCheck">
                                Stwórz nowe konto
                                </label>
                            </div>
                        </div>
                        <div>
                            <div id="createAccountForm" class="d-none">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Nazwa użytkownika">
                                    <span id="usernameInfo" class="text-danger info"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Hasło">
                                    <span id="passwordInfo" class="text-danger info"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Potwierdź hasło">
                                    <span id="confirmPasswordInfo" class="text-danger info"></span>
                                </div>
                            </div>
                            <div id="deliveryForm">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="firstName" placeholder="Imię *">
                                    <span id="firstNameInfo" class="text-danger info"></span>

                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="lastName" placeholder="Nazwisko *">
                                    <span id="lastNameInfo" class="text-danger info"></span>

                                </div>
                                <div class="mb-3">
                                    <select class="form-select" name="country">
                                        <option value="Polska" selected>Polska</option>
                                    </select>
                                    <span id="countryInfo" class="text-danger info"></span>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="address" placeholder="Adres *">
                                    <span id="addressInfo" class="text-danger info"></span>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="postCode" placeholder="Kod pocztowy *">
                                            <span id="postCodeInfo" class="text-danger info"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="city" placeholder="Miasto *">
                                            <span id="cityInfo" class="text-danger info"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="phoneNumber" placeholder="Telefon *">
                                    <span id="phoneNumberInfo" class="text-danger info"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="differentDeliveryAddressCheck" name="differentDeliveryAddress" onclick="toggleDivVisibility('differentDeliveryAddress');">
                                <label class="form-check-label" for="differentDeliveryAddressCheck">
                                    Dostawa pod inny adres
                                </label>
                            </div>
                        </div>
                        <div id="differentDeliveryAddress" class="d-none">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="firstNameDifferentDeliveryAddress" placeholder="Imię *">
                                <span id="firstNameDifferentDeliveryAddressInfo" class="text-danger info"></span>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="lastNameDifferentDeliveryAddress" placeholder="Nazwisko *">
                                <span id="lastNameDifferentDeliveryAddressInfo" class="text-danger info"></span>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="countryDifferentDeliveryAddress">
                                    <option value="Polska" selected>Polska</option>
                                </select>
                                <span id="countryDifferentDeliveryAddressInfo" class="text-danger info"></span>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="addressDifferentDeliveryAddress" placeholder="Adres *">
                                <span id="addressDifferentDeliveryAddressInfo" class="text-danger info"></span>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="postCodeDifferentDeliveryAddress" placeholder="Kod pocztowy *">
                                        <span id="postCodeDifferentDeliveryAddressInfo" class="text-danger info"></span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="cityDifferentDeliveryAddress" placeholder="Miasto *">
                                        <span id="cityDifferentDeliveryAddressInfo" class="text-danger info"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="phoneNumberDifferentDeliveryAddress" placeholder="Telefon *">
                                <span id="phoneNumberDifferentDeliveryAddressInfo" class="text-danger info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-white bg-secondary">
                                <i class="bi bi-truck me-2"></i>
                                2. METODA DOSTAWY
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check mb-3 ms-3">
                                <input class="form-check-input" type="radio" name="deliveryMethodRadio" id="inpostRadio" value="10.99">
                                <label class="form-check-label w-100" for="inpostRadio">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <img src="<?php echo URLROOT; ?>/public/assets/img/inpost-logo.png" class="me-2" alt="Logo firmy InPost">
                                            Paczkomaty 24/7
                                        </div>
                                        <div class="fw-bold me-3">10,99zł</div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-3 ms-3">
                                <input class="form-check-input" type="radio" name="deliveryMethodRadio" id="dpdInAdvanceRadio" value="18.00">
                                <label class="form-check-label w-100" for="dpdInAdvanceRadio">
                                <div class="d-flex justify-content-between">
                                        <div>
                                            <img src="<?php echo URLROOT; ?>/public/assets/img/dpd-logo.png" class="me-2" alt="Logo firmy DPD">
                                            Kurier DPD
                                        </div>
                                        <div class="fw-bold me-3">18,00zł</div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-3 ms-3">
                                <input class="form-check-input" type="radio" name="deliveryMethodRadio" id="dpdOnDeliveryRadio" value="22.00">
                                <label class="form-check-label w-100" for="dpdOnDeliveryRadio">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <img src="<?php echo URLROOT; ?>/public/assets/img/dpd-logo.png" class="me-2" alt="Logo firmy DPD">
                                            Kurier DPD pobranie
                                        </div>
                                        <div class="fw-bold me-3">22,00zł</div>
                                    </div>
                                </label>
                            </div>
                            <span id="deliveryMethodRadioInfo" class="text-danger info"></span>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body text-white bg-secondary">
                                <i class="bi bi-credit-card-fill me-2"></i>
                                3. METODA PŁATNOŚCI
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check mb-3 ms-3">
                                <input class="form-check-input" type="radio" name="paymentMethodRadio" id="payuRadio" value="PayU">
                                <label class="form-check-label" for="payuRadio">
                                    <img src="<?php echo URLROOT; ?>/public/assets/img/payu-logo.png" class="me-2" alt="Logo firmy PayU">
                                    PayU
                                </label>
                            </div>
                            <div class="form-check mb-3 ms-3">
                                <input class="form-check-input" type="radio" name="paymentMethodRadio" id="onDeliveryRadio" value="Przy odbiorze">
                                <label class="form-check-label" for="onDeliveryRadio">
                                    <img src="<?php echo URLROOT; ?>/public/assets/img/platnosc-pobranie.png" class="me-2" alt="Rysunek porftela z wysuniętymi banknotami">
                                    Płatność przy odbiorze
                                </label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="radio" name="paymentMethodRadio" id="transferRadio" value="Przelew zwykły">
                                <label class="form-check-label" for="transferRadio">
                                    <img src="<?php echo URLROOT; ?>/public/assets/img/platnosc-przelew.png" class="me-2" alt="Logo firmy DPD">
                                    Przelew bankowy - zwykły
                                </label>
                            </div>
                            <span id="paymentMethodRadioInfo" class="text-danger info"></span>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-outline-secondary mb-2 w-100" onclick="toggleDivVisibility('discountCodeDiv');">Dodaj kod rabatowy</button>
                            <div id="discountCodeDiv" class="d-none">
                                <div class="mb-3 p-3 border rounded">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="discountCode" placeholder="Kod rabatowy">
                                        </div>
                                        <div class="col">
                                            <div class="btn btn-secondary w-100" onclick="addDiscountCode()">Dodaj</div>
                                        </div>
                                        <span id="discountCodeInfo" class="text-secondary code"></span>
                                        <input type="hidden" id="discountValue" name="discount" value="0">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                        <div class="card mb-3">
                            <div class="card-body text-white bg-secondary">
                                <i class="bi bi-file-text-fill me-2"></i>
                                4. PODSUMOWANIE
                            </div>
                        </div>
                        <div class="mb-3" style="border-bottom: 1px dashed skyblue;">
                            <?php 
                                foreach ($cart->getItems() as $item) {
                                ?>
                                    <div class="row pb-3">
                                        <div class="col-4">
                                            <div class="bg-secondary w-100 h-100"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="d-flex justify-content-between">
                                                <div class="fw-bold">
                                                    <?php echo $item->getProduct()->getTitle(); ?>
                                                </div>
                                                <div class="fw-bold">
                                                    <?php echo number_format($item->getProduct()->getPrice() *  $item->getQuantity(), 2, ',', ''); ?> zł
                                                </div>
                                                <input type="hidden" name="productIds[]" value="<?php echo $item->getProduct()->getId(); ?>">
                                                <input type="hidden" name="productPrices[]" value="<?php echo $item->getProduct()->getPrice(); ?>">
                                            </div>
                                            <div>Ilość: <?php echo $item->getQuantity(); ?></div>
                                            <input type="hidden" name="productQuantities[]" value="<?php echo $item->getQuantity(); ?>">
                                        </div>
                                    </div>
                                <?php
                                }
                            ?>
                        </div>
                        <div class="mb-3" style="border-bottom: 1px dashed skyblue;">
                            <div class="d-flex justify-content-between">
                                <div>Suma częściowa</div>
                                <div>
                                    <?php echo number_format($cart->getTotalSum(), 2, ',', ' '); ?> zł
                                </div>
                                <input type="hidden" id="cartTotalSum" name="cartTotalSum" value="<?php echo $cart->getTotalSum(); ?>">  
                            </div>
                            <div id="shippingDiv" class="d-flex justify-content-between d-none">
                                <div>Wysyłka</div>
                                <div id="shipping"></div> 
                            </div>
                            <div id="discountDiv" class="d-flex justify-content-between d-none">
                                <div>Rabat</div>
                                <div id="discount"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="fw-bold fs-3">Łącznie</div>
                                <div id="orderTotalSum" class="fw-bold fs-3">
                                    <?php echo number_format($cart->getTotalSum(), 2, ',', ' '); ?> zł
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Komentarz"></textarea>
                            <span id="commentInfo" class="text-danger info"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter">
                                Zapisz się, aby otrzymywać newsletter
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="regulaminCheck" name="regulaminCheck">
                                <label class="form-check-label" for="regulaminCheck">
                                Zapoznałam/em się z <a href="#" class="text-decoration-none">Regulaminem</a> zakupów
                                </label>
                            </div>
                            <span id="regulaminCheckInfo" class="text-danger info"></span>
                        </div>
                        <div class="btn btn-danger text-uppercase w-100 p-4" name="submit" onclick="sendForm()">Potwierdź zakup</div>
                        <div id="confirm"></div>
                    </div>
                </div>
            </form>
        </section>

    </div>
    </main>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Logowanie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nazwa użytkownika">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Hasło">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                <button type="button" class="btn btn-danger">Zaloguj</button>
            </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo URLROOT; ?>/public/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/assets/js/javascript.js"></script>


</body>
</html>