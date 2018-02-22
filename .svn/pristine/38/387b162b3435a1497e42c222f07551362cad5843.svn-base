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
	# * FILE: /includes/tables/table_account.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_account[$message])) { ?>

	<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
		<tr class="tr-subtitle-table">
			<td align="center">
				<p class="successMessage"><?=$msg_account[$message]?></p>
			</td>
		</tr>
	</table>

    <? } ?>

    <script language="javascript" type="text/javascript">
        function accountLogin(action, username) {
            var url = "";
            if (action == 'profile' || action == 'edit_profile') {
                url = "<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/<?=MEMBERS_ALIAS?>/sitemgraccess.php?account=" + username + "&action=" + action;
            } else {
                url = "<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/<?=MEMBERS_ALIAS?>/sitemgraccess.php?account=" + username + "";
            }
            membersection = window.open(url, "member_section");
            membersection.focus();
        }
    </script>

    <table class="table-itemlist">

        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LASTLOGIN)?>
            </th>
            <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>
                </th>
            <? } ?>
            <th></th>
            <th nowrap="nowrap" style="width: 100px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
        </tr>
        
        <? foreach($accounts as $account) { ?>
            <? $id = $account->getNumber("id"); ?>
            <tr>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/view.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$account->getString("username")?>">
                        <?=system_showAccountUserName($account->getString("username"));?>
                    </a>
                </td>
                
                <td nowrap>
                    <? if ($account->getNumber("lastlogin") != 0) {
                        $lastLogin_field = format_date($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($account->getNumber("lastlogin"));
                    } else $lastLogin_field = system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT); ?>
                    <span title="<?=$lastLogin_field?>" style="cursor:default"><?=$lastLogin_field;?></span>
                </td>
                
                <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                    <td nowrap>
                        <? if ($account->getString("is_sponsor") == "y") { ?>
                            <?=system_showText(LANG_SITEMGR_SECTION_SPONSOR);?>
                        <? } else if ($account->getString("is_sponsor") == "n" && $account->getString("has_profile") == "y") { ?>
                            <?=system_showText(LANG_SITEMGR_LABEL_MEMBER);?>
                        <? } ?>
                    </td>
                <? } ?>
                    
                <td nowrap="nowrap">
                    <div class="toolbar-icons-button">
                        <div class="toolbar-icons">
                            <ul>
                                <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                                <li>
                                    <? if ($account->getString("has_profile") == 'y') { ?>
                                        <a href="javascript:accountLogin('profile', '<?=$account->getString("username")?>');">
                                            <?=system_showText(LANG_SITEMGR_VIEW_USER_PROFILE)?>
                                        </a>
                                    <? } else {
                                        echo system_showText(LANG_SITEMGR_PROFILE_DISABLED);
                                    } ?>
                                </li>
                                <? } ?>

                                <li>
                                    <a href="javascript:accountLogin(<?=($account->getString("is_sponsor") == 'n' ? "'edit_profile'" : "''")?>, '<?=$account->getString("username")?>');">
                                        <?=system_showText(LANG_SITEMGR_LOGIN)?> <?=system_showText(LANG_SITEMGR_INTOTHISACCOUNT)?>
                                    </a> 
                                </li>
                                
                                <li>
                                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/forgot.php?id=<?=$id?>">
                                        <?=(system_showText(LANG_LABEL_RESET_PASSWORD))?>
                                    </a>
                                </li>

                                <? if (!DEMO_LIVE_MODE || ($account->getString("username") != "demo@demodirectory.com")) { ?>
                                    <li>
                                        <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>
                                        </a>
                                    </li>
                                <? } ?>
                            </ul>
                        </div>
                        <div class="toolbararrow"></div>
                    </div>

                </td>
                
                <td nowrap="nowrap" class="main-options">

                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=(system_showText(LANG_SITEMGR_VIEW))?>
                    </a>
                    <b>|</b>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/account.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(LANG_SITEMGR_EDIT)?>
                    </a>
                </td>
                
            </tr>
        <? } ?>

    </table>