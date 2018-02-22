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
	# * FILE: /theme/default/body/blog/index.php
	# ----------------------------------------------------------------------------------------------------
	   
    $addFlexBox = true;
    
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid blog-home">
    
        <div class="span8">
            
            <div class="row-fluid">
                <?
                include(BLOG_EDIRECTORY_ROOT."/results_blog.php");
                
                $pagination_bottom = true;
                include(system_getFrontendPath("results_pagination.php"));
                ?>
            </div>
        
        </div>
    
        <div class="span4">
            
            <div class="row-fluid hidden-phone">
                <? include(system_getFrontendPath("top_categories.php", "frontend", false, BLOG_EDIRECTORY_ROOT)); ?>
            </div>
            
            <?
            include(BLOG_EDIRECTORY_ROOT."/populartopics.php");
            
            include(BLOG_EDIRECTORY_ROOT."/archive.php");
            
            if (SOCIALNETWORK_FEATURE == "on") {
                include(BLOG_EDIRECTORY_ROOT."/recentmembers.php");
            }
            ?>
            
        </div>
 
    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>