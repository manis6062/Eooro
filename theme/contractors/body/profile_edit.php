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
	# * FILE: /theme/contractors/body/profile_edit.php
	# ----------------------------------------------------------------------------------------------------

    include(system_getFrontendPath("sitecontent_top.php"));
    
?> 

    <div class="row-fluid">
                       
            <? include(system_getFrontendPath("socialnetwork/page_tabs.php")); ?>
            
            <div class="member-form">
                <? include(system_getFrontendPath("socialnetwork/edit_account.php")); ?>
            </div>
            
        
	</div>

	<? include(system_getFrontendPath("sitecontent_bottom.php")); ?>