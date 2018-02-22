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
	# * FILE: /includes/forms/form_contact_members.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/newsletter.php");
                  
    if ($account->foreignaccount == 'y') {
        $isForeignAcc = TRUE;
    }else{
        $isForeignAcc= FALSE;
    }
   
?>
  
    <div id="contact-info">

        <div class="right">
       
         <div class="cont_50">
                <label><?=system_showText(LANG_LABEL_FIRST_NAME);?><span class="req">*</span> <a href="javascript: void(0);">* <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></a></label>
                <input type="text" maxlength="50" name="first_name" value="<?=$first_name?>"  />
          </div>
          
             <div class="cont_50">
                <label><?=system_showText(LANG_LABEL_LAST_NAME);?><span class="req">*</span> <a href="javascript: void(0);">* <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></a></label>
                <input type="text" name="last_name" maxlength="50" value="<?=$last_name?>"/>
            </div>
            
            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_COMPANY)?></label>
                <input type="text" name="company" maxlength="120" value="<?=$company?>" />
            </div>

            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_ADDRESS1)?><span class="req">*</span> <em><?=system_showText(LANG_ADDRESS_EXAMPLE)?></em></label>
                <input type="text" name="address" maxlength="64" value="<?=$address?>" maxlength="50" />
            </div>

            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_ADDRESS2)?> <em><?=system_showText(LANG_ADDRESS2_EXAMPLE)?></em></label>
                <input type="text" name="address2" maxlength="64" value="<?=$address2?>" maxlength="50" />
            </div>

            
            <?php 
            $loadmap1 = 'false';
            include(EDIRECTORY_ROOT . "/includes/code/listing.php");

            include(EDIRECTORY_ROOT . "/includes/code/load_account_location.php");
                            ?>

            <div class="cont_30">
                <label><?=string_ucwords(ZIPCODE_LABEL)?><span class="req">*</span></label>
                <input type="text" name="zip" maxlength="15" value="<?=$zip?>" />
            </div>

            <div class="cont_30">
                <label><?=system_showText(LANG_LABEL_PHONE)?></label>
                <input type="text" id="phone" maxlength="20" name="phone" value="<?=$phone?>" />
            </div>

            <div class="cont_30">
                <label><?=system_showText(LANG_LABEL_FAX)?></label>
                <input type="text" id="fax" maxlength="20" name="fax" value="<?=$fax?>" />
            </div>

            <? if (($id || $account_id) && $isForeignAcc) { ?>
            <div class="cont_100">
                <label style="display:none;"><?=system_showText(LANG_LABEL_EMAIL)?> <a href="javascript: void(0);"><span class="req">*</span> <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></a></label>
                <input hidden name="email" id="email" value="<?=$email?>" />
            </div>
            <? } ?>

            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_URL)?></label>
                <?=$dropdown_protocol;?>
                <input class="input-httpSelect" type="text" maxlength="128" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" />
            </div>

            <?
                //Added Currency selector in Account form
//                $dbMain = db_getDBObject(DEFAULT_DB, true);
//                $dbObj  = db_getDBObject();
//
//                $account = new Account(sess_getAccountIdFromSession());
//                $currency['currency'] = $account->prefered_currency;
//                $currency['symbol']   = $account->currency_symbol;
//
//                //Extract currencies and their name
//                $sql    = "SELECT currency, symbol as currency_name FROM Location_1 order by id desc";
//                $result = $dbMain->query($sql);
//                while ($row = mysql_fetch_assoc($result)) {
//                    $values[] = $row;
//                }
//
//                foreach ($values as $key => $value) {
//                    $currencies[$value['currency']] = $value['currency_name'];
//                }

            ?>
<!--            <div class="cont-100">
                <label>Select Currency</label>
                    <select id="currency-type">
                        <option value="Select Currency" selected>Select Currency</option>
                            <? foreach($currencies as $key => $value): ?>
                                <option value="<?=$key?>" <?=$key == $currency['currency'] ? "selected" : null;?> ><?=$key?> (<?=$value?>)</option>
                            <? endforeach; ?>
                    </select>    
            </div>-->

            <? if (($id || $account_id) && $isForeignAcc) { ?>
                <input type="hidden" name="isforeignAcc" value="y" />
                <input type="hidden" name="foreignaccount" value="y" />
            <? } else { ?>
                <input type="hidden" name="email" id="email" value="<?=$email?>" />
            <? } ?>
        </div>

    </div>

    <?  $info = socialnetwork_retrieveInfoProfile($_SESSION["SESS_ACCOUNT_ID"]); 
        if (SOCIALNETWORK_FEATURE == "on" || $is_sponsor == "y") { ?>

    <div id="settings">

        <div class="right">

            <? if (SOCIALNETWORK_FEATURE == "on") { ?>
            <div class="cont_checkbox" style="<?=$has_profile == "y" || !$has_profile ? "" : "display: none;";?>">	 				
                <input id="inputpublish" type="checkbox" name="publish_contact" <?=($publish_contact == "y" || $publish_contact == "on") ? "checked=\"checked\"": "" ?> />
                <label for="inputpublish"><?=system_showText(LANG_LABEL_PUBLISH_MY_CONTACT);?></label>
            </div>
            <? } ?>

            <? if ($info['is_sponsor'] == "y") { ?>
            <div class="cont_checkbox">	 				
                <input type="checkbox" name="notify_traffic_listing" id="notify_traffic_listing" <?=($notify_traffic_listing == "y" || $notify_traffic_listing == "on" || (!$id && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked=\"checked\"": "" ?> />
                <label for="notify_traffic_listing" ><?=system_showText(LANG_LABEL_NOTIFY_TRAFFIC);?></label>
            </div>
            <? } ?>
            
            <? if ($showNewsletter) { ?>
            <div class="cont_checkbox">
                <input id="inputnewsletter" type="checkbox" class="checkbox" name="newsletter" value="y" <?=($newsletter == "y" || $newsletter == "on") ? "checked=\"checked\"": "" ?> />
                <label for="inputnewsletter"><?=$signupLabel?></label>
            </div>
            <? } ?>
            
            <? if ($twitterSupport && isset($twitterInfo)) { ?>
            <div class="cont_checkbox">
                <input type="checkbox" id="tw_post" name="tw_post" value="1" <?=$twpost_checked?> />
                <label for="tw_post"><?=system_showText(LANG_LABEL_POSTRED)?></label>
                <input type="hidden" name="tw_oauth_token" value="<?=$tw_oauth_token?>"/>
                <input type="hidden" name="tw_oauth_token_secret" value="<?=$tw_oauth_token_secret?>"/>
                <input type="hidden" name="tw_screen_name" value="<?=$tw_screen_name?>"/>
            </div>
            <? } ?>

        </div>
        
    </div>

    <?    
    if (GEOIP_FEATURE == "on") {
    $location_GeoIP = geo_GeoIP();

    if ($location && $location_GeoIP && $facebook_uid) { ?>

    <div id="locationPrefs">

        <div class="left textright">
            <h2><?=system_showText(LANG_LABEL_LOCATIONPREF);?></h2> 				
            <span><?=system_showText(LANG_LABEL_CHOOSELOCATIONPREF);?></span>
        </div>

        <div class="right">
            <div class="cont_checkbox">

                <input id="radio_1" type="radio" name="usefacebooklocation" value="1" style="width:auto" <?=$usefacebooklocation?" checked=\"checked\" ":""?> /> <label for="radio_1"><?=system_showText(LANG_LABEL_USEFACEBOOKLOCATION)?>: <strong> <?=$location?></strong></label>
                <input id="radio_2" type="radio" name="usefacebooklocation" value="0" style="width:auto" <?=!$usefacebooklocation?" checked=\"checked\" ":""?> /> <label for="radio_2" ><?=system_showText(LANG_LABEL_USECURRENTLOCATION)?>: <strong> <?=$location_GeoIP?></strong></label>
                <input type="hidden" name="location" id="location" value="<?=$location?>" />
            </div>     
        </div>

    </div>
    <? }
    } ?>

    <? } ?>


<script>

    <? //Change Currency Script ?>
    
    $( "#currency-type" ).change(function() {
        if($('#currency-type').val().trim() != "Select Currency"){
            var type     = $("#currency-type").val();
            $.ajax({
              method: "POST",
              url: '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>',
              data: {   
                        ajax_type : 'changeCurrency',
                        newVal    : type
                    }
            })
              .done(function( msg ) {
              
            });
        }

    });

</script>