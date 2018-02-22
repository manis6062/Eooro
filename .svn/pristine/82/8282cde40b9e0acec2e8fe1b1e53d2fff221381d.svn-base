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
	# * FILE: /theme/contractors/body/event/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedEvent2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_event.php");

    if (is_array($array_show_events)) { ?>
    
        <div class="row-fluid flex-box-title">
            <h2>
                <?=system_showText(LANG_FEATURED_EVENT);?>
                
                <? if (EVENT_SCALABILITY_OPTIMIZATION != "on") { ?>
                    <a class="view-more" href="<?=(ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER ? EVENT_DEFAULT_URL."/results.php" : EVENT_DEFAULT_URL."/");?>"><?=system_showText(LANG_LABEL_VIEW_ALL_EVENTS);?> »</a>
                <? } ?>
            </h2>
        </div>
    
    <?
        
        $countSpecialItem = 0;
        $lastItemStyle = 0;
        $countRowFluid = 0;
        
        for ($i = 0; $i < count($array_show_events); $i++) {

            $lastItemStyle++;

            $countRowFluid++;

            if ($lastItemStyle == ($countSpecialItem + 1) || $countRowFluid == 3) { $countRowFluid = 1; ?>

            <div class="row-fluid">

            <? } ?>

                <div class="span6 flex-box color-4">

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
                        <time><?=$array_show_events[$i]["date_string"]?></time>

                        <p><?=$array_show_events[$i]["description"]?></p>
                    </section>
                </div>

            <? if ($lastItemStyle >= count($array_show_events) || $lastItemStyle == $numberOfEvents || $countRowFluid == 2) { ?>

            </div>

            <? }

        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedEvent2-->