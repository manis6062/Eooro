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
	# * FILE: /theme/diningguide/body/blog/detail.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content-full">
    
        <div class="row-fluid">
            
            <div class="span8">
                <? $isDetail = true; $user = true; ?>
                <? include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php"); ?>
                <? include(system_getFrontendPath("detailview.php", "frontend", false, BLOG_EDIRECTORY_ROOT)); ?>
            </div>
            
            <div class="sidebar hidden-phone">
                <? include(system_getFrontendPath("browsebycategory.php", "frontend", false, BLOG_EDIRECTORY_ROOT)); ?>
                <? include(BLOG_EDIRECTORY_ROOT."/archive.php"); ?>
                <? $aux_show_related_topics = true; ?>
                <? include(BLOG_EDIRECTORY_ROOT."/recenttopics.php"); ?>
            </div>
        
        </div>
        
    </div>