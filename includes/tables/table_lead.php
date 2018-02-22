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
	# * FILE: /includes/tables/table_lead.php
	# ---------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_lead[$message])) { ?>
        <p class="successMessage"><?=$msg_lead[$message]?></p>
	<? } elseif ($errorMessage) { ?>
        <p class="errorMessage"><?=$errorMessage;?></p>
    <? } ?>
        
	<table class="table-itemlist">
        
		<tr>
			<th>
                <span><?=system_showText(LANG_LABEL_FROM);?></span>
            </th>
            
            <? if (!$item_id) { ?>
			<th>
                <span><?=system_showText(LANG_LABEL_FOR);?></span>
            </th>
            <? } ?>
            
			<th>
                <span><?=string_ucwords(system_showText(LANG_LABEL_SUBJECT));?></span>
            </th>
            
            <th>
                <span><?=string_ucwords(system_showText(LANG_LABEL_CREATED));?></span>
            </th>
                            
            <th>
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </th>
            
		</tr>

		<?
        $url_aux = (string_strpos($url_base, "/".SITEMGR_ALIAS)) ? "".SITEMGR_ALIAS : "".MEMBERS_ALIAS;
        
        if ($leadsArr) foreach($leadsArr as $each_lead) {
            
            $auxMessage = @unserialize($each_lead["message"]);
            if (is_array($auxMessage)) {
                $each_lead["message"] = "";
                foreach ($auxMessage as $key => $value) {
                    $each_lead["message"] .= (defined($key) ? constant($key) : $key).($value ? ": ".$value : "")."\n";
                }
            }
            
            if (!$item_id) {
                
                $labelFor = "";
                if ($each_lead["type"] == "general") {
                    $labelFor = "<span>".system_showText(LANG_GENERAL_LEAD)."</span>";
                } else {
                    
                    if ($each_lead["type"] == "listing") {
                        $aux_itemObj = new Listing($each_lead["item_id"]);
                        $itemPath = LISTING_FEATURE_FOLDER;
                    } elseif ($each_lead["type"] == "classified") {
                        $aux_itemObj = new Classified($each_lead["item_id"]);
                        $itemPath = CLASSIFIED_FEATURE_FOLDER;
                    } elseif ($each_lead["type"] == "event") {
                        $aux_itemObj = new Event($each_lead["item_id"]);
                        $itemPath = EVENT_FEATURE_FOLDER;
                    }
                    
                    if (is_object($aux_itemObj) && $aux_itemObj->getNumber("id")) {
                        $titleStr = $aux_itemObj->getString("title");
                        $labelFor = "<a href=\"".$url_base."/".$itemPath."/view.php?id=".$each_lead["item_id"]."\">".$aux_itemObj->getString("title")."</a>";
                    } else {
                        $titleStr = "";
                        $labelFor = "<span>".system_showText(LANG_GENERAL_LEAD)."</span>";
                    }
                }
                
            }
            
            $iconReplyForward = "";
            if ($each_lead["reply_date"] != "0000-00-00 00:00:00" && $each_lead["forward_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-reply-forward";
                $titleIco = system_showText(LANG_LEAD_REPLIED_FORWARDED_ICO);
                $titleIco = str_replace("[dater]", " (".format_date($each_lead["reply_date"], DEFAULT_DATE_FORMAT, "datestring").")", $titleIco);
                $titleIco = str_replace("[datef]", " (".format_date($each_lead["forward_date"], DEFAULT_DATE_FORMAT, "datestring").")", $titleIco);
            } elseif ($each_lead["reply_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-reply";
                $titleIco = system_showText(LANG_LEAD_REPLIED_ICO)." (".format_date($each_lead["reply_date"], DEFAULT_DATE_FORMAT, "datestring").")";
            } elseif ($each_lead["forward_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-forward";
                $titleIco = system_showText(LANG_LEAD_FORWARDED_ICO)." (".format_date($each_lead["forward_date"], DEFAULT_DATE_FORMAT, "datestring").")";
            }
            ?>

			<tr id="leadTR<?=$each_lead["id"];?>">
                <td>
                    
                    <? if ($iconReplyForward) { ?>
                        <img src="<?=DEFAULT_URL."/images/$iconReplyForward.png"?>" title="<?=$titleIco;?>" />
                    <? } ?>
                    
                    <? if ($each_lead["member_id"] && string_strpos($url_base, "/".SITEMGR_ALIAS)) {
                        $contact = db_getFromDB("contact", "account_id", db_formatNumber($each_lead["member_id"]));
                        
                        if ($contact->getNumber("account_id")) { ?>
                    
                            <a title="<?=$contact->getString("first_name")." ".$contact->getString("last_name");?>" href="<?=$url_base?>/account/view.php?id=<?=$each_lead["member_id"]?>">
                                <?=system_showTruncatedText($contact->getString("first_name")." ".$contact->getString("last_name"), 25);?>
                            </a>
                    
                        <? } else { ?>
                    
                            <span><?=$each_lead["first_name"].($each_lead["last_name"] ? " ".$each_lead["last_name"] : "");?></span>
                            
                        <? } ?>
                            
                    <? } else { ?>
                            
                        <span><?=$each_lead["first_name"].($each_lead["last_name"] ? " ".$each_lead["last_name"] : "");?></span>
                        
                    <? } ?>
                </td>
                    
                <? if (!$item_id) { ?>
                
                    <td><?=$labelFor;?></td>
                    
                <? } ?>
                
                <td><?=$each_lead["subject"];?></td>
                               
                <td><?=format_date($each_lead["entered"], DEFAULT_DATE_FORMAT, "datestring");?></td>
                                               
				<td nowrap class="main-options">
					<a href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'view');"><?=system_showText(LANG_LABEL_VIEW)?></a>
					<? if (string_strpos($url_base, "/".SITEMGR_ALIAS)) { ?>
                    <b>|</b>
                    <a href="javascript:void(0)" onclick="dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', <?=$each_lead["id"]?>, 'Lead_post', '170', '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');"><?=system_showText(LANG_LABEL_DELETE)?></a>
                    <? } ?>
				</td>
                
			</tr>
            
            <tr id="viewTR<?=$each_lead["id"];?>" class="hideForm " style="display:none">
                <td colspan="6" id="viewTD<?=$each_lead["id"];?>" class="innerTable">
                    <div class="view-lead">
                        <h5>
                            <strong><?=$each_lead["subject"];?></strong>
                            <a href="javascript:void(0);" onclick="hideLead(<?=$each_lead["id"];?>, 'view');"> x </a>
                        </h5>
                        
                        <div class="lead-message" id="view_lead_<?=$each_lead["id"];?>">
                            <p><?=nl2br($each_lead["message"]);?></p>
                        </div>

                        <div class="text-options">
                            
                            <a id="linkreply<?=$each_lead["id"];?>" href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'reply');"><?=system_showText(LANG_LABEL_REPLY)?></a>
                            
                            <? if (string_strpos($url_base, "/".SITEMGR_ALIAS)) { ?>
                                | <a id="linkforward<?=$each_lead["id"];?>"  href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'forward');"><?=system_showText(LANG_LABEL_FORWARD)?></a>
                            <? } ?>
                                
                        </div>

                        <div id="reply_lead_<?=$each_lead["id"];?>" style="display:none" class="view-lead-action">
                            
                            <form name="formReply" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                                
                                <input type="hidden" name="item_id" value="<?=$item_id;?>" />
                                <input type="hidden" name="item_type" value="<?=$item_type;?>" />
                                <input type="hidden" name="type" value="<?=$item_type;?>" />
                                <input type="hidden" name="idLead" value="<?=$each_lead["id"];?>" />
                                <input type="hidden" name="screen" value="<?=$screen;?>" /> 
                                <input type="hidden" name="letter" value="<?=$letter;?>" />
                                <input type="hidden" name="action" value="reply" />
                                
                                <label>
                                    <p><?=system_showText(LANG_LABEL_TO);?>: </p>
                                    <input type="email" name="to" value="<?=($to && $action == "reply" && $idLead == $each_lead["id"] ? $to : $each_lead["email"]);?>" />
                                </label>
                                
                                <label>
                                    <p><?=system_showText(LANG_LABEL_MESSAGE);?>:</p>
                                    <textarea name="message" rows="5"><?=($message && $action == "reply" && $idLead == $each_lead["id"] ? $message : "");?></textarea>
                                </label>
                                
                                <div class="admin-actions">
                                    <button type="submit" name="submit" value="Submit" class="admin-btn"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                    <button type="reset"  name="cancel" value="Cancel" class="admin-btn" onclick="hideLead(<?=$each_lead["id"];?>, 'reply');"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                </div>
                                
                            </form>
                            
                        </div>
                        
                        <? if (string_strpos($url_base, "/".SITEMGR_ALIAS)) { ?>
                    
                        <div id="forward_lead_<?=$each_lead["id"];?>" style="display:none" class="view-lead-action">    
                            
                            <form name="formForward" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                                
                                <input type="hidden" name="item_id" value="<?=$item_id;?>" />
                                <input type="hidden" name="item_type" value="<?=$item_type;?>" />
                                <input type="hidden" name="idLead" value="<?=$each_lead["id"];?>" />
                                <input type="hidden" name="screen" value="<?=$screen;?>" /> 
                                <input type="hidden" name="letter" value="<?=$letter;?>" />
                                <input type="hidden" name="action" value="forward" />
                                
                                <label>
                                    <p><?=system_showText(LANG_LABEL_TO);?>: </p>
                                    <input type="email" name="to" value="<?=($to && $action == "forward" && $idLead == $each_lead["id"] ? $to : "");?>" />
                                </label>
                                
                                <label>
                                    <p><?=system_showText(LANG_LABEL_MESSAGE);?>:</p>
                                    <textarea name="message" rows="5"><?=($message && $action == "forward" && $idLead == $each_lead["id"] ? $message : $each_lead["message"]);?></textarea>
                                </label>
                                
                                <div class="admin-actions">
                                    <button type="submit" name="submit" value="Submit" class="admin-btn"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                    <button type="reset"  name="cancel" value="Cancel" class="admin-btn" onclick="hideLead(<?=$each_lead["id"];?>, 'forward');"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                </div>  
                                
                            </form>
                            
                        </div>
                        
                        <? } ?>
                    </div>
                </td>
            </tr>
            
            <tr></tr>

		<? } ?>
	</table>

    <script type="text/javascript">

        var thisForm = "";
        var thisId = "";

        function showLead(idIn, type) {

            thisForm = type;
            thisId = idIn;

            if (type == "view") {

                hideAllLeads();

                $(".errorMessage").css("display", "none");
                $("#"+type+"TR"+idIn).css("display", "");
                $("#"+type+"TR"+idIn).addClass("active");
                $("#leadTR"+idIn).addClass("active");
                $("#view_lead_"+idIn).css("display", "");
                $("#reply_lead_"+idIn).css("display", "none");
                $("#forward_lead_"+idIn).css("display", "none");
                
                $("#linkreply"+idIn).removeClass("active");
                $("#linkforward"+idIn).removeClass("active");

                if (document.getElementById("dropdownDomain")) {
                    document.getElementById("dropdownDomain").disabled = true;
                }

            } else {
                if (type == "forward") {
                    $("#view_lead_"+idIn).css("display", "none");
                } else {
                    $("#view_lead_"+idIn).css("display", "");
                }
                $("#reply_lead_"+idIn).css("display", "none");
                $("#forward_lead_"+idIn).css("display", "none");
                $("#"+type+"_lead_"+idIn).css("display", "");
                
                $("#linkreply"+idIn).removeClass("active");
                $("#linkforward"+idIn).removeClass("active");
                $("#link"+type+idIn).addClass("active");
            }
        }

        function hideLead(idIn, type) {

            if (type == "view") {

                $("#"+type+"TR"+idIn).css("display", "none");
                $("#leadTR"+idIn).removeClass("active");
                $(".errorMessage").css("display", "none");

                if (document.getElementById("dropdownDomain")) {
                    document.getElementById("dropdownDomain").disabled = false;
                }

            } else {

                $("#view_lead_"+idIn).css("display", "");
                $("#"+type+"_lead_"+idIn).css("display", "none");
                $("#link"+type+idIn).removeClass("active");

            }
        }

        function hideAllLeads() {
        <? if ($leadsArr) foreach($leadsArr as $each_lead) { ?>
            $("#viewTR"+<?=$each_lead["id"];?>).css("display", "none");
            $("#viewTR"+<?=$each_lead["id"];?>).removeClass("active");
            $("#leadTR"+<?=$each_lead["id"];?>).removeClass("active");
        <? } ?>
        }    

    </script>