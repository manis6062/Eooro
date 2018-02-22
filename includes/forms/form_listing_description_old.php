<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                width: 69%;
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
                    width: 61%;
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
        
       
        

    
        
    <? endif; ?>
<? endif; ?>
        
         <style>
            .ui-menu .ui-menu-item a{
                font-size: 14px;
            }
            
             .schroll{height:150px; width:100%;}
.schroll{overflow:hidden; overflow-y:scroll;}


#save_categories{
    background-color: #ccc;
    border: 0 none;
    border-radius: 5px;
    color: #fff;
    padding: 6px;
  
}

            
        </style>
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

    <div class="panel panel-default">
        <div class="panel-heading BusinessInfoPage">
            <h1 class="panel-title BusinessTitle">Business Description and Category</h1>
        </div>
        <div class="panel-body BusinessInfopage">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <label for="description" class="description" >Description:</label>
                        <textarea maxlength="5000" class="form-control TextareaBI" tabindex="7" rows="3" name="long_description" id="description" placeholder="Type Description" title="Type Description"><?= stripcslashes($listing->long_description) ?></textarea>
                    </div>
                    <br>
                    <div class="row">
                        <label for="SummaryDescription" class="labelChooseURL" >Summary Description:<span class="asterik">*</span><br>
                            <span class="maxCh">(maximum 250 characters)</span><br>
                        </label>
                        <textarea id="summary" tabindex="21" class="form-control pull-right ChooseURL" maxlength="250" rows="3" name="description" style="margin-bottom:0;" id="SummaryDescription" placeholder="To be used used for seo for page meta description tag and on social media share." title="To be used used for seo for page meta description tag and on social media share."><?= stripcslashes($listing->description) ?></textarea>
                        <span class="ChCounter"><label style="margin-bottom:0;" id="summarydesc_remLen" class="textcounter" > 250 </label>Characters left (including spaces and line breaks)</span>
                    </div>
                </div>


            </div>


            <br>
            <br>





            <?
            //Extract Categories Details
            $categoriesListing = Listing_Category::getCatDetailsFromSubcategory($listing->keywords);
            ?>

            <div class="panel panel-default">
                <div class="panel-heading BusinessInfoPage">
                    <h1 class="panel-title BusinessTitle">Business Categories</h1>
                </div>




                <div class="panel-body BusinessInfopage">
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="col-md-9 col-lg-9" style="padding-left:8px;">
                                <label for="description" class="description" >Choose Business Categories:</label>
                                <input type="text" id="category_name"  name="category_name" style="width:65%;">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <button id ="save_categories" disabled="disabled">Select</button>
<!--                                <button id ="clear_categories" style="background-color: #1fb53b;border: 0 none; border-radius: 5px;color: #fff;padding: 6px;">Clear</button>-->
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <div class="row">
                                <div id="cat_error">
                                    <?
                                    $tabindex = 23;
                                    foreach ($category_names as $key => $names) :
                                        ?>
                                        <? if ($_GET['id']): ?>

                                            <?= ($key == 6 || $key == 18 || $key == 24) ? "<div class='col-sm-6 biCus'>" : null ?>
                                        <? else : ?>

                                            <?= ($key == 6 || $key == 12 || $key == 18 || $key == 24) ? "<div class='col-sm-4 biCus'>" : null ?>
                                        <?
                                        endif;
                                        $url_cat = str_replace("&", "_", $names['category_name']);
                                        $url_cat = str_replace(" ", "", $url_cat);
                                                                               
                                        ?>
                                        <div id = "<?php echo $url_cat . '_2'; ?>" class='panel-group pushBottom' tabindex=<?php echo $tabindex; ?>>
                                            <div class='panel panel-default'>
                                                <div class="panel-heading panelHeadingColor">

                                                    <h4 class="panel-title BusinessTitle">
                                                        <a data-toggle="collapse" href="#<?= $url_cat ?>" id = "<?= $categoriesListing['cat_name'] .'_1' ?>" class="collapsed test_collapse catName" aria-expanded="false"> 
                                                            <i class="<?= $names['category_icon'] ?>"></i> 
                                                            <?= $names['category_name'] ?> 
                                                            <? if ($categoriesListing['cat_name'] == $names['category_name']) { ?>
                                                                <i class="fa fa-minus pull-right"></i></a><? } else {
                                                                ?>
                                                            <i class="fa fa-plus pull-right"></i></a>
                                                        <? } ?>
                                                    </h4>
                                                </div>

                                                <ul id="<?= $url_cat ?>" class="schroll panel-collapse collapse ulLists <?= ($categoriesListing['cat_name'] == $names['category_name'] ? "in" : "") ?>" aria-expanded="false" >

                                                    <?
                                                    foreach ($names['sub_cateogry'] as $sub_cats):
                                                        $replaced_sub_cats = str_replace("&", "_", $sub_cats);
                                                        $replaced_sub_cats = str_replace(",", "", $replaced_sub_cats);
                                                        $replaced_sub_cats = str_replace("/", "", $replaced_sub_cats);
                                                        $replaced_sub_cats = str_replace(" ", "", $replaced_sub_cats);

                                                        ?>
                                                        <li  id = '<?= $replaced_sub_cats; ?>' class="panelbody" <?= ($sub_cats == $categoriesListing['sub_name'] ? "style='background-color:#ccc'" : "") ?>><a><?= $sub_cats ?></a></li>
                                                    <? endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <? if ($_GET['id']): ?>
                                            <?= ($key == 1 || $key == 23) ? "</div>" : null ?>
                                        <? else : ?>
                                            <?= ($key == 1 || $key == 11 || $key == 23) ? "</div>" : null ?>
                                        <? endif; ?>
                                        <?
                                        $tabindex++;
                                    endforeach;
                                    ?>
                                </div>
                                <input name="keywords" type="hidden" value="<?= $listing->keywords ?>" id="categories">
                            </div>
                        </div>
                    </div>
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
                    <div>
                        <!--  NEW GOOGLE Re-Captcha    -->                
                        <div class="g-recaptcha centeringcaptcha" data-callback="imNotARobot" data-sitekey="6Ld09CgTAAAAAH4hvLsHBL-HFvoe9atQbz1IhVjZ"></div>
                        <span id="re-captcha" style="color:red" />            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- panel panel-default end-->

</div> <!-- container end-->
<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/common.js"></script>
<script src="<?= DEFAULT_URL ?>/scripts/jquery/jquery-1.10.2.js"></script>
<script src="<?= DEFAULT_URL ?>/scripts/jquery/jquery_ui/js/jquery-ui-1.10.4.js"></script> 


<script type="text/javascript">
    var imNotARobot = function () {
        console.info("Button was clicked");
        document.getElementById('captcha').innerHTML = "";
    };</script>

<script>
    $('.catName').click(function () {
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

    // ---------------------------------------------------------------- //

    $('.panelbody').click(function () {
        $('.panelbody').css('background-color', '#FFF');
        $(this).css('background-color', '#ccc');
        $('input[name=keywords]').val($(this).children('a').text());
    });








</script>

<script>
    
    
// +, - toggle script

    $(".fa-minus, .fa-plus").click(function () {
        var $this = $(this);
        if ($this.hasClass("fa-plus")) {
            $(".panelbody").css('display' , 'block');
            $('.ulLists').addClass( "schroll" );
            $this.removeClass("fa-plus").addClass("fa-minus");
            $('.ulLists').removeClass( "in" );
            
        if ($this.hasClass("fa-plus")) {
            
        }
            
            return;
        }
        if ($this.hasClass("fa-minus")) {
            $this.removeClass("fa-minus").addClass("fa-plus");
            return;
        }
    });</script>


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


    function JS_submit() {
        document.listing.submit();
    }

</script>

<script>




    var $h = jQuery.noConflict();
    $h(document).ready(function () {
        

//        $h(".pushBottom").not("#Professional_Legal_2").css('display' , 'none');
////        $h(".biCus").css('width' , '100%');
//        $h(".panelbody").not("#Accountants").css('display' , 'none');


        SearchText();

        function SearchText() {
            $h("input#category_name").autocomplete({
                source: function (request, response) {
                    $h.ajax({
                        type: "POST",
                        url: '<? echo DEFAULT_URL . '/sponsors/ajax_load_categories.php' ?>?category_name=' + $h('#category_name').val(),
                        dataType: 'json',
                        success: function (data) {
                            if (data != null) {
                                response(data);
                            }
                            $h(".pushBottom").css('display' , 'block');
                            $h("#save_categories").attr('disabled' , false);
                             $h("#save_categories").css('background' , '#1fb53b');
                        },
                        error: function (result) {
                            alert("Error");
                        }
                    });
                },
                maxShowItems: 5,
                select: function (e, ui) {
                
                    var selected_category_id;
                    var selected_subcategory_id;
                    var select_categoryandsubcategory;
                    var selected_category;
                    var selected_subcategory;

                    selected_category_id = ui.item.category_id;
                    selected_subcategory_id = ui.item.subcategory_id;
                    selected_category = ui.item.category_name;
                    selected_subcategory = ui.item.subcategory_name;
                    select_categoryandsubcategory = ui.item.value;

                    //string replace categories
                    var org_string = selected_category;
                    var newchar = '_';
                    selected_category = org_string.split('&').join(newchar);

                    var org_string1 = selected_category;
                    var newchar1 = '';
                    selected_category = org_string1.split(' ').join(newchar1);
                    
                    
                    console.log(selected_category);


                    var org_sub_string = selected_subcategory;
                    var newchar2 = '_';
                    selected_subcategory = org_sub_string.split('&').join(newchar2);

                    var org_sub_string1 = selected_subcategory;
                    var newchar3 = '';
                    selected_subcategory = org_sub_string1.split(' ').join(newchar3);
                    
                     var org_sub_string2 = selected_subcategory;
                    var newchar4 = '';
                    selected_subcategory = org_sub_string2.split(',').join(newchar4);
                    
                     var org_sub_string3 = selected_subcategory;
                    var newchar5 = '';
                    selected_subcategory = org_sub_string3.split('/').join(newchar5);
                    
                     console.log(selected_subcategory);
                    
                    $h(".panelbody").not("#" + selected_subcategory).css('display' , 'none');
                    $h('.ulLists').removeClass( "schroll" );
                    $h("#" + selected_category).show();
                    $h('.panelbody').css('background-color', '#FFF');
                    $h('.ulLists').removeClass( "in" );
                    $h("#" + selected_subcategory).css('display', 'flex');
                    $h("#" + selected_subcategory).css('background', '#ccc');
                    $h('input[name=keywords]').val($h("#" + selected_subcategory).children('a').text());
                    
                    
                      if($h("#save_categories").click(function () {
                               $h(".pushBottom").css('display' , 'block');
                               $h(".pushBottom").not("#" + selected_category + '_2').css('display' , 'none');
                               $('input#category_name').autocomplete('close').val('');
                                 $h("#save_categories").attr('disabled' , true);
                                 $h("#save_categories").css('background' , '#ccc');

                          }));


                    
                }

                
            });
        }
        
         $h.ui.autocomplete.prototype._renderItem = function (ul, item) {
            var highlighted = item.label.split(this.term).join('<strong>' + this.term +  '</strong>');
            return $h("<li></li>")
                .data("ui-autocomplete", item)
                .append("<a>" + highlighted + "</a>")
                .appendTo(ul); }  
        
      
        

        // if url is active only display url field sholud be active
        var url = $('#url').val();
        if (url != '') {
            $('#display_url').attr('readonly', false);
        } else {
            $('#display_url').attr('readonly', true);
        }

        $('#url').on('change', function () {
            if ($('#url').val() != '') {
                $('#display_url').attr('readonly', false);
            } else {
                $('#display_url').attr('readonly', true);
            }
        })


// limited charecter countdown in textarea

        var maxLength = 250;
        var length = $('textarea#summary').val().length;
        var length = maxLength - length;
        $('#summarydesc_remLen').text(length);
        $('textarea#summary').keyup(function () {
            var length = $(this).val().length;
            var length = maxLength - length;
            $('#summarydesc_remLen').text(length);
        });
        // limited keyword

        //var words = $("textarea#KeywordSearch").value.match(/\S+/g).length;
        //$('#word_left').text(25-words);

        $("textarea#KeywordSearch").keyup(function () {
            var words = this.value.match(/\S+/g).length;
            if (words > 25) {
                // Split the string on first 20 words and rejoin on spaces
                var trimmed = $(this).val().split(/\s+/, 25).join(" ");
                // Add a space at the end to keep new typing making new words
                $(this).val(trimmed + " ");
            } else {

                $('#word_left').text((25 - words) + ' keywords left');
            }
        });
    });
    
    
    
    /*
 * Scrollable jQuery UI Autocomplete
 * https://github.com/anseki/jquery-ui-autocomplete-scroll
 *
 * Copyright (c) 2016 anseki
 * Licensed under the MIT license.
 */
;(function($, undefined) {
'use strict';

$.widget('ui.autocomplete', $.ui.autocomplete, {
  _resizeMenu: function() {
    var ul, lis, ulW, barW;
    if (isNaN(this.options.maxShowItems)) { return; }
    ul = this.menu.element
      .scrollLeft(0).scrollTop(0) // Reset scroll position
      .css({overflowX: '', overflowY: '', width: '', maxHeight: ''}); // Restore
    lis = ul.children('li').css('whiteSpace', 'nowrap');

    if (lis.length > this.options.maxShowItems) {
      ulW = ul.prop('clientWidth');
      ul.css({overflowX: 'hidden', overflowY: 'auto',
        maxHeight: lis.eq(0).outerHeight() * this.options.maxShowItems + 1}); // 1px for Firefox
      barW = ulW - ul.prop('clientWidth');
      ul.width('+=' + barW);
    }

    // Original code from jquery.ui.autocomplete.js _resizeMenu()
    ul.outerWidth(Math.max(
      ul.outerWidth() + 1,
      this.element.outerWidth()
    ));
  }
});

})(jQuery);

</script>
