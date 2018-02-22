<?php

# ----------------------------------------------------------------------------------------------------
# * FILE: /members/listing/review-collector.php
# ----------------------------------------------------------------------------------------------------
if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    header("Location:" . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE);
    exit;
}
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");
include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_ReviewCollector.php';

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();
$contact = new Contact($acctId);
$sponsor_firstname = ucfirst($contact->first_name);
$sponsor_lastname = ucfirst($contact->last_name);
$sponsor_email = $contact->email;
$listing_id = mysql_real_escape_string($_GET['id']);

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);

# ----------------------------------------------------------------------------------------------------
# VALIDATION
# ----------------------------------------------------------------------------------------------------
$listObj = new Listing($id);
$listing_name = $listObj->title;
$owner_id = $listObj->account_id;

$invalidDataIndex = array();

if ($acctId != $owner_id) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}


//CSV upload and verification Logic
if ($_FILES) {

    $csv_mimetypes = array(
        'text/csv',
        'text/plain',
        'application/csv',
        'text/comma-separated-values',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
        'text/anytext',
        'application/octet-stream',
        'application/txt',
    );

    if (in_array($_FILES['file']['type'], $csv_mimetypes)) {
        // possible CSV file
        // could also check for file content at this point
        //If file size is greater than 2 mb fail upload

        if ($_FILES['file']['size'] <= 0 || $_FILES['file']['size'] > 2097152):

            $return['message'] = "Sorry, invalid file size.";
            echo json_encode($return);
            die;
        endif;

        $fileTemporary = $_FILES['file']['tmp_name'];
        $csvAsArray = array_map('str_getcsv', file($fileTemporary));
        $message = "";
        $error = 0;
        $invalidArray = "";
        unset($csvAsArray[0]);

        if (empty($csvAsArray)):
            $return['message'] = "Sorry the CSV file is of invalid format. Please try again.";
            echo json_encode($return);
            die;
        endif;

        foreach ($csvAsArray as $key => $individualArray) {

            $individualArray[0] = str_replace("\n\r", "", $individualArray[0]);
            $individualArray[1] = str_replace("\r\n", "", $individualArray[1]);
            $individualArray[2] = str_replace("\n", "", $individualArray[2]);
            $individualArray[3] = str_replace("\r", "", $individualArray[3]);

            //Check if csv is of correct format else fail
            if (count($individualArray) != 4):
                $return['message'] = "Sorry the CSV file is of invalid format. Please try again.";
                echo json_encode($return);
                die;
            endif;

            $salutationCsv = $individualArray[0];
            $firstnameCsv = $individualArray[1];
            $lastnameCsv = $individualArray[2];
            $emailCsv = $individualArray[3];

            #----------------------
            # 	Validation
            #----------------------
            //Saluation
            if($salutationCsv) {
            if (trim($salutationCsv) != "Mr" && trim($salutationCsv) != "Mr."
                && trim($salutationCsv) != "Miss" && trim($salutationCsv) != "Miss." 
                && trim($salutationCsv) != "Mrs" && trim($salutationCsv) != "Mrs."
                && trim($salutationCsv) != "Dr" && trim($salutationCsv) != "Dr."):
                $message1 = "<li>Salutation can only be 'Mr', 'Miss', 'Mrs' or 'Dr'</li>.";
                $invalidArray[] = $salutationCsv . " || ";
            endif;
        }

            //Firstname
            // if (trim($firstnameCsv) == "" || !ctype_alpha($firstnameCsv)):
            //     $message2 = "<li>Firstname must contain only letters.</li>";
            //     $invalidArray[] = $firstnameCsv . " || ";
            // endif;

            // //Lastname
            // if (trim($lastnameCsv) == "" || !ctype_alpha($lastnameCsv)):
            //     $message3 = "<li>Lastname must contain only letters.</li>";
            //     $invalidArray[] = $lastnameCsv . " || ";
            // endif;

            //Email
            if (validate_email($emailCsv) == false || trim($emailCsv) == "") {
                $message4 = "<li>Email is invalid or missing.</li>";
                $invalidArray[] = $emailCsv . " || ";
            }

            //If everything is correct, put the value in insert Array

            if ($invalidArray):
                $invalidArray1[] = $salutationCsv . " || " . $firstnameCsv . " || " . $lastnameCsv . " || " . $emailCsv;
                $error++;
                //remove invalid data row from csv file
                $invalidDataIndex[] = $key;

                $_SESSION['invalidDataIndex'] = $invalidDataIndex;
                //unset($csvAsArray[$key]);
                unset($invalidArray);


            else:
                $insertArray[] = $salutationCsv . " || " . $firstnameCsv . " || " . $lastnameCsv . " || " . $emailCsv;
            endif;

            //If more than 50 errors, reject the csv files
            if ($error == 50):
                $return['message'] = "CSV files rejected, Too Many Invalid Entries";
                $return['invalidData'] = $invalidArray1;
                $return['message1'] = "<li>Email is invalid or missing.</li>";
                $return['entries'] = null;
                echo json_encode($return);
                die;
            endif;
        }


        //Store the uploaded file in import_files folder inside custom/domain_1
        $path = EDIRECTORY_ROOT . "/custom/domain_1/import_files/" . rand(0000, 9999) . "_" . date("m-d-y") . $listing->id . "_csv.csv";
        $move = move_uploaded_file($_FILES["file"]["tmp_name"], $path);
        $perm = chmod($path, 775);

        $status = ($move == true AND $perm == true ? true : false );
        unset($_SESSION['csv_file_name']);
        $_SESSION['csv_file_name'] = $path;

        //if there are invalid data inside csv file
        if ($invalidArray1 && $insertArray):
            $return['message1'] = $message1 . $message2 . $message3 . $message4;
            $return['message'] = "Verification successful.";
            $return['invalidData'] = $invalidArray1;
            $return['entries'] = array_slice($insertArray, 0, 10);
            $return['status'] = $status;
            echo json_encode($return);
            die;

            elseif($invalidArray1 && $insertArray == null):
            $return['message1'] = $message1 . $message2 . $message3 . $message4;
            $return['message'] = "Sorry the CSV file is of invalid format. Please try again.";
            $return['invalidData'] = $invalidArray1;
            $return['entries'] = array_slice($insertArray, 0, 10);
            $return['status'] = $status;
            echo json_encode($return);
            die;

        endif;


        //If success return successful array into preview section
        $return['entries'] = array_slice($insertArray, 0, 10);
        $return['message'] = "Verification successful.";
        $return['status'] = $status;
        echo json_encode($return);
    } else {
        $return['message'] = "Please upload a CSV file.";
        echo json_encode($return);
        die;
    }
}

//Update Temporary file in our database
if ($_POST['status'] == true && $_POST['verified'] == true):

    if (file_exists($_SESSION['csv_file_name'])):
        $csvFile = $_SESSION['csv_file_name'];
        $csvAsArray = array_map('str_getcsv', file($csvFile));
        unset($csvAsArray[0]);

        $invalidDataIndex = $_SESSION['invalidDataIndex'];

        foreach ($invalidDataIndex as $invalidIndex) {
            unset($csvAsArray[$invalidIndex]);
        }


        //Rebuild array if any entries are deleted
        $csvAsArray = array_values($csvAsArray);

        //Filter CSV and remove unnecessary emails

        $ToAddData = ReviewCollector::checkUnsubscribed($listing_id, $acctId);

        $csvEmail = array();

        //Filter duplicate emails inside CSV file
        foreach ($csvAsArray as $key => $value):

            $csvEmail[] = $value[3];

        endforeach;

        $unique = array_unique($csvEmail);
        $dupes = array_diff_key($csvEmail, $unique);
        
        //echo '<pre>'; print_r($unique); print_r($dupes); exit;

        foreach ($csvAsArray as $key => $value):
            
            foreach($unique as $keya=>$valuea):
            
                if($key == $keya):
           
                    $uni_data[] = $csvAsArray[$key];
                
                    unset($csvAsArray[$key]);
                    
                     
                
                endif;
                
            endforeach;

//            if (in_array($value[3], $dupes)):
//
//                $duplicate_data[] = $csvAsArray[$key];
//
//                unset($csvAsArray[$key]);
//
//            endif;

        endforeach;
       
        $duplicate_data = array_values($csvAsArray);
        
        //print_r($duplicate_data); exit;
        
        $csvAsArray = array_values($uni_data);
        //filter duplicate emails in database
        foreach ($csvAsArray as $key => $value):

            foreach ($ToAddData as $k => $val):

                if ($value[3] == $val['email']):

                    $dbDublicateData[] = $csvAsArray[$key];

                    unset($csvAsArray[$key]);

                endif;

            endforeach;

        endforeach;

        foreach ($csvAsArray as $key => $value):

            $unique_data[] = $csvAsArray[$key];

        endforeach;

               
        //$csvAsArray = array_values($unique_data);
        
        if (count($dbDublicateData) > 0):

            foreach ($dbDublicateData as $dbDublicate):

                $dbDub[] = $dbDublicate[0] . " || " . $dbDublicate[1] . " || " . $dbDublicate[2] . " || " . $dbDublicate[3];

            endforeach;

        endif;

        $return['dbDub'] = array_slice($dbDub, 0, 10);

        //Rebuild array if any entries are deleted
        $insertData = array_values($csvAsArray);

        if (count($duplicate_data) > 0) {

            foreach ($duplicate_data as $dup_data) {
                $d_data[] = $dup_data[0] . " || " . $dup_data[1] . " || " . $dup_data[2] . " || " . $dup_data[3];
            }
        }
        $return['duplicate'] = array_slice($d_data, 0, 10);
        
        if (count($unique_data) > 0) {

            foreach ($unique_data as $uni_data) {
                $u_data[] = $uni_data[0] . " || " . $uni_data[1] . " || " . $uni_data[2] . " || " . $uni_data[3];
            }
        }
        $return['unique'] = array_slice($u_data, 0, 10);



        foreach ($insertData as $index => $value):
            ReviewCollector::RegisterReviewCollectorCSV($acctId, $listing_id, $value[0], $value[1], $value[2], $value[3]);
        endforeach;

        if (count($insertData) > 0) {
            $return['message'] = "Successfully imported. " . count($insertData) . " entries added.";
        } else {
            $return['message'] = "Successfully imported. No new entries were added.";
        }
        unset($_SESSION['invalidDataIndex']);
        echo json_encode($return);
    else:
        $return['message'] = "Sorry something went wrong, please try again";
        echo json_encode($return);
    endif;

endif;

if ($_POST['AddUsers']) {

    $times = count($salutation);
    for ($i = 0; $i < $times; $i++) {
        $salutation[$i] = strip_tags($_POST['salutation'][$i]);
        $firstname[$i] = strip_tags($_POST['firstname'][$i]);
        $lastname[$i] = strip_tags($_POST['lastname'][$i]);
        $email[$i] = strip_tags($_POST['email'][$i]);
        $salutation[$i] = mysql_real_escape_string($salutation[$i]);
        $firstname[$i] = mysql_real_escape_string($firstname[$i]);
        $lastname[$i] = mysql_real_escape_string($lastname[$i]);
        $email[$i] = mysql_real_escape_string($email[$i]);
        $msg[$i] = str_replace("FIRSTNAME", $firstname[$i], $body);
        ReviewCollector::RegisterReviewCollector($acctId, $listing_id, $salutation[$i], $firstname[$i], $lastname[$i], $email[$i]);
    }
}

if ($listObj->status == "A") {
    if (!$_POST) {
        include_once('review-collector/forms.php');
    }
} else {
    include(INCLUDES_DIR . "/views/view_listing_not_activated.php");
}
?>
