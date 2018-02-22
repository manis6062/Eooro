<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
//echo 'working!!';
//print_r( $this->caseDetails );
?><link rel="stylesheet" href="<?=MODULES_REQ.'/casemanager/views/viewcase/tmpl/style.css'?>" />
<div class="content-custom">
    You can view all your case Details in this page.
</div>
<div class="row-fluid responsive">
    <?php 
//        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
//        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
//        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
    ?>
    <div class="span4 responsive-menu">
        <? //include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php"); ?>
        <div class="responsive-scrollmenu">
            <div class="scroll-content">
                <div class="webitem active">
                    <div class="desc">
                        <p class="title">
                            <b><?='Details of Review:'?></b>
                        </p>
                        <p class="simple">
                            <?=  ucwords($this->caseDetails['review_title']);?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="addcontent">
            <p>Add some new contents.</p>

            <ul>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_LISTING_FEATURE_NAME);?></a>
                </li>

                <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_BANNER_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_EVENT_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                <li>
                    Add <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_ARTICLE_FEATURE_NAME);?></a>
                </li>
                <? } ?>
            </ul>

            <? if ($content) { ?>
                <div class="content-custom"><?=$content?></div>
            <? } ?>

        </div>
    </div>
    <div id="dashboard" class="span8 responsive-dashboard">
        <div class="dashboard"> <!-- view_member_dashboard -->
            <header>
                <h2>Case Details</h2>
            </header>
            <section class="stats-summary">
                <div class="row-fluid">
                    <div class="span5">
                        <p>
                            Case Opened Date:
                        </p>
                        <p>
                            Reviewer Name:
                        </p>
                        <p>
                            Reviewer Comment Title:
                        </p>
                        <p>
                            Reviewer Comment Description:
                        </p>
                    </div>
                    <div class="span7">
                        <p>
                            <?=$this->caseDetails['opened_date'];?>
                        </p>
                        <p>
                            <?=$this->caseDetails['reviewer_name']?>
                        </p>
                        <p>
                            <?=  ucwords($this->caseDetails['review_title'])?>
                        </p>
                        <p>
                            <?=$this->caseDetails['review_comment']?>
                        </p>
                    </div>
                </div>
            </section><!-- Details end  -->
            <header class="msg-title">
                <h2>Case Messages</h2>
            </header>
            <section class="stats-summary">
                <div class="row-fluid">
                    <div></div>
                    <div class="msg-container" id="msg-container">
                        <?php 
                            $size = count( $this->caseMessages );
                            for ( $i = 0; $i < $size; $i++ ) :
    //                            $class1 = ( $i % 2 == 0 ) ? 'pull-right' : '';
                                if($this->currentUser->getId() == $this->caseMessages[$i]['from_user'] ) { 
                                    $class  = 'msg msg-sent pull-right';
                                    $sender = 'You: ';
                                } 
                                else{ 
                                    $class  = 'msg msg-received';
                                    $sender = "{$this->toUser->getName()}: ";
                                }
                        ?>
                        <div class="span9 <?=$class;?>">
                            <p><?=$sender;?><span class="pull-right"><?=$this->caseMessages[$i]['date'];?></span></p>
                            <p><b><?=$this->caseMessages[$i]['message'];?></b></p>
                        </div>
                        <?php endfor;?>
                    </div> <!--  end msg-container  -->
                </div>
                <div class="row-fluid">
                    <form id="msg-reply-form">
                        <label for="msg-reply">Your Reply</label>
                        <textarea id="msg-reply" class="msg-reply" placeholder="Type in your reply in no more than 2000 characters" maxlength="2000"></textarea>
                        <button type="button" id="msg-reply-button" class="btn btn-send">Send</button>
                    </form>
                </div>
            </section><!-- Case Messages End  -->
        </div><!--  class- dashboard-ends -->
    </div><!--  id - dashboard - ends -->
</div><!-- row-fluid responsive ends -->

</div> <!-- well container members ends -->
</div> <!-- container-fluid ends -->

<script>
    function scrollToBottom(){
        var msgBox = document.getElementById( 'msg-container' );
        msgBox.scrollTop = msgBox.scrollHeight;
    }
    scrollToBottom();
    
    $( '#msg-reply-button' ).on( 'click', function( event ){
        var reply = $( '#msg-reply' ).val();
        if ( reply.trim() !== '' ) {
            var details = { 
                            "msg"           : reply,
                            "owner_id"      : "<?=$this->caseDetails['owner_id'];?>",
                            "member_id"   : "<?=$this->caseDetails['member_id'];?>",
                            "case"  : "<?=$this->caseDetails['case_id'];?>"
                        };
            $.ajax({
                url: "<?=CASE_URL;?>",
                type: "POST",
                data: {
                    "action"    : "updateMessage",
                    "id"        : "<?=$this->caseDetails['review_id']?>", 
                    "details"   : details 
                },
                success: function( response ){
                    var content = $( '.ajax-reply', response );
                    $( '#msg-container' ).append( content );
                },
                complete: function( response ){
                    scrollToBottom();
                }
            });
        }
        else{
            event.preventDefault();
        }
    });
</script>