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
	# * FILE: /showcategory.php
	# ----------------------------------------------------------------------------------------------------

	include("../../conf/loadconfig.inc.php");
	
	extract($_GET);

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$categories = system_itemRelatedCategories($item_id, $item_type, $user);
	
	if ($item_type == "article"){
		$article = new Article($item_id);
        
        /*
         * Prepare author String
         */
        if ($article->getString("author", true)) {
            $author_string .= system_showText(LANG_BY)." ";
            if ($article->getString("author_url", true)) {
                $author_string .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
            }
            $author_string .= " ".$article->getString("author", true);
            if ($article->getString("author_url", true)) {
                $author_string .= "</a>\n";
            }
        } else {
            $name = socialnetwork_writeLink($article->getNumber("account_id"), "profile", "general_see_profile");
            if ($name) {
                $author_string .= " ".system_showText(LANG_BY)." ".$name;
            }
        }
        
		$auxInfo = system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
        if ($summary){
            echo $publication_info = ($categories ? $categories." - ".$article->getDate("publication_date", true) : $article->getDate("publication_date", true)); 
        } else {
            if (THEME_ARTICLE_SPLIT_COMPINFO) {
                echo $categories;
            } else {
                echo $auxInfo." ".$author_string." ".$categories;
            }
        }
		
	} else {
        if ($categories) {
           echo $categories; 
        } else {
            echo system_showText(LANG_NOINFO);
        }	
	}
	?>