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
	# * FILE: /theme/default/layout/usernavbar.php
	# ----------------------------------------------------------------------------------------------------

?>

    <!--cachemarkerUserNavbar-->

<?

    system_increaseVisit(db_formatString($_SERVER["REMOTE_ADDR"]));

    if (sess_getAccountIdFromSession()) {
        
        $dbObjUser = db_getDBObJect(DEFAULT_DB, true);
        $sqlUser = "SELECT C.first_name,
                                C.last_name,
                                A.has_profile,
                                A.is_sponsor,
                                P.friendly_url,
                                P.nickname
                            FROM Contact C
                            LEFT JOIN Account A ON (C.account_id = A.id)
                            LEFT JOIN Profile P ON (P.account_id = A.id)
                        WHERE A.id = ".sess_getAccountIdFromSession();
        $resultUser = $dbObjUser->query($sqlUser);
        $rowUser = mysql_fetch_assoc($resultUser);
                
    }
    
    if (SOCIALNETWORK_FEATURE == "on") { ?>
    
        <ul class="nav pull-right">
            
            <? if (sess_getAccountIdFromSession()) { ?>

                <li class="dropdown">
                    
                    <a href="javascript:void(0);" class="sign-up dropdown-toggle" data-toggle="dropdown">
                        <i class="i-profile"></i><b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                        
                        <li class="nav-header">
                            <?=system_showText(LANG_LABEL_WELCOME)." ".($rowUser["has_profile"] == "y" && $rowUser["is_sponsor"] == "n" && trim($rowUser["nickname"]) ? $rowUser["nickname"] : $rowUser["first_name"]." ".$rowUser["last_name"]);?>!
                        </li>
                        
                        <li class="divider"></li>
                        
                        <li>
                            <a href="<?=($rowUser["is_sponsor"] == "y" ? ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS : SOCIALNETWORK_URL)?>/"><?=($rowUser["is_sponsor"] == "y" ? system_showText(LANG_MEMBERS_DASHBOARD) : system_showText(LANG_LABEL_PROFILE))?></a>
                        </li>
                                                  
                        <? if ($rowUser["is_sponsor"] == "y") { ?>
                        <li>
                            <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                        </li>
                        <? } ?>

                        <li>
                            <a href="<?=SOCIALNETWORK_URL?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                        </li>
                        
                    </ul>
                    
                </li>

            <? } else { ?>
                
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], SOCIALNETWORK_FEATURE_NAME."/login.php") !== false || string_strpos($_SERVER["PHP_SELF"], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false ? "menuActived" : "")?>">
                    <a href="<?=SOCIALNETWORK_URL;?>/login.php" class="sign-up"><?=system_showText(LANG_MENU_SIGNUPLOGIN)?></a>
                </li>
                
            <? } ?>
        </ul>
    
   <? } else { ?>
    
        <ul class="nav pull-right">
        
        <? if (sess_getAccountIdFromSession()) { ?>
                
           <li class="dropdown">

                <a href="javascript:void(0);" class="sign-up dropdown-toggle" data-toggle="dropdown">
                    <i class="i-profile"></i><b class="caret"></b>
                </a>

                <ul class="dropdown-menu">

                    <li class="nav-header">
                        <?=system_showText(LANG_LABEL_WELCOME)." ".($rowUser["first_name"]." ".$rowUser["last_name"]);?>!
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD);?></a>
                    </li>

                    <li>
                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                    </li>
                        
                    <li>
                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                    </li>

                </ul>

            </li>

        <? } else { ?>	

            <li>
                <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/login.php" class="sign-up"><?=system_showText(LANG_MENU_SIGNUPLOGIN)?></a>
            </li>

        <? } ?>

        </ul>
    
  <?  } ?>

    <!--cachemarkerUserNavbar-->