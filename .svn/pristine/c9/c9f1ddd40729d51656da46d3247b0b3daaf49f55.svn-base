<?

require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_CountryLoader.php';


    if(sess_getAccountIdFromSession()){
        $url = "/sponsors/";
    } else {
        $url = "/order_listing.php?level=10";
    }
    $price_listing = CountryLoader::getListingPriceBasedOnIP();
?>


    <section class="advertise clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-center marginLeft">
                    <div class="transBg">
                        <h1>BUILD YOUR REPUTATION &amp; BOOST YOUR SALES</h1>
                        <!-- Sub heading text put inside class loremIpsum -->
                        <p class="loremIpsum"></p>
                    </div>
                    <button type="button" class="btn btn-success startPriceBtn" onclick="order_now();">
                    Only 
                    <span class="dollarPrice"><?=$price_listing['symbol']?><?=$price_listing['price_listing_monthly']?></span>/month</button>
                </div>
            </div>

      </div>  
    </section>
