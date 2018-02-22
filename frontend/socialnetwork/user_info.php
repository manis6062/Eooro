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
	# * FILE: /frontend/socialnetwork/user_info.php
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);

	$accObj = new Account($id);
	$publish = $accObj->getString("publish_contact");
    $profileObj = new Profile(sess_getAccountIdFromSession());
    $profileObj->extract();
    
    //Facebook integration
    Facebook::getFBInstance($facebook);
    //$urlRedirect = "?attach_account=true&is_sponsor=n&edir_account=".sess_getAccountIdFromSession()."&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/index.php?facebookattached");
    
    //changed the value of $urlRedirect because of the Browser redirect loop problem 
    $urlRedirect = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : DEFAULT_URL.'/index.php';

    
    if (isset($_GET["signoffFacebook"])){
		$facebookMessage = system_showText(LANG_LABEL_FB_ACT_DISC).".";

		$accountObj = new Account(sess_getAccountIdFromSession());
		$accountObj->setString("facebook_username", "");
		$accountObj->setString("foreignaccount", "n");
		$accountObj->setString("foreignaccount_done", "n");
		$accountObj->setString("foreignaccount_auth", "");
		$accountObj->Save();

		$profileObj = new Profile(sess_getAccountIdFromSession());
		$profileObj->setString("facebook_uid", "");
		$profileObj->setString("usefacebooklocation", "0");
		$profileObj->Save();
	}
    
    //Twitter integration
    if ($tw_oauth_token && $tw_oauth_token_secret && $tw_screen_name) {
		$twitterInfo = true;
	}

	setting_get("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey);
	setting_get("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret);
    
	if ($foreignaccount_twitter_apikey && $foreignaccount_twitter_apisecret) {
		$twitterSupport = true;
		$EpiTwitter = new EpiTwitter($foreignaccount_twitter_apikey, $foreignaccount_twitter_apisecret);
	}
    $twitterSupport = false;
    
    if ($_GET["twitter"]) {
		if ($_GET["twitter"] == "success") $twitterMessage = system_showText(LANG_LABEL_TW_SIGNTW_CONN);
		else if ($_GET["twitter"] == "fail") $twitterMessage = system_showText(LANG_LABEL_TW_SIGNTW);
		else if ($_GET["twitter"] == "alreadyused") $twitterMessage = system_showText(LANG_TW_ALREADY_LINKED);
	}

	if ($_GET["signofftwitter"] == "success") $twitterMessage = system_showText(LANG_LABEL_TW_ACT_DISC).".";
	
?>

    <h2>

 <?php if ($info['id'] == $_SESSION['SESS_ACCOUNT_ID']) {
   echo system_showText(LANG_LABEL_ABOUT_ME); 
   }  else {
    echo "About ". $info['first_name']; 
    }  
?>
    
         <? if ($id == sess_getAccountIdFromSession()) { ?>
            <span><a class="view-more" href="<?=SOCIALNETWORK_URL;?>/edit.php" title="<?=LANG_LABEL_EDITPROFILE;?>"><?=LANG_LABEL_EDITPROFILE;?></a></span>
        <? } ?>
    </h2>

    <div class="user-info">
        
        <?
        if (!$info["facebook_image"]) {
            $imgObj = new Image($info["image_id"], true);
            if ($imgObj->imageExists()) {
                echo $imgObj->getTag(true, PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT);
            } else {
                echo "<div class=\"profile-noimage\"></div>";
            }
        } else {

            if (HTTPS_MODE == "on") {
                $info["facebook_image"] = str_replace("http://", "https://", $info["facebook_image"]);
            } ?>

            <img width="<?=$info["facebook_image_width"] ? $info["facebook_image_width"] : 100?>" height="<?=$info["facebook_image_height"] ? $info["facebook_image_height"] : 100?>" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>

        <? } ?>
            
        <section class="basic-info">
            
            <h5><?=htmlspecialchars($info["nickname"]);?></h5>
            
            <?
            if ($info["entered"]) { ?>
                <p><?=system_showText(LANG_LABEL_MEMBER_SINCE);?> <?=format_date($info["entered"])?></p>
            <? }
            
            if ($info["country"] || $info["state"] || $info["city"]) {
                    $arrayLocUser = array();
                    if ($info["country"]) { $arrayLocUser[] = $info["city"];}
                    if ($info["state"]) {  $arrayLocUser[] = $info["state"]; }
                    if ($info["city"]) {  $arrayLocUser[] = $info["country"]; }        
                ?>

                <p>
                   <?=ucfirst(system_showtext(LANG_FROM))?>
                   <?=(implode(", ", $arrayLocUser))?>
                </p>

            <? } ?>        
                
        </section>
      
        <section class="extra-info">            
            
            <? if ($publish == "y") {
                
                if ($info["company"]) { ?>
                    <p><?=ucfirst(system_showText(LANG_LABEL_COMPANY)).": " .nl2br(htmlspecialchars($info["company"]))?></p>     
                <? }
                
                if ($info["address"] || $info["address2"] || $info["phone"] || $info["fax"]) { ?>
                    <address>
                        <p><?=nl2br(htmlspecialchars($info["address"]))?>
                            <? if ($info["address2"]) { ?>
                                <br /><?=nl2br(htmlspecialchars($info["address2"]))?>
                            <? } ?>
                        </p>
                        <? if ($info["phone"]) { ?>
                        <p><?=system_showText(LANG_LABEL_PHONE)?>: <?=$info["phone"];?></p>
                        <? } ?>
                        <? if ($info["fax"]) { ?>
                        <p><?=system_showText(LANG_LABEL_FAX)?>: <?=$info["fax"];?></p>
                        <? } ?>
                    </address>
                <? }
                
                if ($info["url"]) { ?>
                    <p><a href="<?=nl2br(htmlspecialchars($info["url"]))?>" title="<?=system_showText(LANG_LABEL_URL)." ".system_showText(LANG_PAGING_PAGEOF)." ".$info["nickname"]?>" target="_blank"><?=nl2br(htmlspecialchars($info["url"]));?></a></p>
                <? }
            }
            
            if ($info["personal_message"]) { ?>
                <p><?=nl2br(htmlspecialchars($info["personal_message"]))?></p>
            <? } ?> 

        </section>  

        <section class="social-network" id="socialNetworking">
                        
            <?
            if ($id == sess_getAccountIdFromSession() && ($twitterSupport || (FACEBOOK_APP_ENABLED == "on" && $accObj->getString("username") != $accObj->getString("facebook_username")))) {
                
                if ($_GET["error"] == "disableAttach") { ?>
                    <p class="errorMessage"><?=system_showText(LANG_FB_ALREADY_LINKED)?></p>
                <? }

                if (isset($_GET["facebookerror"])) { ?>
                    <p class="errorMessage"><?=system_showText(LANG_MSG_ERROR_NUMBER)." 10001. ".system_showText(LANG_MSG_TRY_AGAIN);?></p>
                <? }
                
                if ($accObj->getString("username") != $accObj->getString("facebook_username") && FACEBOOK_APP_ENABLED == "on") {

                    //Account already associated
                    if ($profileObj && $profileObj->facebook_uid != "") {

                        //Unlink account
                        if (isset($_GET["facebookattached"])) { ?>
                            <p class="successMessage"><?=system_showText(LANG_LABEL_FB_SIGNFB_CONN);?></p>
                        <? } ?>

                        <p><i class="socialicon social-facebook"></i><a href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/index.php?signoffFacebook"><?=system_showText(LANG_LABEL_UNLINK_FB);?></a></p>
                    <?
                    //Account not associated
                    } else {

                        $linkAttachFB = true;

                        //Link Account
                        if ($facebookMessage) { ?>
                            <p class="successMessage"><?=$facebookMessage?></p>
                        <? }

                        include(INCLUDES_DIR."/forms/form_facebooklogin.php");

                    } 
                }
                
                if ($twitterSupport) {
                    
                    if (!isset($twitterInfo)) {

                        if (!isset($EpiTwitter)) {
                            $EpiTwitter = new EpiTwitter($foreignaccount_twitter_apikey, $foreignaccount_twitter_apisecret);
                        }
                        
                        if ($twitterMessage) { ?>
                            <p class="<?=$_GET["signofftwitter"] == "success"? "successMessage": "errorMessage"?>"><?=$twitterMessage?></p>
                        <? } ?>
                            
                        <p><i class="socialicon social-twitter"></i><a href="<?=$EpiTwitter->getAuthorizationUrl()?>"><?=system_showText(LANG_LABEL_TW_LINK)?></a></p>

                    <? } else {
                        
                        if ($twitterMessage) { ?>
                            <p class="<?=$_GET["twitter"] == "success"? "successMessage": "errorMessage"?>"><?=$twitterMessage?></p>
                        <? } ?>
                        
                        <p><i class="socialicon social-twitter"></i><a href="<?=DEFAULT_URL?>/twitter.php?signoffTwitter"><?=system_showText(LANG_LABEL_UNLINK_TW)?></a></p>

                    <? }
                } 
            }
            
            /*if ($aux_show_twitter) { ?>

                <div class="last-tweets">
                    <h2>
                        <?=system_showText(LANG_TWITTER)?>
                    </h2>
                    <ul id="twitter_update_list_profile">
                        <?
                        //This content is prepared by ajax on functions/script_funct.php
                        ?>
                        <li id="twitter_loading_profile" class="loading"></li>
                    </ul>
                </div>
            <? }*/ ?>
                
        </section>
            
    </div>
    
    <script language="javascript" type="text/javascript">
        
        <? if (isset($_GET["signoffFacebook"]) || isset($_GET["facebookattached"]) || isset($_GET["twitter"]) || isset($_GET["signofftwitter"])) { ?>
            $("html, body, div").animate({
                scrollTop: $("#socialNetworking").offset().top
            }, 500);
        <? } ?>
        
    </script>