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
	# * FILE: /mobile/classifiedresults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Classified Results";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
	# PREPARE RESULTS
	# ----------------------------------------------------------------------------------------------------
    //Order by selector
    $paging_url_mobile = MOBILE_DEFAULT_URL."/classifiedresults.php";
    include(EDIR_CONTROLER_FOLDER."/".CLASSIFIED_FEATURE_FOLDER."/results.php");
    
    if (!$screen) $screen = 1;

	$message_search_for = "<p class=\"searchResults no-border\">".system_showText(LANG_SEARCHRESULTS)." ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <span class=\"bold\">".$keyword."</span></p>";
    
    include("./breadcrumb.php");
    
?>

	<div class="results">
        <? if (is_array($classifieds)) {
                       
            if ($keyword) echo $message_search_for;

            $item_total_amount = intval($pageObj->getString("record_amount"));
            $item_amount = count($classifieds);

            if ($item_amount > 0) {

                include("./searchstatistics.php");
                
                echo $orderbyDropDown;

        ?>       
                <div class="row-fluid summary">
                    <?
                    $level = new ClassifiedLevel(true);
                    $isMobileSummary = true;
                    $user = true;

                    foreach ($classifieds as $classified) {
                        
                        include(INCLUDES_DIR."/views/view_classified_summary.php");
                        
                        include("./classifiedview.php");
                    }

                    include("./paging.php"); ?>
                </div>
        <?
            } else {
                echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
            }

        } elseif ($search_lock) {
            echo "<p class=\"warning\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
        } else {
            echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
        }
        ?>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>