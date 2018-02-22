<? 
include("../conf/loadconfig.inc.php");
$dbMain = db_getDBObject(DEFAULT_DB, true); 
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain); 

   $item_id       = $array[2];
   $id            = $array[0]; 
   $item_type     = $array[1];
   $review_title  = $array[6]; 
   $review        = $array[7]; 
   $rating        = $array[11]; 

  
?>

<div class="modal-content">
    <h2>
        Edit your review
        <span >
            <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
        </span>
    </h2>
    
</div>
<section class ="login">  
    <div class="container">
    <div id="Rate" align="center">
      <p id = "rate">Rate it!</p><br>

<script>
$(document).ready(function () {
//for setting the rate value on stars on page load.
      var rat = $("#rate_form").val();
      if(rat == 1) { 
                     $('#1star').css('background-color', '#F00000');
                     $('#2star,#3star,#4star,#5star').css('background-color', '');
                     $('#rate').empty();
                     $('#rate').append("<font color = #F00000 >Bad! </font><br />");
                   }
      else if(rat == 2) {
                         $('#2star,#1star').css('background-color', '#FF9900');
                         $('#3star,#4star,#5star').css('background-color', '');
                         $('#rate').empty();
                         $('#rate').append("<font color = #FF9900 >Not Good! </font><br />");  
                        }
      else if(rat == 3) {
                         $('#3star,#2star,#1star').css('background-color', '#FF9900');
                         $('#4star,#5star').css('background-color', '');
                         $('#rate').empty();
                         $('#rate').append("<font color = #FF9900 >Average! </font><br />"); 
                        }
      else if(rat == 4) {
                         $('#4star,#3star,#2star,#1star').css('background-color', '#6ea840');
                         $('#5star').css('background-color', '');
                         $('#rate').empty();
                         $('#rate').append("<font color = #6ea840 >Good! </font><br />");
                        }
      else if(rat == 5) { 
                         $('#5star,#4star,#3star,#2star,#1star').css('background-color', '#6ea840');
                         $('#rate').empty();
                         $('#rate').append("<font color = #6ea840 >Excellent! </font><br />");
                        }
        
      
      });

</script>

<script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/ratestar.js"></script>
          
<script type="text/javascript" language="javascript">
  function resetRatingLevel() {
      setDisplayRatingLevel(document.rate_form.rating.value);
  }
  
  function setRatingLevel(level) {
      document.rate_form.rating.value = level;
  }
</script>
        
        <div id="hidden" class="resstartwrapper startwrapper" style="margin-bottom:20px"> 
             <div class="starwrapper white starwrapper1" id="1star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="2star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="3star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="4star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="5star"><i class="fa fa-star"></i></div>
        </div>
    </div>
    <form name="rate_form" onsubmit="return false;" id="1form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form" role="form">
        <input type="hidden" name="id" id="id" value="<?=$id?>" />
        <input type="hidden" name="rating" id="rate_form" value="<?if($_POST){echo $_POST["rating"]; } else {echo $rating;}?>" />
	<input type="hidden" id="member_id" name="member_id" value="<?=$_COOKIE["uid"]?>" />
	<div class="row">
            <div class="col-sm-4">
                <div class="form-group formimage reviewmbtm ssssssssss" style="margin-bottom:23px">
                <p class="msg" style="color: #F00;font-size: 15px; margin-top: -12px; margin-bottom:-20px; text-align: center;"></p>
                    <input type="text" name="review_title" 
                           class="form-control loginform reviewinput reviewplacehld" 
                           id="review_title" style="margin-bottom: -15px;margin-top: 25px;"
                           placeholder="Review Title" 
                           value="<?

                           if($_POST){
                            echo $_POST["review_title"];
                           } else {
                            echo $review_title;
                           }
                           ?>" 
                           maxlength="20" 
                           tabindex="1" required>

                </div> 
                <div class="form-group">
                    <textarea class="form-control" 
                              name="review" 
                              id="review" 
                              rows="12" 
                              tabindex="5" 
                              placeholder="Write Your Review Here"><?
                               if($_POST){
                                echo $_POST["review"];
                               } else {
                                echo $review;
                               }
                              ?></textarea>
                </div>
            </div>
            </div>
	<div class="action" align="center">
            <div class="row btnwrapper5 col-sm-4">
                <input type="submit" 
                        name="submit" 
                        value="Update" 
                        id="submitReview" 
                        class="btn btn-default btn-lg reviewsendbtn">
            </div>
        </div>
        
    </form>  <div id="result"></div>     
    </div>
    <p id="message" align="center" style="color:red;">

    </p>
</section>
<div id="spinner" align="center" style="display:none;margin-left:225px;position:absolute;">
   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
   <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>

<div id="edit-complete" style="display:none;text-align:center;color:#000;">
  <h3 style="margin:150px 0px;">Your Review was successfully edited.</h3>
  <p class="standardButton claimButton listingButton">
    <button onclick="parent.$.fancybox.close();">Close</button>
  </p>
</div>


<?


if($_POST)    
{  
    $id           = mysql_real_escape_string($_POST["id"]); 
    $member_id    = mysql_real_escape_string($_POST["member_id"]); 
    $rating       = mysql_real_escape_string($_POST["rating"]); 
    $review       = mysql_real_escape_string($_POST["review"]); 
    $review_title = mysql_real_escape_string($_POST["review_title"]); 
    $added        = date("Y-m-d H:i:s"); 
    $review_title = htmlentities($review_title);
    $review       = htmlentities($review);
    //Update average review column

    $sql = "update {$dbDomain->db_name}.Review set added='$added', rating='$rating', review_title='$review_title', review='$review' where id='$id'";
    $resource = $dbDomain->query( $sql );

    $average = Review::getRateAvgByItem('listing',$array['item_id'], "count");
    $set     = Listing::setAvgReview($average['rate'], $array['item_id'], $average['review_count']);
}

?>
<script>
$(document).ready(function () {

	$( "#submitReview" ).click(function(event) {

  //Stop the form submission
  event.preventDefault();

  $( "#spinner" ).show();
  $( ".login" ).hide();
  
  //Get Ready for AJAX
  var id = $( "#id" ).val();
  var ratings = $( "#rate_form" ).val();
  var review_title = $( "#review_title" ).val();
  var review = $( "#review" ).val();

    function color (id, value, message){
        if (value == "" ){
         $('#'+id).css("border", "3px solid red");
         $('#message').html("<p id='ms"+id+"' style='margin-bottom:-3px;'>"+message+"</p>");
        } else {
          $('#'+id).css("border", "1px solid grey");
          $('#ms'+id).empty();
        }
    }

    function removeColor (id){
          $('#'+id).css("border", "1px solid #DCDCDC");
          $('#message').empty();
    }

    $( "#review,#review_title" ).click(function(event) {
        removeColor("review");
        removeColor("review_title");
    });


  function flashEmpty(id, value, fieldname){
    if( value == "" ){
        $( "#spinner" ).hide();
        $( ".login" ).show();
      var ms = "Please enter the "+fieldname;
      color(id, value, ms);
      return false;
    }
    return true;
  }

    var z = flashEmpty("review", review, "review.");
    var x = flashEmpty("review_title", review_title, "title.");

    if ( z == true && x == true){
      //AJAX
      $.ajax({
          method: "POST",
          data: { id : id,
                  rating : ratings,
                  review_title : review_title,
                  review : review }
        })
          .done(function( msg ) {
            $( "#spinner" ).show();
            $('.login').hide();
            //Please wait show
            $('#reviews',parent.document).click();

                $(document).ajaxStop(function () {
                    $( "#spinner" ).hide();
                    $('#edit-complete').show();
                });
        });       
    }
    
 }); 
});
</script>