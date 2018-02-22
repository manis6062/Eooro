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
	# * FILE: /theme/default/frontend/featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing-->
	<?
	$maxItems = 3;

	$level = implode(",", system_getLevelDetail("ListingLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".($searchReturn["where_clause"] ? $searchReturn["where_clause"]." AND" : "")." (Listing_Summary.level IN (".$level.")) ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".$maxItems;
		$front_featured_listings = db_getFromDBBySQL("listing", $sql, "array");
	}

	if ($front_featured_listings) {

        $ids_report_lote = "";
        $lastItemStyle = 0;
        ?>
            
        <div class="span12 flex-box-group color-3">
                    
            <h2>
                <?=system_showText(LANG_FEATURED_LISTING)?>
                <a rel="canonical" class="view-more" href="<?=LISTING_DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_SEE_ALL);?></a>
            </h2>

            <div class="clearfix"></div>

            <div class="row-fluid">
            
        <?

        foreach ($front_featured_listings as $listing) {

            $lastItemStyle++;
            
            $ids_report_lote .= $listing["id"].",";

            $item_detail = LISTING_DEFAULT_URL."/".$listing["friendly_url"];
            $item_title = $listing["title"];
            if ($lastItemStyle == 1) {
                $item_description = $listing["description"];
            } else {
                $item_description = system_showTruncatedText($listing["description"], 130);
            }

            $imageObj = new Image($listing["image_id"]);
            
            if ($imageObj->imageExists()) {
                $item_image = $imageObj->getTag(false, "", "", $listing["title"], false);
            } else {
                $item_image = "";
            }
            
            if ($lastItemStyle == 1) {
                if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
                    $listing_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($listing["id"]).", 'listing', ".(true).", ".$listing["account_id"].", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    $item_categories = "<p id=\"showCategory_listing".$listing["id"]."\">$listing_moreInfo</p>";

                } else {
                    $item_categories = "<p>".system_itemRelatedCategories($listing["id"], "listing", true)."</p>";
                }
            }
            
            if ($lastItemStyle == 1) { ?>
    
                <div class="row-fluid">
                    <section>
                        <aside>
                            <a href="<?=$item_detail?>" class="image">
                                <? if ($item_image) { ?>
                                    <?=$item_image?>
                                <? } else { ?>
                                    <span class="no-image"></span>
                                <? } ?>
                            </a>
                        </aside>

                        <h5>
                            <a href="<?=$item_detail?>">
                                <?=$item_title?>
                            </a>
                        </h5>

                        <p><?=$item_description?></p>

                        <footer><?=$item_categories;?></footer>

                    </section>

                </div>
                
            <? } else { ?>
                
                <? if ($lastItemStyle == 2) { ?>

                <hr class="box-divisor">

                <div class="row-fluid">
                    
                <? } ?>
                    
                    <div class="span6">
                        <section>
                            <h5>
                                <a href="<?=$item_detail?>">
                                    <?=$item_title?>
                                </a>
                            </h5>
                            <a href="<?=$item_detail?>" class="image">
                                <? if ($item_image) { ?>
                                    <?=$item_image?>
                                <? } else { ?>
                                    <span class="no-image"></span>
                                <? } ?>
                            </a>
                            <p><?=$item_description?></p>
                        </section>
                    </div>
                   
                <? if ($lastItemStyle == count($front_featured_listings)) { ?>
                    
                </div>
                
                <? } ?>
                
            <? } ?>
    
    <? } ?>
          
            </div>

        </div>
                    
        <?
        $ids_report_lote = string_substr($ids_report_lote, 0, -1);
        report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);

	}

	// Preparing markers to full cache
?>
	<!--cachemarkerFeaturedListing-->