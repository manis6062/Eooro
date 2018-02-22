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
	# * FILE: /includes/views/view_event_detail_code_contractors.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div itemscope itemtype="http://schema.org/Event">

        <div class="top-info span12">
            
            <div clas="row-fluid">

                <h3 class="span10" itemprop="name"><?=$event_title;?></h3>
                
                <div class="span2 text-right">
                    
                    <ul class="share-social">
                        <?=$favoritesLink?>
                    </ul>
                    
                </div>

            </div>
            
        </div>

        <div class="row-fluid flex-box-title">

            <article class="top-info span12">

                <div class="span4">
                    <strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong><br />
                    
                    <address><?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?></address>
                    
                    <meta itemprop="startDate" content="<?=$str_date_aux;?>" />

                    <? if ($str_time) { ?>
                        <strong><?=system_showText(LANG_EVENT_TIME)?>:</strong>
                        
                        <address><?=$str_time?></address>
                    <? } ?>

                    <? if ($event_location || $location || $event_address || $event_address2 || $location_map) { ?>
                        <strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong>

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

                </div>

                <div class="span4">

                    <? if ($event_phone) { ?>
                        <strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong>
                        
                        <address><?=$event_phone?></address>
                    <? } ?>

                    <? if ($event_url) { ?>
                        <strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
                        
                        <address>
                            <? if (!$user) {
                                echo "<address class=\"website\"><a href=\"javascript:void(0);\" style=\"cursor:default\">".$dispurl."</a></address>";
                            } else {
                                echo "<address class=\"website\"><a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a></address>";
                            } ?> 
                        </address>
                    <? } ?>

                    <? if ($event_contactName) { ?>
                        <strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong>
                        
                        <address><?=$event_contactName?></address>
                    <? } ?>

                </div>

                <? if ($event_email) { ?>
                    <div class="span4">
                    
                        <a rel="nofollow" href="<?=$contact_email;?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?> btn btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>>
                            <?=system_showText(LANG_SEND_AN_EMAIL);?>
                        </a>

                    </div>
                <? } ?>

            </article>

            <? if ($event_category_tree) { ?>
            <div class="list-categories">
                <?=$event_category_tree?>
            </div>
            <? } ?>

        </div>

        <? 
        $tabOverview = false;
        if ($event_description || $eventGallery) { ?>
        
        <div id="content_overview">
            <?
            $tabActiveOverview = true;
            $tabOverview = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveOverview = false;
            ?>
        </div>
        
        <? } ?>
            
        <? if ($event_description) { ?>   
        <div class="row-fluid flex-box-title">
            <article>
                <p class="long"><?=$event_description?></p>
            </article>
        </div>
        <? } ?>   

         <? if ($event_summarydesc) { ?>
            <meta itemprop="description" content="<?=$event_summarydesc;?>" />
        <? } ?>          

        <? if ($eventGallery) { ?>

            <div class="row-fluid flex-box-title">
                
                <h4><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h4>
                
                <div class="photo-gallery">
                    <? if ($eventGallery) { ?>
                        <div>
                            <?=$eventGallery?>
                        </div>
                    <? } ?>
                </div>

            </div>

        <? } ?>

        <? if ($auxImgPath) { ?>
            <meta itemprop="image" content="<?=$auxImgPath;?>" />
        <? } ?>

        <? if ($event_video_snippet) { ?>

        <div id="content_video" class="area-content">
            <?
            $tabActiveVideo = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveVideo = false;
            ?>
        </div>
      
        <div class="row-fluid flex-box-title">
            <div class="video">
                <script language="javascript" type="text/javascript">
                //<![CDATA[
                    document.write("<?=str_replace("\"","'", $event_video_snippet)?>");
                //]]>
                </script>
            </div>
        </div>

        <? } ?>

    </div>
