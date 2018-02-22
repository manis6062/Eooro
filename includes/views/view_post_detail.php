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
	# * FILE: /includes/views/view_post_detail.php
	# ----------------------------------------------------------------------------------------------------

	include(INCLUDES_DIR."/views/view_comment.php");
    extract($_GET);

?>        
    <div class="tab-container">

        <div id="content_overview" class="tab-content">

            <div class="row-fluid">
                
                <div class=" top-info">
                    
                    <h3><?=$title;?></h3>

                    <div class="row-fluid">
                        
                        <div class="span10">
                            <?=$postOn;?>
                        </div>

                        <div class="span2 text-right">
                            <?=$icon_navbar;?>
                        </div>

                    </div>

                </div>
                
            </div>

            <? if ($postCategoryTree) { ?>
                <div class="row-fluid top-info">
                    <div class="span12">
                        <?=$postCategoryTree;?>
                    </div>
                </div>
            <? } ?>

            <div class="row-fluid middle-info overview">

                <? if (($wp_enabled != "on" || ($force_blog_module && $postImage)) && !$postNoImage) { ?>                      
                        <div class="span7 blog-image">
                            <div <?=($postNoImage ? "class=\"image\"" : "class=\"galleria image\" id=\"galleria\"")?>>
                                <?=$imageTag?>
                            </div>
                        </div>                    
                    <?
                    if (!$postNoImage) {
                        echo system_addGalleryScript(true);
                    }

                }
                
                if ($content) { ?>
                    <?=($content)?>
                <? } ?>

            </div>

        </div>

        <?
        if ($commenting_fb) {
            $showLabel = false;
        ?>
        
        <div class="post-comments flex-box-group color-1">
            
            <span class="clear" style="display:block;"></span>

            <h2><?=system_showText(LANG_BLOG_COMMENTS)?></h2>

            <script language="javascript" type="text/javascript">
                //<![CDATA[
                (function(d){
                var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
                d.getElementsByTagName('head')[0].appendChild(js);
                }(document));

                document.write('<div class="fb-comments" data-href="<?=$detailLink?>" data-num-posts="<?=$commenting_fb_number_comments?>" data-width="<?=FB_COMMENTWIDTH_BLOG?>"></div>');    
                //]]>
            </script>
        </div>
        
        <? } ?>     

        <? if ($detail_comment && $commenting_edir && $review_blog_enabled) { ?>
        
            <br class="clearfix">
            
            <div class="post-comments">
                <? if ($showLabel) { ?>
                    <h2><?=system_showText(LANG_BLOG_COMMENTS)?></h2>
                <? } ?>

                <? if ($success_message){ ?>
                    <p class="successMessage" id="messageSucess"><?=$success_message?></p>
                <? } ?>   

                <div class="comments-list">    
                    <?=$detail_comment?>
                </div>
            </div>
            
        <? } ?>

        <? if ($success_message || $success_approve_message) { ?>
            <script type="text/javascript">
                $('html, body').animate({
                    scrollTop: $('#messageSucess').offset().top
                }, 500);
            </script>
        <?
            unset($success_message);
        } ?>

    </div>

    <? if ($user && $commenting_edir && $review_blog_enabled) { ?>
        <div>
            <? include(EDIRECTORY_ROOT."/includes/forms/form_comment.php");?>
        </div>
    <? } ?>