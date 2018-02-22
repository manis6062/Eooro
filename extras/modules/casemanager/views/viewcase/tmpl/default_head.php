<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
//echo 'working!!';
//print_r( $this->caseDetails );
?><link rel="stylesheet" href="<?=MODULES_REQ.'/casemanager/views/viewcase/tmpl/style.css'?>" />
<div class="content-custom">
    You can view all your case Details in this page.
</div>
<div class="row-fluid responsive">
    <?php 
//        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
//        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
//        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
    ?>
    <div class="span4 responsive-menu">
        <? //include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php"); ?>
        <div class="responsive-scrollmenu">
            <div class="scroll-content">
                <div class="webitem active">
                    <div class="desc">
                        <p class="title">
                            <b><?='Details of Review:'?></b>
                        </p>
                        <p class="simple">
                            <?=ucwords($this->caseDetails['review_title']);?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="addcontent">
            <p>Add some new contents.</p>

            <ul>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_LISTING_FEATURE_NAME);?></a>
                </li>

                <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_BANNER_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_EVENT_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_ARTICLE_FEATURE_NAME);?></a>
                </li>
                <? } ?>
            </ul>

            <? if ($content) { ?>
                <div class="content-custom"><?=$content?></div>
            <? } ?>

        </div>
    </div>
    <div id="dashboard" class="span8 responsive-dashboard">
        <div class="dashboard"> <!-- view_member_dashboard -->