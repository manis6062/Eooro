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
	# * FILE: /includes/views/view_event_detail_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/views/view_detail_tabs.php");
    
?>

	<div class="content-main" itemscope itemtype="http://schema.org/Event">
        
        <div class="tab-container">
            
            <div id="content_overview" class="tab-content">
                
                <div class="row-fluid top-info">
                    
                    <div class="span10">
                        <h2 itemprop="name"><?=$event_title;?></h2>
                    </div>
                    
                    <div class="span2 share">
                        <?=$event_icon_navbar?>
                    </div>
                    
                </div>
                
                <div class="row-fluid">
                    <? if ($event_category_tree) { ?>
                        <?=$event_category_tree?>
                    <? } ?>
                </div>
                
                <div class="row-fluid middle-info">
                    
                    <? if ($imageTag || $eventGallery) { ?>
                    
                    <div class="span6">

                        <? if (($imageTag && !$eventGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>
                            <div class="image">
                                <?=$imageTag?>
                            </div>
                        <? } ?>

                        <? if ($eventGallery) { ?>
                        
                        <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "")?> >
                            <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                                <?=$eventGallery?>
                            </div>
                        </section>

                        <? } ?>
                    </div>
                    
                    <? } ?>
                    
                    <div class="span6">
                        
                        <p><strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong></p>
                        <p><?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?></p>

                        <meta itemprop="startDate" content="<?=$str_date_aux;?>" />
                        
                        <? if ($str_time) { ?>
                            <p><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?></p>
                        <? } ?>
                            
                        <br />

                        <? if ($location || $event_address || $event_address2) { ?>

                            <p><strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong></p>
                        
                            <address itemprop="location" itemscope itemtype="http://schema.org/Place">
                        
                        <? } ?>
                                
                        <? if ($event_location) { ?>
                            <meta itemprop="name" content="<?=$event_location?>"/>
                        <? } ?>
                            
                        <? if ($location_map) { ?>
                            <meta itemprop="map" content="<?=$map_link?>"/>
                        <? } ?>
                            
                        <? if ($event_phone) { ?>
                            <meta itemprop="telephone" content="<?=$event_phone?>"/>
                        <? } ?>
                                
                        <? if ($event_address) { ?>
                            <span><?=nl2br($event_address)?></span>
                        <? } ?>

                        <? if ($event_address2) { ?>
                            <span><?=nl2br($event_address2)?></span>
                        <? } ?>

                        <? if ($location) { ?>
                            <span><?=$location?></span>
                        <? } ?>
                            
                        <? if (is_array($snippet_address) && count($snippet_address > 0)) { ?>
                            
                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">  
                            <? if ($event_address) { ?>
                            <meta itemprop="streetAddress" content="<?=$event_address?>" />
                            <? } ?>
                            <? if ($snippet_address["addressCountry"]) { ?>
                            <meta itemprop="addressCountry" content="<?=$snippet_address["addressCountry"]?>" />
                            <? } ?>
                            <? if ($snippet_address["addressRegion"]) { ?>
                            <meta itemprop="addressRegion" content="<?=$snippet_address["addressRegion"]?>" />
                            <? } ?>
                            <? if ($snippet_address["addressLocality"]) { ?>
                            <meta itemprop="addressLocality" content="<?=$snippet_address["addressLocality"]?>" />
                            <? } ?>
                            <? if ($snippet_address["postalCode"]) { ?>
                            <meta itemprop="postalCode" content="<?=$snippet_address["postalCode"]?>" />
                            <? } ?>
                        </div>
                            
                        <? } ?>

                        <? if (($location) || ($event_address) || ($event_address2)) { ?>
                            </address> 
                        <? } ?>
                        
                        <? if ($event_location) { ?>
                            <p><strong><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</strong> <?=nl2br($event_location)?></p>
                        <? } ?>

                        <? if ($location_map) { ?>
                            <? if ($user) { ?>
                                <p><a href="<?=$map_link?>" target="_blank"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
                            <? } else { ?>
                                <p><a href="javascript:void(0);" style="cursor:default"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
                            <? } ?>
                        <? } ?>
                                
                        <br class="clear" />
                        
                        <? if ($event_phone) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=$event_phone?></p>
                        <? } ?>

                        <? if ($event_url) { ?>
                            <p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
                            <? if (!$user) {
                                echo "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$dispurl."</a>";
                            } else {
                                echo "<a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a>";
                            } ?>
                            </p>
                        <? } ?>

                        <? if ($event_email){ ?>
                            <p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
                        <? } ?>	

                        <? if ($event_contactName) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$event_contactName?></p>
                        <? } ?>
                        
                    </div>
                    
                </div>
                
                <div class="row-fluid">
                    
                    <? if ($event_description) { ?>
                        <div class="content-box">
                            <h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
                            <p class="long"><?=$event_description?></p>
                        </div>
                    <? } ?>
                    
                    <? if ($event_summarydesc) { ?>
                        <meta itemprop="description" content="<?=$event_summarydesc;?>" />
                    <? } ?>

                    <? if ($auxImgPath) { ?>
                        <meta itemprop="image" content="<?=$auxImgPath;?>" />
                    <? } ?>
                    
                </div>
                
            </div>
            
            <div id="content_video" class="tab-content" <?=$activeTab == "video"? "style=\"\"": "style=\"display: none;\"";?>>

                <div class="row-fluid">
                    
                    <div class="span12">
                        <h2><?=$event_title?></h2>
                    </div>
                    
                    <div class="video">
                        <script language="javascript" type="text/javascript">
                        //<![CDATA[
                        document.write("<?=str_replace("\"","'",$event_video_snippet)?>");
                        //]]>
                        </script>
                    </div>
                    
                </div>

            </div>
            
        </div>
	
	</div>