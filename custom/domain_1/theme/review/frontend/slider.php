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
	# * FILE: /theme/default/frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	    
?>

    <div id="myCarousel" class="carousel">

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

                    <div class="carousel-caption">
                        <h1>
                            <? if ($array_slider[$i]["link"]) { ?>

                            <a target="<?=$array_slider[$i]["target"]?>" href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
                                <?=string_htmlentities($array_slider[$i]["title"]);?>
                            </a>

                            <? } else { ?>

                                <?=string_htmlentities($array_slider[$i]["title"]);?>

                            <? } ?>
                        </h1>

                        <p><?=string_htmlentities($array_slider[$i]["description"]);?></p>

                    </div>

                </div>

            <? } ?>

        </div>

    </div>