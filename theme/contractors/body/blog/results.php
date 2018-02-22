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
	# * FILE: /theme/contractors/body/blog/results.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Prepare content to results
	 */
	include(BLOG_EDIRECTORY_ROOT."/searchresults.php");
    
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid responsive-blog">
            
        <div class="span12 row-fluid">

            <div class="tabview-results custom-select-listing">

                <div id="resultsInfo_list">
                    <? include(system_getFrontendPath("results_filter.php"));?>
                </div>

            </div>
            
            <div class="results-info">
                <? include(system_getFrontendPath("results_info.php")); ?>
                <? include(system_getFrontendPath("results_pagination.php"));?>
            </div>

            <div class="post-results">
                <? include(BLOG_EDIRECTORY_ROOT."/results_blog.php"); ?>
            </div>
            
            <div class="bottom-pagination-listing">
            <?
            $pagination_bottom = true;
            include(system_getFrontendPath("results_pagination.php"));
            ?>
            </div>
                
        </div>
      
    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>