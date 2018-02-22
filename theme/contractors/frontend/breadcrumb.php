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
	# * FILE: /theme/contractors/frontend/breadcrumb.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
    #  CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/breadcrumb.php");
   
    if ($show_breadcrumb) { ?>
		<div class="row-fluid breadcrumb">
            <?=$breadcrumb->show_breadcrumb()?>
        </div>
	<? } elseif ($show_auxbreadcrumb) { ?>
		<div class="row-fluid breadcrumb">
            <?=$show_auxbreadcrumb?>
        </div>
	<? }
    unset($page);
    
?>