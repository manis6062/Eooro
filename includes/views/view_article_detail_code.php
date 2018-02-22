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

    include(INCLUDES_DIR."/views/view_detail_tabs.php");

?>

    <div class="tab-container" itemscope itemtype="http://schema.org/Article">

        <div id="content_overview" class="tab-content">

            <div class="row-fluid">
                
                <div class="top-info">
                    
                    <h3 itemprop="name"><?=$article_title?></h3>

                    <div class="row-fluid">
                        
                        <div class="span8" <?=$summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                            <? if ($summary_review) { ?>
                                <?=$summary_review;?>
                            <? } ?>
                            <? if ($summary_review && count($reviewsArr) > 0) { ?>
                                <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                                <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                            <? } ?>
                        </div>

                        <div class="span4 <?=($summary_review ? "text-right" : "text-left")?>">
                            <?=$article_icon_navbar?>
                        </div>
                        
                    </div>
                    
                </div>

            </div>

            <div class="row-fluid">

                <? if ($article_category_tree) { ?>
                    <div class="span12 top-info">
                        <?=$article_category_tree?>
                    </div>
                <? } ?>

            </div>

            <div class="row-fluid middle-info overview">

                <? if ($imageTag || $articleGallery) { ?>

                <div class="span7">
                    
                    <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "class=\"gallery-overview\"")?> >

                        <? if (($imageTag && !$articleGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>

                            <div class="image">
                                <?=$imageTag?>
                            </div>

                        <? } ?>

                        <? if ($articleGallery) { ?>

                            <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                                <?=$articleGallery?>
                            </div>

                        <? } ?>

                        
                    </section>
                    
                </div>

                <? } ?>

                <? if ($article_publicationDate) { ?>
                
                    <h6><?=system_showText(LANG_ARTICLE_PUBLISHED)?></h6>
                    <?=$article_publicationDate?>
                    
                <? } ?>

                <? if ($article_author) { ?>

                    <?=system_showText(LANG_BY)?> <span itemprop="author"><?=$article_authorStr?></span>

                <? } elseif ($article_name) { ?>

                    <?=system_showText(LANG_BY)?> <?=$article_name?>

                <? } ?>

                <? if ($article_content) { ?>

                    <p class="long"><?=($article_content)?></p>

                <? } ?>

            </div>

            <? if ($detail_review) { ?>

            <div class="flex-box-group color-3 helpful-reviews">

                <h2>
                    <i class="icon-pencil"></i>
                    <?=system_showText(LANG_LABEL_HELPFUL_REVIEWS);?>

                    <? if (count($reviewsArr) > 3) { ?>
                        <a rel="nofollow" class="view-more" href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"loadReviews('article', $article_id, 1); showTabDetail('review', true);\"");?>><?=str_replace("[x]", count($reviewsArr), system_showText(LANG_LABEL_SHOW_REVIEWS));?></a>
                    <? } else { ?>
                        <a rel="nofollow" class="view-more <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    <? } ?>
                </h2>

                <?=$detail_review?>

            </div>

            <? } ?>

        </div>

        <? if ($detail_review) { ?>

        <div id="content_review" class="tab-content" <?=$activeTab == "review"? "style=\"\"": "style=\"display: none;\"";?>>

            <div class="row-fluid">

                <div class="span12  top-info">

                    <div class="span8">

                        <h3><?=$article_title?></h3>
                        
                        <div class="stars-rating">
                            <div class="rate-<?=(is_numeric($rate_avg) ? $rate_avg : "0")?>"></div>
                        </div>

                    </div>

                    <div class="span4">
                        <a rel="nofollow" class="btn-review btn btn-success <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    </div>

                </div>

            </div>

            <div id="loading_reviews">
                <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
            </div>

            <div id="all_reviews" class="row-fluid"></div>

        </div>

        <? } ?>

    </div>