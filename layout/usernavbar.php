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
	# * FILE: /layout/usernavbar.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerUserNavbar-->

	<div id="user-navbar">

		<div class="wrapper">
        
			<ul class="user-options">
                
				<? if (SOCIALNETWORK_FEATURE == "on") {
						$aux_show_logoff = false;
						if (sess_getAccountIdFromSession()) {
							$dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
							$sqlWelcome = "SELECT C.first_name,
												  C.last_name,
												  A.has_profile,
												  A.is_sponsor,
												  P.friendly_url,
												  P.nickname
											 FROM Contact C
												LEFT JOIN Account A ON (C.account_id = A.id)
												LEFT JOIN Profile P ON (P.account_id = A.id)
										   WHERE A.id = ".sess_getAccountIdFromSession();

							$resultWelcome = $dbObjWelcome->query($sqlWelcome);
							$contactWelcome = mysql_fetch_assoc($resultWelcome);

							if ($contactWelcome["has_profile"] == "y" && $contactWelcome["is_sponsor"] == "n") { ?>
								<li>
                                    <a href="<?=SOCIALNETWORK_URL?>/"><?=system_showTruncatedText((trim($contactWelcome["nickname"]) ? $contactWelcome["nickname"] : LANG_LABEL_PROFILE), 20)?></a>
                                </li>
							<? } 

							$aux_show_logoff = true;

							if ($contactWelcome["is_sponsor"] == "y") { ?>
                                <li>
                                    <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showTruncatedText($contactWelcome["first_name"]." ".$contactWelcome["last_name"], 20)?></a>
                                </li>
                                
                                <li>
                                    <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MANAGE_CONTENT);?></a>
                                </li>
                            <? }
	                        
						} else { ?>
                            <li>
                                <a href="<?=SOCIALNETWORK_URL;?>/add.php" class="sign-up"><?=system_showText(LANG_JOIN_PROFILE)?></a>
                            </li>
                            <li>
                                <a rel="nofollow" href="<?=DEFAULT_URL."/popup/popup.php?pop_type=profile_login"?>" class="fancy_window_iframe"><?=system_showText(LANG_BUTTON_LOGIN)?></a>
                            </li>
						<? }

						if ($aux_show_logoff) {
							if (!empty($_SESSION[SM_LOGGEDIN])) { ?>
                            
								<script language="javascript" type="text/javascript">
									//<![CDATA[
									function sitemgrSection() {
										location = "<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/sitemgraccess.php?logout";
									}
									$('#demo_mode_sitemgr').css("display", "none");
									//]]>
								</script>
                                
								<li>
                                    <a href="javascript:sitemgrSection();"><?=system_showText(LANG_LABEL_SITEMGR_SECTION);?></a>
                                </li>
                                
							<? } ?>
							<li>
                                <a href="<?=SOCIALNETWORK_URL?>/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                            </li>
						<? }  
				} else {
                    if (sess_getAccountIdFromSession()) { ?>
						<li>
                            <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD);?></a>
                        </li>

                        <li>
                            <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                        </li>

                        <li>
                            <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                        </li>
					<? } else { ?>	
						<li>
                            <a rel="nofollow" href="<?=DEFAULT_URL."/popup/popup.php?pop_type=profile_login"?>" class="fancy_window_iframe"><?=system_showText(LANG_BUTTON_LOGIN)?></a>
                        </li>
					<? } ?>	
				<? } ?>
			</ul>

			<? system_increaseVisit(db_formatString(getenv("REMOTE_ADDR"))); ?>

		</div>
	</div>
	
	<!--cachemarkerUserNavbar-->