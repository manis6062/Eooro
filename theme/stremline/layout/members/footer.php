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
	# * FILE: /theme/default/layout/members/footer.php
	# ----------------------------------------------------------------------------------------------------

?>

            </div><!-- Close container-fluid div -->
            
        </div><!-- Close container div -->
        
		<div id="footer" class=" footer-wrapper footer-members">

			<div class="container">
                
				<div class="row-fluid">
                    
                    <div class="span6">
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
                    
                    <? if (sess_getAccountIdFromSession()) { ?>
                        <div class="span6 text-right">

                            <ul class="footer-nav pull-right">
                                <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/help.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a></li>
                                <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/faq.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                <li><a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>
                            </ul>

                        </div>
                    <? } ?>
                    
                </div>
                
			</div>

		</div>
        
	</body>
    
</html>