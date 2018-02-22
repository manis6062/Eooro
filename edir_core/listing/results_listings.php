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
	# * FILE: /edir_core/listing/results_listings.php
	# ----------------------------------------------------------------------------------------------------
        if( isset($_POST['keyword']) && isset($_POST['zjletter']) ){
            foreach ($listings as $listing) {
                $ids_report_lote .= $listing["id"].",";
                if ($listing["latitude"] && $listing["longitude"]) {
                    $mapNumber++;
                }

                include( INCLUDES_DIR."/views/view_listing_letter.php" );

                if ($count%2 && ($count != 10) && ITEM_RESULTS_CLEAR){
                    echo "<br class=\"clear\" />";
                }
                $count--;
                
            }
            
        }
        else{
	if ($show_results || $search_lock) {

		if (!$listings) {

			if ($search_lock) { ?>
				<p class="errorMessage">
                    <?=system_showText(($search_lock_word ? str_replace("[FT_MIN_WORD_LEN]", FT_MIN_WORD_LEN, LANG_MSG_SEARCH_MIN_WORD_LEN) : LANG_MSG_LEASTONEPARAMETER))?>
                </p>
				<?
			} else {
				$db = db_getDBObject();
				if (true == true) { //$db->getRowCount("Listing_Summary") > 0 ?>
					<div class="resultsMessage">
                        <?
                        unset($aux_lang_msg_noresults);                        
                        $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]",DEFAULT_URL."/".ALIAS_CONTACTUS_URL_DIVISOR.".php", LANG_SEARCH_NORESULTS);

                        /**
                         * @ Add search Listing Modification
						 */

                        $url = $_SERVER['REQUEST_URI']; 
                   		$end = end((explode('/', $url)));

						$arr = explode('.',trim($end));
						if($arr[0] == "addsearchlisting"){
						$_GET['keyword'] = urlencode($_GET['keyword']);
						$url = NON_SECURE_URL. "/sponsors/listing/listing.php?level=10&listingtemplate_id=&keyword=".$_GET['keyword'];

							$message = "<h1 style='font-size:30px;'>Your business not listed?</h1><br>";
							$message .= "Don’t Panic, Try these<br><br>";
							$message .= "1. Check your spelling.<br><br>";
							$message .= "2. Shorten your search term e.g instead of “Acme Plumbing Limited” enter “Acme Plumbing” or “Acme”.<br><br>";
							$message .= "3. If you still can't find this company, simply click the Add New Company button below.<br><br>";
							$message .= '<a href = "' . $url . '"
										<button type="submit" class="btn btn-success pull-right">Add New Company &nbsp;<i class="fa fa-arrow-circle-right"></i></button>
										</a>';

							$aux_lang_msg_noresults = $message;

                         }

                        	echo $aux_lang_msg_noresults;


                        ?>
                <? //show No Results Search form only if the user searched on normal search box:: Add listing search box being exceptional
                  $url = $_SERVER['REQUEST_URI']; 
                   $end = end((explode('/', $url)));

						$arr = explode('.',trim($end));
						if($arr[0]!="addsearchlisting")

                         {  include(system_getFrontendPath("no_keyword.php")); }?>
					</div>
                <? } else { ?>
					<p class="informationMessage">
						<?=system_showText(LANG_MSG_NOLISTINGS);?>
					</p>
                <? }
			}
		} elseif ($listings) {

			$levelObj = new ListingLevel(true);
			$locationManager = new LocationManager();
			$mapNumber = 0;
			$count = 10;
			$ids_report_lote = "";
			
			/**
			 * This variable is used on view_listing_summary.php
			 */
			if (TWILIO_APP_ENABLED == "on"){
				if (TWILIO_APP_ENABLED_SMS == "on"){
					$levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
				}else{
					$levelsWithSendPhone = false;
				}
				if (TWILIO_APP_ENABLED_CALL == "on"){
					$levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
				}else{
					$levelsWithClicktoCall = false;
				}
			} else {
				$levelsWithSendPhone = false;
				$levelsWithClicktoCall = false;
			}
			
			$va = 0;
			foreach ($listings as $listing) {
				$ids_report_lote .= $listing["id"].",";
				if ($listing["latitude"] && $listing["longitude"]) {
					$mapNumber++;
				}
				
                                    include(INCLUDES_DIR."/views/view_listing_summary.php");

                if ($count%2 && ($count != 10) && ITEM_RESULTS_CLEAR){
                    echo "<br class=\"clear\" />";
                }
				$count--;
             $va++;   
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
            if (!$openMap) {
                report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);
            }
		}
	}
        }
?>