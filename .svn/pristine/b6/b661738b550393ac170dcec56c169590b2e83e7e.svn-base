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
	# * FILE: /theme/contractors/body/blog/detail.php
	# ----------------------------------------------------------------------------------------------------

    $addFlexBox = true;
?>

    <div class="row-fluid detail-blog">

        <div class="span8">
            <?
            $isDetail = true;
            $user = true;
            include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php");
            
            include(system_getFrontendPath("detailview.php", "frontend", false, BLOG_EDIRECTORY_ROOT));
            ?>
        </div>


        <div class="span4 hidden-phone">

            <?
            $aux_show_related_topics = true;
            include(BLOG_EDIRECTORY_ROOT."/recenttopics.php");
            ?>

            <div class="row-fluid">
                <? include(system_getFrontendPath("browsebycategory.php", "frontend", false, BLOG_EDIRECTORY_ROOT)); ?>
            </div>
            
            <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, BLOG_EDIRECTORY_ROOT)); ?>

        </div>

    </div>
        