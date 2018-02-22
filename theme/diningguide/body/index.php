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
	# * FILE: /theme/diningguide/body/index.php
	# ----------------------------------------------------------------------------------------------------
   
    setting_get("twitter_widget", $twitter_widget);
?>

    <div class="three-columns">
        
        <div class="row-fluid">
            
            <? include(system_getFrontendPath("top_items.php")); ?>
            
            <div class="row-fluid list-home">
                <? if ($twitter_widget) { ?>
                
                    <div class="span8">
                        <div class="row-fluid">
                            <? include(system_getFrontendPath("top_locations.php")); ?>
                        </div>
                        <div class="row-fluid">
                            <? include(system_getFrontendPath("top_categories.php")); ?>
                        </div>
                    </div>
                
                    <div class="span4">
                        <? include(system_getFrontendPath("twitter.php")); ?>
                    </div>
                
                <? } else {
                    include(system_getFrontendPath("top_locations.php"));
                    include(system_getFrontendPath("top_categories.php"));
                } ?>
                
            </div>
            
        </div>
        
    </div>