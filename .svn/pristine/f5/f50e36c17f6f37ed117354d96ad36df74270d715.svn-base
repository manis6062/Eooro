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
	# * FILE: /theme/contractors/frontend/results_info.php
	# ----------------------------------------------------------------------------------------------------
        
    if ($show_results && (!$pagination_bottom || $str_search)) { ?>

        <div class="search-info">

            <? if ($aux_module_items && !$hideResults) { ?>
            
                <p <?=($addId ? "style=\"display: none;\" id=\"search-info-results\"" : "")?>>
                    <i <?=($addId ? "id=\"total_results\"" : "")?>><?=$array_pages_code["total"]?></i> <?=(($array_pages_code["total"] != 1) ? (system_showText(LANG_RESULTS)) : (system_showText(LANG_RESULT)))?>
                    
                    <? if ($str_search) { ?>
                        <?=$str_search?>
                    <? } ?>
                </p>
                
            <? } ?>

        </div>

    <? } ?>