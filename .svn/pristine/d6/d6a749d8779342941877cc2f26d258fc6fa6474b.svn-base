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
	# * FILE: /mobile/dealview.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="itemView dealView thumbnail">
        
		<div class="row-fluid">
            
			<div class="deal-info">
                
                <? if ($imagePath) { ?>
                    <div class="image span4 pull-left img-polaroid">
                        <a href="<?=$promotionLink;?>"><img src="<?=$imagePath?>" /></a>
                    </div>
                <? } ?>
                
				<h4>
                    <a href="<?=$promotionLink?>"><?=$promotion->getString("name", true, false);?></a>                 
                    <div  class="price">
                        <? if ($sold_out) { ?>
                            <h4><?=system_showText(DEAL_SOLDOUT);?></h4>
                        <? } else { ?>
                            <h4><?=CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "");?> - <?=$offer." ".OFF?></h4>
                        <? } ?>
                    </div>  
				</h4>
                
			</div>   
		</div>
        
        <p><?=$promotion_desc;?></p>
		
	</div>