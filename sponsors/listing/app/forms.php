
<div class="reviewCollector">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs reviewCollector-tabs text-center" role="tablist">

            <li class="col-sm-4 col-xs-12">
                <a id="manage-user" class="bg1">Manage User</a>
            </li>

            <li class="col-sm-4 col-xs-12 active">
                <a id='app-setting' class="bg1">App Setting</a>
            </li>


        </ul>

        <br>


        <div class="panel panel-default">
            <div class="panel-heading BusinessInfoPage">
                <h1 class="panel-title BusinessTitle"><i class="fa fa-user" aria-hidden="true"></i> User Setting </h1>
            </div>
            <div class="panel-body BusinessInfopage">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="row">

                            <div class="btn-group btn-space col-sm-offset-4 col-sm-2 btn-group btn-space col-xs-offset-3 col-xs-2">
                                <button type="button" id="add-user" class="btten btn-lg btten-info btten-space "><i class="fa fa-user-plus" aria-hidden="true"></i> Click here to add user</button>
                            </div>   


                            <form name="app" style="display:none" id="app_user" autocomplete="off" action="<?= system_getFormAction($_SERVER["PHP_SELF"] . "?id=" . $listing_id) ?>" method="post" class="aa">
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
                                                    <th class="th-padding">Add/Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>

                                                    <td>
                                                        <input class="form-control reviewCollect" type="text" name="fullname[]" maxlength="255">
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




                                                        <input class="form-control reviewCollect" type="checkbox" name="is_enable[]" value="Y" checked>

                                                    </td>




                                                    <td><i class="fa fa-plus addNext"></i><a class="addnext"> Add Next</a></td>

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
                                        <!--Start Submit Buttons -->
                                        <table style="margin: 0 auto 0 auto;" cellspacing="4">
                                            <tr>
                                                <td>

                                                    <input type="hidden" name="app_addusers" value="1">
                                                    <button id="submitbutton" class="btn btn-default rtdm">Submit</button>
                                                    <button id="backbutton" class="btn btn-default rtdm" style="display:none;">Go to List</button>
<!--                                                    <button type="button" id="add-more-user" style="display:none;" class="btn btn-default rtdm"><i class="fa fa-user-plus" aria-hidden="true"></i> Add more users</button>-->

                                                    <div id="smallSpinner" style="vertical-align:sub;position:absolute;left:58%;top:438px;display:none;">
                                                        <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 30px;"></i><br>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </form>





                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- panel panel-default end-->




    </div>
</div>
<!--
<style>
    
    .btn-space {
    margin-left: 50px;
    display:
}
</style>
-->

<div class="panel panel-default">
    <div class="panel-heading BusinessInfoPage">
        <h1 class="panel-title BusinessTitle"><i class="fa fa-download" aria-hidden="true"></i> Download Application </h1>
    </div>
    <div class="panel-body BusinessInfopage">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12" style="padding-left: 0px;">
                    <section class="col-sm-12 col-md-4 col-xs-12 container-fluid">
                        <div class="col-xs-push-1 col-sm-push-2">
                            <img class="qrimg" src="../images/eooroqr.png" height="100" width="100" alt="QR Code">
                            <button type="button" class="btten btten-info btten-space"><i class="fa fa-apple" aria-hidden="true"></i> Download for Apple</button>

                        </div>
                    </section>       


                    <section class="col-sm-12  col-md-4 col-xs-12 container-fluid">
                        <div class="col-xs-push-1 col-sm-push-2">
                            <img class="qrimg" src="../images/eooroqr.png" height="100" width="100" alt="QR Code">
                            <button type="button" class="btten btten-info btten-space"><i class="fa fa-android" aria-hidden="true"></i> Download for Android</button>  

                        </div>
                    </section>             

                    <section class="col-sm-12  col-md-4 col-xs-12 container-fluid">
                        <div class="col-xs-push-1 col-sm-push-2">
                            <img class="qrimg" src="../images/eooroqr.png" height="100" width="100" alt="QR Code">
                            <button type="button" class="btten btten-info btten-space"><i class="fa fa-windows" aria-hidden="true"></i> Download for Microsoft</button>

                        </div>
                    </section>



                </div>
            </div>
        </div>
    </div>
</div> <!-- panel panel-default end-->



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
        
        
        function checkUsernameUnique(username){
          var return_data = '';
               $.ajax({
                    type: "POST",
                    async: false, 
                    url: "listing/app.php?id=<?= $id ?>",
                    data: { unique_username : username , id : '<?= $id ?>' },
                    success: function (data) {
                       return_data = data;
                    }
                });  
                         if(return_data == 0){
                            return true;
                        }
                        else{
                            return false;
                        }
        }
        
        

        $(".addnext").click(function () {

            if (count <= 10) {
                $('#customers-input').append('<tr><td><input class="form-control reviewCollect" type="text" name="fullname[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="username[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="password[]" maxlength="255"></td> <td><input class="form-control reviewCollect" type="text" name="email[]" maxlength="255"></td> <td><input class="form-control reviewCollect" type="checkbox" name="is_enable[]" value="Y" checked></td> <td><a class="removethis"><i class="fa fa-remove removeNext"></i> Remove</td></tr>');
                count++;
            } else {
                $('#customers-input > p').empty();
                $('.msg').html('<font color="red" style="margin-top:10px;">Sorry, only 10 entries are allowed at a time.</font>');
            }

        });

        $('#customers-input').on("click", ".removethis", function () {
            $(this).closest('tr').remove();
            $('.msg').empty();
            count--;
        })

        $("#submitbutton").click(function (e) {
            $("#submitbutton").attr('disabled', true);
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
            $("input[name='email[]']").each(function () {
                if (validateEmail($(this).val()) == false) {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Please enter a valid email address.</font>");
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
            
            
                $("form#app_user input[name='username[]']").each(function () {
                    var username = document.getElementById("user_name").value;
                if (checkUsernameUnique(username) == false) {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>This username is already taken. Please choose another name.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                } 
                else if(limitUsernameCharacters(username) == false){
                $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Username should not be less than 3 characters.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                }        
                else {
                    proceed = true;
                }
                $(this).click(function () {
                    $(this).css("border", "1px solid #aaa");
                });

                });
                
                       $("form#app_user input[name='password[]']").each(function () {
                    var password = document.getElementById("pass_word").value;
                if (limitPasswordCharacters(password) == false) {
                    $(this).css("border", "2px solid red");
                    $('.msg').html("<font color='red'>Password should not be less than 4 characters.</font>");
                    proceed = false;
                    e.preventDefault();
                    $("#submitbutton").attr('disabled', false);
                    $("#smallSpinner").hide();
                } 
                else {
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
                    }
                });
            }

        });

    });
</script>

<script>
    $('#backbutton').click(function (e) {
        e.preventDefault();
        $('#app').click();
    });

//      $('#add-more-user').click(function () {
//          $('#dashboard').load('listing/app/forms.php?id=' +<?= $id ?>, function () {
//        });
//    });

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
    });

</script>


