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
	# * FILE: /signup.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    unset($level);
    
    if ($signupItem == "listing") {
        $sitecontentSection = "Listing Advertisement";
        $level = new ListingLevel();
        $levelTable = "ListingLevel";
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
        $levelsWithClickToCall = system_retrieveLevelsWithInfoEnabled("has_call");
    } elseif ($signupItem == "event") {
        $sitecontentSection = "Event Advertisement";
        $level = new EventLevel();
        $levelTable = "EventLevel";
    } if ($signupItem == "classified") {
        $sitecontentSection = "Classified Advertisement";
        $level = new ClassifiedLevel();
        $levelTable = "ClassifiedLevel";
    } if ($signupItem == "article") {
        $sitecontentSection = "Article Advertisement";
        $level = new ArticleLevel();
        $levelTable = "ArticleLevel";
    } if ($signupItem == "banner") {
        $sitecontentSection = "Banner Advertisement";
        $level = new BannerLevel();
        $levelTable = "BannerLevel";
    }
    if( EDIR_THEME !== 'review' ) {
        $contentObj = new Content();
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"content-custom\">".$content."</div>";
		echo "</blockquote>";
	}
    }
   

	$activeLevels = $level->getLevelValues();
       
    if (!$dbObj) {
        $dbMain = db_getDBObject(DEFAULT_DB, false);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    }
    
    //Get popular level
    unset($popularLevel);
    if ($signupItem != "article") {
        $sql = "SELECT value FROM $levelTable WHERE active = 'y' AND theme = '".EDIR_THEME."' AND popular = 'y' LIMIT 1";
        $rowLevel = mysql_fetch_assoc($dbObj->query($sql));
        $popularLevel = $rowLevel["value"];
    }
    
    //Use 4 columns special layout
    $useLowerLevel = false;
    unset($lowerLevel);
    if ($signupItem != "article" && $signupItem != "banner") {
        if (count($activeLevels) == 4) {
            $useLowerLevel = true;

            setting_get("contact_email", $contact_email);
            setting_get("contact_phone", $contact_phone);

            //Get lower level       
            $sql = "SELECT value FROM $levelTable WHERE active = 'y' AND theme = '".EDIR_THEME."' AND popular != 'y' ORDER BY price LIMIT 1";

            $rowLevel = mysql_fetch_assoc($dbObj->query($sql));
            $lowerLevel = $rowLevel["value"];

            //Reorder levels array
            if ($popularLevel) {
                $aux_activeLevels = array();
                $posArray = 0;
                foreach ($activeLevels as $levelValue) {
                    if ($levelValue != $popularLevel && $levelValue != $lowerLevel) {
                        $aux_activeLevels[$posArray] = $levelValue;
                        $posArray = 2;
                    }
                }
                $aux_activeLevels[1] = $popularLevel;
                $aux_activeLevels[3] = $lowerLevel;
                ksort($aux_activeLevels);
                $activeLevels = $aux_activeLevels;
            }

        //Use 3 columns layout
        } elseif($popularLevel) {
            //Reorder levels array
            $aux_activeLevels = array();
            $posArray = 0;
            foreach ($activeLevels as $levelValue) {
                if ($levelValue != $popularLevel && $levelValue != $lowerLevel) {
                    $aux_activeLevels[$posArray] = $levelValue;
                    $posArray = 2;
                }
            }
            $aux_activeLevels[1] = $popularLevel;
            ksort($aux_activeLevels);
            $activeLevels = $aux_activeLevels;
        }
    }
    
    //Prepare available features
    $review_enabled = "";
    if ($signupItem == "listing" || $signupItem == "article") {
        setting_get("commenting_edir", $commenting_edir);
        setting_get("review_{$signupItem}_enabled", $review_enabled);
    }
    
    $availableFeatures = array();
    
    //Title/Address
    if ($signupItem == "article") {
        $availableFeatures[] = "title";
    } else {
        $availableFeatures[] = "title_address";
    }
    
    //Review
    if ($review_enabled == "on" && $commenting_edir) {
        $availableFeatures[] = "review";
    }
    
    //Detail View
    $availableFeatures[] = "detail_view";
    
    if ($signupItem == "listing" ) {
        
        //Backlink
        if (BACKLINK_FEATURE == "on") {
            $availableFeatures[] = "backlink";
        }
        
        //Deal
        if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
            $availableFeatures[] = "deal";
        }
        
        //Click to Call / Send to phone
        if (TWILIO_APP_ENABLED == "on") {
            if (TWILIO_APP_ENABLED_SMS == "on") {
                $availableFeatures[] = "send_to_phone";
            }
            if (TWILIO_APP_ENABLED_CALL == "on") {
                $availableFeatures[] = "click_to_call";
            }
        }
    }
    
    //General features

    if ($signupItem != "classified" && $signupItem != "article") {
        $availableFeatures[] = "phone";
    }
    if ($signupItem == "event" || $signupItem == "classified") {
        $availableFeatures[] = "contact_name";
    }
    if ($signupItem == "classified") {
        $availableFeatures[] = "contact_phone";
        $availableFeatures[] = "contact_email";
        $availableFeatures[] = "price";
    }
    if ($signupItem != "classified" && $signupItem != "article") {
        $availableFeatures[] = "email";
    }
    if ($signupItem != "article") {
        $availableFeatures[] = "url";
    }
    if ($signupItem == "event") {
        $availableFeatures[] = "event_time";
    }
    if ($signupItem == "listing" || $signupItem == "classified") {
        $availableFeatures[] = "fax";
    }
    if ($signupItem == "article") {
        $availableFeatures[] = "publication";
        $availableFeatures[] = "author";
        $availableFeatures[] = "abstract";
        $availableFeatures[] = "content";
    } else {
         $availableFeatures[] = "summary_description";
    }
    if ($signupItem == "listing") {
        $availableFeatures[] = "badges";
    }
    if ($signupItem != "article") {
        $availableFeatures[] = "long_description";
    }
    $availableFeatures[] = "main_image";
    if ($signupItem == "listing" || $signupItem == "event") {
        $availableFeatures[] = "video";
    }
    if ($signupItem == "listing") {
        $availableFeatures[] = "attachment_file";
        $availableFeatures[] = "hours_of_work";
        $availableFeatures[] = "locations";
        if (THEME_LISTING_FBPAGE) {
            $availableFeatures[] = "fbpage";
        }
        if (THEME_LISTING_FEATURES) {
            $availableFeatures[] = "features";
        }
    }

	$countLevels = 0;
	foreach ($activeLevels as $levelValue) {
        $countLevels++;
		
		if ($level->getPrice($levelValue) > 0) {
			$price = $level->getPrice($levelValue);
                        $priceAux = explode(".", $price);

			$priceRenewal = "";
			if (payment_getRenewalCycle($signupItem) > 1) {
				$priceRenewal .= payment_getRenewalCycle($signupItem)." ";
				$priceRenewal .= payment_getRenewalUnitNamePlural($signupItem);
			} else {
				$priceRenewal .= payment_getRenewalUnitName($signupItem);
			}
			if ($payment_tax_status == "on") {
				$priceTax = "+".$payment_tax_value."% ".$payment_tax_label;
				$priceTax .= " (".CURRENCY_SYMBOL.payment_calculateTax($level->getPrice($levelValue), $payment_tax_value).")";
			}
		} else {
			$price = system_showText(LANG_FREE);
            $priceAux = explode(".", $price);
            $priceRenewal = "";
            if ($payment_tax_status == "on") {
                $priceTax = system_showText(LANG_ADVERTISE_NOTAX);
            }
		}
        
            if ($signupItem == "banner") {
                if ($level->getImpressionPrice($levelValue) > 0) {
                    $priceImp = $level->getImpressionPrice($levelValue);
                    $priceImpAux = explode(".", $priceImp);

                    $priceRenewalImp = $level->getImpressionBlock($levelValue)." ".system_showText(LANG_IMPRESSIONS);

                    if ($payment_tax_status == "on") {
                        $priceTaxImp = "+".$payment_tax_value."% ".$payment_tax_label;
                        $priceTaxImp .= " (".CURRENCY_SYMBOL.payment_calculateTax($level->getImpressionPrice($levelValue), $payment_tax_value).")";
                    }
                } else {
                    $priceImp = system_showText(LANG_FREE);
                    $priceImpAux = explode(".", $priceImp);
                    $priceRenewalImp = "";
                    if ($payment_tax_status == "on") {
                        $priceTaxImp = system_showText(LANG_ADVERTISE_NOTAX);
                    }
                }

            }

            //Get fields from each level
            if ($signupItem != "article" && $signupItem != "banner") {

                $auxDefaultFields = array();
                if ($signupItem == "article") {
                    $auxDefaultFields[] = "title";
                } else {
                    $auxDefaultFields[] = "title_address";
                }

                //Review
                if ($signupItem == "article") {
                    $auxDefaultFields[] = "review";
                } elseif ($signupItem == "listing" && is_array($levelsWithReview) && in_array($levelValue, $levelsWithReview)) {
                    $auxDefaultFields[] = "review";
                }

                //Detail View
                if ($level->getDetail($levelValue) == "y") {
                    $auxDefaultFields[] = "detail_view";
                }

                //Click to Call / Send to phone
                if ($signupItem == "listing" ) {

                    if ($level->getBacklink($levelValue) == "y") {
                        $auxDefaultFields[] = "backlink";
                    }

                    if ($level->getHasPromotion($levelValue) == "y") {
                        $auxDefaultFields[] = "deal";
                    }

                    if ($signupItem == "listing" && is_array($levelsWithSendPhone) && in_array($levelValue, $levelsWithSendPhone)) {
                        $auxDefaultFields[] = "send_to_phone";
                    }
                    if ($signupItem == "listing" && is_array($levelsWithClickToCall) && in_array($levelValue, $levelsWithClickToCall)) {
                        $auxDefaultFields[] = "click_to_call";
                    }
                }

                ${"array_fields_".$levelValue} = system_getFormFields(ucfirst($signupItem), $levelValue);
                if (!${"array_fields_".$levelValue}) {
                    ${"array_fields_".$levelValue} = array();
                }
                ${"array_fields_".$levelValue} = array_merge(${"array_fields_".$levelValue}, $auxDefaultFields);
            }

		?>
    <? if( EDIR_THEME === 'review' ) {
            $signupClass = array( '10' => 'singupwrapper2', '30' => '', '50' => '', '70' => '' );
            $getStartedClass = array( '10' => 'getstarted2', '30' => '', '50' => '', '70' => '' );
            include( system_getFrontendPath('review_advertise.php') );
        }
        else {
    ?>	
        <? if ($useLowerLevel && $levelValue == $lowerLevel ? "lower-level" : "") { ?>
            <div class="lower-level <?=(!$popularLevel ? "up" : "")?>">
        <? } ?>

		<div id="content<?=ucfirst($signupItem)?>Level_<?=$levelValue?>" class="pricinglevel <?=($levelValue == $popularLevel ? "most-popular" : "")?>">

			<hgroup>
                
                <? if ($levelValue == $popularLevel) { ?>
                    <h5><?=system_showText(LANG_ADVERTISE_POPULAR);?></h5>
                <? } ?>

                <? if ($signupItem != "banner") { ?>  
                    <h1>
                        <?=(is_numeric($priceAux[0]) ? "<small>".CURRENCY_SYMBOL."</small>" : "");?><?=$priceAux[0];?><?=($priceAux[1] && $priceAux[1] != "00" ? "<small>.".$priceAux[1]."</small>" : "")?><?=($priceRenewal ? "<span> / $priceRenewal</span>" : "<span>&nbsp;</span>");?>
                    </h1>
                <? } ?>  

                <? if ($signupItem == "banner") { ?>
                    <h2>
                        <?=(is_numeric($priceAux[0]) ? "<small>".CURRENCY_SYMBOL."</small>" : "");?><?=$priceAux[0];?><?=($priceAux[1] && $priceAux[1] != "00" ? "<small>.".$priceAux[1]."</small>" : "")?><?=($priceRenewal ? "<span> / $priceRenewal</span>" : "<span>&nbsp;</span>");?>
                    </h2>

                    <? if ($priceTax) { ?>
                        <h6><?=$priceTax;?></h6>
                    <? } ?>
                        
                    <em><span><?=system_showText(LANG_OR);?><span></em>
                        
                    <h3>
                        <?=(is_numeric($priceImpAux[0]) ? "<small>".CURRENCY_SYMBOL."</small>" : "");?><?=$priceImpAux[0];?><?=($priceImpAux[1] && $priceImpAux[1] != "00" ? "<small>.".$priceImpAux[1]."</small>" : "")?><?=($priceRenewalImp ? "<span> / $priceRenewalImp</span>" : "<span>&nbsp;</span>");?>
                    </h3>
                        
                    <? if ($priceTaxImp) { ?>
                        <h6><?=$priceTaxImp;?></h6>
                    <? } ?>
                    
                <? } else { ?>
                    
                    <? if ($priceTax) { ?>
                        <h6><?=$priceTax;?></h6>
                    <? } ?>
                        
                <? } ?>

                <? if ($signupItem != "article") { ?>

                <h4>

                    <?=ucfirst($level->getName($levelValue));?>
                    
                    <? if ($signupItem == "banner") { ?>
                        <br><?=system_showText(LANG_ADVERTISE_SIZE)?>: <?=$level->getWidth($levelValue);?> X <?=$level->getHeight($levelValue);?>
                    <? } ?>

                </h4>

                <? } ?>
                
                <? if ($signupItem == "banner") {
                
                    $auxName = string_strtolower($level->getName($levelValue, true));
                    $auxName = str_replace(" ", "", $auxName);

                    if (file_exists(EDIRECTORY_ROOT."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif")){
                        $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif";
                    } else {
                        $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName.".gif";
                    }
                    ?>
            
                    <a href="<?=$bannerImgScr?>" class="fancy_window_preview_banner text-underline"><?=system_showText(LANG_ADVERTISE_SAMPLE);?></a>
            
                <? } else { ?>
                        
                    <a href="<?=DEFAULT_URL."/popup/popup.php?pop_type=advertise_preview&amp;modulePreview=$signupItem&amp;level=$levelValue"?>" class="fancy_window_preview text-underline"><?=system_showText(LANG_ADVERTISE_SAMPLE);?></a>
                
                <? } ?>
                
			</hgroup>
			
			<a class="btn btn-success btn-caps" href="<?=DEFAULT_URL?>/order_<?=$signupItem?>.php?<?=$signupItem == "banner" ? "type" : "level"?>=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a>
			
            <? if ((!$useLowerLevel || ($useLowerLevel && $levelValue != $lowerLevel))) { ?>
            
                <ul>
                    
                    <? if ($level->getContent($levelValue)) {
                        
                        echo string_nl2li(strip_tags($level->getContent($levelValue)));
                        
                    } elseif ($signupItem != "banner") {

                        foreach ($availableFeatures as $item) {
                            
                            if ($item == "event_time") {
                                $item = "start_time";
                            }
                            ?>
                    
                            <li <?=((is_array(${"array_fields_".$levelValue}) && in_array($item, ${"array_fields_".$levelValue}) || $signupItem == "article") ? "" : "class=\"disabled\"")?>><?=@constant("LANG_ADVERTISE_LIST_".strtoupper($item))?></li>
                            
                        <? } ?>
                        
                    <? } ?>
                        
                </ul>
            
            <? } ?>
		
		</div>
                
        <? if ($useLowerLevel && $levelValue == $lowerLevel ? "lower-level" : "") {
            
            if ($contact_email || $contact_phone) { ?>
              
                <div class="contact-info">
                    <h2><?=LANG_ADVERTISE_QUESTIONS;?></h2>
                    <hr>
                    <h2><?=LANG_ADVERTISE_CONTACT;?></h2>
                    <p><?=$contact_phone;?></p>
                    <p id="contactSidebarInfo_noicon"></p>
                </div>
                
            <? } ?>
            
            </div>
                
        <? } ?>

        <? } ?>
    <? } ?>

<!-- for review theme only -->
<? if ( EDIR_THEME === 'review' ){ ?>
<div class="hidden">
<div class="col-sm-3 child">
            <!--<div class="row">-->
    <div class="thumbnail onedollarwrapper">
        <h4><?=CURRENCY_SYMBOL.'0 ';?>
            <span class="onetime">
                <?echo '/ year';?>
            </span>
            </h4>
<div class="signup">
            <div class="singupwrapper <?=$signupClass[$levelValue]?>">
                <h5><a href="javascript:void(0)">Free</a></h5>
            </div> <!--/singupwrapper-->
        </div>
        <div class="getstarted <?=$getStartedClass[$levelValue]?>">
            <p>GET STARTED</p>
        </div><!--/getstarted-->
        <ul class="example">
            <li>
                <p>
                <span class="nothing">Do nothing</span>, if the data we have is correct simply point your 
                customers to your page on eooro and let them start telling 
                others about how good you are. <br><br><span class="nothing">Nothing to lose</span>, its Free
                </p>
            </li>

        </ul><!--/example-->

    </div><!--/onedollarwrapper-->

    <!--</div>-->
    <!--/row-->
</div><!--/col-sm-3-->
</div>



<? } ?>
