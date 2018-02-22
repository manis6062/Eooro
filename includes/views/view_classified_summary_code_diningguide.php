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
	# * FILE: /includes/views/view_classified_summary_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>

	<div <?=$classified->getNumber("id") ? "id=\"classified_summary_".$classified->getNumber("id")."\"" : ""?> class="summary summary-big">

		<div class="row-fluid title">
            
			<div class="span8">
                
				<h3><?=$title?></h3>
                
                <? if ($complementary_info) { ?>
				<p <?=($classified->getNumber("id") ? "id=\"showCategory_".$classified->getNumber("id")."\"" : "")?>>
					<?=$complementary_info?>
				</p>
                <? } ?>
                
			</div>
            
            <? if ($price) { ?>
                <div class="span4">
                    <p class="price">
                        <?=$price;?>
                    </p>
                </div>
            <? } ?>
            
		</div>
        
		<div class="media">
			 <? if ($imageTag) { ?>
			 	<div class="image summary-image">
                    <?=$imageTag;?>
                </div>
            <? } ?>
            
			 <div class="media-body">
                <? if ($summaryDescription) { ?>
			 	<div class="row-fluid">
			 		<div class="span12">
                        <p><?=$summaryDescription?></p>
			 		</div>
			 	</div>
                <? } ?>
                 
			 	<div class="row-fluid info">
                    
					<div class="span4">
						<? if ($address1 || $address2 || $location) { ?>
							<address>
								<?=$address1?>
								<?=$address2?>
								<?=$location?>
							</address>
		                <? } ?>
					</div>
                    
					<div class="span8">
						<? if ($phone) { ?>
							<p>
								<strong>
									<?=system_showText(LANG_EVENT_LETTERPHONE)?>: 
								</strong>
								<?=$phone?>
							</p>
		                <? } ?>
						
						<? if ($display_url) { ?>
							<p>
								<a href="<?=$display_url?>" <?=$target?> <?=$style?>><?=nl2br($display_urlStr);?></a>
							</p>
		                <? } ?>
		
						<? if ($contact_email) { ?>
							<p>
                                <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a>
							</p>
		                <? } ?>
						
					</div>
                    
		 		</div>
                 
			 </div>
            
		</div>
        
		<div class="row-fluid line-footer">
			<div class="span12 text-right icons">
                <? if ($show_map || !$user) { ?>
                <div class="summary-icons">
                    <span id="summaryNumberID<?=$mapNumber;?>" class="map <?=(($_COOKIE['showMap'] == 0) ? ('isVisible') : ('isHidden'))?>">
                        <a class="map-link" href="javascript:void(0);" <?=($user ? "onclick=\"myclick($mapNumber); scrollPage();\"" : "style=\"cursor:default;\"")?> title="<?=ucfirst(system_showText(LANG_ICONMAP));?>"></a>
                    </span>
                </div>
                <? } ?>
                <div class="navicons"><?=$classified_icon_navbar;?></div>
            </div>
            
		</div>

	</div>