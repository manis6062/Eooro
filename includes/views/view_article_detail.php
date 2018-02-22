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
	# * FILE: /includes/views/view_article_detail.php
	# ----------------------------------------------------------------------------------------------------

    if (!$isMobileDetail) {
        $article_icon_navbar = "";
        include(EDIRECTORY_ROOT."/includes/views/icon_article.php");
        $article_icon_navbar = $icon_navbar;
        $favoritesLink = $links;
        $icon_navbar = "";
    }
    
    $article_id = $article->getNumber("id");

	$imageTag = "";
	$auxImgPath = "";
	$imageObj = new Image($article->getNumber("image_id"));
	if ($imageObj->imageExists()) {
        
        $dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT image_caption, thumb_caption FROM Gallery_Image WHERE image_id = ".$article->getNumber("image_id");
		$r = $dbObj->query($sql);
		while ($row_aux = mysql_fetch_array($r)) {
			$imagecaption = $row_aux["image_caption"];
			$thumbcaption = $row_aux["thumb_caption"];
		}
        if (THEME_USE_BOOTSTRAP) {
            $thumbcaption = system_showTruncatedText($thumbcaption, 45);
            $imagecaption = system_showTruncatedText($imagecaption, 45);
        }

		$imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
		$imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_ARTICLE_FULL_WIDTH, IMAGE_ARTICLE_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $article->getString("title", false)), THEME_RESIZE_IMAGE);
		$imageTag .= "</div>";
        $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
		if ($imagecaption) $imageTag .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
        $auxImgPath = $imageObj->getPath();
	} else {
		$imageTag .= "<span class=\"no-image no-link\"></span>";
	}
    
	$articleGallery = "";
    $arrayPaths = array();

    $articleGallery = system_showFrontGalleryPlugin($article->getGalleries(), $article->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "article", $tPreview, $onlyMain, $arrayPaths);
	
	$article_title = $article->getString("title");
	
	$article_publicationDate = $article->getDate("publication_date");
	
	$article_author = $article->getString("author", true);
	
	$article_authorUrl = $article->getString("author_url", true);
	
	$article_authorStr = "";
	
	if ($article_authorUrl) {
		if ($user) {
			$authorLink = "<a href=\"".$article_authorUrl."\" target=\"_blank\">\n";
		} else {
			$authorLink = "<a href=\"javascript:void(0);\" style=\"cursor:default\">\n";
		}
		$article_authorStr = $authorLink;
	}
	$article_authorStr .= $article_author;
	
    if ($article_authorUrl) {
        $article_authorStr .= "</a>";
    }
	
	$article_name = socialnetwork_writeLink($article->getNumber("account_id"), "profile", "general_see_profile", false, false, false, "", $user);
	
	$article_category_tree = "";
	if ($tPreview) {
		$article_category_tree = "<ul class=\"list list-category\">";
		$article_category_tree .= "<li class=\"level-1\">";
		$article_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$article_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)." ";
		$article_category_tree .= "<span>(230)</span>";
		$article_category_tree .= "</a>";
		$article_category_tree .= "</li>";
		$article_category_tree .= "<li class=\"level-2\">";
		$article_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$article_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1_2)." ";
		$article_category_tree .= "<span>(200)</span>";
		$article_category_tree .= "</a>";
		$article_category_tree .= "</li>";
		$article_category_tree .= "<li class=\"level-1\">";
		$article_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$article_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)." ";
		$article_category_tree .= "<span>(300)</span>";
		$article_category_tree .= "</a>";
		$article_category_tree .= "</li>";
		$article_category_tree .= "<li class=\"level-2\">";
		$article_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$article_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2_2)." ";
		$article_category_tree .= "<span>(230)</span>";
		$article_category_tree .= "</a>";
		$article_category_tree .= "</li>";
		$article_category_tree .= "</ul>";
	} else {
		$categories = $article->getCategories();
		if ($categories) {
				foreach ($categories as $categoryObj) {
                    $arr_full_path[] = $categoryObj->getFullPath();
				}
				if ($arr_full_path){
                    $article_category_tree = system_generateCategoryTree($categories, $arr_full_path, "article", $user);
                }
		}
	}
	
	if ($tPreview) {
		$article_content = $article->getString("content", false);
		$article_content .= "<br /><br />";
		$article_content .= $article->getString("content", false);
		$article_content .= "<br /><br />";
		$article_content .= $article->getString("content", false);
	} else {
		$article_content = $article->getString("content", false);
	}
    
    $article_summary = nl2br($article->getString("abstract", true));
    
    if (!$isMobileDetail) {
        /*
        * Google+ Button
        */
        if ($auxImgPath) {
            array_unshift($arrayPaths, $auxImgPath);
        }
        $article_googleplus_button = share_getGoogleButton($tPreview, $user, false, "", false, $arrayPaths);

        /*
        * Pinterest Button
        */
        $article_pinterest_button = share_getPinterestButton($auxImgPath, $article->getFriendlyURL(false, ARTICLE_DEFAULT_URL), $article_summary, $article_title, $tPreview, $user);

        /*
        * Facebook Buttons
        */
        $article_facebook_buttons = share_getFacebookButton(false, $likeObj, $tPreview, $user);
        
        $detail_review = "";
        setting_get('commenting_edir', $commenting_edir);
        setting_get("review_article_enabled", $review_enabled);
        if ($review_enabled == "on" && $commenting_edir) {
            $item_id = $id;
            $item_type = 'article';
            $reviewSummaryInfo = true;
            $isDetail = true;
            include(INCLUDES_DIR."/views/view_review.php");
            $summary_review .= $item_review;
            $item_review = "";
            
            if ($reviewsArr) {

                $lastItemStyle = 0;
                $numberOfReviews = count($reviewsArr) > 3 ? 3 : count($reviewsArr);
                $reviewMaxSize = 150;
                $counterReview = 0;
                
                $reviewFileName = INCLUDES_DIR."/views/view_review_detail.php";
                $reviewFileNameTheme = INCLUDES_DIR."/views/view_review_detail_".EDIR_THEME.".php";

                foreach ($reviewsArr as $each_rate) {
                    if ($counterReview < 3) {
                        $counterReview++;
                        if ($each_rate->getString("review")) {
                            $each_rate->extract();
                            if (file_exists($reviewFileNameTheme)) {
                                include($reviewFileNameTheme);
                            } else {
                                include($reviewFileName);
                            }
                            $detail_review .= $item_reviewcomment;
                            $item_reviewcomment = "";
                        }
                    } else {
                        break;
                    }
                }
            }
        }

        $detailFileName = INCLUDES_DIR."/views/view_article_detail_code.php";
        $themeDetailFileName = INCLUDES_DIR."/views/view_article_detail_code_".EDIR_THEME.".php";

        if (file_exists($themeDetailFileName)){
            include($themeDetailFileName);
        } else {
            include($detailFileName);
        }
    
    }

?>