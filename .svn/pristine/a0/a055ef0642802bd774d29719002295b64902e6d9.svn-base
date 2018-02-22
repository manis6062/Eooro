<?php 
/**
 * Only Listings are supported for now.
 */
?>
<??>          
        <div class="whole-wrapper clearfix">
<!--         <div class="col-sm-12"> -->
               

                <?
                $contentObj = new Content();

                $content = $contentObj->retrieveContentByType($sitecontentSection);
               // var_dump($sitecontentSection);
                if ($content) {
                        echo $content;

                }
                ?>
                
          <!-- </div> --><!--/col-sm-12--><??>
          </div>
<div class="row plan">
<div class="col-sm-5">
                		<!--<div class="row">-->
                			<div class="well pricing">
                            	<div class="pricing-header">
                            		Premium Plan
                                </div>
                                <div class="price">
                                     <span class="one">
<?=(is_numeric($priceAux[0]) ? CURRENCY_SYMBOL : "");?><?=$priceAux[0];?></span>
            <span class="onetime">
              <?=($priceRenewal ? " / $priceRenewal" : "<span>&nbsp;</span>");?>
            </span>
        
<!--                                	<span class="one">$1</span>-->
<!--                                    <span class="year">/ year</span>-->
                                    <p><span class="special-deal">**Special Launch Deal – 2 years for price of 1</span><br>For only <?=(is_numeric($priceAux[0]) ? CURRENCY_SYMBOL : "");?><?=$priceAux[0];?> you can take full control of your companies 
page and drive new customers to your business.</p>
									<hr>
                                </div>
                                <ul class="items-wrapper">
                                	<li><i class="fa fa-angle-right"></i> Full Business Descriptions (Better for SEO)</li>
                                    <li><i class="fa fa-angle-right"></i> Case Management System (CMS) - Manage Negative Reviews</li>
                                    <li><i class="fa fa-angle-right"></i> Select up to 3 categories for your business</li>
                                    <li><i class="fa fa-angle-right"></i> Provide Full Contact Info</li>
                                    <li><i class="fa fa-angle-right"></i> Social Media – Link with your Facebook & Twitter Accounts</li>
                                    <li><i class="fa fa-angle-right"></i> Upload Pictures & Promo Video</li>
                                </ul>
                                <p>Reputation is Everything, Start Improving your Business today.</p>
                                <?
                            if(sess_isAccountLogged())
                                        { ?>
                                <a href="<?=DEFAULT_URL?>/sponsors/index.php?<?=$signupItem == "banner" ? "type" : "level"?>=<?=$levelValue?>">
                                    <button type="button" class="btn btn-success premium-btn">
                                    Get Started
                                    </button></a>
                                
                                       <? }
                                        else
                                        {
                                         ?> 
 
                                <a href="<?=DEFAULT_URL?>/order_<?=$signupItem?>.php?<?=$signupItem == "banner" ? "type" : "level"?>=<?=$levelValue?>">
                                    <button type="button" class="btn btn-success premium-btn">
                                    Sign up
                                    </button></a>
                                        <?   
                                        }
                                        ?>
                            </div>
                        <!--</div>-->
                        <!--/row-->
                    </div><!--/col-sm-4-->
                        <div class="col-sm-4">
                		<div class="well pricing">
                            	<div class="pricing-header free-plan">
                            		Free Plan
                                </div>
                                <div class="price">
                                	<span class="one">$0</span>
                                    <span class="year">/ year</span>
									<hr>
 <p><span class="nothing">Do nothing</span>, if the data we have is correct simply point your 
                customers to your page on eooro and let them start telling 
                others about how good you are. <br><br><span class="nothing its-free">Nothing to lose</span>, its Free
                </p>
                                </div>
                               <button type="button" class="btn btn-success free-btn">Get Started</button>   

                                </div>
                               
                             
                            </div>
          
</div>

         <div class="hidden"> 
<div class="col-sm-3 child">
            <!--<div class="row">-->
    <div class="thumbnail onedollarwrapper">
 
        <h4><?=(is_numeric($priceAux[0]) ? CURRENCY_SYMBOL : "");?><?=$priceAux[0];?>
            <span class="onetime">
              <?=($priceRenewal ? " / $priceRenewal" : "<span>&nbsp;</span>");?>
            </span>
        </h4>
        <div class="signup">
            <div class="singupwrapper">
                <h5><a href="<?=DEFAULT_URL?>/order_<?=$signupItem?>.php?<?=$signupItem == "banner" ? "type" : "level"?>=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a></h5>
            </div> <!--/singupwrapper-->
        </div>
        <div class="getstarted">
            <p>GET STARTED</p>
        </div><!--/getstarted-->
       
        
        <ul class="example">
            <? if ($level->getContent($levelValue)) {

                echo string_nl2li(strip_tags($level->getContent($levelValue)));

                }
                elseif ($signupItem != "banner") {?>
                  <!--  <li> 
                    <a href="<?=DEFAULT_URL."/popup/popup.php?pop_type=advertise_preview&amp;modulePreview=$signupItem&amp;level=$levelValue"?>" class="fancy_window_preview text-underline"><?=system_showText(LANG_ADVERTISE_SAMPLE);?></a>
                    </li> -->
                <?foreach ($availableFeatures as $item) {

                    if ($item == "event_time") {
                        $item = "start_time";
                    }
                    ?>

                    <li <?=((is_array(${"array_fields_".$levelValue}) && in_array($item, ${"array_fields_".$levelValue}) || $signupItem == "article") ? "" : "class=\"linethrough\"")?>><?=@constant("LANG_ADVERTISE_LIST_".strtoupper($item))?></li>

                <? } ?>

            <? } ?>

        </ul><!--/example-->
        
    </div><!--/onedollarwrapper-->
    <!--</div>-->
    <!--/row-->
</div><!--/col-sm-3--></div> <!--hidden-->
<?php if(sess_getAccountIdFromSession()){
        $url = "/sponsors/";
    } else {
        $url = "/order_listing.php?level=10";
    }
    ?>
<script>
$(document).ready(function(){
    
    $('#monthly').replaceWith("<p><?=$price_listing['symbol']?><span><?=$price_listing['price_listing_monthly']?></span> /month</p>");
    
    $('#yearly').replaceWith("<p><?=$price_listing['symbol']?><span><?=$price_listing['price_listing']?></span> /year</p>");
    
    $('#yearly_price_plan').replaceWith("<span class='pricetag'><?=$price_listing['symbol']?><?=floor($price_listing['price_listing'])?></span>");
    
    $('#monthly_price_plan').replaceWith("<span class='pricetag'><?=$price_listing['symbol']?><?=floor($price_listing['price_listing_monthly'])?></span>");
    
    //$('.purchase').replaceWith('<button class="btn btn-success purchase" type="button" onclick="location.href=\'<?=DEFAULT_URL . $url ?>\';">Get this plan</button>')
})
</script>