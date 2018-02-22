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
	# * FILE: /edir_core/listing/claim.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script language="javascript" type="text/javascript">
        <!--

        function switchFormUserDisplay(user) {
            var loginOptions = ("<?=$loginTypes;?>").split(',');
            for (var i = 0; i < loginOptions.length; i++) {
                $('#' + loginOptions[i]).removeClass('isVisible');
                $('#' + loginOptions[i]).addClass('isHidden');
            }

            $('#' + user).removeClass('isHidden');
            $('#' + user).addClass('isVisible');
        }

        //-->
    </script>

    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

    <? include(system_getFrontendPath("claim.php", "frontend")); ?>