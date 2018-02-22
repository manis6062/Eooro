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
	# * FILE: /theme/contractors/body/listing/detail_deal.php
	# ----------------------------------------------------------------------------------------------------
   
    if ($hasDeal) { ?>

    <div class="flex-box-title row-fluid">
        <h2><?=system_showText(LANG_LABEL_GREAT_OFFER);?></h2>
    </div>

    <div class="row-fluid flex-box-dashed">
        
        <div class="tag">
            <?=$promotionInfo["offer_percentage"];?>
        </div>
        
        <?=$promotionInfo["image"]?>
        
        <section>
            <h5>
                <a href="<?=$promotionInfo["url"];?>"><?=$promotionInfo["name"]?></a>
            </h5>
            <em><?=$promotionInfo["realValue"]?></em>
            <span class="text-warning"><?=CURRENCY_SYMBOL.$promotionInfo["price"].$promotionInfo["cents"]?></span>
        </section>
        
    </div>

    <? } ?>