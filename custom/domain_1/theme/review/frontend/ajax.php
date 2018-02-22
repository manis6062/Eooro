<?php

//ini_set('display_errors', 1);
//	error_reporting(E_ALL);
    $path = "";
    $full_name = "";
    $file_name = "";
    $full_name = $_SERVER["SCRIPT_FILENAME"];
    if (strlen($full_name) > 0) {
        $osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
        $file_pos = strpos($full_name, $osslash."cronjobs".$osslash);
        if ($file_pos !== false) {
            $file_name = substr($full_name, $file_pos);
        }
        $path = substr($full_name, 0, (strlen($file_name)*(-1)));
    }
    if (strlen($path) == 0) $path = "..";
    define("EDIRECTORY_ROOT", $path);

require_once("../includes/db_connection.php");
require_once("functions/autoload.php");
require_once("functions/functions.php");


#------------------------------------
# 	Update / Set Email Template
#------------------------------------

if($_GET['id'] && $_GET['type'] == "email_template"){
	$id  = $_GET['id'];
	$array = ReviewCollector::getTemplateById($id);
	$array->template_body = utf8_encode($array->template_body);
	echo json_encode($array, JSON_HEX_QUOT | JSON_HEX_APOS| JSON_PARTIAL_OUTPUT_ON_ERROR);
}

#------------------------------------
# 	Activate Email Template
#------------------------------------

if($_GET['id'] && $_GET['type'] == "activate"){
	$id  = $_GET['id'];
        $name = $_GET['name'];
	ReviewCollector::activateTemplateByID($id, $name);
}

if($_GET['id'] && $_GET['type'] == "delete_template"){
		$id  = $_GET['id'];
		deleteTemplate($id);
}

    extract($_POST);


  if($ajax_type == "userChangeData"){
            $db = getDb();
       (trim($changeType) == "fullname" || trim($changeType) == "username" || trim($changeType) == "is_enable" || trim($changeType) == "password" ) ? null : die('error'); 
            is_numeric($id) ? null : die('error');
            $newValue = str_replace("<br>", "", $newValue);
            $newValue = htmlentities($newValue);
              if($changeType == "fullname"){
                $fullname = $newValue;
                ($fullname == null) ? die('Fullname must be specified.') : null;
                $sql = "UPDATE User_Login SET fullname ='$fullname' WHERE id ='$id'";
                $result = $db->query($sql);
                echo ($result == true ? "success" : "error");

            }
                if($changeType == "username"){
                $username = $newValue;
                ($username == null) ? die('Username must be specified.') : null;
                $sql = "UPDATE User_Login SET username ='$username' WHERE id ='$id'";
                $result = $db->query($sql);
                echo ($result == true ? "success" : "error");

            }
               if($changeType == "is_enable"){
                $is_enable = $newValue;
                ($is_enable == null) ? die('Active or Inactive must be specified.') : null;
                $sql = "UPDATE User_Login SET is_enable ='$is_enable' WHERE id ='$id'";
                $result = $db->query($sql);
                echo ($result == true ? "success" : "error");

            }
            
              if($changeType == "password"){
                $password = $newValue;
                ($password == null) ? die('Password must be specified.') : null;
                $sql = "UPDATE User_Login SET password ='$password' WHERE id ='$id'";
                $result = $db->query($sql);
                echo ($result == true ? "success" : "error");

            }
    
    } 


?>

