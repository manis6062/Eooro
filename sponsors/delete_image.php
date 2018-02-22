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
	# * FILE: /members/delete_image.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$deleteImageSucess = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST["temp"]=='y'){
			$dbObjMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

			$sql = "SELECT thumb_id FROM Gallery_Temp WHERE image_id=".$_POST["gallery_image_id"];
			$row = mysql_fetch_array($dbObj->query($sql));

			$sql = "DELETE FROM Gallery_Temp WHERE image_id=".$_POST["gallery_image_id"];
			$dbObj->query($sql);

			$image = new Image($_POST["gallery_image_id"]);
			$image->Delete();
			$image = new Image($row["thumb_id"]);
			$image->Delete();
		} else{
			if ($_POST["gallery_image_id"]){
				$gallery = new Gallery($_POST["gallery_id"]);
				$gallery->DeleteImage($_POST["gallery_image_id"]);
			} else {

				$item_type=ucfirst($_POST["item_type"]);

				$item = new $item_type($_POST["item_id"]);
				$image_idDel = $item->getNumber("image_id");
				$thumb_idDel = $item->getNumber("thumb_id");

				$image = new Image($image_idDel);
				$image->Delete();
				$image = new Image($thumb_idDel);
				$image->Delete();

				$dbObjMain = db_getDBObject(DEFAULT_DB, true);
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
				$sql = "UPDATE $item_type SET image_id='',thumb_id='' WHERE id=".$_POST["item_id"];
				$dbObj->query($sql);
			}
		}

		$listingObj = new Listing($_POST['item_id']);

		if($listingObj->status == "P"){
			$listingObj = new ListingPending($_POST['item_id']);
		}

		$listingObj->image_id = null;
		$listingObj->thumb_id = null;
		$listingObj->save();

		$return_upload_message= "<p class=\"successMessage\">".LANG_IMAGE_SUCCESSFULLY_DELETED."</p>";
		$deleteImageSucess = "success";
	}	
	
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?> 
		
		<script type="text/javascript">
		<!--
		DEFAULT_URL = "<?=DEFAULT_URL?>";
		-->
		</script>

		<? if ($deleteImageSucess == "success"){?>
			<script language="javascrip" type="text/javascript">
				parent.loadGallery(<?=$_POST["item_id"]?>, 'y', '<?=MEMBERS_ALIAS?>');
				setTimeout(function(){
					parent.$.fancybox.close();
				}, 1500)
			</script>
		<?}?>

        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		
	</head>

	<body>

		<div <?=(THEME_FLAT_FANCYBOX ? "class=\"modal-content modal-content-upload\"" : "style=\"padding:15px;\"")?>>
            
            <? if (THEME_FLAT_FANCYBOX) { ?>
    
                <h2 class="popup-title"><?=system_showText(LANG_DELETE_IMAGE);?>
                    <span>
                        <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                    </span>
                </h2>

            <? } else { ?>
		
                <h2 style="height:auto;"><?=system_showText(LANG_DELETE_IMAGE);?></h2>
            
            <? } ?>
	
	
			<? if ($return_upload_message) { ?>
				<?=$return_upload_message?>
			<? } else { ?>
			<form name="uploadimage" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="frmEmail" enctype="multipart/form-data">
				<p><?=system_showText(LANG_DELETE_IMAGE_CONFIRM);?></p><br />
	
				<input type="hidden" name="gallery_image_id" value="<?=$gallery_image_id?>" />
				<input type="hidden" name="gallery_id" value="<?=$gallery_id?>" />
				<input type="hidden" name="item_id" value="<?=$item_id?>" />
				<input type="hidden" name="item_type" value="<?=$item_type?>" />
				<input type="hidden" name="temp" value="<?=$temp?>" />
				<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
					<tr>
						<td colspan="2" class="formButton">
							<p class="input-button-form standardButton"><button  type="submit" value="">Yes<?//=system_showText(LANG_BUTTON_SUBMIT)?></button>
								<button type="button" value="" onclick="parent.$.fancybox.close();"><?//=system_showText(LANG_BUTTON_SUBMIT)?>No</button>
							</p>
						</td>
					</tr>
				</table>
			</form>
			<? } ?>
			
		</div>
			

	</body>
</html>
