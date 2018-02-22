<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
            <header>
                <h2 class="span5">Case Details</h2>
                <?php if ( $this->caseDetails['case_status'] !== 'C' ) :?>
                <div class="dropdown case-dropdown">
                    <a class="case-dropdown-toggle case-button" role="button" data-toggle="dropdown" href="#">Close Case</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="my-menu">
                        <li><a href="#" data-close="close-keep" class="fancy_window_closecase"><?=$this->settings['resolution_type_user_k']['short_description'];?></a></li>
                        <li><a href="#" data-close="close-delete" class="fancy_window_closecase"><?=$this->settings['resolution_type_user_d']['short_description'];?></a></li>
                    </ul>
                    <!--<ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="javascript: void(0);" class="dropdown-toggle">--Select option to Close Case--</a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a href="#">option1</a></li>
                                <li><a href="#">option2</a></li>
                            </ul>
                        </li>
                    </ul>-->
                </div>
                <?php else: ?>
                    <div class="case-dropdown">
                        <a class="case-button"href="#">Case is Closed</a>
                    </div>
                <?php endif;?>
                <br clear="all"/>
            </header>
            <section class="stats-summary">
                <div class="row-fluid">
                    <div class="span5">
                        <p>
                            Case Opened Date:
                        </p>
                        <p>
                            Listing Name:
                        </p>
                        <p>
                            Your Comment Title:
                        </p>
                        <p>
                            Your Comment Description:
                        </p>
                    </div>
                    <div class="span7">
                        <p class="local-date">
                            <?=$this->caseDetails['opened_date'];?>
                        </p>
                        <p>
                            <a href="<?=DEFAULT_URL.DIRECTORY_SEPARATOR.ALIAS_LISTING_MODULE.DIRECTORY_SEPARATOR.$this->listing->getString('friendly_url');?>"><?=$this->listing->getString('title');?></a>
                        </p>
                        <p>
                            <?=  ucwords($this->caseDetails['review_title'])?>
                        </p>
                        <p>
                            <?=$this->caseDetails['review_comment']?>
                        </p>
                    </div>
                </div>
            </section><!-- Details end  -->