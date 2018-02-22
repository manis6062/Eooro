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
	# * FILE: /includes/code/google_tagmanager.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# * DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings(GOOGLE_TAG_SETTING);
	$googleSettingObj_status = new GoogleSettings(GOOGLE_TAG_STATUS);

	if ($googleSettingObj_status->getString("value") == "on" && $googleSettingObj->getString("value")) {
		?>
		<!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?=$googleSettingObj->getString("value")?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?=$googleSettingObj->getString("value")?>');</script>
        <!-- End Google Tag Manager -->

		<?
	}

?>
