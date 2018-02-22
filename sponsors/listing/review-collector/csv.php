<style>
    
</style>

<div class="reviewCollector"><h2 style="margin:0;">Bulk Uploader</h2></div>

<ul class="tabs-steps">
    
    <li id="step1" class="active">
        <a>
            Step 1: Import Type
        </a>
    </li>

    <li id="step2">
        <a>
            Step 2: Download CSV                                                            
        </a>
    </li>

    <li id="step3">
      <a>
        Step 3: File Select                        
      </a>  
    </li>

    <li id="step4" class="bd-0" style="pointer-events: none;">
        <a>
          Step 4: Preview / Import 
        </a>
    </li>

</ul>

<!-- Tab 1 -->

<div class="stepContent  active" id="content1">
  <h2>Import Type & Notes </h2>
  <!--<button>Business</button>-->
  <div class="box-wrapper">
    <p id ="null">
        Please bear the following in mind when performing an import:<br/>
        1. Please download csv file and add your data to it. If format is not matched it will be rejected.<br/>
        2. We perform basic email validation and will reject any non formatted email.<br/>
        3. Too many rejection can lead to file being rejected, so please check and upload correct format with correct data.<br/>
        4. Any email already in pending section will not be imported.<br/>
        5. Size and or number of record can be uploaded. Maximum file upload size is 2MB.
        
    </p>
  </div>
  <button class="btn btn-default rtdm next" id="next1" style="float:right;">Continue</button>
</div>


<!-- Tab 2 -->

<div class="stepContent" id="content2">
  <h2>Download Sample CSV File</h2>
      <!--<button>Business</button>-->
  <div class="box-wrapper">
      Do you have questions about the import? <a href="<?=NON_SECURE_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>.php">Click here.</a><br/>
      <a href="<?=NON_SECURE_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/review-collector/csvSample.php"><input type="button" id= "downloadCsv" value="Download CSV File Template" class="buttonCSV"></a>
  </div>
  <button class="btn btn-default rtdm next" id="next2" style="float:right;">Continue</button>
</div>
<!-- Tab 4 -->
<div class="stepContent" id="content3">
  <h3>File Upload</h3>
  <form method="post" id="fileinfo" name="fileinfo" style="overflow:hidden;" onsubmit="return submitForm();">
    <div class="box-wrapper">
      
          <label>Select a file:</label><br>
          <input type="file" id="fileUpload" name="file" />
  </div>
<div id="output"></div>
<button class="btn btn-default rtdm next_upload" id="next3" type="submit" style="float:right;" >Upload and Verify</button>
</form>
</div>
<!-- Tab 5 -->
<div class="stepContent" id="content4">
<h3>Preview/Import</h3>
  <div class="box-wrapper">
  <div id="preview_msg"></div>
   <table class="table table-striped" id="previewEntries">
      <tr>
        <td><strong>Salutation</strong></td>
        <td><strong>Firstname</strong></td>
        <td><strong>Lastname</strong></td>
        <td><strong>Email</strong></td>
      </tr>
   </table>
        <button id="ok-upload" style="display:none;" class="btn btn-default rtdm">Import</button>
        <p class="">
  </div>
</div>
<div class="alertText" id="csvMessage"></div>
<script>

  $('.tabs-steps>li').click(function(){ 
    $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"></div>');
      $('.tabs-steps>li').removeClass('active');
      $(this).addClass('active');
      var parameter = $(this).prop("id");

      var screen = parameter.replace("step","");

      $('.stepContent').removeClass('active');
      $('#content'+screen).addClass('active');

  });
//click action for button next 
  $('.next').click(function(){
    $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"></div>');
    $('.tabs-steps>li').removeClass('active');
    var parameter = $(this).prop("id");

    var screen = parameter.replace("next","");
    
    var screen2 = parseInt(screen) + 1;
   
    $('#step'+screen2).addClass('active');
    $('.stepContent').removeClass('active');
    $('#content'+screen2).addClass('active');

  })
</script>
<script type="text/javascript">
    function submitForm() {
      if($("#fileUpload").val()){
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
            var parsed  = JSON.parse(data);
            var msg     = parsed.message;
            var entries = parsed.entries;
            var msg1;
            var msg2 = parsed.message1;
            var invalidData = parsed.invalidData;

            $('#ok-upload').hide();
         
            if(entries){
                $('#previewEntries').replaceWith('<table class="table table-striped" id="previewEntries"><tr><td><strong>Salutation</strong></td><td><strong>Firstname</strong></td><td><strong>Lastname</strong></td><td><strong>Email</strong></td></tr></table>');
                
                $('#step4').click();
              $('#ok-upload').show();
              
              for (index = 0; index < entries.length; ++index) {
                var single = entries[index].split(' || ');
                $("#fileUpload").val('');

                $('#previewEntries').append('<tr id="entries"><td>'+single[0]+'</td><td>'+single[1]+'</td><td>'+single[2]+'</td><td>'+single[3]+'</td></tr>');
              }
              
              if(invalidData){
                  var invalid;
                  $('#previewEntries').append('<tr><td style="color:red; padding-left:30px">Following data are removed because: <br/>'+msg2+'</td><td></td><td></td><td></td></tr>');
                  for(j = 0; j < invalidData.length; ++j){
                      invalid = invalidData[j].split(' || ');
                    $('#previewEntries').append('<tr id="invalid"><td>'+invalid[0]+'</td><td>'+invalid[1]+'</td><td>'+invalid[2]+'</td><td>'+invalid[3]+'</td></tr>');
                    }
                }
              
              $('#ok-upload').unbind('click').click(function(){
                    $.ajax({
                      url: "<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>",
                      type: "POST",
                      data: {status : parsed.status, verified : 'true' }
                    }).done(function( data ) {
                        var parsed  = JSON.parse(data);
                        var duplicates = parsed.duplicate;
                        var unique = parsed.unique;
                        var dbDub = parsed.dbDub;
                        
                        if(unique){ 
                            $('#previewEntries').replaceWith('<table class="table table-striped" id="previewEntries"><tr><td><strong>Salutation</strong></td><td><strong>Firstname</strong></td><td><strong>Lastname</strong></td><td><strong>Email</strong></td></tr></table>');
                            for (i = 0; i < unique.length; ++i) {
                                var uni = unique[i].split(' || ');
                                //$("#fileUpload").val('');

                                $('#previewEntries').append('<tr><td>'+uni[0]+'</td><td>'+uni[1]+'</td><td>'+uni[2]+'</td><td>'+uni[3]+'</td></tr>');
                              }
                            
                        }
                        else{
                            $('#previewEntries').replaceWith('<table class="table table-striped" id="previewEntries"><tr><td><strong>Salutation</strong></td><td><strong>Firstname</strong></td><td><strong>Lastname</strong></td><td><strong>Email</strong></td></tr><tr><td>There are no unique data.</td><td></td><td></td><td></td></tr></table>');
                        }
                        
                        if(dbDub){
                        
                            $('#previewEntries').append('<tr><td style="color:red">Following data are removed because emails are already exist in database.</td><td></td><td></td><td></td></tr>');
                            for (i = 0; i < dbDub.length; ++i) {
                                var dbDuplicate = dbDub[i].split(' || ');
                                //$("#fileUpload").val('');

                                $('#previewEntries').append('<tr><td>'+dbDuplicate[0]+'</td><td>'+dbDuplicate[1]+'</td><td>'+dbDuplicate[2]+'</td><td>'+dbDuplicate[3]+'</td></tr>');
                              }
                        }
                        
                        if(duplicates){ 
                            $('#previewEntries').append('<tr><td style="color:red">Following data are removed due to duplicate data.</td><td></td><td></td><td></td></tr>');
                            for (i = 0; i < duplicates.length; ++i) {
                                var dup = duplicates[i].split(' || ');
                                //$("#fileUpload").val('');

                                $('#previewEntries').append('<tr><td>'+dup[0]+'</td><td>'+dup[1]+'</td><td>'+dup[2]+'</td><td>'+dup[3]+'</td></tr>');
                              }
                          }
              
                        $('#ok-upload').hide();
                         msg1 = parsed.message;
                        $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"><p class="alert alert-success">'+msg1+'</p></div>');
                    });
                    
                    
              });
              
              $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"><p class="alert alert-success">'+msg+'</p></div>');
   
            }
            else if(entries == null && invalidData){ 
                
                $('#step4').click();
              //$('#ok-upload').show();
              
                var invalid;
                $('#previewEntries').replaceWith('<table class="table table-striped" id="previewEntries"><tr><td><strong>Salutation</strong></td><td><strong>Firstname</strong></td><td><strong>Lastname</strong></td><td><strong>Email</strong></td></tr><tr><td>Following data are removed because:</td><td></td><td></td><td></td></tr></table>');
                  $('#previewEntries').append('<tr><td style="color:red; padding-left:30px">Following data are removed because: <br/>'+msg2+'</td><td></td><td></td><td></td></tr>');
                  for(j = 0; j < invalidData.length; ++j){
                      invalid = invalidData[j].split(' || ');
                    $('#previewEntries').append('<tr id="invalid"><td>'+invalid[0]+'</td><td>'+invalid[1]+'</td><td>'+invalid[2]+'</td><td>'+invalid[3]+'</td></tr>');
                    }

              $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"><p class="alert alert-danger">'+msg+'</p></div>');
            }
            else{
                $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"><p class="alert alert-danger">'+msg+'</p></div>');
            }
            
        });
      }
      else{
        $('#csvMessage').replaceWith('<div class="alertText" id="csvMessage"><p class="alert alert-danger">Please select a csv file to upload.</p></div>');
      }
      return false;
    }
</script>