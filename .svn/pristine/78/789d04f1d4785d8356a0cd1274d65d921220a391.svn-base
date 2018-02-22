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
	# * FILE: /theme/diningguide/frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	
    //Get slider
    unset($sliderObj);
    $sliderObj = new Slider();
    $array_slider = $sliderObj->getSlider(false);
     
    if (is_array($array_slider) && $array_slider[0]) {
         
        /*
		* Prepare variable to start javascript to slider
		*/
        $aux_script_slider = "$('.carousel').carousel();";
        $js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);
         
    ?>

        <div id="myCarousel" class="carousel slide hidden-phone">
            
            <ol class="carousel-indicators">
                
                <? for ($i = 0; $i < count($array_slider); $i++) { ?>
                
                    <li data-target="#myCarousel" data-slide-to="<?=$i?>" <?=($i == 0 ? "class=\"active\"" : "")?>>
                        <span><?=string_htmlentities($array_slider[$i]["title"]);?></span>
                    </li>
                    
                <? } ?>
                    
            </ol>
            
            <!-- Carousel items -->
            <div class="carousel-inner">
                
                <? for ($i = 0; $i < count($array_slider); $i++) { ?>
                
                    <div class="<?=($i==0 ? "active" : "")?> item">
                        
                        <?=$array_slider[$i]["image_tag"]?>
                        
                        <div class="carousel-caption row-fluid">
                            
                            <div class="span8 ">
                                
                                <h1><?=string_htmlentities($array_slider[$i]["title"]);?></h1>
                                <p><?=string_htmlentities($array_slider[$i]["description"]);?></p>
                                
                            </div>
                            
                            <div class="span4 text-right">
                                
                                <? if ($array_slider[$i]["link"]) { ?>
                                    <br />
                                    <a target="<?=$array_slider[$i]["target"]?>" class="btn btn-large btn-success " href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
                                        <?=system_showText(LANG_READMORE);?>
                                    </a>
                                <? } ?>
                                    
                            </div>
                            
                        </div>
                        
                    </div>
                
                <? } ?>
                
            </div>
            
        </div>
        
    <? } ?>