<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

//print_r( $this->caseDetails );
?><link rel="stylesheet" href="<?=MODULES_REQ.'/casemanager/views/viewcase/tmpl/style.css'?>" />
<!-- <div class="content-custom">
    You can view all your case Details in this page. fdsfdsfds
</div> -->
<div class="row-fluid responsive">

    <div class="span12 responsive-menu">
        <div class="user-info1">
        <div class="responsive-scrollmenu">
            <div class="scroll-content">
                <div class="webitem active case-detail">
                               <header class="caseDetail">
                <h2 class="span" style="font-size:17px;width: 20%;min-height:0;">Case Details</h2>
                <?php if ( $this->caseDetails['case_status'] === 'A' ) :?>
                    <div class="case-dropdown">
                        <a class="case-button"href="#">Active</a>
                    </div>
                <?php elseif( $this->caseDetails['case_status'] === 'C' ): ?>
                    <div class="case-dropdown">
                        <a class="case-button"href="#">Closed</a>
                    </div>
                <?php endif; ?>
            </header>
            <section class="stats-summary">
                <div class="row-fluid">
                    <div class="span12 listing-name">
                      <table class="table caseDetail">
                           <tbody>
                               <tr>
                                <td class="col-sm-3">Case Opened Date:</td>
                                <td>
                                    <div class="local-date">
                                        <?=$this->caseDetails['opened_date'];?>
                                    </div>
                                </td>
                              </tr>
                               <tr>
                                <td class="col-sm-3">Reviewer Name:</td>
                                <td><?=$this->caseDetails['reviewer_name']?></td>
                              </tr>
                               <tr>
                                <td class="col-sm-3">Review Title:</td>
                                <td><?=  ucwords($this->caseDetails['review_title'])?></td>
                              </tr>
                               <tr>
                                <td class="col-sm-3">Review Comment:</td>
                                <td> <?=$this->caseDetails['review_comment']?></td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>
                </div>
            </section><!-- Details end  -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="dashboard-case" class="span12 responsive-dashboard">
        <div class="dashboard"> <!-- view_member_dashboard -->