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
	# * FILE: /mobile/articleview.php
	# ----------------------------------------------------------------------------------------------------

?>
    <div class="articles-summary thumbnails">
        
        <div class="itemView articleView thumbnail">
            
            <div class="row-fluid articles">
                
                <h4>
                    <strong><?=$summaryTitle?></strong>
                    
                    <br />

                    <? if ($publication_date || $author) { ?>
                        <span class="articleInfo">
                            <?
                            if ($publication_date) echo $publication_date;
                            ?>
                        </span>
                    
                        <em class="articleInfo">
                            <?
                            if ($author) echo $author;
                            ?>
                        </em>
                    <? } ?>
                </h4>
            </div>
            
            <? if ($summaryDescription) { ?>
                <p><?=$summaryDescription?></p>
            <? } ?>
                
            <div class="navafter">
                <a href="<?=$detailLink;?>"><?=system_showText(LANG_VIEW_ARTICLE)?></a>
            </div>	
                
        </div>
        
    </div>