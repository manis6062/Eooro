<?php
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
# * FILE: /includes/views/member_dashboard.php
# ----------------------------------------------------------------------------------------------------
include_once EDIRECTORY_ROOT . '/custom/domain_1/theme/review/common_functions.php';
?>

<div class="dashboard">
<?php
if ($_SESSION['err'] == '1') {
    echo "<p class='alert alert-danger' id='errorMessage'>Oops! Something went wrong. Please try again after some time.</p>";
    unset($_SESSION['err']);
} elseif ($_SESSION['err'] == '2') {
    echo "<p class='alert alert-danger' id='errorMessage'>Oops! Something went wrong while processing your payment. Please check your payment details and try again.</p>";
    unset($_SESSION['err']);
}
?>

    <header>
 

<? if ($visibilityButton) { ?>
            <a href="<?= $item_levellink; ?>" class="btn btn-primary"><?= system_showText(LANG_LABEL_INCREASEVISIBILITY); ?></a>
        <? } ?>

        <h1><a href="<?php echo NON_SECURE_URL . '/' . ALIAS_LISTING_MODULE .'/' . $itemObj->friendly_url; ?>"  rel="canonical" target="_blank"><?= stripcslashes($item_title); ?></a></h1>

<? if ($impressions_fieldText) { ?>
            <p>
                <b><?= $impressions_fieldText; ?></b>

    <? if (!$impressions_field) { ?>
            <!--<a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(LANG_LABEL_RENEW); ?></a>-->
                <? } ?>
            </p>
            <? } elseif ($item_new) { ?>
            <p><b><?= $item_new; ?></b></p>
        <? } elseif ($item_renewal > 0 || $item_expired) {
            ?>
            <p id="item_renewal" title="<?= $item_renewal_formatted; ?>">Expired 
                <a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(LANG_LABEL_RENEW); ?></a>
<? } elseif ($item_renewal < 0) {
    ?>
            <p id="item_renewal" title="<?= system_showText(LANG_LABEL_EXPIRESON); ?> <?= $item_renewal_formatted; ?>"><?= system_showText(LANG_LABEL_EXPIRESON); ?> <b><?= abs($item_renewal); ?></b> <?= $item_renewal_period ?> <b><?= $month1; ?></b> <?= $month_period ?> 
            <!--<a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(LANG_LABEL_RENEW); ?></a>-->
            </p> 
            <?php if($item_renewal > -30){ ?>
            
            <?php
            if(empty($itemObj->custom_text2)){ ?>
                   <a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(LANG_LABEL_RENEW); ?></a>

          <?php   }
          else{
              echo system_showText("Auto Renewed");
          }
            ?>

         <?php   } ?>

<? } elseif ($item_renewal == '0') { ?>
            <p id="item_renewal" title="<?= system_showText(LANG_LABEL_EXPIRESON); ?> <?= $item_renewal_formatted; ?>">Expires <b>Today</b> <? //=$item_renewal_period ?> <b><?= $month1; ?></b> <?= $month_period ?> 
            <!--<a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(LANG_LABEL_RENEW); ?></a>-->
            </p>

<? } elseif ($hastocheckout || !$item_renewal) { ?>
            <p><a class="floating-tip forcePointer" onclick="$('#bill').click();"><?= system_showText(@constant("LANG_MSG_CONTINUE_TO_PAY_" . string_strtoupper($item_type))); ?></a></p>
        <? } ?>
    </header>


<? if ($item_hasActivity) { ?>

        <section class="stats-summary">

            <h2><?= system_showText(LANG_LABEL_ACTIVITYREPORT); ?></h2>

            <div class="row-fluid">

    <? if ($item_hasDetail || $item_type == "Banner") { ?>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h1><?= ($item_type == "Banner" ? $banner_views : $item_numberviews); ?></h1>
                        <p><?= system_showText(LANG_LABEL_TOTALVIEWERS); ?></p>
                    </div>

    <? }

    if ($item_type == "Banner" && $showBannerClicks) {
        ?>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h1><?= $banner_clicks; ?></h1>
                        <p><?= system_showText(LANG_LABEL_WEBSITEVIEWS); ?></p>
                    </div>

                <? }

                if (($item_hasphone || $item_haswebsite || $item_hasfax) && strtolower($item_type) == "listing") {
                    ?>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <? if ($item_hasphone) { ?>
                            <p><?= $item_phoneviews; ?> <?= system_showText(constant("LANG_LABEL_PHONEVIEW" . ($item_phoneviews == 1 ? "" : "S"))); ?></p>
                        <? } ?>

                        <? if ($item_haswebsite) { ?>
                            <p><?= $item_websiteviews; ?> <?= system_showText(constant("LANG_LABEL_WEBSITEVIEW" . ($item_websiteviews == 1 ? "" : "S"))); ?></p>
                        <? } ?>
                    </div>

                <? }

                if ($item_hasemail) {
                    ?>

                    <div class="col-sm-12 col-md-3 col-lg-3">

                        <h5><?= $item_leads; ?></h5>

                        <p><?= system_showText(constant("LANG_LABEL_LEAD" . ($item_leads == 1 ? "" : "S"))); ?></p>

        <? if ($item_leads) { ?>
                            <p>
                                <a href="javascript:void(0);" onclick="gotoPage('listing-leads');jQuery('html,body').animate({scrollTop: 0}, 0);"><?= system_showText(LANG_LABEL_SEE_LEADS); ?></a>
          
                            </p>
        <? } ?>

                    </div>

                <?
                }
                if ($item_hasreview) {
                    $item_type = "Listing";
                    $item_id = $itemObj->id;
                    $RevObj = new Review();
                    $item_avgreview = $RevObj->getRateAvgByItem($item_type, $item_id);
                    $item_avgreview = floor($item_avgreview);
                    ?>
                    <div class="col-sm-12 col-md-3 col-lg-3">

        <?= displayratingtiny($itemObj->avg_review); ?>

                        <p><?= system_showText(LANG_LABEL_BASED_ON); ?>
                            <?php
                            if ($itemObj->review_count == 1) {
                                echo $itemObj->review_count . ' ' . LANG_REVIEW;
                            } else {
                                echo $itemObj->review_count . ' ' . LANG_REVIEW_PLURAL;
                            }
                            ?></p>
        <? if (count($reviewsArr)) { ?>
                            <p>
                                <a href="javascript:void(0);" onclick="gotoPage('listing-reviews');jQuery('html,body').animate({scrollTop: 0}, 0);"><?= system_showText(LANG_LABEL_SEE_REVIEWS); ?></a>
          
                            </p>
        <? } ?>

                    </div>

    <? } ?>

            </div>

        </section>

    <?
    }
    //echo '<pre>'; print_r($arrayCompletion);
    if ($arrayCompletion["total"] < 100) {
        ?>

        <section class="game-completion">

            <div class="row-fluid">

                <div class="span5">
                    <h5><?= system_showText(constant("LANG_LABEL_" . string_strtoupper($item_type) . "_COMPLETION")); ?></h5>
                    <p><?= system_showText(LANG_LABEL_GAMEFY_TIP); ?></p>

                    <?php $business_id = get_business_id($item_id); ?>

    <?php if (!empty($business_id)) { ?>
                        <h5 style="margin-top:50px;"><?= system_showText('Business ID : ');
        echo $business_id; ?></h5> 
    <?php } ?>

                </div>
            

                <div class="span7">

                    <div class="completion-chart">
                        <input type="text" value="<?= $arrayCompletion["total"] ?>" class="dial" /><span>%</span>
                    </div>

                    <div class="step large-step <?= ($arrayCompletion["highlight"] == "desc" ? "highlight" : "") ?>">

                        <? if ($arrayCompletion["desc"] < 100) { ?>
                            <p><a class="forcePointer" onclick="gotoPage('edt_description');"><?= system_showText(LANG_LABEL_GAMEFY_DESC); ?></a></p>
                        <? } ?>

                        <? if ($arrayCompletion["media"] < 100) { ?>
                            <p><a class="forcePointer" onclick="gotoPage('edt_logo');"><?= system_showText(LANG_LABEL_GAMEFY_MEDIA); ?></a></p>
                        <? } ?>

                        <? if ($arrayCompletion["additional"] < 100) { ?>
                            <p><a class="forcePointer" onclick="gotoPage('edt_ownership');"><?= system_showText(LANG_LABEL_GAMEFY_ADDITIONAL); ?></a></p>
    <? } ?>
    <?php if ($itemObj->custom_text2) { ?>
                            <p id="showUnSubscribe"><a class="forcePointer" onclick="unsubscribeConfirm();" title="Cancel your subscription.">Cancel subscription of this business</a></p>
    <?php } ?>
                        <p style="display:none;" id="showSubscribe" onclick="subscribe(<?= $itemObj->id ?>);"><a class="forcePointer" onclick="unsubscribeConfirm();" title="Cancel your subscription.">Subscribe</a></p>
                        <p><a class="forcePointer" onclick="deleteListing();" title="Business will be taken off your account but not deleted.">Remove business from this account</a></p>

                        <div id="spinnerSubscribe" class="selectCounty" style="vertical-align:sub;display:none;">
                            <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 16px;"></i><br>
                        </div>
                        <p id="messageSubscribe"></p>
                    </div>

                </div>

            </div>

        </section>

<? } else {
    ?>
        <section class="game-completion">

            <div class="row-fluid">

                <div class="span5">
                    <h5><?= system_showText(constant("LANG_LABEL_" . string_strtoupper($item_type) . "_COMPLETION")); ?></h5>
                    <p><?= system_showText(LANG_LABEL_GAMEFY_TIP); ?></p>
                </div>

                <div class="span7">

                    <div class="completion-chart">
                        <input type="text" value="<?= $arrayCompletion["total"] ?>" class="dial" /><span>%</span>
                    </div>

                    <div class="step large-step highlight">                        
                        <p><a class="forcePointer" onclick="deleteListing();" title="Business will be taken off your account but not deleted.">Remove business from this account</a></p>                        
                    </div>                    

                </div>

            </div>

        </section>
<? }

if ($showChart) {
    ?>

        <section class="stats-complete">

            <h2><?= system_showText(LANG_LABEL_STATISTICS); ?></h2>

            <div class="chart-legends">

                <div class="hidden-legends <?= (count($avReports) <= 2 ? "hidden-desktop" : "") ?>">

                    <span><?= system_showText(LANG_LABEL_VIEW_MORE_STATS) ?> &raquo;</span>

                    <ul id="optionLegend">

    <?
    $countReport = 1;
    foreach ($avReports as $avReport) {
        ?>

                            <li class="legend-<?= $countReport ?> <?= ($countReport <= 2 ? "isvisible" : "") ?>" report="<?= $avReport ?>" onclick="selectLegend('select', <?= $countReport ?>, <?= $avReport ?>)">
                                <i <?= ($countReport <= 2 ? "class=\"checked\"" : "") ?>></i>
                                <b style="background-color: rgb(<?= $avReportsColors[($countReport - 1)] ?>)"></b>
                            <?= $avReportsLabels[($countReport - 1)] ?>
                            </li>

        <?
        $countReport++;
    }

    if (count($avReports) > 2) {
        ?>
                            <li class="legend-ALL" onclick="selectLegend('viewALL', <?= $countReport; ?>)">
                                <i></i>
                                <b></b>
        <?= system_showText(LANG_LABEL_VIEW_ALL) ?>
                            </li>
    <? } ?>                        

                    </ul>

                </div>

                <ul id="controlLegend">

                    <li class="legend-1 isvisible" <?= (count($avReports) > 2 ? "onclick=\"selectLegend('select', 1, " . $avReports[0] . ")\"" : "") ?>>
                        <i class="checked"></i>
                        <b style="background-color: rgb(<?= $avReportsColors[0] ?>)"></b>
    <?= $avReportsLabels[0] ?>
                    </li>

                    <li class="legend-2 isvisible" <?= (count($avReports) > 2 ? "onclick=\"selectLegend('select', 2, " . $avReports[1] . ")\"" : "") ?>>
                        <i class="checked"></i>
                        <b style="background-color: rgb(<?= $avReportsColors[1] ?>)"></b>
    <?= $avReportsLabels[1] ?>
                    </li>              

                </ul>

            </div>

            <canvas id="myChart" width="580" height="200"></canvas>

        </section>

<? } ?>

        <?php if ($itemObj->custom_text5) { ?>
        <section class="subscription-option">
            <a href="" id="showPaymentMethod" data-id="<?php echo $itemObj->id; ?>">Click here to update payment method</a>
            <div id="spinnerPayment" class="selectCounty" style="vertical-align:sub;display:none;">
                <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 16px;"></i><br>
            </div>
            <div id="updatePaymentMethodShow"></div>
    <?php //include_once EDIRECTORY_ROOT . '/includes/views/subscription_info.php';  ?>
        </section> 
<?php } ?>     

    <style type="text/css">
        .subscription-option{
            overflow: hidden;
            background-color: #f8f8f8;
            border-bottom: 1px solid #e8e9eb;
        }

    </style>     
    <script type="text/javascript">
        $(document).ready(function () {
            window.setTimeout(function () {
                $('#errorMessage').hide();
            }, 4000);
        });
    </script> 

    <script type="text/javascript">

<?
$count = 0;
foreach ($avReports as $avReport) {
    ?>

            var <?= $avReport ?> = {
                fillColor: "rgba(<?= $avReportsColors[$count] ?>,0.1)",
                strokeColor: "rgba(<?= $avReportsColors[$count] ?>,0.3)",
                pointColor: "rgba(<?= $avReportsColors[$count] ?>,1)",
                pointStrokeColor: "#fff",
                data: <?= ${"data_" . $avReport} ?>
            };

    <?
    $count++;
}
?>

        var chartLabels = [<?= $strLabel ?>];
        var initialReport = [<?= $initialReport ?>];
        var maxInitialReport = <?= $maxInitialReport; ?>;

        // popup
        $("a.fancy_window_opencase").fancybox({
            'closeBtn': false,
            'padding': 0,
            'type': 'iframe',
            'width': 600
        });


        // to open case
        function showCase(info) {
            $.ajax({
                url: "<?= AJAX_REQ ?>",
                type: "POST",
                data: {mod: "casemanager", con: "opencase", details: info},
                success: function (response, status, jqXHR) {
                    console.log("response " + response);
                    console.log("status " + status);
                    console.log("jqXHR " + jqXHR);
                }
            });
        }

        function gotoPage(page_id) {
            $('#' + page_id).click();
        }
    </script>
    <script>

        function  deleteListing() {
            $.fancybox({
                content: '<div class="modal-content">\
                        <h2><span>Warning!</span><span>\
                        <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                        <div style="width:500px;" class="sureDelete">\
                        <p id="model-text">By clicking ok you will remove this business from your account but will not be deleted from eooro.com. Once removed from account you or anyone else can reclaim the business. Are you sure you want to remove this business from your account?</p>\
                        <p id="model-text-done" style="display:none;">Business deleted successfully!.</p>\
                        <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                        <div style="text-align:right;margin-top:10px;">\
                        <button id="ok-model-button" onclick="confirmDelete();" style="padding:4px 20px;" type="button" class="btn btnOk">Ok</button>\
                        <button id="cancel-model-button"style="padding:4px 6px;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Cancel</button>\
                        <button id="done-model-button" style="padding:4px 20px;display:none;" onclick="location.reload();jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                        <button id="failed-model-button" style="padding:4px 6px;display:none;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                        </div></div>\
                    </div>',
                modal: true
            });
        }

        function confirmDelete() {
            $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>", {
                ajax_type: 'deleteListing',
                item_id: <?= $item_id ?>
            }, function (ret) {
                if (ret.trim() == 'true') {
                    $('#model-text').hide();
                    $('#model-text-done').show();
                    $('#done-model-button').show();
                    $('#cancel-model-button').hide();
                    $('#ok-model-button').hide();
                } else {
                    $('#model-text').hide();
                    $('#model-text-failed').show();
                    $('#failed-model-button').show();
                    $('#cancel-model-button').hide();
                    $('#ok-model-button').hide();
                }
            });
        }

        function  unsubscribeConfirm() {
            $.fancybox({
                content: '<div class="modal-content">\
                            <h2><span>Warning!</span><span>\
                            <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                            <div style="width:500px;" class="sureDelete">\
                            <p id="model-text">Your subscription will be deleted but your business will continue to be in your account until it has expired. Are you sure you want to delete subscription of this business?</p>\
                            <p id="model-text-done" style="display:none;">Unsubscribed successful!.</p>\
                            <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                            <div style="text-align:right;margin-top:10px;">\
                            <button id="ok-model-button" onclick="unsubscribe(' +<?= $itemObj->id ?> + ');jQuery.fancybox.close();" style="padding:4px 20px;" type="button" class="btn btnOk">Ok</button>\
                            <button id="cancel-model-button"style="padding:4px 6px;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Cancel</button>\
                            <button id="done-model-button" style="padding:4px 20px;display:none;" onclick="location.reload();jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                            <button id="failed-model-button" style="padding:4px 6px;display:none;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                            </div></div>\
                        </div>',
                modal: true
            });
        }
        function unsubscribe(listing) {
            $('#spinnerSubscribe').show();
            $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", {
                ajax_type: "unsubscribe_listing",
                listing: listing
            }, function (result) {
                $('#spinnerSubscribe').hide();
                if (result.trim() == "success") {
                    $('#showUnSubscribe').hide();
                    $('#showSubscribe').show()
                    $('#messageSubscribe').html('Unsubscribe Successful.');
                    loadDashboard('Listing', listing);
                }

                if (result.trim() == "error") {
                    $('#messageSubscribe').html('Unsubscribe Failed, Please Try Again.');
                }

            });
        }

        function subscribe(listing) {
            var checkCookie = $.cookie('showListing');
            if (!$.cookie('showListing').indexOf('4298') > -1) {
                $.cookie('showListing', checkCookie + listing + ",");
            }
            $('#bill').click();
        }

        $('#showPaymentMethod').click(function (e) {
            e.preventDefault();
            $(this).hide();
            $('#spinnerPayment').show();
            var id = $(this).data('id');
            // var customer_id     = $(this).data('customer');
            // var token           = $(this).data('token');

            $.post("<?= SECURE_URL ?>/includes/views/subscription_info.php", {
                id: id
                        // customer_id     : customer_id,
                        // token           : token
            }, function (result) {
                $('#spinnerPayment').hide();
                $('#updatePaymentMethodShow').html(result);
            });
        });

    </script>