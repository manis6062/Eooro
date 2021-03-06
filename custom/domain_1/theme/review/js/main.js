var cookCookies = {
        getCookie: function( name ){
            if (document.cookie.length > 0) {
                var c_start = document.cookie.indexOf(name + "=");
                if (c_start != -1) {
                    c_start = c_start + name.length + 1;
                    var c_end = document.cookie.indexOf(";", c_start);
                    if (c_end == -1) {
                        c_end = document.cookie.length;
                    }
                    return decodeURI(document.cookie.substring(c_start, c_end));
                }
            }
            return "";
        },
        setCookie: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
            var sExpires = "";
            if (vEnd) {
                switch (vEnd.constructor) {
                    case Number:
                        sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                        break;
                    case String:
                        sExpires = "; expires=" + vEnd;
                        break;
                    case Date:
                        sExpires = "; expires=" + vEnd.toUTCString();
                        break;
                }
            }
            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
        }
    };

//Javascript for Cookie Bar
 
(function($){
    $.cookieBar = function(options,val){
        if(options=='cookies'){
            var doReturn = 'cookies';
        }else if(options=='set'){
            var doReturn = 'set';
        }else{
            var doReturn = false;
        }
        var defaults = {
            message: '<font size="2pt">We use<a href="privacypolicy.php" target="_blank">cookies</a>. By continuing you confirm you accept.</font>', //Message displayed on bar
            acceptButton: true, //Set to true to show accept/enable button
            acceptText: '<font size="1.5pt">Ok</font>', //Text on accept/enable button
            declineButton: false, //Set to true to show decline/disable button
            declineText: 'Disable Cookies', //Text on decline/disable button
            policyButton: false, //Set to true to show Privacy Policy button
            policyText: 'Privacy Policy', //Text on Privacy Policy button
            policyURL: '/privacy-policy/', //URL of Privacy Policy
            autoEnable: false, //Set to true for cookies to be accepted automatically. Banner still shows
            acceptOnContinue: false, //Set to true to silently accept cookies when visitor moves to another page
            expireDays: 365, //Number of days for cookieBar cookie to be stored for
            forceShow: false, //Force cookieBar to show regardless of user cookie preference
            effect: 'slide', //Options: slide, fade, hide
            element: 'body', //Element to append/prepend cookieBar to. Remember "." for class or "#" for id.
            append: false, //Set to true for cookieBar HTML to be placed at base of website. Actual position may change according to CSS
            fixed: false, //Set to true to add the class "fixed" to the cookie bar. Default CSS should fix the position
            bottom: false, //Force CSS when fixed, so bar appears at bottom of website
            zindex: '', //Can be set in CSS, although some may prefer to set here
            redirect: String(window.location.href), //Current location
            domain: String(window.location.hostname), //Location of privacy policy
            referrer: String(document.referrer) //Where visitor has come from
        };
        var options = $.extend(defaults,options);
        
        //Sets expiration date for cookie
        var expireDate = new Date();
        expireDate.setTime(expireDate.getTime()+(options.expireDays*24*60*60*1000));
        expireDate = expireDate.toGMTString();
        
        var cookieEntry = 'cookie_accepted={value}; expires='+expireDate+'; path=/';
        
        //Retrieves current cookie preference
        var i,cookieValue='',aCookie,aCookies=document.cookie.split('; ');
        for (i=0;i<aCookies.length;i++){
            aCookie = aCookies[i].split('=');
            if(aCookie[0]=='cookie_accepted'){
                cookieValue = aCookie[1];
            }
        }
        //Sets up default cookie preference if not already set
        if(cookieValue=='' && options.autoEnable){
            cookieValue = 'enabled';
            document.cookie = cookieEntry.replace('{value}','enabled');
        }
        if(options.acceptOnContinue){
            if(options.referrer.indexOf(options.domain)>=0 && String(window.location.href).indexOf(options.policyURL)==-1 && doReturn!='cookies' && doReturn!='set' && cookieValue!='true' && cookieValue!='declined'){
                doReturn = 'set';
                val = 'true';
            }
        }
        if(doReturn=='cookies'){
            //Returns true if cookies are enabled, false otherwise
            if(cookieValue=='enabled' || cookieValue=='true'){
                return true;
            }else{
                return false;
            }
        }else if(doReturn=='set' && (val=='true' || val=='declined')){
            //Sets value of cookie to 'accepted' or 'declined'
            document.cookie = cookieEntry.replace('{value}',val);
            if(val=='true'){
                return true;
            }else{
                return false;
            }
        }else{
            //Sets up enable/accept button if required
            var message = options.message.replace('{policy_url}',options.policyURL);
            
            if(options.acceptButton){
                var acceptButton = '<a style="cursor:pointer" class="cb-enable">'+options.acceptText+'</a>';
            }else{
                var acceptButton = '';
            }
            //Sets up disable/decline button if required
            if(options.declineButton){
                var declineButton = '<a href="" class="cb-disable">'+options.declineText+'</a>';
            }else{
                var declineButton = '';
            }
            //Sets up privacy policy button if required
            if(options.policyButton){
                var policyButton = '<a href="'+options.policyURL+'" class="cb-policy">'+options.policyText+'</a>';
            }else{
                var policyButton = '';
            }
            //Whether to add "fixed" class to cookie bar
            if(options.fixed){
                if(options.bottom){
                    var fixed = ' class="fixed bottom"';
                }else{
                    var fixed = ' class="fixed"';
                }
            }else{
                var fixed = '';
            }
            if(options.zindex!=''){
                var zindex = ' style="z-index:'+options.zindex+';"';
            }else{
                var zindex = '';
            }
            
            //Displays the cookie bar if arguments met
            if(options.forceShow || cookieValue=='enabled' || cookieValue==''){
                if(options.append){
                    $(options.element).append('<div id="cookie-bar"'+fixed+zindex+'><p>'+message+acceptButton+declineButton+policyButton+'</p></div>');
                }else{
                    $(options.element).prepend('<div id="cookie-bar"'+fixed+zindex+'><p align=center>'+message+acceptButton+declineButton+policyButton+'</p></div>');
                }
            }
            
            //Sets the cookie preference to accepted if enable/accept button pressed
            $('#cookie-bar .cb-enable').click(function(){
                document.cookie = cookieEntry.replace('{value}','true');
                $('#cookie-bar').slideUp(300,function(){$('#cookie-bar').remove();});
                if(cookieValue!='enabled' && cookieValue!='true'){
                    // window.location = options.currentLocation;
                }else{
                    if(options.effect=='slide'){
                        $('#cookie-bar').slideUp(300,function(){$('#cookie-bar').remove();});
                    }else if(options.effect=='fade'){
                        $('#cookie-bar').fadeOut(300,function(){$('#cookie-bar').remove();});
                    }else{
                        $('#cookie-bar').hide(0,function(){$('#cookie-bar').remove();});
                    }
                    return false;
                }
            });
            //Sets the cookie preference to declined if disable/decline button pressed
            $('#cookie-bar .cb-disable').click(function(){
                var deleteDate = new Date();
                deleteDate.setTime(deleteDate.getTime()-(864000000));
                deleteDate = deleteDate.toGMTString();
                aCookies=document.cookie.split('; ');
                for (i=0;i<aCookies.length;i++){
                    aCookie = aCookies[i].split('=');
                    if(aCookie[0].indexOf('_')>=0){
                        document.cookie = aCookie[0]+'=0; expires='+deleteDate+'; domain='+options.domain.replace('www','')+'; path=/';
                    }else{
                        document.cookie = aCookie[0]+'=0; expires='+deleteDate+'; path=/';
                    }
                }
                document.cookie = cookieEntry.replace('{value}','declined');
                if(cookieValue=='enabled' && cookieValue!='true'){
                    // window.location = options.currentLocation;
                }else{
                    if(options.effect=='slide'){
                        $('#cookie-bar').slideUp(300,function(){$('#cookie-bar').remove();});
                    }else if(options.effect=='fade'){
                        $('#cookie-bar').fadeOut(300,function(){$('#cookie-bar').remove();});
                    }else{
                        $('#cookie-bar').hide(0,function(){$('#cookie-bar').remove();});
                    }
                    return false;
                }
            });
        }
    };
})(jQuery);
//sponsors Login page hide show
$(document).ready(function(){
    $('#emailBtn').click(function(){
        $('#loginForm').show();
        $('#loginBtnWrapper').hide();

    });

});

//scripts review main

//Accept Cookie Bar
$(document).ready(function(){$.cookieBar({})});

//Hide Content includes/views/view_review_detail_review.php
// function hidecontent(va){
//     var i = va;
//     var ds= $("#display_"+i);
//     var image= $("#image_"+i);

//     $(image).click(function() {
//         $(ds).toggle();


//     });

// }

// function hidecontent(va){
        
//       var i = va;    
//       var ds = document.getElementById('display_'+i);
//       var image = document.getElementById('image_'+i);
//         if (ds.style.display === 'block'){
//            ds.style.display = 'none';
//            image.style.display = "";
//         }
//         else {
//            ds.style.display = 'block';
//            image.style.display = "none";
//         }
//     }
