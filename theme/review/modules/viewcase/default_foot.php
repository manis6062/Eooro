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
</div><!-- container ends -->
 <? /*
 if($_SERVER['HTTP_X_REQUESTED_WITH']){ ?>
    <p class="standardButton">
        <a id="transaction-back" onclick="$('#listing-cases').click();" class="button customStandardButton">Back</a>
    </p>
<? } */?>
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
                    //console.log(response);
                    // TODO: cross browser compatibility issue
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(response, "text/html");
                    var content = $( '.ajax-reply', doc );
                    console.log( doc );
                    console.log( content );
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
                //console.log( response );
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
            
            date = new Date( Date.UTC(year, month-1, day, hms[0], hms[1], hms[2] ) );
                        
            var options = {   year:'numeric', month: 'long', day: 'numeric', timeZone: 'UTC', formatMatcher:'basic' };
            var date1 = date.toLocaleTimeString()+" "+  date.toLocaleDateString();
            

            var parts1 = date1.split( ' ' );
            var dat = parts1[1]; //console.log(dat);
            var tim = parts1[0]; //console.log(tim);

            var dt = new Date();
            var cur_dat = $.datepicker.formatDate('dd/mm/yy', new Date()); //console.log(cur_dat);
            var cur_tim = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds(); 
            var localeSpecificTime = date.toLocaleTimeString( 'en-US', { hour12: true });

             if(dat == cur_dat) {
                
                var dms = date.getTime(); 
                var cms = dt.getTime(); 
                var diff = cms-dms;
                var temp = diff/86400000; 
                var day = Math.floor(temp); 
                 if(day<1){
                    temp = 24*(temp-day); 
                    var hour = Math.floor(temp); 
                    if(hour){if(hour==1){hour= "- "+hour+" hour ago"; min=""; sec="";}else{hour= "- "+hour+" hours ago"; min=""; sec="";}}else{hour="";}
                    temp=60*(temp-hour); 
                    var min = Math.floor(temp); 
                    if(min){if(min==1){min= "- "+min+" minute ago"; hour=""; sec="";}else {min="- "+min+" minutes ago"; hour="";sec="";}}else{min="";}
                    temp = 60*(temp-min); 
                    var sec = Math.floor(temp); 
                    if(sec){if(sec==1){sec= "- "+sec+" second ago"; hour=""; min="";}else {sec="- "+sec+" seconds ago"; hour="";min="";}}else{sec="";}
                  
                  }
                  else{
                    hour=min=sec="";
                  }
                
                return hour+" "+min+" "+sec;
              }
                 else {
                    return date.toLocaleDateString('en-US', options) + ', ' + localeSpecificTime.replace(/:\d+ /, ' ');
                 }
        }
        catch( e ){
            // deal with it
            return '';
        }
    }
    $( document ).ready(function(){
            //retrieve-date
        $( '.local-date' ).each(function( index, element ){
            var gmt = $( element ).text();
            $( element ).text( convertGMTtoLocal(gmt) );
            $(".local-date").css("display", "");
            // len=$(".local-date").text().length;
            // console.log(len);




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