<div class="reviewCollector" style="margin-bottom:50px;">

	<h2>Email Template</h2>
	
	<p class="customize pull-right">
		<a id="back-to-reviewcollector">
			Back
		</a>
	</p>

	<form id="emailtemplateform" name="emailtemplate" action="" autocomplete="off" class="aa">
		
		<? if (!$nav_page) { ?>
			
			<div class="emailTemplate col-sm-offset-3 col-sm-6">

				
				<div class="form-group form-inline">
			
					<label for="subject" class="subject">Subject :</label>
					<input class="form-control reviewCollect" id="sub" type="text" name="subject" value="<?=$_POST['subject'] ? $_POST['subject'] : $subject?>" maxlength="255" size="35" placeholder="Enter Subject">
			
				</div>
					
			    <span class="click-here"><b style="cursor:pointer;" onclick='loadfancy();'>Click Here</b> for using variables.</span>
			
			    	<div class="form-group">

						<? if ($body) { ?>

							<textarea class="form-control reviewCollect" id="txt" name="body" rows="6" cols="50"><?=replacefunctionone($body)?></textarea>
						
						<? } else { ?>

							<textarea class="form-control reviewCollect" id="txt" name="body" rows="6" cols="50"><?=replacefunctionone($message)?></textarea>
						
						<? } ?>
						
							<input type="hidden" name="nav_page" value="2">

					</div>
			
				<button id="reset" name="resetEmailToDefault" class="btn btn-default rtdm">Reset to Default</button>
				<button id="preview" name="next" value="Preview Message" class="btn btn-default pm">Preview Message</button>	

				<p id="msg" style="color:red;font-size:12px;display:none;margin-top:10px;"></p>

			</div>

		<? } ?>

		<!-- End Email Form -->
						
		<? if ($nav_page == 2) { 
			
				extract($_POST);
				$subject 	= htmlentities($_POST['subject']);
				$body 		= htmlentities($_POST['body']);

			?>
			<!-- Start Preview Email -->

			<div class="emailTemplate col-sm-offset-3 col-sm-6">

			  <div class="subject-preview">					
				
				<?=$subject?>
				<input type="hidden" name="subject" maxlength="255" size="35" value="<?=$subject?>">
			  
			  </div>

			  	<div class="subject-preview">	
					<? $body = replacefunctiontwo($body);?>
					<?=nl2br($body)?>
					<textarea name="body" style="height:200px; width:400px;display:none;"><?=$body?></textarea>
					<input type="hidden" name="nav_page" value="back">
				
				</div>	

					<? if (!$nav_page) { ?>
						
					<? } elseif($nav_page==2) { ?>
					
						<a><button id="back-previous" name="back" class="btn btn-default rtdm">Back</button></a>
						<input type="hidden" name="save" value="save">
						<a><button id="save" class="btn btn-default rtdm">Save</button></a>

					<? } ?>
			</div>

			<!-- End Preview Email -->

		<? } ?>
	
	</form>

	<?	if( $save && $nav_page != "0" ) {?>

		<div class="emailTemplate col-sm-offset-3 col-sm-5">
	        <div class="alert alert-success">
	          <strong>Well Done!</strong> Email template saved successfully.
	        </div>
			<a href ="review-collector.php?id=<?=$listing_id?>">
				<button id="back-button" type="button" class="btn btn-default rtdm">Back</button>
			</a>	
		</div>

	<? } ?>
</div>
<script>
	function loadfancy(){
		 $.fancybox({
		    'padding':  0,
		    'width'	 :    500,
		    'height' :   500,
		    content  : '<div style=\'height:200px;width:400px;font-size:12px;\'><br>\
		    				<div style=\'margin-left:10px;\'>\
		    					<b><center>Using Varibales</center></b><br><br>\
					    	    	LISTING_LINK : Listing Link <br>\
					    	    	LISTING_NAME : Your Company\'s Name <br>\
					    	    	SPONSOR_FIRST_NAME : Your First Name <br>\
					    	    	SPONSOR_LAST_NAME : Your Last Name <br><br>\
					    	    	All variables are required.\
					    	</div>\
		    	    	</div>'
	    });
	}

	function PostData(datastring){
		showspinner();
		$.ajax({
		    type: "POST",
		    url: "<?=DEFAULT_URL?>/sponsors/listing/email_form.php?id=<?=$id?>",
		    data: datastring,
		    success: function(data) {
			    $('#dashboard').empty();
				$('#dashboard').append(data);
				hidespinner();         
		    }
		});

	}
</script>
<script>

	$('#back-previous').click(function(e){
		e.preventDefault();
		document.emailtemplate.nav_page.value = 0;
		var datastring = $("#emailtemplateform").serialize();	
		PostData(datastring);
	});

	var x = '<?=$mss?>';
	var z = '<?=$msb?>';

	$( "#reset" ).click(function() {
  		$('#sub').empty();
		$('#txt').empty();
		$('#txt').val(z);
		$('#sub').val(x);
		return false;
	});
</script>

<script>

	$('#back-button, #back-to-reviewcollector').click(function(e){
	  e.preventDefault();
	  	showspinner();
		$('#dashboard').load('listing/review-collector.php?id='+<?=$id?>, function() {
        	hidespinner();
    	});
	});

	$('#preview').click(function(e){
		e.preventDefault();
		var body = $('#txt').val();
			$('#msg').empty();
			if( body.indexOf('LISTING_LINK') == -1 <? // || body.indexOf('SPONSOR_FIRST_NAME') == -1 || body.indexOf('SPONSOR_LAST_NAME') == -1 || body.indexOf('LISTING_NAME') == -1 ?>){
				$('#msg').show();
				$('#msg').html('All variables are required.');
				loadfancy();
				e.preventDefault();
			} else {
				var datastring = $("#emailtemplateform").serialize();	
				PostData(datastring);
			}
	});

	$('#save').click(function(e){
		e.preventDefault();
		var datastring = $("#emailtemplateform").serialize();
		PostData(datastring);
	});
</script>
