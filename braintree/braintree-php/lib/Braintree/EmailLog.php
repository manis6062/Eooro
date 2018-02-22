<?php 

class EmailLog {

	public static function save($listing_id = false, $account_id = false, $email = false, $emailNotification_id = false, $subscription_id = false, $notification_type = false, $subject = false, $body = false, $issue_sending = false) {

        $sitemgr_email = EDIR_SUPPORT_EMAIL;
        $from = EDIRECTORY_TITLE." <$sitemgr_email>";


        return DBQuery::execute(function() use($listing_id, $from, $account_id, $email, $emailNotification_id, $subscription_id, $notification_type, $subject, $body, $issue_sending){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("INSERT INTO Email_Log"
                    . " (log_date,"
                    . " listing_id,"
                    . " account_id,"
                    . " email,"
                    . " email_notification_id,"
                    . " subscription_id,"
                    . " notification_type,"
                    . " sent_from,"
                    . " email_subject,"
                    . " email_body,"
                    . " issue_sending)"
                    . " VALUES"
                    . " (NOW(),"
                    . " :listing_id,"
                    . " :account_id,"
                    . " :email,"
                    . " :emailNotification_id,"
                    . " :subscription_id,"
                    . " :notification_type,"
                    . " :from,"
                    . " :subject,"
                    . " :body,"
                    . " :issue_sending)");

            $parameter = array(
                    ":listing_id" => $listing_id,
                    ":account_id" => $account_id,
                    ":email" => $email,
                    ":emailNotification_id" => $emailNotification_id,
                    ":subscription_id" => $subscription_id,
                    ":notification_type" => $notification_type,
                    ":from" => $from,
                    ":subject" => $subject,
                    ":body" => $body,
                    ":issue_sending" => $issue_sending
            );

            $sql->execute($parameter);
        });

	}
}

?>