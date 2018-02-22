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
	# * FILE: /theme/contractors/frontend/event_calendar.php
	# ----------------------------------------------------------------------------------------------------

    // CREATING CACHE
    $objCache = new cache("event_calendar", true);
    
    if ($objCache->caching) {
        
        // Preparing markers to Full Cache
        ?>
        <!--cachemarkerEventCalendar-->
        <?
        
        if ($_GET["this_date"]) cal_display_month("", $_GET["this_date"], "Y", "Y", "week", false, LANG_UPCOMING_EVENT);
        else cal_display_month(false, false, "Y", "Y", "week", false, LANG_UPCOMING_EVENT);

        $firstEvent = true;
        $showYear = true;
        calendar_getEventsDay($calendar, $showYear);

        if (count($calendar)) { ?>

            <div class="flex-box-group box-calendar">

                <ul class="calendar-event">

                    <? foreach ($calendar as $monthDay) {

                        if ($firstEvent) {
                            $triggerJS = "getEventsCalendar('{$monthDay["day"]}', '{$monthDay["month"]}', '{$monthDay["year"]}')";
                            $firstEvent = false;
                        }

                        ?>

                    <li id="<?=$monthDay["day"].$monthDay["month"].$monthDay["year"]?>" onclick="getEventsCalendar('<?=$monthDay["day"]?>', '<?=$monthDay["month"]?>', '<?=$monthDay["year"]?>');">
                        <b><?=$monthDay["dayWeek"]?></b><br />
                        <span><?=(EDIR_LANGUAGE == "en_us" ? system_getOrdinalLabel($monthDay["day"]) : $monthDay["day"])?></span>
                    </li>

                    <? } ?>

                </ul>

                <p class="calendar_loading" style="display:none"></p>

                <div id="calendar_event"></div>
                
                <input type="hidden" id="last_day_click" value="" />

            </div>

            <? if ($triggerJS) { ?>

            <script language="javascript" type="text/javascript">
                $(document).ready(function(){
                    <?=$triggerJS;?>
                });
            </script>

            <? }

        } ?>

        <script language="javascript" type="text/javascript">
            function set_cal_date(date) {
                var path = "";

                path = "<?=EVENT_DEFAULT_URL?>/results.php?this_date="+date+"&search_by_day=true";

                document.location.href = path;
            }
        </script>
    
    <?  
        // Preparing markers to full cache
        ?>
        <!--cachemarkerEventCalendar-->
        <?
        }
        $objCache->close();
    ?>