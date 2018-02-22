<?php
    include(INCLUDES_DIR."/code/newsletter.php");
		    
	?>
        
    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>
    <section class="login">
    <div class="container">
    <div class="row-fluid login-page">
                   
        <div class="col-sm-5 center namilne-parent">

            <h1 class="text-center"><?=system_showText(LANG_JOIN_PROFILE);?></h1>
               
            <section class="login-box" style="overflow:hidden;">              
            
                <form name="add_account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" autocomplete="off">
                    
                      <? include(INCLUDES_DIR."/forms/form_addaccount_review.php"); ?>

                </form>

            </section>

            <section class="login-underbox">
                <p>
                    <a href="<?=SOCIALNETWORK_URL?>/login.php" style="color:#337ab7;"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a>
                </p>
            </section>
            
        </div>
    
    </div>
    </div>
    </section>