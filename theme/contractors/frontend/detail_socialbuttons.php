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
	# * FILE: /theme/contractors/frontend/detail_socialbuttons.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/socialbuttons.php");

    if ($item_facebookbuttons || $item_googlebutton || $item_pinterest || $twitter_imgE) { ?>

        <div class="content-social-box">
            
            <?=$item_facebookbuttons?>
            
            <?=$item_googlebutton?>
            
            <div class="clearfix"></div>
            
            <?=$item_pinterest?>
            
            <a rel="nofollow" <?=$twitter?>><?=$twitter_imgE?></a>
        </div>

    <? } ?>