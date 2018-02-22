<?

if ($show_results && (!$pagination_bottom || $str_search)) { ?>

    <? if ($aux_module_items && !$hideResults) { ?>

        <div class="row">
            <div class="homesearch">
                <span class="search-result result">
                    <?=$array_pages_code["total"]?></i> <?=(($array_pages_code["total"] != 1) ? (system_showText(LANG_RESULTS)) : (system_showText(LANG_RESULT)))?>
                    <?=($str_search)?>
                    <?php $url = $_SERVER['REQUEST_URI']; 
                        $end = end((explode('/', $url)));

                        $arr = explode('.',trim($end));
                        if($arr[0] == "addsearchlisting"){ ?>

                    <h5 style=\"color:black\">If your business is listed below click the “Claim This Business” Link to add your business.</h5>
                    <? } ?>
                </span>
            </div> <!--/homesearch--> 
        </div> <!--/row-->

    <? } ?>

<? } ?>