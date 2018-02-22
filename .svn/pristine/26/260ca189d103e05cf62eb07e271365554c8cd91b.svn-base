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
	# * FILE: /theme/diningguide/body/classified/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_classified.php");
	
    if (is_array($array_show_classifieds)) { ?>
    
        <h2>
			<span><?=system_showText(LANG_FEATURED_CLASSIFIED)?></span>
			<? if ($seeAllTextLink && $seeAllText) { ?>
				<a class="view-more" href="<?=$seeAllTextLink?>"><?=$seeAllText;?></a>
            <? } ?>
		</h2>
    
        <div class="special-item">
            
            <div class="image">
                <a href="<?=$array_show_classifieds[0]["detailLink"]?>">
                    <? if ($array_show_classifieds[0]["image_tag"]) { ?>
                        <?=$array_show_classifieds[0]["image_tag"]?>
                    <? } else { ?>
                        <span class="no-image"></span>
                    <? } ?>
                </a>
            </div>
            
            <h3>
                <a href="<?=$array_show_classifieds[0]["detailLink"]?>">
                    <?=$array_show_classifieds[0]["title"]?>
                </a>
            </h3>
            
            <? if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") { ?>
                        
                <p id="showCategory_classified<?=$array_show_classifieds[0]["id"]?>">
                    <a href="javascript: void(0);" onclick="showCategory(<?=$array_show_classifieds[0]["id"]?>, 'classified', true, <?=$array_show_classifieds[0]["account_id"]?>, true)">
                        <?=system_showText(LANG_VIEWCATEGORY)?>
                    </a>
                </p>

            <? } else { ?>

                <p> 
                    <?=$array_show_classifieds[0]["categories"]?> <?=$array_show_classifieds[0]["author_string"]?>
                </p>

            <? } ?>
        </div>
		
        <div class="featured featured-classified">
            
            <?
            $lastItemStyle = 0;
            for ($i = 1; $i < count($array_show_classifieds); $i++) {
                
				$lastItemStyle++;

                if (($lastItemStyle % 2) && ($lastItemStyle != 1)){ ?>
                    <br class="clear" />
                <? } ?>

                <div class="featured-item featured-item-special">

                    <div class="image">
                        <a href="<?=$array_show_classifieds[$i]["detailLink"]?>" class="image">
                            <? if ($array_show_classifieds[$i]["image_tag"]) { ?>
                                <?=$array_show_classifieds[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>
                    </div>

                    <h3>
                        <a href="<?=$array_show_classifieds[$i]["detailLink"]?>">
                            <?=system_showTruncatedText($array_show_classifieds[$i]["title"], 90);?>
                        </a>
                    </h3>

                    <? if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") { ?>

                        <p id="showCategory_classified<?=$array_show_classifieds[$i]["id"]?>">
                            <a href="javascript: void(0);" onclick="showCategory(<?=$array_show_classifieds[$i]["id"]?>, 'classified', true, <?=$array_show_classifieds[$i]["account_id"]?>, true)">
                                <?=system_showText(LANG_VIEWCATEGORY)?>
                            </a>
                        </p>

                    <? } else { ?>

                        <p> 
                            <?=$array_show_classifieds[$i]["categories"]?> <?=$array_show_classifieds[$i]["author_string"]?>
                        </p>

                    <? } ?>
                </div>
            <? } ?>
        </div>
    
<? }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedClassified2-->