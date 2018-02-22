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
	# * FILE: /includes/forms/form_discountcode.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript">
	<!--
	function showAmountType(type) {
		if (type == '%') {
			$('#mat').empty();
			$('#mat').append("* Amount");
			document.getElementById('amount_monetary').innerHTML = '';
			document.getElementById('amount_percentage').innerHTML = type;
			$('#case1,#case2').show();
		} else if (type == 'duration') {
			$('#mat').empty();
			$('#mat').append("* Months");
			document.getElementById('amount_percentage').innerHTML = '';
			document.getElementById('amount_monetary').innerHTML = '';
			$('input[name=amount]').empty();
			$('#case1,#case2').hide();
		} else {
			$('#mat').empty();
			$('#mat').append("* Amount");
			document.getElementById('amount_monetary').innerHTML = type;
			document.getElementById('amount_percentage').innerHTML = '';
			$('#case1,#case2').show();
		}
	}
	--> 
</script>

<script>
$( document ).ready(function() {
	if ($('input[name="type"]:checked').val() == "duration"){
		showAmountType('duration');
		var str = $('.errorMessage').text();
		var res = str.replace("Amount must be greater than 0.", "Month must be greater than 0.");
		$('.errorMessage').empty();
		
		var res = res.replace(".", ".<br>");
		var res = res.replace(".•", ".<br>•");
		$('.errorMessage').append(res);
	}
});
</script>

<? echo "<p class=\"informationMessage\">* ".system_showText(LANG_SITEMGR_LABEL_REQUIREDFIELD)."</p>"; ?>

<? if ($message_discountcode) {?>
	<p class="errorMessage"><?=$message_discountcode?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_INFORMATION)?></th>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_CODE)?>:</th>
		<td><input type="text" name="id" value="<?=$id?>" class="input-form-discountcode" maxlength="10" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_EXPIRATIONDATE)?>:</th>
		<td><input type="text" name="expire_date" id="expire_date" value="<?=($expire_date ? $expire_date : "")?>" class="input-form-discountcode" style="width:100px" maxlength="10" /><span class="label-field-form">(<?=format_printDateStandard()?>)</span></td>
	</tr>
	<? if ($x_id) { ?>
		<tr>
			<th><?=system_showText(LANG_SITEMGR_STATUS)?></th>
			<td><?=$discountCodeStatusDropDown?></td>
		</tr>
	<? } ?>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>:</th>
		<td class="capitalize">
			<input type="radio" id="percentage" name="type" value="percentage" class="inputAlign" <?=(($type == "percentage") ? "checked=true" : "")?> onclick="showAmountType('%');" />
			<?=system_showText(LANG_SITEMGR_LABEL_PERCENTAGE)?>
			<input type="radio" name="type" value="monetary value" class="inputAlign" <?=((!$type || $type == "monetary value") ? "checked=true" : "")?> onclick="showAmountType('<?=CURRENCY_SYMBOL?>');" />
			<?=system_showText(LANG_SITEMGR_LABEL_FIXEDVALUE)?>				
			<input type="radio" id="dur" name="type" value="duration" class="inputAlign" <?=(( $type == "duration") ? "checked=true" : "")?> onclick="showAmountType('duration');" />
			Duration
		</td>
	</tr>
	<tr>
		<th id = 'mat'>* <?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?>:</th>
		<td>
			<span class="inline" id='amount_monetary'><? if (!$type || $type == "monetary value") { echo CURRENCY_SYMBOL; } ?></span><input type="text" name="amount" value="<?=(($amount) ? $amount : "0")?>" style="width:100px" class="input-form-discountcode" maxlength="10" /><span class="inline" id='amount_percentage'><? if ($type && $type != "monetary value") { echo "%"; } ?></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_AVAILABLEOF)?>:</th>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="td-checkbox">
						<input type="checkbox" name="listing" class="inputCheck" <?=(($listing == "on") ? ("checked=true") : (""))?> />
					</td>
					<td style="color: #003365;">
						<?=system_showText(LANG_SITEMGR_LISTING_SING)?>
					</td>
				
					<td class="td-checkbox" id="case1">
						<input type="checkbox" name="case" class="inputCheck" <?=(($case == "on") ? ("checked=true") : (""))?> />
					</td>
					<td style="color: #003365;" id="case2">
						Case
					</td>
				</div>
					<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="event" class="inputCheck" <?=(($event == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_EVENT_SING)?>
						</td>
					<? } ?>
					<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="banner" class="inputCheck" <?=(($banner == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_BANNER_SING)?>
						</td>
					<? } ?>
					<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="classified" class="inputCheck" <?=(($classified == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?>
						</td>
					<? } ?>
					<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="article" class="inputCheck" <?=(($article == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_ARTICLE_SING)?>
						</td>
					<? } ?>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>Country</th>
		<td>
			<select name="location_1">
				<option value="0" <?=0 == $location_1 ? "selected" : null?>>Global Brand</option>
				<?foreach ($country as $key => $value): ?>
				<option value="<?=$key?>" <?=$key == $location_1 ? "selected" : null?>><?=$value?></option>
				<?endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_RECURRING)?>:</th>
		<td>
			
			<input type="radio" name="recurring" value="yes" class="inputAlign" <?=(($recurring == "yes") ? "checked=true" : "")?> />
			<?=system_showText(LANG_SITEMGR_YES)?>
		
	
		
			<input type="radio" name="recurring" value="no" class="inputAlign" <?=((!$recurring || $recurring == "no") ? "checked=true" : "")?> />
			<?=system_showText(LANG_SITEMGR_NO)?>
			
			<span>(<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_ALLOWREPEAT_TEXT)?>)</span>
					
		</td>
	</tr>
</table>

