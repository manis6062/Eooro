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
	# * FILE: /sitemgr/prefs/pricing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	extract($_GET);

	//increases frequently actions
	if (!isset($price)) system_setFreqActions('prefs_pricing','pricing');
	
	// Default CSS class for message
	$message_style = "successMessage";

	setting_get( 'compression_level_gif', $compression_level_gif);
	setting_get( 'compression_level_jpg', $compression_level_jpg);
	setting_get( 'compression_level_png', $compression_level_png);

	extract($_POST);
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

			setting_set( 'compression_level_gif', mysql_real_escape_string($compression_level_gif));
			setting_set( 'compression_level_jpg', mysql_real_escape_string($compression_level_jpg));
			setting_set( 'compression_level_png', mysql_real_escape_string($compression_level_png));


	}


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
			<h1><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS))?> - Custom Settings</h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>			

			<br />

			<div class="header-form">Image Compression Settings</div>

			<p class="informationMessage">
					JPEG : Quality (1 - 100) : 1 max-compression, 100 is no compression
				<br>
					GIF : Quality (1 - 100)  : 1 max-compression, 100 is no compression
				<br>
					PNG : Quality (0 - 9)    : 0 is no compression, 9 is max compression
			</p>

			<form name="imagecompresssettings" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			<div class="holder">
				<table cellpadding="0" cellspacing="0" border="0" rules="all">
	                <tbody>
	                <tr>
	                	<th width="100px">Image Type</th>
	                	<th width="100px">Compression Level</th>
	                </tr>
	                <tr>
	                    <td>JPEG</td><td><input type="number" name="compression_level_jpg" max="100" min="0" value="<?=$compression_level_jpg?>"></td>
	                </tr>
	                <tr>
	                    <td>GIF</td><td><input type="number" name="compression_level_gif" max="100" min="0" value="<?=$compression_level_gif?>"></td>
	                </tr>
	                <tr>
	                    <td>PNG</td><td><input type="number" name="compression_level_png" max="9" min="0" value="<?=$compression_level_png?>"></td>
	                </tr>                    
					</tbody>
				</table>
            </div>

				<table class="table-form">
					<tr>
						<td>
							<button type="submit" name="imagecompress" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
				<? if ($_SERVER['REQUEST_METHOD'] == "POST") { ?>
					<font color="green"> Ok! </font>
				<? } ?>
			</form>

		</div>
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
