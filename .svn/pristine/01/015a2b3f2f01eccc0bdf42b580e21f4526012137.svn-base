<?
	
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /members/listing/email_form.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_ReviewCollector.php';
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$contact = new Contact($acctId);
	$sponsor_firstname 	= ucfirst($contact->first_name);
	$sponsor_lastname 	= ucfirst($contact->last_name);
	$sponsor_email		= $contact->email;
	$listing_id = mysql_real_escape_string($_GET['id']);
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$company 	  = new Listing($listing_id);
	$listing_name = $company->title;
	$owner_id     = $company->account_id;

		if($acctId != $owner_id){
		  header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
          exit;
		}

	$template 		  = ReviewCollector::ExtractUserTemplate($acctId, $listing_id);
	$default_template = ReviewCollector::getDefaultEmailTemplate();

	if(!$template){
		$template['subject'] = $default_template['subject'];
		$template['body'] 	 = $default_template['body'];
	}

	$message 	  = str_replace("<br>","\n",$template['body']);
	$subject 	  = $template['subject'];
	$friendly_url = $company->friendly_url . ".html?reviewcollector=true";
	$review_url_extracted = DEFAULT_URL. "/" .ALIAS_LISTING_MODULE. "/" .$friendly_url;
	$review_url   = "<br><a href  = " . $review_url_extracted . " target = _blank >" . $review_url_extracted . "</a>";

	$msb = str_replace("<br>", "\\r", $default_template['body']); 
    $mss = $default_template['subject'];

	function replacefunctionone($body){
		
		global $sponsor_firstname, $sponsor_lastname, $listing_name,$review_url,$firstname;

		$body = str_replace($firstname, "FIRSTNAME",  $body);
		$body = str_replace($review_url, "LISTING_LINK",  $body);
		$body = str_replace("<br>", "\r\n", $body);
		$body = str_replace($review_url, "LISTING_LINK", $body);
		$body = str_replace($firstname, "FIRSTNAME",  $body);
		$body = str_replace($review_url, "LISTING_LINK", $body);
		$body = str_replace($listing_name, "LISTING_NAME", $body);
		$body = str_replace($sponsor_firstname, "SPONSOR_FIRST_NAME", $body);
		$body = str_replace($sponsor_lastname, "SPONSOR_LAST_NAME", $body);

		return $body;
	}


	function replacefunctiontwo($body){
		
		global $review_url, $body, $listing_name, $sponsor_firstname, $sponsor_lastname;

		$body = str_replace("LISTING_LINK", $review_url, $body);
		$body = str_replace("\r\n", "<br>", $body);
		$body = str_replace("LISTING_NAME", $listing_name, $body);
		$body = str_replace("SPONSOR_FIRST_NAME", $sponsor_firstname, $body);
		$body = str_replace("SPONSOR_LAST_NAME", $sponsor_lastname, $body);

		return $body;

	}

		if($_POST['save']){
			
			$subject 	 	= htmlentities($_POST['subject']);
			$body		 	= htmlentities($_POST['body']);
			$subject 	 	= mysql_real_escape_string($_POST['subject']);
			$body		 	= mysql_real_escape_string($_POST['body']);
			
			$body = replacefunctionone($body);
			ReviewCollector::SaveEmailTemplate($acctId, $listing_id, $subject, $body);
		}

?>
<?
	include_once('review-collector/email_template_form.php');
?>