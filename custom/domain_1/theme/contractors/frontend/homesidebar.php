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
	# * FILE: /theme/contractors/frontend/homesidebar.php
	# ----------------------------------------------------------------------------------------------------

    if ($addHomeSidebar) { ?>
        
        <div class="span4">

            <? if ($front_text_sidebar || $front_text_sidebar2) { ?>
            
            <div class="flex-box-underline hidden-phone">
                
                <? if ($front_text_sidebar) { ?>
                
                    <h3><?=$front_text_sidebar?></h3>
                
                <? } ?>
                
                <div class="clearfix">
                    
                    <? if ($front_text_sidebar2) { ?>
                    
                        <p><?=$front_text_sidebar2?></p>
                    
                    <? } ?>
                    
                    <a class="text-success" href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
                        <?=system_showText(LANG_LABEL_LEARN_MORE);?> »
                    </a>
                    
                </div>
                
            </div>
            
            <? } ?>

            <? include(system_getFrontendPath("newsletter.php")); ?>

            <? if ($front_testimonial) { ?>
            
                <div class="flex-box-underline box-statement">
                    
                    <blockquote <?=(!file_exists(EDIRECTORY_ROOT.IMAGE_TESTIMONIAL_PATH) ? "class=\"total\"" : "")?>>
                        
                        <p><?=$front_testimonial;?></p>
                        
                        <? if ($front_testimonial_author) { ?>
                            <small><?=$front_testimonial_author;?></small>
                        <? } ?>
                        
                    </blockquote>
                    
                    <? if (file_exists(EDIRECTORY_ROOT.IMAGE_TESTIMONIAL_PATH)) { ?>
                    
                    <img class="statement" src="<?=DEFAULT_URL.IMAGE_TESTIMONIAL_PATH;?>"/>
                    
                    <? } ?>
                    
                </div>
            
            <? } ?>

        </div>
        
    <? } ?>