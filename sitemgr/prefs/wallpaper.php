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
	# * FILE: /sitemgr/prefs/theme.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
        $devem = DEMO_DEV_MODE;
        $livem = DEMO_LIVE_MODE;
        $demmm = DEMO_MODE;
        
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	$dbMain = db_getDBObject(DEFAULT_DB, true);
    $main = $dbMain->db_name;
    
    $sql = "SELECT name,abbreviation from {$main}.Location_1";
    $resource = mysql_query($sql);
     while( $row = mysql_fetch_assoc($resource) ){
            $countryname[] = $row;       
        }
 
    $count  = count($countryname); 

    //Uploading Files

	$u = EDIRECTORY_ROOT."/custom/domain_1/theme/".EDIR_THEME."/images/wallpapers/";
	$loc = "/custom/domain_1/theme/".EDIR_THEME."/images/wallpapers/";
	$loc =  str_replace('//', '/', $u);
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - Wallpaper</h1>
				<p>Please upload an image of size 1350 x 500 pixels. </p>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		


				<? include(EDIRECTORY_ROOT."/includes/code/thumbnail_sitemgr.php"); ?>
				
				<br />
                <style>
                .formdiv{
                	float: left;
					width: 350px;
                }

                .imagediv{
                	float: right;
                	width: 350px;
                }
                </style>
				<div class = "formdiv">
						<form action="" name="wallpaper" method="post" enctype="multipart/form-data">
		    			    <p align = "left">1. Select Country </p> <br />
		    			    <?
					        //Available Country Names
					        echo "<select id='sel' name = 'CountrySelect'>";
					        echo '<option value="Select a Country">Select a Country</option>';
					        echo '<option value ="DefaultWallpaper">Default Wallpaper</option>';
					        echo '<option value ="banner">Banner Image</option>';
					        for ($i=0; $i < $count; $i++){
					            echo '<option id ="option" value =' . str_replace(' ', '_', $countryname[$i]['name']) . '>' . $countryname[$i]['name'] . '</option>';
					        } 
					        echo "</select>";
						    ?>
					    
					    <br /> <br />
					    <p align = "left">2. Select Image To Upload </p> <br />
					    <input type="file" name="fileToUpload" id="fileToUpload"> <br /><br />
					    
					    <input type="submit" id="sub" value="Upload Image" name="submit">
						</form>
						 <!-- <input type="file" name="image" id="image" size="1" onchange="UploadImage('account');"/><br /> -->
						<div class = "message" > 
							<? 
								if ($_POST){
									echo "<script>
									var element = document.getElementById('sel');
    								element.value = '" . $_POST['CountrySelect'] . "';
									</script>";
								    
								    $target_dir = $u;
								    
								    // if underscore, replace with space 

								    $country = $_POST['CountrySelect'];
								    if (strpos($_POST['CountrySelect'],'_') !== false) {
								        $country =  str_replace('_', '', $country);
								    }

								    $target_file = $target_dir . $country . "_img.jpg";
								    $uploadOk = 1;
								    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								    
								    // Check if image file is a actual image or fake image
								    if(isset($_POST["submit"])) {
								        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
								        if($check !== false) {
								            // echo "File is an image - " . $check["mime"] . ".";
								            $uploadOk = 1;
								        } else {
								            echo "<font color ='red'>Invalid Operation.</font><br/>";
								            $uploadOk = 0;
								        }
								    }
								    
								    // // Check if file already exists
								    // if (file_exists($target_file)) {
								    //     echo "Sorry, file already exists.";
								    //     $uploadOk = 0;
								    // }

								    // Check file size
								    if ($_FILES["fileToUpload"]["size"] > 15000000) {
								        echo " Sorry, your file is too large. ";
								        $uploadOk = 0;
								    }
								    // Allow certain file formats
								    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								    && $imageFileType != "gif" ) {
								        echo " Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
								        $uploadOk = 0;
								    }
								    // Check if $uploadOk is set to 0 by an error
								    if ($uploadOk == 0) {
								        echo " Sorry, your file was not uploaded. ";
								    // if everything is ok, try to upload file
								    } else {
								        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
								            chmod($target_file, 0777);
								            echo "<font color='green'><br />Success! Image has been updated.</font>";
								              } else {
								            echo "<font color='red'><br />Error!! Image update failed</font>";
								             }
								    }
								}
							?>

						</div>	
				</div>	

				<div class="imagediv">

				<? if (!$_POST) { ?> 
						<p><center>Current Image</center></p>

				<?} else { ?>
						<p><center>New Image</p>						
				<? } ?>			
						 <br />
<? 
if ($_COOKIE['locwall']){
	$_COOKIE['locwall'] = str_replace('_', '', $_COOKIE['locwall']);
	$imagelink = NON_SECURE_URL . '/custom/domain_1/theme/review/images/wallpapers/' . $_COOKIE['locwall'] . '_img.jpg';
	?>
<img id="img" src ="<?=$imagelink?>"  onError="this.src='<?=NON_SECURE_URL?>/custom/domain_1/theme/review/images/wallpapers/noimage.jpg';" style="height:125px;width:325px;border: 1px solid #DCE0E1;"><br><div id="Delete Image"><a href ="?delete=1">Delete Image</a><br />

<? } else {
	$imagelink = NON_SECURE_URL . '/custom/domain_1/theme/review/images/wallpapers/DefaultWallpaper_img.jpg';
	
}

?>



<?
 if(isset($_GET['delete']))
    {
    	$delete = '../../custom/domain_1/theme/review/images/wallpapers/' . $_COOKIE['locwall'] . '_img.jpg';
    	// var_dump(file_exists($delete));
    	
			if (!unlink($delete)) {
				echo ("<font color = 'red'>Error deleting Image</font>");
				unset($_GET);
			}
		
			else {
				echo ("<font color = 'green'>Image has been deleted </font>");
				unset($_GET);
			}

	}
?></div>
<? /*
	<img id="img" <? echo 'src='. NON_SECURE_URL . '/custom/domain_1/theme/review/images/wallpapers/' . $country . '_img.jpg'; ?> style="height:125px;width:325px;border: 1px solid #DCE0E1;">
					
*/ 



	?>		</div>	


					
				

				</div>
							
			</div>	


		</div> <br> <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br><br><br><br>
	<?
					$imagelink = NON_SECURE_URL . '/custom/domain_1/theme/review/images/wallpapers/' . $_COOKIE['locwall'] . '_img.jpg';
					// var_dump($imagelink);	

				?>
				
				

		<div id="bottom-content"></div>

	</div>

	<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//include(SM_EDIRECTORY_ROOT."/layout/footer.php");
	?>
<script>
$(document).ready(function(){	

	$("#sel").change(function(){
		var value  = $( "#sel" ).val();
		if ((value != "Select a Country")){
			console.log($( "#sel" ).val());	

	 	var date = new Date();
		var minutes = 10;
		date.setTime(date.getTime() + (minutes * 60 * 1000));
		$.cookie("locwall", value, { expires: date });
		
		// location.href = "wallpaper.php";

			// $.cookie("locwall", value);
			console.log(window.location.origin+window.location.pathname);
			var loc = window.location.origin+window.location.pathname;
			// console.log(window.location.pathname);
		window.location.replace(loc);
		} else {
			var date = new Date();
			date.setTime(date.getTime() + (-30 * 1000));
			$.cookie('locwall', 'expire', { expires: date });  // expires after -30 second
			var loc = window.location.origin+window.location.pathname;
			window.location.replace(loc);
		}
	});

     if ($.cookie("locwall") != null) {
    		 
		$("#sel").val($.cookie('locwall')); 
     }

});
</script>


<script>
$(document).ready(function(){

	d = new Date();
	$("#img").attr("src", "<?=$imagelink?>?"+d.getTime());

	// $('img').error(function(){
	//         $(this).attr('src', '<?=NON_SECURE_URL?>/custom/domain_1/theme/review/images/wallpapers/noimage.jpg');
	// });
	

});
</script>