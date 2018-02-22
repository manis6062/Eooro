<?

if ($section == "sitemgr") { ?>

    <div class="form-login">

        <h2><?=LANG_SITEMGR_FORGOOTTEN_PASS_1;?></h2>
        <br />

        <p class="login-question"><?=LANG_SITEMGR_FORGOOTTEN_PASS_TIP;?></p>

        <? if ($message) { ?><p class="<?=$message_class?>"><?=$message?></p><? } ?>		

        <div class="form-box">
            <input type="text" name="username" value="" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS)?>" />
            <button type="submit" value="Send It" class="stmgr-btn success"><?=LANG_SITEMGR_SEND_IT;?></button>
        </div>
        <p class="linkLogin">
            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/login.php"><?=LANG_SITEMGR_FORGOOTTEN_PASS_3;?></a>
        </p>

    </div>

<? } else { ?>

        <? if ($message_class != "informationMessage") { ?>
                <p class="<?=$message_class?>"><?=$message?></p>
        <? }?>
             
        <? if ($message_class != "successMessage") { ?>
            <label for="reset-email" class="reset-label">
                <?=system_showText(LANG_MSG_TYPE_USERNAME);?>
            </label>
            <input class="reset-input placeholder" type="email" id="username" name="username" value="<?=$_GET['email']?>" title="Your Email Address" placeholder="<?=system_showText(LANG_LABEL_EMAIL_ADDRESS);?>">
          
                    
            <button type="submit" class="btn btn-success reset-button resetContinueBtn"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
            
            <p class="forgotpassword doubleline">
                <a href="<?=DEFAULT_URL;?>/<?=$cancel_section;?>"><?=system_showText(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD);?></a>
            </p>

        <? } ?>


    <? } ?>
