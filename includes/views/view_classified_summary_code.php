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
	# * FILE: /includes/views/view_classified_summary_code.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($friendly_url) { ?>
		<a name="<?=$friendly_url;?>"></a>
	<? } ?>

    <div <?=$classified->getNumber("id") ? "id=\"summary_map_content_".$classified->getNumber("id")."\"" : ""?>>
        
        <div class="summary summary-small">
            
            <section>
                
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
                        <div class="listing-tag-deal">
                            <div class="name-tag-deal">
                                <?=$price;?>
                            </div>
                        </div>
                    <? } ?>

                </div>

                <div class="media">
                    
                    <div class="row-fluid">
                        <? if ($summaryDescription) { ?>
                            <p><?=$summaryDescription?></p>
                        <? } ?>
                    </div>

                    <div class="media-body">

                        <div class="row-fluid info">

                            <? if ($imageTag) { ?>
                                <div class="span4">
                                    <div class="summary-image">
                                        <?=$imageTag;?>
                                    </div>
                                </div>
                            <? } ?>

                            <div class="span8">

                                <div class="summary-address">
                                    <? if ($address1 || $address2 || $location) { ?>
                                        <address>
                                            <?=$address1?>
                                            <?=($address1 ? "<br />" : "").$address2?>
                                            <?=($address2 ? "<br />" : "").$location?>
                                        </address>
                                    <? } ?>
                                </div>

                                <div class="summary-contact span12">

                                    <? if ($display_url) { ?>
                                        <div>
                                            <a href="<?=$display_url?>" <?=$target?> <?=$style?>><?=nl2br($display_urlStr);?></a>
                                        </div>
                                    <? } ?>

                                    <div class="text-right">
                                        <? if ($phone) { ?>
                                            <div>
                                                <?=$phone?>
                                            </div>
                                        <? } ?>
                                        
                                        <? if ($contact_email) { ?>
                                        <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=  string_strtolower(system_showText(LANG_SEND_AN_EMAIL));?></a>
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