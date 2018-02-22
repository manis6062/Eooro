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
    $recentArticles = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_article.php");
    $recentArticles = false;
    
	if (is_array($array_show_articles)) { ?>
	
        <div class="flex-box-group zebra color-4">
            <h2><?=system_showText(LANG_LABEL_ARTICLE_RECENT)?></h2>
        

            <? for ($i = 0; $i < count($array_show_articles); $i++) { ?>

            <section>
                <h6>
                    <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                        <?=system_showTruncatedText($array_show_articles[$i]["title"], 35);?>
                    </a>
                </h6>
                
                <time><?=ucfirst(system_showText(LANG_BLOG_ON));?> <?=$array_show_articles[$i]["publication_string"]." ".$array_show_articles[$i]["author_string"]?></time>
                
                <p><?=system_showTruncatedText($array_show_articles[$i]["abstract"], 65);?></p>
            </section>

            <? } ?>
            
        </div>
				
<? } ?>