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
	# * FILE: /includes/views/view_post_summary.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="post-summary">

        <? if (($wp_enabled != "on" || ($force_blog_module && $postImage)) && !$postNoImage) { ?>
        
		<div class="span4">
			<section>
		 		
		        <div class="image">

		            <a href="<?=$detailLink;?>" title="<?=$title;?>" <?=$postStyle?>>
		                <?=$postImage;?>
		            </a>

		        </div>
                
	    	</section>
		</div>
        
        <? } ?>
        
        <h3>
			<a href="<?=$detailLink?>" title="<?=$title;?>" <?=$postStyle?>><?=$title;?></a>
		</h3>
        
		<time><?=$postOn;?></time>
            
        <p class="posts"><?=$postContent;?></p>
           
		<div class="blog-comments">
			<?=$commentsTag;?>
		</div>
	
	</div>