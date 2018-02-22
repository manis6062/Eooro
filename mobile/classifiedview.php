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
	# * FILE: /mobile/classifiedview.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="itemView classifiedView thumbnail">
        
		<div class="row-fluid">
            
			<div class="classified-info">
				<h4>
                    <?=$title?>
                    
                <? if ($price) { ?>
                    <div class="price"> 
                        <h5 ><?=$price?></h5>
                    </div>
                <? } ?>
                    
				<? if ($phone) { ?>
					<br/><em class="phone"><i class="icon-phone"></i> <?=$phone?></em>
				<? } ?>
				</h4>
			</div>
			
		</div>
        
		<? if ($summaryDescription) { ?>
			<p><?=$summaryDescription?></p>
		<? } ?>
            
	</div>