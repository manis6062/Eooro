<?
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    header("Location:" . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE);
    exit;
}

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
if (MAIL_APP_FEATURE == "on") {
    arcamailer_checkSubscriber();
}

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);


# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
if (sess_getAccountIdFromSession()) {

    $account = new Account(sess_getAccountIdFromSession());
    $contact = new Contact(sess_getAccountIdFromSession());

    //Extract country ID
    if ($contact->country) {
        $countryID = Location1::getIDFromName($contact->country);
        $stateID = Location3::getIDFromNameAndCountryID($contact->state, $countryID);
    }

    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        $account->extract();
        $contact->extract();
    }
} else {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}

$contactObj = new Contact($_SESSION["SESS_ACCOUNT_ID"]);
$contactArray = (array)$contactObj;
$cleaned_contact_array = HtmlCleaner::CleanBasic($contactArray); // outpur filter before display
$contactObj = new Contact($cleaned_contact_array);

$first_name = $contactObj->first_name;
$last_name = $contactObj->last_name;
if ($first_name == NULL || $last_name == NULL) {
    echo "<div class=\"content-custom alert alert-danger\"><strong><font color = \"red\">Please fill your first name & lastname.</font></strong></div>";
}
?> 

<div <?= (EDIR_THEME === 'review') ? '' : ''; ?>>
    <? if (($account->getString("foreignaccount") == "y") && ($account->getString("foreignaccount_done") == "n")) { ?>
        <p class="warningMessage"><?= system_showText(LANG_MSG_FOREIGNACCOUNTWARNING); ?></p>
        <?
    }

    require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
    require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");

    $contentObj = new Content();
    $content = $contentObj->retrieveContentByType("Manage Account");
    if ($content) {
        echo "<div class=\"content-custom\">" . $content . "</div>";
    }

    include(INCLUDES_DIR . "/forms/form_members_messages.php");
    ?>        

    <div class="member-form">

        <form name="account" id="account" method="post">

            <input type="hidden" name="account_id" value="<?= $account_id ?>" />

            <div>

                <? include(INCLUDES_DIR . "/forms/form_account_members.php"); ?>

                <? include(INCLUDES_DIR . "/forms/form_contact_members.php"); ?>

                <div id="form-action">

                    <div class="left "></div>

                    <div class="right">
                        <p class="standardButton">
                            <a id="submit" class="button customStandardButton">Submit</a>
                        </p>
                    </div>

                </div>

                <div id="message" class="alertText"></div>

            </div>

        </form>

    </div>

    <?
    $contentObj = new Content();
    $content = $contentObj->retrieveContentByType("Manage Account Bottom");
    if ($content) {
        echo "<div class=\"content-custom\">" . $content . "</div>";
    }
    ?>

</div>
<script>
    $(function () {
        $(".alert").fadeOut(5000);
    });
</script>

<script>

    $('#submit').click(function () {

    var regexp = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
    var no = $("#phone").val();
    var fax = $("#fax").val();
    if(no || fax) {
        if (no.length>0 && !regexp.test(no)) {
            $('#message').html('');
            $('#message').show();
            $("#message").html("<p class='alert alert-danger'>Invalid Phone Number!!</p>");
            $('#message').delay(3000).hide('fast');
            return false;
        }
        if (fax.length>0 && !regexp.test(fax)) {
            $('#message').html('');
            $('#message').show();
            $("#message").html("<p class='alert alert-danger'>Invalid Fax Number!!</p>");
            $('#message').delay(3000).hide('fast');
            return false;
        }
    }

        var datastring = $("#account").serialize();
        var data = $("#account :input[name!='company'][name!='address2'][name!='phone'][name!='fax'][name!='url'][name!='password'][name!='retype_password']").filter(function (index, element) {
            if ($(element).val() == "") {
                $(element).css('border', "1px solid red");
            } else $(element).css('border', "");
            
            return $(element).val() == "";
        }).serialize();
        if (data == "") {
            $.ajax({
                type: "POST",
                url: "account/account_ajax.php",
                data: datastring,
                success: function (data) {

                    if (data.indexOf("true") > -1) {
                        $('#message').html('');
                        $('#message').show();
                        $("#message").html("<p class='alert alert-success'>Success! Your changes were saved.</p>");
                        $('#message').delay(3000).hide('fast');
                    } else {
                        $('#message').html('');
                        $('#message').show();
                        $("#message").html("<p class='alert alert-danger'>Failed! Fields with * are required.<br> Please try again.</p>");
                        $('#message').delay(3000).hide('fast');
                    }

                }
            });
        } else {
            $('#message').html('');
            $('#message').show();
            $("#message").html("<p class='alert alert-danger'>Failed! Fields with * are required.<br> Please try again.</p>");
            $('#message').delay(3000).hide('fast');
        }

    });

</script>
<? // Show city and State script  ?>
<script>

    $('#loc_1').on('change', function () {
        $('#loc_3,#loc_4').val('');
        var location = $(this).find(':selected').data('location');
        $('#location_1').val(location);
    });

    function showState(state) {
        $('#spinnerState').show();
        $('#cityNotFound').hide();
        if (state != '') {
            $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", {ajax_type: "loadState", state: state, loc_1: $('#location_1').val()}, function (data, status) {
                if (data.trim() != "null") {
                    var obj = JSON.parse(data);
                    $('#stateResultDiv').show();
                    $('#stateResultUl').empty();
                    $('#spinnerState').hide();
                    $.each(obj, function (key, value) {
                        var name = value.name;
                        var id = value.id;
                        $('#stateResultUl').append('<li>' + name + '<input type="hidden" class="location_3" value="' + id + '"/></li>');
                    })
//                    $('#stateResultUl').find("li:odd").addClass("ac_odd");
//                    $('#stateResultUl').find("li:even").addClass("ac_even");

                    $('#stateResultUl').on('click', 'li', function () {
                        $('#loc_3').val($(this).text());
                        $('#location_3').val($(this).find('.location_3').val());
                        $('#loc_4').val('');
                        $('#stateResultDiv').hide();
                        $('#stateNotFound').hide();
                        $("#loc_4").prop("readonly", false);    

                    });
                    
                    $('#loc_3').focusout(function(){
                        var state_name = $('#loc_3').val();
                        state_name = state_name.charAt(0).toUpperCase() + state_name.slice(1);
                        
                        //if(jQuery.inArray(state_name, arr_name) !== -1){
                        $.each(obj, function (key, value){
                            if(state_name == value.name){
                                var name_id = value.id;
                            
                                $('#loc_3').val(state_name);
                                $('#location_3').val(name_id);
                                $('#loc_4').val('');
                                $('#stateResultDiv').hide();
                                $('#stateNotFound').hide();
                                $("#loc_4").prop("readonly", false);
                                return false;
                            }
                            
                        })
                     //}
                    })
                } else {
                    $('#stateNotFound').html('State/County not found.');
                    $('#stateNotFound').show();
                    $('#spinnerState').hide();                    
                    $('#loc_4').attr('readonly', 'readonly');
                }
            });
        } else {
            $('#spinnerState').hide();
        }
    }

    function showCity(city) {
        $('#spinnerCity').show();
        if (city != '') {
            $.post("<?= DEFAULT_URL ?>/sponsors/ajax.php", {ajax_type: "loadCity", city: city, loc_1: $('#location_1').val(), loc_3: $('#location_3').val()}, function (data, status) {
                $('#spinnerCity').hide();
                if (data.trim() != "null") {
                    var obj = JSON.parse(data);
                    $('#cityResultDiv').show();
                    $('#cityResultUl').empty();
                    $.each(obj, function (key, value) {
                        var name = value.name;
                        var id = value.id;
                        $('#cityResultUl').append('<li>' + name + '<input type="hidden" class="location_4" value="' + id + '"/></li>');
                    })
//                    $('#cityResultUl').find("li:odd").addClass("ac_odd");
//                    $('#cityResultUl').find("li:even").addClass("ac_even");

                    $('#cityResultUl').on('click', 'li', function () {
                        $('#loc_4').val($(this).text());
                        $('#cityResultDiv').hide();
                        $('#zipnotfound').hide();
                        $('#cityNotFound').hide();
                    });
                    
                    $('#loc_4').focusout(function(){
                        var city_name = $('#loc_4').val();
                        city_name = city_name.charAt(0).toUpperCase() + city_name.slice(1);
                        
                        //if(jQuery.inArray(state_name, arr_name) !== -1){
                        $.each(obj, function (key, value){
                            if(city_name == value.name){ 
                                
                                $('#loc_4').val(city_name);
                                $('#cityResultDiv').hide();
                                $('#zipnotfound').hide();
                                $('#cityNotFound').hide();
                                return false;
                            }
                            
                            else{$('#loc_4').val('');}
                            
                            
                        });
                    });
                } else {
                    $('#cityNotFound').show();
                    $('#cityNotFound').html('City not found.');
                    $('#spinnerCity').hide();
                }
            });

            $(document).click(function () {
                $('#cityResultDiv').hide();
            });
        } else {
            $('#spinnerCity').hide();
        }
    }

 
</script>