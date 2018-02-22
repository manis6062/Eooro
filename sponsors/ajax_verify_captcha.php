<?php
if ($_POST['captchaResponse']) {
    $captcha = filter_input(INPUT_POST, 'captchaResponse'); // get the captchaResponse parameter sent from our ajax
    /* Check if captcha is filled */

    if (!$captcha) {
        http_response_code(401); // Return error code if there is no captcha
    }
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . DATA_SECRETKEY . "&response=" . $captcha);
    if ($response . success == false) {
        echo 'SPAM';
        http_response_code(401); // It's SPAM! RETURN SOME KIND OF ERROR
    } else {
        echo 'EVERYTHING LOOKS FINE';
        // Everything is ok and you can proceed by executing your login, signup, update etc scripts
    }
    exit;
}

?>
<script>
    console.log('test');
</script>