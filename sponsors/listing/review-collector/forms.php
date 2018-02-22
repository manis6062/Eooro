<div class="reviewCollector">
<h2>Review Collector System</h2>   
      <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xNRdPV_aRFI"></iframe>
                </div>
              </div> <!-- col-sm-5 -->
              <div class="col-sm-7">
                <div class="rightContentWrapper">
                    <p><u><strong>Add Customers</strong></u> name and emails below and click submit, this puts them into our review collection system.</p>
                    <p><u><strong>Pending List</strong></u> section displays which customer have yet to review your business</p>
                    <p><u><strong>Collected Reviews</strong></u> shows which customers have reviewed your business.</p>
                    <p><u><strong>Bulk Uploader</strong></u> should be used if you have too many customers to enter manually.</p>
                </div>
              </div> <!-- col-sm-7 -->
            </div> <!-- row -->
          </div> <!-- col-sm-12 -->
      </div>
</div>      
<hr>
<div class="reviewCollector">
    <h2>Overview</h2>
    <!--<p class="customize pull-right">
        <a id="form">Customize email template</a>
    </p>-->
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs reviewCollector-tabs text-center" role="tablist">
            <li class="active col-sm-4 col-xs-12">
                <a id="add-customers" class="bg1">Add Customers</a>
            </li>
            
            <li class="col-sm-4 col-xs-12">
                <a id="pending-list" class="bg1">Pending List</a>
            </li>

            <li class="col-sm-4 col-xs-12">
                <a id='collected-reviews' class="bg1">Collected Reviews</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <form name="reviewcollector" id="reviewcollector" autocomplete="off" action="<?= system_getFormAction($_SERVER["PHP_SELF"] . "?id=" . $listing_id) ?>" method="post" class="aa">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="addCustomer">
                    <!-- Start Email Form -->

                    <table class="table table-bordered table-bordered2 reviewCollect" id="customers-input">

                        <thead>
                            <tr>
                                <th class="th-padding">No</th>
                                <th class="th-padding">Salutation</th>
                                <th class="th-padding">First Name</th>
                                <th class="th-padding">Last Name</th>
                                <th class="th-padding">Email</th>
                                <th class="th-padding">Add/Remove</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="salutation[]" class="form-control reviewCollect" id="salutation">
                                        <option>Mr.</option>
                                        <option>Ms.</option>
                                        <option>Mrs.</option>
                                    </select>
                                </td>

                                <td>
                                    <input class="form-control reviewCollect" type="text" name="firstname[]" maxlength="255">
                                </td>

                                <td>
                                    <input class="form-control reviewCollect" type="text" name="lastname[]" maxlength="255">
                                </td>

                                <td>
                                    <input class="form-control reviewCollect" type="text" name="email[]" maxlength="255">
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
                                <td><p class="text-center ca">Customers Added.</p></td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="msg">
                    </p>
                    <!--Start Submit Buttons -->
                    <table style="margin: 0 auto 0 auto;" cellspacing="4">
                        <tr>
                            <td>

                                <input type="hidden" name="AddUsers" value="1">
                                <button id="submitbutton" class="btn btn-default rtdm">Submit</button>
                                <button id="backbutton" class="btn btn-default rtdm" style="display:none;">Back</button>
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



<script>
    $(document).ready(function () {

        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }

        var count = 2;

        $(".addnext").click(function () {

            if (count <= 10) {
                $('#customers-input').append('<tr><td>' + count + '</td><td><select name="salutation[]" class="form-control reviewCollect" id="salutation"><option>Mr.</option><option>Ms.</option><option>Mrs.</option></select></td><td><input class="form-control reviewCollect" type="text" name="firstname[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="lastname[]" maxlength="255"></td><td><input class="form-control reviewCollect" type="text" name="email[]" maxlength="255"><td><a class="removethis"><i class="fa fa-remove removeNext"></i> Remove</td></tr>');
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
            var datastring = $("#reviewcollector").serialize();

            var allFilled = true;

            $("form#reviewcollector input[type=text]").each(function (index, element) {
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

            if (allFilled == true && proceed == true) {
                $('.msg').hide();
                $.ajax({
                    type: "POST",
                    url: "listing/review-collector.php?id=<?= $id ?>",
                    data: datastring,
                    success: function (data) {
                        $('#customers-input').hide();
                        $('#customers-success').show();
                        $('#submitbutton').hide();
                        $('#backbutton').show();
                        $("#smallSpinner").hide();
                    }
                });
            }

        });

    });
</script>

<script>
    $('#backbutton').click(function (e) {
        e.preventDefault();
        $('#revc').click();
    });

    $('#collected-reviews').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/review-collector/collected-reviews.php?id=' +<?= $id ?>, function () {
            hidespinner();
        });
    });

    $('#pending-list').click(function (e) {
        e.preventDefault();
        showspinner();
        $('#dashboard').load('listing/review-collector/pending-list.php?id=' +<?= $id ?>, function () {
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

</script>

<hr>

<? include ('csv.php') ?>




<?
/*
  <form method="post" id="fileinfo" name="fileinfo" onsubmit="return submitForm();">
  <label>Select a file:</label><br>
  <input type="file" id="fileUpload" name="file" required />
  <input type="submit" value="Upload" />
  </form>
  <div id="output"></div>

  <script type="text/javascript">
  function submitForm() {
  var fd = new FormData(document.getElementById("fileinfo"));
  fd.append("label", "WEBUPLOAD");
  $.ajax({
  url: "<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>",
  type: "POST",
  data: fd,
  enctype: 'multipart/form-data',
  processData: false,
  contentType: false
  }).done(function( data ) {
  //
  });
  return false;
  }
  </script>


 */?>