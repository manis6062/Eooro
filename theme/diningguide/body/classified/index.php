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
	# * FILE: /theme/diningguide/body/classified/index.php
	# ----------------------------------------------------------------------------------------------------
   
?>

    <div class="row-fluid">

        <div class="content">
            <div class="content-featured">
                <? include(system_getFrontendPath("featured.php", "body/classified", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            </div>
        </div>

        <div class="sidebar hidden-phone">
            <? include(system_getFrontendPath("browsebylocation.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            <? include(system_getFrontendPath("browsebycategory.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
        </div>

    </div>