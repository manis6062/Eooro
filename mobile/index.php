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
	# * FILE: /mobile/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Home Page";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;

	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $numberItemsMobile = 3;
    $getAddress = true;
    $isMobileSummary = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_listing.php");
    
    if (is_array($array_show_listings)) { ?>

        <div class="home-recents">
            
            <h4><?=system_showText(LANG_MOBILE_RECENT_LISTINGS);?></h4>

            <hr/>

            <? for ($i = 0; $i < count($array_show_listings); $i++) { ?>
            
            <div class="recent-listing row-fluid"> 
			
                 <? if ($array_show_listings[$i]["image_path"]) { ?>  
                <div class="image span4 pull-left">                 
				 <a href="<?=$array_show_listings[$i]["detailLink"];?>">
                       <img src="<?=$array_show_listings[$i]["image_path"]?>" class="img-polaroid">  
                    </a>                
				</div>
                <? } ?>
                
                <div class="title"> 
                    <h4><a href="<?=$array_show_listings[$i]["detailLink"];?>"><?=$array_show_listings[$i]["title"]?></a></h4> 
                    <? if ($array_show_listings[$i]["address"]) { ?>
                        <address><?=$array_show_listings[$i]["address"];?></address>
                    <? } ?>
                </div>
            </div>
            
            <hr/> 
            <? } ?>

        </div>

<? }
    
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>
