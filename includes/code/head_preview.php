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
	# * FILE: /includes/code/head_preview.php
	# ----------------------------------------------------------------------------------------------------

    include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
?>

    <script type="text/javascript">
    <!--
    DEFAULT_URL = "<?=DEFAULT_URL?>";
    -->
    </script>

    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.js"></script>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/lang/<?=EDIR_LANGUAGE?>.js"></script>

    <? if (THEME_USE_BOOTSTRAP && !THEME_GALLERY_FANCYBOX) { ?>

        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/galleria/galleria-1.2.9.min.js"></script>
        <script type="text/javascript" src="<?=THEMEFILE_RELATIVE_PATH."/".EDIR_THEME."/galleria/galleria.".EDIR_THEME.".js"?>"></script>

    <? } else { ?>

        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/ad-gallery/jquery.ad-gallery.js"></script>

    <? } ?>

    <?=system_getNoImageStyle($cssfile = true);?>

    <!--[if lt IE 9]>
    <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
    <![endif]-->