<?/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 
<section class="banner res-banner <?=$customBannerSectionClass?>">
    <div class="banner-wrapper resbanner <?=$customBannerDivClass?>">
        <div class="container">
            <div class="row size1">
        	<div class="logo reslogo pull-left">
                    <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> >
                        <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/eooro-white.png" alt="logo" class="logohighreso" width="250px" height="54px" />
                    </a>
                    <div class="hwrap1">
                        <!-- <h1 style=" text-transform: none;"> -->
                            <!-- <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/white-logo-title.png" alt="logo-title" class="logo-title" width="170px"/> -->
                             <span class="repu">Reputation Is Everything</span>
                             <!-- <div class="tm1">TM</div> -->
                        <!-- </h1> -->
                    </div>
                </div>
                <div class="search col-sm-7 newsearch newsearch1" style="padding:0">
                    <?php //include( system_getFrontendPath('search.php') );
                        //include( EDIRECTORY_ROOT.'/searchfront.php' );
                    ?>
                    <br>
        <? //search box for FAQ?>
        
            <div class="row-fluid">
                <form name="faq" style="margin:0;" action="<?=system_getFormAction($faq_front ? $_SERVER["REQUEST_URI"] : $_SERVER["PHP_SELF"])?>" method="get">
                    
                    <a href="<?=DEFAULT_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">
                        <?//=system_showText(LANG_FAQ_CONTACT);?>
                    </a>    
                    <div id="custom-search-input" class="search-advanced">
                     <div class="transparent-bg">
                      <form class="form" name="search_form" method="get" action="<?php echo DEFAULT_URL.'/company-reviews/results.php'; ?>">
                <h2>Did not find your answer? Contact us.</h2>
                <div id="custom-search-input" class="search-advanced">
                    <div class="search-keyword input-group location">
                        <input type="text" name="keyword" class="search-query form-control without-country" id="keyword" placeholder="<?=system_showText(LANG_FAQ_TIP);?>" value="">
                        <span class="input-group-btn search-button">
                            <button class="btn btn-danger btn-info btn-search" type="submit">
                                Search
                            </button>
                        </span>
                    </div>
                    <input type="hidden" name="where" id="where" placeholder="Location to search..." value="United Kingdom" class="ac_input" autocomplete="off">
                    <!--</div>-->
                    <input type="hidden" name="sel" id="sel" value="">
                </div><!--/custom-search-input-->

            </form>
                     </div>     
                    </div>
                </form>
            </div>
                    
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