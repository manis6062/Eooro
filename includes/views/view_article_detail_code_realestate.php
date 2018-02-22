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
	# * FILE: /includes/views/view_article_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="detail" itemscope itemtype="http://schema.org/Article">
		
		<h1 itemprop="name"><?=$article_title;?></h1>
        
        <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT)); ?>
        
        <span class="clear">&nbsp;</span>
				
		<div class="columns">
        
        	<? if (($imageTag && !$articleGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>
            	<div class="image-shadow">
                    <div class="image">
                        <?=$imageTag?>
                    </div>
                </div>
            <? } ?>

            <? if($articleGallery) { ?>
               <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>">
                    <?=$articleGallery?>
                </div>
            <? } ?>
            
            <div class="share" <?=$summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                <?=$article_icon_navbar?>
                
                <? if ($summary_review && count($reviewsArr) > 0) { ?>
                    <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                    <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                <? } ?>
            </div>
			
			<div>
                
                <? if ($article_category_tree) { ?>
                    <?=$article_category_tree?>
                <? } ?>
				
				<? if ($article_publicationDate) {?>
					<p><strong><?=system_showText(LANG_ARTICLE_PUBLISHED)?>:</strong> <?=$article_publicationDate?></p>
				<? }?>
					
				<? if ($article_author){?>
					
					<p><strong><?=system_showText(LANG_BY)?> </strong> <span itemprop="author"><?=$article_authorStr?></span></p>	
					
				<? } elseif ($article_name){?>
					
					<p><strong><?=system_showText(LANG_BY)?> </strong> <?=$article_name?></p>	
					
				<? } ?>	
				
			</div>
			
			<div class="content-custom">
				<br /><? if($article_content) { ?>
					<?=($article_content)?>
				<? } ?>
			</div>
			
		</div>	

	</div>