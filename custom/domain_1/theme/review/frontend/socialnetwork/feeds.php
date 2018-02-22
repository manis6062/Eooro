
<section class="latest-review shadow">
    <div class="container">
            <div class="row">
                <h3>Social Media</h3>
            </div>
    	<div class="row">
            <div class="col-sm-4 faceBook">
            	<? include(system_getFrontendPath("facebook_feeds.php", 'frontend/socialnetwork')); ?>
            </div>
            <div class="col-sm-4">
            	<? include(system_getFrontendPath("twitter_feeds.php", 'frontend/socialnetwork')); ?>
            </div>
            <div class="col-sm-4">
            	<? //include(system_getFrontendPath("google_feeds.php", 'frontend/socialnetwork')); ?>
            </div>
    	</div>
    </div> <!--/container-->
</section>
