<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_Lead.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$leadObj = new Lead($id, $module, $domain_id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 10.0.01
	 * @package Classes
	 * @name Lead
	 * @method Lead
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method Reply
	 * @method Forward
	 * @access Public
	 */
	class Lead extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
        /**
		 * @var integer
		 * @access Private
		 */
		var $item_id;
        /**
		 * @var integer
		 * @access Private
		 */
		var $member_id;
         /**
		 * @var string
		 * @access Private
		 */
		var $type;
        /**
		 * @var string
		 * @access Private
		 */
		var $first_name;
         /**
		 * @var string
		 * @access Private
		 */
		var $last_name;
        /**
		 * @var string
		 * @access Private
		 */
		var $email;
         /**
		 * @var string
		 * @access Private
		 */
		var $phone;
        /**
		 * @var string
		 * @access Private
		 */
		var $subject;
        /**
		 * @var string
		 * @access Private
		 */
		var $message;
		/**
		 * @var datetitme
		 * @access Private
		 */
		var $entered;
        /**
		 * @var date
		 * @access Private
		 */
		var $reply_date;
        /**
		 * @var date
		 * @access Private
		 */
		var $forward_date;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
        /**
		 * @var char
		 * @access Private
		 */
		var $new;
        /**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
        /**
		 * @var mixed
		 * @access Private
		 */
        var $data_in_array;

		/**
		 * <code>
		 *		$leadObj = new Lead($id, $domain_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name Lead
		 * @access Public
		 * @param integer $var
		 * @param integer $domain_id
		 */
		function Lead($var = "", $domain_id = false) {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id) {
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				} elseif (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Leads WHERE id = $var";
				$row = mysql_fetch_assoc($db->query($sql));
				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row = "") {
			
            $status = new ItemStatus();
            
            $this->id					= ($row["id"])					? $row["id"]					: ($this->id				? $this->id					: 0);
            $this->item_id				= ($row["item_id"])				? $row["item_id"]				: ($this->item_id			? $this->item_id			: 0);
            $this->member_id			= ($row["member_id"])			? $row["member_id"]				: ($this->member_id			? $this->member_id			: 0);
			$this->type                 = ($row["type"])				? $row["type"]					: ($this->type				? $this->type				: "");
			$this->first_name           = ($row["first_name"])			? $row["first_name"]			: ($this->first_name		? $this->first_name			: "");
			$this->last_name            = ($row["last_name"])			? $row["last_name"]             : ($this->last_name         ? $this->last_name			: "");
			$this->email                = ($row["email"])				? $row["email"]					: ($this->email				? $this->email				: "");
			$this->phone                = ($row["phone"])				? $row["phone"]					: ($this->phone				? $this->phone				: "");
			$this->subject              = ($row["subject"])				? $row["subject"]               : ($this->subject			? $this->subject			: "");
			$this->message              = ($row["message"])				? $row["message"]               : ($this->message			? $this->message			: "");
            $this->entered				= ($row["entered"])				? $row["entered"]				: ($this->entered			? $this->entered			: "");
            $this->reply_date			= ($row["reply_date"])			? $row["reply_date"]			: ($this->reply_date		? $this->reply_date			: "");
            $this->forward_date			= ($row["forward_date"])		? $row["forward_date"]			: ($this->forward_date		? $this->forward_date		: "");
            $this->new                  = ($row["new"])                 ? $row["new"]                   : ($this->new               ? $this->new                : "y");
            $this->status				= ($row["status"])				? $row["status"]				: $status->getDefaultStatus();
            $this->data_in_array        = $row;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$leadObj->Save();
		 * <br /><br />
		 *		//Using this in Lead() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id) {
                $aux_log_domain_id = $this->domain_id;
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} elseif (defined("SELECTED_DOMAIN_ID")) {
                $aux_log_domain_id = SELECTED_DOMAIN_ID;
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $aux_log_domain_id = SELECTED_DOMAIN_ID;
                $dbObj = db_getDBObject();
			}

			unset($dbMain);
            
			$this->prepareToSave();
            
			if ($this->id) {
                
				$sql  = "UPDATE Leads SET"
					. " status = $this->status,
                        new = $this->new"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
                
			} else {
                
				$sql = "INSERT INTO Leads ("
					. " item_id, 
                        member_id, 
                        type, 
                        first_name, 
                        last_name, 
                        email, 
                        phone, 
                        subject, 
                        message, 
                        entered, 
                        status)"
					. " VALUES"
					. " ($this->item_id, 
                        $this->member_id, 
                        $this->type, 
                        $this->first_name, 
                        $this->last_name, 
                        $this->email, 
                        $this->phone, 
                        $this->subject, 
                        $this->message, 
                        NOW(), 
                        $this->status)";
				
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
                
                if ($this->type == "'listing'") {
                    $itemObj = new Listing(str_replace("'", "", $this->item_id));
                    $itemTitle = $itemObj->getString("title");
                } elseif ($this->type == "'event'") {
                    $itemObj = new Event(str_replace("'", "", $this->item_id));
                     $itemTitle = $itemObj->getString("title");
                } elseif ($this->type == "'classified'") {
                    $itemObj = new Classified(str_replace("'", "", $this->item_id));
                     $itemTitle = $itemObj->getString("title");
                } else {
                    $itemTitle = system_showText(LANG_LABEL_GENERAL_FORM);
                }
                
                activity_newActivity($aux_log_domain_id, $this->member_id, 0, "newlead", str_replace("'", "", $this->type), $itemTitle);

			}
			
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$leadObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
            
			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id) {
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} elseif (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $dbObj = db_getDBObject();
			}

			unset($dbMain);

			$sql = "DELETE FROM Leads WHERE id = $this->id";
			$dbObj->query($sql);
		}
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$leadObj->Reply($message);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name Reply
         * @param text $message
         * @param string $to
		 * @access Public
        */
		function Reply($message, $to, $listing_id) {
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id) {
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} elseif (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $dbObj = db_getDBObject();
			}

			unset($dbMain);
            
           $sql = "UPDATE Leads SET status = 'A', reply_date = NOW() WHERE id = $this->id";
           $dbObj->query($sql);

           #---------------------------------------------------------
           #	Reply To Sponsor when replied from google mail
           #---------------------------------------------------------
           
           $aid = $_SESSION['SESS_ACCOUNT_ID'];
           $a = new Account($aid);
           $a->username = str_replace("google::", "", $a->username);

           if(strpos($a->username, "facebook::") > -1 ){
           		$b = new Contact($_SESSION['SESS_ACCOUNT_ID']);
           		$a->username = $b->email;	
           }
           setting_get("sitemgr_email", $sitemgr_email);

           #---------------------------------------------------------
           #	Add sponsor's name and listing url in email message
           #---------------------------------------------------------
           
           $info = new Contact($a->id);
           $sp_name = $info->first_name . " " .$info->last_name;

           //Listing_Url
           $listing = new Listing($listing_id);
           $listing_url = NON_SECURE_URL . "/" . ALIAS_LISTING_MODULE ."/". $listing->friendly_url;
           $listing_name = $listing->title;

           $message .= "\r\n";
           $message .= "\r\nSponsor's Name : " . ucwords($sp_name);
           $message .= "\r\nListing Name : " . $listing_name;
           $message .= "\r\nListing Url : " . $listing_url . "\r\n";
           $message .= "\r\n";

           //Lead message from Dashboard : when receiver reply in google to column, sitemgr email is sent, fix.
           system_mail($to, "Re: ".$this->subject, $message, " <$sitemgr_email>", "text/plain", '', '', $error,'','', $a->username, $listing->id, $listing->account_id);
        }
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$leadObj->Forward($message);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 10.0.01
		 * @name Forward
         * @param text $message
         * @param string $to
		 * @access Public
        */
		function Forward($message, $to) {
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id) {
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} elseif (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
                $dbObj = db_getDBObject();
			}

			unset($dbMain);
            
           $sql = "UPDATE Leads SET status = 'A', forward_date = NOW() WHERE id = $this->id";
           $dbObj->query($sql);
            
            setting_get("sitemgr_email", $sitemgr_email);
            system_mail($to, "Fwd: ".$this->subject, $message, " <$sitemgr_email>", "text/plain", '', '', $error);
        }

        #------------------------
        # Custom Functions
        #------------------------

        public static function GetLeadsCountForListing($listing_id, $account_id){
    	    $db  = db_getDBObject();
		    $sql = "SELECT count(*) FROM (Leads, Listing) 
		            WHERE  Leads.type = 'listing' AND Leads.item_id = '$listing_id' 
		            AND Leads.item_id = Listing.id 
		            AND Listing.account_id = '$account_id' 
		            ORDER BY Leads.entered DESC";

		        $result = $db->query($sql);
		        $row = mysql_fetch_assoc($result);

		    return $row['count(*)'];
        }


        public static function GetLeadsForListing($listing_id, $account_id){
    	    $db  = db_getDBObject();
		    $sql = "SELECT Leads.* FROM (Leads, Listing) 
		            WHERE  Leads.type = 'listing' AND Leads.item_id = '$listing_id' 
		            AND Leads.item_id = Listing.id 
		            AND Listing.account_id = '$account_id' 
		            ORDER BY Leads.entered DESC";

		        $result = $db->query($sql);
		        while($row = mysql_fetch_assoc($result)){
		            $return[] = $row;
		        }

		    return $return;
        }

        public static function GetLeadsForListingForPagination($listing_id, $account_id, $start_from, $number_of_results_per_page){
    	    $db  = db_getDBObject();
		    $sql = "SELECT Leads.* FROM (Leads, Listing) 
		            WHERE  Leads.type = 'listing' AND Leads.item_id = '$listing_id' 
		            AND Leads.item_id = Listing.id 
		            AND Listing.account_id = '$account_id' 
		            ORDER BY Leads.entered DESC LIMIT $start_from, $number_of_results_per_page";

		        $result = $db->query($sql);
		        while($row = mysql_fetch_assoc($result)){
		            $return[] = $row;
		        }

		    return $return;
        }



	}
?>