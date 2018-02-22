<?php

include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_PaymentCaseLog.php';
class CaseTransactionLogger extends TransactionLogger
{
    public function logIndividualTransaction( $paymentLogObj, $txStatus, $type, $caseObjArray )
    {
        foreach ( $caseObjArray as $id => $caseObject ) {
            $caseLog['payment_log_id'] = $paymentLogObj->getString( 'id' );
            $caseLog['case_id'] = $caseObject->getNumber( 'case_id' );
            $caseLog['amount']  = $caseObject->getPrice();
        
            if ( $caseLog['payment_log_id'] ) {
                $caseLogger = new PaymentCaseLog( $caseLog );
                $caseLogger->save();
            }
        }
    }
    
    public function updateType( $txStatus, $itemStatus, $type, $caseObjArray )
    {
        if ( $txStatus ) {
            foreach( $caseObjArray as $id => $caseObject ){
                $caseObject->setString( 'case_status', 'A' );
                $caseObject->save();
            }
        }
    }
}