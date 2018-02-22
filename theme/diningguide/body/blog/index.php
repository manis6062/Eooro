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
	# * FILE: /theme/diningguide/body/blog/index.php
	# ----------------------------------------------------------------------------------------------------
	   
?>

    <div class="row-fluid">
    
        <div class="content content-blog">
            
            <div class="content-main">
                
                <div class="top-pagination post-home">
                    
                    <div class="line-bottom row-fluid">
                        
                        <div class="span12">
                            <? include(system_getFrontendPath("results_pagination.php")); ?>
                        </div>
                        
                    </div>
                    
                </div>
                
                <?
                include(BLOG_EDIRECTORY_ROOT."/results_blog.php");
                
                $pagination_bottom = true;                
                include(system_getFrontendPath("results_pagination.php"));
                ?>
                
            </div>
            
        </div>
    
        <div class="sidebar hidden-phone">
            <?
            include(BLOG_EDIRECTORY_ROOT."/populartopics.php");
            include(system_getFrontendPath("browsebycategory.php", "frontend", false, BLOG_EDIRECTORY_ROOT));
            include(BLOG_EDIRECTORY_ROOT."/archive.php");
            ?>
        </div>
 
    </div>