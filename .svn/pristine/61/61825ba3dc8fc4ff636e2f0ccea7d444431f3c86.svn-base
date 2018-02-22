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
	# * FILE: /includes/views/view_article_detail_code.php
	# ----------------------------------------------------------------------------------------------------


?>

    <div itemscope itemtype="http://schema.org/Article">
                
        <div class="top-info">
            
            <div class="row-fluid">
                
                <h3 itemprop="name" class="span11"><?=$article_title?></h3>

                <div class="span1 text-right">
                    <ul class="share-social">
                        <?=$favoritesLink?>
                    </ul>
                </div>
                
            </div>
            
        </div>

        <div class="row-fluid flex-box-title">
            
            <article class="top-info span12">
            
                <? if ($summary_review) { ?>
                    <div class="span4 big-rating" <?=$summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                        
                        <?=$summary_review;?>
                        
                        <? if (count($reviewsArr) > 0) { ?>
                            <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                            <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                        <? } ?>
                    </div>
                <? } ?>

                <div class="span4">                    
                    <? if ($article_author) { ?>
                    
                        <strong><?=system_showText(LANG_BY)?></strong>
                        <address><span itemprop="author"><?=$article_authorStr?></span></address>
                   
                    <? } elseif ($article_name) { ?>
                    
                        <strong><?=system_showText(LANG_BY)?></strong>
                        <address><span itemprop="author"><?=$article_name?></span></address>
                    
                    <? } ?>
                </div>

                <? if ($article_publicationDate) { ?>
                <div class="span4"> 
                    <strong><?=system_showText(LANG_ARTICLE_PUBLISHED)?></strong>
                    <address><?=$article_publicationDate?></address>
                </div>
                <? } ?>

            </article>

            <? if ($article_category_tree) { ?>
                <div class="list-categories">
                    <?=$article_category_tree?>
                </div>
            <? } ?>
            
        </div>

        <? 
        $tabOverview = false;
        if ($article_content || $articleGallery) { ?>
        
        <div id="content_overview">
            <?
            $tabActiveOverview = true;
            $tabOverview = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveOverview = false;
            ?>
        </div>
        
        <? } ?>

        <div class="row-fluid flex-box-title article-content">

            <? if ($article_content) { ?>

            <article>
                <p class="long"><?=($article_content)?></p>
            </article>

            <? } ?>
            
        </div>

        <? if ($articleGallery) { ?>

            <div class="row-fluid flex-box-title">
                
                <h4><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h4>
                
                <div class="photo-gallery">
                    
                    <div>
                        <?=$articleGallery?>
                    </div>
                    
                </div>

            </div>

        <? } ?>

        <? if ($detail_review) { ?>

        <div id="content_review" class="area-content">
            <?
            $tabActiveReview = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveReview = false;
            ?>
        </div>

        <div class="row-fluid flex-box-title">

            <div class="top-info top-review">
                <div class="row-fluid">
                    <div class="big-rating">
                        <?=str_replace("»", "", $summary_review);?>
                    </div>
                </div>
            </div>
            
            <script language="javascript" type="text/javascript">
                $('document').ready(function() {
                    loadReviews('<?=$item_type?>', <?=($user ? $item_id : "'preview'")?>, 1, 'tab');
                });
            </script>
            
            <div id="loading_reviews" class="loading_reviews_preview">
                <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
            </div>

            <div id="all_reviews" class="all_reviews_preview row-fluid"></div>

        </div>

        <? } ?>

    </div>