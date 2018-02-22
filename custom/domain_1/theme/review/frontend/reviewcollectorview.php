
<section class="login review popup">

    <div class="popup-review">
        <div class="info">
            <? if ($message_review) {
                if ($success_review) { 
                    $listing_friendlyurl = $itemObj->getString('friendly_url');
            ?>
                    <p class="successMessage">
                        <?=$message_review?>
                        Please wait we are redirecting you to business page <span id='count'></span> secs.
                    </p>
                    <script>
                    setTimeout(location.href = "<?=DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/'.$listing_friendlyurl;?>",3000);
                    window.onload = function(){
                    (function(){
                      var counter = 4;

                      setInterval(function() {
                        counter--;
                        if (counter >= 1) {
                          span = document.getElementById("count");
                          span.innerHTML = counter;
                        }

                      }, 1000);

                    })();

                    }
                    </script>

                <? }
            } ?>
        </div>

        <? if (!$success_review) { ?>
        
        
        
        <form name="rate_form" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>" method="post" class="form" role="form">
            <input type="hidden" id="item_type" name="item_type" value="<?=$item_type?>" />
            <input type="hidden" id="item_id" name="item_id" value="<?=$item_id?>" />
            <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

            <?
                if(!$review_details){
                     include(INCLUDES_DIR."/forms/form_review_reviewcollector.php"); 
                }
                else{
                   include(INCLUDES_DIR."/forms/form_update_reviewcollector.php"); 
                }

            ?>

        </form>
        
        
        
        
        <? } ?>
    </div>
</section>
