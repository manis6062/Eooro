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
	# * FILE: /theme/diningguide/body/general.php
	# ----------------------------------------------------------------------------------------------------

    include(system_getFrontendPath("general.php"));

?>
	<div class="content-center">
        
        <div <?=($addSidebar ? "class=\"content content-general\" " : "")?>>
            
            <div <?=($addSidebar ? "class=\"content-main\"" : "")?>>
                <? include(system_getFrontendPath("sitecontent_top.php")); ?>
                <? if ($filePathToInclude) include($filePathToInclude); ?>
            </div>
            
        </div>
    
        <? if ($hasContactInfo && $addSidebar) { ?>
        
            <div class="sidebar contactus">

                <? include(system_getFrontendPath($contactIncludeFile)); ?>

            </div>
        
        <? } ?>
        
        <div class="clearfix"></div>
        
	</div>