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
    # * FILE: /theme/contractors/layout/footer.php
    # ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/contactus.php");
?>

                </div><!-- Close container-fluid div -->
        </div><!-- Close container div -->

        <!-- //Don't show banners for home page, advertise pages, maintenance page and error page -->
        <? if (
                string_strpos($_SERVER["PHP_SELF"], "/order_") === false && 
                string_strpos($_SERVER["REQUEST_URI"], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && 
                string_strpos($_SERVER["PHP_SELF"], "/maintenancepage.php") === false &&
                ACTUAL_PAGE_NAME != "errorpage.php" && 
                !$activeMenuHome
            ) { ?>
        
		<div class="container">
			<? include(system_getFrontendPath("banner_bottom.php")); ?>
		</div>
        
        <? } ?>

        <div id="footer" class="footer-wrapper">

            <div class="container">

                <?
                //Breadcrumb
                front_addBreadcrumb();
                ?>
                
                <div class="row-fluid">
                    
                    <div class="span<?=($twitter_widget ? "8" : "4")?>">
                        <h4><?=system_showText(LANG_SITE_CONTENT);?></h4>
                        <ul class="nav">
                            <? include(system_getFrontendPath("footer_menu.php", "layout")); ?>
                        </ul>
                    
                    </div>
                    
                    <? if ($twitterAccount && !$twitter_widget) { ?>
                    <div class="span4 last-tweets">
                        <h4>
                            Twitter
                            
                            <? if ($setting_twitter_link) { ?>
                                <small class="pull-right">
                                    <a href="http://www.twitter.com/<?=$setting_twitter_link?>" target="_blank" title="<?=system_showText(LANG_FOLLOW_US_TWITTER)?>">
                                        <?=system_showText(LANG_FOLLOW_US);?>
                                    </a>
                                </small>
                            <? } ?>

                        </h4>

                        <?=$timeLine;?>
                       
                    </div>
                    <? } ?>
                                       
                    <div class="span2 pull-right text-right copyright">                       
                        
                        <!-- The code below controls the Copyright info -->
                        <? front_getCopyright($footer, true); ?>
                        <p><?=$footer?></p>
                        
                    </div>
                    
                </div>                
               
            </div>

        </div>

        <!-- Search statistic report - DO NOT REMOVE THIS CODE  -->
        <?=front_statisticReport($banner_section);?>

        <!-- Google maps for results page - DO NOT REMOVE THIS CODE  -->
        <?=front_googleMaps($itemRSSSection, $listings, $classifieds, $events, $promotions, $levelObj);?>

        <!-- Google analytics code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleAnalytics();?>

        <!-- Include all js and css files (minimized) - DO NOT REMOVE THIS CODE  -->
        <? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>
        
        <!-- Pinterest Button - DO NOT REMOVE THIS CODE  -->
        <?=front_pinterestButton();?>
    </body>
    
</html>