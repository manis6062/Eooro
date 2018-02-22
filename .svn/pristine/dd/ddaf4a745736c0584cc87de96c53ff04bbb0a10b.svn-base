<?
# ----------------------------------------------------------------------------------------------------
# * FILE: /members/listing/review-collector.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../../conf/loadconfig.inc.php");
include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_App.php';

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();
$contact = new Contact($acctId);
$sponsor_firstname = ucfirst($contact->first_name);
$sponsor_lastname = ucfirst($contact->last_name);
$sponsor_email = $contact->email;
$listing_id = mysql_real_escape_string($_GET['id']);

$listingObject = new Listing($_GET['id']);
$listing_stat = $listingObject->status;


# ----------------------------------------------------------------------------------------------------
# Pagination
# ----------------------------------------------------------------------------------------------------

$this_page_no = ($_GET['page'] ? $_GET['page'] : 1 );
$actual_page = $_GET['page'];
$number_of_results_per_page = 10;

$total_entries = App::GetTotalUsers($listing_id);
$paginates = ceil($total_entries / $number_of_results_per_page);

$start_from = ($this_page_no * $number_of_results_per_page) - $number_of_results_per_page;
if ($_GET['sort'] && $_GET['order']) {
    $sort = "fullname";
    $sort_order = $_GET['order'];

    $_GET['sort'] == "fullname" ? $sort = "fullname" : null;
    $_GET['sort'] == "username" ? $sort = "username" : null;
    $_GET['sort'] == "password" ? $sort = "password" : null;
    $_GET['sort'] == "remarks" ? $sort = "is_enable" : null;

    $users_info = App::GetUsersInfoSort($listing_id, $start_from, $number_of_results_per_page, $sort, $sort_order);
} else {
    $users_info = App::GetUsersInfoNoSort($listing_id, $start_from, $number_of_results_per_page);
}


//get rows with id
# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------  

extract($_GET);
extract($_POST);

$_GET['order'] == "ASC" ? $odr = "DESC" : $odr = "ASC";
?>


<!--------------------------------------Update User Form------------------------------------------------------------------>
<?php 
if ($listing_stat != "A") {
   
    include(INCLUDES_DIR . "/views/view_listing_not_activated.php");
    die;
}


?>

<?php
if ($_POST['getrows_id']) {

    $id = $_POST['getrows_id'];
    $edit_info = APP::getRowsWithId($id);
    ?>
    <form method="POST" id ="editForm">
        <input type="hidden" name="ajax_type" value="editForm">
        <input type="hidden" name="id" value="<?= $edit_info['id'] ?>">
        <input type="hidden" name="listing_id" value="<?= $_POST['listing_id'] ?>">


        <div role="tabpanel">
            <div class="panel">
                <div class="panel-heading BusinessInfoPage">
                    <h1 class="panel-title "><i class="fa fa-user" aria-hidden="true"></i> Edit User </h1>
                </div>
                <div role="tabpanel" class="tab-pane" id="editLists">
                    <table class="table table-bordered  reviewCollect table-hover">
                        <thead>
                            <tr>
                                <th class="th-padding">Username</th>
                                <td><input type="text" name="username" id="usernames" maxlength="8" size="25" value="<?= $edit_info['username'] ?>" required></td>
                            </tr>    

                            <tr>
                                <th class="th-padding">User Email</th>
                                <td><input type="text"  name="email" id ="email" size="25" value="<?= $edit_info['email'] ?>" required></td>
                            </tr>  
                        <p id="email_validate_msg"></p>
                        <tr>
                            <th class="th-padding">New Password</th>
                            <td><input type="text" id="password" name="password" maxlength="8" size="25"></td>
                        </tr>
                        <tr>
                            <th class="th-padding">Confirm Password</th>
                            <td><input type="text" id="c_password" maxlength="8" size="25"></td>
                        </tr>
                        <tr>
                            <th class="th-padding">Block User</th>
                            <td>
                                <?php if ($edit_info['is_locked'] == 1) { ?>
                                    <input id = "is_locked" class="reviewCollect" value="0" type="checkbox" onchange="changed('is_locked', '<?= $edit_info['id'] ?>', this.value);" name="is_locked" checked>
                                <?php } else { ?>
                                    <input id = "is_locked" class="reviewCollect" value="1" type="checkbox" onchange="changed('is_locked', '<?= $edit_info['id'] ?>', this.value);" name="is_locked" >
                                <?php } ?>
                            </td>  
                        </tr>
                        <tr>
                            <th class="th-padding">Delete User</th>
                            <td class="th-padding closeItem"><i id="delete" onClick="deleteUser(<?= $edit_info['id'] ?>)" class="fa fa-remove"></i></td>
                        </tr>


                        </tr>
                        </thead>      
                    </table>


                </div>
            </div></div>
    </form>


    <table style="margin: 0 auto 0 auto;  cellspacing:4"  id="button_table">
        <tr>
            <td>

                <button id = "edit_button"class="btn btn-default rtdm" >Submit</button>
                <button id="goBack" class="btn btn-default rtdm" >Cancel</button>
            </td>
        </tr>
    </table>


    <script>

        $('#goBack').click(function (e) {
            $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $_POST['listing_id'] ?>, function () {
            });
        });




        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }


        $(function () {
            $("#email").keyup(function () {
                var email = $("#email").val();
                if (validateEmail(email) == false) {
                    $('#email_validate_msg').html("<div style='color: red;margin-top: -5px; padding-bottom: 3px;'>&nbsp&nbspThe Email Address you entered is not valid.&nbsp&nbsp</div>");
                } else {
                    $('#email_validate_msg').html('');

                }
            });
        });



        function throwMessage(msg) {
            $.fancybox({
                content: '<div class="modal-content">\
                        <h2><span>Error!</span><span>\
                        <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                        <div style="width:240px;" class="sureDelete">\
                        <p id="model-text">' + msg + '</p>\
                        <div style="text-align:center;margin:10px;">\
                        <button id="ok-model-button" onclick="jQuery.fancybox.close();" style="padding:7px 15px;" type="button" class="btn btnOk">Ok</button>\
                        </div></div>\
                    </div>',
                modal: true
            });
        }






        $('#edit_button').click(function (e) {
            var new_password = $('#password').val();
            var confirm_password = $('#c_password').val();
            var username = $('#usernames').val();
            var error = false;
            if (username != '') {
                if (checkUsernameUniqueUpdate(username) == false) {
                    error = true;
                    throwMessage('This username is already taken. Please choose another name.');
                }
                e.preventDefault();
            } else {
                error = true;
            }

            if (new_password != '') {
                if (new_password != confirm_password) {
                    throwMessage('Password does not match. Please try again.');
                    error = true;

                } else if (limitPasswordCharacters(new_password) == false) {
                    throwMessage('Password should  be between 4 and 8 characters');
                    error = true;

                }
                e.preventDefault();
            }

            if (error == false) {
                updateAppUser();
            }


        });



        // Update User Registration

        function checkUsernameUniqueUpdate(username) {
            var return_data = '';
            $.ajax({
                type: "POST",
                async: false,
                url: "listing/app.php",
                data: {unique_username: username, listing_id: '<?= $_POST['listing_id'] ?>', id: '<?= $edit_info['id'] ?>'},
                success: function (data) {
                    return_data = data;
                }
            });
            if (return_data == 0) {
                return true;
            } else {
                return false;
            }
        }


        function updateAppUser() {
            var url = "<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#editForm").serialize(),
                success: function (data)
                {
                    $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $_POST['listing_id'] ?>, function () {
                    });
                }

            });


        }






    </script>



    <?php
    die;
}
?>

<!--------------------------------------Update User Form Ends------------------------------------------------------------------>


<!--------------------------------------Add User Form ------------------------------------------------------------------>

<div id="main_user_add">
    <div role="tabpanel">
        <div class="panel panel-default">
            <div class="panel-heading BusinessInfoPage">
                <h1 class="panel-title "><i class="fa fa-user" aria-hidden="true"></i> Add User </h1>
            </div>
            <div class="panel-body BusinessInfopage">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="row">
                            <table style="margin: 0 auto 0 auto;"   cellspacing="4"  id="add-user-button">
                                <tr>
                                    <td>

                                        <button type="button" id="add-user" class="btten btn-lg btten-info btten-space "><i class="fa fa-user-plus" aria-hidden="true"></i> Click here to add user</button>
                                    </td>
                                </tr>
                            </table>




                            <form name="app" style="display:none" id="app_user" autocomplete="off"  method="post" class="aa">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="addCustomer">
                                        <!-- Start Email Form -->

                                        <table class="table table-bordered table-bordered2 reviewCollect" id="customers-input">

                                            <thead>
                                                <tr>
                                                    <th class="th-padding">Name</th>
                                                    <th class="th-padding">Username</th>
                                                    <th class="th-padding">Password</th>
                                                    <th class="th-padding">Email</th>
                                                    <th class="th-padding">Active</th>
                                                    <th class="th-padding" id="XXX" style="display:none;">X</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>

                                                    <td>
                                                        <input class="form-control reviewCollect" type="text" name="fullname[]" id="full_name" maxlength="255">
                                                    </td>

                                                    <td>
                                                        <input class="form-control reviewCollect" type="text" name="username[]" id="user_name" maxlength="8">
                                                    </td>

                                                    <td>
                                                        <input class="form-control reviewCollect" type="text" name="password[]" id="pass_word" maxlength="8">
                                                    </td>

                                                    <td>
                                                        <input class="form-control reviewCollect" type="text" name="email[]" maxlength="255">
                                                    </td>
                                                    <td>




                                                        <input class=" reviewCollect" type="checkbox" name="is_enable[]" value="Y" checked>

                                                    </td>





                                                </tr>

                                            </tbody>

                                        </table>


                                        <table class="table table-bordered table-bordered2 reviewCollect" id="customers-success" style="display:none;">
                                            <thead>
                                                <tr>
                                                    <th class="th-padding"><p class="text-center ca">Success</p></th>
                                                </tr>
                                            </thead>



                                            <tbody>
                                                <tr>
                                                    <td><p class="text-center ca">Users Added.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <p class="msg">
                                        </p>
                                        <input type="hidden" name="app_addusers" value="1">
                                        <!--Start Submit Buttons -->

                                    </div>
                                </div>
                            </form>


                            <table style="margin: 0 auto 0 auto; display: none;" cellspacing=4 id="button_table">
                                <tr>
                                    <td>


                                        <button id="submitbutton" class="btn btn-default rtdm">Submit</button>
                                        <button id="cancel_button" class="btn btn-default rtdm" >Cancel</button>
                                        <a type="button" class="addnext btn btn-default" style="background-color:#ff004f; color: white; border-color: transparent; margin-top: 10px;"> Add Line</a>
                                        <!--                                                     <button id="backbutton" class="btn btn-default rtdm" style="display:none;">Go to List</button>
                                         --><!--                                                    <button type="button" id="add-more-user" style="display:none;" class="btn btn-default rtdm"><i class="fa fa-user-plus" aria-hidden="true"></i> Add more users</button>-->

                                        <div id="smallSpinner" style="vertical-align:sub;position:absolute;left:58%;top:438px;display:none;">
                                            <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 30px;"></i><br>
                                        </div>
                                    </td>
                                </tr>
                            </table>





                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- panel panel-default end-->




    </div>
</div>

<!--------------------------------------Add User Form Ends ------------------------------------------------------------------>




<!--------------------------------------User Lists ------------------------------------------------------------------>


<div class="reviewCollector">

    <div role="tabpanel" class="tab-pane for_scroll" id="pendingLists">
        <table class="table table-bordered  reviewCollect table-hover">
            <thead>
                <tr>
                    <th class="th-padding">Name</th>
                    <th class="th-padding">Last Login</th>
                    <th class="th-padding">Failure Count</th>
                    <th class="th-padding">Active</th>
                    <th class="th-padding">Settings</th>


                </tr>
            </thead>
            <tbody>
                <? foreach ($users_info as $key => $info) { ?>
                    <tr class="customerdatarow">
                        <td id="name<?= $info['id'] ?>" onblur="changed('fullname', '<?= $info['id'] ?>', this.innerHTML);" contenteditable="true"><?= $info['fullname'] ?></td>
                        <td><?
                            $db_date = $info['last_login_on'];
                            $ts = strtotime($db_date);
                            $actual_date = date('Y-m-d H:i', $ts);

                            if (!empty($info['last_login_on'])) {
                                echo $actual_date;
                            } else {
                                echo '-';
                            }
                            ?></td>
                        <td><?
                            if (!empty($info['faillogin_count'])) {
                                echo $info['faillogin_count'];
                            } else {
                                echo '-';
                            }
                            ?></td>
                        <td>
                            <?php if ($info['is_enable'] == 'Y') { ?>
                                <input class="reviewCollect" type="checkbox" name="is_enable<?php echo $key; ?>" onchange="changed('is_enable', '<?= $info['id'] ?>', this.value);" value="N" checked>
                            <?php } elseif ($info['is_enable'] == 'N') { ?>
                                <input class="reviewCollect" type="checkbox" name="is_enable<?php echo $key; ?>" onchange="changed('is_enable', '<?= $info['id'] ?>', this.value);" value="Y">
                            <?php } ?>

                        </td>

                        <td>
                            <a  style="cursor:pointer;"onClick="openSettingBox(<?php echo $info['id']; ?>)">
                                <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>

                            </a>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>

        <?
        /**
         * @Pagination
         */
        $limit = 10;
        $page_number = $this_page_no;
        $count = $page_number;
        $this_page_no = $page_number;
        $screen = 1;
        $paginates < $limit ? $limit = $paginates : null;

        if ($paginates > 0) {
            ?>    
            <div id="pendingList-pagi" style="text-align: center;">
                <ul class="pagination plPagi">

                    <li>       
                        <a onclick="loadData('1')";>&laquo; Start</a>
                    </li>

                    <li>       
                        <a onclick="loadData(<?= ($this_page_no > 1 ? $this_page_no - 1 : "99999"); ?>);">&laquo; Prev</a>
                    </li>

                    <? for ($i = $page_number - 4; $i <= min($page_number + 9, $paginates); $i++) { ?>

                        <li <?= ($page_number == $i ? 'class="active"' : null) ?>>

                            <? if ($i > 0 && $page_number < 5 && $i <= 10) { ?>
                                <a onclick="loadData(<?= $i ?>);">      
                                    <?= ($i <= 10 ? $i : null) ?>
                                </a>

                            <? } else { ?>

                                <? if ($i > 0 && $i < $page_number + 6) { ?>
                                    <a onclick="loadData(<?= $i ?>);">
                                        <?= $i ?>
                                    </a>
                                <? } ?>

                            <? } ?>

                        </li>
                    <? } ?>

                    <li <?= (($count > $paginates) ? "class='disabled'" : ""); ?>>
                        <a onclick="loadData(<?= (($this_page_no < $paginates) ? $url . ($this_page_no + 1) : "99999"); ?>);">&raquo; Next</a>
                    </li>

                    <li>       
                        <a onclick="loadData('<?= $paginates; ?>')";>&raquo; End</a>
                    </li>

                </ul>
            </div>
        <? } ?>
    </div>





</div> <!-- container reviewcollector -->

<!--------------------------------------User Lists Ends------------------------------------------------------------------>

<div style="margin-bottom:20px;"></div>

<script>
    function loadData(page) {
        if (page != "99999") {
            $('#dashboard').load('listing/app/manage-user.php?id=<?= $id ?>&page=' + page);
        }
    }
</script>


<script>




    $('#app_setting').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/app.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    });

    $('#manage-user').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    });
</script>

<script>

    function deleteUser(id) {
        $.fancybox({
            content: '<div class="modal-content">\
                      <h2><span>Warning!</span><span>\
                      <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                      <div style="width:240px;" class="sureDelete">\
                      <p id="model-text">Are you sure you want to delete this customer ?</p>\
                      <p id="model-text-done" style="display:none;">Success! Customer deleted.</p>\
                      <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                      <div style="text-align:center;margin-top:10px;">\
                      <button id="ok-model-button" onclick="deleteRecord(' + id + ');jQuery.fancybox.close();" style="padding:4px 6px;" type="button" class="btn btnOk">Ok</button>\
                      <button id="cancel-model-button"style="padding:4px 6px;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Cancel</button>\
                      </div></div>\
                  </div>',
            modal: true
        });
    }

    function changePassword(id) {
        $.fancybox({
            content: '<div class="modal-content">\
                      <h2><span>Change Password</span><span>\
                      <a href="javascript:void(0);" onclick="openSettingBox(' + id + ');">Close</a></span></h2>\
                      <div style="width:400px;">\
                      <p id="model-text">Enter New Password</p>\
                       <input id="password" type ="text" name = "password"><br> \
                             <p id="model-text">Confirm Password</p>\
                        <input id="c_password" type ="text" name = "c_password"> \ \n\
                        <p id="model-text-done" style="display:none;">Success! Password has been changed.</p>\
                      <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                      <div style="text-align:center;margin:10px;">\
                      <button id="ok-model-button" onclick="changeUserPassword(' + id + ');" style="padding:5px 15px;" type="button" class="btn btnOk">Ok</button>\
                      </div></div>\
                  </div>',
            modal: true
        });
    }





    function openSettingBox(id) {

        $.ajax({
            type: "POST",
            url: "listing/app/manage-user.php?id=" + id,
            data: {getrows_id: id, listing_id: <?php echo $_GET['id'] ?>},
            success: function (data) {
                $('#pendingLists').html(data);
                $('#main_user_add').hide();
            }
        });
    }

    function changePasswordRetry(id, msg) {
        $.fancybox({
            content: '<div class="modal-content">\
                       <h2><span>Error !</span><span>\
                      <a href="javascript:void(0);" onclick="openSettingBox(' + id + ');">Close</a></span></h2>\
                      <div style="width:400px;">\
                      <span style="color:red">' + msg + '</span>\
                      <p id="model-text">Enter New Password</p>\
                       <input id="password" type ="text" name = "password"><br> \
                             <p id="model-text">Confirm Password</p>\
                        <input id="c_password" type ="text" name = "c_password"> \ \n\
                        <p id="model-text-done"  style="display:none;">Success! Password has been changed.</p>\
                      <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                      <div style="text-align:center;marginp:10px;">\
                      <button id="ok-model-button" onclick="changeUserPassword(' + id + ');" style="padding:7px 15px;" type="button" class="btn btnOk">Ok</button>\
                      </div></div>\
                  </div>',
            modal: true
        });
    }


    function reload_page() {
        $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    }



    function throwMessage(msg) {
        $.fancybox({
            content: '<div class="modal-content">\
                    <h2><span>Error!</span><span>\
                    <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                    <div style="width:240px;" class="sureDelete">\
                    <p id="model-text">' + msg + '</p>\
                    <div style="text-align:center;margin:10px;">\
                    <button id="ok-model-button" onclick="jQuery.fancybox.close();" style="padding:7px 15px;" type="button" class="btn btnOk">Ok</button>\
                    </div></div>\
                </div>',
            modal: true
        });
    }

    function throwMessageAndReturn(id, msg) {
        $.fancybox({
            content: '<div class="modal-content">\
                    <h2><span>Error!</span><span>\
                    <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                    <div style="width:240px;" class="sureDelete">\
                    <p id="model-text">' + msg + '</p>\
                    <div style="text-align:center;margin:10px;">\
                    </div></div>\
                </div>',
            modal: true
        });
    }



    function throwSuccessMessage(msg, id) {
        $.fancybox({
            content: '<div class="modal-content">\
                    <h2><span>Success!</span><span>\
                    </span></h2>\
                    <div style="width:300px;" class="sureDelete">\
                    <p id="model-text">' + msg + '</p>\
                    <div style="text-align:center;margin:10px;">\
                    <button id="ok-model-button" onclick="openSettingBox(' + id + ')" style="padding:7px 15px;" type="button" class="btn btnOk">Ok</button>\
                    </div></div>\
                </div>',
            modal: true
        });
    }



    function limitPasswordCharacters(password) {
        var re = /^([a-zA-Z0-9!@#$%&*_-]){4,8}$/;
        return re.test(password);
    }

    function changed(type, id, text) {
        if (type == 'username') {

            if (text == '') {
                $('#' + type + id).css('border-bottom', '3px solid red');
                throwMessageAndReturn(id, 'Username cannot not be empty.');
                return false;
            }
            if (limitUsernameCharacters(text) == false) {
                $('#' + type + id).css('border-bottom', '3px solid red');
                throwMessageAndReturn(id, 'username should not be exceed from 8 characters.');
                return false;
            }

            if (checkUsernameUnique(text) == false) {
                $('#' + type + id).css('border-bottom', '3px solid red');
                throwMessageAndReturn(id, 'This username is already taken. Please choose another name.');
                return false;

            }
        }

        showspinner();
        $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>",
                {
                    ajax_type: "appChangeData",
                    id: id,
                    changeType: type,
                    newValue: text.trim()
                }
        , function (data) {
            hidespinner();
            if (data.trim().indexOf("success") > -1) {
                $('#' + type + id).css('border-bottom', '0px');
                if (type == 'is_enable') {
                    $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
                        hidespinner();
                    });
                }

            } else {
                $('#' + type + id).css('border-bottom', '3px solid red');
                throwMessage(data);
            }
        });
    }



    $('#backbutton').click(function (e) {
        e.preventDefault();
        $('#app').click();
    });

    $('#cancel_button').click(function (e) {
        $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
        });
    });
    
  
    function deleteRecord(id) {
        showspinner();
        $.post("<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/ajax.php" ?>",
                {
                    ajax_type: "appDeleteData",
                    id: id
                }
        , function (data) {
            hidespinner();
            if (data.trim().indexOf("success") > -1) {
                $('#delete' + id).closest('tr').remove();
                $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
                    hidespinner();
                });
            } else {
                throwMessage("Please try again.");
            }

        });
    }
</script>
<!-- <script src="http://localhost/10300/custom/domain_1/theme/review/js/responsive-paginate.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
    $(".pagination").rPage();
});
    </script> -->
<script>
    $(document).ready(function () {

        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }

        function limitUsernameCharacters(username) {
            var re = /^([a-zA-Z0-9_-]){3,8}$/;
            return re.test(username);
        }

        function limitPasswordCharacters(password) {
            var re = /^([a-zA-Z0-9!@#$%&*_-]){4,8}$/;
            return re.test(password);
        }


// Add App User 

        function checkUsernameUnique(username) {
            var return_data = '';
            $.ajax({
                type: "POST",
                async: false,
                url: "listing/app.php?id=<?= $id ?>",
                data: {unique_username: username, listing_id: '<?= $id ?>'},
                success: function (data) {
                    return_data = data;
                }
            });
            if (return_data == 0) {
                return true;
            } else {
                return false;
            }
        }


        var count = 0;

        $(".addnext").click(function () {
            count = 1;
            if (count <= 10) {
                $('#XXX').css('display', '');
                $('#customers-input').append('<tr><td><input class="form-control reviewCollect" type="text" name="fullname[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="username[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="password[]" maxlength="255"></td> <td><input class="form-control reviewCollect" type="text" name="email[]" maxlength="255"></td> <td><input class="reviewCollect" type="checkbox" name="is_enable[]" value="Y" checked></td> <td class = "removeagain"><a class="removethis removeagain"><i class="fa fa-remove removeNext"></i> </td></tr>');
                count++;

            } else {
                $('#customers-input > p').empty();
                $('.msg').html('<font color="red" style="margin-top:10px;">Sorry, only 10 entries are allowed at a time.</font>');
            }

        });

         $('#customers-input').on('click', '.removethis', function () {
            $(this).parent().parent().remove();
            $('.msg').empty();
            count--;
        });
        
          $('#customers-input').on('click', '.removeagain', function () {
            $(this).parent().remove();
            $('.msg').empty();
            count--;
        });









//           $('.removethis').click( function () {
//           alert('fsdfsdfsdf');
//            $('#customers-input').closest('tr').remove();
//            $('.msg').empty();
//            count--;
//        });

        $("#submitbutton").click(function (e) {
            $("#smallSpinner").show();

            e.preventDefault();
            var datastring = $("#app_user").serialize();


            var allFilled = true;

            $("form#app_user input[type=text]").each(function (index, element) {
                if (element.value === '') {
                    allFilled = false;
                }
            });
            if (allFilled == false) {
                $('.msg').html("<font color='red'>Please fill in all fields.</font>");
                e.preventDefault();
            }

            var proceed = null;
            $("input[name='email[]']").each(function (e) {

                if ($(this).val() == '') {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Email address cannot be empty.</font>");
                    proceed = false;

                } else if (validateEmail($(this).val()) == false) {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Please enter a valid email address.</font>");
                    proceed = false;
                    e.preventDefault();
                } else {
                    proceed = true;
                }

                $(this).click(function () {
                    $(this).css("border", "1px solid #aaa");
                });

            });



            $("form#app_user input[name='username[]']").each(function (e) {
                var username = document.getElementById("user_name").value;
                if (username == '') {
                    $(this).css("border", "2px solid red");
                    throwMessage('Username cannot be empty.');
                    proceed = false;
                    e.preventDefault();
                } else if (checkUsernameUnique(username) == false) {
                    $(this).css("border", "2px solid red");
                    throwMessage('This username is already taken. Please choose another name.');
                    $("#submitbutton").attr('disabled', false);
                    proceed = false;
                    e.preventDefault();

                } else if (limitUsernameCharacters(username) == false) {
                    $(this).css("border", "2px solid red");
                    throwMessage('Username should not be less than 3 characters.');
                    proceed = false;
                    e.preventDefault();
                } else {
                    proceed = true;
                }
                $(this).click(function () {
                    $(this).css("border", "1px solid #aaa");
                });

            });

            $("form#app_user input[name='password[]']").each(function () {
                var password = document.getElementById("pass_word").value;

                if (password == '') {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Password cannot be empty.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                } else if (limitPasswordCharacters(password) == false) {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Password should not be less than 4 characters.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                } else {
                    proceed = true;
                }
                $(this).click(function () {
                    $(this).css("border", "1px solid #aaa");
                });

            });


            $("form#app_user input[name='fullname[]']").each(function () {
                var full_name = document.getElementById("full_name").value;
                if (full_name == '') {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Fullname cannot be empty.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                } else {
                    proceed = true;
                }
                $(this).click(function () {
                    $(this).css("border", "1px solid #aaa");
                });

            });

            if (allFilled == true && proceed == true) {
                $('.msg').hide();

                $.ajax({
                    type: "POST",
                    url: "listing/app.php?id=<?= $id ?>",
                    data: datastring,
                    beforeSend: function () {
                        showspinner();
                    },
                    success: function (data) {
                        hidespinner();
                        $('#customers-input').hide();
                        $('#customers-success').show();
                        $('#submitbutton').hide();
                        $('#backbutton').show();
//                         $('#add-more-user').show();
                        $("#smallSpinner").hide();
                        $("#add-user").hide();
                        throwUserSucessMessage("User Added successfully.");
                        $('#app').click();
                    }
                });
            }

        });

    });
</script>

<script>


    function throwUserSucessMessage(msg) {
        $.fancybox({
            content: '<div class="modal-content">\
                    <h2><span>Success!</span><span>\
                    <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                    <div style="width:240px;" class="sureDelete">\
                    <p id="model-text">' + msg + '</p>\
                    <div style="text-align:center;margin:10px;">\
                    <button id="ok-model-button" onclick="jQuery.fancybox.close();" style="padding:7px 15px;" type="button" class="btn btnOk">Ok</button>\
                    </div></div>\
                </div>',
            modal: true
        });
    }

    $('#manage-user').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/app/manage-user.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    });

    $('#form').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/email_form.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    });


    $("#add-user").click(function () {
        $("#app_user").toggle("slow", function () {
// Animation complete.
        });
        $("#add-user-button").hide();
        $("#pendingLists").hide();
        $("#button_table").show();


    });

</script>