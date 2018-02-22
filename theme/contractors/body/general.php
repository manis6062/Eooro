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
	# * FILE: /theme/contractors/body/general.php
	# ----------------------------------------------------------------------------------------------------

    include(system_getFrontendPath("general.php"));

?>
	<div class="row-fluid generalpage">
        
        <div class="row-fluid">
            
	        <div <?=($addSidebar ? "class=\"span".($hasContactInfo ? "8" : "12")."\"" : "class=\"box-title color-4\"")?> >
	        	<? 
                include(system_getFrontendPath("sitecontent_top.php"));
                
                if ($filePathToInclude) {
                    include($filePathToInclude);
                }
                
                include(system_getFrontendPath("sitecontent_bottom.php"));
                ?>
	        </div>
            
            <? if ($hasContactInfo) { ?>

            <div <?=($addSidebar ? "class=\"span4 contactus\" " : "row-fluid")?>>
	             <? 
                 include(system_getFrontendPath("sitecontent_bottom.php"));
                 
                 if ($addSidebar) {
                     
                     if (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR) !== false) {
                         
                         include(system_getFrontendPath("contact_map.php"));
                         
                     } elseif (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_LEAD_URL_DIVISOR) !== false) {
                         
                         include(system_getFrontendPath("lead_contact.php"));
                     } 

	             } ?>
            </div>
            
            <? } ?>
            
        </div>
        
	</div>