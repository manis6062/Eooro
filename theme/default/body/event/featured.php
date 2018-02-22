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
	# * FILE: /theme/default/body/event/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedEvent2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_event.php");

    if (is_array($array_show_events)) {
        
        $countSpecialItem = 0;
        $lastItemStyle = 0;
        $countRowFluid = 0;
        
        for ($i = 0; $i < count($array_show_events); $i++) {

            $lastItemStyle++;

            if ($countSpecialItem < $specialItem) {
                if ($countSpecialItem == 0) { ?>
                    <div class="row-fluid flex-box color-4">

                        <h2><?=system_showText(LANG_FEATURED_EVENT_SING);?><time><?=$array_show_events[$i]["date_string"]?></time></h2>

                        <div class="row-fluid">
                <? } ?>

                <div class="span12">

                    <aside>
                        <a href="<?=$array_show_events[$i]["detailLink"]?>">
                            <? if ($array_show_events[$i]["image_tag"]) { ?>
                                <?=$array_show_events[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>
                    </aside>
                    
                    <section>
                        <h5>
                            <a href="<?=$array_show_events[$i]["detailLink"]?>">
                                <?=$array_show_events[$i]["title"]?>
                            </a>
                        </h5>
                        <p><?=$array_show_events[$i]["description"]?></p>
                    </section>

                </div>

                <? if ($countSpecialItem == ($specialItem - 1) || (count($array_show_events) == $countSpecialItem +1)) { ?>

                        </div>

                    </div>

                <? }

                $countSpecialItem++;

            } else {
                
                $countRowFluid++;
                
                if ($lastItemStyle == ($countSpecialItem + 1) || $countRowFluid == 3) { $countRowFluid = 1; ?>

                <div class="row-fluid">

                <? } ?>

                    <div class="span6 flex-box color-4">
                        
                        <h2><?=system_showText(LANG_FEATURED_EVENT_SING);?><time><?=$array_show_events[$i]["date_string"]?></time></h2>

                        <a href="<?=$array_show_events[$i]["detailLink"]?>">
                            <? if ($array_show_events[$i]["image_tag"]) { ?>
                                <?=$array_show_events[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                        <section>
                            <h5>
                                <a href="<?=$array_show_events[$i]["detailLink"]?>">
                                    <?=$array_show_events[$i]["title"]?>
                                </a>
                            </h5>
                            
                            <p><?=$array_show_events[$i]["description"]?></p>
                        </section>
                    </div>

                <? if ($lastItemStyle >= count($array_show_events) || $lastItemStyle == $numberOfEvents || $countRowFluid == 2) { ?>

                </div>

                <? }
                }
        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedEvent2-->