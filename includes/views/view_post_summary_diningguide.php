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
	# * FILE: /includes/views/view_post_summary_diningguide.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="post-summary">
        
        <h2>
			<a href="<?=$detailLink?>" title="<?=$title;?>" <?=$postStyle?>><?=$truncatedTitle;?></a>
		</h2>
        
        <div class="row-fluid ">
            
			<div class="span6">
				<p>
                	<?=system_showText(LANG_BY);?> <?=EDIRECTORY_TITLE;?>
                    <?=$postOn;?>
           		</p>
                
                <p><span <?=($post->getNumber("id") ? "id=\"showCategory_".$post->getNumber("id")."\"" : "")?>><?=$postCategoryTree;?></span></p>
			</div>
                        
		</div>
        
        <? if ($wp_enabled != "on" || ($force_blog_module && $postImage)) { ?>

        <div class="image">

            <a href="<?=$detailLink;?>" title="<?=$title;?>" <?=$postStyle?>>
                <?=$postImage;?>
            </a>

        </div>

        <? } ?>
            
        <p class="posts"><?=$postContent;?></p>
           
		<div class="row-fluid  line-footer">
            
			<div class="span6 hidden-phone">
                <p><?=$commentsTag;?></p>
            </div>
            
            <div class="span6">
                <? if ($more) { ?>
                <p class="text-right"><a class="read-more" href="<?=$detailLink;?>" <?=$postStyle?>><?=system_showText(LANG_READMORE);?></a></p>
                <? } ?>
            </div>
            
		</div>
	
	</div>