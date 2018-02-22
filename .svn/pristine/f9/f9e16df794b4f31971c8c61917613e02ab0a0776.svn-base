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
	# * FILE: /includes/views/view_event_summary_code_contractors.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>
        
    <div <?=$event->getNumber("id") ? "id=\"summary_map_content_".$event->getNumber("id")."\"" : ""?>>
	
        <div class="summary summary-small">
            
            <section>
                
                <div class="row-fluid title">

                    <div class="span7">

                        <h3><?=$title?></h3>

                        <? if ($complementary_info) { ?>
                            <p <?=($event->getNumber("id") ? "id=\"showCategory_".$event->getNumber("id")."\"" : "")?>>
                                <?=$complementary_info?>
                            </p>
                        <? } ?>

                    </div>
                    
                    <div class="span5 text-right">
                        <? if ($when) { ?>
                            <h4><?=$when;?></h4>
                        <? } ?>

                        <? if ($str_time) { ?>
                            <em><?=$str_time?></em>
                        <? } ?>
                    </div>

                </div>

                <div class="media">

                    <? if ($description) { ?>
                        <div class="row-fluid">
                            <p><?=nl2br($description)?></p>
                        </div>
                    <? } ?>

                    <div class="media-body">

                        <div class="row-fluid info">

                            <? if ($imageTag) { ?>
                            
                            <div class="span4">
                                <div class="summary-image">
                                    <?=$imageTag?>
                                </div>
                            </div>
                            
                            <? } ?>

                            <div class="span8">
                                
                                <? if ($event_location || $address1 || $address2 || $location) { ?>
                                
                                <div class="summary-address">
                                    <address>
                                        <? if ($event_location) { ?>
                                            <span class="oneline"><?=nl2br($event_location)?> </span><br />
                                        <? } ?>

                                        <?=$address1?>
                                        <?=$address2?>
                                        <?=$location?>
                                    </address>
                                </div>
                                
                                <? } ?>

                                <div class="summary-contact span12">

                                    <? if ($event_url) { ?>
                                    
                                        <div>
                                            <a href="<?=$event_url;?>" target="_blank">
                                                <?=($user ? $event_url : system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE));?>
                                            </a>
                                        </div>
                                    
                                    <? } ?>

                                    <div class="<?=($event_url ? "text-right right" : "")?>">
                                        
                                        <? if ($phone) { ?>
                                        
                                        <p><?=$phone?></p>
                                            
                                        <? } ?>

                                        <? if ($event_email) { ?>
                                        
                                        <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>">
                                            <?=string_strtolower(system_showText(LANG_SEND_AN_EMAIL));?>
                                        </a>
                                        
                                        <? } ?>
                                        
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                
            </section>

        </div>
        
    </div>