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
	# * FILE: /theme/default/body/classified/index.php
	# ----------------------------------------------------------------------------------------------------
   
    include(system_getFrontendPath("sitecontent_top.php")); ?>

    <div class="row-fluid box-order">

		<div class="span4 order-2">
            
            <? include(system_getFrontendPath("top_categories.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            
            <div>
                <? include(system_getFrontendPath("top_locations.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
            </div>
            
        </div>


        <div class="span8 order-1">

            <? include(system_getFrontendPath("featured.php", "body/classified", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>

        </div>

    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>