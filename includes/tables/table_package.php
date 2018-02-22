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
	# * FILE: /includes/tables/table_package.php
	# ----------------------------------------------------------------------------------------------------

	$itemCount = count($packages);

	if (is_numeric($message) && isset($msg_package[$message])) {
		$message != 3 ? $class = "successMessage" : $class = "errorMessage";?>
		<p class=<?=$class?>><?=$msg_package[$message]?></p>
		<?
	}

	if (is_numeric($error_message)) {
		echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
	} elseif ($error_msg) {
		echo "<p class=\"errorMessage\">".$error_msg."</p>";
	} elseif ($msg == "success") {
		echo "<p class=\"successMessage\">".LANG_MSG_PACKAGE_SUCCESSFULLY_UPDATE."</p>";
	} elseif ($msg == "successdel") {
		echo "<p class=\"successMessage\">".LANG_MSG_PACKAGE_SUCCESSFULLY_DELETE."</p>";
	}
	unset($msg);
    
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){
		include(INCLUDES_DIR."/tables/table_paging.php");
	}

	?>

	<table class="table-itemlist">

		<tr>
			<th><?=system_showText(LANG_SITEMGR_PACKAGE_TITLE);?></th>
			<th><?=system_showText(LANG_SITEMGR_PACKAGE_LEVEL_TYPE);?></th>
			<th><?=system_showText(LANG_LABEL_STATUS);?></th>
			<th><?=system_showText(LANG_SITEMGR_PACKAGE_DATE_CREATED);?></th>
			<th class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<?
		if ($packages) {
			foreach ($packages as $package) {
				$id = $package->getNumber("id");
				?>
				<tr>
					<td>
						<a href="<?=$url_redirect?>/package.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=$package->getString("title")?>
						</a>
					</td>
					<td>
						<?

						/*
						 * Get level title
						 */
						if($package->getString("module") == "listing"){
							$auxLevelObj = "ListingLevel";
						}elseif($package->getString("module") == "article"){
							$auxLevelObj = "ArticleLevel";
						}elseif($package->getString("module") == "classified"){
							$auxLevelObj = "ClassifiedLevel";
						}elseif($package->getString("module") == "event"){
							$auxLevelObj = "EventLevel";
						}elseif($package->getString("module") == "banner"){
							$auxLevelObj = "BannerLevel";
						}
						unset($levelObj);
						$levelObj = new $auxLevelObj();
						echo string_ucwords($package->getString("module")).($auxLevelObj == "ArticleLevel" ? "" : " ".string_ucwords($levelObj->getName($package->level)));
						?>
					</td>
					<td>
						<?
						unset($aux_url,$statusObj,$status);
						$statusObj	= new ItemStatus();
						$status		= $statusObj->getStatus($package->getString("status"));
						$aux_url	= $url_redirect."/settings.php?id=".$id."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : "");
						?>
						<a title="<?=$status?>" href="<?=$aux_url?>" class="link-table">
							<?=$statusObj->getStatusWithStyle($package->getString("status"));?>
						</a>
					</td>
					<td>
						<?=format_date($package->getString("entered"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($package->getNumber("entered"));?>
					</td>
					<td nowrap class="main-options text-center">
						<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=system_showText(LANG_LABEL_VIEW);?>
						</a>
                        <b>|</b>
						<a href="<?=$url_redirect?>/package.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=system_showText(LANG_LABEL_EDIT);?>
						</a>
                        <b>|</b>
						<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=system_showText(LANG_LABEL_DELETE);?>
						</a>
					</td>
				</tr>
				<?
			}
		}
		?>
	</table>