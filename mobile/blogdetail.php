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
    # * FILE: /mobile/blogdetail.php
    # ----------------------------------------------------------------------------------------------------
    
    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/mobile.inc.php");
    include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on") { exit; }
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
    $post = new Post();
    if (!$post->getPostByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/blogHome.php");
        exit;
    }
    
    unset($postMsg);
    if ((!$post->getNumber("id")) || ($post->getNumber("id") <= 0)) {
        $postMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ($post->getString("status") != "A") {
        $postMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    }
    report_newRecord("post", $post->getNumber("id"), POST_REPORT_DETAIL_VIEW);
    $post->setNumberViews($post->getNumber("id"));
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = $headertagtitle;
    include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

    if (!$postMsg) {
		
		$user = true;
        $isMobileDetail = true;
        $isDetail = true;
        
        include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php");
        
		$module_item_title = $title;
		include("./breadcrumb.php"); 
        
?>
    
    <div class="detail ">
        
        <div class="thumbnail ">
            
            <div class="row-fluid ">
                
                <div class="blog-info">
                    
                    <? if ($imagePath) { ?>
                        <div class=" img-polaroid pull-left span4">
                            <a class="group" href="<?=$imagePath;?>"><img src="<?=$imagePath;?>"/></a>
                        </div>
                    <? } ?>
                    
                    <h4><?=$title?></h4>
                    
                    <div class="info">
                        <?=system_showText(LANG_BY);?> <strong><?=EDIRECTORY_TITLE;?></strong>
                        <?=$postOn;?>
                    </div>
                    
                </div>              

                <?=$content;?>

            </div>
            
        </div>
        
    </div>

    <? } else { ?>
        
        <p class="warning"><?=$postMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>	 