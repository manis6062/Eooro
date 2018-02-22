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
	# * FILE: /theme/default/body/faq.php
            # ----------------------------------------------------------------------------------------------------
    //$thePageTitle = '<h3>How can we help you?</h3>';
    $thePageTitle = '<h1 class="transparent-bg">FAQ</h1>';
    include(system_getFrontendPath("review_banner_faq.php"));
?>	
	<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="hidden">
		  <li itemprop="itemListElement" itemscope
		      itemtype="http://schema.org/ListItem">
		    <a itemprop="item" href="<?=NON_SECURE_URL?>/faq.php">
		        <span itemprop="name">FAQ</span></a>
		    <meta itemprop="position" content="1" />
		  </li>
	</ol>

    <div class="container">
	<div class="row-fluid">
        
		<div class="box-title">
			<?
            include(system_getFrontendPath("general.php"));
            if ($filePathToInclude) {
                include($filePathToInclude);
            }
            ?>
		</div>

	</div>
    </div>