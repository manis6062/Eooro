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
	# * FILE: /includes/forms/form_uploadimage.php
	# ----------------------------------------------------------------------------------------------------

	$current_large_image_width = $newwidth;
	$current_large_image_height = $newheight;
	
    if (GALLERY_FREE_RATIO == "on") {
        $aspectratio = 0;
    } else {
        $mdc = image_getMdc(IMAGE_SLIDER_WIDTH, IMAGE_SLIDER_HEIGHT);
        $aspectratio = (IMAGE_SLIDER_WIDTH/$mdc) / (IMAGE_SLIDER_HEIGHT/$mdc);
    }
	
?>

	<script type="text/javascript">

		function sendFile () {
			setValue('yes');
			$('#uploadimage').submit();
			$('#loadingBar').css('display', '');
			$('#imgFile').css('display', 'none');
			$('#submitButton').css('display', 'none');
		}

		function setValue(op){
			if (document.getElementById("uploadThumbID"))
				document.getElementById("uploadThumbID").value=op;
		}

		function noUpload(){
			parent.$.fancybox.close();
		}
		
		<?if ($current_large_image_width) { ?>
			$(function(){
					
				imgWidth = <?=$current_large_image_width?>;
				imgHeight = <?=$current_large_image_height?>;

				$('#imgUpload').Jcrop({
					onChange: showPreview,
					onSelect: showPreview,
					bgColor: 'transparent',
					setSelect:   [ (imgWidth/4), (imgHeight/4), (imgWidth/4*3), (imgHeight/4*3) ],
					aspectRatio: <?=$aspectratio?>,
					boxWidth: 400,
					boxHeight: 400,
					fullImageWidth: imgWidth,
					fullImageHeight: imgHeight,
					minSize : [(imgWidth)/2,(imgHeight)/2]
				});

			});

			function showPreview(coords){
				$('#x1').val(coords.x);
				$('#y1').val(coords.y);
				$('#x2').val(coords.x2);
				$('#y2').val(coords.y2);
				$('#w').val(coords.w);
				$('#h').val(coords.h);
                
                if (coords.w > 0 || coords.h > 0) {
                
                    var rx = <?=$thumbWidthItem?> / coords.w;
                    var ry = <?=$thumbHeightItem?> / coords.h;

                    $('#thumbnailPreview').css({
                        width: Math.round(rx * <?=$current_large_image_width;?>) + 'px',
                        height: Math.round(ry * <?=$current_large_image_height;?>) + 'px',
                        marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                        marginTop: '-' + Math.round(ry * coords.y) + 'px'
                    });
                    
                }
			};
		<?}?>

	</script>

	<? if (string_strlen($error)>0 || $upload == "y") { ?>
		<? echo $error; ?>
		<? if ($upload == "y"){?>
		<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
				<tr>
					<td class="TaddImagetxt"><?=LANG_ORIGINAL?></td>
					<td class="TaddPreviewtxt"></td>
				</tr>
			
		</table>
		<? } 
	 } 
	
	if ($upload == "y"){ ?>
		<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
			<tr>
				<td class="TaddImage">
					<img id="imgUpload" src="<?=DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/".$large_image_name.$_SESSION['user_file_ext'];?>" />	
				</td>
                
                <? if (GALLERY_FREE_RATIO != "on") { ?>
				<td class="TaddPreview">
					<div style="border:1px #e5e5e5 solid; float:left; left:15px; position:relative; overflow:hidden; width:<?=$thumbWidthItem;?>px; height:<?=$thumbHeightItem;?>px;">
						<img src="<?=DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/".$large_image_name.$_SESSION['user_file_ext'];?>" style="position: relative;" id="thumbnailPreview" />
					</div>
				</td>
                <? } ?>
			</tr>	
		</table>
        <br />
	<?} ?>
	
	<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
		<? if ($captions != "y"){?>
			<tr>
				<input type="hidden" id="uploadThumbID" name="uploadThumb" value="" />
				<td class="TimageFile" width="140" height="30"><span><?=system_showText(LANG_LABEL_IMAGEFILE);?></span>:</td>
				<td class="IimageFile">
					<input type="file" id="imgFile" name="image" size="30" onChange="sendFile();" class="<?=((!$thumb_id) ? "inputExplode": "inputExplodeSmall");?>"/>
					<div id="loadingBar" align="center" style="display: none;">
						<img src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif"/>
					</div>
				</td>
			</tr>
		<? } ?>
		<? if ($captions == "y") { ?>

		<tr>
			<th class="wrapcaption"><?=system_showText(LANG_LABEL_THUMBCAPTION)?>:</th>
			<td class="wrapcaption"><input id="thumb_caption" type="text" name="thumb_caption" value="<?=$thumb_caption?>" class="inputExplode" maxlength="250" /></td>
		</tr>

		<tr>
			<th class="wrapcaption"><?=system_showText(LANG_LABEL_IMAGECAPTION)?>:</th>
			<td class="wrapcaption"><input id="image_caption" type="text" name="image_caption" value="<?=$image_caption?>" class="inputExplode" maxlength="250"/></td>
		</tr>
		<? } ?>
	</table>
	
	<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
            <tr><!-- modifications -->
			<td height="24" colspan="2" class="formButton">
				<p class="input-button-form <?=(EDIR_THEME==='review') ? 'standardButton' : ''?>">
					<?if ($upload == "y" || $captions == "y"){?>
						<button id="submitButton UploadImage" type="submit" onclick="setValue('no');" value="Upload" /><?=system_showText(LANG_BUTTON_SUBMIT)?>
					<?} else {?>
						<button type="button" onclick="noUpload();" value="Upload" id="UploadImage"><?=system_showText(LANG_BUTTON_CANCEL)?>
					<? } ?>
					</button>
				</p>
			</td>
		</tr>
	</table>