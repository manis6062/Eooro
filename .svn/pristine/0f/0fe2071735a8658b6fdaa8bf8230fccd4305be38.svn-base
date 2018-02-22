<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
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
                    "id"        : "<?=$this->caseDetails['review_id'];?>", 
                    "details"   : details 
                },
                success: function( response ){
                    console.log(response);
                    var content = $( '.ajax-reply', response );
                    var gmt     = $( '.local-date', content ).text();
//                    console.log( gmt );
//                    console.log( changeUTCtoLocal( gmt ) );
                    $( '.local-date', content ).text( convertGMTtoLocal( gmt ) );
                    $( '#msg-container' ).append( content );
                },
                complete: function( response ){
                    scrollToBottom();
                    document.getElementById( 'msg-reply' ).value = '';
                }
            });
        }
        else{
            event.preventDefault();
        }
    });
    
    $( '.msg-status' ).on( 'click focus', function(){
        var details = { 
                            "owner_id"      : "<?=$this->caseDetails['owner_id'];?>",
                            "member_id"   : "<?=$this->caseDetails['member_id'];?>",
                            "case"  : "<?=$this->caseDetails['case_id'];?>"
                        };
        $.ajax({
            url: "<?=CASE_URL;?>",
            type: "POST",
            data: {
                "action"    : "updateSeen",
                "id"        : "<?=$this->caseDetails['review_id']?>", 
                "details"   : details 
            },
            success: function( response ){
                console.log( response );
            }
        });
    });
    
    function convertGMTtoLocal( date ){
        try{
            var parts = date.split( '-' );
            var year    = parts[0];
            var month   = parts[1];
            var parts   = parts[2].split( ' ' );
            var day     = parts[0];
            var hms     = parts[1].split( ':' );

            date = new Date( Date.UTC(year, month, day, hms[0], hms[1], hms[2]) );

            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        catch( e ){
            // deal with it
            return '';
        }
    }
    $( document ).ready(function(){
        $( '.local-date' ).each(function( index, element ){
            var gmt = $( element ).text();
            $( element ).text( convertGMTtoLocal(gmt) );
        }); 
    });
    
//    $( 'a.fancy_window_closecase' ).fancybox();
    
    // close case
    $( '.case-dropdown' ).on( 'click', 'a', function(){
        var closeOption = $( this ).data( 'close' );
        if ( closeOption ) {
            var details = { 
                    "closeMethod"   : closeOption,
                    "case"          : "<?=$this->caseDetails['case_id'];?>",
                    "id"        : "<?=$this->caseDetails['review_id'];?>",
                    "review"    : "<?=$this->caseDetails['review_id'];?>"
                };

            $.ajax({
                url: "<?=EXTRAS_REQ.DIRECTORY_SEPARATOR.'ajax.php';?>",
                type: "POST",
                data: {
                    "module"    : "casemanager",
                    "con"       : "viewcase",
                    "action"    : "showCaseCloseAgreement", 
                    "details"   : details 
                },
                success: function( response ){
                    console.log( response );
                    $.fancybox.open(
                            [{
                                content: response,
                                'width': 600,
                                'height' : 280,
                                'autoSize' : false
                            }]
                        );
                }
            });
        }
    });
</script>