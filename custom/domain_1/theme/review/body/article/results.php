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
	# * FILE: /theme/default/body/article/results.php
	# ----------------------------------------------------------------------------------------------------
	
	/*
	 * Prepare content to results
	 */
    include(ARTICLE_EDIRECTORY_ROOT."/searchresults.php");
    $filter_item = ARTICLE_FEATURE_FOLDER;
    include(EDIRECTORY_ROOT."/search_filters.php");
    
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid span12">

        <? if (count($filters) > 0 && $show_results) { ?>
        
        <div class="span3">
            
            <div id="return_filter" class="sidebar-filters">
                <? include(system_getFrontendPath("filters.php")); ?>
            </div>
            
        </div>

        <? } ?>

        <div class="span9">

            <? if ($show_results) {
                
                if (count($filters) > 0 && !$articles) {
                    
                ?>
                    <div class="noresults">
                        
                        <div class="resultsMessage">
                            <?=system_showText(LANG_SEARCH_NORESULTS);?>
                        </div>
                        
                    </div>
                <?
                
                } else {
                    
                    if ($aux_module_items && !$hideResults) { ?>
            
                        <div class="visible-phone btn btn-inverse" onclick="CloseFilters();">
                            <?=system_showText(LANG_LABEL_FILTER)?>
                        </div>
            
                    <? } ?>

                    <div class="tabview-results custom-select-listing">

                        <div id="resultsInfo_list">
                            <? include(system_getFrontendPath("results_filter.php"));?>
                        </div>

                    </div>

                    <? include(system_getFrontendPath("results_tabs.php")); ?>

                    <div id="content_listView">

                        <div class="results-info-listing">
                            <? include(system_getFrontendPath("results_info.php")); ?>
                            <? include(system_getFrontendPath("results_pagination.php"));?>
                        </div>

                        <? include(ARTICLE_EDIRECTORY_ROOT."/results_articles.php"); ?>

                        <div class="bottom-pagination-listing">
                            <? 
                            $pagination_bottom = true;
                            $showLetter = false;
                            include(system_getFrontendPath("results_pagination.php"));
                            ?>
                        </div>

                    </div>
                    <?
                }
            } else {
                
                if ($search_lock) { ?>
            
                    <p class="errorMessage">
                        <?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
                    </p>
                <? } else {
                    
                    $db = db_getDBObject();
                    if ($db->getRowCount("Article") > 0) { ?>
                    
                        <div class="resultsMessage">
                            <?=system_showText(LANG_SEARCH_NORESULTS);?>
                        </div>
                    
                    <? } else { ?>
                    
                        <p class="informationMessage">
                            <?=system_showText(LANG_MSG_NOARTICLES);?>
                        </p>
                        
                    <? }
                }
            }
            ?>
            
        </div>
    
	</div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>