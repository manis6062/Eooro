<?
	include("../../../conf/loadconfig.inc.php");
	include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_ReviewCollector.php';
	require_once EDIRECTORY_ROOT."/custom/domain_1/theme/review/review.php";

	# ------------------------------------------------------------------------------

	sess_validateSession();
	$acctId 			= sess_getAccountIdFromSession();
	$listing_id 		= mysql_real_escape_string($_GET['id']);

	# ------------------------------------------------------------------------------
?>
<section class="login" style="height: 500px;">
	
	<h1>Welcome to create campaign</h1>

<!-- Date Picker -->
<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
<?if(!$_POST['navigate'] && !$actual_page_no) {?>

	<form method="post" action="" autocomplete="off">


	Campaign Name : <input type="text" name="campaign_name" />
		
		<br><br>
		<td> Campaign Start Date: <input type="text" name="start_date" id="start_date" value="" class="input-form-discountcode" style="width:100px" maxlength="10" /></td>
		<br><br>
		<td> Campaign End Date:   <input type="text" name="expire_date" id="expire_date" value="" class="input-form-discountcode" style="width:100px" maxlength="10" /></td>
		<br><br>
		<br><br>

		<input type="hidden" name="navigate" value="2">		

		<button type="submit" class="btn btn-default btn-lg ctl">Next</button>

	</form>

<script type="text/javascript">
	$(document).ready(function() {
		//DATE PICKER
		<?
		if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
		elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
		?>

		$('#start_date').datepicker({
			showOn: 'both',
	   		buttonImage: '<?=DEFAULT_URL."/custom/domain_1/theme/review/images/calender.png"?>',
	   		buttonImageOnly: true,
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true,
            yearRange: '<?=date("Y")?>:<?=date("Y")+10?>',
            minDate: 0
		});

		$('#expire_date').datepicker({
			showOn: 'both',
	   		buttonImage: '<?=DEFAULT_URL."/custom/domain_1/theme/review/images/calender.png"?>',
	   		buttonImageOnly: true,
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true,
            yearRange: '<?=date("Y")?>:<?=date("Y")+10?>',
            minDate: 0
		});
    });
</script>
<?}?>

<!--End Date Picker -->









<? if($_POST['navigate'] == "2" || $actual_page_no) {

	$number_of_reviews = ReviewCollector::GetTotalRequestedReviews($acctId, $listing_id);

	//Pagination
	$actual_page_no = $_GET['page'];
	$_GET['page'] = $_GET['page'] ? $_GET['page'] : 1;
	$page_number = $_GET['page'];
	$number_of_results_per_page = 5;

	$page_number = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;
	$number_of_pages   = ceil($number_of_reviews / $number_of_results_per_page);	
	$requested_reviews = ReviewCollector::GetRequestedReviewsList($acctId,$listing_id,$page_number,$number_of_results_per_page);
		
		?>
<!-- Table and Pagination -->

<h2 style="color:#000;">Select customers to invite</h2>

<form name="selectusers" id="selectusers" method="post" action="">

	<input type="hidden" name="campaign_name" value="<?=$_POST['campaign_name']?>" />
	<input type="hidden" name="start_date" value="<?=$_POST['start_date']?>" />
	<input type="hidden" name="expire_date" value="<?=$_POST['expire_date']?>" />



<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td></td>
		<td><strong>#</strong></td>										
		<td><strong>Salutation</strong></td>
		<td><strong>Firstname</strong></td>
		<td><strong>Lastname</strong></td>
		<td><strong>Email</strong></td>						
	</tr>

<? 
function searchArray($position){

	if(in_array($position, $_POST['select'])){
		echo "checked";
	}
}
?>

	<? foreach ($requested_reviews as $key => $review){ ?>
		<tr>
			<td><input type="checkbox" name="select[]" value="<?=$review['id']?>" <?searchArray($review['id'])?>></td>
			<td><?=($key+1)+($number_of_results_per_page * ($_GET['page'] - 1))?></td>
			<td><?=$review['salutation']?></td>
			<td><?=$review['firstname']?></td>
			<td><?=$review['lastname']?></td>
			<td><?=$review['email']?></td>
		</tr>
	<? } ?>
</table>

<div class="paginate_records" align="center">
	<?for($i = 1; $i <= $number_of_pages; $i++){?>
		<a><?=(($_GET['page'] == $i) ? "<strong><u>" : "" )?><box id="page-<?=$i?>" onclick="scanclick(<?=$i?>)"><?=$i?></box><?=(($_GET['page'] == $i) ? "</u></strong>" : "" )?></a>
	<?}?>
</div>

<?foreach ($_POST['select'] as $key => $value) { ?>
	<input type="hidden" name="select[]" value="<?=$value?>">
<? }?>
		<br><br>
		<? if(($_GET['page'] + 1) <= $number_of_pages){?>
			<button type="submit" class="btn btn-default btn-lg ctl" onclick='this.form.action="campaign.php?id=<?=$listing_id?>&page=<?=$_GET['page']+1?>";'>Add More</button>
		<? } ?>
		<br><br>
		<input id="navigate" type="hidden" name="navigate" value="2">
		<a class="btn btn-default btn-lg ctl" id="back">Back</a>
		<button type="submit" class="btn btn-default btn-lg ctl" onclick="demopage()">Next</button>
</form>
<script>
function demopage() {
		document.selectusers.navigate.value = 3;
		document.selectusers.action="campaign.php?id=<?=$listing_id?>";
		document.selectusers.submit();
	}
$("#back").click(function(){
    	$("#navigate").remove();
    	document.selectusers.submit();
});


function scanclick(num){

	if ( num != <?=$_GET['page']?>){
	   	document.selectusers.action="campaign.php?id=<?=$listing_id?>&page="+num;
	   	document.selectusers.submit();
	}
}

</script>
<? } ?>






<!-- Email Sample -->
<? if($_POST['navigate'] == "3"){

	$contact 			= new Contact($acctId);
	$sponsor_firstname 	= ucfirst($contact->first_name);
	$sponsor_lastname 	= ucfirst($contact->last_name);
	$sponsor_email		= $contact->email;
	

	$company = new Listing($listing_id);
	$friendly_url = $company->friendly_url . ".html?request_id=".$acctId;
	$review_url_extracted = DEFAULT_URL. "/" .ALIAS_LISTING_MODULE. "/" .$friendly_url;
	$review_url = "<br><a href  = " . $review_url_extracted . " target = _blank >" . $review_url_extracted . "</a>";

	$template 		   = ReviewCollector::ExtractUserTemplate($acctId, $listing_id);

	if(!$template){
		$template_extract = ReviewCollector::getDefaultEmailTemplate();
		foreach ($template_extract as $temp) {
			$template[] = $temp['value'];
		}
		$template['subject'] = $template[0];
		$template['body'] 	 = $template[1];
		unset($template[0],$template[1]);
	}
		
		?>

<link rel="stylesheet" href="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/css/jquery.mCustomScrollbar.css" />
<script src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<div id ="content" >
	<div style="height: 100px;overflow:hidden;" class="mCustomScrollbar" data-mcs-theme="dark">
		<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">
			<tr>
				<td><strong>#</strong></td>										
				<td><strong>Salutation</strong></td>
				<td><strong>Firstname</strong></td>
				<td><strong>Lastname</strong></td>
				<td><strong>Email</strong></td>						
			</tr>
			<? foreach (array_unique($_POST['select']) as $key => $id){ 
				$info = ReviewCollector::GetCustomerDetailsByID($acctId, $listing_id, $id);
				?>
				<tr>
					<td><?=($key+1)?></td>
					<td><?=$info['salutation']?></td>
					<td><?=$info['firstname']?></td>
					<td><?=$info['lastname']?></td>
					<td><?=$info['email']?></td>
				</tr>
			<? } ?>
		</table>
	</div>

	<h2 style="color:#000;">Email Sample</h2>

	<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">						
			<tr>
				<td>
					<div class="label-form">
						Subject: 
					</div>
				</td>
				<td>
					<?=$template['subject']?>
				</td>
			</tr>
						
			<tr>
				<td>
					<div class="label-form">
						Body: 
					</div>
				</td>
				<td>
					<?//$template['body'] = str_replace("FIRSTNAME", $requested_reviews[0]['firstname'], $template['body'])?>
					<?$template['body'] = str_replace("LISTING_LINK", $review_url, $template['body'])?>
					<?$template['body'] = str_replace("SPONSOR_FIRST_NAME", $sponsor_firstname, $template['body'])?>
					<?$template['body'] = str_replace("SPONSOR_LAST_NAME", $sponsor_lastname, $template['body'])?>

					<?=$template['body']?>

				</td>
			</tr>
	</table>
	<form name="thirdpage" method="post" action="">

	<input type="hidden" name="campaign_name" value="<?=$_POST['campaign_name']?>" />
	<input type="hidden" name="start_date" 	  value="<?=$_POST['start_date']?>" />
	<input type="hidden" name="expire_date"   value="<?=$_POST['expire_date']?>" />
	
		<?foreach ($_POST['select'] as $key => $value) { ?>
			<input type="hidden" name="select[]" value="<?=$value?>">
		<? }?>
		<input id="navigate" type="hidden" name="navigate" value="4">
		

		<a class="btn btn-default btn-lg ctl" id="back">Back</a>


		<button id="sub" type="submit" class="btn btn-default btn-lg ctl">Submit</button>
	</form>
</div>
<div id="spinner" align="center" style="display:none;">
 <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:100px;font-size:100pt;"></i><br/>
 <h2 style="color:#000;"> Please Wait...</h2>
</div>
<script>
    (function($){
        $(window).load(function(){
            $(".content").mCustomScrollbar();
        });
    })(jQuery);

    $("#sub").click(function(){
    	$("#content").hide();
	    $("#spinner").show();
    });

$("#back").click(function(){
    	$("#navigate").val(2);
    	document.thirdpage.submit();
    });

</script>
<? } ?>





<? if ($_POST['navigate'] == "4"){

$flash_error    = "<center><br><br><i class='fa fa-frown-o' style='font-size: 250px;'></i><br><br>Something's not right.</center>";
$flash_error   .= "<a href='" . $_SERVER['PHP_SELF'] . "?id=". $listing_id . "''><button class='btn btn-default btn-lg ctl'>Try again</button>";
$flash_success  = "<center><br><br><i class='fa fa-smile-o' style='font-size: 250px;'></i><br><br>Done.</center>";
$flash_success .= "<button id='done' class='btn btn-default btn-lg ctl' onclick='parent.$.fancybox.close();'>Ok</button>";

	if(!$_POST['campaign_name'] || !$_POST['start_date'] || !$_POST['expire_date'] ) {
		echo $flash_error;
		die();
	}

	/**
	 * Check if select ids belongs to this user
	 * Check if any limit is set and find out
	 * if the user has tampered with any of
	 * our form data. In that case we
	 * will throw error.
	 */
if ($_POST['select']){

	//Get limit value from settings and see if limit has been exceeded

	//If tampered and duplicate value is put, this will get rid of it
	if (count($_POST['select']) !== count(array_unique($_POST['select']))){
		echo $flash_error;
		die();
	}

	//If tried to put other customers this will throw error.
	foreach($_POST['select'] as $id){

		$check_if_belongs_to_user = ReviewCollector::CheckIfBelongsToUser($id, $acctId, $listing_id);

		if($check_if_belongs_to_user == 0){
			echo $flash_error;
			die();
		}

		$ids .= $id . " | ";

	}

	//If Good, Update the campaign table

	$ids = rtrim($ids, " | ");
		
		$campaign_name = escape_bad_things($_POST['campaign_name']);
		$campaign_name = escape_bad_things2($_POST['campaign_name']);
		$start_date    = escape_bad_things($_POST['start_date']);
		$start_date    = escape_bad_things2($_POST['start_date']);
		$end_date 	   = escape_bad_things($_POST['expire_date']);
		$end_date 	   = escape_bad_things2($_POST['expire_date']);

		
		$start_date = date('Y-m-d', strtotime(str_replace('-', '/', $start_date)));
		$end_date   = date('Y-m-d', strtotime(str_replace('-', '/', $end_date)));

		$result = ReviewCollector::CreateCampaign($acctId, $listing_id, $campaign_name, $ids, $template['subject'], $template['body'], $start_date, $end_date);

		if($result == true){
				echo $flash_success;
		} else {
			echo $flash_error;
			die();	
		}


} else {
		echo $flash_error;
		die();
}

	?>




<?}?>


</section>
<script>
$("#done").click(function(){
	// setTimeout("location.href = window.parent.location.reload(false);",1);
});
</script>