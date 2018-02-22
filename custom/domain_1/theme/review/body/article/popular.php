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
	# * FILE: /theme/default/body/article/popular.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $popularArticles = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_article.php");
    $popularArticles = false;

	if (is_array($array_show_articles)) { ?>
	
        <div class="flex-box-group color-4">
            
            <h2><?=system_showText(LANG_LABEL_ARTICLE_POPULAR)?></h2>
        

            <? for ($i = 0; $i < count($array_show_articles); $i++) { ?>

            <section class="item-preview">
                <aside>
                    <a href="<?=$array_show_articles[$i]["detailLink"]?>" class="image">
                        <? if ($array_show_articles[$i]["image_tag"]) { ?>
                            <?=$array_show_articles[$i]["image_tag"]?>
                        <? } else { ?>
                            <span class="no-image"></span>
                        <? } ?>
                    </a>
                </aside>
                <h6>
                    <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                        <?=system_showTruncatedText($array_show_articles[$i]["title"], 30);?>
                    </a>
                </h6>
            </section>

            <? } ?>
            
        </div>
				
<? } ?>