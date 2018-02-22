/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
function convertGMTtoLocal( date ){
    var parts = date.split( '-' );
    var year    = parts[0];
    var month   = parts[1];
    var parts   = parts[2].split( ' ' );
    var day     = parts[0];
    var hms     = parts[1].split( ':' );

    date = new Date( Date.UTC(year, month, day, hms[0], hms[1], hms[2]) );

    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
}
function scrollToBottom(){
    var msgBox = document.getElementById( 'msg-container' );
    msgBox.scrollTop = msgBox.scrollHeight;
}

(function( $ ){
    $.fn.changeGMTtoLocal = function( date ){
        var convertGMTtoLocal = function( date ){
            var parts = date.split( '-' );
            var year    = parts[0];
            var month   = parts[1];
            var parts   = parts[2].split( ' ' );
            var day     = parts[0];
            var hms     = parts[1].split( ':' );

            date = new Date( Date.UTC(year, month, day, hms[0], hms[1], hms[2]) );

            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        return convertGMTtoLocal( date );
    };
}(jQuery));
    