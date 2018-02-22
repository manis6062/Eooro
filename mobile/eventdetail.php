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
	# * FILE: /mobile/eventdetail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	
    $event = new Event();
    if (!$event->getEventByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/events.php");
        exit;
    }
    
    $levelObj = new EventLevel(true);
    
    unset($eventMsg);
    if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
        $eventMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ($event->getString("status") != "A") {
        $eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } elseif ($levelObj->getDetail($event->getNumber("level")) != "y" && $levelObj->getActive($event->getNumber("level")) == "y") {
        $eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } else {
        report_newRecord("event", $event->getNumber("id"), EVENT_REPORT_DETAIL_VIEW);
        $event->setNumberViews($event->getNumber("id"));
    }
		
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
	
	if (!$eventMsg) {
		
		$user = true;
        $isMobileDetail = true;
        include(INCLUDES_DIR."/views/view_event_detail.php");
        
		$module_item_title = $event_title;
		include("./breadcrumb.php"); 
			       
?>
    
    <div class="detail">
        
        <div class="thumbnail ">
            
            <div class="row-fluid ">

                <h4><?=$event_title;?></h4>
                
                <h5 class="eventDateTime">
                    
                <?=system_showText(LANG_EVENT_WHEN);?>:<span> <?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?></span><br />

                <? if ($str_time) { ?>
                    <?=system_showText(LANG_EVENT_TIME);?>: <span><?=$str_time?></span><br />
                <? } ?>
                    
                <? if ($event_location) { ?>
                    <?=system_showText(LANG_SEARCH_LABELLOCATION)?>: <span><?=$event_location?></span>
				<? } ?>
                    
                </h5>
                
                <? if ($location || $event_phone || $event_url ) { ?>    
                    <address>
                        <? if ($location) { ?>
                        <p>
                            <i class="icon-map-marker"></i>  <?=$location?> 
                        </p>
                        <? } ?>
                        
                        <? if($event_url) { ?>
                            <p>
                                <i class="icon-globe"></i> <?="<a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a>"?>
                            </p>
                        <? } ?>
                            
                        <? if ($event_phone) { ?>
                            <p>
                                <i class="icon-phone"></i> <?=$event_phone?>
                            </p>
                        <? } ?>
                    </address>
                <? } ?>

                <? if ($location_map) { ?>
                    <div class="map span12 plusmarginb">
                        <img src="http://maps.google.com/maps/api/staticmap?center=<?=$location_map?>&zoom=15&size=275x130&maptype=roadmap&mobile=true&markers=icon:<?=$icon?>|<?=$location_map?>&sensor=false" class="span12 img-polaroid" />
                    </div>
                <? } ?>
                    
                <? if ($eventGallery) { ?>
                    <strong><?=system_showText(LANG_GALLERYTITLE);?></strong>
                    
                    <hr/> 

                    <div class="gallery">
                        <?=$eventGallery;?> 
                    </div> 
                <? } ?>
                
                <br/>

                <? if ($event_description) { ?>
                    <strong><?=system_showText(LANG_LABEL_DESCRIPTION);?></strong>
                    <hr/> 
					<p class="listing-description"><?=$event_description?></p>
                <? } ?>

            </div>
            
        </div>
        
    </div>

    <? } else { ?>
        
        <p class="warning"><?=$eventMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>