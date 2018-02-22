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
	# * FILE: /includes/views/view_post_summary_contractors.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="post-summary">
        
        <time>
        	<b><?=$postDay?>,</b>
        	<em><?=$postMonth?> <?=$postYear?></em>
        </time>
		
		<section>

	        <h2>
				<a href="<?=$detailLink?>" title="<?=$title;?>" <?=$postStyle?>><?=$title;?></a>
			</h2>
            
            <p>
                <span <?=($post->getNumber("id") ? "id=\"showCategory_".$post->getNumber("id")."\"" : "")?>>
                    <?=$postCategoryTree;?>
                </span>
            </p>
	 		
            <? if (($wp_enabled != "on" || ($force_blog_module && $postImage)) && !$postNoImage) { ?>
            
	        <div class="image">
	            <a href="<?=$detailLink;?>" title="<?=$title;?>" <?=$postStyle?>>
	                <?=$postImage;?>
	            </a>
	        </div>
            
            <? } ?>

            <p class="posts"><?=$postContent;?></p>

            <footer>
            	<small><?=$commentsTag;?></small>
				<a class="text-success pull-right" href="<?=$detailLink;?>">
                    <small><?=system_showText(LANG_LABEL_KEEP_READING);?> »</small>
                </a>
            </footer>

    	</section>

	</div>