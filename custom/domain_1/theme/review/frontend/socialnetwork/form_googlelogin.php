<?
    if (!$goLabel) {
        if (string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false) {
            $goLabel = system_showText(LANG_LOGINGOOGLEUSER); //"Google"; 
        } else {
            $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
        }
    }
    $state = $_SESSION['go_state'] = md5( uniqid() );
?>
<?php if ($foreignaccount_google) {?>
    <a target="_top"id="googleSignInButton" href="javascript: void(0);">
        <button type="button" class="btn btn-default custombtn">
            <div class="fbbtnwrapper gplus">
                <i class="fa fa-google-plus fb gp"></i>
                <span><?=strtoupper($goLabel)?></span>
            </div>
        </button>
    </a>
<?} ?>
<script language="javascript" type="text/javascript">
   
    var destiny = '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/googleauth.php?login$urlRedirect"?>';
    ( function($){
        $( document ).ready(function(){
            $( '#googleSignInButton' ).click(function(){
                $( this ).attr( 'href', 'https://accounts.google.com/o/oauth2/auth?scope=' +
                                'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.profile.emails.read&' +
                                'state=<?=$state?>&' +
                                'redirect_uri=<?=GOOGLE_REDIRECT_URL?>&'+
                                'response_type=code&' +
                                'client_id=<?=GOOGLE_CLIENT_ID?>&' +
                                'access_type=online' );
                
            });
        });
    })(jQuery);
    
    //]]>
</script>