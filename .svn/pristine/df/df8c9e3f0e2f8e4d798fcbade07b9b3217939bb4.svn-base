<?php

?>
            <header class="msg-title">
                <h2>Case Messages</h2>
            </header>
            <section class="stats-summary">
                <div class="row-fluid">
                    <div></div>
                    <div class="msg-container msg-status" id="msg-container">
                        <?php 
                            $size = count( $this->caseMessages );
                            for ( $i = 0; $i < $size; $i++ ) :
    //                            $class1 = ( $i % 2 == 0 ) ? 'pull-right' : '';
                                if($this->currentUser->getId() == $this->caseMessages[$i]['from_user'] ) { 
                                    $class  = 'msg msg-sent pull-right';
                                    $sender = 'You: ';
//                                    $seen   = preg_match( '/0000-00-00/', $this->caseMessages[$i]['delivery_status'] ) ? '' : 'seen';
                                } 
                                else{ 
                                    $class  = 'msg msg-received';
                                    $sender = "{$this->toUser->getName()}: ";
//                                    $seen   = '';
                                }
                                
                        ?>
                        <div class="span9 <?=$class;?>">
                            <p><?=$sender;?><span class="pull-right local-date"><?=$this->caseMessages[$i]['date'];?></span></p>
                            <p><b><?=$this->caseMessages[$i]['message'];?></b></p>
                        </div>
                        <?php endfor;?>
                    </div> <!--  end msg-container  -->
                </div>
                <?php if ( $this->caseDetails['case_status'] !== 'C' ) :?>
                <div class="row-fluid">
                    <form id="msg-reply-form" class="msg-status">
                        <label for="msg-reply">Your Reply</label>
                        <textarea id="msg-reply" class="msg-reply" placeholder="Type in your reply in no more than 2000 characters" maxlength="2000"></textarea>
                        <button type="button" id="msg-reply-button" class="btn btn-send">Send</button>
                    </form>
                </div>
                <?php endif; ?>
            </section><!-- Case Messages End  -->