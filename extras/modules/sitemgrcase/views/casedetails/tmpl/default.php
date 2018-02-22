<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?><link rel="stylesheet" href="<?=MODULES_REQ.'/sitemgrcase/views/casedetails/tmpl/style.css'?>" />
<div id="main-right">
    <div id="top-content">
        <div id="header-content">
            <h1>View Case Details</h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin">
            <!-- Everything goes here  -->
            <div class="submenu">
                <ul>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=searchcase'?>">Search</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=manage'?>">Manage</a></li>
                    <li class="submenu_active"><a>View</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=setting'?>">Setting</a></li>
                </ul>
            </div> <!-- submenu complete  -->
            <br clear="all">
            
            <div class="header-form" title="">Basic Details</div>
            
            <div class="col-2">
                <p>
                    Case Opening Date:
                </p>
                <p>
                    Owner:
                </p>
                <p>
                    Reviewer:
                </p>
                <p>
                    Listing Title:
                </p>
                <p>
                    Review Title:
                </p>
                <p>
                    Review:
                </p>
            </div>
            <div class="col-8">
                <p>
                    <span class="local-date"><?=$this->caseDetails['opened_date'];?></span>
                </p>
                <p>
                    <?=$this->caseDetails['nickname'];?>
                </p>
                <p>
                    <?=$this->caseDetails['reviewer_name'];?>
                </p>
                <p>
                    <?=$this->caseDetails['title'];?>
                </p>
                <p>
                    <?=$this->caseDetails['review_title'];?>
                </p>
                <p>
                    <?=$this->caseDetails['review'];?>
                </p>
            </div>
            <br clear="all">
            <div class="header-form" title="">Case Messages</div>
            
            <div class="msg-container" id="msg-container">
                <?php 
                    $size = count( $this->messages );
                    for( $i = 0; $i < $size; $i++ ):
                        if ( $this->messages[$i]['from_user'] == $this->caseDetails['owner_id']) {
                            $class  = 'msg msg-sent pull-right';
                            $sender = $this->caseDetails['nickname'];
                        }
                        else if( $this->messages[$i]['from_user'] == $this->caseDetails['member_id'] ){
                            $class  = 'msg msg-received';
                            $sender = $this->caseDetails['reviewer_name'];
                        }
                ?>
                    <div class="msg-separate <?=$class;?>">
                        <p><?=$sender;?><span class="pull-right local-date"><?=$this->messages[$i]['date'];?></span></p>
                        <p><b><?=$this->messages[$i]['message'];?></b></p>
                    </div>
                <?php endfor;?>
            </div>
        </div><!--  default-margin ends  -->
    </div><!--  content-content ends  -->
    <div id="bottom-content">
        &nbsp;
    </div>
</div><!-- main-right  -->
<script src="<?=JAVASCRIPT_LIB_URL.DIRECTORY_SEPARATOR.'utilities.js'?>"></script>
<script>
    $( '.local-date' ).each(function( index, element ){
        var date = $( element ).text();
        $(element).text( convertGMTtoLocal(date) );
    });
    scrollToBottom();
</script>