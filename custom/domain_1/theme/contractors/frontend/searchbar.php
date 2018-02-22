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
	# * FILE: /theme/contractors/frontend/searchbar.php
	# ----------------------------------------------------------------------------------------------------

    $js_fileLoader = system_scriptColectorOnReady("

        $('#keyword_home').autocomplete(
            '".AUTOCOMPLETE_KEYWORD_URL."?module=listing',
                    {
                        delay:1000,
                        dataType: 'html',
                        minChars:".AUTOCOMPLETE_MINCHARS.",
                        matchSubset:0,
                        selectFirst:0,
                        matchContains:1,
                        cacheLength:".AUTOCOMPLETE_MAXITENS.",
                        autoFill:false,
                        maxItemsToShow:".AUTOCOMPLETE_MAXITENS.",
                        max:".AUTOCOMPLETE_MAXITENS."
                    }
            );

    ", $js_fileLoader);

?>
    <div class="searchbar">
        <div class="row-fluid form-inline">
            <form name="search_form_home" method="get" action="<?=NON_SECURE_URL."/results.php";?>">
                <input type="text" name="keyword" id="keyword_home" placeholder="<?=system_showText(LANG_LABEL_SEARCHKEYWORD);?>..."/>
                <button type="submit" class="btn btn-success"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
            </form>
        </div>
    </div>