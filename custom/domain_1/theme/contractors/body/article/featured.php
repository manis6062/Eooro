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
	# * FILE: /theme/contractors/body/article/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedArticle2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $hideLabelPub = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_article.php");

    if (is_array($array_show_articles)) { ?>
    
        <div class="row-fluid flex-box-title">
            <h2>
                <?=system_showText(LANG_FEATURED_ARTICLE);?>
                
                <? if (ARTICLE_SCALABILITY_OPTIMIZATION != "on") { ?>
                    <a class="view-more" href="<?=(ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER ? ARTICLE_DEFAULT_URL."/results.php" : ARTICLE_DEFAULT_URL."/");?>"><?=system_showText(LANG_LABEL_VIEW_ALL_ARTICLES);?> »</a>
                <? } ?>
            </h2>
        </div>
    
    <?
        
		$countSpecialItem = 0;
        $lastItemStyle = 0;
        
        for ($i = 0; $i < count($array_show_articles); $i++) {
            
            $lastItemStyle++;
            
            if ($lastItemStyle == ($countSpecialItem + 1)) { ?>

            <div class="row-fluid">

            <? } ?>

            <div class="flex-box row-fluid">
                
                <div class="span12">

                    <aside>

                        <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                            <? if ($array_show_articles[$i]["image_tag"]) { ?>
                                <?=$array_show_articles[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                    </aside>

                    <section>

                        <h5 class="oneline">
                            <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                                <?=$array_show_articles[$i]["title"]?>
                            </a>
                        </h5>

                        <time><?=ucfirst(system_showText(LANG_BLOG_ON));?> <?=$array_show_articles[$i]["publication_string"]?> <?=$array_show_articles[$i]["author_string"]?></time>

                        <p><?=$array_show_articles[$i]["abstract_small"]?></p>
                        
                    </section>
                    
                </div>
                
            </div>

            <? if ($lastItemStyle >= count($array_show_articles) || $lastItemStyle == $numberOfArticles) { ?>

            </div>

            <? }

        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedArticle2-->