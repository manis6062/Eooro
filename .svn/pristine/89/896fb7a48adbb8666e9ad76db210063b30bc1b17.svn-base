<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/socialnetwork/edit_account.php
	# ----------------------------------------------------------------------------------------------------

?>

	<form name="account" id="account" method="post" class="reviewerEditACcount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
        
		<input type="hidden" name="tab" id="tab" value="<?=$tab ? $tab: "tab_1";?>" />
		<input type="hidden" name="account_id" value="<?=$account_id?>" />

		<?
        $accountID = sess_getAccountIdFromSession();
        ?>
		<div id="cont_tab_1" style="<?=($tab == 'tab_1' || !$tab) ? '' : 'display:none'?>">
            
			<? include(INCLUDES_DIR."/forms/form_profile.php"); ?>
			
			<div id="msg" class="alertText"></div>

			<div class="btAdd">
				<p class="standardButton">
					<button id="sub" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button id="back" style="display:none;">Back</button>
				</p>
			</div>
		</div>

		<div id="cont_tab_2" style="<?=($tab == 'tab_2') ? '' : 'display:none'?>">
			
			<? include(INCLUDES_DIR."/forms/form_account_members.php"); ?>
			<? include(INCLUDES_DIR."/forms/form_contact_members.php"); ?>

			<div class="btAdd">
				<p class="standardButton">
					<button id="modal" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="reset" onclick="redirect('<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			</div>
            
		</div>

		<script>

			$('#sub').click(function(e){
				e.preventDefault();			
				function testempty(value){
					var z = 1;
					  if ($('#'+value).val().trim() == '' ){
					    $('#'+value).css('border','2px solid red').css('border-radius','5px');
					    $('#msg').html('Fields with * are required.');
					    var z = 0;
					  }
					return z;
				}

			var total  = testempty("nn") + testempty("friendly_url");
				if (total < 2){ 
					return false;
				} else {

					var datastring = $("#account").serialize();
					$.ajax({
				    type: "POST",
				    url: "edit.php",
				    data: datastring,
				    success: function(data) {
						if( data.indexOf("true") > -1 ){
							$('#msg').html('');
							$('#msg').show();
							$("#msg").html("<p class='alert alert-success'>Success! Your Changes Were Saved.</p>");	
							$('#msg').delay(3000).hide('fast');
							$('#sub').hide();
							$('#back').show();
						} else {
							$("#msg").html("<p class='alert alert-danger'>Failed! Oops something is not right.</p>");
						}
		   		}
			});

				}
			});

		    $("form#account :input").each(function(){
		        $(this).click(function(e){
		          $(this).css('border','1px solid #aaa').css('border-radius','5px');;
		        });    
		    });

		    $('#back').click(function(e){
		    	e.preventDefault();
		    	$('#overview').click();
		    });

			

    </script>               
	</form>