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
	# * FILE: /theme/diningguide/frontend/top_items.php
	# ----------------------------------------------------------------------------------------------------

    // Preparing markers to Full Cache
?>
    <!--cachemarkerTopItems-->
        
<?
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/top_items.php");

    if (count($topItems)) { ?>

    <ul class="thumbnails">
        
        <? foreach ($topItems as $topItem) { ?>

            <li class="<?=$topItem["class"]?> span4">

                <? if ($topItem["class"] != "top-review") { ?>

                <div class="thumbnail">

                    <h2>
                        <i class="i-<?=$topItem["class"]?>"></i> <?=$topItem["label"];?>
                        <a href="<?=$topItem["more"];?>" class="pull-right"><?=system_showText(LANG_MORE);?></a>
                    </h2>

                    <a href="<?=$topItem["item"]["link"];?>"><?=$topItem["item"]["image"];?></a>

                    <div class="caption">

                        <h3>
                            <a href="<?=$topItem["item"]["link"];?>"><?=$topItem["item"]["title"];?></a>
                        </h3>
                        <p><?=$topItem["item"]["description"];?></p>
                        <p class="text-right">
                            <a href="<?=$topItem["item"]["link"];?>" class="btn btn-small btn-success"><?=system_showText(LANG_LABEL_KEEP_READING);?></a>
                        </p>

                    </div>

                </div>

                <? } else { ?>

                <h2>
                    <i class="i-<?=$topItem["class"]?>"></i> <?=$topItem["label"];?>
                </h2>
                
                <ul>
                    
                    <? foreach ($topItem["item"] as $item) { ?>
                    
                    <li>
                        <div class="rate-stars pull-right">
                            <?
                            if ($item["rating"]) {
                                for ($k = 0; $k < $item["rating"]; $k++) { ?>
                                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png"?>" alt="Star On" />
                                <? }
                            } ?>
                        </div>
                        
                        <h5>
                            <a href="<?=$item["link"];?>"><?=$item["title"];?></a>
                            <div class="rate-stars"></div>
                        </h5>
                        
                        <p><?=$item["description"];?></p>
                    </li>
                    
                    <? } ?>
                    
                </ul>

                <? } ?>

            </li>

        <? } ?>

    </ul> 

    <? }

    // Preparing markers to Full Cache
?>
    <!--cachemarkerTopItems-->