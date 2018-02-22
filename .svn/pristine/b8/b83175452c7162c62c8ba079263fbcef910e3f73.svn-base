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
    # * FILE: /includes/views/view_article_summary_code_contractors.php
    # ----------------------------------------------------------------------------------------------------

?>

    <div id="article_summary_<?=$article->getNumber("id");?>" class="summary summary-article">

		<section>

	        <div class="row-fluid title">
	            
	            <div class="span12">
                    
	                <h3><?=$summaryTitle;?></h3>
                    
                    <? if ($complementary_info_category) { ?>
                        <p <?=($article->getNumber("id") ? "id=\"showCategory_".$article->getNumber("id")."\"" : "")?>>
                            <?=$complementary_info_category?>
                        </p>
		            <? } ?> 
                        
	            </div>

	        </div>
	         
	        <div class="row-fluid media">

	            <div class="span4">
	            	<br />
	            	<div class="summary-image"><?=$summaryImage;?></div>
	            </div>
	            
	            <div class="span8 media-body">
	                
	                <div class="row-fluid">
                        
	                    <? if ($summaryDescription) { ?>
                        
	                    <div class="span12">
	                        <p><?=$summaryDescription;?></p>
	                    </div>
                        
	                    <? } ?>
                        
	                </div>
	                
	            </div>
	            
			</div>

	    </section>

        <div class="row-fluid line-footer">

            <div class="span6 review">
                <?=($item_review ? $item_review : "");?>
            </div>
            
            <? if ($complementary_info_published) { ?>
            
	             <div class="span6 comp-info">
		            <p><?=$complementary_info_published?></p>
	             </div>
            
            <? } ?>

        </div>

    </div>