<?
    require CLASSES_DIR.'/apis/facebook/autoload.php';

    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookSession;

    Facebook::getFBInstance($facebook);
    $helper = $facebook->getHelper();
    // for temporary use
    $_SESSION['red_destiny'] = $urlRedirect;

if (!$fbLabel) {
    if (string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false) {
        $fbLabel = "Facebook";
    } else {
        $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
    }
}
?>
    <a target="_top" href="<?=$helper->getLoginUrl(explode(',', FACEBOOK_PERMISSION_SCOPE));?>">
        <button type="button" class="btn btn-default custombtn">
            <div class="fbbtnwrapper">
                <i class="fa fa-facebook fb"></i>
                <span><?=strtoupper($fbLabel)?></span>
            </div>
        </button>
    </a>