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
    # * FILE: /members/listing/listinglevel.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();

    extract($_GET);
    extract($_POST);

    $url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
    $url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
    $members = 1;

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    

    if ($id) {
        $listing = new Listing($id);
        if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
            exit;
        }
        $listing->extract();
    }

    extract($_POST);
    extract($_GET);

    $levelObj = new ListingLevel();
    if ($level) {
        $levelArray[$levelObj->getLevel($level)] = $level;
    } else {
        $levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (($id) && ($listing)) {
            if ($_POST["level"] && ($_POST["level"] != $listing->getNumber("level"))) {
                $status = new ItemStatus();
                $listing->setString("status", $status->getDefaultStatus());
                $listing->setDate("renewal_date", "00/00/0000");
            }
            $listing->setString("level", $_POST["level"]);
            $listing->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
            $listing->Save();
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
            exit;
        } else {
            
            /*
             * Check if exists package
             */
            $packageObj = new Package();
            $array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "listing", $_POST["level"]);
            if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {
                header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/order_package.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
            }else{
                header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
            }
            exit;
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>
        <section>
         <div class="container">  
           <div class="thumbnail listingthumbnail lisingthumbnail1">  
            <? if( EDIR_THEME==='review'){ $closingTag = '</div></div>';?>
               <div class="row">
                        <div class="col-sm-5 col-sm-offset-1 steps-width">
                            <div class="heading-banner heading-banner1">
                                <h4><?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <?=string_strtoupper(system_showText(LANG_THREESTEPS))?></h4>
                            </div><!--/heading-banner-->
                        </div><!--/col-sm-5-->
               </div>
            
               <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                 <div class="pWrapper">
                     
               <?  if($no>60){ ?>    
                   <div class="row">
                <ul class="standardStep steps-3 claim-listing">
                   <!--  <li class="steps-ui stepActived stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
                    <li class="steps-ui"><span>2</span>&nbsp;<?=system_showText(LANG_CHECKOUT);?></li>
                    <li class="steps-ui"><span>1</span>&nbsp;<?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li> -->
                                        <li class="list col-sm-3 gap">
                                            <span>1</span> &nbsp; <?=system_showText(LANG_ADVERTISE_IDENTIFICATION)?>
                                        </li>

                                        <li class="list col-sm-3 active-width gap">
                                            <span>2</span> &nbsp; <?=system_showText(LANG_ADVERTISE_CONFIRMATION)?>

                                        </li>

                                        <li class="list col-sm-3 active checkout-width gap">
                                            <span>3</span> &nbsp; <?=system_showText(LANG_CHECKOUT)?>
                                        </li>
                </ul>
            </div>
               <? }
               else {?>
                     <div class="row">
                <ul class="standardStep steps-3 claim-listing">
                   <!--  <li class="steps-ui stepActived stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
                    <li class="steps-ui"><span>2</span>&nbsp;<?=system_showText(LANG_CHECKOUT);?></li>
                    <li class="steps-ui"><span>1</span>&nbsp;<?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li> -->
                                        <li class="list col-sm-3 gap">
                                            <span>1</span> &nbsp; <?=system_showText(LANG_ADVERTISE_IDENTIFICATION)?>
                                        </li>

                                        <li class="list col-sm-3 active active-width gap">
                                            <span>2</span> &nbsp; <?=system_showText(LANG_ADVERTISE_CONFIRMATION)?>

                                        </li>

                                        <li class="list col-sm-3 checkout-width gap">
                                            <span>3</span> &nbsp; <?=system_showText(LANG_CHECKOUT)?>
                                        </li>
                </ul>
            </div>
                     
               <?} ?>      
        <? } else { $closingTag = '</div>';?>
            <div>
        <? } ?>
        
    </section>

    <div class="container">

        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        
        if ($id) {
            $contentObj = new Content();
            $content = $contentObj->retrieveContentByType("Listing Change Level");
            if ($content) {
                echo "<blockquote>";
                    echo "<div class=\"dynamicContent\">".$content."</div>";
                echo "</blockquote>";
            }
        }
        ?>

        <form name="listinglevel" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>" />
            <? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>
        </form>

        <form action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" method="get">

            <div class="baseButtons">

                <p class="standardButton">
                    <button type="button" onclick="document.listinglevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
                </p>
                <p class="standardButton">
                    <button type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
                </p>

            </div>

        </form>

    </div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
