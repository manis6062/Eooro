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
	# * FILE: /mobile/listingdetail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
	$listing = new Listing();
    if (!$listing->getListingByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/listings.php");
        exit;
    }

    $levelObj = new ListingLevel(true);

    unset($listingMsg);
    if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
        $listingMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ($listing->getString("status") != "A") {
        $listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } elseif ($levelObj->getDetail($listing->getNumber("level")) != "y" && $levelObj->getActive($listing->getNumber("level")) == "y") {
        $listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } else {
        report_newRecord("listing", $listing->getNumber("id"), LISTING_REPORT_DETAIL_VIEW);
        $listing->setNumberViews($listing->getNumber("id"));
    }
    
    $noCaptcha = true;
    include(EDIRECTORY_ROOT."/includes/code/listingcontact.php");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
	
	if (!$listingMsg) {
		
        $user = true;
        $isMobileDetail = true;
        include(INCLUDES_DIR."/views/view_listing_detail.php");
        
		$module_item_title = $listingtemplate_title;
		include("./breadcrumb.php");
		
?>
	
    <div class="detail">
        
        <div class="thumbnail ">
            
            <div class="row-fluid ">
				
                <h4><?=$listingtemplate_title?></h4>
				
				<? if ($listingtemplate_location || $listingtemplate_phone || $listingtemplate_url) { ?>
                
                    <address>
                        
                        <? if ($listingtemplate_location) { ?>
                            <p>
                                <i class="icon-map-marker"></i> <?=$listingtemplate_location?>
                            </p>
                        <? } ?>

                        <? if ($listingtemplate_phone) { ?>
                            <p>
                                <i class="icon-phone"></i> <?=$listingtemplate_phone?>
                            </p>
                        <? } ?>
                    
                        <? if ($listingtemplate_url) { ?>
                            <p>
                                <i class="icon-globe"></i> <?=$listingtemplate_url?>
                            </p>
                        <? } ?>
					
                    </address>
                    
                <? } ?>
					
                <? if ($location_map) { ?>
                    <div class="map span12 plusmarginb" id="imgLocationMap">
                        <img src="http://maps.google.com/maps/api/staticmap?center=<?=$location_map?>&zoom=15&size=275x130&scale=2&maptype=roadmap&mobile=true&markers=icon:<?=$icon?>|<?=$location_map?>&sensor=false" class="span12 img-polaroid" />
                    </div>
                <? } ?>
				
                <? if ($listingtemplate_gallery) { ?>
                    <strong><?=system_showText(LANG_GALLERYTITLE);?></strong>
                    
                    <hr/> 

                    <div class="gallery">
                        <?=$listingtemplate_gallery;?> 
                    </div> 
                <? } ?>
                
                <? if ($hasDeal) { ?>
                    <br /> 
                    
                    <strong><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?></strong>
                    
                    <hr />

                    <h4><?=$promotionInfo["name"]?></h4>
                    
                    <h4 class="price">
                        <?=CURRENCY_SYMBOL.$promotionInfo["price"].($promotionInfo["cents"] ? "<span class=\"cents\">".$promotionInfo["cents"]."</span>" : "")?> - <?=$promotionInfo["summary_offer"]?>
                    </h4>
                    
                    <div class="deal-info">
                        
                        <div class="img-polaroid pull-left <?=(!$promotionInfo["image"] ? "no-image" : "")?>">
                            <? if ($promotionInfo["image"]) { ?>
                            <a class="group" href="<?=$promotionInfo["url"]?>">
                                <img width="168px" title="<?=$promotionInfo["name"]?>" alt="<?=$promotionInfo["name"]?>" src="<?=$promotionInfo["image"]?>">
                            </a>
                            <? } ?>
                        </div>
                        
                        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.min.js"></script>
                        <script type="text/javascript">
                            //<![CDATA[
                            $(document).ready(function() {
                                newDate = new Date(<?=$promotionDeals['timeleft'][0]?>,<?=($promotionDeals['timeleft'][1]-1)?>,<?=$promotionDeals['timeleft'][2]?>,23,59,59);
                                $('#timeLeft').countdown({
                                    until: newDate,
                                    format:'<?=$format?>',
                                    pluginStyle: false
                                });
                            });
                            //]]>
                        </script>
                        
                        <div class="span8 pull-right">
                            <ul id="timeLeft">
                            </ul>
                            
                            <br />
                            <br />
                            
                            <div class="moreinfo">
                                
                                <strong><?=system_showText(DEAL_ORIGINALVALUE);?>:</strong> <?=$promotionInfo["realValue"];?>
                                <br />
                                
                                <div class="pull-left">
                                    <strong><?=system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL)." ".system_showText(DEAL_LEFTAMOUNT)?>:</strong> <?=$deal_left;?>
                                </div>

                                <div class="pull-left">
                                    <strong><?=system_showText(DEAL_DEALSDONE_PLURAL)?>:</strong> <?=$deal_sold;?>
                                </div>
                                                                   
                            </div>
                        </div>

                    </div>
                    
                    <a class="btn btn-info span12 plusmarginb" href="<?=$promotionInfo["url"]?>"><?=system_showText(LANG_LABEl_VIEW_DEAL);?></a>  
                <? }  ?>
                 
                <br />
                 
                <? if ($listingtemplate_long_description) { ?>
                    <strong><?=system_showText(LANG_LABEL_DESCRIPTION);?></strong>
                    <hr/> 
					<p class="listing-description"><?=$listingtemplate_long_description?></p>
                <? } ?>
				 
                <? if ($listingtemplate_email) { ?> 
                    
                <strong><?=system_showText(LANG_NOTIFY_CONTACTUS)?></strong>    
                
                    <a name="info"></a>
                    
                    <form id="contactForm" name="contactForm" class="contact form-horizontal" method="post" action="<?=system_getFormAction($_SERVER["REQUEST_URI"]."#info")?>">
                        
                        <? foreach ($_GET as $key => $value) print "<input type=\"hidden\" name=\"$key\" value=\"$value\" />"; ?>
                        <input type="hidden" name="id" value="<?=$listing->getNumber("id");?>" />
                        <input type="hidden" name="to" value="<?=string_htmlentities($listing->getString("email"));?>" />
                        
                        <? if ($error) { ?>
                            <p class="<?=$message_style?>"><?=$error?></p>
                        <? } ?>
                        
                        <div class="control-group ">
                            <label class="control-label">* <?=system_showText(LANG_LABEL_NAME);?></label>
                            <div class="controls">
                                <input class="span12" type="text" placeholder="<?=system_showText(LANG_LABEL_NAME);?>" name="name" id="name" value="<?=$name?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">* <?=system_showText(LANG_LABEL_EMAIL)?></label>
                            <div class="controls">
                                <input  class="span12" type="email" placeholder="<?=system_showText(LANG_LABEL_EMAIL)?>" name="from" id="from" value="<?=$from?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?=system_showText(LANG_LABEL_SUBJECT)?></label>
                            <div class="controls">
                                <input  class="span12" type="text"placeholder="<?=system_showText(LANG_LABEL_SUBJECT)?>" name="subject" id="subject" value="<?=$subject?>" />
                            </div>
                        </div>
                        
                        <? $body = str_replace("<br />", "", $body); ?>

                        <div class="control-group">
                            <label class="control-label">* <?=system_showText(LANG_LABEL_MESSAGE)?></label>
                            <div class="controls">
                                <textarea  class="span12" type="text" placeholder="<?=system_showText(LANG_LABEL_ADDITIONALMSG)?>" name="body" id="body"><?=html_entity_decode($body)?></textarea>
                            </div>
                        </div>

                       <div class="control">
                            <button type="submit" class="btn plusmarginb btn-success"><?=LANG_BUTTON_SEND?></button>
                       </div>
                            
                    </form>
                    
                <? } ?>
                    
			</div>
            
		</div>
        
    </div>
        
    <? } else { ?>
        
        <p class="warning"><?=$listingMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>	