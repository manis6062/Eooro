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
	# * FILE: /theme/diningguide/body/listing/results.php
	# ----------------------------------------------------------------------------------------------------
	
	/*
	 * Prepare content to results
	 */
	include(LISTING_EDIRECTORY_ROOT."/searchresults.php");
    $filter_item = LISTING_FEATURE_FOLDER;
    include(EDIRECTORY_ROOT."/search_filters.php");
    
?>
    <div class="content-center">

        <? 
    //    if ($listings && $show_results) { 
        if ((count($filters) > 0) && $show_results) { 
            ?>
       
            <div id="return_filter" class="sidebar sidebar-filters">
                <?
                include(system_getFrontendPath("filters.php")); 
                ?>
            </div>
            <? 
        } 
        ?>
        <div class="content content-results-filters">
            
            <? 
            if($show_results){
                
                if((count($filters) > 0) && !$listings){
                    $show_tabs_on_no_results = true;
                    include(system_getFrontendPath("results_tabs.php")); 
                    ?>
                    <div class="noresults">
                        <?
                        
                        echo $array_pages_code["total"]." ".(($array_pages_code["total"] != 1) ? (system_showText(LANG_RESULTS)) : (system_showText(LANG_RESULT))).$str_search."<br />";
                        if(is_array($aux_original_search)){
                            $aux_original_search = implode("&",$aux_original_search);
                            $aux_link = LISTING_DEFAULT_URL."/results.php"."?".$aux_original_search;
                        }else{
                            
                            $aux_link = LISTING_DEFAULT_URL."/results.php";
                        }
                        
                        ?>
                        <h3><?=system_showText(LANG_LABEL_FILTER_NO_MATCHES)?></h3>
                        <a href="<?=$aux_link?>"><?=system_showText(LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH)?></a>
                    </div>
                    <?
                }else{
                    if ($aux_module_items && !$hideResults) { 
                        ?>
                        <div class="visible-phone btn btn-inverse" onclick="CloseFilters();">
                            <?=system_showText(LANG_LABEL_FILTER)?>
                        </div>
                        <? 
                    } 
                    ?>

                    <div class="tabview-results custom-select-listing">

                        <div id="resultsInfo_list" <?=($openMap ? "style=\"display: none;\"" : "");?>>
                            <? include(system_getFrontendPath("results_pagination_default.php"));?>
                            <? include(system_getFrontendPath("results_filter_default.php"));?>
                        </div>

                        <div id="resultsInfo_map" <?=(!$openMap ? "style=\"display: none;\"" : "");?>>
                            <?
                            $addId = true;
                            include(system_getFrontendPath("results_info_default.php"));
                            $addId = false;
                            ?>
                        </div>

                    </div>

                    <? include(system_getFrontendPath("results_tabs.php")); ?>

                    <div id="content_listView" <?=($openMap ? "style=\"display: none;\"" : "");?>>

                        <div class="results-info-listing">
                            <? include(system_getFrontendPath("results_info_default.php")); ?>
                        </div>

                        <? include(LISTING_EDIRECTORY_ROOT."/results_listings.php"); ?>

                        <div class="bottom-pagination-listing">
                            <? 
                            $pagination_bottom = true;
                            $showLetter = false;
                            include(system_getFrontendPath("results_pagination_default.php"));
                            ?>
                        </div>

                    </div>
                    <? 
                    $ajaxMap = true; include(system_getFrontendPath("results_maps.php")); 
                }
            }else{
                
                if ($search_lock) {
                    ?>
                    <p class="errorMessage">
                        <?=system_showText(($search_lock_word ? str_replace("[FT_MIN_WORD_LEN]", FT_MIN_WORD_LEN, LANG_MSG_SEARCH_MIN_WORD_LEN) : LANG_MSG_LEASTONEPARAMETER))?>
                    </p>
                    <?
                } else {
                    $db = db_getDBObject();
                    if ($db->getRowCount("Listing_Summary") > 0) { ?>
                        <div class="resultsMessage">
                            <?
                            unset($aux_lang_msg_noresults);                        
                            $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]",DEFAULT_URL."/".ALIAS_CONTACTUS_URL_DIVISOR.".php", LANG_SEARCH_NORESULTS);
                            echo $aux_lang_msg_noresults;
                            ?>
                        </div>
                    <? } else { ?>
                        <p class="informationMessage">
                            <?=system_showText(LANG_MSG_NOLISTINGS);?>
                        </p>
                    <? }
                }
            }
            ?>
        </div>
    
	</div>