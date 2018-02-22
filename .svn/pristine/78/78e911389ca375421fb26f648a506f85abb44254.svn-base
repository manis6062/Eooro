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
	# * FILE: /mobile/listingview.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="listings-summary thumbnails">
        
        <div class="itemView listingView thumbnail">
            
            <div class="row-fluid">	

                <? if ($listingtemplate_image) { ?>
                    <div class="image span4 pull-left img-polaroid">
                        <?=$listingtemplate_image?>
                    </div>
                <? } ?>
                
                <h4>
                    <? if ($detailLink) { ?>
                        <a href="<?=$detailLink?>">
                    <? } ?>

                    <?=$listingtemplate_title;?>

                    <? if ($detailLink) { ?>
                        </a>
                    <? } ?>
                </h4>
                
                <? if ($listingtemplate_description) { ?>
                    <p>
                        <?=$listingtemplate_description?>
                    </p>
                <? } ?>
                
            </div>	

            <? if ($listingtemplate_location || $listingtemplate_phone || $listingtemplate_url) { ?>
                <address>
                    <? if ($listingtemplate_location) { ?>
                    <p>
                        <i class="icon-map-marker"></i> <?=$listingtemplate_location?>	
                    </p>
                    <? } ?>
                    
                    <? if ($listingtemplate_phone) { ?>
                    <p>
                        <i class="icon-phone"></i> <?=$listingtemplate_phone?>	
                    </p>
                    <? }

                    if ($listingtemplate_url) { ?>
                    <p>
                        <i class="icon-globe"></i> <?=$listingtemplate_url?>
                    </p>
                    <? } ?>
                </address>
            <? } ?>
            
            <? if ($detailLink) { ?>
                <div class="navafter">
                    <a href="<?=$detailLink?>"><?=system_showText(LANG_VIEW_LISTING)?></a>
                </div>
            <? } ?>

        </div>
        
    </div>