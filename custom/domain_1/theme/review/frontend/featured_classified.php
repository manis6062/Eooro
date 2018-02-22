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
	# * FILE: /theme/default/frontend/featured_classified.php
	# ----------------------------------------------------------------------------------------------------
	
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

        # ----------------------------------------------------------------------------------------------------
        # CODE
        # ----------------------------------------------------------------------------------------------------

        $maxItems = 1;

        $level = implode(",", system_getLevelDetail("ClassifiedLevel"));

        if ($level) {
            unset($searchReturn);
            $searchReturn = search_frontClassifiedSearch($_GET, "random");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".($searchReturn["where_clause"] ? $searchReturn["where_clause"]." AND" : "")." (Classified.level IN (".$level.")) ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ORDER BY `random_number` LIMIT ".$maxItems."";
            $front_featured_classifieds = db_getFromDBBySQL("classified", $sql, "array");
        }

        if ($front_featured_classifieds) {

            $ids_report_lote = "";

            foreach ($front_featured_classifieds as $classified) {

                $ids_report_lote .= $classified["id"].",";

                $item_detail = CLASSIFIED_DEFAULT_URL."/".$classified["friendly_url"];
                $item_title = $classified["title"];
                $item_description = system_showTruncatedText($classified["summarydesc"], 130);
                $item_price = ($classified["classified_price"] ? CURRENCY_SYMBOL.$classified["classified_price"] : "");

                $imageObj = new Image($classified["image_id"]);

                if ($imageObj->imageExists()) {
                    $item_image = $imageObj->getTag(false, "", "", $classified["title"], false);
                } else {
                    $item_image = "";
                }

                ?>
                   
                <div class="flex-box color-2">
                    
                    <h2><?=system_showText(LANG_FEATURED_CLASSIFIED_SING)?><?=($item_price ? "<span>$item_price</span>" : "")?></h2>

                    <a href="<?=$item_detail?>" class="image">
                        <? if ($item_image) { ?>
                            <?=$item_image?>
                        <? } else { ?>
                            <span class="no-image"></span>
                        <? } ?>
                    </a>

                    <section>
                        <h5>
                            <a href="<?=$item_detail?>">
                                <?=$item_title?>
                            </a>
                        </h5>

                        <p><?=$item_description?></p>
                    </section>

                </div>
    
                <?
                

            }
            $ids_report_lote = string_substr($ids_report_lote, 0, -1);
            report_newRecord("classified", $ids_report_lote, CLASSIFIED_REPORT_SUMMARY_VIEW, true);

        }
    }

    // Preparing markers to full cache
?>
    <!--cachemarkerFeaturedClassified-->