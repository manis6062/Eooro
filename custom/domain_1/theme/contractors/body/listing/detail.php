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
	# * FILE: /theme/contractors/body/listing/detail.php
	# ----------------------------------------------------------------------------------------------------
   
?>

    <div class="row-fluid tablet-full">

        <div class="span8">
            <? include(system_getFrontendPath("detailview.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
        </div>

        <div class="span4">
            
            <div class="sidebar">
                
                <? include(system_getFrontendPath("detail_maps.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_deal.php", "body/listing", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_fanpage.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_checkin.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                
            </div>
            
        </div>

    </div>

    <? include(system_getFrontendPath("related_listings.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>