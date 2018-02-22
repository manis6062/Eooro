
<link href="http://localhost/10300/sponsors/listing/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">






<?php
if( strpos($_SERVER['PHP_SELF'], MEMBERS_ALIAS . "/index.php")){
    $true = true;
}

if($itemObj){
    $itemObj->status == "P" ? $itemObj = new ListingPending($itemObj->id) : null;
    $itemObj->status = str_replace("P", "Pending", $itemObj->status);
    $itemObj->status = str_replace("A", "Active", $itemObj->status);

    strlen($itemObj->title) > 20 ? $thistitle = substr($itemObj->title, 0, 18) . "..." : $thistitle = $itemObj->title;
}

if ( $true == true ) { 
?>

<button id="hider" style="display:none;" onclick="hideMenu();" class="btn-menu" >
    <div class="icon-menu">
        <i class="fa fa-bars"></i>
        Menu
    </div></button>
<button id="shower" onclick="showMenu();" class="btn-menu">
<div class="icon-menu">
        <i class="fa fa-bars"></i>
        Menu
    </div></button>

    <div class="">
        <div class="">
            <div class="ReviewerProfileBusinessMenu-dashboard">
                <div class="col-sm-12">
                    <div class="row">
                        <div role="tabpanel">

                            <!-- Tab panes -->

                            <div class="row">
                                <div class="reviewerProfileTabs Business">
                                    <div class="col-sm-3" id="sidebar" style="display:none;">
                                        <div class="tab-content Business">
                                            <div role="tabpanel" class="tab-pane" id="ReviewerProfile">
                                            </div>
                                            
                                            <div role="tabpanel" class="tab-pane active" id="BusinessMenu">

                                            <!-- Business menu markup -->
                                            <div class="panel-group reviewerProfile" id="accordion1" role="tablist" aria-multiselectable="true">
                                                <div class="panel-group reviewerProfile">
                                                    <div class="panel panel-default reviewerProfile">
                                                        <div class="btn-group reviewerProfile">
                                                            <button type="button" id="business-changer" class="btn btn-default dropdown-toggle reviewerProfile" data-toggle="dropdown">
                                                                <i class="fa fa-building-o"></i> <span data-bind="label"><?=htmlspecialchars($itemObj) ? htmlspecialchars($thistitle) . "&nbsp; " /*. $itemObj->status*/ : htmlspecialchars($thistitle); ?></span><i class="fa fa-chevron-down pull-right ReviewerChev"></i>                                                                  
                                                            </button>
                                                            <?
                                                           
                                                                $showAddContent = true;

                                                                if (count($sponsorItems) > 0) { ?>

                                                                    <ul class="dropdown-menu reviewerProfile" id="menu" role="menu" style="height:300px;overflow-y:scroll;overflow-x:hidden;">

                                                                        <?  $counter = 1;
                                                                            foreach ($sponsorItems as $item) { 
                                                                                   strlen($item["title"]) > 19 ? $title_short = htmlspecialchars(substr($item["title"], 0, 19))."..." :
                                                                                    $title_short = htmlspecialchars($item['title']);
                                                                            ?>
                                                                            <li title="<?=htmlspecialchars($item["title"]);?>" <?=$counter < 2 ? 'class="active"' : null; ?>><a class="reviewerProfile <?=($item["status_label"] == "Active" ? "reviewerProfile2Active" : "reviewerProfile2Pending");?>" <?=$item["clickFunction"]?>><?=$title_short;?><span class="badge businessMenu<?=$item["status_label"]?> pull-right"> <?=$item["status_label"]?> </span></a></li>

                                                                         <? $counter++; } ?>

                                                                            <li><a onclick='window.location.href="listing/addsearchlisting.php";' class="list-group-item reviewerProfile"><i class="fa fa-plus"></i> Add New Business</a></li>
                                                                     </ul>
                                                                <? } ?>

                                                        </div> <!-- btn-group -->
                                                    </div>
                                                </div>

                                                <div class="panel-group reviewerProfile">
                                                    <div class="panel panel-default reviewerProfile">
                                                        <div class="panel-heading reviewerProfile" role="tab" id="heading5">
                                                            <h4 class="panel-title reviewerProfile">
                                                                <a data-toggle="" data-parent="#accordion1" href="#collapse5"  aria-expanded="true" aria-controls="collapse5">
                                                                    <i class="fa fa-suitcase"></i> Business Menu

                                                                </a>
                                                            </h4>
                                                        </div>

                                                        <div id="collapse5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading5">
                                                            <div class="b0">
                                                                <a id="ovrvw" class="list-group-item reviewerProfile active"><i class="fa fa-list-alt"></i> Overview</a>
                                                                <a id="listing-reviews" class="list-group-item reviewerProfile" onclick="openPage('listing-reviews','listing_reviews', getItemId())"><i class="fa fa-comments"></i> Reviews</a>
                                                                <a id='revc' class="list-group-item reviewerProfile"><i class="fa fa-users"></i> Review Collector</a>
                                                                <a id='wig' class="list-group-item reviewerProfile"><i class="fa fa-cog rpcog"></i> Website Widget</a>
                                                                <a id="listing-leads" class="list-group-item reviewerProfile" onclick="openPage('listing-leads','listing_leads', getItemId())"><i class="fa fa-line-chart"></i> Leads & Enquiries</a>
                                                                <a id="listing-cases" class="list-group-item reviewerProfile" onclick="openPage('listing-cases','listing_cases', getItemId())"><i class="fa fa-file-text"></i> Cases</a>
                                                                 <a id="app" class="list-group-item reviewerProfile"><i class="fa fa-cubes"></i> App</a>

                                                               
                                                                <!-- Shaded Sections -->
                                                                
                                                                <a id='edt_detail'   class="list-group-item reviewerProfile imp"><i class="fa fa-pencil-square-o"></i> Edit Business Info</a>
                                                                
                                                                     <!-- Edit Business Sub Categories -->
<!--                                                                <a id='edt_detail'   class="list-group-item reviewersubProfile imp"><i class="fa fa-shield fa-rotate-270"></i> Detail</a>-->
                                                                <a id='edt_ownership'   class="list-group-item reviewerProfile imp"><i class="fa fa-universal-access"></i> Ownership and SEO</a>
                                                                <a id='edt_description'   class="list-group-item reviewerProfile imp"><i class="fa fa-list-ul"></i> Description and Category</a>
                                                                <a id='edt_logo'   class="list-group-item reviewerProfile imp"><i class="fa fa-file-video-o"></i> Logo and Video</a>
                                                                
                                                                
                                                                <a id="bill"  class="list-group-item reviewerProfile imp" onclick="menuItemClick('billing','bill', getItemId())"><i class="fa fa-credit-card"></i> Billing</a>
                                                                <a id="trans" class="list-group-item reviewerProfile imp" onclick="menuItemClick('transactions','trans', getItemId())"><i class="fa fa-history"></i> Payment History</a>
                                                                <a id="acct"  class="list-group-item reviewerProfile imp" onclick="menuItemClick('account','acct')"><i class="fa fa-user"></i> <?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                                                                 <input type="hidden" value="" id="listing_id_text_box">
                                                            </div>
                                                        </div>
                                                </div> <!-- panel-group reviewerProfile -->
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-9" id="change-class">
                                        
<? } ?>

                                        
<script>
 $("body").live('click', function(evt){
    if(evt.target.id != "business-changer"){
      $('.dropdown-toggle').collapse('hide');
      $('.dropdown-menu').css('display' , 'none');
  }
});

</script>
