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
	# * FILE: /theme/diningguide/body/event/featured.php
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

		<h2>
			<span><?=system_showText(LANG_EVENT_FEATURED)?></span>
			<? if ($seeAllTextLink && $seeAllText) { ?>
				<a class="view-more" href="<?=$seeAllTextLink?>"><?=$seeAllText;?></a>
			<? } ?>
		</h2>
    
        <div class="special-item">
            
            <div class="image">
                <a href="<?=$array_show_events[0]["detailLink"]?>">
                    <? if ($array_show_events[0]["image_tag"]) { ?>
                        <?=$array_show_events[0]["image_tag"]?>
                    <? } else { ?>
                        <span class="no-image"></span>
                    <? } ?>
                </a>
            </div>
            
            <h3>
                <a href="<?=$array_show_events[0]["detailLink"]?>">
                    <?=$array_show_events[0]["title"]?>
                </a>
            </h3>
            
            <? if ($array_show_events[0]["date_recurring"]) { ?>
                <p>
                    <?=$array_show_events[0]["date_recurring"]?>
                </p>
            <? } else { ?>
                <?=$array_show_events[0]["date_string"]?>
            <? } ?>
                
            <? if (EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>

                <p id="showCategory_event<?=$array_show_events[0]["id"]?>">
                    <a href="javascript: void(0);" onclick="showCategory(<?=$array_show_events[0]["id"]?>, 'event', true, <?=$array_show_events[0]["account_id"]?>, true)">
                        <?=system_showText(LANG_VIEWCATEGORY)?>
                    </a>
                </p>

            <? } else { ?>

                <p> 
                    <?=$array_show_events[0]["categories"]?> <?=$array_show_events[0]["author_string"]?>
                </p>

            <? } ?>
        </div>
		
		<div class="featured featured-event">

			<?
            $lastItemStyle = 0;
            for ($i = 1; $i < count($array_show_events); $i++) {
				
				$lastItemStyle++;
			
                if (($lastItemStyle % 2) && ($lastItemStyle != 1)) { ?>
                    <br class="clear" />
                <? } ?>
					
                <div class="featured-item featured-item-special">

                    <div class="image">
                        <a href="<?=$array_show_events[$i]["detailLink"]?>" class="image">
                            <? if ($array_show_events[$i]["image_tag"]) { ?>
                                <?=$array_show_events[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>
                    </div>

                    <h3>
                        <a href="<?=$array_show_events[$i]["detailLink"]?>">
                            <?=system_showTruncatedText($array_show_events[$i]["title"], 90);?>
                        </a>
                    </h3>

                    <div class="date">

                        <? if ($array_show_events[$i]["calendar_month"] && $array_show_events[$i]["calendar_day"]) { ?>
                            <div class="calendar">
                                <span class="month">
                                    <?=$array_show_events[$i]["calendar_month"]?>
                                </span>

                                <span class="day">
                                    <?=$array_show_events[$i]["calendar_day"]?>
                                </span>
                            </div>
                        <? } ?>

                        <? if ($array_show_events[$i]["date_recurring"]) { ?>
                            <p class="recurring">
                                <?=$array_show_events[$i]["date_recurring"]?>
                            </p>
                        <? } else { ?>
                            <?=$array_show_events[$i]["date_string"]?>
                        <? } ?>
                    </div>

                    <? if (EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>

                        <p id="showCategory_event<?=$array_show_events[$i]["id"]?>">
                            <a href="javascript: void(0);" onclick="showCategory(<?=$array_show_events[$i]["id"]?>, 'event', true, <?=$array_show_events[$i]["account_id"]?>, true)">
                                <?=system_showText(LANG_VIEWCATEGORY)?>
                            </a>
                        </p>

                    <? } else { ?>

                        <p> 
                            <?=$array_show_events[$i]["categories"]?> <?=$array_show_events[$i]["author_string"]?>
                        </p>

                    <? } ?>
                </div>
            <? } ?>
        </div>

<? }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedEvent2-->