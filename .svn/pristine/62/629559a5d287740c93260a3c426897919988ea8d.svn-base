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
	# * FILE: /includes/views/view_event_summary_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>
	
	<div class="summary summary-big">
	
        <div class="row-fluid title">

            <div class="span12">

                <h3><?=$title?></h3>
                
                <? if ($complementary_info) { ?>
                <p <?=($event->getNumber("id") ? "id=\"showCategory_".$event->getNumber("id")."\"" : "")?>>
                    <?=$complementary_info?>
                </p>
                <? } ?>

            </div>

        </div>
        
        <div class="media">

            <? if ($imageTag) { ?>
                <div class="image summary-image">
                    <?=$imageTag?>
                </div>
            <? } ?>

            <div class="media-body">
                <? if ($description) { ?>
                <div class="row-fluid">
                   
                    <div class="span12">
                        <p><?=nl2br($description)?></p>
                    </div>
                    
                </div>
                <? } ?>
                
                <div class="row-fluid info">
                    <? if ($address1 || $address2 || $location) { ?>
                    <div class="span4">
                        <address>
                            <?=$address1?>
                            <?=$address2?>
                            <?=$location?>
                        </address>
                    </div>
                    <? } ?>
                    
                    <div class="span6">
                        <? if ($event_location) { ?>
                            <p>
                                <strong>
                                    <?=system_showText(LANG_SEARCH_LABELLOCATION)?>:
                                </strong>
                                <?=nl2br($event_location)?>
                            </p>
                        <? } ?>

                        <? if ($when) { ?>
                            <p>
                                <strong>
                                    <?=system_showText(LANG_EVENT_WHEN);?>:
                                </strong>
                                <?=$when;?>
                            </p>
                        <? } ?>

                        <? if ($str_time) { ?>
                            <p>
                                <strong>
                                    <?=system_showText(LANG_EVENT_TIME)?>:
                                </strong>
                                <?=$str_time?>
                            </p>
                        <? } ?>

                        <? if ($phone){ ?>
                            <p>
                                <strong>
                                    <?=system_showText(LANG_EVENT_LETTERPHONE)?>:
                                </strong>
                                <?=$phone?>
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
                        <a class="map-link" href="javascript:void(0)" <?=($user ? "onclick=\"myclick($mapNumber); scrollPage();\"" : "style=\"cursor:default;\"")?> title="<?=ucfirst(system_showText(LANG_ICONMAP));?>"></a>
                    </span>
                </div>
                <? } ?>
                <div class="navicons"><?=$event_icon_navbar;?></div>
            </div>
            
        </div>
	
	</div>