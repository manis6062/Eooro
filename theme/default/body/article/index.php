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
	# * FILE: /theme/default/body/article/index.php
	# ----------------------------------------------------------------------------------------------------
   
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid">

        <div class="span9">

            <? include(system_getFrontendPath("featured.php", "body/article", false, ARTICLE_EDIRECTORY_ROOT)); ?>
                    
            <div class="row-fluid">
                <? include(system_getFrontendPath("top_categories.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT)); ?>
            </div>

		</div>

        <div class="span3 sidebar">

            <div class="row-fluid">
                <? include(system_getFrontendPath("popular.php", "body/article", false, ARTICLE_EDIRECTORY_ROOT)); ?>
            </div>
            
            <div class="row-fluid">
                <? include(system_getFrontendPath("recent.php", "body/article", false, ARTICLE_EDIRECTORY_ROOT)); ?>
            </div>

        </div>

    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>