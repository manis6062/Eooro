
<?//For sitelink searchbox ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  
  "url": "<?=NON_SECURE_URL?>",
  
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?=NON_SECURE_URL?>/results/?keyword={q}",
    "query-input": {
        "@type": "PropertyValueSpecification",
        "valueRequired": true,
        "valueMaxlength": 100,
        "valueName": "q"
    }
  }
}
</script>
<?  
    include( system_getFrontendPath( 'index_banner.php') );
    //Slider
    include(EDIRECTORY_ROOT."/includes/code/slider_front.php");
	//Newsletter
    include(EDIRECTORY_ROOT."/includes/code/newsletter.php");
    //Facebook page
    setting_get("setting_facebook_link", $setting_facebook_link);

?>
              
   
    <? include( system_getFrontendPath("sitecontent_top.php")); ?>
    
    <? include( system_getFrontendPath("featured_review.php")); ?>
    
    <? include( system_getFrontendPath('most_viewed.php') ); ?>

    <?// include( system_getFrontendPath("feeds.php", 'frontend/socialnetwork'));?>
    
    <? include( system_getFrontendPath("sitecontent_bottom.php"));?>

