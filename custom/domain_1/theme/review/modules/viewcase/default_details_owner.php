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
                <?php if ( $this->caseDetails['case_status'] === 'A' ) :?>
                    <div class="case-dropdown">
                        <a class="case-button"href="#">Case is Active</a>
                    </div>
                <?php elseif( $this->caseDetails['case_status'] === 'C' ): ?>
                    <div class="case-dropdown">
                        <a class="case-button"href="#">Case is Closed</a>
                    </div>
                <?php endif; ?>
            </header>
            <section class="stats-summary dfdsf">
                <div class="row-fluid">
                    <div class="span5 listing-name">
                        <p>
                            Listing Name:
                        </p>
                        <p>
                            Case Opened Date:
                        </p>
                        <p>
                            Reviewer Name:
                        </p>
                        <p>
                            Reviewer Comment Title:
                        </p>
                        <p>
                            Reviewer Comment Description:
                        </p>
                    </div>
                    <div class="span7 listing-details">
                        <p>
                            <?=$this->listing->getString('title');?>
                        </p>
                        <p class="local-date">
                            <?=$this->caseDetails['opened_date'];?>
                        </p>
                        <p>
                            <?=$this->caseDetails['reviewer_name']?>
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