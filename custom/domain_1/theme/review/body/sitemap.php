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
	# * FILE: /theme/default/body/sitemap.php
	# ----------------------------------------------------------------------------------------------------
    //for the banner
    $thePageTitle = '<h1 class="transparent-bg">Sitemap</h1>';
    include(system_getFrontendPath("review_banner_contactus.php"));
    
    include(system_getFrontendPath("general.php"));

?>
		<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="hidden">
		  <li itemprop="itemListElement" itemscope
		      itemtype="http://schema.org/ListItem">
		    <a itemprop="item" href="<?=NON_SECURE_URL?>/sitemap.php">
		        <span itemprop="name">Sitemap</span></a>
		    <meta itemprop="position" content="1" />
		  </li>
		</ol>


        <section class="contact-form login review">

            <div class="row-fluid generalpage">

                    <div class="row-fluid">
                <?//for the head title page 
                include(system_getFrontendPath("sitecontent_top.php")); ?>
            </div>
        
            <div class="container">
	        <div <?=($addSidebar ? "class=\"col-sm-$contentSpanSize\"" : "class=\"box-title color-4\"")?> >
	       		<? if ($filePathToInclude) include($filePathToInclude); ?>
	        </div>

            <? if ($hasContactInfo) { ?>

            <div <?=($addSidebar ? "class=\"col-sm-$sidebarSpanSize contactus\" " : "row-fluid")?>>
	             <? 
                 include(system_getFrontendPath("sitecontent_bottom.php"));
                 
                 if ($addSidebar) {
                     
                     include(system_getFrontendPath($contactIncludeFile));// contact_map.php file ho

	             } ?>
            </div>
            
            <? } ?>
            </div>
        </section>
        
	</div>