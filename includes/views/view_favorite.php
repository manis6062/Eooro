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
	# * FILE: /includes/views/view_favorite.php
	# ----------------------------------------------------------------------------------------------------

    if ($module == "listing") {
        $item_title = $listingtemplate_title;
        $item_phone = $listingtemplate_phone;
    } elseif ($module == "classified") {
        $item_title = $title;
        $item_phone = $phone;
        $listingtemplate_twilioCall = "";
    } elseif ($module == "event") {
        $item_title = $title;
        $item_phone = $phone;
        $listingtemplate_twilioCall = "";
    } elseif ($module == "article") {
        $item_title = $summaryTitle;
        $listingtemplate_twilioCall = "";
    }
?>
    
    <section class="item-favorite" id="favorite_<?=$countItem?>" <?=$countItem > $maxFavorites ? "style=\"display:none;\"" : ""?>>
                    
        <div class="item-info">

            <div class="row-fluid">

                <span class="pull-left"><?=system_showText(constant("LANG_".strtoupper($module)."_FEATURE_NAME"));?></span>

                <? if ($avgreview && ($module == "listing" || $module == "article")) { ?>
                
                <div class="pull-right stars-rating">
                    <div class="rate-<?=$avgreview;?>"></div>
                </div>
                
                <? } ?>

            </div>

            <h4>
                <a href="<?=$itemLink?>"><?=$item_title;?></a>
            </h4>

            <? if ($module != "article") { ?>
            <address>
                
                <p><?=system_getItemAddressString(ucfirst($module), $favorite["id"]);?></p>
                
                <? if ($item_phone) { ?>
                    <p><?=$item_phone?></p>
                <? } ?>
                
            </address>
            <? } ?>

        </div>

        <div class="item-options text-right">
            
            <span class="pull-left">
                
                <a <?=$linkFacebook;?> title="<?=system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Facebook"?>"><i class="socialicon social-facebook-mini"></i></a>
                
                <a <?=$linkTwitter;?> title="<?=system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Twitter"?>"><i class="socialicon social-twitter-mini"></i></a>
                
                <? if ($listingtemplate_twilioCall) { ?>
                <a href="<?=$listingtemplate_twilioCall?>" <?=$twilioCall_style?>><i title="<?=system_showText(LANG_LABEL_CLICKTOCALL);?>" class="socialicon social-clickcall-mini"></i></a>
                <? } ?>
                
            </span>
            
            <? if ($id == sess_getAccountIdFromSession()) { ?>
            
            <abbr title="<?=system_showText(LANG_ICONQUICKLIST_REMOVE)?>">
                <a rel="nofollow" href="<?=$remove_favorites_link;?>" <?=$remove_favorites_click?>><?=system_showText(LANG_QUICKLIST_REMOVE);?></a>
            </abbr>
            
            <? } ?>

        </div>

    </section>