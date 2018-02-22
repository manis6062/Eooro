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
	# * FILE: /mobile/articledetail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	
    $article = new Article();
    if (!$article->getArticleByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/articles.php");
        exit;
    }
    
    $levelObj = new ArticleLevel(true);
    
    unset($articleMsg);
    if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
        $articleMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ($article->getString("status") != "A") {
        $articleMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } elseif ($levelObj->getDetail($article->getNumber("level")) != "y" && $levelObj->getActive($article->getNumber("level")) == "y") {
        $articleMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } else {
        report_newRecord("article", $article->getNumber("id"), ARTICLE_REPORT_DETAIL_VIEW);
        $article->setNumberViews($article->getNumber("id"));
    }
		
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
	
	if (!$articleMsg) {
		
		$user = true;
        $isMobileDetail = true;
        include(INCLUDES_DIR."/views/view_article_detail.php");
        
		$module_item_title = $article_title;
		include("./breadcrumb.php"); 
			       
?>
	
	<div class="detail">
        
		<div class="thumbnail ">
            
			<div class="row-fluid ">		
				
				<h4><?=$article_title?></h4>
				
				<? if ($article_publicationDate || $article_author) { ?>
                   <span class="articleInfo">
                        <?
                        if ($article_publicationDate) echo $article_publicationDate;  
                        ?>       
                        <br /> 
                        <?
                        if ($article_author) echo system_showText(LANG_BY)." ".$article_author;
                        ?>   
                    </span>
                    
                <? } ?>
					
                <? if ($article_content) { ?>
					<?=$article_content?>
                <? } ?>
				
			</div>
            
		</div>
        
    </div>
        
    <? } else { ?>
        
        <p class="warning"><?=$articleMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>