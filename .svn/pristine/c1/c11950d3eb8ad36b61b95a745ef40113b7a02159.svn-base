<?
#----------------------------------------------------------------
#   	Extract Billing Page Currency, symbol and price
#----------------------------------------------------------------

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbObj = db_getDBObject();

//GeoIP based currency, 
//$price is coming from includes/code/billing.php
$currency = $price;
$_SESSION['list_id'] = key($bill_info['listings']);
$grace_period = $bill_info['listings'][$_SESSION['list_id']]['gracePeriodUsed'];



//$account = new Account(sess_getAccountIdFromSession());
//$currency['currency'] = $account->prefered_currency;
//$currency['symbol'] = $account->currency_symbol;
//Extract currencies and their name
//$sql = "SELECT currency, symbol as currency_name FROM Location_1 order by id desc";
//$result = $dbMain->query($sql);
//while ($row = mysql_fetch_assoc($result)) {
//    $values[] = $row;
//}
//foreach ($values as $key => $value) {
//    $currencies[$value['currency']] = $value['currency_name'];
//}
?>

<!-- Start Tab Panes -->

<div role="tabpanel"> 

    <!-- Nav tabs -->
    <ul class="nav nav-tabs custom-tabs unpaid-paid" role="tablist">
        <li role="presentation" class="active" id="active"><a href="#recent-review" aria-controls="recent-review" role="tab" data-toggle="tab">Checkout</a></li>
        <!--        <li class="pull-right">
                    <div class="form-group rmp">
                        <select class="form-control selectCurrency" id="currency-type">
                            <option value="Select Currency" selected>Select Currency</option>
<? foreach ($currencies as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $key == $currency['currency'] ? "selected" : null; ?> ><?= $key ?> (<?= $value ?>)</option>
        <? endforeach; ?>
                        </select>    
                    </div>
        
                </li>-->

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
        </div>
        <div role="tabpanel" class="tab-pane">
        </div>
    </div>

</div> <!-- tabpanel -->


<!-- End Tab Panes -->

<!-- Start Billing Wrapper -->

<div class="row">
    <div class="col-sm-12">
        <div class="businessCasesWrapper clearfix">

            <!-- Lisitngs -->

<?
if ($bill_info['listings']): ?>

                <? foreach ($bill_info['listings'] as $listing): ?>

                    <? $listing['needtocheckout'] == "y" ? $listingOpenWrapper = "show" : null; ?>

                <? endforeach; ?>

            <? endif; ?>

            <? if ($listingOpenWrapper): ?>

                <table class="table table-condensed BillingPage">
                    <thead>
                        <tr>
                            <th class="businessN">Business Name</th>
                            <th class="promotionalC">Promotional Code</th>
                            <th class="paymentC">Payment Cycle</th>
                            <th class="price">Price</th>
                            <th style="visibility:hidden;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
    <?
    foreach ($bill_info['listings'] as $id => $info):
        if ($info['needtocheckout'] == "y"):
            $checked = "checked";
            ?>

                                <tr class=" yearly <?= (trim($info["needtocheckout"]) == "y" ? "colorPending" : ($info['monthly'] == "y" ? "colorMonthly" : "colorYearly") ) ?>">

                                    <!-- Title -->

                                    <td>
                                        <input style="display:none;position:absolute;z-index:999;" id="listing_id-<?= $id ?>" name="listing_id[]" value="<?= $id ?>" <?= $checked ?> class="inputCheck" type="checkbox">
            <?= ((concat($info['title'], 60))) ?>
                                    </td>

                                    <!-- Promotional Code  -->

                                    <td>
                                        <input type="text" id='discount-<?= $id ?>' onblur="validateDiscount('listing', <?= $id ?>);" name="discountlisting_id[]" class="promotionalCode" value="<?= $info["discount_id"] ?>" <?= (trim($info['monthly']) == "y" ? "disabled" : null); ?>/>
                                        <a data-toggle="tooltip" title="Apply Now" data-placement="left" class="forcePointer" data-original-title="Apply Now" style="vertical-align:text-bottom;">
                                            <i class="fa fa-arrow-right billing-down-arrow" aria-hidden="true"></i>
                                    </td>

                                    <!-- Duration  -->

                                    <td>
                                        <label class="checkbox-inline"><input name = "cycle-<?= $id ?>" type="radio" value="yearly" onclick="changeDuration('yearly', '<?= $id ?>', this);" <?= (trim($info['monthly']) == "n" ? "checked" : null); ?>>Yearly</label>
                                        <label class="checkbox-inline"><input name = "cycle-<?= $id ?>" type="radio" value="monthly" onclick="changeDuration('monthly', '<?= $id ?>', this);" <?= (trim($info['monthly']) == "y" ? "checked" : null); ?>>Monthly</label>
                                    </td>

                                    <!-- Price -->

                                    <td>

                                        <!-- Currency Symbol -->

                            <symbol class="symbol">
            <?= $currency['currency'] ?>
                            </symbol>

                            <!-- Amount -->
                            <p id="singleprice-<?= $id ?>" class="singleprice">
            <?= sprintf('%0.2f', $info['total_fee']) ?>
                            </p>
                            <input type="hidden" style="display:block;width:60px;font-size:14px;" id="price-ref-<?= $id ?>" class="each-price-ref" value="<?= sprintf('%0.2f', $info['total_fee']); ?>">
                            <input type="hidden" style="display:block;width:60px;font-size:14px;" id="listing-price-<?= $id ?>" class="each-price" value="<?= $info['total_fee'] ?>">
                            <input type="hidden" class="custom_checkbox4" id="custom_checkbox4-<?= $id ?>" value="<?php echo $info['gracePeriodUsed']; ?>">
                            </td>

                            <!-- Add / Remove -->

                            <td><a data-toggle="tooltip" title="Remove" data-placement="left" onclick="toggleItem(<?= $id ?>, 'listing')" id="btn-<?= $id ?>" class="forcePointer" style="margin-top:0;"><i class='fa <?= $info['needtocheckout'] == "y" ? "fa-times billing-remove" : "fa-plus " ?>' id="checkout"></i> <? //=$info['needtocheckout'] == "y" ? " Remove" : " Add"       ?>
                                    <!-- <button data-toggle="tooltip" title="" data-placement="left" onclick="toggleItem(4268, 'listing')" data-original-title="Remove" value="submit" type="submit" id="button" class="btn btn-default checkout forcePointer billing-btn-remove">Remove</button> -->
                                </a></td>

                            </tr>						
        <? endif; ?>
                    <? endforeach; ?>
                    </tbody>
                </table>


            
            <?php 
            if($grace_period != 'y'){ ?>
                <p class="alert alert-info noBilling">
                    The first month is free, but we still run your payment details to make sure you are a real person. Your card is not charged, if you decide to cancel within a month you will not be billed.</p>
          <?php  }
            
            ?>
                
<? endif; ?>


            <!-- Cases  -->



<? if ($bill_info['cases']): ?>

                <? foreach ($bill_info['cases'] as $case): ?>

                    <? $case['needtocheckout'] == "y" ? $caseOpenWrapper = "show" : null; ?>

                <? endforeach; ?>

            <? endif; ?>


<? if ($caseOpenWrapper == "show"): ?>

                <table class="table table-condensed BillingPage Cases">
                    <thead>
                        <tr>
                            <th class="businessN">Cases</th>
                            <th>Promotional Code</th>
                            <th style="width:160px;"></th>
                            <th>Price</th>
                            <th style="visibility:hidden;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>

    <? foreach ($bill_info['cases'] as $id => $info): ?>

                            <? if ($info['needtocheckout'] == "y"): ?>

                                <tr class="yearly">

                                    <!-- Title -->

                                    <td>
                                        <input style="display:none;position:absolute;" id="case_id-<?= $id ?>" name="case_id[]" value="<?= $id ?>" checked="checked" class="inputCheck" type="checkbox">
            <?= concat($info['title'], 25) ?>
                                    </td>

                                    <!-- Promotional Code -->

                                    <td>
                                        <input type="text" id='discount-<?= $id ?>' name="discountcase_id[]" onblur="validateDiscount('case', <?= $id ?>);" class="promotionalCode" value="<?= $info["discount_id"] ?>" />
                                    </td>

                                    <td class="noUse"></td>

                                    <!-- Price -->

                                    <td>
                                    
                            <symbol class="symbol">
            <?= $currency['currency'] ?>
                            </symbol>
                            <p id="singleprice-<?= $id ?>" class="singleprice">
            <?= sprintf('%0.2f', $info['total_fee']) ?>
                            </p>
                            <input type="hidden" style="width:60px;font-size:14px;" id="price-ref-<?= $id ?>"  class="each-price-ref" value="<?= sprintf('%0.2f', $info['total_fee']) ?>">
                            <input type="hidden" style="width:60px;font-size:14px;" id="case-price-<?= $id ?>" class="each-price"     value="<?= $info['total_fee'] ?>">
                            <input type="hidden" class="custom_checkbox4" id="custom_checkbox4-<?= $id ?>" value="<?php echo $info['needtocheckout']; ?>">

                            </td>

                            <!-- Add/Remove -->
                            <td>
                                <a data-toggle="tooltip" title="Remove" data-placement="left" onclick="toggleItem(<?= $id ?>, 'case')" id="btn-<?= $id ?>" class="forcePointer removebtn <?= $info['needtocheckout'] == "y" ? null : "plusbtn" ?>"><i class="fa fa-times"></i> <? //=$info['needtocheckout'] == "y" ? " Remove" : " Add"       ?>
                                    <!--  <button data-toggle="tooltip" title="" data-placement="left" onclick="toggleItem(4268, 'listing')" data-original-title="Remove" value="submit" type="submit" id="button" class="btn btn-default checkout forcePointer billing-btn-remove">Remove</button> -->
                                </a>


                            </td>
                            </tr>

        <? endif; ?>

                    <? endforeach; ?>

                    </tbody>
                </table>

<? endif; ?>

            <!-- Payment Buttons -->
<? if ($listingOpenWrapper || $caseOpenWrapper): ?>

                <div class="billing_payment_options">
    <? include(INCLUDES_DIR . "/forms/form_paymentmethod.php"); ?>
                </div>

<? else: ?>

                <section style="text-align:center;height:450px;padding-top: 10%;">

                    <h3>No items requiring checkout.</h3>

                </section>

<? endif; ?>

        </div><!--/businessCasesWrapper-->
    </div><!--/col-sm-9 -->
</div> <!--/row -->

<div id="SelectCurrencyMessage" style="display:none;text-align: center;margin-top: 20%;">
    <p align="center"><h2>Please select your prefered currency.</h2></p>
</div>

<? //Script to send JSON data to changeCurrency AJAX, parameters include listing_id, location_1, targetcurrency (comes from payment currency on change)   ?>

<?
//Create listing location 1 as JSON
foreach ($bill_info['listings'] as $id => $value) {
    $listing_id_location1[] = array('id' => $id, 'loc' => $value['location_1']);
}

foreach ($bill_info['cases'] as $id => $value) {
    $case_id_location1[] = array('id' => $id);
}

$send_values_listings = json_encode($listing_id_location1);
$send_values_cases = json_encode($case_id_location1);
?>

<? //Change Currency Script ?>
<script>

//    $("#currency-type").change(function () {
//        if ($('#currency-type').val().trim() != "Select Currency") {
//            var type = $("#currency-type").val();
//            var listings = <?= $send_values_listings ?>;
//            var cases = <?= $send_values_cases ?>;
//            $.ajax({
//                method: "POST",
//                url: '<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>',
//                data: {
//                    ajax_type: 'changeCurrency',
//                    listings: listings,
//                    cases: cases,
//                    newVal: type
//                }
//            })
//                    .done(function (msg) {
//                        var parsed = JSON.parse(msg);
//                        $('.symbol').html(parsed.symbol);
//                        $.each(parsed.price, function (id, price) {
//                            $('#singleprice-' + id).html(price);
//                            $('#price-ref-' + id).val($('#price-ref-' + id).val() == "0.00" ? "0.00" : price);
//                        });
//                        calculateTotal();
//                    });
//        }
//
//    });
</script>

<? //Script to show hide paid or unpaid items  ?>

<script>
    $('.service-list-item-notneed').hide();

    $("#active").click(function () {
        $('.service-list-item-notneed').hide();
        $('.service-list-item-need').show();
    });

    $("#passive").click(function () {
        $('.service-list-item-need').hide();
        $('.service-list-item-notneed').show();
    });


</script>

<? // Script to calculate values in different currencies  ?>

<? //Script to calculate Discount Code?>
<script>
    function validateDiscount(type, id) {

        var discount_code = $('#discount-' + id).val().trim();
        $.ajax({
            method: "POST",
            url: "<?= DEFAULT_URL . '/' . MEMBERS_ALIAS ?>/billing/checkpromocode.php",
            data: {code: discount_code, type: type, id: id},
            beforeSend: function (jqXhr, settings) {
                //showspinner();
                loadModelWindow('Please wait while we validate code', true);
            }
        })
                .done(function (msg) {
                    var response = JSON.parse(msg);
                    var original_price = response.original_price;
                    var discount_price = response.price;
                    var message = response.message.trim();
                    loadModelWindow(message);

                    if (message.indexOf("Promotional Code Accepted") > -1 || message.indexOf("Promotional Code Removed") > -1 || message.indexOf("Invalid promotional code") > -1) {
                        $('#price-ref-' + id).val(discount_price);
                        $('#singleprice-' + id).text(discount_price);
                        type == "listing" ? $('#listing-price-' + id).val(discount_price) : $('#case-price-' + id).val(discount_price);
                        calculateTotal();
                    }

                    if (message.indexOf("Invalid promotional code") > -1) {
                        $('#discount-' + id).val('');
                    }
                });

    }
</script>

<? //This script loads fancybox modal alert ?>
<script>
    function loadModelWindow(msg, dontUseCloseButton) {
        var closeButton = '';
        if (!dontUseCloseButton) {
            closeButton = '<button id=\"fancyconfirm_cancel\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnCancel\" >Ok</button>';
        }
        jQuery.fancybox({
            'height': 70,
            'modal': true,
            'content': "<div class=\"modal-content\"><h2>Info</h2><div style=\"width:240px;\" class=\"sureDelete\">" + msg + "<div style=\"text-align:right;margin-top:10px;\">" + closeButton + "</div></div></div>",
            'beforeShow': function () {
                jQuery("#fancyconfirm_cancel").click(function () {
                    jQuery.fancybox.close();
                });
            }
        });
    }
</script>

<? //Script to change price based on whether the subscription is montly or yearly   ?>
<script>
    function changeDuration(type, id, obj) {

<? //Remove discount id for monthly listing  ?>
        if (type.trim() == "monthly") {
            $('#discount-' + id).val('');
            $('#discount-' + id).prop('disabled', true);
        }

        if (type.trim() == "yearly") {
            $('#discount-' + id).prop('disabled', false);
        }

        $.ajax({
            method: "POST",
            url: '<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>',
            data: {ajax_type: 'changeDuration', type: type, listing: id},
        })
                .done(function (data) {
                    var data = JSON.parse(data);
                    $('#price-ref-' + id).val(data['price']);
                    $('#singleprice-' + id).html(data['price']);
                    $('#custom_checkbox4-' + id).html(data['custom_checkbox4']);
                    calculateTotal();

<? // Change Color Code  ?>

                    var className = $(obj).parents('tr.yearly');
                    var classValue = className.prop('class');
                    var trimClassValue = classValue.replace('yearly ', '');

                    if (trimClassValue.trim() != "colorPending") {
                        $(className).removeClass(trimClassValue);
                        if (type.trim() === "monthly") {
                            $(className).addClass('colorMonthly');
                        }

                        if (type.trim() === "yearly") {
                            $(className).addClass('colorYearly');
                        }
                    }
                });
    }
</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<style>
    .paymentCheckPaypal {
        color: green;
        position: absolute;
        z-index: 1;
        top: 15px;
        left: -4px;
        display: none;
    }
    .paymentCheckCreditcard{
        color: green;
        position: absolute;
        z-index: 1;
        top: 15px;
        right: -4px;
    }

<? if ($claimlistingid): // Add or Claim Page       ?>
        th.businessN {
            width: 645px;
        }
        .table.BillingPage>tbody>tr>td{
            vertical-align: middle;
        }
        p.singleprice {
            margin-bottom: 0;
        }
        .table.BillingPage a {
            margin-top: 0;
        }

        @media (max-width:1199px) and (min-width:992px){
            th.businessN {
                /*  width: 470px;*/
                width: 435px;
            }
        }
        /* @media (max-width:992px){
            .billing-btn-remove{
                 display: none;
            }
         }*/
        @media (max-width:991px) and (min-width:480px){
            table.table.BillingPage td {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            input.promotionalCode {
                width: 30%!important;
                height: 28px;
            }
            /* .billing-btn-remove{
                 display: visible;
            }
            .billing-remove{
                 display: none;
            }*/
        }
        @media (max-width:991px) and (min-width:768px){
            /*  .billing-btn-remove{
                  display: none;
             }
             .billing-remove{
                  display: none;
             }*/
            table.table.BillingPage td {
                padding-left: 25%!important;
                height: auto!important;
            }
        }
        @media (max-width:766px) and (min-width:600px){
            table.table.BillingPage td {
                padding-left: 30%!important;
                height: auto!important;
            }
            /* .billing-btn-remove{
                 display: visible;
            }
            .billing-remove{
                 display: none;
            }*/
        }
<? else: //Main Billing Page       ?>
        th.businessN {
            width: 355px;
            /*    width: 320px;*/
        }
        input.promotionalCode {
            width: 140px;

        }

        @media (max-width:1199px) and (min-width:992px){
            th.businessN {
                /*width: 240px;*/
                width: 235px;
            }
            input.promotionalCode {
                /*  width: 135px;*/
                width: 115px;
            }
        }

<? endif; ?>
</style>