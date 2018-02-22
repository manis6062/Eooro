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
	# * FILE: /theme/diningguide/body/classified/detail.php
	# ----------------------------------------------------------------------------------------------------
   
?>

	<div class="content-full">
    
        <div class="row-fluid">
        
            <div class="span8">
                <? include(system_getFrontendPath("detailview.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            </div>
            
            <div class="sidebar">
                <? include(system_getFrontendPath("detail_maps.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
                <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            </div>
        
        </div>
     
    </div>