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
	# * FILE: /theme/diningguide/frontend/results_pagination_default.php
	# ----------------------------------------------------------------------------------------------------

    if ((($array_pages_code["total"] > $aux_items_per_page)) && !$hideResults) { ?>

        <div class="pagination">
            
            <div class="goto">
                
                <? if ($array_pages_code["previous"] || $array_pages_code["first"] || $array_pages_code["pages"] || $array_pages_code["last"] || $array_pages_code["next"]) { ?>
                
                <ul class="pages">                   
                    <?=($array_pages_code["previous"] ? $array_pages_code["previous"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&laquo;</a></li>");?>
                    <?=$array_pages_code["first"];?>
                    <?=$array_pages_code["pages"];?>
                    <?=$array_pages_code["last"];?>
                    <?=($array_pages_code["next"] ? $array_pages_code["next"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&raquo;</a></li>");?>
                </ul>
                
                <? } ?>

            </div>
            
        </div>

    <? } ?>