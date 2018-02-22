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
# * FILE: /members/claim/listing.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);

if ($_GET['claimlistingid']) {
    $list_id = intval($_GET['claimlistingid']);
} else {
    $list_id = intval($_POST['claimlistingid']);
}


# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

$listingObject = new Listing($list_id);
$listing = $listingObject;
$account = new Account($acctId);

if ($listingObject->account_id != $acctId) {
    if ($listingObject->account_id != 0) {
        header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
        exit;
    }
}

$url_redirect = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/claim";
$url_base = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "";
$members = 1;

$sql = "SELECT cat.category_id,cat.name category_name, cat.category_icon, sub.name as sub_category
                FROM Category cat RIGHT JOIN SubCategory sub 
                ON cat.category_id = sub.category_id order by  cat.name,cat.category_id,sub.name";
$result = $dbDomain->query($sql);
while ($row = mysql_fetch_assoc($result)) {
    $raw_categories[] = $row;
}

foreach ($raw_categories as $cats) {
    !in_array($cats['category_name'], $category_names[$cats['category_id']]) ? $category_names[$cats['category_id']]['category_name'] = $cats['category_name'] : "";
    $category_names[$cats['category_id']]['sub_cateogry'][] = $cats['sub_category'];
    !in_array($cats['category_icon'], $category_names[$cats['category_id']]) ? $category_names[$cats['category_id']]['category_icon'] = $cats['category_icon'] : "";
}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
include(EDIRECTORY_ROOT . "/includes/code/listing.php");

$listing = new Listing($claimlistingid); //Claim
$members = true;

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");
require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
?>

<div class="content content-full">

    <div <?= (EDIR_THEME === 'review') ? 'class="container"' : '' ?>>

        <p id ="message" class="errorMessage"></p>

        <form name="listing" id="listing" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="ieBugFix" value="1" />
            <input type="hidden" name="process" id="process" value="claim" />
            <input type="hidden" name="id" id="id" value="<?= $id ?>" />
            <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?= $claimlistingid ?>" />
            <input type="hidden" name="claim_id" id="claim_id" value="<?= $claimID ?>" />
            <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?= $listingtemplate_id ?>" />
            <input type="hidden" name="account_id" id="account_id" value="<?= $acctId ?>" />
            <input type="hidden" name="level" id="level" value="<?= $level ?>" />

<? include(INCLUDES_DIR . "/forms/form_listing.php"); ?>

            <input type="hidden" name="ieBugFix2" value="1" />

            <p class="standardButton claimButton listingButton">

<? echo "<a style=\"text-decoration:none\" href=\"javascript:history.go(-1)\" id=\"back\">BACK</a>"; ?>

                <button id="button" type="button"><?= system_showText(LANG_BUTTON_NEXT) ?></button>
            <div id="spinner" style="vertical-align:sub;text-align:center;display:none;">
                <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 26px;"></i> Please wait...<br>
            </div>
            </p>

        </form>            
    </div>
</div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/common.js"></script>
<script>
    $('#button').on('click', function () {
        if ($("#listing").valid() == true) {
            $('#button').hide();
            $('#back').hide();
            $('#spinner').show();
<? //check captcha    ?>
            if ($("#g-recaptcha-response").val()) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo DEFAULT_URL . '/sponsors/ajax_verify_captcha.php'; ?>",
                    dataType: 'html',
                    data: {
                        captchaResponse: $("#g-recaptcha-response").val()
                    },
                    success: function (data) {
                        $('#spinner').show();
                        JS_submit();
                        console.log("everything looks ok");
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log("You're a robot");
                    },
                });

            } else {
                document.getElementById('captcha').innerHTML = "Captcha field is required";
                $('#button').show();
                $('#back').show();
                $('#spinner').hide();
                return false;
            }
        }
    });

    var globalCheck = function () {
        return $('#LocationActivities').val().trim() != 'Global';
    };

    var stateCheck = function () {
        if (globalCheck() == true) {
            return $('#location_3').val().trim() == '0';
        } else {
            return false;
        }
    }

    var cityCheck = function () {
        if (globalCheck() == true) {
            console.log($('#location_4').val().trim() == '0');
            return $('#location_4').val().trim() == '0';
        } else {
            return false;
        }
    }

    $(function () {

        //validation for phone number
        jQuery.validator.addMethod('phoneUS', function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, '');
            return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^[\s()+-]*([0-9][\s()+-]*){6,20}$/);
        });
        $.validator.addMethod('videoYoutube', function (videostring, element) {
            var youtubeReg = /youtu\.?be(?:.com)?\/([^<>"\'\s]+)/;
            if (videostring.length === 0) {
                return true;
            }
            return youtubeReg.test(videostring);
        });

        $("#listing").validate({
            // Specify the validation rules
            ignore: ":hidden:not(#location_3,#location_4,input[name='keywords'])",
            rules: {
                keywords: "required",
                title: "required",
                friendly_url: "required",
                custom_text0: "required",
                description: "required",
                captchatext: "required",
                custom_dropdown3: "required",
                address: {
                    required: globalCheck,
                },
                location_1: {
                    required: globalCheck,
                },
                stateCheck: {
                    required: stateCheck,
                },
                phone: {
                    required: false,
                    phoneUS: true
                },
                fax: {
                    required: false,
                    phoneUS: true
                },
                cityCheck: {
                    required: cityCheck,
                },
                video_snippet: {
                    required: false,
                    videoYoutube: true
                }
            },
            // Specify the validation error messages
            messages: {
                title: "Business trading name is required",
                friendly_url: "A url is required",
                custom_text0: "Legal business name is required",
                captchatext: "Captcha text is required",
                description: "Summary description is required",
                address: "Address is required",
                location_1: "Country name is required",
                keywords: "Please select a business category",
                stateCheck: "A valid State/County is required",
                cityCheck: "A valid City is required",
                phone: "Invalid Phone Number.",
                fax: "Invalid Fax Number.",
                video_snippet: "Only Youtube Video is allowed"
            },
            // Highlight Errors
            highlight: function (element) {
                $(element).addClass('invalidFormData');
            }, unhighlight: function (element) {
                $(element).removeClass('invalidFormData');
            },
            errorPlacement: function (label, element) {
                //label.addClass('arrow');
                label.insertAfter(element);
                if ($(element).attr('id') == 'SummaryDescription') {
                    label.addClass('arrow1');
                }
                if ($(element).attr('id') == 'friendly_url') {
                    label.addClass('arrow2');
                    $(element).after('<br>')
                }
                if ($(element).attr('id') == 'categories') {
                    label.addClass('arrow3');
                    $('#cat_error').addClass('invalidFormData');
                    $('#cat_error').addClass('cat_err_msg');
                    $(element).after('<br>')
                }
                if ($(element).attr('id') == 'location_1' || $(element).attr('id') == 'location_3' || $(element).attr('id') == 'location_4') {
                    label.addClass('location_1');

                    //$(element).after('<br>')
                }
                $(element).after('<br>')

            },
            //Invalid
            invalidHandler: function (form, validator) {

                if (!validator.numberOfInvalids())
                    return;
                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).offset().top
                }, 1);

            },
            //Success
            submitHandler: function (form) {}
        });
    });
</script>
<style type="text/css">  
    .error{
        color: red!important;
        font-size: 12px;
        font-family: sans-serif;
        font-weight: normal;
        margin-bottom:0px;
        margin-left: 17px;
    }   
    .errorCustom {
        color: red;
        font-size: 12px;
        font-family: sans-serif;
        font-weight: normal;
        margin-bottom:0px;
    }

    .arrow{
        margin-left: 0px;

    }
    .arrow1{
        margin-left: 0px;
        position: absolute;
        right:15px;
        top:80px;
    }
    .arrow2{

        margin-left: 0;
        position: absolute;
        right: 15px;
        top: 35px;
    }

    .arrow3{
        position: absolute;
        bottom: -12px;
        right: 16px;
    }
    .location_1{
        display: block !important;
        font-size: 12px !important;
        text-align: right;
    }
    .cat_err_msg{
        overflow: hidden;
        padding-top: 5px;
    }
</style>
<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
?>