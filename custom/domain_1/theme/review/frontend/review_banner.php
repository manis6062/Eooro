<section class="banner res-banner <?=$customBannerSectionClass?>">
    <div class="banner-wrapper resbanner <? 
    $e_url = explode('/', $_SERVER['REQUEST_URI']);
    $r_url = $e_url[sizeof($e_url)-2];
    echo $r_url.'test';
    if(strtolower($r_url != 'claim')) echo $customBannerDivClass; ?>">
        <div class="container">
            <div class="row size1">
        	<div class="logo reslogo pull-left">
                    <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> >
                        <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/eooro-white.png" alt="logo" class="logohighreso" width="250px" height="45px"/>
                    </a>
                    <div class="hwrap1">
                      <!--   <h1 style=" text-transform: none;">
                        <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/white-logo-title.png" alt="logo-title" class="logo-title" width="250px"/>
                        </h1> -->
                         <span class="repu">Reputation Is Everything</span>
                         
                    </div>
            </div>
                <div class="search col-sm-7 newsearch newsearch1 " style="padding: 0;">
                    <?php //include( system_getFrontendPath('search.php') );
                        include( EDIRECTORY_ROOT.'/searchfront.php' );
                    ?>
                </div> <!--/custom-search-input-->
                
            </div> <!--/row-->
    	</div> <!--/container-->
    </div> <!--/banner-wrapper-->
    <div class="container">
    	<div class="row">
            <?=$thePageTitle?>
    	</div>
    </div>
</section>
