<?
    /* ==================================================================*\
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
    \*================================================================== */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/views/view_article_summary_code_dininngguide.php
    # ----------------------------------------------------------------------------------------------------

?>

    <div id="article_summary_<?=$article->getNumber("id");?>" class="summary summary-article">
	 
        <div class="row-fluid title">
            
            <div class="span12">
                
                <h3><?=$summaryTitle;?></h3>
                
                <? if ($complementary_info) { ?>
                <p <?=($article->getNumber("id") ? "id=\"showCategory_".$article->getNumber("id")."\"" : "")?>>
                    <?=$complementary_info?>
                </p>
                <? } ?>
                
            </div>

        </div>
         
        <div class="media">
            
            <div class="image summary-image"><?=$summaryImage;?></div>
            
            <div class="media-body">
                
                <div class="row-fluid">
                    <? if ($summaryDescription) { ?>
                    <div class="span12">
                        <p><?=$summaryDescription;?></p>
                    </div>
                    <? } ?>
                </div>
                
            </div>
            
		</div>
         
        <div class="row-fluid  line-footer">

            <div class="span6 review">
                <?=($item_review ? $item_review : "");?>
            </div>

            <div class="span6 text-right icons">
                 <div class="navicons"><?=$icon_navbar;?></div>
            </div>
            
        </div>

    </div>