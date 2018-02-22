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
	# * FILE: /theme/diningguide/body/results.php
	# ----------------------------------------------------------------------------------------------------
	
	/*
	 * Prepare content to results
	 */
	include(LISTING_EDIRECTORY_ROOT."/searchresults.php");
    
?>

	<div class="content-center">
                      
        <div class="top-pagination">
            
            <? include(system_getFrontendPath("results_info.php")); ?>
            
            <div class="line-bottom">
                <? include(system_getFrontendPath("results_filter.php")); ?>
                <? include(system_getFrontendPath("results_pagination.php")); ?>
          	</div>
            
        </div>

        <div class="content-full-results">
                   
            <? include(LISTING_EDIRECTORY_ROOT."/results_listings.php"); ?>
            
            <div class="bottom-pagination">
                <? 
                $pagination_bottom = true;
                $showLetter = false;
                include(system_getFrontendPath("results_pagination.php"));
                ?>
            </div>
	            
    	</div>
        
	</div>