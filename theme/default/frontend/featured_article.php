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
	# * FILE: /theme/default/frontend/featured_article.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedArticle-->
	<?
    
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

		# ----------------------------------------------------------------------------------------------------
		# CODE
		# ----------------------------------------------------------------------------------------------------

		$maxItems = 1;

		$level = implode(",", system_getLevelDetail("ArticleLevel"));

		if ($level) {
			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "random");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".($searchReturn["where_clause"] ? $searchReturn["where_clause"]." AND" : "")." (Article.level IN (".$level.")) ".($searchReturn["group_by"] ? "GROUP BY ".$searchReturn["group_by"] : "")." ORDER BY `publication_date` DESC, `random_number` LIMIT ".$maxItems;
            $array_articles = db_getFromDBBySQL("article", $sql, "array");
		}

		if ($array_articles) {

            $ids_report_lote = "";
            
            foreach ($array_articles as $article) {

                $ids_report_lote .= $article["id"].",";

                $item_detail = ARTICLE_DEFAULT_URL."/".$article["friendly_url"];
                $item_title = $article["title"];
                $item_description = system_showTruncatedText($article["abstract"], 130);

                $imageObj = new Image($article["image_id"]);

                if ($imageObj->imageExists()) {
                    $item_image = $imageObj->getTag(false, "", "", $article["title"], false);
                } else {
                    $item_image = "";
                }

                ?>
                
                <div class="flex-box color-2">
                    
                    <h2>
                        <?=system_showText(LANG_FEATURED_ARTICLE_SING)?>
                        <a class="view-more" href="<?=ARTICLE_DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_SEE_ALL);?></a>
                    </h2>

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
            report_newRecord("article", $ids_report_lote, ARTICLE_REPORT_SUMMARY_VIEW, true);
        } 
	}
?>
<!--cachemarkerFeaturedArticle-->