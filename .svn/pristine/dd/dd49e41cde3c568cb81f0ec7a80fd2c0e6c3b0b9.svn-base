<?
/* ==================================================================*\
  ######################################################################
  #                                                                    #
  # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
  #                                                                    #
  # This file may not be redistributed in whole or part.               #
  # eDirectory is licensed on a per-domain basis.                      #
  #                                                                    #
  # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
  #                                                                    #
  # http://www.edirectory.com | http://www.edirectory.com/license.html #
  ######################################################################
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form_backlinks.php
# ----------------------------------------------------------------------------------------------------

if (strpos($_SERVER['SERVER_NAME'], "eooro") > -1) {
    $partial_uri = "//eooro.net/widget/";
} elseif (strpos($_SERVER['SERVER_NAME'], "lcnservers") > -1) {
    $partial_uri = "//vps65937-6.lcnservers.com/widget/";
} else {
    $partial_uri = "//localhost/widget/";
}

$partial_uri_small = $partial_uri . "small/";
if(!empty($listing->custom_dropdown5)){
    $widget_uri = $partial_uri . $listing->custom_dropdown5;
}else{
 $widget_uri = $partial_uri . $listing->friendly_url;
}

if(!empty($listing->custom_dropdown5)){
  $widget_uri_small = $partial_uri . "small/" . $listing->custom_dropdown5;
}
else{
  $widget_uri_small = $partial_uri . "small/" . $listing->friendly_url;
}



$widget_uri_backlink = $partial_uri . "backlink/";
// Old Version
//$widget_uri_horizontal = $partial_uri . "horizontal/";


//New Version V2
$widget_uri_horizontal = $partial_uri . "horizontal-V2/";
$widget_uri_horizontal_970 = $partial_uri . "horizontal-970/";



//Vertical Version 
//$widget_uri_vertical = $partial_uri . "";

//Vertical Version 2 
$widget_uri_vertical = $partial_uri . "vertical-V2/";




?>

<?
if ($message_backlink) {
    echo "<p class=\"errorMessage\">";
    echo $message_backlink;
    echo "</p>";
}
?>

<form name="backlinks" id="backlinks" method="post">
<div class="row">
    <div class="col-sm-12 col-md-7 col-lg-7">
         <div class="reviewCollector">
         <h2 style="color:#000;">Website Widget</h2>   
          <div class="hidden-xs embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/GY3m50UgcLU"></iframe>
          </div>
          <div class="websiteWidgetWrapper">
              <h4><strong>Why add a Website Widget?</strong></h4>
                <p>Adding one of Eooro’s widgets to your website lets potential new customers know that you care about your reputation and this instills confidence straight away.</p> <!-- As a bonus, once you verify the widget is on your site we give you a “Verified” status on your business page.-->
              <h4><strong>What's in it for me?</strong></h4>
                <p>Adding one of our widgets to the homepage of your website not only links your customers directly to your review page on eooro, but it helps improve your online presence.</p>
                <p>As it is also is a form of link exchange between eooro and your website, it helps enhance both websites online presence by backlinking to each other.</p>
                <p>Read this for more information about backlinks - <a href="https://en.wikipedia.org/wiki/Backlink" style="color:#337ab7;font-weight:normal;">https://en.wikipedia.org/wiki/Backlink.</a></p>
          </div>
          </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="addingWebsiteWrapper" style="overflow:hidden;">
              <h4><strong><u>How to add a Website Widget to your website</u></strong></h4>
                <div
                  <div class="col-sm-4">
                    <strong>Step 1</strong><br>
                    <p>Choose the website widget below you like.</p>
                  </div>
                  <div class="col-sm-4">
                    <strong>Step 2</strong><br>
                    <p>Click the "HTML" tab and copy the code.</p>
                  </div>
                  <div class="col-sm-4">
                    <strong>Step 3</strong><br>
                    <p>Paste the code into the front page of your website.</p>
                  </div>

            </div>
          </div>
        </div>
        

            <input type="hidden" name="id" value="1176">
            <input type="hidden" id="backlinkValid" name="backlinkValid" value="0">	
            <div class="content-custom">
            </div>
            <div class="bottom">
        
            </div>
    </div>


    <div class="col-sm-12 col-md-5 col-lg-5 ">
        <div class="websiteWidget-free-wrapper clearfix">
            <ul class="nav nav-tabs websiteWidget-free">
                <li class="active"><a href="#websiteWidget-widget-free" data-toggle="tab">Widget</a>  </li>
                <li><a href="#websiteWidget-HTML" data-toggle="tab">HTML Code</a> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in free-widget" id="websiteWidget-widget-free">
                    <iframe src="<?= $widget_uri_small ?>" scrolling="no" frameborder="0" style="overflow:hidden;height:163px;width:250px;background-color:transparent;" height="150px" width="250px"></iframe>
                    <div class="widthHeight">
                        <strong>250px x 163px</strong>
                    </div>		

                </div>
                <div class="tab-pane fade" id="websiteWidget-HTML">
                    <textarea name="websiteWidget-textarea" id="inputWebsite-free" class="form-control websiteWidgetTextarea" >
                        <iframe src="<?php
                        if(!empty($listing->custom_dropdown5)){
                            echo $partial_uri_small.$listing->custom_dropdown5;
                        }else{
                            echo $partial_uri_small.$listing->friendly_url;
                        } ?>"
                            scrolling="no"
                            style="float:left;border:0px;width:250px;height:183px;">
                        </iframe>
                    </textarea>

                </div>
            </div>
        </div>

        <div class="websiteWidget-premium-wrapper">

            <ul class="nav nav-tabs websiteWidget-premium">
                <li class="active"><a href="#websiteWidget-widget-premium" data-toggle="tab">Widget</a></li>
                <li><a href="#websiteWidget-HTML-premium" data-toggle="tab">HTML Code</a> </li>
            </ul>	

            <div class="tab-content">
                <div class="tab-pane fade active in premium-widget" id="websiteWidget-widget-premium">
                    <iframe src="<?php
                        if(!empty($listing->custom_dropdown5)){
                            echo $widget_uri_vertical.$listing->custom_dropdown5;
                        }else{
                            echo $widget_uri_vertical.$listing->friendly_url;
                        } ?>" scrolling="no" frameborder="0" style="overflow:hidden;height:710px;width:325px;background-color:transparent;" height="440px" width="325px"></iframe>
                    <div class="widthHeight">
                        <strong>325px x 710px</strong>
                    </div>	
                </div>

                <div class="tab-pane fade" id="websiteWidget-HTML-premium">
                    <textarea name="websiteWidget-textarea" id="inputWebsite-premium" class="form-control websiteWidgetTextarea" rows="3">

                    <iframe  src="<?php
                        if(!empty($listing->custom_dropdown5)){
                            echo $widget_uri_vertical.$listing->custom_dropdown5;
                        }else{
                            echo $widget_uri_vertical.$listing->friendly_url;
                        } ?>"
                            scrolling="no"
                            style="float:left;border:0px;width:300px;height:486px;"></iframe>
                    </textarea>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Horizontal Widget -->
<div class="horizontalWidgetSection">
    <div class="row">
        <div class="col-sm-12">	
            <div class="websiteWidget-verify-wrapper-horizontal">

                <ul class="nav nav-tabs websiteWidget-verify-horizontal">
                    <li class="active"><a href="#websiteWidget-widget-verify-horizontal" data-toggle="tab">Widget</a></li>
                   <li><a href="#websiteWidget-HTML-verify-horizontal750" data-toggle="tab">HTML Code</a></li>
                </ul>


                <div class="tab-content">

                    <div class="tab-pane fade active in verify-widget" id="websiteWidget-widget-verify-horizontal">
                        
                        <iframe id="horizontal-widget-preview" src="<?php
                        if(!empty($listing->custom_dropdown5)){
                            echo $widget_uri_horizontal.$listing->custom_dropdown5;
                        }else{
                            echo $widget_uri_horizontal.$listing->friendly_url;
                        } ?>" style="border:0px;width:100%;height:455px;background-color:transparent;margin-bottom:5px;" scrolling="no"></iframe>	
                        <div class="widthHeight widthHeight1">
                            <!--<strong>750px x 120px</strong>-->
                        </div>                            	
                    </div>
                    
                    <div class="tab-pane fade" id="websiteWidget-HTML-verify-horizontal750">
                        <textarea name="websiteWidget-textarea" id="inputWebsite-premium-iframe" class="form-control websiteWidgetTextarea-horizontal" rows="3">
                            
                           
                            <?php
                            if ($widget_uri_horizontal = $partial_uri . "horizontal-V2/") {
                                ?>
                    <div id ="horizontal-v2-widget">
                   <link rel="stylesheet" href="<?php echo $partial_uri . 'assets/css/horizontal-widgetV2.min.css'; ?>" type="text/css" media="all" />
                            <?php } elseif ($widget_uri_horizontal == $partial_uri . "horizontal/") { ?>
                    <div id ="horizontal-widget">
                   <link rel="stylesheet" href="<?php echo $partial_uri . 'assets/css/horizontal-widget.min.css'; ?>" type="text/css" media="all" />
                            <?php } ?>
                        <iframe id="eooro_horizontal_widget" class ="iphonescreenv2"
                                    src="<?php
                            if (!empty($listing->custom_dropdown5)) {
                                echo $widget_uri_horizontal . $listing->custom_dropdown5;
                            } else {
                                echo $widget_uri_horizontal . $listing->friendly_url;
                            }
                            ?>"
                                    scrolling="no"
                                    style="width:100%;height:415px;"
                                    frameborder="0">      
                            </iframe>
                   </div>
                        </textarea>
                    </div>

                    <div class="tab-pane fade" id="websiteWidget-HTML-verify-horizontal950">
                        <textarea name="websiteWidget-textarea" id="inputWebsite-premium-950" class="form-control websiteWidgetTextarea-horizontal" rows="4">
                        <div id="eooro-widget-backlink" class="eooro-widget" data-business="<?php if(!empty($listing->custom_dropdown5)){
                            echo $listing->custom_dropdown5;
                        }else{
                            echo $listing->friendly_url;
                        } ?> ?>">
                        <script>d = document.getElementsByClassName("eooro-widget"), l = d[0].dataset.business; f = document.createElement("iframe"), f.setAttribute('id', 'tata'), f.setAttribute("src", "<?= $widget_uri_horizontal ?>" + l), f.setAttribute("scrolling", "no"), f.setAttribute("style", "float:left;border:0px;width:100%;height:270px;background-color:transparent;"), d[0].appendChild(f); 
</script>
                        </div></textarea>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<div class="clearfix">
    <!--<div class="col-sm-12">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-3">
                <p class="website-url"><?= system_showText(LANG_LABEL_ENTERURL); ?> </p>
                <input type="url" id="website_url" name="backlink_url" value="<?= $backlink_url ?>" class="form-control backlink-input" placeholder="Ex: http://www.mywebsite.com" />

                <p class="website-url"><?= system_showText(LANG_LABEL_VERIFYSITE); ?></p> 
                <button type="button" class="btn btn-info btnColor" onclick="checkWebsite();"><?= system_showText(LANG_LABEL_VERIFY) ?></button>
                <button type="button" class="btn btn-info inactive btnColor" id="continue" disabled="disabled" style="cursor: default;" onclick="addBacklink();"><?= system_showText(LANG_LABEL_CONFIRM_BACKLINK); ?></button>
                <p style="display:none" id="imgLoading"><img src="<?= DEFAULT_URL ?>/custom/domain_1/theme/review/images/iconography/icon-loading-content.gif"></p>
            </div>
        </div>
    </div>-->
</div>


</form>
<input type="hidden" id="wig-type">
</div>


<script type="text/javascript">
    function addBacklink(){

    var backlinkValid = $('#backlinkValid').val();
    var url = $('#website_url').val();
    var type = $('#wig-type').val();
    $.post("listing/backlinks.php?id=<?= $id ?>", { backlinkValid : backlinkValid, backlink_url : url, wigType: type })
            .done(function(response) {
            if (response.trim() === "success"){
            fancy_alert('Backlink successfully added.', 'successMessage', false, 350, 'auto', false);
            }
            });
    }

    function checkWebsite(){

    var url = "";
    var listingId = <?= $id ?>;
    url = $('#website_url').val();
    if (url){
    $("#imgLoading").css("display", "");
    $.post(DEFAULT_URL + "/check_website.php", {
    url: url,
            id: listingId
    }, function (response) {
    var status = JSON.parse(response);
    $("#imgLoading").css("display", "none");
    if (status.status.trim() == "OK"){
    $('#wig-type').val(status.type.trim());
    $('#continue').prop("disabled", "");
    $('#continue').removeClass("inactive");
    $('#continue').css("cursor", "pointer");
    $('#backlinkValid').val("1");
    fancy_alert('<?= system_showText(LANG_LABEL_VALIDATION_OK) ?>', 'successMessage', false, 350, 'auto', false);
    } else {
    $('#continue').prop("disabled", "disabled");
    $('#continue').addClass("inactive");
    $('#continue').css("cursor", "default");
    $('#backlinkValid').val("0");
    fancy_alert('<?= system_showText(LANG_LABEL_VALIDATION_FAIL) ?>', 'errorMessage', false, 350, 'auto', false);
    }
    });
    } else {
    fancy_alert('<?= system_showText(LANG_LABEL_TYPE_URL) ?>', 'informationMessage', false, 350, 'auto', false);
    }
    }
    
    $(document).ready(function(){
        $('#theme').on('change', function(){
            var changedValue = $(this).val();
            var textarea = $('#inputWebsite-premium-iframe');
            var text = textarea.val();
            var iframe = $($.parseHTML(text));
            <?php 
            if(!empty($listing->custom_dropdown5)){
                $replace_widget = $listing->custom_dropdown5;
            }
            else{
                 $replace_widget = $listing->friendly_url;
            }
            
            ?>
            var newSource = '<?php echo $widget_uri_horizontal.$replace_widget; ?>?theme='+changedValue;
            iframe.attr('src', newSource);
            var emptydiv = $(document.createElement('div'));
            emptydiv.append(iframe);
            var iframeHtml = emptydiv.html();
            textarea.val('');
            textarea.val(iframeHtml);
            
            var previewFrame = document.getElementById('horizontal-widget-preview');
            previewFrame.setAttribute('src', newSource);
        });
    });

</script>
<style>
    .addingWebsiteWrapper {
        background-color: #E9E9E9;
        padding: 5px 8px;
        border-radius: 4px;
    }
     .addingWebsiteWrapper h4{
        margin-top: 0;
     }
     .addingWebsiteWrapper.finalStepsWrapper {
        margin-top: 5px;
    }
</style>