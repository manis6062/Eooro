<?php
include_once CLASSES_DIR.'/class_Subscriber.php';
if( isset($_POST['email']) && validate_email( $_POST['email'] ) ){
    $email = $_POST['email'];
    try{
        $subscriber = new stdClass();
        $subscriber->email = $email;
        $subscriber->is_active = 1;

        $subscriberObj = new Subscriber( $subscriber );
        if ( !$subscriberObj->isEmailRegistered($email) ) {
            $subscriberObj->Save();
        }
        echo 'true';
    }
    catch ( Exception $e ){
        echo 'false';
    }
}
else {
    echo 'invalid';
}