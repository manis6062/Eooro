<?php

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
	# * FILE: /sitemgr/content/advertisement.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions("content_advertisement", "content");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
?>
    <div id="main-right">

        <div id="top-content">
            <div id="header-content">
                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?> - <?=ucfirst(system_showText(LANG_SITEMGR_ADVERTISEMENT))?></h1>
            </div>
        </div>

        <div id="content-content">

            <div class="default-margin">

                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                
                include(INCLUDES_DIR."/tables/table_content_submenu.php");

                $whereContent = "section = 'advertise_general'";

                $blockedContent = unserialize(SITECONTENT_BLOCKED);
                $blockedContent = array_map("db_formatString", $blockedContent);
                $whereContent .= " AND type NOT IN (".implode(",", $blockedContent).")";

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, $whereContent);
                $contents = $pageObj->retrievePage();

                if (count($contents)) {
                ?>

                <br />
                <table class="table-itemlist">
                    <tr>
                        <th><?=ucfirst(system_showText(LANG_SITEMGR_ADVERTISEMENT))?></th>
                        <th style="width:60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    </tr>
                    <?
                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                        </td>
                    </tr>
                    <?
                    }

                }
                
                # ----------------------------------------------------------------------------------------------------
                # LISTING ADVERTISE
                # ----------------------------------------------------------------------------------------------------

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_listing'$where");
                $contents = $pageObj->retrievePage();

                $listinglevelObj = new ListingLevel();
                $listinglevelValue = $listinglevelObj->getValues();

                if (count($contents) || count($listinglevelValue)) {

                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                            
                        </td>
                    </tr>
                    <?
                    }
                }
                
                # ----------------------------------------------------------------------------------------------------
                # EVENT ADVERTISE
                # ----------------------------------------------------------------------------------------------------

                if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_event'$where");
                $contents = $pageObj->retrievePage();

                $eventlevelObj = new EventLevel();
                $eventlevelValue = $eventlevelObj->getValues();

                if (count($contents) || count($eventlevelValue)) {

                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <? if ($section == "client"){ ?>
                            <a href="custom.php?id=<?=$id?>">
                                <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                            </a>
                            <? } else { ?>
                                <? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
                                && (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
                                    <a href="content.php?id=<?=$id?>">
                                        <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                                    </a>
                                <? } ?>
                            <? } ?>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                            
                        </td>
                    </tr>
                    <? }
                    } 
                }
                
                # ----------------------------------------------------------------------------------------------------
                # CLASSIFIED ADVERTISE
                # ----------------------------------------------------------------------------------------------------

                if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_classified'$where");
                $contents = $pageObj->retrievePage();

                $classifiedlevelObj = new ClassifiedLevel();
                $classifiedlevelValue = $classifiedlevelObj->getValues();

                if (count($contents) || count($classifiedlevelValue)) {

                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <? if ($section == "client"){ ?>
                            <a href="custom.php?id=<?=$id?>">
                                <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                            </a>
                            <? } else { ?>
                                <? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
                                && (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
                                    <a href="content.php?id=<?=$id?>">
                                        <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                                    </a>
                                <? } ?>
                            <? } ?>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                            
                        </td>
                    </tr>
                    <? }
                    }
                }
                
                # ----------------------------------------------------------------------------------------------------
                # ARTICLE ADVERTISE
                # ----------------------------------------------------------------------------------------------------

                if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_article'$where");
                $contents = $pageObj->retrievePage();

                $articlelevelObj = new ArticleLevel();
                $articlelevelValue = $articlelevelObj->getValues();

                if (count($contents) || count($articlelevelValue)) {

                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <? if ($section == "client"){ ?>
                            <a href="custom.php?id=<?=$id?>">
                                <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                            </a>
                            <? } else { ?>
                                <? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
                                && (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
                                    <a href="content.php?id=<?=$id?>">
                                        <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                                    </a>
                                <? } ?>
                            <? } ?>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                            
                        </td>
                    </tr>
                    <? }
                    }
                }
                
                # ----------------------------------------------------------------------------------------------------
                # BANNER ADVERTISE
                # ----------------------------------------------------------------------------------------------------

                if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {

                $pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_banner'$where");
                $contents = $pageObj->retrievePage();

                $bannerlevelObj = new BannerLevel();
                $bannerlevelValue = $bannerlevelObj->getValues();

                if (count($contents) || count($bannerlevelValue)) {

                    foreach ($contents as $content) {
                        $id = $content->getNumber("id");
                        $contentLabel = string_strtoupper($content->getString("type"));
                        $contentLabel = str_replace(" ", "_", $contentLabel);
                    ?>
                    <tr>
                        <td>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <? if ($section == "client"){ ?>
                            <a href="custom.php?id=<?=$id?>">
                               <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                            </a>
                            <? } else { ?>
                                <? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
                                && (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
                                    <a href="content.php?id=<?=$id?>">
                                        <?=system_showText(LANG_LABEL_SEO_TUNING);?> |
                                    </a>
                                <? } ?>
                            <? } ?>
                            <a href="content.php?id=<?=$id?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                        </td>
                    </tr>
                    <? }
                    }
                } ?> 
                </table>
               

                <?
                #---------------------------------------------------------
                # Advertise Images
                #---------------------------------------------------------
                ?>

                <?// Listing ?>
                <table class="table-itemlist">
                    <tr>
                        <th><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?></th>
                        <th width="60px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    </tr>
                    <?
                    foreach ($listinglevelValue as $value) {
                    ?>
                    <tr>
                        <td>
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=listing&value=<?=$value?>">
                                <?=$listinglevelObj->showLevel($value)?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=listing&value=<?=$value?>">
                               <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
                
                
                <?// Event 
                if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
                ?>
                <table class="table-itemlist">
                    <tr>
                                <th><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT_SING))?></th>
                                <th width="60px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                            </tr>
                            <?
                            foreach ($eventlevelValue as $value) {
                            ?>
                            <tr>
                                <td>
                                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=event&value=<?=$value?>">
                                        <?=$eventlevelObj->showLevel($value)?>
                                    </a>
                                </td>
                                <td nowrap class="main-options">
                                     <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=event&value=<?=$value?>">
                                        <?=system_showText(LANG_SITEMGR_EDIT)?>
                                    </a>
                                 </td>
                            </tr>
                            <?
                            }
                            ?>
                </table>
                
               
                <? } ?>

                <?// Classified 
                if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
                ?>
                <table class="table-itemlist">
                    <tr>
                            <th><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?></th>
                            <th width="60px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                        </tr>
                        <?
                        foreach ($classifiedlevelValue as $value) {
                        ?>
                        <tr>
                            <td>
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=classified&value=<?=$value?>">
                                    <?=$classifiedlevelObj->showLevel($value)?>
                                </a>
                            </td>
                            <td nowrap class="main-options">
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=classified&value=<?=$value?>">
                                    <?=system_showText(LANG_SITEMGR_EDIT)?>
                                </a>
                            </td>
                        </tr>
                        <?
                        }
                        ?>
                </table>
                
                
                <? } ?>

                <?// Article 
                if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
                ?>
                <table class="table-itemlist">
                    <tr>
                        <th><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE))?></th>
                        <th width="60px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    </tr>
                    <?
                    foreach ($articlelevelValue as $value) {
                    ?>
                    <tr>
                        <td>
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=article&value=<?=$value?>">
                                <?=$articlelevelObj->showLevel($value)?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=article&value=<?=$value?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
                
              
                <? } ?>

                <?// Banner 
                if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
                ?>
                <table class="table-itemlist">
                    <tr>
                        <th><?=string_ucwords(system_showText(LANG_SITEMGR_BANNER))?></th>
                        <th width="60px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    </tr>
                    <?
                    foreach ($bannerlevelValue as $value) {
                    ?>
                    <tr>
                        <td>
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=banner&value=<?=$value?>">
                                <?=$bannerlevelObj->showLevel($value)?>
                            </a>
                        </td>
                        <td nowrap class="main-options">
                           <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/contentlevel.php?section=banner&value=<?=$value?>">
                                <?=system_showText(LANG_SITEMGR_EDIT)?>
                            </a>
                           
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
                
               
                <? } ?>

            </div>

        </div>

        <div id="bottom-content">&nbsp;</div>

    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>