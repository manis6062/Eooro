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
	# * FILE: /includes/forms/form_crop.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    if ($_GET["sitemgrLang"]) {
        $loadSitemgrLangs = true;
    }
	include("../../conf/loadconfig.inc.php");

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	
	extract($_GET); 

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	</head>
	<body>
		<div id="cropper">
		<script type="text/javascript">
			function setCrop(op, sulfix) {
				if (op == 0) {
                    if ($('#w'+sulfix).val() == 0 || $('#h'+sulfix).val() == 0) {
                        alert("<?=system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN);?>");
                        document.getElementById("image"+sulfix).value = "";
                        document.getElementById("image_type"+sulfix).value = "";
                        parent.$.fancybox.close();
                      } else {
                      	<? if(string_strpos($_SERVER["HTTP_REFERER"], SOCIALNETWORK_FEATURE_NAME)) {?>
                      	$('#cropper').hide();
                      	$('#crop-spinner').show();
                      	jQuery('#sub').click();
                      	var loaded = null;
                      	$(document).ajaxStop(function () {
                      		if(loaded) return false;
		                   	$('#body',parent.document).load('edit.php',function(){
	                      		$('#crop-spinner').hide();
				                parent.$.fancybox.close();
				            });
				            loaded = true;
						});
                      	<? } else { ?>
                        parent.$.fancybox.close();
                        jQuery('#modal').click();
                        <? } ?>
                    }
				} else if (op == 1) {
                    document.getElementById("image"+sulfix).value = "";
                    document.getElementById("image_type"+sulfix).value = "";
                    parent.$.fancybox.close();
				}
			}
		</script>
		<div id="loadingBar" align="center">
			<img src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif"/>
		</div>

		<div align="center">
			<p class="errorMessage" id="noImageSpan<?=$multi?>" style="display:none; height: auto; overflow: hidden" >
				<span id="errorType" style="display:none">
					<?=system_showText(LANG_MSG_INVALID_IMAGE_TYPE)?>
				</span>
				<span id="errorSize" style="display:none">
					<?
					$sizeMessage = "";
					$sizeMessage .= system_showText(LANG_MSG_IMAGE_FILE_TOO_LARGE)." ";
					$sizeMessage .= system_showText(LANG_MSG_MAX_FILE_SIZE)." ".UPLOAD_MAX_SIZE." MB.";
					echo $sizeMessage;
					?>
				</span>
				<br />
				<?=system_showText(LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE)?>
			</p>
		</div>

		<div id="crop" style="display:none" align="center">
			<img id="imgUpload<?=$multi?>" style="display:none"/>
		</div>
		<? if (string_strpos($_SERVER["HTTP_REFERER"], SITEMGR_ALIAS)){ ?>
		<div id="cropButtons" align="center">
			<input type="button" id="ButtonCropSubmit" style="display:none" value="<?=system_showText(LANG_BUTTON_SUBMIT)?>" onClick="setCrop(0, '<?=$multi?>');" class="input-button-form">
			<input type="button" value="<?=system_showText(LANG_BUTTON_CANCEL)?>" onClick="setCrop(1, '<?=$multi?>');" class="input-button-form">
		</div>
		<? } elseif(string_strpos($_SERVER["HTTP_REFERER"], SOCIALNETWORK_FEATURE_NAME)) { ?>
		<div id="cropButtons" class="baseButtons">
			<p class="standardButton">
				<button id="ButtonCropSubmit" onClick="setCrop(0, '<?=$multi?>');" type="button"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			</p>
			<p class="standardButton">
				<button type="submit" onClick="setCrop(1, '<?=$multi?>');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			</p>
		</div>
		<? } else { ?>
		<div id="cropButtons" class="baseButtons">

			<p class="standardButton">
				<button id="ButtonCropSubmit" onClick="setCrop(0, '<?=$multi?>');" type="button"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			</p>
			<p class="standardButton">
				<button type="submit" onClick="setCrop(1, '<?=$multi?>');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			</p>
		
		</div>
		<? } ?>
		</div>
		<div id="crop-spinner" align="center" style="display:none;margin-left:200px;position: absolute;">
		   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
		   <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
		</div>
	</body>
</html>