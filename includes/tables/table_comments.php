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
	# * FILE: /includes/tables/table_comments.php
	# ---------------------------------------------------------------------------------------------------

	$wp_enabled = "";
?>
	
 	<table class="table-itemlist">
		<tr>
			<? if ($reply_id){?>
			<th><?=system_showText(LANG_LABEL_REPLY);?></th>
			<? } else {?>
			<th><?=system_showText(LANG_LABEL_COMMENT);?></th>
			<? } ?>
			<th><?=system_showText(LANG_LABEL_POST);?></th>
			<th><?=system_showText(LANG_LABEL_ADDED);?></th>
			<th><?=string_ucwords(system_showText(LANG_LABEL_ACCOUNT));?></th>
			<? if (!$wp_enabled) { ?>
                <th><?=string_ucwords(system_showText(LANG_LABEL_STATUS));?></th>
			<? } ?>
			<th></th>
			<th><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<? if ($commentsArr) foreach($commentsArr as $each_rate) {

			$hasReply = blog_getReply($each_rate->getNumber('id'));
			$post = new Post($each_rate->getNumber('post_id'));

            $info = array();
			$item_type = $each_rate->getString('item_type');
			$item_id = $each_rate->getNumber("item_id");
			?>

			<tr>
				<td>
					<?
					if ($each_rate->getString("description")) {
						$comment_title = strip_tags($each_rate->getString("description", false, 30));
					} else {
						$comment_title = system_showText(LANG_NA);
					}
					?>

					<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/comments/view.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table"><?=$comment_title?></a>
				</td>
				<td>
					<? $post_title = $post->getString("title", true, 30); ?>
					<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/view.php?id=<?=$post->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table"><?=$post_title?></a>

				</td>
				<td><?=($each_rate->getString("added")) ? format_date($each_rate->getString("added"), DEFAULT_DATE_FORMAT, "datetime")." - ".$each_rate->getTimeString("added") : system_showText(LANG_NA);?></td>
				<td>
					<?
					$account_id = $each_rate->getNumber("member_id");
					$account = new Contact($account_id);
					if ($account->getString("first_name")) {
						$reviewer_name = system_showTruncatedText($account->getString("first_name")." ".$account->getString("last_name"), 25);
					} else {
						$reviewer_name = system_showText(LANG_NA);
					}
					?>

					<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/view.php?id=<?=$account_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$reviewer_name?>">
					<?=$reviewer_name?>
					</a>
				</td>

				<? if (!$wp_enabled) { ?>
                <td>
					
                	<? if ($each_rate->getNumber("approved") == 0) { ?>
                		<span class="status-suspended"><?=(system_showText(LANG_LABEL_PENDING_APPROVAL))?></span>
            		<? } ?>
					
					<? if ($each_rate->getNumber("approved") == 1) { ?>
                		<span class="status-active"><?=(system_showText(LANG_LABEL_APPROVED))?></span>
            		<? } ?>
            		
				</td>
				<? } ?>
                
                <td>
                    <div class="toolbar-icons-button">
                        <div class="toolbar-icons">
                            <ul>
                                
                            <? if ($each_rate->getNumber("approved") == 0) { ?> 
                                <li>
                                    <a href='javascript:void(0);' onclick='showStatusField(<?=$each_rate->getNumber('id');?>);'>
                                        <?=(system_showText(LANG_REVIEW_APPROVE))?>
                                    </a>
                                </li>
                            <? } ?>

                            <? if (!$wp_enabled) { ?>
                                <? if (!$reply_title) { ?>
                                    <? if (!$hasReply) { ?>
                                        <li><?=system_showText(LANG_LABEL_REPLY);?></li>
                                    <? } else { ?>
                                        <li>
                                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php?reply_id=<?=$each_rate->getNumber("id")?>">
                                                <?=system_showText(LANG_LABEL_REPLY);?>
                                            </a>
                                        </li>
                                    <? } ?>
                                <? } ?>
                            <? } ?>

                            <li>
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/comments/delete.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>">
                                    <?=system_showText(LANG_SITEMGR_DELETE)?>
                                </a>
                            </li>

                            </ul>
                        </div>
                        <div class="toolbararrow"></div>
                    </div>
				</td>
                
				<td class="main-options">
					<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=BLOG_FEATURE_FOLDER;?>/comments/view.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>">
						<?=system_showText(LANG_SITEMGR_VIEW)?>
					</a>
				</td>
			</tr>

             <? // Status Edit Form ?>
            <tr id="statusTR<?=$each_rate->getNumber('id');?>" class="hideForm" style="display:none">
                <td colspan="7" id="statusTD<?=$each_rate->getNumber('id');?>" class="innerTable">
                    <form name="formStatus" action="status.php">
                        <p class="informationMessage"  style="display:none" id="informationMessageStatus"><?=system_showText(LANG_STATUS_EMPTY);?></p>
                        <input type="hidden" name="post_id" value="<?=$each_rate->getNumber('post_id');?>" />
                        <input type="hidden" name="idComment" value="<?=$each_rate->getNumber('id');?>" />
                        <? if ($filter_id) { ?>
                        <input type="hidden" name="filter_id" value="1" />
                        <? } ?>
                        <input type="hidden" name="screen" value="<?=$_GET['screen']?>" />
                        <input type="hidden" name="letter" value="<?=$_GET['letter']?>" />
                        <p class="title"><?=$comment_title;?></p><br />
                        <?if ($each_rate->getNumber("approved") == 0) {?>
                            <input type="radio" name="status" value="comment" id="approve_comment<?=$each_rate->getNumber('id');?>">&nbsp;<?=( $reply_id ?system_showText(LANG_SITEMGR_APPROVE_REPLY) : system_showText(LANG_SITEMGR_APPROVE_COMMENT))?></input><br />
                        <? } ?>

                        <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
                            <tr>
                                <td>
                                    <button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                    <button type="reset"  name="cancel" value="Cancel" class="input-button-form" onclick="hideStatusField(<?=$each_rate->getNumber('id');?>);"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <tr><?// Empty line to fix the zebra style?></tr>
        <? } ?>

    </table>

    <script type="text/javascript">

        var thisForm = "";
        var thisId = "";

        $('img[alt=star]').bind('click', function(){
            $(this).fadeOut(50);
            $(this).fadeIn(50);
        });


        function showStatusField(idIn) {

            thisForm = "status";
            thisId = idIn;

            hideAllComments();
            hideAllStatus();

            $('.informationMessage').css('display', 'none');
            $('#statusTR'+idIn).css('display', '');
    //        $('.input-button-form').focus();
        }

        function hideReplyField(idIn) {
            $('#replyReviewTR'+idIn).css('display', 'none');
            $('.errorMessage').css('display', 'none');
        }

        function hideStatusField(idIn) {
            $('#statusTR'+idIn).css('display', 'none');
            $('.informationMessage').css('display', 'none');
        }

        function hideAllComments() {
        <? if ($commentsArr) foreach($commentsArr as $each_rate) { ?>
            $('#CommentTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
        <? } ?>
        }

        function hideAllStatus() {
        <? if ($commentsArr) foreach($commentsArr as $each_rate) { ?>
            $('#statusTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
        <? } ?>
        }



    </script>