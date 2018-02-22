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
	# * FILE: /theme/default/body/event/detail.php
	# ----------------------------------------------------------------------------------------------------
   
?>
    
    <div class="row-fluid tablet-full">

        <div class="span8">
            <? include(system_getFrontendPath("detailview.php", "frontend", false, EVENT_EDIRECTORY_ROOT)); ?>
        </div>

        <div class="span4">
            
            <div class="sidebar">
                
                <? include(system_getFrontendPath("detail_maps.php", "frontend", false, EVENT_EDIRECTORY_ROOT)); ?>
                
                <div>
                    <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, EVENT_EDIRECTORY_ROOT)); ?>
                </div>
                
                <div class="row-fluid">
                    <? include(system_getFrontendPath("event_calendar.php")); ?>
                </div>
                
            </div>
            
        </div>

    </div>