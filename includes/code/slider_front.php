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
	# * FILE: /includes/code/slider_front.php
	# ----------------------------------------------------------------------------------------------------

    unset($sliderObj);
    $sliderObj = new Slider();
    $array_slider = $sliderObj->getSlider(false);
    $showSlider = false;

    if (is_array($array_slider) && $array_slider[0]) {

        /*
        * Prepare variable to start javascript to slider
        */
        $aux_script_slider = "$('.carousel').carousel();";
        $js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);
        $showSlider = true;

    }
?>