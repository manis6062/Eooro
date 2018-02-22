 <section class="banner">
    <div class="banner-wrapper">
        <div class="container">
            <div class="row size">
                <div class="logo pull-left">
                    <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> >
                        <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/eooro-white.png" alt="logo" class="logohighreso" width="250px" height="54px"/>
                    </a>
                </div>
                <div class="hwrap pull-right">
                   <!-- <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/white-logo-title.png" alt="white-logo-title" class="logo-title" width="300px"/> -->
                   <h1>Reputation Is Everything<sup>TM</sup></h1>
                  
                </div>
            </div> <!--/row-->
        </div> <!--/container-->
    </div> <!--/banner-wrapper-->
    <div class="container">
        <div class="row">
               <div class="search col-sm-7 newsearch">
                <?php
                if ( string_strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR."/") === false && 
                    string_strpos($_SERVER['REQUEST_URI'], ALIAS_CONTACTUS_URL_DIVISOR.".php") === false && 
                    string_strpos($_SERVER['REQUEST_URI'], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && 
                    string_strpos($_SERVER['REQUEST_URI'], "/order_") === false && 
                    string_strpos($_SERVER['REQUEST_URI'], ALIAS_FAQ_URL_DIVISOR.".php") === false && !$hide_search) {

                    include(EDIRECTORY_ROOT."/searchfront.php");
                } 
                //system_getFrontendPath('search.php'); ?>
            </div> 
        </div> 
    </div>
    <div class="banner-wrapper banner-cus">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 cushave">
                <div class="greencircle"><em>1</em></div>
                <span class="haveyour">Have your say</span>
            </div>
            <div class="col-sm-4 cusget">
                <div class="greencircle orangecircle"><em>2</em></div>
                <span class="haveyour">Get clued up</span>
            </div>
            <div class="col-sm-4 cusshare">
                <div class="greencircle bluecircle"><em>3</em></div>
                <span class="haveyour">Share with others</span>
            </div>
        </div>
    </div>
    </div> <!--/banner-wrapper-->
</section>
        
