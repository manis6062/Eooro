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
    # * FILE: /theme/contractors/body/index.php
    # ----------------------------------------------------------------------------------------------------    

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------   
    include(EDIRECTORY_ROOT."/includes/code/front_content.php");

    include(system_getFrontendPath("sitecontent_top.php")); ?>   

    <div class="row-fluid homepage">
        
        <div class="span<?=($addHomeSidebar ? "8" : "12")?>">
           
             <? include(system_getFrontendPath("browsebycategory.php")); ?>
           
             <? include(system_getFrontendPath("searchbar.php")); ?>
           
        </div>
        
        <? include(system_getFrontendPath("homesidebar.php")); ?>
        
    </div>   
       
    <div class="row-fluid mrgt-30">
        <? include(system_getFrontendPath("featured_review.php")); ?>
    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>

</div><!-- Well Container -->
</div><!-- Container Fluid -->

    <? include(system_getFrontendPath("socialbar.php")); ?>

    <div class="footer-row">
        <div class="container">
            <div class="row-fluid">
                <div class="span<?=($twitter_widget ? "8" : "12")?>">
                    <? include(system_getFrontendPath("top_locations.php", "frontend")); ?>
                </div>
                <? if ($twitter_widget) { ?>
                <div class="span4">
                    <? include(system_getFrontendPath("twitter.php")); ?>
                </div>
                <? } ?>
            </div>
        </div>
    </div>

<div><!-- To be closed on footer.php -->
<div><!-- To be closed on footer.php -->