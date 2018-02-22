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
	# * FILE: /theme/contractors/body/listing/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedListing2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_listing.php");

    if (is_array($array_show_listings)) { ?>
    
        <div class="flex-box-title row-fluid">
            <h2>
                <?=system_showText(LANG_FEATURED_LISTING);?>
                
                <? if (LISTING_SCALABILITY_OPTIMIZATION != "on") { ?>
                    <a rel="canonical" class="view-more" href="<?=LISTING_DEFAULT_URL."/results.php"?>"><?=system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);?> »</a>
                <? } ?>   
            </h2>
        </div>
    
    <?
    
        $countSpecialItem = 0;
        $lastItemStyle = 0;
        
        for ($i = 0; $i < count($array_show_listings); $i++) {
          
            if (!($lastItemStyle % 3)) { ?>

            <div class="row-fluid">

            <? } ?>

                <div class="span4 flex-box color-3">

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

            <? 
            
            $lastItemStyle++;
            
            if (!($lastItemStyle % 3) || $lastItemStyle >= count($array_show_listings) || $lastItemStyle == $numberOfListings) { ?>

            </div>

            <? }
        }
    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedListing2-->