
                        
<form class="form" name="search_form" method="get" action="<?=$action;?>">
    <h2>What Company Reviews are you looking for?</h2>
    <div id="custom-search-input" class="search-advanced">
        <div class="search-keyword input-group location">
            <input type="text" name="keyword" class="search-query form-control" id="keyword<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=$keyword;?>" />
            <span class="input-group-btn search-button">
                <button class="btn btn-danger btn-info btn-search" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>

        <? if ($hasWhereSearch) { ?>
        <!--<div class="search-location">
            <label id="where-title" class="title" for="where"><?=system_showText(LANG_LABEL_SEARCHINGFOR_WHERE).' in '.$where.'?';?></label>-->
            <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
        <!--</div>-->
        <? } ?>
        <input type="hidden" name="sel" id="sel" value="" />
    </div><!--/custom-search-input-->

</form>
