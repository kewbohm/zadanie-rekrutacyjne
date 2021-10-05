document.querySelectorAll("input[name='deliveryMethodRadio']").forEach((input) => {
    input.addEventListener('change', () => {
        calculateOrderTotalSum();
        changePaymentAndDeliveryRadios();
    });
    input.addEventListener('click', () => {
        document.getElementById('shippingDiv').classList.remove('d-none');
        document.getElementById('shipping').innerHTML = parseFloat(document.querySelector("input[name='deliveryMethodRadio']:checked").value).toFixed(2).replace('.', ',') + ' zł';
    });
});

function toggleDivVisibility(divId) {
    var div = document.getElementById(divId);

    div.classList.toggle("d-none");
}

function calculateOrderTotalSum() {
    var deliveryCheck = $('input[name="deliveryMethodRadio"]:checked').val() ?? 0;
    var cartTotalSum = $('#cartTotalSum').val();
    var discountValue = $('#discountValue').val();
    $('#orderTotalSum').html((parseFloat(deliveryCheck) + parseFloat(cartTotalSum) - parseFloat(discountValue)).toFixed(2).replace('.', ',') + ' zł');
}

function changePaymentAndDeliveryRadios() {
    var payuRadio = document.getElementById("payuRadio");
    var onDeliveryRadio = document.getElementById("onDeliveryRadio");
    var transferRadio = document.getElementById("transferRadio");

    if (document.getElementById("dpdOnDeliveryRadio").checked === true) {
        payuRadio.checked = false;
        payuRadio.disabled = true;
        transferRadio.checked = false;
        transferRadio.disabled = true;
        onDeliveryRadio.disabled = false;
    } else {
        payuRadio.disabled = false;
        transferRadio.disabled = false;
        onDeliveryRadio.disabled = true;
        onDeliveryRadio.checked = false;
    }
}

function clearCart(cartElement) {
    $('#' + cartElement + 'CodeInfo').html('');
    $('#' + cartElement + '').html();
    $('#' + cartElement + 'Div').addClass('d-none');
}

function sendForm() {
    var formValidStatus;
    formValidStatus = validateForm();
    if (formValidStatus) {
        $.ajax({
        type: 'POST',
        url: '',
        data: $('#orderForm').serialize(),
        cache: false,
        success: function(data) {
            $('#orderForm').find('input[type="text"], input[type="password"], select, textarea').val('');
            $('#orderForm').find('input[type="radio"], input[name="newsletter"], input[name="regulaminCheck"]').removeAttr('checked disabled');
            $('#confirm').html(data);
            clearCart('discount');
            $('#discountValue').val(0);
            clearCart('shipping');
            calculateOrderTotalSum();
        },
        error: function(data) {
            $('#confirm').html('<div class="alert alert-danger text-center my-3"><p>Coś poszło nie tak. Spróbuj ponownie.</p></div>');
        }
        });
    }
}

var formValidStatus;

function validateForm() {
    formValidStatus = true;
    $(".info").html('');
    if ($('#createAccountCheck:checked').val()) {
        let usernameValue = $("input[name='username']").val(); 
        let passwordValue = $("input[name='password']").val(); 
        let confirmPasswordValue = $("input[name='confirmPassword']").val(); 

        if (!usernameValue) {
            $('#usernameInfo').html("Wprowadź nazwę użytkownika.");
            formValidStatus = false;
        } else if (usernameValue.length < 3 || usernameValue.length > 10) {
            $('#usernameInfo').html("Nazwa użytkownika nie może być krótsza niż 3 znaki i dłuższa niż 10 znaków.");
            formValidStatus = false;
        } else if (!/^[\p{L}0-9]+$/u.test(usernameValue)) {
            $('#usernameInfo').html("Nazwa użytkownika może zawierać wyłącznie litery i cyfry.");
            formValidStatus = false;
        }

        if (!passwordValue) {
            $('#passwordInfo').html("Wprowadź hasło.");
            formValidStatus = false;
        } else if (passwordValue.length < 8) {
            $('#passwordInfo').html("Hasło musi składać się z minimum 8 znaków, w tym jednej cyfry.");
            formValidStatus = false;
        } else if (!/^(?=.*\d).+$/.test(passwordValue)) {
            $('#passwordInfo').html("Hasło musi składać się z minimum 8 znaków, w tym jednej cyfry.");
            formValidStatus = false;
        }

        if (!confirmPasswordValue) {
            $('#confirmPasswordInfo').html("Wprowadź hasło.");
            formValidStatus = false;
        } else if (confirmPasswordValue !== passwordValue) {
            $('#confirmPasswordInfo').html("Hasła nie są identyczne.");
            formValidStatus = false;
        }
    }            

    validateOrderForm('');

    if ($('#differentDeliveryAddressCheck:checked').val()) {
        validateOrderForm('DifferentDeliveryAddress');
    }

    if (!$("input[name='deliveryMethodRadio']:checked").length > 0) {
        $('#deliveryMethodRadioInfo').html("Wybierz jedną z metod dostawy.");
            formValidStatus = false;
    }

    if (!$("input[name='paymentMethodRadio']:checked").length > 0) {
        $('#paymentMethodRadioInfo').html("Wybierz jedną z metod płatności.");
            formValidStatus = false;
    }

    let commentValue = $("textarea[name='comment']").val(); 

    if (!/^[\p{L}0-9 .,?]*$/u.test(commentValue)) {
        $('#commentInfo').html("Komentarz może zawierać wyłącznie litery i cyfry oraz znaki '. , ?'.");
        formValidStatus = false;
    }

    if (!$("input[name='regulaminCheck']:checked").length > 0) {
        $('#regulaminCheckInfo').html("Potwierdź zapoznanie się z regulaminem.");
            formValidStatus = false;
    }

    return formValidStatus;
}

function validateOrderForm (delivery) {
    let firstNameValue = $("input[name='firstName" + delivery + "']").val(); 
    let lastNameValue = $("input[name='lastName" + delivery + "']").val();
    let countryValue = $("select[name='country" + delivery + "']").val();
    let addressValue = $("input[name='address" + delivery + "']").val();
    let postCodeValue = $("input[name='postCode" + delivery + "']").val();
    let cityValue = $("input[name='city" + delivery + "']").val();
    let phoneNumberValue = $("input[name='phoneNumber" + delivery + "']").val();

    if (!firstNameValue) {
        $('#firstName' + delivery + 'Info').html("Wprowadź swoje imię.");
        formValidStatus = false;
    } else if (!/^[\p{L}]+$/u.test(firstNameValue)) {
        $('#firstName' + delivery + 'Info').html("Imię może zawierać wyłącznie litery.");
        formValidStatus = false;
    }

    if (!lastNameValue) {
        $('#lastName' + delivery + 'Info').html("Wprowadź swoje nazwisko.");
        formValidStatus = false;
    } else if (!/^[-\p{L}]+$/u.test(lastNameValue)) {
        $('#lastName' + delivery + 'Info').html("Nazwisko może zawierać wyłącznie litery i znak -.");
        formValidStatus = false;
    }
    
    if (!countryValue) {
        $('#country' + delivery + 'Info').html("Podaj nazwę kraju.");
        formValidStatus = false;
    }

    if (!addressValue) {
        $('#address' + delivery + 'Info').html("Wprowadź swój adres (ulica, numer budynku, numer mieszkania).");
        formValidStatus = false;
    } else if (!/^[-\p{L}0-9 \/.]+$/u.test(addressValue)) {
        $('#address' + delivery + 'Info').html("Nazwisko może zawierać wyłącznie litery, cyfry oraz znaki '- / .'.");
        formValidStatus = false;
    }

    if (!postCodeValue) {
        $('#postCode' + delivery + 'Info').html("Wprowadź kod pocztowy.");
        formValidStatus = false;
    } else if (!/^[0-9]{2}[-][0-9]{3}$/.test(postCodeValue)) {
        $('#postCode' + delivery + 'Info').html("Wprowadź kod pocztowy w formacie: 00-000, np. 45-340.");
        formValidStatus = false;
    }

    if (!cityValue) {
        $('#city' + delivery + 'Info').html("Wprowadź nazwę miasta.");
        formValidStatus = false;
    } else if (!/^[-\p{L}.]+$/u.test(cityValue)) {
        $('#city' + delivery + 'Info').html("Nazwa miast może zawierać wyłącznie litery oraz znak '-'.");
        formValidStatus = false;
    }

    if (!phoneNumberValue) {
        $('#phoneNumber' + delivery + 'Info').html("Wprowadź swój numer.");
        formValidStatus = false;
    } else if (!/^[+0-9]+$/.test(phoneNumberValue)) {
        $('#phoneNumber' + delivery + 'Info').html("Numer telefonu może zawierać wyłącznie cyfry oraz znak '+'.");
        formValidStatus = false;
    } else if (phoneNumberValue.length < 9 || phoneNumberValue.length > 12) {
            $('#phoneNumberInfo').html("Numer telefonu nie może być krótszy niż 9 znaków i dłuższy niż 13 znaków.");
            formValidStatus = false;
    }
}

function addDiscountCode() {
    var codeValidStatus;
    codeValidStatus = validateDiscountCode();
    if (codeValidStatus) {
        $.ajax({
        type: 'POST',
        url: 'discount-code.php',
        data: 'discountCode=' + $("input[name='discountCode']").val(),
        cache: false,
        success: function(data) {
            $('#discountCodeInfo').html('Kod został aktywowany');
            $('#discountValue').val(data);
            $('#discount').html('-' + parseFloat(data).toFixed(2).replace('.', ',') + ' zł');
            $('#discountDiv').removeClass('d-none');
            calculateOrderTotalSum();
        },
        error: function(data) {
            $('#discountCodeInfo').html('Podany kod jest nieprawidłowy');
        }
        });
    }
}

function validateDiscountCode() {
    codeValidStatus = true;
    $(".code").html('');

    let codeValue = $("input[name='discountCode']").val(); 

    if (!codeValue) {
        $('#discountCodeInfo').html("Wprowadź kod.");
        codeValidStatus = false;
    } else if (!/^[A-Z0-9]+$/u.test(codeValue)) {
        $('#discountCodeInfo').html("Podany kod jest nieprawidłowy");
        codeValidStatus = false;
    }

    return codeValidStatus;
}