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
            <h1>Search Opened Cases</h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin">
            <!-- Everything goes here  -->
            <div class="submenu">
                <ul>
                    <li class="submenu_active"><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=searchcase'?>">Search</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=manage'?>">Manage</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=setting'?>">Setting</a></li>
                </ul>
            </div> <!-- submenu complete  -->
            <br clear="all">
            <div class="header-form">Search</div>
            <div id="search-form-wrapper">
            <form name="case-search-form" id="case-search-form" >
                <table class="standard-table noMargin" id="searchcase-table">
                    <tbody>
                        <tr>
                            <th>Owner Name:</th>
                            <td><input type="text" name="search[owner_name]" placeholder="Enter Listing Owner's Name" value="<?=$this->searchDetails['owner_name']?>"/></td>
                        </tr>
                        <tr>
                            <th>Listing Title:</th>
                            <td><input type="text" name="search[listing_title]" placeholder="Enter Listing Title" value="<?=$this->searchDetails['listing_title']?>"/></td>
                        </tr>
                        <tr>
                            <th>Reviewer Name:</th>
                            <td><input type="text" name="search[reviewer_name]" placeholder="Enter Reviewer's Name" value="<?=$this->searchDetails['reviewer_name']?>"/></td>
                        </tr>
                        <tr>
                            <th>Review Title:</th>
                            <td><input type="text" name="search[review_title]" placeholder="Enter Review Title" value="<?=$this->searchDetails['review_title']?>"/></td>
                        </tr>
                        <tr>
                            <th>Opened Date:</th>
                            <td><input type="text" name="search[opened_date]" placeholder="Enter Case Opening Date" value="<?=$this->searchDetails['opened_date']?>"/></td>
                        </tr>
                        <tr>
                            <th>Case Status:</th>
                            <td><input type="radio" name="search[case_status]" value="A">Active<br>
                            <input type="radio" name="search[case_status]" value="C">Closed<br>
                            <input type="radio" name="search[case_status]" value="I">Initialised</td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="controller" value="searchcase" />
                <input type="hidden" name="action" value="search" />
                <input type="submit" value="Search" class="input-button-form" />
            </form>
            </div>
            <br clear="all">
            <button id="search-form-toggler" class="pull-left">Show / Hide Form</button>
            <?php if ( $this->searched ): 
                        if ( $this->cases) :
            ?>
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
            <?php else : ?>
            <p> No Results Found </p>
            <?php endif;
                endif; 
            ?>
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
</div>
<script> 
    //search-form-wrapper   search-form-toggler
    $( '#search-form-toggler' ).click(function(){
        $( '#search-form-wrapper' ).toggle();
    });
</script>
