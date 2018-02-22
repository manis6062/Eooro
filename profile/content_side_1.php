<?      

    $reviewer_id   = $id;      
    $reviewer_info = new Profile($id);
    $contact_info = new Contact($id);
    
    $contact_info_array = (array) $contact_info;
    $cleaned_contact_info = HtmlCleaner::CleanBasic($contact_info_array);
    $contact_info = new Contact($cleaned_contact_info);
    
    $acctidFromSession = sess_getAccountIdFromSession();
    $acctidFromGet     = $id;
    $acctidFromSession == $acctidFromGet ? $showedit = true : $showedit = false;
    if(trim($contact_info->first_name) != ''){
        $name = $contact_info->first_name.' '.$contact_info->last_name;
    }
    else if(trim($contact_info->first_name) == '' && trim($reviewer_info->nickname) !=''){
        $name = $reviewer_info->nickname;
    }
    else{
        $email = $contact_info->email;
        $f_name = explode('@', $email);
        $name = $f_name[0];
    }
        
?>


<section class="ReviewerProfileBusinessMenu">
    <div class="container">
                <div class="ReviewerProfileBusinessMenu-dashboard">
                    <div class="col-sm-12">
                        
                                <div class="row">
                                        <div role="tabpanel">
                                            
                                            <? if ($showedit == true ) { ?>
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a aria-controls="ReviewerProfile" role="tab" data-toggle="tab">Reviewer</a></li>
                                                <li role="presentation"><a href="<?=DEFAULT_URL . "/" .  MEMBERS_ALIAS?>" class="bgeee" role="tab">Business</a></li>
                                                <span class="profile pull-right">Welcome, <?=ucwords($name)?><?//=ucwords($reviewer_info->nickname)?>!</span>
                                            </ul>
                                            <? } ?>
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
                                                <!-- Tab panes -->
<div class="row">
        <div class="reviewerProfileTabs">
            <div class="col-sm-3" id="sidebar">
                <div class="tab-content Business">
                    <div role="tabpanel" class="tab-pane active" id="ReviewerProfile">
  
                        <div class="panel-group reviewerProfile" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel-group reviewerProfile">
                                <div class="panel panel-default reviewerProfile">
                                    <div class="panel-heading reviewerProfile" role="tab" id="heading3">
                                        <h4 class="panel-title reviewerProfile">
                                        <a data-toggle="" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                            <i class="fa fa-user"></i> Reviewer Profile
                                            
                                        </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading3">
                                        <div class="b0">
                                            <a class="list-group-item reviewerProfile active" id="overview" onclick="clickFunction('overview', '<?=($id == sess_getAccountIdFromSession() ? "" : "../");?>overview',<?=$id?>);"><i class="fa fa-list-alt"></i> Overview</a>
                                            <a class="list-group-item reviewerProfile" id="reviews" onclick="clickFunction('reviews', 'reviews');"><i class="fa fa-comments"></i> Reviews</a>
                                            <? if ($showedit == true ) { ?>
                                                <a class="list-group-item reviewerProfile" id="cases" onclick="clickFunction('cases', 'cases');"><i class="fa fa-file-text"></i> Cases</a>
                                                <a class="list-group-item reviewerProfile" id="edit" onclick="clickFunction('edit', 'edit');"><i class="fa fa-cog rpcog"></i> Edit Profile</a>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
            </div>
        </div>
        <div class="col-sm-9" id="body" >