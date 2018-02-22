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
    # * FILE: /includes/forms/form_searchverify.php
    # ----------------------------------------------------------------------------------------------------

?>
    
    <p>
        <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP1)?><br />
        <?=system_showText(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP2))?><br />
        <br ><a href="https://www.google.com/webmasters/tools/dashboard" target="blank"><?=system_showText(LANG_SITEMGR_SEARCHMETATAGS_GOOGLE)?></a>
        <br /><a href="http://www.bing.com/toolbox/webmaster" target="blank"><?=system_showText(LANG_SITEMGR_SEARCHMETATAGS_LIVE)?></a>
    </p><br />
    
    <?
    if ($error) 
        echo "<p class=\"errorMessage\">".$error."</p>";
    else if ($success)
        echo "<p class=\"successMessage\">".$msg_success."</p>";
    unset($error);
    ?>
    
    <div class="header-form">
        <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLE))?>
    </div>
    
    <br />
    
    <table class="standard-table">

    <tr class="tr-form">
        <th align="right" class="td-form" style="padding-bottom:20px;">
            <div class="label-form">
                <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLETAG)?>:
            </div>
        </th>
        <td align="left" class="td-form">
            <input type="text" name="google_tag" value="<?=string_htmlentities($google_tag)?>" class="input-form-adminemail" />
            <span><?=string_htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE1))?></span>
        </td>
    </tr>

    </table>
    
    <br />
    
    <div class="header-form">
        <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVE))?>
    </div>
    
    <br />
    
    <table cellpadding="2" cellspacing="0" border="0" class="standard-table">

    <tr class="tr-form">
        <th align="right" class="td-form" style="padding-bottom:20px;">
            <div class="label-form">
                <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVETAG)?>:
            </div>
        </th>
        <td align="left" class="td-form">
            <input type="text" name="live_tag" value="<?=string_htmlentities($live_tag)?>" class="input-form-adminemail" />
            <span><?=string_htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE3))?></span>
        </td>
    </tr>
    
    </table>
    
    <br />
    
    <table style="margin: 0 auto 0 auto;">
        <tr>
            <td>
                <button type="submit" name="searchmetatag" value="Submit" class="input-button-form" ><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
            </td>
        </tr>
    </table>
    
    <br />