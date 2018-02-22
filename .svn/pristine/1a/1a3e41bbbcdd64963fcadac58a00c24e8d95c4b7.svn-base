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
	# * FILE: /theme/default/frontend/advertise.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="content content-full">
		
		<?
		if ($sitecontent) {
			echo "<div class=\"content-custom\">".$sitecontent."</div>";
		}
		?>

        <ul class="tabs tabs-advertise">
            <li id="tab_listing" <?=$activeTab == "listing"? "class=\"active\"": "";?> onclick="showTab('listing');"><a href="javascript:void(0);"><?=system_showText(LANG_LISTING_OPTIONS)?></a></li>
	
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<li id="tab_event" <?=$activeTab == "event"? "class=\"active\"": "";?> onclick="showTab('event');"><a href="javascript:void(0);"><?=system_showText(LANG_EVENT_OPTIONS)?></a></li>
			<? } ?>
	
			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<li id="tab_classified" <?=$activeTab == "classified"? "class=\"active\"": "";?> onclick="showTab('classified');"><a href="javascript:void(0);"><?=system_showText(LANG_CLASSIFIED_OPTIONS)?></a></li>
			<? } ?>
	
			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<li id="tab_article" <?=$activeTab == "article"? "class=\"active\"": "";?> onclick="showTab('article');"><a href="javascript:void(0);"><?=system_showText(LANG_ARTICLE_OPTIONS)?></a></li>
			<? } ?>
			
			<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
				<li id="tab_banner" <?=$activeTab == "banner"? "class=\"active\"": "";?> onclick="showTab('banner');"><a href="javascript:void(0);"><?=system_showText(LANG_BANNER_OPTIONS)?></a></li>
			<? } ?>
        </ul>
		
		<div class="content-main">
		
			<div class="tab-container pricing-table">
			
				<div id="content_listing" class="tab-content tab-content-advertise" <?=$activeTab == "listing"? "style=\"\"": "style=\"display: none;\"";?>>
					<?
                    $signupItem = "listing";
                    include(EDIRECTORY_ROOT."/signup.php");
                    ?>
				</div>
			
				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
					<div id="content_event" class="tab-content tab-content-advertise" <?=$activeTab == "event"? "style=\"\"": "style=\"display: none;\"";?>>
						<?
                        $signupItem = "event";
                        include(EDIRECTORY_ROOT."/signup.php");
                        ?>
					</div>
				<? } ?>
			
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<div id="content_classified" class="tab-content tab-content-advertise" <?=$activeTab == "classified"? "style=\"\"": "style=\"display: none;\"";?>>
						<?
                        $signupItem = "classified";
                        include(EDIRECTORY_ROOT."/signup.php");
                        ?>
					</div>
				<? } ?>
			
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<div id="content_article" class="tab-content tab-content-advertise" <?=$activeTab == "article"? "style=\"\"": "style=\"display: none;\"";?>>
						<?
                        $signupItem = "article";
                        include(EDIRECTORY_ROOT."/signup.php");
                        ?>
					</div>
				<? } ?>
			
				<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
					<div id="content_banner" class="tab-content tab-content-advertise" <?=$activeTab == "banner"? "style=\"\"": "style=\"display: none;\"";?>>
						<?
                        $signupItem = "banner";
                        include(EDIRECTORY_ROOT."/signup.php");
                        ?>
					</div>
				<? } ?>
		
			</div>
			
		</div>
		
		<?
		$contentObj = new Content();
		$content = $contentObj->retrieveContentByType("Advertise with Us Bottom");
		if ($content) {
			echo "<div class=\"content-custom\">".$content."</div>";
		}
        ?>
	
	</div>