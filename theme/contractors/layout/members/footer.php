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
	# * FILE: /theme/contractors/layout/members/footer.php
	# ----------------------------------------------------------------------------------------------------

?>

            </div><!-- Close container-fluid div -->
            
        </div><!-- Close container div -->
        
		<div id="footer" class=" footer-wrapper footer-members">

			<div class="container">
                
				<div class="row-fluid text-right">
                        <?
                        customtext_get("footer_copyright", $footer_copyright);
                        
                        if (!$footer_copyright) {
                            $footer = "Copyright &copy; ".date("Y")." Arca Solutions, Inc. <br />All Rights Reserved.";
                        } else {
                            $footer = $footer_copyright;
                        }
                        
                        if (BRANDED_PRINT == "on") { ?>
                            <h5 class="powered-by">Powered by <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank">eDirectory Cloud Service&trade;</a>.</h5>
                        <? } ?>
                            
                        <p class="copyright">
                            <?=$footer?>
                        </p>

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