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
	# * FILE: /theme/default/frontend/popup.php
	# ----------------------------------------------------------------------------------------------------

?>
 <? if ($pop_type == "reviewformpopup") { ?>
    <style>
        body {
            background-color: #eef9ff;
        }

        #mc{
            height:505px;
        }

    </style>
<? } ?>
    <div id="mc" class="modal-content <?=$extraStyle?>">

        <? if ($pop_type == "advertise_preview") { ?>
        
            <h2>
                <b><?=$label;?></b>
                <span>
                    <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>
        
            <? if ($modulePreview == "banner") { ?>
        
                <div class="span8-5 level-summary">	
                    <p class="preview-desc"><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></p>
                    <img class="banner-image" src="<?=$bannerImgScr?>" alt="<?=$levelObj->getName($levelValue);?>" title="<?=$levelObj->getName($levelValue);?>" />
                </div>
        
            <? } else { ?>
        
                <div class="span8-5 level-summary">				

                    <p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>

                    <? include(INCLUDES_DIR."/views/view_{$modulePreview}_summary.php"); ?>

                </div>

                <?
                ${$modulePreview} = $moduleObj;
                if ($levelObj->getDetail(${$modulePreview}->getNumber("level")) == "y") {
                    $typePreview = "detail"; 
                ?>

                    <div class="row-fluid level-detail">

                        <p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>

                        <?
                        $signUpItem = $modulePreview;
                        include(system_getFrontendPath("detail_preview.php", "frontend"));
                        ?>

                    </div>

                <? }
        
            } ?>
        
        <? } elseif (string_strpos($pop_type, "emailform") !== false) { ?>

            <h2>
                <b><?=stripcslashes($obj->getString("title"))?></b> 
                <span>
                    <a href="javascript:void(0);" onclick="<?=($_GET["auto"] ? "urlRedirect('".DEFAULT_URL.$ItemPath."');" : "parent.$.fancybox.close();");?>"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>
        <div class="container">
            <div class="send-email">

                <div class="info">

                    <? if ($error) { ?>
                        <p class="errorMessage"><?=$error?></p>
                    <? } ?>

                    <? if ($return_email_message) { ?>

                        <p><?=$return_email_message?></p>

                    <? } else { ?>

                        <h4 class="text-center"><?=stripcslashes($saudation);?></h4>

                    <? } ?>

                </div>

                <form name="mail" 
                      action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" 
                      method="post" 
                      class="form" 
                      id="emailForm"
                      role="form">

                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="receiver" value="<?=$receiver?>" />
                    <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                    <? if(!$item_error && !$return_email_message) { ?>

                        <div class="left">
                            <? if ($receiver != "owner") { ?>

                            <div class="form-group formimage reviewmbtm">
                                
                                <input 
                                    type="email" 
                                    name="to" 
                                    value="<?=$to?>" 
                                    class="form-control loginform reviewinput reviewplacehld"
                                    placeholder="<?=system_showText(LANG_LABEL_TO)?> <?=system_showText(LANG_LABEL_FRIEND_EMAIL)?>*"/>
                            </div>

                            <? } else { ?>  <?//earlier readonly code - <?=(sess_getAccountIdFromSession() && is_object($userInfo)) ? "readonly=\"readonly\"" : ""*/?>
                                <input type="hidden" name="to" value="<?=$to?>" />
                                <div class="form-group formimage reviewmbtm">
                                <?$reviewer_info = new Profile($_SESSION["SESS_ACCOUNT_ID"]);?>
                                    <input 
                                        class="form-control loginform reviewinput reviewplacehld" 
                                        type="text" 
                                        name="name" 
                                        value="<?=$name?>"
                                        id="name" 
                                        placeholder="<?=system_showText(LANG_LABEL_NAME)?> *"
                                        value="<?=$reviewer_info->nickname//=(sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("first_name")." ".$userInfo->getString("last_name")) : ($name)?>"  
                                        />
                                </div>
                            <? } ?>
                            <div class="form-group formimage reviewmbtm">
                                <input 
                                    type="email" 
                                    name="from" 
                                    value="<?=($receiver == "owner" && sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("email")) : ($from)?>" 
                                    class="form-control loginform reviewinput reviewplacehld"
                                    id="email"
                                    placeholder="<?=($receiver != "owner" ? system_showText(LANG_LABEL_FROM)." (". string_strtolower(LANG_LABEL_YOUREMAIL).")" : system_showText(LANG_LABEL_YOUREMAIL))?> *"/>
                            </div>

                            <div class="form-group formimage reviewmbtm">
                                <input 
                                    type="text" 
                                    name="subject" 
                                    value="<?=$subject?>" 
                                    class="form-control loginform reviewinput reviewplacehld"
                                    placeholder="<?=system_showText(LANG_LABEL_SUBJECT)?> *"/>
                            </div>

                        </div>

                        <div class="right">

                            <div class="contactListing-textArea">
                                <?
                                $body = str_replace("<br />", "", $body);
                                ?>
                                
                                <textarea 
                                    name="body" 
                                    rows="6" 
                                    cols="0"
                                     class="form-control contactListing-textArea"
                                    placeholder="<?=system_showText(LANG_LABEL_ADDITIONALMSG)?> <?=($receiver == "owner" ? "* " : "")?>"><?= $body?></textarea>
                            </div>
                             
                        </div>

                        <div class="action">

                            <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
                            <div class="captcha contactListing">
                                <div style="text-align : -webkit-center;">
                                <div class="row" style="text-align: -moz-center;">
                     <div class="g-recaptcha" data-callback="imNotARobot" data-sitekey="<?php echo DATA_SITEKEY; ?>"></div>
                    <span id="re-captcha" style="color:red" /> 
                                </div>
                            </div>
                            </div>
                            <div style="padding-top:5px;">
                              <button class="btn btn-lg btten-info btten-space g-recaptcha" id="submit" type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>  
                            </div>
                            

                        </div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
                      
<script type="text/javascript">
  $('#submit').click(function(e){
        // Google Recaptcha
   if(get_Captcha() == ''){
        e.preventDefault();
    };  
  });
</script>

<script> 
                        if ( $("#name").val().length > 0 ) {
                            $('#name').attr('readonly', 'true');
                        }
                        if ( $("#email").val().length > 0 ) {
                            $('#email').attr('readonly', 'true');
                        }
                        </script>

                    <? } ?>
                </form>
            </div>
        </div>

        <? } elseif (string_strpos($pop_type, "review") !== false) { ?>

        <section class="login review popup">

            <div class="popup-review">
                <div class="info">
                    <? if ($message_review) {
                        if ($success_review) { ?>
                            <div class="alert alert-success">
                                <?

                                $message_review .= "Please wait window will refresh in <span id='count'></span> secs.";
                                echo $message_review;
                                ?>
                            </div>
                            <script>
                            setTimeout("location.href = window.parent.location.reload();",3000);
                            window.onload = function(){
                            (function(){
                              var counter = 4;

                              setInterval(function() {
                                counter--;
                                if (counter >= 1) {
                                  span = document.getElementById("count");
                                  span.innerHTML = counter;
                                }
                                
                              }, 1000);
                                
                            })();
                              
                            }
                            </script>

                        <? }
                    } ?>
                </div>

                <? if (!$success_review) { ?>
                <form name="rate_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form" role="form">
                        <input type="hidden" id="item_type" name="item_type" value="<?=$item_type?>" />
                        <input type="hidden" id="item_id" name="item_id" value="<?=$item_id?>" />
                        <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                        <?
                        include(INCLUDES_DIR."/forms/form_review_review.php"); 
                        ?>

                    </form>
                <? } ?>
            </div>
        </section>

        <? } elseif ($pop_type == "clicktocallpopup") {

            $auxObj = new $_GET["module"]($_GET["module_id"]);
        ?>

            <h2>
                <b><?=$auxObj->getString("title")?></b>
                <span>
                    <a href="javascript:void(0);" onclick="<?=($_GET["auto"] ? "urlRedirect('".DEFAULT_URL.$ItemPath."');" : "parent.$.fancybox.close();");?>"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>

            <div class="info">

                <? if ($error) { ?>
                    <p class="errorMessage"><?=$error?></p>
                <? } ?>

                <? if ($return_message) { ?>

                    <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-calling.gif" />
                    <p><?=$return_message?></p>

                <? } else { ?>

                    <p><?=system_showText(LANG_LISTING_CLICKTOCALL_SAUDATION);?></p>

                <? } ?>

            </div>

            <? if (!$return_message) { ?>

                <form name="twilioClickToCall" method="post" class="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                    <input type="hidden" name="module_id" value="<?=$_GET["module_id"]?>" />
                    <input type="hidden" name="module" value="<?=$_GET["module"]?>" />
                    <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                    <div class="left">
                        <div>
                            <label for="phone">* <?=system_showText(LANG_LABEL_PHONE)?> <span>(000) 000-0000</span></label>
                            <span class="comment"><?=system_showText(LANG_CLICKTOCALL_TIP6)?></span>
                            <input type="text" class="text" name="phone" id="phone" value="<?=$phone?>"  />								
                        </div>
                    </div>
                    <div class="action">
                        <button type="submit" value="Send"><?=system_showText(LANG_TWILIO_CALL)?></button>
                    </div>
                </form>

            <? } ?>

        <? } elseif ($pop_type == "sendtophonepopup") {

            $auxObj = new $module($module_id);
        ?>

            <h2>
                <b><?=$auxObj->getString("title")?></b>
                <span>
                    <a href="javascript:void(0);" onclick="<?=($_GET["auto"] ? "urlRedirect('".DEFAULT_URL.$ItemPath."');" : "parent.$.fancybox.close();");?>"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>

            <div class="info">

                <? if ($error) { ?>
                    <p class="errorMessage"><?=$error?></p>
                <? } ?>

                <? if ($return_message) { ?>

                    <?=$return_message?>

                <? } else { ?>

                    <p><?=system_showText(LANG_LISTING_TOPHONE_SAUDATION);?></p>

                <? } ?>

            </div>

            <? if (!$return_message) { ?>

                <form name="twilioSMS" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form">

                    <input type="hidden" name="module_id" value="<?=$module_id?>" />
                    <input type="hidden" name="module" value="<?=$module?>" />
                    <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                    <div class="left">
                        <div>
                            <label for="phone">* <?=system_showText(LANG_LABEL_PHONE)?> <span>(000) 000-0000</span></label>
                            <input type="text" class="text" name="phone" id="phone" value="<?=$phone?>"  />
                        </div>
                    </div>
                    <div class="action">
                        <button type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>
                    </div>
                </form>

            <? } 

        } elseif($pop_type == 'update_paymentmethod') {

                include( system_getFrontendPath( 'update_paymentmethod_form.php') );

            } elseif ($pop_type == "terms") { ?>

            <h2>
                <b><?=system_showText(LANG_TERMS_USE);?></b>
                <span>
                    <a href="javascript:void(0);" onclick="<?=($_GET["auto"] ? "urlRedirect('".DEFAULT_URL.$ItemPath."');" : "parent.$.fancybox.close();");?>"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>

        <?
            if ($sitecontent) {
                echo "<div class=\"content-custom\">".$sitecontent."</div>";
            }

        } elseif ($pop_type == "profile_login") { ?>
<section class="login loginpopup">
    <div class="container">
        <h1 class="login-create">Login with  Eooro.com here.</h1>
        <div class="row">
<!--            <div class="col-xs-12"> -->

<!--            <div class="col-sm-1 col-xs-1">
                <span class="or">or</span>
            </div>-->
            <div class="col-xs-12">
                <div id="loginBtnWrapper" class="popUpLogin">
                    <!-- <h3 class="noaccount">Don’t have an account? Sign Up! <br/> or<br/> Log In with</h3> -->
    <!--                 <h3 class="noaccount">or<br/> Log In with</h3> -->
                    <? 
                    if (FACEBOOK_APP_ENABLED == "on") {
                        $urlRedirect = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : DEFAULT_URL.'/index.php';
                        include( system_getFrontendPath( 'socialnetwork/form_facebooklogin.php') );
                    }

                    if ($foreignaccount_google) {
                        $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                        include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                    } 
                     if ($foreignaccount_google) {
                        $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                        include( system_getFrontendPath( 'socialnetwork/form_twitterlogin.php') );
                    } 
                     if ($foreignaccount_google) {
                        $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                        include( system_getFrontendPath( 'socialnetwork/form_linkedinlogin.php') );
                    } 
                    ?>
                    <button type="button" class="btn btn-default custombtn" id="emailBtn">
                        <div class="fbbtnwrapper gplus ema">
                            <i class="fa fa-envelope fb gps"></i>
                            <span><?=strtoupper('Log in with Email')?></span>
                        </div>
                    </button>
                </div>

            <div class="col-xs-10 col-xs-offset-1 popUpFormWrapper" style="display:none;" id="loginForm">
                <div class="row">
                  <!--   <h2 class="login-into-account">Login into your account</h2> -->
                    <form class="form" name="login" target="_parent" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>" role="form"> 

                    <!--previous action; action="<?=((SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on") ? SECURE_URL : DEFAULT_URL)?><?=$url?>" -->
                        <? 
                        $members_section = true;
                        include(INCLUDES_DIR."/forms/form_login_review.php"); ?>
                    </form>
                </div>
            </div>
            </div>
        <!--    </div>  -->  <!--col-xs-12 ends-->
            
        </div>   <!--row ends--> 
    </div>
</section>

        <? } elseif ($pop_type == "deal_redeem") { ?>

            <h2>
                <b><?=$promotion->getString("name");?></b>
                <span>
                    <a href="javascript:void(0);" onclick="<?=($_GET["auto"] ? "urlRedirect('".DEFAULT_URL.$ItemPath."');" : "parent.$.fancybox.close();");?>"><?=system_showText(LANG_CLOSE);?></a>
                </span>
            </h2>

            <div class="redeem-deal">
                <?
                if ($promotion && !$promotionMsg && $errorNumber != 2 && $errorNumber != 3) {

                    //Listing info
                    $listingtemplate_address = "";
                    if ($listing->getString("address")) {
                        $listingtemplate_address = nl2br($listing->getString("address", true));
                    }

                    $listingtemplate_address2 = "";
                    if ($listing->getString("address2")) {
                        $listingtemplate_address2 = nl2br($listing->getString("address2", true));
                    }

                    $listingtemplate_phone = "";
                    if ($listing->getString("phone")) {
                        $listingtemplate_phone  = $listing->getString("phone", true);
                    }

                    $listingtemplate_email = "";
                    if (htmlspecialchars($listing->getString("email"))) {
                        $listingtemplate_email = $listing->getString("email");
                    }

                    $listingtemplate_url = "";
                    if (htmlspecialchars($listing->getString("url"))) {
                        $display_url = htmlspecialchars($listing->getString("url"));
                        if (htmlspecialchars($listing->getString("display_url"))) {
                            $display_url = htmlspecialchars($listing->getString("display_url"));
                        }
                        $listingtemplate_url = $display_url;

                    }

                    $listingtemplate_location = "";
                    $locationsToshow = system_retrieveLocationsToShow();
                    $locationsParam = system_formatLocation($locationsToshow.", z");
                    $listingtemplate_location = $listing->getLocationString($locationsParam, true);

                    if ($promotion->getNumber("realvalue") > 0) {
                        $offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
                    } else {
                        $offer = "100%";
                    }
                    $promotionInfo = $promotion->getDealInfo(sess_getAccountIdFromSession());
                    $contact = new Contact(sess_getAccountIdFromSession());

                    customtext_get("promotion_default_conditions", $promotion_default_conditions);

                    if ($errorNumber && $reprint != "true") { ?>
                        <p id="errorMessage" class="<?=$errorNumber == 1 ? "informationMessage" : "errorMessage"?>"><?=$errorNumber == 1 ? system_showText(DEAL_REDEEM_DONEALREADY) : system_showText(DEAL_REDEEMINFO_2)?></p>
                    <? } ?>

                    <h1><?=$errorNumber ? $redeemCheck : $redeem_code;?></h1>

                    <h2><?=$promotion->getString("name");?></h2>

                    <div class="text-center">
                        <button href="javascript:void(0);" onclick="javascript:print_page();" class="btn btn-success"><?=system_showText(LANG_LABEL_PRINT);?></button>
                    </div>

                    <div class="comp-info">

                        <div class="deal-info">
                            <p><strong><?=system_showText(LANG_LABEL_NAME)?></strong>: <?=$contact->getString("first_name")." ".$contact->getString("last_name")?></p>
                            <p><strong><?=system_showText(LANG_DEAL_REMEEDED_AT)?></strong>: <?=format_date($promotionInfo["account"]["datetime"], DEFAULT_DATE_FORMAT, "date")?> - <?=format_date($promotionInfo["account"]["datetime"], "H:i", "datetime")?></p>
                            <p><strong><?=system_showText(DEAL_VALIDUNTIL)?></strong>: <?=$promotion->getDate("end_date");?></p>
                            <p><strong><?=system_showText(DEAL_ORIGINALVALUE)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2)?></p>
                            <p><strong><?=system_showText(DEAL_AMOUNTPAID)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?></p>
                        </div>

                        <div class="listing-info">
                            <p><strong><?=system_showText(LANG_LISTING_FEATURE_NAME)?>: </strong><?=$listing->getString("title")?></p>
                            <? if ($listingtemplate_phone) { ?>
                            <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERPHONE))?>: </strong><?=$listingtemplate_phone?></p>
                            <? } ?>
                            <? if ($listingtemplate_email) { ?>
                            <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTEREMAIL))?>: </strong><?=$listingtemplate_email?></p>
                            <? } ?>
                            <? if ($listingtemplate_url) { ?>
                            <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERWEBSITE))?>: </strong><?=$listingtemplate_url?></p>
                            <? } ?>
                            <? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_ADDRESS)?>: </strong>
                                <? if ($listingtemplate_address) { ?>
                                    <span><?=$listingtemplate_address.($listingtemplate_address2 || $listingtemplate_location ? ", " : "" )?></span>
                                <? } ?>
                                <? if ($listingtemplate_address2) { ?>
                                    <span><?=$listingtemplate_address2.($listingtemplate_location ? ", " : "")?></span>
                                <? } ?>
                                <? if ($listingtemplate_location) { ?>
                                    <span><?=$listingtemplate_location?></span>
                                <? } ?>
                            </p>
                            <? } ?>
                        </div>
                    </div>

                    <? if ($promotion->getString("conditions")) { ?>
                        <div class="terms">
                            <p><?=nl2br($promotion->getString("conditions"));?></p>
                        </div>
                    <? } ?>


                <? } elseif ($errorNumber == 3) { ?>
                    <p class="informationMessage"><?=system_showText(LANG_MSG_NEED_LOGIN_DEAL);?></p>
                <? } else { ?>
                    <p class="<?=$errorNumber == 2 ? "errorMessage" : "informationMessage"?>"><?=$errorNumber == 2 ? system_showText(DEAL_REDEEMINFO_2): $promotionMsg;?></p>
                <?  }?>

                </div>

            <? } elseif ($pop_type == "uploadimage") { ?>

                <h2>
                    <b><?=($captions == "y"? system_showText(LANG_LABEL_EDIT_CAPTIONS) : system_showText(LANG_LABEL_ADDIMAGE))?></b>
                    <span>
                        <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                    </span>
                </h2>

                <?
                $sql = "SELECT COUNT(*) FROM Gallery_Temp WHERE image_default = 'n' AND sess_id = '".$gallery_hash."'";
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                $r = $dbObj->query($sql);
                while ($row_aux = mysql_fetch_array($r)) {
                    $cont_temp = $row_aux[0];
                }
                if ($galleryid){
                    $gallery = new Gallery($galleryid);
                    $cont_gal = count($gallery->image);
                }

                if ($photos && $photos >= 0 && ($cont_temp + $cont_gal) >= $photos){
                    $return_upload_message .= "<p class=\"errorMessage\">".LANG_YOU_CAN_ADD_MAXOF.$photos.LANG_TO_YOUR_GALLERY."</p>";
                }

                if ($return_upload_message) {
                    echo $return_upload_message;
                } else {
                    ?>
                    <form id="uploadimage" name="uploadimage" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="frmEmail" enctype="multipart/form-data" >

                        <input type="hidden" name="pop_type" value="<?=$pop_type?>" />
                        <input type="hidden" name="item_type" value="<?=$item_type?>" />
                        <input type="hidden" name="main" value="<?=$main?>" />
                        <input type="hidden" name="level" value="<?=$level?>" />
                        <input type="hidden" name="temp" value="<?=$temp?>" />
                        <input type="hidden" name="gallery_item_id" id="gallery_item_id" value="<?=$gallery_item_id?>" />
                        <input type="hidden" name="gallery_id" id="gallery_id" value="<?=$gallery_id?>" />
                        <input type="hidden" name="image_id" id="image_id" value="<?=$image_id?>" />
                        <input type="hidden" name="thumb_id" id="thumb_id" value="<?=$thumb_id?>" />
                        <input type="hidden" name="item_id" id="item_id" value="<?=$item_id?>" />
                        <input type="hidden" name="captions" id="captions" value="<?=$captions?>" />
                        <input type="hidden" name="x1" value="0" id="x1" />
                        <input type="hidden" name="y1" value="0" id="y1" />
                        <input type="hidden" name="x2" value="<?=$thumbWidthItem?>" id="x2" />
                        <input type="hidden" name="y2" value="<?=$thumbHeightItem?>" id="y2" />
                        <input type="hidden" name="w" value="<?=$thumbWidthItem?>" id="w" />
                        <input type="hidden" name="h" value="<?=$thumbHeightItem?>" id="h" />
                        <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />
                        <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />

                        <? include(INCLUDES_DIR."/forms/form_uploadimage.php"); ?>
                    </form>
                <? } ?>

            <? } elseif ($pop_type == "custominvoice_items") { ?>

                <? if ($customInvoiceItems) { ?>
        
                <h2>
                    <b><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_TITLE)?>: <?=$customInvoice->getString("title");?></b>
                    <span>
                        <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                    </span>
                </h2>
        
                <? } ?>

                <div class="customInvoice">

                    <? if ($customInvoiceItems) { ?>

                        <h3><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_ITEMS)?></h3>

                        <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
                            <tr>
                                <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                                <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                            </tr>
                            <? if (!$view || $view != "payment_log") { ?>
                                <? foreach($customInvoiceItems as $each_custominvoice_item) { ?>
                                    <tr>
                                        <td><?=$each_custominvoice_item["description"]?></td>
                                        <td><?=CURRENCY_SYMBOL." ".format_money($each_custominvoice_item["price"])?></td>
                                    </tr>
                                <? }?>
                            <? } else { ?>
                                    <?
                                    if ($customInvoicePaymentItems && $customInvoicePaymentPrices) {
                                        foreach ($customInvoicePaymentItems as $key => $each_item) {
                                        ?>
                                            <tr>
                                                <td><?=$each_item?></td>
                                                <td><?=CURRENCY_SYMBOL." ".format_money($customInvoicePaymentPrices[$key])?></td>
                                            </tr>
                                        <?
                                        }
                                    }
                                    ?>
                            <? } ?>
                        </table>

                    <? } else { ?>
                            <p class="informationMessage"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></p>
                    <? } ?>

                </div>

            <? } elseif ($pop_type == "package_items") { ?>

                <? if ($packageItems) { ?>
        
                <h2>
                    <b><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_TITLE)?>: <?=$package->getString("title");?></b>
                    <span>
                        <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                    </span>
                </h2>
        
                <? } ?>

                <div class="customInvoice">

                    <? if ($packageItems) { ?>

                        <h2><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_TITLE)?>: <?=$package->getString("title");?></h2>

                        <h3><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_ITEMS)?></h3>

                        <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
                            <tr>
                                <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                                <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                            </tr>
                            <?
                            if ($packagePaymentItems && $packagePaymentPrices) {
                                foreach ($packagePaymentItems as $key => $each_item) {
                                ?>
                                    <tr>
                                        <td><?=$each_item?></td>
                                        <? if ($key != 0) { ?>
                                        <td><?=$str_price?></td>
                                        <? } else { ?>
                                        <td>&nbsp;</td>
                                        <? } ?>
                                    </tr>
                                <?
                                }
                            }
                            ?>
                        </table>

                    <? } else { ?>
                            <p class="informationMessage"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></p>
                    <? } ?>

                    </div>

            <? } elseif ($pop_type == "twilio_report") { ?>

                <h2>
                    <b><?=system_showText(LANG_LISTING_FEATURE_NAME)?> - <?=system_showText(LANG_CLICKTOCALL_REPORT)?> - <?=$listing->getString("title", true, 35);?></b>
                    <span>
                        <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                    </span>
                </h2>

                <?
                include(INCLUDES_DIR."/tables/table_twilio_report.php");			
                ?>

            <? } ?>
    </div>
