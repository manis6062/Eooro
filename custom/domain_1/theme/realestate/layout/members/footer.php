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
	# * FILE: /theme/realestate/layout/members/footer.php
	# ----------------------------------------------------------------------------------------------------
?>
                    
                    <br clear="all" />

                </div>
            
                <br clear="all" />
            
            </div>
		</div>
        
		<div id="footer-wrapper">

			<div id="footer">
                
				<div class="right">
					<?
						customtext_get("footer_copyright", $footer_copyright);
						if (!$footer_copyright) {
							$footer = "Copyright &copy; ".date("Y")." Arca Solutions, Inc. <br />All Rights Reserved.";
						} else {
							$footer = $footer_copyright;
						}
					?>
					
					<? if (BRANDED_PRINT == "on") { ?>
						<h5 class="powered-by">Powered by <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank">eDirectory Cloud Service&trade;</a>.</h5>
					<? } ?>
					<p class="copyright">
						<?=$footer?>
					</p>
					
					<? if (string_strpos($_SERVER["PHP_SELF"], "/login.php") !== false || string_strpos($_SERVER["PHP_SELF"], "/forgot.php") !== false) {
						$w3cCSSURL = "http://jigsaw.w3.org/css-validator/check/referer"; 
						$w3cXHTMLURL = "http://validator.w3.org/check/referer"; 
						?>
                        <?/*
						<p class="w3c">
							W3C /
							<a href="<?=$w3cXHTMLURL;?>" target="_blank">XHTML</a>
						</p>
                        */?>
					<? } ?>
	
					<?
					// GOOGLE ANALYTICS FEATURE 
					if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE && (GOOGLE_ANALYTICS_ENABLED == "on")) {
						$google_analytics_page = "members";
						include(INCLUDES_DIR."/code/google_analytics.php");
					}
					?>
				</div>
                
			</div>

		</div>
	</body>
</html>