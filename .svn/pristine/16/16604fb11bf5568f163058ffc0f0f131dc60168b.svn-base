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
# * FILE: /members/listing/listing.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$url_redirect = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS;
$url_base = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "";
$members = 1;
$item_form = 1;
// $process       = ($_GET['id'] == "edit" ? "edit" : "add");
//get categories
$sql = "SELECT cat.category_id,cat.name category_name, cat.category_icon,sub.name as sub_category
                FROM Category cat RIGHT JOIN SubCategory sub 
                ON cat.category_id = sub.category_id order by cat.name,cat.category_id, sub.name ASC";
$domain = DBConnection::getInstance()->getDomain();
$raw_categories = array();
DBQuery::execute(function() use ($domain, $sql, &$raw_categories) {
    $stmt = $domain->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $raw_categories[] = $row;
    }
});


foreach ($raw_categories as $cats) {
    !in_array($cats['category_name'], $category_names[$cats['category_id']]) ? $category_names[$cats['category_id']]['category_name'] = $cats['category_name'] : "";
    $category_names[$cats['category_id']]['sub_cateogry'][] = $cats['sub_category'];
    !in_array($cats['category_icon'], $category_names[$cats['category_id']]) ? $category_names[$cats['category_id']]['category_icon'] = $cats['category_icon'] : "";
    //$category_names[$cats['category_id']['category_icon']] = $cats['category_icon'];
}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

include(EDIRECTORY_ROOT . "/includes/code/listing.php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------

if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");
}

require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
?>


<div class="content content-full">   

    <p id ="message" class="errorMessage"></p>

    <form name="listing" id="listing" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">

        <? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

        <input type="hidden" name="ieBugFix" value="1" />

        <? /* Microsoft IE Bug */ ?>

        <input type="hidden" name="process" id="process" value="<?= $process ?>" />
        <input type="hidden" name="id" id="id" value="<?= $id ?>" />
        <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?= $listingtemplate_id ?>" />
        <input type="hidden" name="account_id" id="account_id" value="<?= $acctId ?>" />
        <input type="hidden" name="level" id="level" value="<?= $level ?>" />
        <input type="hidden" name="using_package" id="using_package" value="<?= ($package_id ? "y" : "n") ?>" />
        <input type="hidden" name="package_id" id="package_id" value="<?= $package_id ?>" />
        <input type="hidden" name="gallery_hash" value="<?= $gallery_hash ?>" />
        <input type="hidden" name="process" value="<?= $_GET['id'] ? "edit" : "add" ?>" />
        <? // include(INCLUDES_DIR . "/forms/form_listing.php"); ?>

        
                <?php
                if($_GET['sub_menu'] == 'edt_detail'){
                    include(INCLUDES_DIR . "/forms/form_listing_detail.php");
                }
                elseif($_GET['sub_menu'] == 'edt_ownership'){
                    include(INCLUDES_DIR . "/forms/form_listing_ownership.php");
                }
                elseif($_GET['sub_menu'] == 'edt_description'){
                    include(INCLUDES_DIR . "/forms/form_listing_description.php");
                }
                elseif($_GET['sub_menu'] == 'edt_logo'){
                    include(INCLUDES_DIR . "/forms/form_listing_logo.php");
                }
                else{
                    include(INCLUDES_DIR . "/forms/form_listing.php");
                }
                
                 ?>

        
        <? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

        <input type="hidden" name="ieBugFix2" value="1" />

        <? /* Microsoft IE Bug */ ?>

    </form>

    <p class="standardButton claimButton listingButton">
        <? if (!$id): ?>
            <a style="text-decoration:none" id="back" href="javascript:history.go(-1)">Back</a>
            <button id ="button"  type="button" tabindex="52"><?= system_showText(LANG_BUTTON_NEXT) ?></button>
        <? else: ?>
            <!--<a id="prv" href="<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . "listing/preview.php?id=" . $id ?>" class="iframe fancy_window_preview" style="margin-right: 5px;width:85px;">Preview</a>-->
            <button id ="button" class="sub_button" type="button" tabindex="52"><?= system_showText(LANG_BUTTON_SAVE) ?></button>
        <? endif; ?>
    <div id="spinner" style="vertical-align:sub;text-align:center;display:none;">
        <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 26px;"></i> Please wait...<br>
    </div>
</p>


</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    $('#button').on('click', function () {
        if ($("#listing").valid() == true) {
            $('#back').hide();
            $('#spinner').show();
<? //check captcha   ?>
            if ($("#g-recaptcha-response").val()) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo DEFAULT_URL . '/sponsors/ajax_verify_captcha.php'; ?>",
                    dataType: 'html',
                    data: {
                        captchaResponse: $("#g-recaptcha-response").val()
                    },
                    
                    beforeSend : function(){
                    $('#smallSpinner').show();
                    },
                    success: function (data) {
                        JS_submit();
                       $('#spinner').show();
                       $('#button').hide();

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

    var location_3 = function () {
        if (globalCheck() == true) {
            if ($('#location_3').val().trim() == '0' || $('#location_3').val().trim() == '')
                return true;
        } else {
            return false;
        }
    }

    var location_4 = function () {
        if (globalCheck() == true) {
            console.log($('#location_4').val().trim() == '0');
            if ($('#location_4').val().trim() == '0' || $('#location_4').val().trim() == '')
                return true;
        } else {
            return false;
        }
    }
    var availableLocation1;

    $(function () {
        //validation for phone number
        $.validator.addMethod('phoneUS', function (phone_number, element) {
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
        $.validator.addMethod('verifiedCountry',function(){
            var index;
            for (index = 0; index < availableLocation1.length; ++index) {
                var name=availableLocation1[index].value;
                if(name.toUpperCase()==$('#input_location_1').val().toUpperCase()){
                    $("#input_location_1").val(name);
                    return true;
                }
            }
            return false;
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
                input_location_1:{
                    required:true,
                    verifiedCountry:true
                },
                input_location_3:"required",
                input_location_4:"required",
                address: {
                    required: globalCheck,
                },
                location_1: {
                    required: globalCheck,
                },
//                location_3: {
//                    required: location_3,
//                },
//                location_4: {
//                    required: location_4,
//                },
                phone: {
                    required: false,
                    phoneUS: true
                },
                fax: {
                    required: false,
                    phoneUS: true
                },
                url: {
                    required: false,
                    url: true
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
                location_3: "A valid State/County is required",
                location_4: "A valid City is required",
                phone: "Invalid Phone Number.",
                fax: "Invalid Fax Number.",
                video_snippet: "Only Youtube Video is allowed",
                input_location_1:{
                    verifiedCountry:"Country not valid, please select from list"
                },
                
            },
            // Highlight Errors
            highlight: function (element) {
                $(element).addClass('invalidFormData');

            }, unhighlight: function (element) {
                $(element).removeClass('invalidFormData');
                if ($(element).attr('id') == 'categories') {
                    $('#cat_error').removeClass('invalidFormData');
                    $('#cat_error').removeClass('cat_err_msg');
                }

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
                // if ($(element).attr('id') == 'location_1' || $(element).attr('id') == 'location_3' || $(element).attr('id') == 'location_4' ) {
                //     label.addClass('location_1');

                // }
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
if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
}
?>
