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
	# * FILE: /includes/forms/form_account.php
	# ----------------------------------------------------------------------------------------------------

	$readonly = "";
	if (DEMO_LIVE_MODE && ($username == "demo@demodirectory.com")) { $readonly = "readonly"; }
	    
    $isForeignAcc = false;
    if ((string_strpos($username, "facebook::") !== false || string_strpos($username, "google::") !== false)) {
        $isForeignAcc = true;
    }

?>

    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

    <table id="account_info" border="0" cellpadding="2" cellspacing="0" class="standard-table noMargin">

        <? if ((string_strpos($username, "facebook::") === false && string_strpos($username, "google::") === false)) { ?>

            <tr>
                <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></th>
            </tr>

            <tr>
                <th <?=((($id || $account_id) && $isForeignAcc) ? "" : "class=\"alignTop alignWithField\"");?>>* <?=system_showText(LANG_LABEL_USERNAME)?>:</th>
                <td>
                    <? if (($id || $account_id) && $isForeignAcc) { ?>
                    
                        <input type="hidden" name="username" value="<?=$username?>" />
                        <?=system_showAccountUserName($username);?>
                        <span><?=system_showAccountMessage($username);?></span>
                        
                    <? } else { ?>
                        
                        <input type="text" name="username" <?=($profileAdd ? "id=\"username\"" : "")?> value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'members', <?=($accountID ? $accountID : 0);?>); populateField(this.value,'email');"/>
                        <span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
                        <div id="checkUsername">&nbsp;</div>
                        
                    <? } ?>
                </td>
            </tr>

        <? } else { ?>

            <input type="hidden" name="username" value="<?=$username?>" />

        <? } ?>

        <? if (!$isForeignAcc) { ?>

            <tr>
                <th class="alignTop alignWithField">* <?=system_showText(constant("LANG_LABEL_".(string_strpos($_SERVER["PHP_SELF"], "add")?("CREATE_"):"NEW_")."PASSWORD"))?>:</th>
                <td>
                    <input type="text" name="password" class="input-form-account" <?=$readonly?> value="<?=($autopw) ? system_generatePassword() : "";?>" />
                    <span><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
                </td>
            </tr>
            

        <? } ?>

    </table>