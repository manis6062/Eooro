<? 
include("../conf/loadconfig.inc.php");

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();


//Extracting Terms and Conditions from Database

$sql = "SELECT * FROM Setting_Case WHERE name = 'reviewer_t_and_c' And is_enabled = 1 order by updated_date";
$resource = $dbDomain->query( $sql );
$terms = mysql_fetch_array($resource);

$rid = $_POST["review-id"];
$sql1 = "SELECT * FROM Review WHERE id = '$rid' AND status = 'A'";
$resource1 = $dbDomain->query( $sql1 );
$rev = mysql_fetch_array($resource1);

$rev_title = $rev["review_title"];


?>
<section id="close-case-body">
<div class="modal-content">
<h2>
        <span> Close case for "<?=$rev_title?>"</span>
        <span>
            <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
        </span>
    </h2>
<h3 class="terms">Terms and Conditions</h3>
<div id="case-agreement" class="agreement">
    <p>
       <?= $terms['long_description'] ?>
    </p>
</div>
<p class="pull-left">
        <input id="agree-checkbox" type="checkbox" value="<?=$_POST['case-id']?>" name="agree" style="margin-left: 5px;">
        I accept the Agreement
    </p>
    <p class="pull-right">    
        <button id="close-button" type="button" class="btn btn-success closedCase">Close Case</button> 
    </p>
</div>
</section>
<div id="spinner-case" align="center" style="display:none;margin-left:225px;position:absolute;">
   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
   <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>

<div id="edit-complete" class="login" style="display:none;text-align:center;color:#000;">
  <h3 style="margin:150px 0px;">Case closed successfully.</h3>
  <p class="standardButton claimButton listingButton">
    <button onclick="parent.$.fancybox.close();">Close</button>
  </p>
</div>

<script>
    var checkBox    = document.getElementById( 'agree-checkbox' );
    var closeButton = document.getElementById( 'close-button' );
    closeButton.disabled = true;

    checkBox.onchange = function(){
        if ( this.checked ) {
            closeButton.disabled = false;
        }
        else{
            closeButton.disabled = true;
        }
    };
    
    $( '#close-button' ).on( 'click',function(){
        $('#close-case-body').hide();
        $('#spinner-case').show();
            var details = <?=json_encode($_POST);?>; 
            
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: {
                    "ajax_type" : 'close_case', 
                    "details"   : details 
                },
                success: function( response ){
                    
                    $('#body', parent.document).load('cases.php', function(){
                            $('#spinner-case').hide();
                            $('#edit-complete').show();
                        });
                }
            });

    });
</script>