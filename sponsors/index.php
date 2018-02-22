<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /members/index.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
extract($_GET);
extract($_POST);

//CHECK First name & User name if user is logged in via google
$contactObj = new Contact($_SESSION["SESS_ACCOUNT_ID"]);
$contactArray = (array) $contactObj;
$cleanedContactArray = HtmlCleaner::CleanBasic($contactArray);
$contactObj = new Contact($cleanedContactArray);

$first_name = $contactObj->first_name;
$last_name = $contactObj->last_name;

#-----------------------------------------------------------------------------------------------------
# If user has no listings, send him to profile page
#-----------------------------------------------------------------------------------------------------

if (!strpos($_SERVER['HTTP_REFERER'], 'profile')) {
    $AccountObj = new Account(sess_getAccountIdFromSession());
    $listings = Listing::getListingCountByAccountId($AccountObj->id);
    if ($listings < 1) {
        $url = SOCIALNETWORK_URL . "/index.php";
        if ($_GET['messageAct']) {
            $url .= '?messageAct=1';
        }
        header('Location:' . $url);
        exit;
    }
}
# ----------------------------------------------------------------------------------------------------
# SUBMIT - DELETE ITEMS
# ----------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($hiddenValue) { //Delete
        $id = intval($hiddenValue);

        switch ($module) {
            case "banner" :
                $itemObj = new Banner($id);
                $message = 0;
                break;
            case "article" :
                $itemObj = new Article($id);
                $message = 2;
                break;
            case "classified" :
                $itemObj = new Classified($id);
                $message = 2;
                break;
            case "event" :
                $itemObj = new Event($id);
                $message = 2;
                break;
            case "promotion" :
                $itemObj = new Promotion($id);
                $message = 4;
                break;
                break;
        }

        if (sess_getAccountIdFromSession() != $itemObj->getNumber("account_id")) {
            header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
            exit;
        }

        $itemObj->delete();

        header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/index.php?&module=$module&message=$message");
        exit;
    }
}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

/*
 * Get sponsor's items
 */
$acctId = sess_getAccountIdFromSession();
$sponsorItems = array();
$status = new ItemStatus();
$arrayForms = array();

//Listings
$sql = "SELECT id, level, title, status, friendly_url, promotion_id FROM Listing WHERE account_id = $acctId ORDER BY level, title";
$listings = db_getFromDBBySQL("listing", $sql, "array", false, SELECTED_DOMAIN_ID);
$level = new ListingLevel(true);
$levelValues = $level->getLevelValues();
$levelDefault = $level->getLevel($level->getDefaultLevel());
$activeLevels = array();
foreach ($levelValues as $levelValue) {
    if ($level->getActive($levelValue) == 'y') {
        $activeLevels[] = $levelValue;
    }
}

foreach ($listings as $listing) {

    //Modificaton: Listing pending, show data from Listing Pending

    if ($listing['status'] == "P") {
        $listing = (array) new ListingPending($listing['id']);
    }

    $item = array();
    $item["module"] = "listing";
    $item["label"] = system_showText(LANG_LISTING_FEATURE_NAME);
    $item["level"] = "(" . (in_array($listing["level"], $activeLevels) ? $level->showLevel($listing["level"]) : string_ucwords($levelDefault)) . ")";
    $item["status"] = $listing["status"];
    $item["status_label"] = $status->getStatus($listing["status"]);
    $item["status_style"] = $status->getStatusWithStyle($listing["status"]);
    $item["title"] = $listing["title"];
    $item["id"] = $listing["id"];
    $listingHasPromotion = $level->getHasPromotion($listing["level"]);
    if (!$listing["promotion_id"] && $listingHasPromotion == "y" && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
        $item["link_promotion"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . PROMOTION_FEATURE_FOLDER . "/deal.php?listing_id=" . $listing["id"];
    }
    $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/listing.php?id=" . $listing["id"];
    $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/preview.php?id=" . $listing["id"];
    $item["clickFunction"] = "onclick=\"loadDashboard('Listing', {$listing["id"]})\"";

    if (!count($sponsorItems)) {
        $item["class"] = "active";
        $firstItem = "Listing";
        $firstItemId = $listing["id"];
    }

    $sponsorItems[] = $item;
}

//Promotions
if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {

    $sql = "SELECT id, name, listing_id FROM Promotion WHERE account_id = $acctId ORDER BY name";
    $promotions = db_getFromDBBySQL("promotion", $sql, "array", false, SELECTED_DOMAIN_ID);

    if (count($promotions)) {

        $arrayForms[] = "promotion";

        foreach ($promotions as $promotion) {
            $item = array();
            $item["module"] = "promotion";
            $item["label"] = system_showText(LANG_PROMOTION_FEATURE_NAME);
            $item["title"] = $promotion["name"];
            $item["id"] = $promotion["id"];
            $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . PROMOTION_FEATURE_FOLDER . "/deal.php?id=" . $promotion["id"];
            $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . PROMOTION_FEATURE_FOLDER . "/preview.php?id=" . $promotion["id"];
            $item["link_remove"] = "dialogBox('confirm', '" . system_showText(LANG_PROMOTION_DELETE_CONFIRM) . "', " . $promotion["id"] . ", 'delete_promotion', '200', '" . system_showText(LANG_BUTTON_OK) . "', '" . system_showText(LANG_BUTTON_CANCEL) . "');";
            if (!$promotion["listing_id"]) {
                $item["alert_deal"] = system_showText(LANG_LABEL_NOTLINKED);
            }
            $item["clickFunction"] = "onclick=\"loadDashboard('Promotion', {$promotion["id"]})\"";

            if (!count($sponsorItems)) {
                $item["class"] = "active";
                $firstItem = "Promotion";
                $firstItemId = $promotion["id"];
            }

            $sponsorItems[] = $item;
        }
    }
}

//Banners
if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {

    $sql = "SELECT id, type, caption, status FROM Banner WHERE account_id = $acctId ORDER BY caption";
    $banners = db_getFromDBBySQL("banner", $sql, "array", false, SELECTED_DOMAIN_ID);
    $level = new BannerLevel(true);
    $levelValues = $level->getLevelValues();
    $levelDefault = $level->getLevel($level->getDefaultLevel());
    $activeLevels = array();
    foreach ($levelValues as $levelValue) {
        if ($level->getActive($levelValue) == "y") {
            $activeLevels[] = $levelValue;
        }
    }

    if (count($banners)) {

        $arrayForms[] = "banner";

        foreach ($banners as $banner) {
            $item = array();
            $item["module"] = "banner";
            $item["label"] = system_showText(LANG_BANNER_FEATURE_NAME);
            $item["level"] = "(" . (in_array($banner["level"], $activeLevels) ? $level->showLevel($banner["level"]) : string_ucwords($levelDefault)) . ")";
            $item["status"] = $banner["status"];
            $item["status_label"] = $status->getStatus($banner["status"]);
            $item["status_style"] = $status->getStatusWithStyle($banner["status"]);
            $item["title"] = $banner["caption"];
            $item["id"] = $banner["id"];
            $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . BANNER_FEATURE_FOLDER . "/edit.php?id=" . $banner["id"];
            $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . BANNER_FEATURE_FOLDER . "/preview.php?id=" . $banner["id"];
            $item["link_remove"] = "dialogBox('confirm', '" . system_showText(LANG_BANNER_DELETE_CONFIRM) . "', " . $banner["id"] . ", 'delete_banner', '200', '" . system_showText(LANG_BUTTON_OK) . "', '" . system_showText(LANG_BUTTON_CANCEL) . "');";
            $item["clickFunction"] = "onclick=\"loadDashboard('Banner', {$banner["id"]})\"";

            if (!count($sponsorItems)) {
                $item["class"] = "active";
                $firstItem = "Banner";
                $firstItemId = $banner["id"];
            }

            $sponsorItems[] = $item;
        }
    }
}

if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

    $sql = "SELECT id, level, title, status, friendly_url FROM Event WHERE account_id = $acctId ORDER BY level, title";
    $events = db_getFromDBBySQL("event", $sql, "array", false, SELECTED_DOMAIN_ID);
    $level = new EventLevel(true);
    $levelValues = $level->getLevelValues();
    $levelDefault = $level->getLevel($level->getDefaultLevel());
    $activeLevels = array();
    foreach ($levelValues as $levelValue) {
        if ($level->getActive($levelValue) == 'y') {
            $activeLevels[] = $levelValue;
        }
    }

    if (count($events)) {

        $arrayForms[] = "event";

        foreach ($events as $event) {
            $item = array();
            $item["module"] = "event";
            $item["label"] = system_showText(LANG_EVENT_FEATURE_NAME);
            $item["level"] = "(" . (in_array($event["level"], $activeLevels) ? $level->showLevel($event["level"]) : string_ucwords($levelDefault)) . ")";
            $item["status"] = $event["status"];
            $item["status_label"] = $status->getStatus($event["status"]);
            $item["status_style"] = $status->getStatusWithStyle($event["status"]);
            $item["title"] = $event["title"];
            $item["id"] = $event["id"];
            $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . EVENT_FEATURE_FOLDER . "/event.php?id=" . $event["id"];
            $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . EVENT_FEATURE_FOLDER . "/preview.php?id=" . $event["id"];
            $item["link_remove"] = "dialogBox('confirm', '" . system_showText(LANG_EVENT_DELETE_CONFIRM) . "', " . $event["id"] . ", 'delete_event', '200', '" . system_showText(LANG_BUTTON_OK) . "', '" . system_showText(LANG_BUTTON_CANCEL) . "');";
            $item["clickFunction"] = "onclick=\"loadDashboard('Event', {$event["id"]})\"";

            if (!count($sponsorItems)) {
                $item["class"] = "active";
                $firstItem = "Event";
                $firstItemId = $event["id"];
            }

            $sponsorItems[] = $item;
        }
    }
}

//Classifieds
if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

    $sql = "SELECT id, level, title, status, friendly_url FROM Classified WHERE account_id = $acctId ORDER BY level, title";
    $classifieds = db_getFromDBBySQL("classified", $sql, "array", false, SELECTED_DOMAIN_ID);
    $level = new ClassifiedLevel(true);
    $levelValues = $level->getLevelValues();
    $levelDefault = $level->getLevel($level->getDefaultLevel());
    $activeLevels = array();
    foreach ($levelValues as $levelValue) {
        if ($level->getActive($levelValue) == 'y') {
            $activeLevels[] = $levelValue;
        }
    }

    if (count($classifieds)) {

        $arrayForms[] = "classified";

        foreach ($classifieds as $classified) {
            $item = array();
            $item["module"] = "classified";
            $item["label"] = system_showText(LANG_CLASSIFIED_FEATURE_NAME);
            $item["level"] = "(" . (in_array($classified["level"], $activeLevels) ? $level->showLevel($classified["level"]) : string_ucwords($levelDefault)) . ")";
            $item["status"] = $classified["status"];
            $item["status_label"] = $status->getStatus($classified["status"]);
            $item["status_style"] = $status->getStatusWithStyle($classified["status"]);
            $item["title"] = $classified["title"];
            $item["id"] = $classified["id"];
            $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . CLASSIFIED_FEATURE_FOLDER . "/classified.php?id=" . $classified["id"];
            $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . CLASSIFIED_FEATURE_FOLDER . "/preview.php?id=" . $classified["id"];
            $item["link_remove"] = "dialogBox('confirm', '" . system_showText(LANG_CLASSIFIED_DELETE_CONFIRM) . "', " . $classified["id"] . ", 'delete_classified', '200', '" . system_showText(LANG_BUTTON_OK) . "', '" . system_showText(LANG_BUTTON_CANCEL) . "');";
            $item["clickFunction"] = "onclick=\"loadDashboard('Classified', {$classified["id"]})\"";

            if (!count($sponsorItems)) {
                $item["class"] = "active";
                $firstItem = "Classified";
                $firstItemId = $classified["id"];
            }

            $sponsorItems[] = $item;
        }
    }
}

if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

    $sql = "SELECT id, level, title, status, friendly_url FROM Article WHERE account_id = $acctId ORDER BY title";
    $articles = db_getFromDBBySQL("article", $sql, "array", false, SELECTED_DOMAIN_ID);
    $level = new ArticleLevel(true);
    $levelValues = $level->getLevelValues();
    $levelDefault = $level->getLevel($level->getDefaultLevel());
    $activeLevels = array();
    foreach ($levelValues as $levelValue) {
        if ($level->getActive($levelValue) == 'y') {
            $activeLevels[] = $levelValue;
        }
    }

    if (count($articles)) {

        $arrayForms[] = "article";

        foreach ($articles as $article) {
            $item = array();
            $item["module"] = "article";
            $item["label"] = system_showText(LANG_ARTICLE_FEATURE_NAME);
            $item["status"] = $article["status"];
            $item["status_label"] = $status->getStatus($article["status"]);
            $item["status_style"] = $status->getStatusWithStyle($article["status"]);
            $item["title"] = $article["title"];
            $item["id"] = $article["id"];
            $item["link_edit"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . ARTICLE_FEATURE_FOLDER . "/article.php?id=" . $article["id"];
            $item["link_preview"] = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . ARTICLE_FEATURE_FOLDER . "/preview.php?id=" . $article["id"];
            $item["link_remove"] = "dialogBox('confirm', '" . system_showText(LANG_ARTICLE_DELETE_CONFIRM) . "', " . $article["id"] . ", 'delete_article', '200', '" . system_showText(LANG_BUTTON_OK) . "', '" . system_showText(LANG_BUTTON_CANCEL) . "');";
            $item["clickFunction"] = "onclick=\"loadDashboard('Article', {$article["id"]})\"";

            if (!count($sponsorItems)) {
                $item["class"] = "active";
                $firstItem = "Article";
                $firstItemId = $article["id"];
            }

            $sponsorItems[] = $item;
        }
    }
}

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");
echo '<section class="ReviewerProfileBusinessMenu Business">';
echo (EDIR_THEME === 'review') ? '<div class="container">' : '';
$contentObj = new Content();



//Your account is not activated.
if ($accountObj->active != "y") {
    echo "<div class=\"content-custom alert alert-danger\"><strong><font color = \"red\">Your account is not activated. Please activate it. <a class='forcePointer' onclick='sendEmailActivation(" . $accountObj->id . ")';>Click here to resend activation email.</a></font><img id='loadEmail99' style='display:none;' src=" . DEFAULT_URL . "/images/img_loading.gif></strong></div>";
}
$reviewer_info = new Profile($_SESSION['SESS_ACCOUNT_ID']);
$content = $contentObj->retrieveContentByType("Sponsor Home");

if (trim($contactObj->first_name) != '') {
    $name = $contactObj->first_name . ' ' . $contactObj->last_name;
} else if (trim($contactObj->first_name) == '' && trim($reviewer_info->nickname) != '') {
    $name = $reviewer_info->nickname;
} else {
    $email = $contactObj->email;
    $f_name = explode('@', $email);
    $name = $f_name[0];
}



// $name = $contactObj->first_name;
// $laname= $contactObj->last_name;
$content = '<ul class="nav nav-tabs" role="tablist">
	    			<li role="presentation" class="bgeee"><a href="' . DEFAULT_URL . "/" . SOCIALNETWORK_FEATURE_NAME . "/" . '">Reviewer</a></li>
	    			<li role="presentation" class="active"><a aria-controls="BusinessMenu" class="bgeee" role="tab" data-toggle="tab">Business</a></li>
<button class="add-business profile pull-left " onclick="AddBusiness()"><i class="fa fa-plus"></i> Add New Business</button>	    			
<span class="profile pull-right">Welcome, ' . (ucwords($name)) . '</span>
				</ul>';
if ($content) {
    echo "<div class=\"content-custom BusinessMenu\">" . $content . "</div>";
}

//Success and error messages
if (is_numeric($message) && isset(${"msg_" . $module}[$message])) {
    ?>
    <?
    $elect = ${"msg_" . $module}[$message];
    $title = $_SESSION['listing_title1'];
    $mess = $title . ": " . $elect;
    ?>
    <div id="alert" class="alert alert-<?= ($class ? $class : "success") ?>">
    <?= $mess; ?>
    </div>

<? } ?>

<div class="row-fluid responsive">
    <div id="spinner" align="center" class="businessSpinner" style="display:none;margin-left:570px;position: absolute;">
        <i class="fa fa-circle-o-notch fa-spin cus-spin" style="color:#FF004F;margin-top:50px;font-size:70pt;"></i><br>
        <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
    </div>

    <?
    require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
    require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");

    $contentObj = new Content();
    $content = $contentObj->retrieveContentByType("Sponsor Home Bottom");

    if ($firstItemId) {
        $itemObj = new $firstItem($firstItemId);
        $itemObj->status == "P" ? $itemObj = new ListingPending($firstItemId) : null;
        ?>

        <? include(MEMBERS_EDIRECTORY_ROOT . "/layout/navbar.php"); ?>
        <div class="Buinessdashboard-wrapper">
            <div id="dashboard">            
        <?
        if ($firstItemId) {
            //Prepare code for dashboard
            $item_type = $firstItem;
            $item_id = $firstItemId;

            include(INCLUDES_DIR . "/code/member_dashboard.php");

            //Build dashboard
            include(INCLUDES_DIR . "/views/view_member_dashboard.php");
        }

        if ($content) {
            ?>
                    <div class="content-custom"><?= $content ?></div>

                <? } ?>

                <? include_once("layout/navbar_footer.php") ?>

                <script>
                    $('#listing_id_text_box').val(<?= $firstItemId ?>);
                    //For First listing
                    prvhref = $("#prv").attr("href");
                    $("#prv").attr('href', prvhref +<?= $firstItemId ?>);
                </script>

            </div>
        </div>

<?
} else {

    include(MEMBERS_EDIRECTORY_ROOT . "/layout/navbar_new_account.php");
    include(INCLUDES_DIR . "/views/view_no_listings.php");
    include_once("layout/navbar_footer.php");
}
?>


</div>
    <?= (EDIR_THEME === 'review') ? '</div>            </section>' : '' ?>
    <?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
    ?>

<script language="javascript" type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/activationEmail.js"></script>


<script type="text/javascript">

                if ($("#myChart").length) {
                    //This will get the first returned node in the jQuery collection.
                    var ctx = $("#myChart").get(0).getContext("2d");
                }

                function initializeDashboard() {
                    $(".dial").knob({
                        readOnly: true,
                        fgColor: "#<?= $colorKnob; ?>",
                        bgColor: "#DEE1E3",
                        fontWeight: 300,
                        thickness: .2,
                        width: 70,
                        height: 70
                    });

                    $(".status, .floating-tip, .alert-new, #item_renewal").tooltip({
                        animation: true,
                        placement: "top"
                    });

                    if ($("#myChart").length) {
                        //Get context with jQuery - using jQuery's .get() method.
                        ctx = $("#myChart").get(0).getContext("2d");
                        loadChart();
                    }
                }

                $(function () {
                    $("#alert").fadeOut(5000);
                    initializeDashboard();
                });

                function showReply(id) {
                    $('#review_reply' + id).css('display', '');
                    $('#link_reply' + id).css('display', 'none');
                    $('#cancel_reply' + id).css('display', '');
                }

                function hideReply(id) {
                    $('#review_reply' + id).css('display', 'none');
                    $('#link_reply' + id).css('display', '');
                    $('#cancel_reply' + id).css('display', 'none');
                }

                function showLead(id) {
                    $('#lead_reply' + id).css('display', '');
                    $('#link_lead' + id).css('display', 'none');
                    $('#cancel_lead' + id).css('display', '');
                }

                function hideLead(id) {
                    $('#lead_reply' + id).css('display', 'none');
                    $('#link_lead' + id).css('display', '');
                    $('#cancel_lead' + id).css('display', 'none');
                }

                function saveReply(id) {

                    var message = $('textarea#reply' + id).val();
                    $("#submitReply" + id).css("cursor", "default");
                    $("#submitReply" + id).prop("disabled", "disabled");
                    $("#submitReply" + id).html('<?= system_showText(LANG_WAITLOADING); ?>');

                    $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>", $("#formReply" + id).serialize(), function (data) {
                        if (data.trim() == "ok") {
                            $("#msgReviewE" + id).css("display", "none");

                            $("#msgReviewS" + id).css("display", "");
                            $("#msgReviewS" + id).fadeOut(5000);

                            $("#rep" + id).css("display", "");
                            $("#text" + id).css("display", "");
                            $('#rep' + id).text('');
                            $("#rep" + id).append('<p>"' + message + '"</p>');
                            $('#reply' + id).val('');

                        } else {
                            $("#msgReviewE" + id).css("display", "");
                            $("#msgReviewS" + id).css("display", "none");
                        }
                        $("#submitReply" + id).html('<?= system_showText(LANG_BUTTON_SUBMIT); ?>');
                        $("#submitReply" + id).prop("disabled", "");
                        $("#submitReply" + id).css("cursor", "pointer");
                    });
                }

                function saveLead(id) {
                    $("#submitLead" + id).css("cursor", "default");
                    $("#submitLead" + id).prop("disabled", "disabled");
                    $("#submitLead" + id).html('<?= system_showText(LANG_WAITLOADING); ?>');

                    $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>", $("#formLead" + id).serialize(), function (data) {
                        if (data == "ok") {
                            $("#msgLeadE" + id).css("display", "none");
                            $("#msgLeadS" + id).css("display", "");
                            $("#msgLeadS" + id).fadeOut(5000);
                            setTimeout("leadBox('hide', " + id + ");", 4000);
                            $("#title_replied" + id).css("display", "none");
                            $("#new_replied" + id).css("display", "");
                        } else {
                            $("#msgLeadE" + id).html(data);
                            $("#msgLeadE" + id).css("display", "");
                            $("#msgLeadS" + id).css("display", "none");
                        }
                        $("#submitLead" + id).html('<?= system_showText(LANG_BUTTON_SUBMIT); ?>');
                        $("#submitLead" + id).prop("disabled", "");
                        $("#submitLead" + id).css("cursor", "pointer");
                    });
                }

                function reviewBox(option, id) {
                    $("#reviews-list").children(".item-review").children(".review-detail").stop(true, true).slideUp();
                    $("#reviews-list").children(".item-review").children(".review-summary").stop(true, true).slideDown().removeClass("new");
                    if (option == "show") {
                        $("#review-summary-" + id).slideUp();
                        $("#review-detail-" + id).slideDown();
                        setItemAsViewed("review", id);
                    } else {
                        $("#review-summary-" + id).slideDown();
                        $("#review-detail-" + id).slideUp();
                    }
                }

                function leadBox(option, id) {
                    $("#leads-list").children(".item-review").children(".review-detail").stop(true, true).slideUp();
                    $("#leads-list").children(".item-review").children(".review-summary").stop(true, true).slideDown().removeClass("new");
                    if (option == "show") {
                        $("#lead-summary-" + id).slideUp();
                        $("#lead-detail-" + id).slideDown();
                        setItemAsViewed("lead", id);
                    } else {
                        $("#lead-summary-" + id).slideDown();
                        $("#lead-detail-" + id).slideUp();
                    }
                }

                function dealBox(option, id) {
                    $("#deals-list").children(".item-review").children(".review-detail").stop(true, true).slideUp();
                    $("#deals-list").children(".item-review").children(".review-summary").stop(true, true).slideDown();
                    if (option == "show") {
                        $("#deal-summary-" + id).slideUp();
                        $("#deal-detail-" + id).slideDown();
                    } else {
                        $("#deal-summary-" + id).slideDown();
                        $("#deal-detail-" + id).slideUp();
                    }
                }

                function changeDealStatus(option, id, promocode) {
                    $.post("<?= DEFAULT_URL ?>/<?= MEMBERS_ALIAS ?>/<?= PROMOTION_FEATURE_FOLDER ?>/deal.php", {action: option, promotion_id: promocode}, function () {
                        if (option == "freeUpDeal") {
                            $("#label_used" + id).css("display", "");
                        } else {
                            $("#label_used" + id).css("display", "none");
                        }
                    });
                }

                function setItemAsViewed(type, id) {
                    $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>", {
                        ajax_type: 'setItemAsViewed',
                        type: type,
                        id: id
                    }, function () {});
                }

                function showspinner() {
                    $('#dashboard').hide();
                    $('#spinner').show();
                }

                function hidespinner() {
                    $('#spinner').hide();
                    $('#dashboard').show();
                }

                function loadDashboard(item_type, item_id) {
                    showspinner();
                    $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>", {
                        ajax_type: 'load_dashboard',
                        item_type: item_type,
                        item_id: item_id
                    }, function (ret) {
                        $(".webitem").removeClass("active");
                        $("#" + item_type + "_" + item_id).addClass("active");
                        scrollPage('#float_layer');
                        $("#dashboard").hide().html(ret).fadeIn(800);
                        initializeDashboard();
                        hidespinner();
                        $('#listing_id_text_box').val(item_id);
                    });
                }


<? //Begin Dashboard Sidebar Scripts  ?>

                function hideMenu() {
                    $('#dashboard').animate({width: '100%'}, 1);
                    $('#dashboard').css({"border-left": "0px solid #DDD"});
                    $('#change-class').removeClass('col-sm-9');
                    $('#change-class').addClass('col-sm-12');
                    $('#sidebar').hide();
                    $('#hider').hide();
                    $('#shower').show();
                }

                function showMenu() {
                    $('#sidebar').show();
                    $('#change-class').removeClass('col-sm-12');
                    $('#change-class').addClass('col-sm-9');
                    $('#hider').show();
                    $('#shower').hide();
                    $('#dashboard').hide();
                }

                function calculateScreenHideMenu() {
                    var width = $(window).width();
                    if (width < 750) {
                        hideMenu();
                    }
                }

                if ($(document).width() < 750) {
                    $('#sidebar').hide();
                } else {
                    $('#sidebar').show();
                }



                function getItemId() {
                    item_id = $('#listing_id_text_box').val();
                    return item_id;
                }

                function highlightThis(item_id) {
                    $('.b0').each(function () {
                        $(this).children('a').removeClass("active");
                    });
                    $('#' + item_id).addClass('active');
                }

                function clickFunction(item, filename) {
                    
                    
                    $('#' + item).click(function () {
                        calculateScreenHideMenu();
                        highlightThis(item);
                        showspinner();
                        item_id = getItemId();
                         $('#dashboard').load('listing/' + filename + '.php?id=' + item_id, function () {
                                        hidespinner();
                                    });
                  
                    });
                }
                
                
                
                 function clickSubFunction(item, filename) {
                    $('#' + item).click(function () {
                        calculateScreenHideMenu();
                        highlightThis(item);
                        showspinner();
                        item_id = getItemId();
                         $('#dashboard').load('listing/' + filename + '.php?id=' + item_id + '&sub_menu=' + item, function () {
                                        hidespinner();
                                    });
                  
                    });
                }
                
                
                
                
                
                 function clickAppFunction(item, filename) {
                    $('#' + item).click(function () {
                        calculateScreenHideMenu();
                        highlightThis(item);
                        showspinner();
                        item_id = getItemId();
                      $('#dashboard').load('listing/app/' + filename + '.php?id=' + item_id, function () {
                                        hidespinner();
                                    });
                    });
                }
                
                
                
                

                function openPage(clicked_item, filename, item_id) {
                    highlightThis(clicked_item);
                    showspinner();
                    calculateScreenHideMenu();
                    item_id = getItemId();

                    $('#dashboard').load(filename + '.php?id=' + item_id, function () {
                        hidespinner();
                    });

                }

                $('#ovrvw').click(function () {
                    highlightThis("ovrvw");
                    calculateScreenHideMenu();
                    showspinner();
                    item_id = getItemId();
                    loadDashboard('Listing', item_id, function () {
                        hidespinner();
                    });
                });

                function menuItemClick(page, elem_id, item_id) {
                    highlightThis(elem_id);
                    calculateScreenHideMenu();
                    showspinner();
                    var url = item_id ? page + '/?itemid=' + item_id : page + '/';
                    $('#dashboard').load(url, function () {
                        if (page == 'transactions') {
                            if ($(window).width() < 993) {
                                $('#dashboard').css('overflow-x', 'scroll');
                            }
                        }
                        hidespinner();
                    });
                }

                clickFunction("edt", "listing");
                clickSubFunction("edt_detail", "listing");
                clickSubFunction("edt_ownership", "listing");
                clickSubFunction("edt_description", "listing");
                clickSubFunction("edt_logo", "listing");
                
                clickFunction("wig", "backlinks");
                clickFunction("revc", "review-collector");
                clickAppFunction("app", "manage-user");

<? //End Dashboard Sidebar Scripts  ?>

                function selectLegend(option, id, chartdata) {
                    var countVisible = 0;

                    if (option == "viewALL") {

                        if ($(".legend-ALL").hasClass("isvisible")) {
                        } else {
                            countVisible = 2;
                            $("#optionLegend > li > i").addClass("checked");
                            $(".legend-ALL").addClass("isvisible");
                            $("#optionLegend > li").not(".isvisible").clone().appendTo("#controlLegend");
                            $("#optionLegend > li").addClass("isvisible");
                        }
                    } else {
                        id: id
                        chartdata: chartdata
                        $newlegend = $(".legend-" + id).clone();

                        if ($(".legend-" + id).hasClass("isvisible")) {

                            //Check if there's at least one other legend selected to prevent empty chart
                            $('#optionLegend li').each(function () {
                                if ($(this).hasClass("isvisible")) {
                                    countVisible++;
                                }
                            });

                            if (countVisible > 1) {
                                $(".legend-" + id).children("i").removeClass("checked");
                                $(".legend-" + id).removeClass("isvisible");
                                $("#controlLegend").children(".legend-" + id).remove();
                                $(".legend-ALL").children("i").removeClass("checked");
                                $(".legend-ALL").removeClass("isvisible");
                            }
                        } else {
                            countVisible = 2;
                            $(".legend-" + id).children("i").addClass("checked");
                            $(".legend-" + id).addClass("isvisible");
                            $newlegend.appendTo("#controlLegend");
                        }
                    }
                    if (countVisible > 1) {
                        controlChart();
                    }
                }

                function loadChart() {
                    var data = {
                        labels: chartLabels,
                        datasets: initialReport
                    };
                    var steps = 5;
                    var max = maxInitialReport;
                    if (max < steps) {
                        steps = max;
                    }
                    var options = {
                        bezierCurve: false,
                        scaleOverride: true,
                        scaleSteps: steps,
                        scaleStepWidth: Math.ceil(max / steps),
                        scaleStartValue: 0
                    };
                    new Chart(ctx).Line(data, options);
                }

                function controlChart() {

                    var datasets = new Array();
                    var max = 0;
                    var thisHighest = 0;
                    $('#optionLegend li').each(function () {
                        if ($(this).hasClass("isvisible")) {
                            var reportType = $(this).attr('report');
                            if (reportType) {
                                datasets.push(window[reportType]);
                                thisHighest = Math.max.apply(Math, window[reportType].data);
                                if (thisHighest > max) {
                                    max = thisHighest;
                                }
                            }
                        }
                    });

                    var steps = 5;
                    if (max < steps) {
                        steps = max;
                    }
                    var options = {
                        bezierCurve: false,
                        scaleOverride: true,
                        scaleSteps: steps,
                        scaleStepWidth: Math.ceil(max / steps),
                        scaleStartValue: 0
                    };

                    var data = {
                        labels: chartLabels,
                        datasets: datasets
                    };
                    new Chart(ctx).Line(data, options);

                }

</script>

<script>

    $(document.body).on('click', '.dropdown-menu li', function (event) {
        event.preventDefault();
        var $target = $(event.currentTarget);

        var str = $target.text().replace(' Pending', '').replace(' Active', '');

        $('#menu').each(function () {
            $(this).children('li').removeClass("active");
        });
        $target.closest('li').addClass('active')

        if (str.length > 20)
            str = str.substring(0, 20);

        $target.closest('.btn-group')
                .find('[data-bind="label"]').text(str)
                .end()
                .children('.dropdown-toggle reviewerProfile').dropdown('toggle');
        highlightThis("ovrvw");
        calculateScreenHideMenu();
        $('#menu').hide();
        return false;
    });
    
    
    function AddBusiness() {
   window.location.href = "<?php echo DEFAULT_URL . '/sponsors/listing/addsearchlisting.php'; ?>";
   
}

</script>