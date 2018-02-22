<? if ($sitemgr): ?>
    <style>
        label,
        span{
            float:left;
            margin-bottom: 5px;
        }
        .fullWidth{
            margin-bottom: 5px;
        }
        input,
        textarea,
        select{
            width: 100%;
        }
        .panel-body.BusinessInfopage {
            overflow: hidden;
        }
        /*    span{
                float:left;
                margin-bottom: 5px;
            }*/
        .text-right.textLeft{
            margin-bottom: 5px;
        }
        span.tipsSpan {
            float: none;
            margin-bottom: 0;
        }
        input.ChooseURL {
            height: 24px!important;
            width: 98%;
            margin-bottom: 5px;
        }
        textarea.ChooseURL{
            width: 98.5%;
            margin-bottom: 5px!important;
        }
        .pushBottom{
            overflow: hidden;
        }
        .textcounter{
            width:7%;
        }
        strong.BillingDateRenew {
            width: 100%;
            display: block;
            float: left;
            text-align: left;
        }
        .imgcap > img{
            float: left;
            margin-bottom: 5px;
        }
        a.forcePointer{
            float:left;
        }
        .captcha input.loginform{
            width: 98%;
            margin-bottom: 5px;
        }
    </style>
<? else: ?>
    <? if ($_GET['id']): ?>

        <? //Edit Page stylesheet?>

        <style>
            label{
                display:inline-block;
            }
            input::-webkit-input-placeholder {
                font-size:16px;
                font-weight:normal;

            }
            input::-moz-placeholder {
                font-size:16px;
                font-weight:normal;

            }
            input:-ms-input-placeholder { 
                font-size:16px;
                font-weight:normal;

            }
            .fullWidth {
                /*width: 100%!important;*/
            }
            input.form-control.input-width {
                width: 100%;
            }
            .form-control.input-widthUrl {
                width: 46%;
            }
            textarea.form-control.TextareaBI{
                margin-bottom: 0;
                display: inline-block!important;
                width: 85.5%!important;
            }
            select.location_1.location_1BL {
                width: 69%;
                margin-bottom: 0;
            }
            span.rb, span.bt, span.la, span.Country {
                margin-bottom: 5px;
                display: inline-block;
            }
            label.labelChooseURL {
                margin-bottom: 5px;
            }
            label.labelChooseURL {
                width: 19%;
            }
            input.form-control.pull-right.ChooseURL,
            textarea.form-control.pull-right.ChooseURL {
                width: 80.5%;
            }
            input.form-control.input-width.input-widthSocial {
                width: 59%;

            }
            span.ChCounter {
                margin-left: 19.5%;
            }
            .col-sm-3.biCus {
                width: 25%;
            }
            .panel-body.BusinessInfopage {
                font-size: 13px;
            }
            .custom_drop1,
            .custom_drop2,
            .custom_drop3{
                width: 100%;
            }
            .col-sm-3.biCus {
                /*width: 100%;*/
            }
            p.maxVideo a{
                color: #337ab7;
            }
            .panel-group.pushBottom {
                margin-bottom: 2px;
            }
            .ac_results{
                left:132px!important;
            }
            [class*="businessLocationTable"] {
                margin: 0;
            }
            [class*="businessLocationTable"] th {
                padding: 0;
                width: 35%; 
            }
            [class*="businessLocationTable"] label {
                font-size: 13px;
                margin-right: 5px;
            }
            .content-full .select {
                width: 100%;
                margin-bottom: 15px;
            }
            .standard-table span.asterik {
                color: #ff004f;
                display: inline-block;
            }
            .billingInformation {
                overflow: hidden;
                text-align: center;
            }
            #showSubscribeButton,
            #showUnSubscribeButton {
                text-align: center;
            }
            @media (max-width: 1199px) and (min-width: 992px){
                .fullWidth {
                    width: 100%!important;
                }
                .panel-body.BusinessInfopage {
                    font-size: 12px;
                }
                .form-control.input-widthUrl {
                    width: 46.5%;
                }
                textarea.form-control.TextareaBI {
                    width: 61%!important;
                }
                select.location_1.location_1BL {
                    width: 61%;
                }
                input.form-control.input-width {
                    width: 100%;
                }
                .ac_results{
                    left:129px!important;
                    width: 53.5%!important;
                }

            }
            @media (max-width: 991px) and (min-width: 768px){
                input.form-control.input-width {
                    width: 100%; 
                }
                .text-right.textLeft{
                    text-align:left;
                }
                textarea.form-control.TextareaBI {
                    width: 100%!important;
                }
                .fullWidth {
                    width: 100%!important;
                }
                label.URL{
                    display: block!important;
                }
                .form-control.input-widthUrl {
                    width: 80%!important;
                }
                select.custom_drop1,
                select.custom_drop2,
                select.custom_drop3 {
                    width:100%!important;
                }
                span.Country {
                    display: block;
                }
                select.location_1 {
                    width: 100%!important;
                }
                label.labelChooseURL {
                    width: 100%; 
                    text-align: left!important;
                    margin-bottom: 5px;
                }
                input.form-control.pull-right.ChooseURL,
                textarea.form-control.pull-right.ChooseURL {
                    margin-bottom: 5px; 
                    width: 100%; 
                }
                input.form-control.input-width.input-widthSocial {
                    width: 100%;
                }
                span.ChCounter {
                    margin-left: 1px;

                }
                .panel-group.pushBottom {
                    margin-bottom: 2px;
                }
                .ac_results{
                    left:17px!important;
                    width: 89.5%!important;
                }
                [class*="businessLocationTable"] th {
                    display: block;
                    text-align: left;
                }
                [class*="businessLocationTable"] td {
                    display: block;
                }
            }
            @media (max-width: 767px){
                input.form-control.input-width {
                    width: 100%; 
                }
                .text-right.textLeft{
                    text-align:left;
                }
                textarea.form-control.TextareaBI {
                    width: 100%!important;
                }
                label.URL{
                    display: block!important;
                }
                .form-control.input-widthUrl {
                    width: 100%!important;
                }
                .btn-group.cusDropdown {
                    margin-bottom: 5px!important;
                }
                select.custom_drop1,
                select.custom_drop2,
                select.custom_drop3 {
                    width:100%!important;
                }
                span.Country {
                    display: block;
                }
                select.location_1 {
                    width: 100%!important;
                }
                label.labelChooseURL {
                    width: 100%; 
                    text-align: left!important;
                    margin-bottom: 5px;
                }
                input.form-control.pull-right.ChooseURL,
                textarea.form-control.pull-right.ChooseURL {
                    margin-bottom: 5px; 
                    width: 100%; 
                }
                input.form-control.input-width.input-widthSocial {
                    width: 100%;
                }
                span.ChCounter {
                    margin-left: 1px;

                }
                .panel-group.pushBottom {
                    margin-bottom: 2px;
                }
                .ac_results{
                    left:17px!important;
                    width: 94.5%!important;
                }
                [class*="businessLocationTable"] th {
                    display: block;
                    text-align: left;
                }
                [class*="businessLocationTable"] td {
                    display: block;
                }
            }

        </style>
    <? else: ?>

        <? // Add/Claim Page stylesheet?>

        <style>
            input::-webkit-input-placeholder {
                font-size:16px;
                font-weight:normal;

            }
            input::-moz-placeholder {
                font-size:16px;
                font-weight:normal;

            }
            input:-ms-input-placeholder { 
                font-size:16px;
                font-weight:normal;

            }
            .panel-body.BusinessInfopage label{
                color:#000;
                display:inline-block;
            }
            select.location_1.location_1BL{
                width:330px;
                margin-bottom:0;
            }
            textarea.TextareaBI{
                display: inline-block!important;
                width:81%!important;
            }
            .custom_drop1{
                width: 142px;
            }
            .custom_drop3{
                width: 160px;
            }
            .ac_results{
                left:225px!important;
                width: 57.5%!important;
            }
            [class*="businessLocationTable"] {
                margin: 0;
            }
            [class*="businessLocationTable"] th {
                padding: 0;
                width: 35%; 
            }
            [class*="businessLocationTable"] label {
                font-size: 16px;
                margin-right: 5px;
                margin-top: -10px;
            }
            .content-full .select {
                width: 100%;
                margin-bottom: 15px;
            }
            .standard-table span.asterik {
                color: #ff004f;
                display: inline-block;
            }

            @media (max-width: 1199px) and (min-width: 992px){
                .panel-body.BusinessInfopage {
                    font-size: 13px;
                }
                .form-control.input-widthUrl {
                    width: 39%;
                }
                select.custom_drop1 {
                    width: 115px!important;
                }
                select.custom_drop2 {
                    width: 182px!important;
                }
                select.custom_drop3 {
                    width: 138px!important;
                }
                select.location_1 {
                    width: 271px !important;
                }
                [class*="businessLocationTable"] label {
                    font-size: 13px;
                }

            }

            @media (max-width: 991px) and (min-width: 768px){
                .panel-body.BusinessInfopage {
                    font-size: 13px;
                }
                select.location_1.location_1BL {
                    width: 182px !important;
                }
                input.form-control.input-width {
                    width: 70%;
                }
                input.form-control.input-width.input-widthBL {
                    width: 65.5%;
                }
                input.form-control.input-width.input-widthSocial {
                    width: 81.5%;
                }
                .form-control.input-widthUrl {
                    width: 56%;
                }
                textarea.TextareaBI {
                    width:70%!important;
                }
                .col-sm-3.biCus {
                    width: 100%;
                }
                .panel-group.pushBottom {
                    margin-bottom: 2px;
                }
                [class*="businessLocationTable"] label {
                    font-size: 13px;
                }
            }
            @media (max-width: 767px){
                input.form-control.input-width {
                    width: 100%; 
                }
                .text-right.textLeft{
                    text-align:left;
                }
                textarea.TextareaBI {
                    width: 100%!important;
                }
                label.URL{
                    display: block!important;
                }
                .form-control.input-widthUrl {
                    width: 82.5%!important;
                }
                .btn-group.cusDropdown {
                    margin-bottom: 5px!important;
                }
                .form-control.input-widthUrl {
                    width: 100%!important;
                }
                select.custom_drop1,
                select.custom_drop2,
                select.custom_drop3 {
                    width:100%!important;
                }
                span.Country {
                    display: block;
                }
                select.location_1 {
                    width: 100%!important;
                }
                label.labelChooseURL {
                    width: 100%; 
                    text-align: left!important;
                    margin-bottom: 5px;
                }
                input.form-control.pull-right.ChooseURL,
                textarea.form-control.pull-right.ChooseURL {
                    margin-bottom: 5px; 
                    width: 100%; 
                }
                input.form-control.input-width.input-widthSocial {
                    width: 100%;
                }
                span.ChCounter {
                    margin-left: 1px;

                }
                .panel-group.pushBottom {
                    margin-bottom: 2px;
                }
                [class*="businessLocationTable"] th {
                    display: block;
                    text-align: left;
                }
                [class*="businessLocationTable"] td {
                    display: block;
                }
            }
        </style>
        
        
                    <style>
            @media screen and (max-height: 550px){
            #fornolyrechapcha {
                transform:scale(0.79);
                -webkit-transform:scale(0.79);
                transform-origin:0 0;
                -webkit-transform-origin:0 0;
            }
            }
                    </style>
        

            
    <? endif; ?>
<? endif; ?>
<?
#-------------------------------------------------------
# Custom Parameters
#-------------------------------------------------------
# custom_text0      -> LegalBusinessName
# custom_dropdown0  -> url type (http, https, ftp)
# custom_dropdown1  -> BusinessRelation
# custom_dropdown2  -> BusinessType
# custom_dropdown3  -> LocationActivities
# custom_text1      -> TwitterFeed
# custom_text2      -> Subscription ID for braintree
# custom_text3      -> nextBillingDate from braintree
# custom_text4      -> customer id for braintree 
# custom_text5      -> Payment method token from braintree 
# custom_checkbox0  -> Business is website
# custom_checkbox1  -> Global Brand
# custom_checkbox2  -> Country Brand
# custom_checkbox3  -> y -> monthly, n -> yearly
# custom_checkbox4  -> Listing's grace period of 30 days
#-------------------------------------------------------
?>
<?php
$acctId = sess_getAccountIdFromSession();
$contactObj = new Contact($acctId);
$listing_array = (array) $listing;
$listing_array = HtmlCleaner::CleanBasic($listing_array);
$listing = new Listing($listing_array);
?>
<div <?= !$_SERVER['HTTP_X_REQUESTED_WITH'] ? 'class="container"' : '' ?>>

    
    <div class="panel panel-default" id='logo'>
    <div class="panel-heading BusinessInfoPage">
        <h1 class="panel-title BusinessTitle">Logo and video <small>(700px x 460px) (JPG, GIF or PNG)</small></h1>
    </div>
    <div class="panel-body BusinessInfopage">
        <div class="row">
            <div class="col-sm-12">

<? if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0) { ?>
                    <table class="standard-table galleryImgcenter" > 
                        <tr id="table_gallery">
                            <td colspan="3">
                                <div id="galleryF" class="galleryImgcenter"></div>
                            </td>
                        </tr>

                        <?
                        $gallery_id = $listing->getGalleries();
                        if ($onlyMainImage) {
                            ?>
                            <tr id="addImage" style="display:<?= ($image_id ? "none" : ""); ?>">
                                <? } else { ?>
                            <tr>
                                <? } ?>
                            <td class="alignTop ">
                                <? if ($members) { ?>
                                    <a id="uploadimage" tabindex="45" href="<?= DEFAULT_URL ?>/sponsors/popup/popup.php?domain_id=<?= SELECTED_DOMAIN_ID ?>&pop_type=uploadimage&gallery_hash=<?= $gallery_hash ?>&item_type=listing&item_id=<?= $listing->getNumber("id") ?>&galleryid=<?= $gallery_id[0] ?>&photos=<?= $levelMaxImages ?>&level=<?= $level ?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><?= system_showText(LANG_LABEL_ADDIMAGE) ?></a>
    <? } else { ?>
                                    <a id="uploadimage" tabindex="45" href="<?= DEFAULT_URL ?>/<?= SITEMGR_ALIAS ?>/uploadimage.php?gallery_hash=<?= $gallery_hash ?>&item_type=listing&item_id=<?= $listing->getNumber("id") ?>&galleryid=<?= $gallery_id[0] ?>&photos=<?= $levelMaxImages ?>&level=<?= $level ?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?= system_showText(LANG_LABEL_ADDIMAGE) ?></b></a>
    <? } ?>
                                <tr style="text-algin:center;">
                           <p id="uploadimageError" class="error" style="display:none;">Only one image is allowed for uploading at a time.</p> 
                        </tr>
                            </td>
                        </tr> 
                        
                    </table>
                <? } ?>
<? if ($claimlistingid): ?>
                    <input type="hidden" name="gallery_hash" value="<?= $gallery_hash ?>">
<? endif; ?>
            </div>
        </div>
    </div>
</div> <!-- panel panel-default end-->
    
    
    <div class="panel panel-default">
    <div class="panel-heading BusinessInfoPage">
        <h1 class="panel-title BusinessTitle">Video Snippet Code <small>(If video snippet code was filled in, it will appear on the detail page)</small></h1>
    </div>
    <div class="panel-body BusinessInfopage">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-6 pushBottom">
                        <div class=" textLeft">
                            <div class="col-md-12">
                               <label for="video_snippet" >Code:</label> 
                            </div>
                            <div class="col-md-12">
                                 <input type="text" tabindex="47" name="video_snippet" value="<?= $listing->video_snippet ?>" class="form-control input-width" id="video_snippet" placeholder="">
                            </div>
                                
                            
                           
                        </div>
                    </div>
                    <div class="form-group col-sm-6 pushBottom">
                        <div class=" textLeft">
                            <div class="col-md-12">
                                  <label for="Caption"> Caption:</label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" tabindex="48" name="video_description" class="form-control input-width" value="<?= $listing->video_description ?>" id="Caption" placeholder="">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <p class="maxVideo">(Maximum video code size supported: 605px x 272px.) (If the video code size is bigger than supported video size, it will be modified.) (Do you have a question about Video Snippet Code? <a href="<?= NON_SECURE_URL ?>/sponsors/<?= ALIAS_FAQ_URL_DIVISOR ?>.php" tabindex="49">Click here.</a>)</p>
            </div>
        </div>
    </div>
</div> <!-- panel panel-default end-->

</div>
<!-- panel panel-default end-->    

<div class="panel panel-default">
    <div class="panel-heading BusinessInfoPage">
        <h1 class="panel-title BusinessTitle">Captcha</h1>
    </div>
    <div class="panel-body BusinessInfopage">
        <div class="row">
            <div class="col-sm-12" style="text-align: -moz-center;">
                <div class="action" style="text-align : -webkit-center;">
                    <div class="row reviewpara text-center ">
                        <p><?= system_showText(LANG_CAPTCHA_HELP) ?></p>
                    </div>
                    <div id="fornolyrechapcha">
                        <!--  NEW GOOGLE Re-Captcha    -->                
                        <div class="g-recaptcha centeringcaptcha" data-callback="imNotARobot" data-sitekey="6Ld09CgTAAAAAH4hvLsHBL-HFvoe9atQbz1IhVjZ" ></div>
                        <span id="re-captcha" style="color:red" />            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- panel panel-default end-->

</div> <!-- container end-->
 <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<script type="text/javascript">
    var imNotARobot = function() {
    console.info("Button was clicked");
    document.getElementById('captcha').innerHTML = "";
    };</script>

<script>



    $('.catName').click(function(){
    var divCls = $(this).closest('div').next().attr('class');
    var elm = $(this).find('i').next('i');
    if (divCls.indexOf("in") >= 0) {

    elm.next('i').attr('class', '');
    elm.attr('class', 'fa fa-plus pull-right');
    //alert(a);
    } else {
    elm.attr('class', '');
    elm.attr('class', 'fa fa-minus pull-right');
    }


    });
    $("a.fancy_window_imgAdd").fancybox({
    'type'                  : 'iframe',
            'width'                 : <?= FANCYBOX_UPIMAGE_WIDTH ?>,
            'minHeight'             : <?= FANCYBOX_UPIMAGE_HEIGHT ?>,
            'closeBtn'              : false,
            'padding'               : 0,
            'margin'                : 0
    });
    // ---------------------------------------------------------------- //

    $('.panelbody').click(function(){
    $('.panelbody').css('background-color', '#FFF');
    $(this).css('background-color', '#ccc');
    $('input[name=keywords]').val($(this).children('a').text());
    });


    // ---------------------------------------------------------------- //

    function validateFriendlyURL(friendly_url, id) {

    $("#URL_ok").css("display", "none");
    $("#URL_notok").css("display", "none");
    if (friendly_url) {

    $("#loadingURL").css("display", "");
    $.get(DEFAULT_URL + "/check_friendlyurl.php", {
    type: "listings",
            friendly_url: friendly_url,
            id : id
    }, function (response) {
    if (response.trim() == "ok") {
    $("#urlSample").html(friendly_url);
    $("#URL_ok").css("display", "");
    $("#URL_notok").css("display", "none");
    } else {
    $("#URL_ok").css("display", "none");
    $("#URL_notok").css("display", "");
    }
    $("#loadingURL").css("display", "none");
    });
    } else {
    $("#URL_ok").css("display", "none");
    $("#URL_notok").css("display", "none");
    }
    }

    // ---------------------------------------------------------------- //

    function captchaReload(){
    var d = new Date();
    $("#capimg").attr("src", "<?= DEFAULT_URL ?>/includes/code/captcha.php?" + d.getTime());
    }

</script>



<script>

    function isInt(elm) {
    if (elm.value == "") {
    return false;
    }
    for (var i = 0; i < elm.value.length; i++) {
    if (elm.value.charAt(i) < "0" || elm.value.charAt(i) > "9") {
    return false;
    }
    }
    return true;
    }

    // ---------------------------------- //

    function JS_submit() {
    document.listing.submit();
    }

    // ---------------------------------- //

    function makeMain(image_id, thumb_id, item_id, temp, item_type) {

    $.get(DEFAULT_URL + "/makemainimage.php", {
    image_id: image_id,
            thumb_id: thumb_id,
            item_id: item_id,
            temp: temp,
            item_type: item_type,
            gallery_hash: '<?= $gallery_hash ?>',
            domain_id: <?= SELECTED_DOMAIN_ID ?>
    }, function () {
<? if ($members) { ?>
        loadGallery(item_id, "y", "<?= MEMBERS_ALIAS ?>", "", "true");
<? } else { ?>
        loadGallery(item_id, "y", "<?= SITEMGR_ALIAS ?>", "", "true");
<? } ?>
    });
    }

    // ---------------------------------- //

    function changeMain(image_id, thumb_id, item_id, temp, gallery_id, item_type) {

    $.get(DEFAULT_URL + "/changemainimage.php", {
    image_id: image_id,
            thumb_id: thumb_id,
            item_id: item_id,
            gallery_id: gallery_id,
            temp: temp,
            item_type: item_type,
            level: <?= $level ?>,
            gallery_hash: '<?= $gallery_hash ?>',
            domain_id: <?= SELECTED_DOMAIN_ID ?>
    }, function (response) {
    if (response == "error"){
    fancy_alert('<?= system_showText(LANG_ITEM_ALREADY_HAD_MAX_IMAGE) ?>', 'errorMessage', false, 500, 100, false);
    }
<? if ($members) { ?>
        loadGallery(item_id, "y", "<?= MEMBERS_ALIAS ?>", "", "true");
<? } else { ?>
        loadGallery(item_id, "y", "<?= SITEMGR_ALIAS ?>", "", "true");
<? } ?>
    });
    }

    // ---------------------------------- //

    function loadGallery(id, new_image, sess, del, main) {

    $("#galleryF").fadeIn(0);
    $.get(DEFAULT_URL + "/includes/code/returngallery.php", {
    sess: sess,
            module: 'listing',
            id: id,
            new_image: new_image,
            main: main,
            gallery_hash: '<?= $gallery_hash ?>',
            domain_id: <?= SELECTED_DOMAIN_ID ?>,
            level: <?= $level ?>
    }, function (ret) {
    $("#galleryF").html(ret);
    if (ret.indexOf('<img') > - 1){
    $("#uploadimage").removeClass('fancy_window_imgAdd');
    $("#uploadimage").click(function(event){
    event.preventDefault();
    if ($("#uploadimage").attr('class').indexOf('fancy_window_imgAdd') == - 1){
    $('#uploadimageError').show();
    }

    });
    } else {
    $('#uploadimageError').hide();
    $("#uploadimage").addClass('fancy_window_imgAdd');
    }

    $('.ImageDelete').click(function(){
    $('#uploadimageError').hide();
    });
    $('.ImageDelete').click(function(){
    $('#uploadimageError').hide();
    });
    if (del != "edit" && del != "editFe"){
    if (del == "n"){
    $("#addImage").css("display", "none");
    $("#galleryF").css("display", "");
    } else {
<? if ($hasImage) { ?>
        if (del) {
        $("#addImage").css("display", "none");
        $("#galleryF").css("display", "");
        } else {
        $("#addImage").css("display", "");
        $("#galleryF").css("display", "none");
        }
<? } else { ?>
        $("#addImage").css("display", "");
        $("#galleryF").css("display", "none");
<? } ?>
    }
    } else {
    if (del == "edit" || del == "editFe")
            $("#galleryF").css("display", "");
    }

    if (main == "true"){
    $("#galleryF").css("display", "");
    }
<? if ($hasImage) { ?>
        $("#galleryF").css("display", "");
<? } ?>

    if (ret == "no image"){
    $("#galleryF").css("display", "none");
    }

    $("a.fancy_window_imgCaptions").fancybox({

<? if ($members) { ?>

        'type'                  : 'iframe',
                'width'                 : <?= FANCYBOX_IMAGECAPTIONS_WIDTH ?>,
                'minHeight'             : <?= FANCYBOX_IMAGECAPTIONS_HEIGHT ?>,
    <? if (THEME_FLAT_FANCYBOX) { ?>
            'closeBtn'              : false,
    <? } ?>
        'padding'               : 0,
                'margin'                : 0

<? } else { ?>

        'overlayShow'           : true,
                'overlayOpacity'        : 0.75,
                'autoDimensions'        : false,
                'width'                 : <?= FANCYBOX_IMAGECAPTIONS_WIDTH ?>,
                'height'                : <?= FANCYBOX_IMAGECAPTIONS_HEIGHT ?>,
                'titleShow'             : false

<? } ?>

    });
    $("a.fancy_window_imgDelete").fancybox({

<? if ($members) { ?>
        'type'                  : 'iframe',
                'width'                 : <?= FANCYBOX_DELIMAGE_WIDTH ?>,
                'minHeight'             : <?= FANCYBOX_DELIMAGE_HEIGHT ?>,
    <? if (THEME_FLAT_FANCYBOX) { ?>
            'closeBtn'              : false,
    <? } ?>
        'padding'               : 0,
                'margin'                : 0
<? } else { ?>

        'overlayShow'           : true,
                'overlayOpacity'        : 0.4,
                'autoDimensions'        : false,
                'width'                 : <?= FANCYBOX_DELIMAGE_WIDTH ?>,
                'height'                : <?= FANCYBOX_DELIMAGE_HEIGHT ?>,
                'titleShow'             : false
<? } ?>
    });
    });
    }

<?
if ($members)
    $sess = MEMBERS_ALIAS;
else
    $sess = SITEMGR_ALIAS;
$id ? null : $id = $claimlistingid; //Fix for add image not showin claim page
?>
    loadGallery(<?= $id ? $id : '0' ?>, 'y', '<?= $sess ?>', '<?= $id ? 'editFe' : 'editF' ?>', <?= $onlyMainImage ? "'false'" : "''" ?>);
<? if ($hasValidCoord) { ?>
        loadMap(document.listing, true);
<? } ?>

</script>
<? // Local Global Validation Script     ?>

<script>

    function  unsubscribeConfirm(){
    $.fancybox({
    content: '<div class="modal-content">\
                        <h2><span>Warning!</span><span>\
                        <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                        <div style="width:240px;" class="sureDelete">\
                        <p id="model-text">Are you sure you want to unsubscribe this business ?</p>\
                        <p id="model-text-done" style="display:none;">Unsubscribed successful!.</p>\
                        <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                        <div style="text-align:right;margin-top:10px;">\
                        <button id="ok-model-button" onclick="unsubscribe(' +<?= $listing->id ?> + ');jQuery.fancybox.close();" style="padding:4px 6px;" type="button" class="btn btnOk">Ok</button>\
                        <button id="cancel-model-button"style="padding:4px 6px;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Cancel</button>\
                        <button id="done-model-button" style="padding:4px 6px;display:none;" onclick="location.reload();jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                        <button id="failed-model-button" style="padding:4px 6px;display:none;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                        </div></div>\
                    </div>',
            modal: true
    });
    }
    function unsubscribe(listing){
    $('#spinnerSubscribe').show();
    $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", {
    ajax_type :"unsubscribe_listing",
            listing   : listing
    }, function(result){
    $('#spinnerSubscribe').hide();
    if (result.trim() == "success"){
    $('#showUnSubscribeButton').hide();
    $('#showSubscribeButton').show()
            $('#messageSubscribe').html('Unsubscribe Successful.');
    }

    if (result.trim() == "error"){
    $('#messageSubscribe').html('Unsubscribe Failed, Please Try Again.');
    }

    });
    }

    function subscribe(listing){
    var checkCookie = $.cookie('showListing');
    if (!$.cookie('showListing').indexOf('4298') > - 1){
    $.cookie('showListing', checkCookie + listing + ",");
    }
    $('#bill').click();
    }
</script>
<script>
    $(document).ready(function(){

    // if url is active only display url field sholud be active
    var url = $('#url').val();
    if (url != ''){
    $('#display_url').attr('readonly', false);
    }
    else {
    $('#display_url').attr('readonly', true);
    }

    $('#url').on('change', function(){
    if ($('#url').val() != ''){
    $('#display_url').attr('readonly', false);
    }
    else{
    $('#display_url').attr('readonly', true);
    }
    })


    });

</script>



