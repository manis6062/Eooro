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
	# * FILE: /theme/default/body/general.php
	# ----------------------------------------------------------------------------------------------------

    include(system_getFrontendPath("general.php"));

?>
	<div class="row-fluid generalpage">

		<div class="row-fluid">
            <? include(system_getFrontendPath("sitecontent_top.php")); ?>
        </div>
        
        <div class="row-fluid">
	        <div <?=($addSidebar ? "class=\"span$contentSpanSize\"" : "class=\"box-title color-4\"")?> >
	       		<? if ($filePathToInclude) include($filePathToInclude); ?>
	        </div>

            <? if ($hasContactInfo) { ?>

            <div <?=($addSidebar ? "class=\"span$sidebarSpanSize contactus\" " : "row-fluid")?>>
	             <? 
                 include(system_getFrontendPath("sitecontent_bottom.php"));
                 
                 if ($addSidebar) {
                     
                     include(system_getFrontendPath($contactIncludeFile));

	             } ?>
            </div>
            
            <? } ?>

        </div>
        
	</div>