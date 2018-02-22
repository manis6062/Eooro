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
	# * FILE: /mobile/listings.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Listing Home";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
        
    include("./breadcrumb.php");
      
    $level = implode(",", system_getLevelDetail("ListingLevel"));
    
    if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random", true);
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Listing_Summary.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY ".($searchReturn["order_by"] ? $searchReturn["order_by"] : " `Listing_FeaturedTemp`.`random_number` ")." LIMIT ".MAX_ITEM_INDEXRESULTS."";
		$listings = db_getFromDBBySQL("listing", $sql, "array");
	}
   
    if (is_array($listings)) {
        
        $levelObj = new ListingLevel(true);
        $isMobileSummary = true;
        $user = true;
        
		foreach ($listings as $listing) {
            
            include(INCLUDES_DIR."/views/view_listing_summary.php");
            
			include("./listingview.php");
            
		}
        
        if (LISTING_SCALABILITY_OPTIMIZATION != "on") { ?>
            <a href="<?=MOBILE_DEFAULT_URL."/listingresults.php"?>" class="btn btn-primary span12"><?=system_showText(LANG_LABEL_MORELISTINGS);?></a>
        <? } ?>
        
	<? } else { ?>
        
        <p class="warning"><?=system_showText(LANG_MSG_NO_RESULTS_FOUND)?></p>
        
	<? } ?>
        
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>