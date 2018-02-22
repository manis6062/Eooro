<style>
	.wrapper1{   
    background-color: #F5F5F5;
    border: 1px solid #DDDDDD;
    border-radius: 4px 0 4px 0;
    color: #3B3C3E;
    font-size: 12px;
    font-weight: bold;
    left: -1px;
    padding: 10px 7px 5px;
}
</style>
<? 
include("../conf/loadconfig.inc.php");


$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();
$info = socialnetwork_retrieveInfoProfile($_SESSION["SESS_ACCOUNT_ID"]);


	function get_local_time($current_time){
	    $time        = strtotime($current_time.' UTC');
	    $dateInLocal = date("jS M Y", $time);
	    return $dateInLocal;
	}

    function getNameFromId($uid){
    	global $info;
    	$info = socialnetwork_retrieveInfoProfile($uid);
    	return $info["first_name"]." ".$info["last_name"];
    }

    function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }



$rid        = mysql_real_escape_string($_POST["rid"]);
$cid        = mysql_real_escape_string($_POST["case-id"]);
$owner_id   = mysql_real_escape_string($_POST["owner-id"]);
$member_id  = mysql_real_escape_string($_POST["member-id"]);

$sql1 = "SELECT case_status FROM Opened_Cases WHERE case_id='$cid'";
$resource1 = $dbDomain->query( $sql1 );
$case_status = mysql_fetch_array($resource1);
			
			
			$sql = "SELECT  m.id,m.case_id,c.owner_id,l.title,r.review_title,from_user,to_user,message,date, m.delivery_status FROM Opened_Cases c "
			        . "INNER JOIN Review r ON c.review_id=r.id "
			        . "INNER JOIN Listing l ON l.id=r.item_id "
			        . "INNER JOIN Case_Messages m ON c.case_id=m.case_id "
			        . "WHERE c.review_id={$rid}";
			//var_dump($sql);
			$resource = $dbDomain->query( $sql );
			$all_results = array();        
			//$result = mysql_fetch_array($resource);

			while ($result = mysql_fetch_array($resource)){
			       		$all_results[] = $result;
					}
					
      //var_dump($all_results);   
			$looptimes  =  count($all_results);
			for($k = 0 ; $k < $looptimes; $k++){
			$review_title = $all_results[$k]["review_title"];
			$title = $all_results[$k]["title"]; } ?>

	
                <div class="modal-content"> 
                    <h2 class="casemsg">
                        <span> "<?=$title?>: <?=$review_title?>"</span>
                        <span>
                            <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                        </span>
                    </h2>   
                  <div class="media-wrapper col-xs-12 text-left">
                                                  

  
                    <div class="wrapper1">
                     <!-- <div class="commentjuction">
                                                                  <i class="fa fa-comments size"></i>
                                                                    <span class="view-comment ">View more comment</span>
                                                                    <span class="view-comment-number hidden">3 of 15</span>
                                                               </div> -->
                                        <div class="wrapper2">
                                          <?    
                                                for($z = 0 ; $z < $looptimes; $z++){ 
                                                    //var_dump($all_results);

                                                    $ctime = $all_results[$z]['date']; 
                                                    $time = strtotime($ctime.' UTC'); 
                                                    $dateInLocal = date("Y-m-d H:i:s", $time); 
                                                    $elapsed_time = time_elapsed_string($dateInLocal); //var_dump($elapsed_time); 
                                                    
                                                    $mesg = $all_results[$z]['message']; //var_dump($mesg);
                                                    $user_id = $all_results[$z]['from_user']; //var_dump($user_id);
                                                    $user_name = getNameFromId($user_id); //var_dump($user_name); 
                                                    $owner_id = $all_results[$z]["owner_id"]; 

                                                    //var_dump($info["image_id"]);
                                                    $mainImage = $info["image_id"];
                                                    $imgObj = new Image($info["image_id"]);
                                                    $type = $imgObj->type;
                                                    if($type=="0"){$type = "PNG";}else {$type=$type;}
                                                    //else{$type = $type; }
                                                    //var_dump($imgObj);
                                                        if ($mainImage) {
                                                            // if ($image["image_default"] == "y") { //store the main image to use on meta tag og:image
                                                                // var_dump("expression");
                                                                $mainImage = DEFAULT_URL."/custom/profile/".$user_id."_photo_".$info["image_id"].".".string_strtolower($type);
                                                                // var_dump($mainImage);
                                                            // }
                                                        }
                                                    if (!$mainImage) { //if there is no main image, use a random image
                                                      $mainImage = DEFAULT_URL."/images/profile_noimage.png";
                                                    }

                                                    //var_dump($mainImage);

                                                    //var_dump($image);
                                          ?>
                                                  <div id="owner_id" class="hidden"><?=$all_results[$i]["owner_id"];?></div>
                                                  <div id="sess_id" class="hidden"><?=$_SESSION["SESS_ACCOUNT_ID"];?></div>
                                                  <div id="case_id_<?=$z;?>" class="hidden"><?=$cid;?></div>

                                          <?        if ( $all_results [$z] ['from_user'] != $account_id){ ?>
                                                               <div class="media custom-margin clearfix">

                                                              <div class="media-left pull-left medialeft-padding">
                                                                  <a href="#">
                                                                      <!-- <div class="media-object img-circle" src='<?//=DEFAULT_URL?>/images/profile_noimage.png' alt="img1" width="65" height="65"> -->
                                                                      <!-- </div> -->
                                                                      <div id="circle"></div>
                                                                    </a>
                                                              </div>
                                                                
                                                              <div class="media-body mediabody-tooltip pull-left">
                                                                  <div class="chattool-tip"></div>
                                                                    <h4 class="media-heading text-color"><?=$user_name;?></h4> <time datetime="2015-02-14 20:00"><?=$elapsed_time;?></time>
                                                                      <p class="chat-para"><?=$mesg;?></p>
                                                                        
                                                              </div>
                                                                
                                                               </div>
                                                <? } else {?>
                                                        <div class="media clearfix custom-margin">
                                                              
                                                              <div class="media-left pull-right medialeft-padding right">
                                                                  <a href="#"> <?//\"".DEFAULT_URL."/images/profile_noimage.png\"?>
                                                                      <!-- <div class="media-object img-circle" src='<?//=DEFAULT_URL?>/images/profile_noimage.png' alt="img1" width="65" height="65">
                                                                      </div> -->
                                                                      <div id="circle1"></div> 
                                                                    </a>
                                                                </div>
                                                                
                                                              
                                                                <div class="media-body mediabody-tooltip text-right right-tooltip pull-right">
                                                                  <div class="chattool-tip right"></div>
                                                                    <time datetime="2015-02-14 20:00"><?=$elapsed_time;?></time>
                                                                    <h4 class="media-heading text-color"><?=$user_name;?></h4> 
                                                                      <p class="chat-para"><?=$mesg;?></p>
                                                                        
                                                                </div>
                                                                
                                                               </div>
                                                <? } ?>  
                                                <? $array [] .= $z;?>
                                                  
                                          <? } ?> 
                                          <div class="media custom-margin clearfix" id="left"></div>
                                          <div class="media clearfix custom-margin" id="right"></div> 

                                          </div>
                                          <? if ($case_status["case_status"] == "A") { ?>
                                                            <form id="msg-reply-form<?=$i?>">
                                                               <textarea id="msg-reply<?=$i?>" class="msg-reply" placeholder="Type in your reply in no more than 2000 characters" style="width:100%;color:#000;" maxlength="2000" maxlength="2000"></textarea>
                                                            </form>
                                                      <? }
                                                       ?>
                                          </div>          
                                        </div> <!--wrapper--> 
                                      </div> <!--modal-content-->   


<script>
	jQuery(document).ready(function(){       
        var $t = $('.wrapper2');
        $t.animate({"scrollTop": $('.wrapper2')[0].scrollHeight}, "slow");
});
</script>

<? $loop = count($array);
for ($t = 0; $t < $loop ; $t++):  ?>
<script>
	$(document).ready(function(){
    var sess_id = $('#sess_id').text();
    var user = $('#owner_id').text();
    $(document).keypress(function(e) {

      $('#msg-reply').on("input", function() {
        var cid = $('#case_id_<?=$t;?>').text();
          var dInput = this.value;
            if(e.which == 13) {
                  
                var output = dInput.replace(/<script[^>]*?>.*?<\/script>/gi, '').
                 replace(/<[\/\!]*?[^<>]*?>/gi, '').
                 replace(/<style[^>]*?>.*?<\/style>/gi, '').
                 replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');
                var dInput = output;
                 
                if (dInput !== '\n') {

                  if(sess_id == user){
                    $("#left").append("<div class='media custom-margin clearfix'><div class='media-left pull-left medialeft-padding'><a href='#'><div id='circle'></div></a></div><div class='media-body mediabody-tooltip pull-left'><div class='chattool-tip'></div><h4 class='media-heading text-color'><?=getNameFromId($account_id)?></h4><time datetime='2015-02-14 20:00'><?=time_elapsed_string(date('Y-m-d H:i:s'))?></time><p class='chat-para'>"+dInput+"</p></div></div>");
                  }else{
                    $("#right").append("<div class='media custom-margin clearfix'><div class='media-left pull-right medialeft-padding right'><a href='#'><div id='circle1'></div></a></div><div class='media-body mediabody-tooltip text-right right-tooltip pull-right'><div class='chattool-tip right'></div><time datetime='2015-02-14 20:00'><?=time_elapsed_string(date('Y-m-d H:i:s'))?></time><h4 class='media-heading text-color'><?=getNameFromId($account_id)?></h4><p class='chat-para'>"+dInput+"</p></div></div>");
                                     }
                
                }

                 var reply = dInput;
                 $('#msg-reply').val('');
                 e.which = '';


              if (reply !== '\n') {

                $.ajax({
                        method: "POST",
                        url: "ajax.php",
                        data: {
                                "ajax_type"     : 'review_message',
                                "msg"           : reply,
                                "owner_id"      : "<?=$owner_id;?>",
                                "member_id"     : "<?=$member_id;?>",
                                "cid"           : cid
                      },
                      	success: function( response ){
                          
                      	var $t = $('.wrapper2');
              			    $t.animate({"scrollTop": $('.wrapper2')[0].scrollHeight}, "slow");	
                      }
                  })

                  .done(function( msg ) {
                });
              }

            }
      });
    });
});
</script>
<?php endfor; ?>
