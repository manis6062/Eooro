<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules / casemanager
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
<section class="reviews-list" id="opened-cases">
    <h2> Opened Cases </h2>
     <p class="paging pull-right"><?=$this->openedCases;?> Cases Open</p>
    <div class="row-fluid head">
        <div class="span-3 display">
           
        </div>
    </div>
    <?php 
    if ( $this->openedCases):
        $size = count( $this->cases );
        for( $i = 0; $i < $size; $i++ ) : 
    ?>
    <div class="item-review">
        <div class="review-summary">
            <div>
                <?php if( $this->cases[$i]['case_status'] === 'I' ): ?>
                <p><a href="<?=DEFAULT_URL.'/sponsors/billing/index.php'?>">Pay to activate Case.</a></p>
                <?php endif; ?>
                <p>
                <b><?=$this->cases[$i]['reviewer_name'];?>:</b>
                <b><?=  ucwords($this->cases[$i]['review_title']);?></b>
                <em class="pull-right"><?=  format_date( $this->cases[$i]['opened_date'], DEFAULT_DATE_FORMAT, 'datetime' );?></em>
                </p>
            </div>
            <div>
                <?php if( $this->cases[$i]['case_status'] !== 'I' ) :?>
                <?=$this->unreadMsgs[$i] ? '<span>'.$this->unreadMsgs[$i] . ' New Messages</span>' : '';?>
                <span><a onclick='showCase(<?=$this->cases[$i]['id']?>)'>View Case</a></span>
                    <?=( $this->cases[$i]['case_status'] === 'C' ) ? '<span> Case is Closed</span>' : '';?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endfor;endif;?>
</section>
<script>
function showCase(case_id){
    showspinner();
    $('#dashboard').load('<?=EXTRAS_REQ.DIRECTORY_SEPARATOR."case.php?id="?>'+case_id, function() {
        hidespinner();
    }); 
}
</script>