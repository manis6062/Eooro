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
    # * FILE: /theme/default/frontend/featured_promotion.php
    # ----------------------------------------------------------------------------------------------------

    // Preparing markers to Full Cache
    ?>
    <!--cachemarkerFeaturedDeal-->
    <?
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION) {

        $maxItems = 1;

        unset($searchReturn);
        $searchReturn = search_frontPromotionsearch($_GET, "random");
        $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".($searchReturn["where_clause"] ? "WHERE ".$searchReturn["where_clause"] : "")." ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ".($searchReturn["order_by"] ? "ORDER BY ".$searchReturn["order_by"] : "")." LIMIT ".$maxItems;
        $front_featured_promotions = db_getFromDBBySQL("promotion", $sql, "array");

        if ($front_featured_promotions) {
            
            $ids_report_lote = "";
            $level = new ListingLevel();

            foreach ($front_featured_promotions as $promotion) {

                $ids_report_lote .= $promotion["id"].",";

                $item_price = string_substr($promotion["dealvalue"], 0, (string_strpos($promotion["dealvalue"], ".")));
                $item_cents = string_substr($promotion["dealvalue"], (string_strpos($promotion["dealvalue"], ".")), 3);
                if ($item_cents == ".00") {
                    $item_cents = "";
                }
                if (!$item_price && !$item_cents) {
                    $item_price = system_showText(LANG_FREE);
                }
                
                if ($promotion["realvalue"] > 0) {
                    $item_offer = round(100-(($promotion["dealvalue"]*100)/$promotion["realvalue"]))."%";
                } else {
                    $item_offer = "100%";
                }
                
                $item_detail = PROMOTION_DEFAULT_URL."/".$promotion["friendly_url"];
                $item_title = $promotion["name"];
                
                $item_description = $promotion["description"];
                
                $imageObj = new Image($promotion["image_id"]);
            
                if ($imageObj->imageExists()) {
                    $item_image = $imageObj->getTag(false, "", "", $promotion["name"], false);
                } else {
                    $item_image = "";
                }
                
                //Listing Information
                $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion["id"]), 1, "", "array");
                if ($listing["title"]) {
                    if ($level->getDetail($listing["level"]) == "y") {
                        $item_listing_link = "".LISTING_DEFAULT_URL."/".$listing["friendly_url"];
                    } else {
                        $item_listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing["id"];
                    }
                    $item_listing_title = $listing["title"];
                }
                $item_listing_categories = "";
                if (LISTING_SCALABILITY_OPTIMIZATION != "on") {
                    $item_listing_categories = system_itemRelatedCategories($listing["id"], "deal", true);
                }
                
                ?>
                    
                <div class="span12 flex-box color-1">
                    
                    <h2>
                        <?=system_showText(LANG_FEATURED_PROMOTION_SING);?>
                        <span><?=((is_numeric($item_price) ? CURRENCY_SYMBOL : "").$item_price.$item_cents)?><b class="divisor"></b><?=$item_offer." ".system_showText(LANG_DEAL_OFF);?></span>
                    </h2>
                    
                    <div class="row-fluid">
                        
                        <div class="span12 row-fluid">
                            
                            <aside class="span8">
                                
                                <a href="<?=$item_detail?>" class="image">
                                    <? if ($item_image) { ?>
                                        <?=$item_image?>
                                    <? } else { ?>
                                        <span class="no-image"></span>
                                    <? } ?>                              
                                    <span>
                                        <h4><?=$item_title;?></h4>
                                    </span>
                                </a>

                            </aside>
                            
                            <section>
                                
                                <h5>
                                    <a href="<?=$item_detail?>">
                                        <?=$item_listing_title?>
                                    </a>
                                </h5>
                                
                                <p><?=$item_description?></p>
                                
                                <? if ($item_listing_categories) { ?>
                                <footer>
                                    <p><?=$item_listing_categories;?></p>
                                </footer>
                                <? } ?>
                                
                            </section>
                            
                        </div>
                        
                    </div>

                </div>
    
                <?
                
            }
            $ids_report_lote = string_substr($ids_report_lote, 0, -1);
            report_newRecord("promotion", $ids_report_lote, PROMOTION_REPORT_SUMMARY_VIEW, true);
                
        }
    }
    // Preparing markers to full cache
    ?>
    <!--cachemarkerFeaturedDeal-->