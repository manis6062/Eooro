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
	# * FILE: /includes/tables/table_import.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script type="text/javascript">
        function JS_openDetail(id) {
            document.getElementById('log_'+id).style.display = '';
            document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_close.gif" onclick="JS_closeDetail('+id+');" />'
        }
        function JS_closeDetail(id) {
            document.getElementById('log_'+id).style.display = 'none';
            document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('+id+');" />'
        }
    </script>

    <? if ($message) { ?>
        <p class="successMessage"><?=$message?></p>
    <? } ?>

    <tr>
        <td>
            <div id="img_<?=$import->getNumber("id");?>">
                <img style="cursor: pointer;" src="<?=DEFAULT_URL?>/images/content/<?=($log_id == $import->getNumber("id") ? "img_close.gif" : "img_open.gif")?>" onclick="<?=($log_id == $import->getNumber("id") ? "JS_closeDetail" : "JS_openDetail")?>('<?=$import->getNumber("id");?>');" />
            </div>
        </td>
        <td>
            <?=format_date($import->getString("date"))?>&nbsp; - <?=format_getTimeString($import->getNumber("time"))?>
        </td>
        <td>
            <fieldset title="<?=$import->getString("filename");?>">
                <?=$import->getString("filename", true, 23);?>
            </fieldset>
        </td>
        <td id="total_lines_<?=(int)$import->getNumber("id")?>">
            <?=(int)$import->getNumber("totallines")?>
        </td>
        <td id="error_lines_<?=(int)$import->getNumber("id")?>">
            <?=(int)$import->getNumber("errorlines")?>
        </td>
        <td id="progress_added_<?=(int)$import->getNumber("id")?>">
            <?=(int)$import->getNumber("linesadded")?>
        </td>
        <td id="tdprogress_<?=$import->getNumber("id")?>">
            <?
            $status = new ImportStatus();
            if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"> - <span id=\"progress_".$import->getNumber("id")."\">".$import->getString("progress")."</span></span>";
            else if ($import->getString("action") == "NR") echo $status->getStatusWithStyle("WR", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            else if ($import->getString("status") == "P" && $import->getString("action") == "RI") echo $status->getStatusWithStyle("Q", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            else if ($import->getString("status") == "P" && $import->getString("action") == "NC") echo $status->getStatusWithStyle("Q2", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            else if ($import->getString("status") == "P" && $import->getString("action") == "C") echo $status->getStatusWithStyle("U", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            else if ($import->getString("status") == "P" && $import->getString("action") == "NA") echo $status->getStatusWithStyle("PA", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            else echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
            ?>
        </td>
        <td nowrap>
            
            <div class="toolbar-icons-button">
                            
                <div class="toolbar-icons">
                    
                    <ul>
            
                        <? if ((($import->getString("status") == "F") || ($import->getString("status") == "S")) && ($import->getString("action") != "NR")) {
                            $onclick_rollback = "linkRedirect('rollback.php?import_type=$importType&id=".$import->getNumber("id")."');";
                            $cursor_rollback = "pointer;";
                            $class = "";
                        } else {
                            $onclick_rollback = "javascript: void(0);";
                            $cursor_rollback = "default;";
                            $class = "disabled";
                        } ?>
                        <li>
                            <a href="javascript:void(0);" class="<?=$class?>" id="span_rollback_<?=$import->getNumber("id")?>" onclick="<?=$onclick_rollback?>" style="cursor:<?=$cursor_rollback?>">
                                <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK)?>
                            </a>
                        </li>

                        <? if ($import->getString("status") == "R") {
                            $onclick_off = "linkRedirect('stop.php?import_type=$importType&id=".$import->getNumber("id")."');";
                            $cursor_off = "pointer;";
                            $class = "";
                        } else {
                            $onclick_off = "javascript: void(0);";
                            $cursor_off = "default;";
                            $class = "disabled";
                        } ?>
                        <li>
                            <a href="javascript:void(0);" class="<?=$class?>" id="span_stop_<?=$import->getNumber("id")?>" onclick="<?=$onclick_off?>" style="cursor: <?=$cursor_off?>">
                                <?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT)?>
                            </a>
                        </li>

                        <? if (($import->getString("status") != "R") && ($import->getString("status") != "W") && ($import->getString("action") != "NR") && ($import->getString("action") != "C")) {
                            $onclick_del = "linkRedirect('delete.php?import_type=$importType&id=".$import->getNumber("id")."');";
                            $cursor_del = "pointer;";
                            $class = "";
                        } else {
                            $onclick_del = "javascript: void(0);";
                            $cursor_del = "default;";
                            $class = "disabled";
                        } ?>
                        <li>
                            <a href="javascript:void(0);" class="<?=$class?>" id="span_delete_<?=$import->getNumber("id")?>" onclick="<?=$onclick_del?>" style="cursor: <?=$cursor_del?>">
                                <?=system_showText(LANG_SITEMGR_IMPORT_DELETELOG)?>
                            </a>
                        </li>
                        
                    </ul>
                    
                </div>
                            
                <div class="toolbararrow"></div>

            </div>
            
        </td>
        
    </tr>

    <tr id="log_<?=$import->getNumber("id");?>" <? if ($log_id != $import->getNumber("id")) echo "style=\"display:none;\"";?> >
        <td colspan="5">
            <?
            echo import_getHistory($import->getString("history"));
            ?>
        </td>
        <td colspan="3" align="center" id="message_progress_<?=$import->getNumber("id")?>">&nbsp;</td>
    </tr>