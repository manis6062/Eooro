<?
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------    
    //Validate captcha
    if($_SERVER['HTTP_X_REQUESTED_WITH']){

	    if($_POST && $_POST['captcha_value']){
	        if(md5($_POST['captcha_value']) == $_SESSION["captchakey"]){
	            echo "true";
	        } else {
	            echo "invalid";
	        }   
	    }
    } else {
    	header("Location:" . DEFAULT_URL . '/' . ALIAS_LISTING_MODULE . '/' );
    	exit;
    }

?>