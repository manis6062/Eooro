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
    # * FILE: /mobile/dealredeem.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/mobile.inc.php");
    include("../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on") { exit; }
    
    extract($_GET);
    extract($_POST);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage)) {

            sess_registerAccountInSession($_POST["username"]);
            setcookie("username_members", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

            $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

            setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

            header("Location: ".MOBILE_DEFAULT_URL."/dealredeem.php?id=$id_login");
            exit;

        }
        
    }

    if ($login == "true" && $id_login > 0) {

        $needLogin = true;
        
        $defaultusername = $username;
        $defaultpassword = "";
        if (DEMO_MODE) {
            $defaultusername = "demo@demodirectory.com";
            $defaultpassword = "abc123";
        }
        
        $promotion = new Promotion($id_login);
        $dealName = $promotion->getString("name");

    } elseif ($id && sess_getAccountIdFromSession()) {
        
        $redeemit = true;
        $nofacebook = true;
        $isMobileRedeem = true;
        
        include(EDIRECTORY_ROOT."/includes/code/deal_redeem.php");
        
    }
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = $headertagtitle;
    include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

?>
    <div class="redeem">

        <? if (!$needLogin) {
            
            if ($promotion && !$promotionMsg) {
                
                if ($promotion->getNumber("realvalue") > 0) {
                    $offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
                } else {
                    $offer = "100%";
                }
                $promotionInfo = $promotion->getDealInfo(sess_getAccountIdFromSession());
                $contact = new Contact(sess_getAccountIdFromSession());
                
            if ($errorNumber) { ?>
                <p id="errorMessage" class="informationMessage"><?=system_showText(DEAL_REDEEM_DONEALREADY);?></p>
            <? } ?>
                
            <h4>
                <span><?=$promotion->getString("name");?></span>
            </h4>

            <p class="text-small">

                <strong><?=system_showText(LANG_DEAL_REMEEDED_AT)?></strong> <?=format_date($promotionInfo["account"]["datetime"], DEFAULT_DATE_FORMAT, "date")?> - <?=format_date($promotionInfo["account"]["datetime"], "H:i", "datetime")?><br/>
                <strong><?=system_showText(DEAL_VALIDUNTIL)?></strong> <?=$promotion->getDate("end_date");?><br/>
                <br/>
                <strong><?=system_showText(LANG_LABEL_NAME)?></strong> <?=$contact->getString("first_name")." ".$contact->getString("last_name")?><br/>
                <strong><?=system_showText(DEAL_ORIGINALVALUE)?></strong> <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2)?><br/>
                <strong><?=system_showText(DEAL_AMOUNTPAID)?></strong> <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?><br/>

            </p>

            <hr/>

            <h4 class="text-info"><?=system_showText(LANG_MOBILE_DEAL_REDEEMED);?></h4>

            <p>
                <strong><?=system_showText(LANG_MOBILE_DEAL_USECODE);?> <span><?=$errorNumber ? $redeemCheck : $redeem_code;?></span></strong>
            </p>
            
            <hr/> <br />

            <? } else { ?>
                <p class="errorMessage"><?=$promotionMsg;?></p>
            <? }
                
        } else { ?>
			<strong><?=$dealName;?></strong>
			<hr/>
            <p><?=system_showText(LANG_MOBILE_DEAL_LOGIN);?></p>   
            <form id="loginForm" name="loginForm" class="contact form-horizontal" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                
                <input type="hidden" name="login" value="<?=$login?>" />
                <input type="hidden" name="id_login" value="<?=$id_login?>" />

                <? if ($authmessage) { ?>
                    <p class="errorMessage"><?=$authmessage?></p>
                <? } ?>

                <div class="control-group ">
                    <label class="control-label"><?=system_showText(LANG_LABEL_USERNAME);?></label>
                    <div class="controls">
                        <input class="span12" type="text" placeholder="<?=system_showText(LANG_LABEL_USERNAME);?>" name="username" id="username" value="<?=$defaultusername?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?=system_showText(LANG_LABEL_PASSWORD)?></label>
                    <div class="controls">
                        <input class="span12" type="password" placeholder="<?=system_showText(LANG_LABEL_PASSWORD)?>" name="password" id="password" value="<?=$defaultpassword?>" />
                    </div>
                </div>

                <div class="control">
                    <button type="submit" class="btn plusmarginb btn-success"><?=LANG_BUTTON_LOGIN?></button>
                </div>

            </form>
                
        <? } ?>
        
    </div>
     
<?   
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>