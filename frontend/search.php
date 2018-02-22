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
	# * FILE: /frontend/search.php
	# ----------------------------------------------------------------------------------------------------

?>

	<form class="form" name="search_form" method="get" action="<?=$action;?>">

		<div id="search">
			<fieldset>
				<label><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></label>
				<input type="text" name="keyword" id="keyword<?=($searchResponsive ? "_resp" : "")?>" value="<?=$keyword;?>" />
				<p><?=$searchByKeywordTip?></p>
			</fieldset>

			<? if ($hasWhereSearch) { ?>

				<fieldset>
					<label><?=system_showText(LANG_LABEL_SEARCHWHERE);?></label>
					<input type="text" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" value="<?=$where;?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "")?> />
					<p><?=system_showText(LANG_LABEL_SEARCHWHERETIP);?></p>
				</fieldset>

            <? } ?>
            
            <? if (!$keepFormOpen) { ?>
                <div class="left">
                    <button type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>

                    <? 
                    if ($hasAdvancedSearch) {
                        $aux_template_id = $template_id;
                    ?>
                    <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$aux_template_id?>', true);">
                        <span id="advanced-search-label"><?=system_showText(LANG_BUTTON_ADVANCEDSEARCH);?></span>
                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_BUTTON_ADVANCEDSEARCH_CLOSE);?></span>
                    </a>
                    <? } ?>
                </div>
             <? } ?>

		</div>

		<? 
		if ($hasAdvancedSearch  && !$keepFormOpen) {
			$template_id = $template_id ? $template_id : 0; ?>
			<div id="advanced-search" style="display:none;">
				<? include(EDIRECTORY_ROOT."/advancedsearch.php") ?>
			</div>
			<? 
		} 
	if (!$keepFormOpen) { ?>
	</form>
    <? } ?>