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
	# * FILE: /edir_core/deal/results_events.php
	# ----------------------------------------------------------------------------------------------------

	if ($show_results) {

		if (!$promotions) {

			if ($search_lock) {?>
				<p class="errorMessage">
					<?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
				</p>
				<?
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Promotion") > 0) { ?>
					<div class="resultsMessage">
                        <?
                        unset($aux_lang_msg_noresults);                        
                        $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]", DEFAULT_URL."/".ALIAS_CONTACTUS_URL_DIVISOR.".php", LANG_SEARCH_NORESULTS);
                        echo $aux_lang_msg_noresults;
                        ?>
					</div>
                <? } else { ?>
					<p class="informationMessage">
						<?=system_showText(LANG_MSG_NOPROMOTIONS);?>
					</p>
                <? }
			}
		} elseif ($promotions){
			
			$mapNumber = 0;
			$count = 10;
            $ids_report_lote = "";
	
			foreach ($promotions as $promotion) {
				
                $ids_report_lote .= $promotion->getNumber("id").",";
				$listingObj = new Listing($promotion->getNumber("listing_id"));

				if ($listingObj->getNumber("id")) {
					if ($listingObj->getString("latitude") && $listingObj->getString("longitude")){
						$mapNumber++;
					}
				}
				
				include(INCLUDES_DIR."/views/view_promotion_summary.php");
				$count--;
			}
            $ids_report_lote = string_substr($ids_report_lote, 0, -1);
            if (!$openMap) {
                report_newRecord("promotion", $ids_report_lote, PROMOTION_REPORT_SUMMARY_VIEW, true);
            }
		}
	}
?>