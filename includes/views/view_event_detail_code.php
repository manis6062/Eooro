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
	# * FILE: /includes/views/view_event_detail_code.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/views/view_detail_tabs.php");

?>

    <div class="tab-container" itemscope itemtype="http://schema.org/Event">

        <div id="content_overview" class="tab-content">

            <div class="top-info span12">
                
                <div clas="row-fluid">
                    <h3 class="span10" itemprop="name"><?=$event_title;?></h3>
                    
                    <div class="span2 share-middle text-right">
                        <?=$event_icon_navbar?>
                    </div>
                </div>
                
            </div>

            <div class="row-fluid">
                
                <? if ($event_category_tree) { ?>
                <div class="span12 top-info">
                    <?=$event_category_tree?>
                </div>
                <? } ?>
                
            </div>

            <div class="row-fluid middle-info">

                <? if ($imageTag || $eventGallery) { ?>

                <div class="span7">

                    <? if (($imageTag && !$eventGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>
                        <div class="image">
                            <?=$imageTag?>
                        </div>
                    <? } ?>

                    <? if ($eventGallery) { ?>
                     <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "class=\"gallery-overview\"")?> >
                        <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                            <?=$eventGallery?>
                        </div>
                    </section>
                    <? } ?>
                </div>

                <? } ?>

                <div class="span5">

                    <strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong><br />
                    
                    <?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?> <br />
                    
                    <meta itemprop="startDate" content="<?=$str_date_aux;?>" />

                    <? if ($str_time) { ?>
                            <br /><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?> <br />
                    <? } ?>

                    <? if ($event_location || $location || $event_address || $event_address2 || $location_map) { ?>

                        <br /><strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong>

                        <address itemprop="location" itemscope itemtype="http://schema.org/Place">

                    <? } ?>
                            
                    <? if ($event_location) { ?>
                        <span itemprop="name"><?=$event_location?></span><br />
                    <? } ?>
                        
                    <? if ($event_phone) { ?>
                        <meta itemprop="telephone" content="<?=$event_phone?>"/>
                    <? } ?>

                    <? if ($event_address) { ?>
                        <span><?=nl2br($event_address)?></span><br />
                    <? } ?>

                    <? if ($event_address2) { ?>
                        <span><?=nl2br($event_address2)?></span><br />
                    <? } ?>

                    <? if ($location) { ?>
                        <span><?=$location?></span><br />
                    <? } ?>
                        
                    <? if ($location_map) { ?>
                        <? if ($user) { ?>
                            <a href="<?=$map_link?>" itemprop="map" target="_blank"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?></a><br />
                        <? } else { ?>
                            <a href="javascript:void(0);" style="cursor:default"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?></a><br />
                        <? } ?>
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

                    <? if ($event_location || $location || $event_address || $event_address2 || $location_map) { ?>
                        </address>
                    <? } ?>

                    <? if ($event_phone) { ?>
                        <strong><?=system_showText(LANG_LABEL_PHONE)?>:<br /></strong><?=$event_phone?><br />
                    <? } ?>

                    <? if ($event_url) { ?>
                       <br /><strong><?=system_showText(LANG_EVENT_WEBSITE)?>: <br /></strong>
                        
                        <? if (!$user) {
                            echo "<address class=\"website\"><a href=\"javascript:void(0);\" style=\"cursor:default\">".$dispurl."</a></address>";
                        } else {
                            echo "<address class=\"website\"><a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a></address>";
                        } ?> 

                    <? } ?>

                    <? if ($event_contactName) { ?>
                        <br /><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong><br /> <?=$event_contactName?> <br />
                    <? } ?>
                        
                    <? if ($event_email){ ?>
                        <br /><a rel="nofollow" href="<?=$contact_email;?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?> btn btn-large btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>>
                            <?=system_showText(LANG_SEND_AN_EMAIL);?>
                        </a>
                    <? } ?>

                </div>

            </div>

            <div class="row-fluid">

                <? if ($event_description) { ?>
                    <div class="content-box">
                        <h4><?=system_showText(LANG_LABEL_DESCRIPTION);?></h4>
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

                <div class="span12 top-info">
                    <h3><?=$event_title?></h3>
                </div>

                <div class="video">
                    <script language="javascript" type="text/javascript">
                    //<![CDATA[
                    document.write("<?=str_replace("\"","'", $event_video_snippet)?>");
                    //]]>
                    </script>
                </div>

            </div>

        </div>

    </div>