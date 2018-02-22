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
	# * FILE: /sitemgr/layout/footer.php
	# ----------------------------------------------------------------------------------------------------

?>

				<span class="clear"></span>

			</div>

		</div>

		<div class="sitemgr-footer">

			<div class="container-box">
            	
				<? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false){?>
                <div class="backLinks">
                    <a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_BACKTOSITE)?></a>
                    <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_SITEMGR_MEMBERSSECTION)?></a>
                </div>
				<?}?>
        
				<div class="footer-copyright">
					<span class="basePowered">Powered by <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank">eDirectory Cloud Service</a>&trade; <?=VERSION?>.</span>
					<br />&copy; Arca Solutions Inc. Developers of eDirectory.
				</div>

			</div>

		</div>

		<?
		// GOOGLE ANALYTICS FEATURE 
		if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE && (GOOGLE_ANALYTICS_ENABLED == "on")) {
			$google_analytics_page = "sitemgr";
			include(INCLUDES_DIR."/code/google_analytics.php");
		}
		?>
    </div>

	</body>

	<script type="text/javascript">
		$(".toolbar-icons").hide();
		$(".toolbar-icons-button").click(
			function() {
				var toolbar = $(this).children(".toolbar-icons");
				if (toolbar.is(":hidden")) {
					$(".toolbar-icons").hide();
					toolbar.show();
				} else {
					toolbar.hide();
				}
				
			}
		)

	</script>

</html>