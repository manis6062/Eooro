<?php

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
	# * FILE: /theme/default/body/listing/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_listing.php");

    if (is_array($array_show_listings)) {

        $countSpecialItem = 0;
        $lastItemStyle = 0;
        
        for ($i = 0; $i < count($array_show_listings); $i++) {

            $lastItemStyle++;

            if ($countSpecialItem < $specialItem) {
                if ($countSpecialItem == 0) { ?>
                    <div class="row-fluid flex-box-group color-3">

<!--                        <h2><?=system_showText(LANG_FEATURED_LISTING);?></h2>-->

                        <div class="row-fluid">
                <? } ?>

                <div class="col-sm-6">

                    <section>
                        <h5>
                            <a href="<?=$array_show_listings[$i]["detailLink"]?>">
                                <?=$array_show_listings[$i]["title"]?>
                            </a>
                        </h5>

                        <a href="<?=$array_show_listings[$i]["detailLink"]?>">
                            <? if ($array_show_listings[$i]["image_tag"]) { ?>
                                <?=$array_show_listings[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                        <p><?=$array_show_listings[$i]["description"]?></p>
                    </section>

                </div>

                <? if ($countSpecialItem == ($specialItem - 1) || (count($array_show_listings) == $countSpecialItem +1)) { ?>

                        </div>

                    </div>

                <? }

                $countSpecialItem++;

            } else {  ?>

                <? if ($lastItemStyle == ($countSpecialItem + 1)) { ?>

                <div class="row-fluid fl">

                <? } ?>

                    <div class="col-sm-4 flex-box color-3">
							<div class="border">
                        
                        <h2><?=system_showText(LANG_FEATURED_LISTING_SING);?></h2>

                        <a href="<?=$array_show_listings[$i]["detailLink"]?>">
                            <? if ($array_show_listings[$i]["image_tag"]) { ?>
                                <?=$array_show_listings[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                        <section>
                            <h5>
                                <a href="<?=$array_show_listings[$i]["detailLink"]?>">
                                    <?=$array_show_listings[$i]["title"]?>
                                </a>
                            </h5>
                            
                            <p><?=$array_show_listings[$i]["description"]?></p>
                        </section>
                        </div>
                    </div>

                <? if ($lastItemStyle >= count($array_show_listings) || $lastItemStyle == $numberOfListings) { ?>

                </div>

                <? }
                }
        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedListing2-->
