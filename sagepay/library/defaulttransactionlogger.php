<?php


class DefaultTransactionLogger extends TransactionLogger
{
    protected $payment_type_log;
    /**
     * To Log current item type transaction in their corresponding database
     * tables.
     * item type = listing, event, atricle, etc
     * item level = listing level, event level .. etc.
     * 
     * @param PaymentLog $paymentLogObj
     * @param $txStatus Tells if the transaction was completed or failed.
     */
    public function logIndividualTransaction( $paymentLogObj, $txStatus, $type, $array )
    {
        //foreach ( $this->txClasses as $type => $array ){
            $level      = $type. 'Level';
            $typekey    = strtolower($type);
            foreach( $array as $id => $typeObject ){
                $levelObj   = new $level();
                
                // common logs
                $this->payment_type_log['payment_log_id']   = $paymentLogObj->getString('id');
                $this->payment_type_log[ $typekey.'_id']    = $id;
                $this->payment_type_log[ $typekey.'_title'] = $typeObject->getString('title');
                $this->payment_type_log['discount_id']      = $typeObject->getString('discount_id');
                $this->payment_type_log['amount']           = $typeObject->getPrice();
                $this->payment_type_log['renewal_date']     = $txStatus ? $typeObject->getNextRenewalDate() : $typeObject->getString('renewal_date');
                $this->payment_type_log['level']            = $typeObject->getString('level');
                $this->payment_type_log['level_label']      = $levelObj->showLevel($typeObject->getString('level'));
                
                /**
                 **  @ Discount code modification for Duration Type : Store in log
                 */  

                $discountCodeObj = new DiscountCode($typeObject->getString('discount_id'));
                                
                if(($discountCodeObj->type =="duration") && ($discountCodeObj->status == "A") && $discountCodeObj->expire_date >= date('Y-m-d')){
                    $amont = intval($discountCodeObj->amount);
                    
                    function mth($date_str, $months)
                    {
                        $date = new Datetime($date_str);
                        $start_day = $date->format('j');

                        $date->modify("+{$months} month");
                        $end_day = $date->format('j');

                        if ($start_day != $end_day)
                            $date->modify('last day of last month');

                        return $date;
                    }
                    
                    $amont = $amont + 12; //Add One Year

                    $result = mth($typeObject->getString('renewal_date'), $amont);

                    if ($typeObject->renewal_date == '0000-00-00'){
                        $today = date("Y-m-d");
                        $result = mth($today, $amont);
                    }

                    
                    $result = (array) $result;
                    $d = $result['date'];
                    $d = explode(" ", $d);
                                   
                    $this->payment_type_log['renewal_date']   = $d[0];        
                }


                // different logs
                $this->logForSeparateTypes( $typeObject, $levelObj, $typekey );
                
                $loggerName     = 'Payment'.$type.'Log';
                $loggerObj      = new $loggerName( $this->payment_type_log );
                // just to confirm.. not so necessary
                if ( $this->payment_type_log['payment_log_id'] ) {
                    $loggerObj->save();
                }
            }
        //}
    }
    
    /**
     * Listing, Event, Article, Banner have some extra fields that are different
     * from each other and have to be logged in their corresponding table. (in database)
     * 
     * @param object $typeObject Listing, event, article etc object depending on
     *                              type of current transaction.
     * @param object $levelObject ListingLevel, EventLevel, ArticleLevel etc object
     *                          depending on type of current transaction.
     * @param string $typekey type of current transaction.
     */
    protected function logForSeparateTypes( &$typeObject, &$levelObject, $typekey )
    {
        
        if ( $typekey === 'listing' ) {
            $this->getCategoryDetails( $typeObject, $levelObject );
        }
        elseif( $typekey === 'event' ){

        }
        elseif ( $typekey === 'article' ) {

        }
        elseif ( $typekey === 'banner' ) {

        }
        elseif ( $typekey === 'custominvoice' ) {
            // making sure custom invoice doesnt work
            unset( $this->payment_type_log );
        }
    }
    
    /**
     * Listing has category and extracategories. To fetch those information from 
     * the database, for the current transanction.
     * 
     * @param object $typeObject Listing object 
     * @param object $levelObject ListingLevel object
     */
    protected function getCategoryDetails(  $typeObject, $levelObject )
    {
        $category_amount = 0;
        $sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$typeObject->getString("id")."";
        $result = $this->domainDb->query($sql);
        if(mysql_num_rows($result)){
                while($row = mysql_fetch_assoc($result)){
                        $category_amount++;
                }
        }
        // for categories
        $this->payment_type_log['categories'] = ($category_amount) ? $category_amount : 0;
        $this->payment_type_log["extra_categories"] = 0;
        if (($category_amount > 0) && (($category_amount - $levelObject->getFreeCategory($typeObject->getString("level"))) > 0)) {
            $this->payment_type_log["extra_categories"] = $category_amount - $levelObject->getFreeCategory($typeObject->getString("level"));
        } else {
            $this->payment_type_log["extra_categories"] = 0;
        }
        
        // for template
        $this->payment_type_log["listingtemplate_title"] = "";
        if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
            if ($typeObject->getString("listingtemplate_id")) {
                $listingTemplateObj = new ListingTemplate($typeObject->getString("listingtemplate_id"));
                $this->payment_type_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
            }
        }
    }
    
    public function updateType( $txStatus, $status, $type, $array )
    {
        $typeLowerCase  = strtolower( $type );
        foreach ( $array as $id => $typeObject ){
            $typeObject->setString( 'renewal_date', $txStatus ? $typeObject->getNextRenewalDate() : $typeObject->getString('renewal_date') );
            setting_get( $typeLowerCase.'_approve_paid', $approve_required );


                /**
                 **  @ Discount code modification for Duration Type
                 */  

                $discountCodeObj = new DiscountCode($typeObject->getString('discount_id'));
                                
                if(($discountCodeObj->type =="duration") && ($discountCodeObj->status == "A") && $discountCodeObj->expire_date >= date('Y-m-d')){
                    $amont = intval($discountCodeObj->amount);
                    
                    function add($date_str, $months)
                    {
                        $date = new Datetime($date_str);
                        $start_day = $date->format('j');

                        $date->modify("+{$months} month");
                        $end_day = $date->format('j');

                        if ($start_day != $end_day)
                            $date->modify('last day of last month');

                        return $date;
                    }

                    $result = add($typeObject->getString('renewal_date'), $amont);
                    $result = (array) $result;
                    $d = $result['date'];
                    $d = explode(" ", $d);
                    
                    $typeObject = new Listing($id);
                    
                    $typeObject->setRenewalDate($d[0],$id);
                    $typeObject = new Listing($id);
                                        
                    $this->payment_type_log['renewal_date']   = $typeObject->getString("renewal_date");        
                }


            if ($approve_required === 'on'){
                    $typeObject->setString("status", $status->getDefaultStatus());
            }
            else{
                    $typeObject->setString("status", "A");
            }

            $typeObject->save();
        }
        return $approve_required;
    }
}