<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
<div id="main-right">
    <div id="top-content">
        <div id="header-content">
            <h1>Manage Cases</h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin">
            <!-- Everything goes here  -->
            <div class="submenu">
                <ul>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=searchcase'?>">Search</a></li>
                    <li class="submenu_active"><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=manage'?>">Manage</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=setting'?>">Setting</a></li>
                </ul>
            </div> <!-- submenu complete  -->
            <br clear="all">
            
            <!-- form starts  -->
            <form name="item_table" id="item_table" method="post">
                <table class="table-itemlist">
                    <thead>
                        <tr>
                            <th id="title">
                                <span>Listing Title</span>
                                <a><i class="sitemgr-icon-arrow-<?=$this->arrowDir['title'] ? $this->arrowDir['title'] : 'down';?> sort-field"></i></a>
                            </th>
                            <th id="review_title">
                                <span>Review Title</span>
                                <a><i class="sitemgr-icon-arrow-<?=$this->arrowDir['review_title'] ? $this->arrowDir['review_title'] : 'down';?> sort-field"></i></a>
                            </th>
                            <th id="opened_date">
                                <span>Date</span>
                                <a><i class="sitemgr-icon-arrow-<?=$this->arrowDir['opened_date'] ? $this->arrowDir['opened_date'] : 'down';?> sort-field"></i></a>
                            </th>
                            <th id="case_status">
                                <span>Status</span>
                                <a><i class="sitemgr-icon-arrow-<?=$this->arrowDir['case_status'] ? $this->arrowDir['case_status'] : 'down';?> sort-field"></i></a>
                            </th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $this->cases as $case ): ?>
                        <tr>
                            <td><?=$case['title'];?></td>
                            <td><?=$case['review_title'];?></td>
                            <td><?=$case['opened_date'];?></td>
                            <td><?=$this->status[$case['case_status']];?></td>
                            <td><a href="<?=EXTRAS_REQ.'/sitemgr_case.php?controller=casedetails&details='.$case['case_id'];?>" >View</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="hidden" name="controller" value="manage" />
                <input type="hidden" name="details[order_by]" id="order_by" value="" />
                <input type="hidden" name="details[order_dir]" id="order_dir" value="" />
            </form>
        </div><!--  default-margin ends  -->
    </div><!--  content-content ends  -->
    <div id="bottom-content">
        <!-- pagination over here  -->
        <div class="sitemgr-pagination bottom-pagination">
            <ul>
                <?=($this->pagesArray["previous"] ? $this->pagesArray["previous"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&laquo;</a></li>");?>
                <?=$this->pagesArray["first"];?>
                <?=$this->pagesArray["pages"];?>
                <?=$this->pagesArray["last"];?>
                <?=($this->pagesArray["next"] ? $this->pagesArray["next"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&raquo;</a></li>");?>
            </ul>
        </div>
    </div>
</div><!-- main-right  -->

<script>
    $( '.sort-field' ).bind( 'click', function(){
        var id = $( this ).closest( 'th' ).attr( 'id' );
        console.log( id );
        document.getElementById( 'order_by' ).value = id;
        
        console.log( $(this).attr('class') );
        var defaultClass = $(this).attr('class');
        if ( defaultClass.indexOf('down') == -1 ) {
            document.getElementById( 'order_dir' ).value = 'ASC';
        }
        else if(  defaultClass.indexOf('up') == -1  ){
            document.getElementById( 'order_dir' ).value = 'DESC';
        }
        
        $( '#item_table' ).submit();
    });
</script>