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
	# * FILE: /sitemgr/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

    $blockMenuTodo = todo_validatePage(true);
?>
	<script type="text/javascript">

		// JQUERY 1.3.1 / DROP DOWN NAVBAR FUNCTION
		var TopenMS=0;
		var TchangeMS=0;

		function showDropdownSearch(){
			if (TopenMS==0){
				$("#divSearch").slideDown('slow');
				$('#linkSearch').text("<?=system_showText(LANG_CLOSE)?>");
				TchangeMS=1;
			} else {
				$("#divSearch").slideUp('slow');
				$('#linkSearch').text("<?=system_showText(LANG_SITEMGR_ADVOPTIONS)?>");
				TchangeMS=0;
			}

			if (TchangeMS==1){
				TopenMS=1;
			} else {
				TopenMS=0;
			}
		}

	</script>

	<?
	setting_get("wp_enabled", $wp_enabled);
	$openListing		=	((string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "content")  && !string_strpos($_SERVER["PHP_SELF"], "export"))||((string_strpos($_SERVER["PHP_SELF"], "claim")) && !string_strpos($_SERVER["PHP_SELF"], "prefs"))||(string_strpos($_SERVER["REQUEST_URI"], "item_type=listing") && !string_strpos($_SERVER["PHP_SELF"], "/leads") ));
	$openBanner			=	(string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER));
	$openEvent			=	(string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)      && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openClassified		=	(string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openArticle		=	(string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER)    && !string_strpos($_SERVER["PHP_SELF"], "content")||(string_strpos($_SERVER["REQUEST_URI"], "item_type=article")));
	$openPromotion		=	((string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) || string_strpos($_SERVER["REQUEST_URI"], "item_type=promotion")) && (!string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "prefs") && !string_strpos($_SERVER["PHP_SELF"], "content")));
	$openBlog			=	(string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "postcomments"));
	$openLeads			=	(string_strpos($_SERVER["PHP_SELF"], "/leads"));
	$openSiteContent	=	(string_strpos($_SERVER["PHP_SELF"], "content"));
	$openSeo			=   (string_strpos($_SERVER["PHP_SELF"], "seocenter") && !$_GET["id"]);
	$openRevenue		=	(string_strpos($_SERVER["PHP_SELF"], "transactions") || string_strpos($_SERVER["PHP_SELF"], "invoices") || string_strpos($_SERVER["PHP_SELF"], "custominvoices") || string_strpos($_SERVER["PHP_SELF"], "discountcode"));
	$openSettings		=	(string_strpos($_SERVER["PHP_SELF"], "prefs") || string_strpos($_SERVER["PHP_SELF"], "emailnotifications") || string_strpos($_SERVER["PHP_SELF"], "package"));
	$openReports		=   (string_strpos($_SERVER["PHP_SELF"], "reports") && !$openSettings);
    $openLocations		=	(string_strpos($_SERVER["PHP_SELF"], "locations"));
	$openData			=	((string_strpos($_SERVER["PHP_SELF"], "import") || string_strpos($_SERVER["PHP_SELF"], "export")) && !string_strpos($_SERVER["PHP_SELF"], "prefs"));
	$openLang			=	(string_strpos($_SERVER["PHP_SELF"], "langcenter"));
	$openplugin			=	(string_strpos($_SERVER["PHP_SELF"], "plugin"));
    $openMobile 		=	(string_strpos($_SERVER["PHP_SELF"], "mobile"));
    $openMailapp 		=	(string_strpos($_SERVER["PHP_SELF"], MAILAPP_FOLDER."/"));
	?>

	<div id="main-left">

		<?
		/*
		 * This var $domainDropDown is created on /sitemgr/layout/header.php
		 */
		if (!is_numeric($domainDropDown) && (!string_strpos($_SERVER["PHP_SELF"], "login.php")) && (!string_strpos($_SERVER["PHP_SELF"], "resetpassword.php"))) { ?>
			<div class="chooseDomainDropDown">
				<p><?=system_showText(LANG_SITEMGR_SELECT_DOMAIN);?>:</p>
				<?=$domainDropDown;?>
				<span class="clear"></span>
			</div>
        <? } ?>
        
		<div id="content-navbar">            
                
				<ul class="side-nav">
                    
					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
                    
					<li class="nav-item">
						<a <?=($blockMenuTodo ? "href=\"javascript: void(0);\" " : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".LISTING_FEATURE_FOLDER."/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_LISTING);?></span></a>
						<? if (!$blockMenuTodo) { ?>
                        <ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/index.php?item_type=listing"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/claim/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIMED));?></a></li>
                            <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/index.php"><?=system_showText(LANG_SITEMGR_MENU_TEMPLATES);?></a></li>
                            <? } ?>
						</ul>
                        <? } ?>
					</li>
                    
					<?	} ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS) && BANNER_FEATURE == "on") { ?>
                    
					<li class="nav-item">
						<a <?=(CUSTOM_BANNER_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".BANNER_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_BANNER_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_BANNER);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS) && EVENT_FEATURE == "on" && FORCE_DISABLE_EVENT_FEATURE != "on") { ?>
                    
					<li class="nav-item">
						<a <?=(CUSTOM_EVENT_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".EVENT_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_EVENT_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/eventcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS) && CLASSIFIED_FEATURE == "on" && FORCE_DISABLE_CLASSIFIED_FEATURE != "on") { ?>
					
                    <li class="nav-item">
						<a <?=(CUSTOM_CLASSIFIED_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".CLASSIFIED_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_CLASSIFIED_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/classifiedcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES) && ARTICLE_FEATURE == "on" && FORCE_DISABLE_ARTICLE_FEATURE != "on") { ?>
					
                    <li class="nav-item">
						<a  <?=(CUSTOM_ARTICLE_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".ARTICLE_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_ARTICLE_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/articlecategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/index.php?item_type=article"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS) && PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && FORCE_DISABLE_PROMOTION_FEATURE != "on") { ?>
					
                    <li class="nav-item">
						<a  <?=(CUSTOM_PROMOTION_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".PROMOTION_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_PROMOTION_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/index.php?item_type=promotion"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
						 </ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG) && BLOG_FEATURE == "on") { ?>
					
                    <li class="nav-item">
						<a <?=(CUSTOM_BLOG_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/index.php"."\"")?>><span <?=(CUSTOM_BLOG_FEATURE != "on" || $blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_BLOG_SING);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<? if (!$wp_enabled){ ?>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/blog.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<? } ?>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/blogcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php"><?=string_ucwords(system_showText(LANG_BLOG_COMMENTS));?></a></li>
						</ul>
					</li>
                    
					<? } ?>
                    
                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LEADS)) { ?>
					
                    <li class="nav-item ">
						<a <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_LABEL_LEADS);?></span></a>
                        <ul >
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=listing"><?=system_showText(LANG_SITEMGR_LISTING_LEADS);?></a></li>
                            
                            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=event"><?=system_showText(LANG_SITEMGR_EVENT_LEADS);?></a></li>
                            <? } ?>

                            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=classified"><?=system_showText(LANG_SITEMGR_CLASSIFIED_LEADS);?></a></li>
                            <? } ?>

                            <? if (THEME_ENQUIRE_PAGE) { ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=general"><?=system_showText(LANG_SITEMGR_GENERAL_LEADS);?></a></li>
                            <? } ?>
                        </ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITECONTENT)) { ?>
					
                    <li class="nav-item">
						<a <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_MENU_SITECONTENT);?></span></a>
						<ul >
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/index.php"><?=system_showText(LANG_SITEMGR_GENERAL);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/advertisement.php"><?=system_showText(LANG_SITEMGR_ADVERTISEMENT);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/member.php"><?=system_showText(LANG_SITEMGR_MEMBER);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/client.php"><?=system_showText(LANG_SITEMGR_MENU_CUSTOM);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/listing.php"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING));?></a></li>
							<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") { ?>
                                <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/deal.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION));?></a></li>
							<? } ?>
                            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/event.php"><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT));?></a></li>
							<?}?>
							<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/classified.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED));?></a></li>
							<?}?>
							<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/article.php"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE));?></a></li>
							<?}?>
                            <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/blog.php"><?=string_ucwords(system_showText(LANG_SITEMGR_BLOG));?></a></li>
							<?}?>    
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/htmleditor.php"><?=system_showText(LANG_SITEMGR_SETTINGS_HTMLEDITOR);?></a></li>
                            <? if (THEME_SLIDER_FEATURE == "on") { ?>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_slider.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SLIDER);?></a></li>
                            <? } ?>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/navigation.php"><?=system_showText(LANG_SITEMGR_SETTINGS_NAVIGATION);?></a></li>
                            <? if (THEME_ENQUIRE_PAGE) { ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/leadeditor.php"><?=string_ucwords(system_showText(LANG_SITEMGR_LEADS_EDITOR))?></a></li>
                            <? } ?>
						</ul>
					</li>
                    
					<? } ?>

                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SEOCENTER)) { ?>
                    
					<li class="nav-item"><a class="nomenu"  <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/seocenter.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_SEOCENTER)?></span></a></li>
                    
                    <? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
                    
					<li class="nav-item">
						<a  <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_REVENUECENTER);?></span></a>
						<ul class="nav-2-col">
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
								<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
									<li class="nav-item-title">
										<p><?=system_showText(LANG_SITEMGR_TRANSACTION);?></p>
										<ul>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/transactions/"><?=system_showText(LANG_SITEMGR_HISTORY);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/transactions/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
											<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
												<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/export/payment.php?type=online"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
											<? } ?>
										</ul>
									</li>
								<? } ?>
								<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<li class="nav-item-title">
									<p><?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE));?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/invoices/"><?=system_showText(LANG_SITEMGR_HISTORY);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/invoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
										<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/export/payment.php?type=invoice"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
										<? } ?>
									</ul>
								</li>
								<? } ?>

							<? } ?>

							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
									<li class="nav-item-title">
                                        <p><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE));?></p>
										<ul>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/custominvoices/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/custominvoices/custominvoice.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/custominvoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
										</ul>
									</li>									
								<? } ?>
							<? } ?>

							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE);?></p>
                                    <ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/discountcode/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/discountcode/discountcode.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
									</ul>
								</li>
							<? } ?>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_REPORTS)) { ?>
                    
					<li class="nav-item ">
						<a <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/reports/systemreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SYSTEMREPORT);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATISTICREPORT);?></a></li>
						</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SETTINGS)) { ?>
                    
					<li class="nav-item settings_">
						<a  <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_MENU_SETTINGS);?></span></a>
							<ul class="nav-3-col">
								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_GENERAL);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/theme.php"><?=system_showText(LANG_SITEMGR_MENU_THEMES);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/foreignaccount.php"><?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/share.php"><?=system_showText(LANG_SITEMGR_SHARE);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/faq.php"><?=system_showText(LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/robotsfilter.php"><?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS);?></a></li>
										<? if (MAINTENANCE_FEATURE == "on") { ?>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/maintenance.php"><?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE);?></a></li>
										<? } ?>
										<? if (FEATURED_CATEGORY == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/featuredcategory.php"><?=string_ucwords(system_showText(LANG_SITEMGR_FEATUREDCATEGORY_PLURAL));?></a></li>
										<? } ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/approvalrequirement.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_APPROVAL));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/location.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/visitorprofile.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SOCIALNETWORK));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/comments.php"><?=string_ucwords(system_showText(LANG_SITEMGR_COMMENTING_OPTIONS));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/twilio.php"><?=string_ucwords(system_showText(LANG_SITEMGR_TWILIO));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/api.php"><?=system_showText(LANG_SITEMGR_API);?></a></li>
									</ul>
								</li>
								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/email.php"><?=system_showText(LANG_SITEMGR_SYSTEMEMAIL);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/emailnotifications/"><?=system_showText(LANG_SITEMGR_MENU_EMAILNOTIF);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/emailconfig.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?></a></li>
									</ul>
								</li>

								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_NAVBAR_MODULES);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/editorchoice.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS);?></a></li>
										<? if(ABLE_RENAME_LEVEL == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_MENULABEL);?></a></li>
										<? }?>
                                        <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/index.php"><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_PLURAL));?></a></li>
                                        <? } ?>
										<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION) { ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/deal.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL));?></a></li>
										<? } ?>
										<? if (CLAIM_FEATURE == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/claim.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></a></li>
										<? } ?>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/modules.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MANAGE_MODULES))?></a></li>
									</ul>
								</li>
                                
                                <? if (GOOGLE_ADS_ENABLED == "on" || GOOGLE_MAPS_ENABLED == "on" || GOOGLE_ANALYTICS_ENABLED == "on" || GOOGLE_TAGMANAGER_ENABLED == "on") { ?>
                                
								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLE);?></p>
									<ul>
										<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
                                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/googleprefs/googlemaps.php"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS);?> </a></li>
                                        <? } ?>
                                        <? if (GOOGLE_ADS_ENABLED == "on") { ?>
                                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/googleprefs/googleads.php"><?=system_showText(LANG_SITEMGR_GOOGLEADS);?> </a></li>
                                        <? } ?>
                                        <? if (GOOGLE_ANALYTICS_ENABLED == "on") { ?>
                                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/googleprefs/googleanalytics.php"><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS);?> </a></li>
                                        <? } ?>
                                        <? if (GOOGLE_TAGMANAGER_ENABLED == "on") { ?>
                                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/googleprefs/googletag.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLETAG);?> </a></li>
                                        <? } ?>
									</ul>
								</li>
                                
                                <? } ?>

								<li class="nav-item-title">
									<p><?=system_showText(LANG_SITEMGR_PAYMENTSETTINGS);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/pricing.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING);?></a></li>
										<? if (PAYMENTSYSTEM_FEATURE == "on") { ?>
											<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/paymentgateway.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY);?></a></li>
											<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
												<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/invoice.php"><?=system_showText(LANG_SITEMGR_INVOICEINFORMATION);?></a></li>
											<?}?>
										<? } ?>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/tax.php"><?=system_showText(LANG_SITEMGR_SETTINGS_TAX);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/package/index.php"><?=system_showText(LANG_SITEMGR_PACKAGE_PLURAL);?></a></li>
									</ul>
								</li>

								<li class="nav-item-title">
									<p>Custom</p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/custom_settings.php">Settings</a></li>
									</ul>
								</li>
							</ul>
					</li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) {
						$_locations = explode(",", EDIR_LOCATIONS);
						$firsLevel = $_locations[0]; ?>
                    <li class="nav-item">
                        <a class="nomenu"  <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/locations/location_$firsLevel/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS));?></span></a>
                    </li>
                    
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
                    
					<li class="nav-item">
						<a <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></span></a>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/import/index.php"><?=ucfirst(system_showText(LANG_SITEMGR_IMPORT));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/import/importlog.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/import/settings.php"><?=system_showText(LANG_SITEMGR_DEFAULTSETTINGS);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/export/index.php"><?=ucfirst(system_showText(LANG_SITEMGR_EXPORT));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/export/download.php"><?=ucfirst(system_showText(LANG_SITEMGR_EXPORT_DOWNLOAD));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/export/payment.php"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
						</ul>
					</li>
                    
					<? } ?>

                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LANGUAGECENTER)) { ?>
                    
                    <li class="nav-item">
                        <a <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/langcenter/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER));?></span></a>
                        <ul>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/langcenter/index.php"><?=system_showText(LANG_SITEMGR_LANGUAGE);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/langcenter/edit.php"><?=system_showText(LANG_SITEMGR_LANGUAGES_EDIT);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/langcenter/add.php"><?=system_showText(LANG_SITEMGR_LANGUAGES_ADD);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/langcenter/flags.php"><?=system_showText(LANG_SITEMGR_LANGUAGES_CHANGE);?></a></li>
                        </ul>
                    </li>
                    
                    <? } ?>

                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PLUGINS)) { ?>
                    
                    <li class="nav-item plugin_">
                        <a <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/plugins/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=string_ucwords(system_showText(LANG_SITEMGR_PLUGINS));?></span></a>
                        <ul>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/plugins/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                            <? if (SUGARCRM_FEATURE == "on") { ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/plugins/index.php?type=0"><?=system_showText(LANG_SITEMGR_NAVBAR_SUGARCRM);?></a></li>
                            <? } ?>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/plugins/index.php?type=1"><?=system_showText(LANG_SITEMGR_NAVBAR_WORDPRESS);?></a></li>
                        </ul>
                    </li>
                    
                    <? } ?>
                    
                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_MOBILE)) { ?>
                    
                    <li class="nav-item">
                        
                    </li>
                    
                    <li class="nav-item">
                        <a id="link_mobile" <?=($openMobile && !$blockMenuTodo ? "class=\"borderDownSelected\"" : "");?> <?=($blockMenuTodo ? "style=\"cursor:default;\"" : "")?> href="javascript:void(0);"><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_MOBILE);?></span></a>
                        <ul>
                            <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/index.php"?>"><?=system_showText(LANG_SITEMGR_BUILD_YOUR_APP)?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/screen.php"><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/notifications.php"><?=system_showText(LANG_SITEMGR_MOBILE_NOTIFICATIONS);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/adverts.php"><?=system_showText(LANG_SITEMGR_MOBILE_ADVERTS);?></a></li>
                        </ul>
                    </li>
                        
                    <? } ?>
                    
                    <? if (MAIL_APP_FEATURE == "on" && permission_hasSMPermSection(SITEMGR_PERMISSION_MAILAPP)) { ?>
                    
                    <li class="nav-item">
                        <a class="nomenu" <?=($blockMenuTodo ? "href=\"javascript: void(0);\" style=\"cursor:default;\"" : "href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".MAILAPP_FOLDER."/index.php"."\"")?>><span <?=($blockMenuTodo ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_MAILAPP);?></span></a>
                    </li>
                        
                    <? } ?>
                    
                    <?php   if ( permission_hasSMPermSection(SITEMGR_PERMISSION_CASE)) : ?>
                    <!-- case modifications -->
                    <li class="nav-item">
                        <a href="" id="case-nav">Case</a>
                        <ul>
                            <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=searchcase'?>">Search</a></li>
                            <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=manage'?>">Manage Case</a></li>
                            <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=setting'?>">Case Settings</a></li>
                        </ul>
                    </li>
                    <?php endif;?>
                </ul>
                
		</div>

		<div id="bottom-navbar">&nbsp;</div>
	</div>