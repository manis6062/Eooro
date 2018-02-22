<?php

   setting_get( 'listing_detail_show_facebook', $show_facebook);
   setting_get( 'listing_detail_show_twitter', $show_twitter);

if($show_facebook == "on" || $show_twitter == "on" ){ ?>

<section class="recentReview-footer" style="margin-left:-790px;">
        <div class="container">
        	
        </div>
</section>

<? }  else { ?>

banner
 
<? } ?>
