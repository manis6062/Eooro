<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class EmailPlugin
{
    /**
     * User Account Object
     * 
     * @var \Account
     */
    protected $account;
    
    public function onUserReview( $eventObj, $eventName, $dispatcherObj )
    {
        $review = $eventObj->getReview();
        $contactObj           = new Contact($review->member_id);
        $listingObj           = new Listing($review->item_id);
        $detailLink           = LISTING_DEFAULT_URL."/".$listingObj->friendly_url;

        if ( $this->shouldSendEmail() ) {
            $emailNotificationObj = new EmailNotification(56);
            $subject              = $emailNotificationObj->subject;
            $body                 = $emailNotificationObj->body;

            $body                 = str_replace(array('ACCOUNT_NAME','LISTING_NAME',
                                                'LISTING_URL', 'REVIEW'), 
                                                array($contactObj->first_name.' '.$contactObj->first_name, 
                                                $listingObj->title, $detailLink, $review->getString( 'review', false )), 
                                                $body);

            $to         = $this->account->username;
            $from       = 'hello@eooro.com';
            // $mailer     = new EDirMailer( $to, $subject, $body, $from );
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $listingObj->id, $contactObj->account_id, 56);
            
        }
    }
    
    protected function shouldSendEmail()
    {
        $id         = sess_getAccountIdFromSession();
        // to send email the person must be logged in
        if ( $id ) {
            $this->account    = new Account( $id );
            if ( preg_match( '/^(facebook::|google::)/', $this->account->username, $matches ) ) {
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }
}