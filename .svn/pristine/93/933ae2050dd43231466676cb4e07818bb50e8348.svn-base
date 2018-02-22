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
	# * FILE: /includes/form/form_faq_default.php
	# ----------------------------------------------------------------------------------------------------

?>

	<script type="text/javascript">
		function showAnswer(answer) {
			$(document).ready(function() {
				if ($('#'+answer).css('display') == 'none') {
					$('#'+answer).slideDown(400);					
                } else {
					$('#'+answer).slideUp(400);
                }
			});
		}
	</script>

	<div class="content-faq">
	<? //added the commented part on the review banner of FAQ page?>
<!--        <div class="faq-search flex-box-group">
            <div class="row-fluid">
                <form name="faq" action="<?//=system_getFormAction($faq_front ? $_SERVER["REQUEST_URI"] : $_SERVER["PHP_SELF"])?>" method="get">
                    <h4 class="span5"><?//=system_showText(LANG_FAQ_HELP);?></h4>
                    <input type="search" class="span5" name="keyword" id="keyword" placeholder="<?//=system_showText(LANG_FAQ_TIP);?>" value="<?//=$keyword;?>" />
                    <button type="submit" class="btn btn-success span2 pull-right"><?//=system_showText(LANG_BUTTON_SEARCH);?></button>
                </form>
            </div>
        </div>-->
	
        <? if ($faq_front) { ?>
            <div class="faq-front">
                <a href="<?=DEFAULT_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php"><?//=system_showText(LANG_FAQ_CONTACT);?></a>
            </div>
        <? }
       
        include(INCLUDES_DIR."/tables/table_paging.php");

        if ($faqs) {
            $i = 0;
            echo "<div class=\"faqAnswers\">";
            foreach ($faqs as $faq) {
                echo "<div>";
                echo "<h3 class=\"standardSubTitle\"><a href=\"javascript:void(0);\" onclick=\"showAnswer('answer".$i."');\">".$faq["question"]."</a></h3>";
                echo "<p id=\"answer".$i."\" style=\"display:none\">".trim(str_replace('"','',$faq["answer"]))."</p>";
                echo "</div>";
                $i++;
            }
            echo "</div>";
        } else {
            echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
        }
		?>
	
	</div>
    
    <?
    $bottomPagination = true;
    include(INCLUDES_DIR."/tables/table_paging.php");
    ?>