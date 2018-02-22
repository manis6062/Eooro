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
	# * FILE: /includes/views/view_article_detail_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/views/view_detail_tabs.php");

?>
		
    <div class="content-main" itemscope itemtype="http://schema.org/Article">
        
        <div class="tab-container">
            
            <div id="content_overview" class="tab-content">
                
                <div class="row-fluid">

                    <div class="span12">
                        <h2 itemprop="name"><?=$article_title?></h2>
                    </div>

                </div>
                
                <div class="row-fluid top-info">
                                   
                    <? if ($summary_review) { ?>
                        <div class="span6" <?=$summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                            <?=$summary_review;?>
                            
                            <? if ($summary_review && count($reviewsArr) > 0) { ?>
                                <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                                <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                            <? } ?>
                        </div>
                    <? } ?>
                    
                    <div class="span6 share">
                        <?=$article_icon_navbar?>
                    </div>
                    
                </div>
                
                <div class="row-fluid clearfix">
                    
                    <? if ($article_category_tree) { ?>
                        <?=$article_category_tree?>
                    <? } ?>
                    
                </div>
                
                <div class="row-fluid middle-info">
                    
                    <? if ($imageTag || $articleGallery) { ?>
                    
                    <div class="span6">
                        
                        <? if (($imageTag && !$articleGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>

                            <div class="image">
                                <?=$imageTag?>
                            </div>

                        <? } ?>

                        <? if ($articleGallery) { ?>
                            <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "")?> >
                                <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                                    <?=$articleGallery?>
                                </div>
                            </section>
                        <? } ?>

                    </div>
                    
                    <? } ?>
                    
                    <div class="span6">

                        <? if ($article_publicationDate) { ?>
                            <p><strong><?=system_showText(LANG_ARTICLE_PUBLISHED)?></strong></p>
                            <p><?=$article_publicationDate?></p>
                        <? } ?>

                        <? if ($article_author) { ?>

                            <p><strong><?=system_showText(LANG_BY)?> </strong> <span itemprop="author"><?=$article_authorStr?></span></p>

                        <? } elseif ($article_name) { ?>

                            <p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_name?></p>

                        <? } ?>

                    </div>
                    
                </div>
                
                <div class="row-fluid">
                    
                    <? if ($article_content) { ?>
                    
                        <div class="content-box">
                            <p class="long"><?=($article_content)?></p>
                        </div>

                    <? } ?>
                    
                </div>
                
                <? if ($detail_review) { ?>
                
                <div class="helpful-reviews">    
                    
                    <h2>
                        <?=system_showText(LANG_LABEL_HELPFUL_REVIEWS);?>
                        
                        <? if (count($reviewsArr) > 3) { ?>
                            <a rel="nofollow" class="pull-right" href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"loadReviews('article', $article_id, 1); showTabDetail('review', true);\"");?>><?=str_replace("[x]", count($reviewsArr), system_showText(LANG_LABEL_SHOW_REVIEWS));?></a>
                        <? } else { ?>
                            <a rel="nofollow" class="pull-right <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                        <? } ?>
                    </h2>                    
                    
                    <?=$detail_review?>
                    
                </div>
                
                <? } ?>
                
            </div>
            
            <? if ($detail_review) { ?>
			
            <div id="content_review" class="tab-content" <?=$activeTab == "review"? "style=\"\"": "style=\"display: none;\"";?>>

                <div class="row-fluid">

                    <div class="span12">
                        <h2><?=$article_title?></h2>
                        <a rel="nofollow" class="pull-right <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    </div>

                </div>
                
                <div id="loading_reviews">
                    <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
                </div>
                
                <div id="all_reviews" class="content-reviews"></div>

            </div>
            
            <? } ?>
			
		</div>
            
    </div>