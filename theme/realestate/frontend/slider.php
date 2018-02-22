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
	# * FILE: /theme/realestate/frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	
	//Get slider
    unset($sliderObj);
    $sliderObj = new Slider();
    $array_slider = $sliderObj->getSlider();
    
    $hasSlider = false;
	
	if (is_array($array_slider)) {
        
        $hasSlider = true;

       /*
		* Prepare variable to start javascript to slider
		*/
        $aux_script_slider = "$(\".slider-content\").easySlider({
                                                loop: true,
                                                orientation: 'fade', 
                                                autoplayDuration: 3000,
                                                autogeneratePagination: false,
                                                restartDuration: 4500,
                                                nextId: 'next',
                                                prevId: 'prev',
                                                pauseable: true
                                        });";
        $js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);				
     
    ?>
        <div class="slider-info"></div>
        
        <div class="slider-content">
            
            <ul>
                
            <? for ($i = 0; $i < count($array_slider); $i++) { ?>
                
                <li>
                    <div class="slider-content-full" style="background:url('<?=$array_slider[$i]["image_url"]?>');">
                        
                        <div class="slider-content-box">
                            
                            <div class="slider-info-content">
                                
                                <? if ($array_slider[$i]["link"]) { ?>
                                <p class="button-read">
                                    <a target="<?=$array_slider[$i]["target"]?>" href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>"><?=system_showText(LANG_READMORE)?></a>
                                </p>
                                <? } ?>
                                
                                <? if ($array_slider[$i]["price"] != "0.00" && $array_slider[$i]["price"]) { ?>
                                    <div class="slider-price">
                                        <p><?=CURRENCY_SYMBOL." ".$array_slider[$i]["price"]?></p>
                                    </div>
                                <? } ?>

                                <div class="slider-title">
                                    <h2><?=string_htmlentities($array_slider[$i]["title"]);?></h2>
                                    <p><?=system_showTruncatedText($array_slider[$i]["description"], SLIDER_MAX_CHARS, "");?></p>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </li>
                
            <? } ?>
            </ul>
            
        </div>
    <? } ?>