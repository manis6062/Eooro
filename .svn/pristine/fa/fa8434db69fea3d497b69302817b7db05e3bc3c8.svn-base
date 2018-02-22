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
	# * FILE: /includes/forms/form_colorscheme.php
	# ----------------------------------------------------------------------------------------------------


?>	
	
	<script language="javascript" type="text/javascript">

		function JS_submit(type) {
			if (type == "reset"){
				$("#action").attr("value", "reset");
				dialogBox("confirm", '<?=system_showText(LANG_SITEMGR_COLORS_RESET_CONFIRM);?>', "Submit", "color_scheme", 200,'<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
			} 
			if (type == "apply"){
				$("#aux_action").attr("value", "1");
			}
			
			if (type != "reset"){
				document.color_scheme.submit();
			}
		}
		
		function enableOptions(id){
			$("#"+id).css("display", "");
		}
		
		function hideOptions(id){
			$("#"+id).css("display", "none");
		}
		
		function emptyColor(id, div, box){
			$("#"+id).attr("value", "SCHEME_EMPTY");
			$("#"+div+" span").css("backgroundColor", "");
			$("#"+box).css("display", "none");
		}
		
		function restoreDefault(id, div, color, box){
			if (color){
				$("#"+id).attr("value", color);
				$("#"+div+" span").css("backgroundColor", "#"+color);
			} else {
				$("#"+id).attr("value", "SCHEME_EMPTY");
				$("#"+div+" span").css("backgroundColor", "");
			}
			$("#"+box).css("display", "none");
		}

	</script>
	
	<? if ($errorMessage) { ?>
		<div id="warning" class="errorMessage">
			<?=$errorMessage?>
		</div>
	<? } else if ($successMessage) { ?>
		<div id="warning" class="successMessage">
			<?=$successMessage?>
		</div>
	<? } ?>

	<div class="header-form">
		<?=ucwords(system_showText(LANG_SITEMGR_COLOR_SCHEME)." - $label");?>
	</div>
	
	<? if ($scheme != EDIR_SCHEME) { ?>
		<p class="informationMessage"><?=system_showText(LANG_SITEMGR_COLOR_SCHEME_TIP)?></p>
	<? } ?>
		
	<div class="block-info">
		
		<div class="well-grid main-colors">
				<h4><?=system_showText(LANG_SITEMGR_COLOR_MAINCOLORS);?></h4>
				
				<? foreach ($table_colors_3 as $table_info) { ?>
		
				<p>
					<b><?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)))?>:</b>					
					<a href="javascript: void(0);" onclick="restoreDefault('color<?=$table_info?>', 'colorSelector<?=$table_info?>', '<?=$arrayDefault[$theme][$scheme]["color".$table_info]?>', 'options<?=$table_info?>')"><?=LANG_SITEMGR_COLOR_RESTORE?></a>
					<span class="colorSelector-3" id="colorSelector<?=$table_info?>"><span style="background-color: #<?=${"color".$table_info}?>; cursor:pointer;"></span></span>
					<input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>"/>
				</p>
			
				<? } ?>

		</div>

		<div class="well-grid">
			<h4><?=system_showText(LANG_SITEMGR_COLOR_SUPPORTCOLORS);?></h4>

				<? foreach ($table_colors_2 as $table_info) { ?>		
				<p>
					<b><?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>:</b>
					<a href="javascript: void(0);" onclick="restoreDefault('color<?=$table_info?>', 'colorSelector<?=$table_info?>', '<?=$arrayDefault[$theme][$scheme]["color".$table_info]?>', 'options<?=$table_info?>')"><?=LANG_SITEMGR_COLOR_RESTORE?></a>
					<span class="colorSelector-4" id="colorSelector<?=$table_info?>"><span style="background-color: #<?=${"color".$table_info}?>; cursor:pointer;"></span></span>
					<input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>"/>
				</p>
				<? } ?>
		</div>

		<div class="well-grid">
			<h4><?=system_showText(LANG_SITEMGR_COLOR_TYPOGRAFYOPTIONS);?></h4>

			<? foreach ($table_colors_1 as $table_info) { ?>
		
				<p>
					<b><?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>:</b>
					<a href="javascript: void(0);" onclick="restoreDefault('color<?=$table_info?>', 'colorSelector<?=$table_info?>', '<?=$arrayDefault[$theme][$scheme]["color".$table_info]?>', 'options<?=$table_info?>')"><?=LANG_SITEMGR_COLOR_RESTORE?></a>
					<span class="colorSelector-4" id="colorSelector<?=$table_info?>"><span style="background-color: #<?=${"color".$table_info}?>; cursor:pointer;"></span></span>
					<input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>"/>
				</p>
			
			<? } ?>
                
            <p>
                <b><?=string_ucwords(system_showText(LANG_SITEMGR_COLOR_FONT))?>:</b>
                <span><?=$arrayFont;?></span>
            </p>

		</div>

	</div>