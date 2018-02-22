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
	# * FILE: /theme/default/body/article/featured.php
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

    if (is_array($array_show_articles)) {
        
		$countSpecialItem = 0;
        $lastItemStyle = 0;
        
        for ($i = 0; $i < count($array_show_articles); $i++) {
            
            $lastItemStyle++;
            
			if ($countSpecialItem < $specialItem) {
				if ($countSpecialItem == 0) { ?>
                    <div class="row-fluid">
				<? } ?>
				
                <div class="span<?=($countSpecialItem == 0 ? "8" : "4")?> flex-box color-2">
                    
                    <h2><?=system_showText(LANG_FEATURED_ARTICLE_SING);?></h2>
                    
                    <? if ($countSpecialItem == 0) { ?>
                    
                    <div class="clearfix"></div>
                    
                    <? } ?>
                    
                    <? if ($countSpecialItem == 0) { ?>
                    
                    <section>
                        <aside>
                            
                    <? } ?>
                            <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                                <? if ($array_show_articles[$i]["image_tag"]) { ?>
                                    <?=$array_show_articles[$i]["image_tag"]?>
                                <? } else { ?>
                                    <span class="no-image"></span>
                                <? } ?>
                            </a>
                            
                    <? if ($countSpecialItem == 0) { ?>
                            
                        </aside>
                        
                    <? } else { ?>
                        
                    <section>
                            
                    <? } ?>

                        <h5>
                            <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                                <?=$array_show_articles[$i]["title"]?>
                            </a>
                        </h5>
                        
                        <time><?=ucfirst(system_showText(LANG_BLOG_ON));?> <?=$array_show_articles[$i]["publication_string"]?> <?=$array_show_articles[$i]["author_string"]?></time>
                        
                        <? if (!$countSpecialItem) { ?>
                        
                        <p><?=$array_show_articles[$i]["abstract_full"]?></p>
                        
                        <? } ?>
                        
                    </section>

                </div>
                    
                <? if ($countSpecialItem == ($specialItem - 1) || (count($array_show_articles) == $countSpecialItem +1)) { ?>

                    </div>
			
				<? }
				
				$countSpecialItem++;

            } else {  ?>

                <? if ($lastItemStyle == ($countSpecialItem + 1)) { ?>

                <div class="row-fluid">

                <? } ?>
                    
                    <div class="span4 flex-box color-2">

                        <h2><?=system_showText(LANG_FEATURED_ARTICLE_SING);?></h2>

                        <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                            <? if ($array_show_articles[$i]["image_tag"]) { ?>
                                <?=$array_show_articles[$i]["image_tag"]?>
                    <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                        <section>
                            <h5>
                                <a href="<?=$array_show_articles[$i]["detailLink"]?>">
                                    <?=$array_show_articles[$i]["title"]?>
                                </a>
                            </h5>
                    
                            <time><?=ucfirst(system_showText(LANG_BLOG_ON));?> <?=$array_show_articles[$i]["publication_string"]?> <?=$array_show_articles[$i]["author_string"]?></time>
                            
                            <p><?=$array_show_articles[$i]["abstract_small"]?></p>
                        </section>
                </div>

                <? if ($lastItemStyle >= count($array_show_articles) || $lastItemStyle == $numberOfArticles) { ?>

		</div>
				
<? }
                }
        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedArticle2-->