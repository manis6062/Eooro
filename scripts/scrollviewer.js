/**
 * @author          Subigya Jyoti Panta
 * @subpackage      ScrollViewer
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

$.fn.scrollViewer = function( options ){
    var original   = {
            pageRatio           : 0.8,
            scrollingDocument   : document,
            viewingWindow       : window,
            itemType            : 'listing',
            itemId              : 1,
            screen              : 2,
            ajaxURL             : DEFAULT_URL + "/loadReviewsBottomless.php",
            ajaxType            : 'POST',
            responseContainer   : '.helpful-reviews',
            loadingGif          : DEFAULT_URL + '/custom/domain_1/theme/stremline/images/iconography/icon-loading-footer.gif',
            loadingContainerId  : 'loading-container',
            filterContents      : false,
            filterSelector      : null,
            endOfResult         : 0,
            loadResult          : true
    };
    var settings    = $.extend( {}, original, options );
    var loadResult  = settings.loadResult;
    var loading     = '<div id="'+settings.loadingContainerId+'"><div id="spinner" align="center"><i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:10px;font-size:20pt;"></i><br><h2 style="color:#000;font-size:10px;"> Please Wait...</h2></div></div>';
    var isEndOfResult  = function( param, response ){
        if( typeof param === 'function' ){
            return param( response );
        }
        else{
            if( param == response ){
                // end of result ho
                return true;
            }
            else{
                // end of result hoina
                return false;
            }
        }
    };
    $( document ).ready(function(){
        var $document   = $( settings.scrollingDocument );
        var $window     = $( settings.viewingWindow );
        $document.scroll(function(event){
            
            if( $document.scrollTop() >= $document.height() * 0.8 - $window.height() && loadResult ){
//                console.log( 'aaa' );
//                console.log( settings.screen, ' SCREEN ' );
                $.ajax({
                    url: settings.ajaxURL,
                    type: settings.ajaxType,
                    data: { 
                        item_type   : settings.itemType,
                        item_id     : settings.itemId,
                        screen      : settings.screen
                           },
                    beforeSend: function(){
                        loadResult = false;
                         $( settings.responseContainer ).append( loading );
                    },
                    success: function( response ){
                        if( settings.responseLog ){
//                        console.log( response );
//                            console.log( settings.screen, ' SCREEN ' );
//                            console.log( 'RESPONSE --> ', response );
                        }
                        if( settings.filterContents ){
                            var responseMain = $( settings.filterSelector.keep, response );
                            response        = responseMain.html();
                            if( settings.filterSelector.discard ){
                                var aa = settings.filterSelector.discard.join(',');
                                // console.log( aa );
                                response = responseMain.contents().not( settings.filterSelector.discard.join(',') ); 
//                                console.log( 'RESPONSE --> ', responseMain.html() );
                            }
                        }
//                        console.log( 'RESPONSE --> ', response );
                        settings.screen++;
                        
                        if( isEndOfResult( settings.endOfResult, response ) ){
                            loadResult = false; 
                        }
                        else {
                            // end of result hoina so append
                            $( settings.responseContainer ).append( response );
                            loadResult = true;   
                        }
                    },
                    complete : function(){
                        $( '#'+settings.loadingContainerId ).remove();
                    }
                });
            }
        }); 
    });
    
    return this; // for chaining
};
