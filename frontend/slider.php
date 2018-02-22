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
	# * FILE: /frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	
	//Get slider
    unset($sliderObj);
    $sliderObj = new Slider();
    $array_slider = $sliderObj->getSlider();
	
	if (is_array($array_slider)) {
        
        /*
        * Prepare variable to start javascript to slider
        */
        $aux_script_slider = "$(\"#slider\").easySlider({
                                        auto: true,
                                        continuous: true,
                                        numeric: true
                                    });";
        $js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);			
        
        
        ?>

		<div class="content-top content-top-slider">
			<div id="slider">
				<ul>
					<? for ($i = 0; $i < count($array_slider); $i++) { ?>
					<li>
						<div class="slider-item">
							<div class="left">
                                
								<? if ($array_slider[$i]["link"]) { ?>
                                
                                <a target="<?=$array_slider[$i]["target"]?>" href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
                                    
								<? }
                                
								echo $array_slider[$i]["image_tag"];
                                
								if ($array_slider[$i]["link"]) { ?>
                                    
                                </a>
                                
								<? } ?>
                                
							</div>	
                            
							<div class="right">
                                
								<h2>
									<? if ($array_slider[$i]["link"]) { ?>
                                    
                                    <a href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
                                        
									<? }
                                    
									echo string_htmlentities($array_slider[$i]["title"]);
                                    
									if ($array_slider[$i]["link"]) { ?>
                                        
                                    </a>
									<? } ?>
                                    
								</h2>
                                
								<p><?=string_htmlentities($array_slider[$i]["description"]);?></p>
                                
							</div>
                            
						</div>
					</li>
					<? } ?>
				</ul>
			</div>
		</div>
	<? } ?>