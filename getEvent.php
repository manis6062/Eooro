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
	# * FILE: /getEvent.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
    
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

    Event::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

    $thisDate = $_GET["year"]."-".$_GET["month"]."-".$_GET["day"];
    
    if (is_array($items)) {
        
        $level = new EventLevel(true);
        
        foreach ($items as $item) {

            if ($item["start_date"] == $thisDate) {
                
                if ($level->getDetail($item["level"]) == "y") {
                    $itemTitle = "<a href=\"".EVENT_DEFAULT_URL."/".$item["friendly_url"].".html\">{$item["title"]}</a>";
                } else {
                    $itemTitle = $item["title"];
                }
                
                ?>
                
            <section class="item-preview">
                
                <h5><?=$itemTitle?></h5>
                
                <p><?=$item["description"]?></p>
                
                <? if ($item["start_time"] != "00:00:00") { ?>
                    <b><?=system_showText(LANG_EVENT_STARTS)." ".format_getTimeString($item["start_time"]);?></b>
                <? } ?>
                
            </section>

            <? }
            
        }
    }
?>