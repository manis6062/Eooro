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
	# * FILE: /mobile/blogview.php
	# ----------------------------------------------------------------------------------------------------

?>
    <div class="itemView blogView thumbnail">

        <div class="row-fluid">
            <div class="blog-info">
                <? if ($postImage) { ?>
                    <div class="image span4 pull-left img-polaroid">
                        <a href="<?=$detailLink;?>" title="<?=$title;?>">
                            <?=$postImage;?>
                        </a>
                    </div>
                <? } ?>
                
                <h4>
                    <a href="<?=$detailLink?>" title="<?=$title;?>"><?=$truncatedTitle;?></a>
                </h4>
                
                <div class="info">
                    <?=system_showText(LANG_BY);?> <strong><?=EDIRECTORY_TITLE;?></strong>
                    <?=$postOn;?>
                </div>
            </div>   
        </div>

        <p><?=$postContent;?></p>

    </div>