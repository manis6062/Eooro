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
	# * FILE: /theme/contractors/body/deal/index.php
	# ----------------------------------------------------------------------------------------------------
           
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid">

        <div class="span8">
            
            <? include(system_getFrontendPath("featured.php", "body/deal", false, PROMOTION_EDIRECTORY_ROOT)); ?>

        </div>

        <div class="span4">
                
            <div class="row-fluid">
                <? include(system_getFrontendPath("browsebycategory.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>

            <div class="row-fluid">
                <? include(system_getFrontendPath("top_locations.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>
           
        </div>

    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>