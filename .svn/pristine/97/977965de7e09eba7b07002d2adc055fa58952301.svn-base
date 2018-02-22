<?php

?>
            <header class="msg-title">
                <h2>Case Messages</h2>
            </header>
            <section class="stats-summary">
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
                        <div class="span9 <?=$class;?>"> <? $date = $this->caseMessages[$i]['date']; ?>
                             
                            <p><?=$sender;?>
                                <span class="local-date pull-right" style="display:none"> <?=$this->caseMessages[$i]['date'];?></span>
                            </p>
                            <p><b><?=$this->caseMessages[$i]['message'];?></b></p>
                        </div>
                        <?php endfor;?>
                    </div> <!--  end msg-container  -->
                <?php if ( $this->caseDetails['case_status'] !== 'C' ) :?>
                    <form id="msg-reply-form" class="msg-status">
                        <label for="msg-reply">Your Reply</label>
                        <textarea id="msg-reply" class="msg-reply extra-listing" placeholder="Type in your reply in no more than 2000 characters" maxlength="2000"></textarea>
                        <button type="button" id="msg-reply-button" class="btn btn-send your-reply">Send</button>
                    </form>
                <?php endif; ?>
            </section><!-- Case Messages End  -->