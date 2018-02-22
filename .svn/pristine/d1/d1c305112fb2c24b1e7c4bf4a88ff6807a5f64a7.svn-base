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
	# * FILE: /mobile/eventview.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="itemView eventView thumbnail">
        
		<div class="row-fluid">
            <h4><?=$title;?></h4>
            
            <? if ($when || $str_time) { ?>
                <h5 class="eventDateTime">
                    
                <? if ($when) { ?>
                    <?=system_showText(LANG_EVENT_WHEN);?>: <span> <?=$when?></span> <br />
                <? } ?>

                <? if ($str_time) { ?>
                    <?=system_showText(LANG_EVENT_TIME);?>:<span> <?=$str_time?></span><br />
                <? } ?>
                    
                <? if ($event_location) { ?>
                    <?=system_showText(LANG_SEARCH_LABELLOCATION)?>: <span> <?=$event_location;?></span> 
                <? } ?>
                    
                </h5>
            
            <? } ?>
		</div>
        
		<? if ($event_fulllocation) { ?>
			<address class="event-address">
				<span> <i class="icon-map-marker"></i> <?=$event_fulllocation?></span>
			</address>
		<? } ?>
        
		<? if ($phone) { ?>
			<p class="phone"><i class="icon-phone"></i> <?=$phone?></p>
		<? } ?>
            
		<? if ($description) { ?>
			<p><?=$description?></p>
		<? } ?>
            
	</div>