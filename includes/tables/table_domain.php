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
	# * FILE: /includes/tables/table_domain.php
	# ----------------------------------------------------------------------------------------------------

	$itemCount = count($domains);
    
    if (is_numeric($message) && isset($msg_domain[$message])) { ?>
        <p class="successMessage"><?=$msg_domain[$message]?></p>
    <? }

    if ($error_msg) {
        echo "<p class=\"errorMessage\">".$error_msg."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_DOMAIN_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);
    
    ?>

	<table class="table-itemlist">

		<tr>
			<th><?=string_ucwords(system_showText(LANG_DOMAIN_NAME));?></th>
			<th><?=system_showText(LANG_SITEMGR_DOMAIN_URL);?></th>
			<th><?=string_ucwords(system_showText(LANG_SITEMGR_DATECREATED));?></th>
			<th><?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_CREATED_BY));?></th>
			<th><?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_ACTIVATION));?></th>
			<th><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<?
		$cont = 0;

		if ($domains) foreach ($domains as $domain) {
			$cont++;
			$id = $domain->getNumber("id");
			$url = $domain->getString("url");
			$domain->changeActivationStatus();
			$itemStatus = new ItemStatus();
			?>

			<tr>
				<td>
					<a title="<?=$domain->getString("name");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<?=$domain->getString("name", true, 80);?>
					</a>
				</td>
				<td>
					<span title="<?=$domain->getString("url");?>"><?=$domain->getString("url", true, 80);?></span>
				</td>
				<td>
					<?=$domain->getDate("created");?>
				</td>
				<td>
					<?
						if ($domain->getNumber("smaccount_id")) {
							$smaObj = new SMAccount($domain->getNumber("smaccount_id"));
							$sitemgr_username = $smaObj->getString("username");
						} else {
							setting_get("sitemgr_username", $sitemgr_username);
						}
					?>
					<span title="<?=$sitemgr_username?>"><?=system_showTruncatedText($sitemgr_username, 20);?></span>
				</td>
				<td><?=$itemStatus->getStatusWithStyle($domain->getString("activation_status"));?></td>
				<td nowrap class="main-options">
					<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
						<?=system_showText(LANG_LABEL_VIEW);?>
					</a>

					<? if (!sess_getSMIdFromSession()) { ?>
                        <b>|</b><a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_DELETE);?>
                        </a>
					<? } ?>
				</td>
			</tr>
		<? } ?>
	</table>