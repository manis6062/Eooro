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
	# * FILE: /includes/tables/table_content.php
	# ----------------------------------------------------------------------------------------------------

    if ($contents) { ?>

	<table class="table-itemlist">

		<tr>
			<th>
				<span><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></span>
			</th>
			<th>
				<span><?=system_showText(LANG_SITEMGR_LASTUPDATED)?></span>
			</th>
			<th class="text-center">
                <span><?=system_showText(LANG_LABEL_OPTIONS)?></span>
            </th>
		</tr>

		<?
		foreach($contents as $content) {
			$id = $content->getNumber("id");
			if ( $id == 68 ) {
				if ( SITEMAP_FEATURE == 'off' ) continue;
			}
            $contentLabel = string_strtoupper($content->getString("type"));
            $contentLabel = str_replace(" ", "_", $contentLabel);
		?>

			<tr>
				<td>
					<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>">
							<?=$content->getString("type")?>
						</a>
					<? } else { ?>
						<a href="content.php?id=<?=$id?>">
                            <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
						</a>
					<? } ?>
				</td>
				<td>
					<?
					if ($content->getNumber("updated") == 0) {
						echo system_showText(LANG_SITEMGR_NOTUPDATED);
					} else {
						echo format_date($content->getNumber("updated"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($content->getNumber("updated"));
					}
					?>
				</td>
				<td nowrap class="main-options text-center">
					<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>">
							<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
						</a>
					<? } else { ?>
						<a href="content.php?id=<?=$id?>">
							<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
						</a>
					<? } ?>
					<? if ($content->getString("section") == "client") { ?>
						<b>|</b> <a href="delete.php?id=<?=$id?>">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</a>
					<? } ?>
				</td>
			</tr>

        <? } ?>

	</table>
		
    <? } ?>