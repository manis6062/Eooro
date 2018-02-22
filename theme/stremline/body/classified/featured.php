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
	# * FILE: /theme/default/body/classified/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_classified.php");
	
    if (is_array($array_show_classifieds)) {
    
        $lastItemStyle = 0;
        
        for ($i = 0; $i < count($array_show_classifieds); $i++) {

            if (!($lastItemStyle % 2)) { ?>
                
            <div class="row-fluid">
    
            <? } ?>
                
                
            <div class="span6 flex-box color-2">

                <h2>
                    <a href="<?=$array_show_classifieds[$i]["detailLink"]?>">
                        <?=$array_show_classifieds[$i]["title"]?>
                    </a>
                    <?=($array_show_classifieds[$i]["price"] ? "<span>".CURRENCY_SYMBOL.$array_show_classifieds[$i]["price"]."</span>" : "")?>
                </h2>
                
                <a href="<?=$array_show_classifieds[$i]["detailLink"]?>">
                    <? if ($array_show_classifieds[$i]["image_tag"]) { ?>
                        <?=$array_show_classifieds[$i]["image_tag"]?>
                    <? } else { ?>
                        <span class="no-image"></span>
                    <? } ?>
                </a>

                <section>
                                        
                    <p><?=$array_show_classifieds[$i]["description"]?></p>
                    
                </section>

            </div>
                
            <? 
            
            $lastItemStyle++;
            
            if (!($lastItemStyle % 2) || $lastItemStyle == count($array_show_classifieds) || $lastItemStyle == $numberOfClassifieds) { ?>
                
            </div>
    
            <? }

        }

    }
	// Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedClassified2-->