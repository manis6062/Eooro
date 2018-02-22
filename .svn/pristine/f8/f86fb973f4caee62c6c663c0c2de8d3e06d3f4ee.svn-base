<? 

    
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /members/claim/listinglevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
        
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

        $listingObject = new Listing($claimlistingid);
            $listing_title = $listingObject->getString("title");
            $friendly_url = $listingObject->getString("friendly_url");
            $description = $listingObject->getString("description");
            $long_description = $listingObject->getString("long_description");
            $keywords = $listingObject->getString("keywords");
            $url = $listingObject->getString("url");
            $phone = $listingObject->getString("phone");
            $fax = $listingObject->getString("fax");
            $address = $listingObject->getString("address");
            $address2 = $listingObject->getString("address2");
            $zip_code = $listingObject->getString("zipcode");
        //var_dump($listingObject);
        
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
//	session_start();
//        $accObj = new AccountProfileContact($acctId); //var_dump($accObj);
//        $accountObj = new Account($acctId);  //var_dump($accountObj);
//        if ($accountObj->getString("is_sponsor") != "y")
//        {
//            $sql1 = "UPDATE Account SET is_sponsor = 'y' WHERE id = $this->id";
//            $resource = $dbDomain->query( $sql1 );
//        }
//        
        sess_validateSession();
        //var_dump($_COOKIE);
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/claim";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;
        
        # ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
        $username = $_COOKIE["username_members"];
        
        # ----------------------------------------------------------------------------------------------------
	# DB CONNECT
	# ----------------------------------------------------------------------------------------------------
        
        
        $account_id = $acctId;
        $listing_id = $claimlistingid;
        $status = "progress";
        $step = "a";

        $date_time = date("Y-m-d H:i:s");   
        $sql = "INSERT INTO Claim (account_id, username, listing_id, listing_title, status, step, date_time)"
        . "VALUES ('{$account_id}','{$username}','{$listing_id}', '{$listing_title}', '{$status}', '{$step}', '{$date_time}')";
        $resource = $dbDomain->query( $sql );
        
        
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") {var_dump("ehllo"); exit; }
	if (!$claimlistingid) {var_dump("ehllo1");
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
            var_dump("ehllo2");
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
        // IF THE SESS_ACC_ID is not EQUAL TO LISTING OBJECT'S ACC ID
//	if ($listingObject->getNumber("account_id") != $acctId) {
//		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
//		exit;
//	}

	if (!is_array($listingObject->getGalleries())) {
            var_dump("ehllo3");
		$gallery = new Gallery();
		$aux = array("account_id"=>0,"title"=>$listingObject->getString("title"),"entered"=>"NOW()","updated"=>"now()");
		$gallery->makeFromRow($aux);
		$gallery->save();
		$listingObject->setGalleries($gallery->getNumber("id"));
	}


	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'a' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
            var_dump("ehllo4");
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
            var_dump("ehllo5");
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		var_dump("ehllo");
                $status = new ItemStatus();
		$listingObject->setDate("renewal_date", "00/00/0000");
		$listingObject->setString("status", $status->getDefaultStatus());
		$listingObject->setString("level", $_POST["level"]);
		$listingObject->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
		$listingObject->save();
		$claimObject->setString("step", "b");
		$claimObject->save();
        
                
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/listing.php?claimlistingid=".$claimlistingid);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	$listing = $listingObject;
	$listing->extract();
	$levelObj = new ListingLevel();
    if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
    require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
   
    <? if( EDIR_THEME !== 'review' ) :?>
    <div class="real-steps">
        <div  class="standardStep-Title">
            <?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span>
        </div>
        <ul class="standardStep steps-3">
            <li class="steps-ui stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
            <li class="steps-ui stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LISTING_UPDATE);?></li>
            <li class="steps-ui"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ACCOUNT_SIGNUP);?></li>
        </ul>
    </div>
    <? else : ?>
        <div class="container">
        <div class="thumbnail listingthumbnail lisingthumbnail1">
            <div class="row">
                <div class="col-sm-5 col-sm-offset-1 steps-width">
                    <div class="heading-banner heading-banner1">
                        <h4><?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <?=string_strtoupper(system_showText(LANG_THREESTEPS))?></h4>
                    </div><!--/heading-banner-->
                </div><!--/col-sm-5-->
            </div>
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="pWrapper">
                        <div class="row">
                            <ul class="claim-listing">
                                
                                <li class="list col-sm-3 gap">
                                    <span>1</span> &nbsp; <?=system_showText(LANG_ACCOUNTSIGNUP)?>
                                </li>

                                <li class="list col-sm-3 active active-width gap">
                                    <span>2</span> &nbsp; <?=system_showText(LANG_LISTINGUPDATE)?>

                                </li>

                                <li class="list col-sm-3 checkout-width gap">
                                    <span>3</span> &nbsp; <?=system_showText(LANG_CHECKOUT)?>
                                </li>
                               
                            </ul>
                        </div>
                    </div><!--/pWrapper-->
                </div>
            </div><!--/row-->
        </div><!--/thumbnail-->
    </div> <!--/container-->
    <? endif; ?>
        <?=(EDIR_THEME==='review') ? '<div class="container">' : ''?>
	<div class="content content-full">

        <div>
    
            <form name="listinglevel" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
    
                <input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>" />
    
                <? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>
    
                <p class="standardButton claimButton listingButton">
                    <button type="submit"><?=system_showText(LANG_BUTTON_NEXT)?></button>
                </p>
    
            </form>
    
        </div>
	</div>
        <?=(EDIR_THEME==='review') ? '</div>' : ''?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
