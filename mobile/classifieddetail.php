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
	# * FILE: /mobile/classifieddetail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	
    $classified = new Classified();
    if (!$classified->getClassifiedByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/classifieds.php");
        exit;
    }
    
    $levelObj = new ClassifiedLevel(true);
    
    unset($classifiedMsg);
    if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
        $classifiedMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ($classified->getString("status") != "A") {
        $classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } elseif ($levelObj->getDetail($classified->getNumber("level")) != "y" && $levelObj->getActive($classified->getNumber("level")) == "y") {
        $classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } else {
        report_newRecord("classified", $classified->getNumber("id"), CLASSIFIED_REPORT_DETAIL_VIEW);
        $classified->setNumberViews($classified->getNumber("id"));
    }
		
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
	
	if (!$classifiedMsg) {
		
		$user = true;
        $isMobileDetail = true;
        include(INCLUDES_DIR."/views/view_classified_detail.php");
        
		$module_item_title = $classified_title;
		include("./breadcrumb.php"); 
			       
?>
    
    <div class="detail">
        
        <div class="thumbnail ">
            
            <div class="row-fluid ">

                <h4><?=$classified_title;?></h4>
                
                <? if ($classified_price != 'NULL' && $classified_price != '') { ?>
                    <h4 class="price"><?=CURRENCY_SYMBOL." ".$classified_price;?></h4>
                <? } ?>

                <? if ($location || $classified_phone) { ?>    
                    <address>
                        <? if ($location) { ?>
                        <p>
                            <i class="icon-map-marker"></i>  <?=$location?> 
                        </p>
                        <? } ?>

                        <? if ($classified_phone) { ?>
                        <p>
                            <i class="icon-phone"></i> <?=$classified_phone?>
                        </p>
                        <? } ?>
                    </address>
                <? } ?>

                <? if ($location_map) { ?>
                    <div class="map span12 plusmarginb">
                        <img src="http://maps.google.com/maps/api/staticmap?center=<?=$location_map?>&zoom=15&size=275x130&maptype=roadmap&mobile=true&markers=icon:<?=$icon?>|<?=$location_map?>&sensor=false" class="span12 img-polaroid" />
                    </div>
                <? } ?>

                <? if ($classifiedGallery) { ?>
                    <strong><?=system_showText(LANG_GALLERYTITLE);?></strong>
                    
                    <hr/> 

                    <div class="gallery">
                        <?=$classifiedGallery;?> 
                    </div> 
                <? } ?>
                
                <br/>

                <? if ($classified_description) { ?>
                    <strong><?=system_showText(LANG_LABEL_DESCRIPTION);?></strong>
                    <hr/> 
					<p class="listing-description"><?=$classified_description?></p>
                <? } ?>

            </div>
            
        </div>
        
    </div>

    <? } else { ?>
        
        <p class="warning"><?=$classifiedMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>