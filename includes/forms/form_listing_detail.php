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
/*                input.form-control.input-width {
                    width: 61%;
                }*/
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
            <h1 class="panel-title BusinessTitle">Business Detail</h1>
        </div>
        <div class="panel-body BusinessInfopage">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                
                                <div class="col-md-12">
                                   <label for="BusinessTradingName" class="businesstradingname">Business Name:<span class="asterik">*</span></label> 
                                </div>
                                <div class="col-md-12">
                                   <input type="text" maxlength="128" tabindex="1" name="title" value="<?= $listing->title ? stripcslashes($listing->title) : htmlentities(stripcslashes($keyword)) ?>" class="form-control input-width BusinessInfo" id="BusinessTradingName" placeholder="Business name customers will know" <?= (!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '" . FRIENDLYURL_VALIDCHARS . "', '" . FRIENDLYURL_SEPARATOR . "');\" " : "" ?> autofocus title="Business name customers will know"> 
                                </div>
                                
                                

                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                
                                <div class="col-md-12">
                                    <label for="LegalBusinessName" class="businesstradingname">Legal Name:<span class="asterik">*</span></label>
                                </div>
                                <div class="col-md-12">
                                  <input type="text" maxlength="128" tabindex="2" name="custom_text0" value="<?= $listing->custom_text0 ? (stripcslashes($listing->custom_text0)) : htmlentities(stripcslashes($keyword)) ?>" class="form-control input-width BusinessInfo" id="LegalBusinessName" placeholder="Official Registered Business Name" title="Official Registered Business Name">  
                                </div>
                                
                                
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                <div class="col-md-12">
                                    <label for="Phone" >Phone:</label>
                                </div>
                                <div class="col-md-12">
                                      <input type="text" maxlength="20" tabindex="3" name="phone" id="phone" value="<?= $listing->phone ?>" class="form-control input-width BusinessInfo" id="phone" placeholder="">
                                </div>
                                
                              
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                <div class="col-md-12">
                                   <label for="Fax" >Fax:</label> 
                                </div>
                                <div class="col-md-12">
                                    <input type="text" maxlength="20" tabindex="4" name="fax" id="fax" value="<?= $listing->fax ?>" class="form-control input-width BusinessInfo" id="fax" placeholder="">
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                <div class="col-md-12">
                                    <label for="URL"  class="URL">URL:</label>
                                </div>
                                <div class="col-md-12">
                                     <input type="text" maxlength="128" tabindex="5" name="url" value="<?= $listing->url ?>" class="form-control input-width BusinessInfo" id="url" placeholder="eg.:http://www.example.com/index.php" > 
                                </div>
                                
                              
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 pushBottom fullWidth">
                            <div class=" textLeft">
                                <div class="col-md-12">
                                     <label for="email" >Email:</label>
                                </div>
                                <div class="col-md-12">
                                     <input type="email" maxlength="128" tabindex="6" name="email" value="<?= ($listing->email) ? $listing->email : $contactObj->email ?>" class="form-control input-width BusinessInfo" id="email" placeholder="">
                                </div>
                              
                               
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel-heading BusinessInfoPage">
                <h1 class="panel-title BusinessTitle">Location</h1>
            </div>
            <div class=" BusinessInfopage">
                <div class="row">
                    <? if ($loadMap) { ?>
                        <table>
                            <tr <?= ($members ? "style=\"display: none\"" : "" ) ?>>
                                <th><?= system_showText(LANG_LABEL_LATITUDE) ?>:</th>
                                <td>
                                    <input type="text" name="latitude" id="latitude" <?= ($loadMap ? "onblur=\"loadMap(document.listing, true);\"" : "") ?> value="<?= $latitude ?>" maxlength="10" />
                                    <span>Ex: 38.830391</span>
                                </td>
                            </tr>

                            <tr <?= ($members ? "style=\"display: none\"" : "" ) ?>>
                                <th><?= system_showText(LANG_LABEL_LONGITUDE) ?>:</th>
                                <td>
                                    <input type="text" name="longitude" id="longitude" <?= ($loadMap ? "onblur=\"loadMap(document.listing, true);\"" : "") ?> value="<?= $longitude ?>" maxlength="10" />
                                    <span>Ex: -77.196370</span>
                                </td>
                            </tr>
                        </table>
                    <? } ?>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">

                                <?php include(EDIRECTORY_ROOT . "/includes/code/load_location_autocomplete.php");
                                ?>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">



                                <div cellpadding="0" cellspacing="0" border="0" class="  standardSIGNUPTable">
                                    <!-- Zip/Postcode -->
                                    <div class="form-group fullWidth" >
                                        <div class="col-md-12">
                                            <label for="zip_code">Zip/Postcode:
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" maxlength="15" tabindex="14" name="zip_code" value="<?= $listing->zip_code ?>" class="location-input form-control  input-widthBL" id="zip_code" placeholder="" >
                                        </div>
                                    </div>


                                    <!-- Street Address -->
                                    <div class="form-group fullWidth">
                                        <div class="col-md-12">
                                            <label for="address" >Street Address:
                                                <?
                                                if ($_GET['id']) {
                                                    if ($listing->custom_checkbox1 == "n") {
                                                        $as_style = "style = 'display : inline-block'";
                                                    } else
                                                        $as_style = "style = 'display : none'";
                                                }
                                                else {
                                                    $as_style = "style = 'display : inline-block'";
                                                }
                                                ?><span class="asterik" <?= $as_style ?>>*</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" maxlength="50" tabindex="15" name="address" value="<?= $listing->address ?>" class="form-control location-input input-widthBL" id="address" onblur="loadMap(document.listing);" placeholder="">
                                        </div>
                                    


                                         </div>



                                    <div class="form-group fullWidth">
                                        <div class="col-md-12">
                                            <label for="location_1">Location of Activities:
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="custom_dropdown3" class="custom_drop3 location-input" tabindex="10" id="LocationActivities" <?= ($listing->status == "A" && !$claimlistingid ? "disabled" : "") ?>>
                                                <option value="Local" <?= ($listing->custom_checkbox0 == "n" ? "selected" : null) ?> >Local</option>
                                                <option value="National" <?= ($listing->custom_checkbox2 == "y" ? "selected" : null) ?>>National</option>
                                                <option value="Global" <?= ($listing->custom_checkbox1 == "y" ? "selected" : null) ?> >Global</option>
                                            </select>
                                            <input type="checkbox" class="hidden " style="display:none;" name="custom_checkbox0" value="y" <?= ($listing->custom_checkbox0 == "y" ? "checked" : null) ?>>
                                            <input type="checkbox" class="hidden " style="display:none;" name="custom_checkbox1" value="y" <?= ($listing->custom_checkbox1 == "y" ? "checked" : null) ?>>
                                            <input type="checkbox" class="hidden" style="display:none;" name="custom_checkbox2" value="y" <?= ($listing->custom_checkbox2 == "y" ? "checked" : null) ?>>
                                        </div>
                                    </div>


                                   

                                </div>




                            </div>
                            <!--                            <div class="col-sm-6">-->

                            <?php
                            if ($loadMap) {

                                include(EDIRECTORY_ROOT . "/includes/code/maptuning_forms.php");
                                ?>
                                <table class="standard-table noMargin" id="tableMapTuning" tabindex="16" <?= ($hasValidCoord ? "" : "style=\"display: none\"" ) ?>>
                                    <tr>
                                        <th colspan="2" class="standard-tabletitle">
                                            <?= system_showText(LANG_LABEL_MAP_TUNING) ?> 
                                            <div id="tipsMap">
                                                <span style="text-align: justify;"><?= system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST) ?></span>
                                                <br />
                                                <span style="text-align: justify;"><?= system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE) ?></span>
                                                <br />
                                                <span style="text-align: justify;"><?= system_showText(LANG_MSG_DRAG_AND_DROP_MARKER) ?></span>
                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
                                            <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?= $latitude_longitude ?>" />
                                            <input type="hidden" name="map_zoom" id="map_zoom" value="<?= $map_zoom ?>" />
                                            <input type="hidden" name="maptuning_done" id="maptuning_done" value="<?= $maptuning_done ?>" />
                                        </td>
                                    </tr>

                                </table>

                            <? } ?>
                            <!--                            </div>-->
                        </div>
                    </div>            
                </div>
            </div> <!-- panel panel-default end-->

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

<div id="smallSpinner" style="vertical-align:sub;position:absolute;left:42%;top:20px;display:none;">
                <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 30px;"></i><br>
            </div>

</div> <!-- container end-->
<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/common.js"></script>

<script type="text/javascript">
                                    var imNotARobot = function() {
                                    console.info("Button was clicked");
                                    document.getElementById('captcha').innerHTML = "";
                                    };</script>

<script>
    $( document ).ready(function() {
        
     $('.panelbody').click(function(){
    $('.panelbody').css('background-color', '#FFF');
    $(this).css('background-color', '#ccc');
    $('input[name=keywords]').val($(this).children('a').text());
    });
<? # Start  Location Scripts               ?>

    $('#location_1').on('change', function(){
    $('#location_3').html('<option selected></option>');
    $('#location_4').html('<option selected></option>');
    $('#stateCheck').val('');
    $('#cityCheck').val('');
    loadMap(document.listing);
    map.setZoom(map.getZoom() - 7);
    $('#zipnotfound').hide();
    $('#stateNotFound').hide();
    $('#cityNotFound').hide();
<? //Empty location1 validation         ?>

    if ($('#location_1').val() == ""){
    $("#stateCheck").prop("readonly", true);
    $("#cityCheck").prop("readonly", true);
    } else {
    $("#stateCheck").prop("readonly", false);
    $("#cityCheck").prop("readonly", true);
    }
    });
    // ---------------------------------------------------------------- //

    function showState(state){
    $('#spinnerState').show();
    $('#cityNotFound').hide();
    if (state != ''){
    $('#cityCheck').val('');
    $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", { ajax_type:"loadState", state: state, loc_1 : $('#location_1').val() }, function(data, status){
    $('#spinnerState').hide();
    if (data.trim() != "null"){
    var obj = JSON.parse(data);
    $('#stateResultDiv').show();
    $('#stateResultUl').empty();
    $.each(obj, function (key, value) {
    var name = value.name;
    var id = value.id;
    $('#stateResultUl').append('<li style="background-color: #fafafa;line-height: 20px;font-size: 14px;">' + name + '<input type="hidden" class="location_3" value="' + id + '"/></li>');
    })

            $('#stateResultUl').on('click', 'li', function(){
    $('#stateCheck').val($(this).text());
    $('#location_3').html('<option value=' + $(this).find('.location_3').val() + ' selected>' + $(this).text() + '<option>');
    $('#location_3').click();
    loadMap(document.listing);
    map.setZoom(map.getZoom() - 9);
    $('#stateResultDiv').hide();
    $('#zipnotfound').hide();
    $('#stateNotFound').hide();
    $("#cityCheck").prop("readonly", false);
    });
    $('#stateCheck').focusout(function(){
    var state_name = $('#stateCheck').val();
    state_name = state_name.charAt(0).toUpperCase() + state_name.slice(1);
    $.each(obj, function (key, value){
    if (state_name == value.name){
    var name_id = value.id;
    $('#stateCheck').val(state_name);
    $('#location_3').html('<option value=' + name_id + ' selected>' + state_name + '<option>');
    $('#location_3').click();
    loadMap(document.listing);
    map.setZoom(map.getZoom() - 9);
    $('#stateResultDiv').hide();
    $('#zipnotfound').hide();
    $('#stateNotFound').hide();
    $("#cityCheck").prop("readonly", false);
    }
    })
    })
    } else {
    $('#stateNotFound').html('State/County not found.');
    $('#stateNotFound').show().fadeOut(3000);
    $('#location_3').click();
    $('#location_3').val('');
    $('#location_4').val('');
    $('#spinnerState').hide();
    $("#cityCheck").val('');
    $('#location_3').html('<option selected></option>');
    $('#location_4').html('<option selected></option>');
    $("#cityCheck").prop("readonly", true);
    }
    });
    $(document).click(function(){
    $('#stateResultDiv').hide();
    });
    } else {
    $('#spinnerState').hide();
    }

    }

    // ---------------------------------------------------------------- //

    function showCity(city){
    $('#spinnerCity').show();
    if (city != ''){
    $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", { ajax_type:"loadCity", city: city, loc_1 : $('#location_1').val(), loc_3:$('#location_3').val() }, function(data, status){
    $('#spinnerCity').hide();
    if (data.trim() != "null"){
    var obj = JSON.parse(data);
    $('#cityResultDiv').show();
    $('#cityResultUl').empty();
    $.each(obj, function (key, value) {
    var name = value.name;
    var id = value.id;
    $('#cityResultUl').append('<li style="background-color: #fafafa;line-height: 20px;font-size: 14px;">' + name + '<input type="hidden" class="location_4" value="' + id + '"/></li>');
    })

            $('#cityResultUl').on('click', 'li', function(){
    $('#cityCheck').val($(this).text());
    $('#location_4').html('<option value=' + $(this).find('.location_4').val() + ' selected>' + $(this).text() + '<option>');
    $('#location_4').click();
    loadMap(document.listing);
    $('#cityResultDiv').hide();
    $('#zipnotfound').hide();
    $('#cityNotFound').hide();
    });
    $('#cityCheck').focusout(function(){
    var city_name = $('#cityCheck').val();
    city_name = city_name.charAt(0).toUpperCase() + city_name.slice(1);
    $.each(obj, function (key, value){
    if (city_name == value.name){
    var c_name_id = value.id;
    $('#cityCheck').val(city_name);
    $('#location_4').html('<option value=' + c_name_id + ' selected>' + city_name + '<option>');
    $('#location_4').click();
    loadMap(document.listing);
    $('#cityResultDiv').hide();
    $('#zipnotfound').hide();
    $('#cityNotFound').hide();
    return false;
    }
    else{$('#cityCheck').val(''); }


    });
    });
    } else {
    $('#cityNotFound').html('City not found.');
    $('#cityNotFound').show().fadeOut(3000);
    $('#location_4').val('');
    $('#spinnerCity').hide();
    }
    });
    $(document).click(function(){
    $('#cityResultDiv').hide();
    });
    } else {
    $('#spinnerCity').hide();
    }
    }

<? # End  Location Scripts                 ?>   
       
});
    
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
    
    
     var website = 'input[name="custom_checkbox0"]';
    var global = 'input[name="custom_checkbox1"]';
    var country = 'input[name="custom_checkbox2"]';
    $('#LocationActivities').on('change', function(){
    if (this.value.trim() == "National" || this.value.trim() == "Global"){
    $(website).prop('checked', true);
    } else {
    $(website).prop('checked', false);
    $(country).prop('checked', false);
    $(global).prop('checked', false);
    }

    if (this.value.trim() == "National"){
    $(country).prop('checked', true);
    $(global).prop('checked', false);
    }

//    if (this.value.trim() == "Global"){
//    $(global).prop('checked', true);
//    $(country).prop('checked', false);
//    $('.Country>.asterik,label[for="StateCounty"]>.asterik,label[for="TownCity"]>.asterik,label[for="address"]>.asterik').hide();
//    } else {
//    $('.Country>.asterik,label[for="StateCounty"]>.asterik,label[for="TownCity"]>.asterik,label[for="address"]>.asterik').show();
//    }

    if (this.value.trim() == "Global"){
    $(global).prop('checked', true);
    $(country).prop('checked', false);
    $('#div_location_1 .asterik,#div_location_3 .asterik,#div_location_4 .asterik,label[for="address"]>.asterik').hide();
    } else {
    $('#div_location_1 .asterik,#div_location_3 .asterik,#div_location_4 .asterik,label[for="address"]>.asterik').show();
    }
    });
    

</script>

