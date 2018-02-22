<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="hidden">
  <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="<?=DEFAULT_URL?>/advetise.php">
        <span itemprop="name">Advertise</span></a>
    <meta itemprop="position" content="1" />
  </li>
</ol>
<?php 
  
    $thePageTitle = '<h3 class="transparent-bg">Sign up today - make your listing work harder.</h3>';
    include(system_getFrontendPath("advertise_banner.php"));
?>
		<?
//		if ($sitecontent) {
//			echo "<div class=\"content-custom\">".$sitecontent."</div>";
//		}
		?>

<section class="latest-review cusreview">

<?php $url = explode('/',$_SERVER['REQUEST_URI']);
?>
    <!--<div <? //if($url[2] != "advertise.php"){  echo 'class="container"';}?>>-->
    <div <?php  if(!strpos($_SERVER['REQUEST_URI'], "advertise.php")) echo 'class="container"';  ?>>
            	<!--<div class="row">-->
        <?/*?><div class="col-sm-9 cuscato">
            <div class="row">
                <div class="homesearch">
                    <h4>Home <span class="search-result">/ Events</span></h4>
                </div> <!--/homesearch--> 
            </div> <!--/row-->
        </div> <!--/col-sm-9--><?*/?>





		<div class="clearfix"></div>
<div class="parent">	

        <?php
            $signupItem = "listing";
            include(EDIRECTORY_ROOT."/signup.php");
        ?>
				
			
        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { 

            $signupItem = "event";
            include(EDIRECTORY_ROOT."/signup.php");
            }
        ?>
			
        <?php 
            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
        
                $signupItem = "classified";
                include(EDIRECTORY_ROOT."/signup.php");
            } 
        ?>
			
        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		$signupItem = "article";
                        include(EDIRECTORY_ROOT."/signup.php");
                        
            } 
         ?>
			
        <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
                $signupItem = "banner";
                include(EDIRECTORY_ROOT."/signup.php");
            } 
        ?>
<!--			            <div class="col-sm-3 child">

                <?/*
                $contentObj = new Content();
                $content = $contentObj->retrieveContentByType($sitecontentSection);
                if ($content) {
                        echo $content;
                }*/
                ?>
                
            </div>/col-sm-3-->
	</div>
        <!-- <div class="row">
                <div class="col-sm-6">
                <div class="fooads">
                        <span>Banner Advert 570px x 73px</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="fooads">
                        <span>Banner Advert 570px x 73px</span>
                </div>
            </div>
        </div> -->
    </div>
			
</section>
		
        
	
<!-- this needs to be made dynamic,,, just for now it is kept this way  -->
<!--<section class="latest-review recently-reviewed">
    <div class="container">-->
            
        <?
/*
            $contentObj = new Content();
            $content = $contentObj->retrieveContentByType("Advertise with Us Bottom");
            if ($content) {
                    echo $content;
            }
       */ ?>
        
<!--    </div>
</section>-->
<? 
//include( system_getFrontendPath('feeds.php', 'frontend/socialnetwork' ) );
?>
<style>
    .cusreview{
        background-color: #fff;
    }
</style>
