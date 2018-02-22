

<?

$thePageTitle = '<h3>Search Results:</h3>';
//include(system_getFrontendPath("review_banner.php"));
/*
 * Prepare content to results
 */
include(LISTING_EDIRECTORY_ROOT."/searchresults.php");
$filter_item = LISTING_FEATURE_FOLDER;
include(EDIRECTORY_ROOT."/search_filters.php");

include(system_getFrontendPath("sitecontent_top.php")); 
$scriptlocation = EDIRECTORY_FOLDER."/scripts/scrollviewer.min.js"; 
?>



<section class="latest-review cusreview">
    <div class="container">
        <? if ($show_results) {

            if (count($filters) > 0 && !$listings) {

            ?>
                <div class="noresults">

                    <div class="resultsMessage">
                        <?=system_showText(LANG_SEARCH_NORESULTS);?>
                    </div>

                </div>
            <?

            } else { // results are returned...?>
                <div id="content_listView" <?=($openMap ? "style=\"display: none;\"" : "");?> class="col-sm-9 cuscato">

                    <div class="results-info-listing">
                        <? include(system_getFrontendPath("results_info.php")); ?>
                    </div>

                    <? include(LISTING_EDIRECTORY_ROOT."/results_listings.php"); ?>
                </div>
                <? 
                $ajaxMap = true;
                //include(system_getFrontendPath("results_maps.php")); 
            }
        } else {

            if ($search_lock) { ?>

               <!--  <p class="errorMessage">
                    <?=system_showText(($search_lock_word ? str_replace("[FT_MIN_WORD_LEN]", FT_MIN_WORD_LEN, LANG_MSG_SEARCH_MIN_WORD_LEN) : LANG_MSG_LEASTONEPARAMETER))?>
                </p> -->
            <? } else {

                $db = db_getDBObject();
                if ($db->getRowCount("Listing_Summary") > 0) { ?>

                    <div class="resultsMessage">
                        <?=system_showText(LANG_SEARCH_NORESULTS);?>
                    </div>

                <? } else { ?>

                    <p class="informationMessage">
                        <?=system_showText(LANG_MSG_NOLISTINGS);?>
                    </p>

                <? }
            }
        }
        ?>


<? include(system_getFrontendPath("sitecontent_bottom.php")); ?>
</section>
<script src="<?=$scriptlocation;?>"></script>