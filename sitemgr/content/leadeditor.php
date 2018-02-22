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
    # * FILE: /sitemgr/content/leadeditor.php
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
    
    if (!THEME_ENQUIRE_PAGE) exit;

	//increases frequently actions
	system_setFreqActions('content_leadeditor', 'content');
    
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/leadeditor.php");
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
    <script language="javascript" type="text/javascript">

        $(function(){
            $('#form-builder').formbuilder({
                'save_url': '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/leadeditor.php?action=save&domain_id=".SELECTED_DOMAIN_ID?>',
                'load_url': '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/leadeditor.php?action=load&domain_id=".SELECTED_DOMAIN_ID?>'
            });

            $(function() {
                $("#form-builder ul").sortable({ opacity: 0.6, cursor: 'move'});
            });
        });

    </script>

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT)?> - <?=system_showText(LANG_SITEMGR_LEADS_EDITOR);?></h1>
			</div>
		</div>

		<div id="content-content">

			<div class="default-margin">
                
                <? 
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); 
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); 
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); 
                
                include(INCLUDES_DIR."/tables/table_content_submenu.php"); 
                ?>
                
                <p><?=system_showText(LANG_SITEMGR_LEADS_TIP1)?></p>
                <p style="padding-bottom: 10px;"><?=system_showText(LANG_SITEMGR_LEADS_TIP2)?></p>
                
                <p id="successMessage" class="successMessage" style="display:none;"><?=system_showText(LANG_SITEMGR_LEADS_SUCCESS)?></p>
                
                <input type="hidden" name="domain_url" id="domain_url" value="<?=$domainURL?>" />
                <input type="hidden" name="livemode" id="livemode" value="<?=(DEMO_LIVE_MODE ? 1 : 0)?>" />
                <input type="hidden" name="livemode_msg" id="livemode_msg" value="<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);?>" />
                
                <div id="form-builder" class="form-builder"></div>

			</div>
            
		</div>
        
	</div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>