<?

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
	# * FILE: /classes/class_AccountProfileContact.php
	# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$accountObj = new AccountProfileContact($domain_id, $account_id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name AccountProfileContact
 * @method AccountProfileContact
 * @method makeFromRow
 * @method Save
 * @method Delete
 * @access Public
 */

class AccountProfileContact extends Handle {

        /**
         * @var integer
         * @access Private
         */
        var $account_id;
/**
         * @var varchar
         * @access Private
         */
        var $username;
        /**
         * @var varchar
         * @access Private
         */
        var $first_name;
        /**
         * @var varchar
         * @access Private
         */
        var $last_name;
        /**
         * @var varchar
         * @access Private
         */
        var $nickname;
        /**
         * @var varchar
         * @access Private
         */
        var $friendly_url;
        /**
         * @var integer
         * @access Private
         */
        var $image_id;
        /**
         * @var varchar
         * @access Private
         */
        var $facebook_image;
        /**
         * @var integer
         * @access Private
         */
        var $facebook_image_width;
        /**
         * @var integer
         * @access Private
         */
        var $facebook_image_height;
        /**
         * @var char
         * @access Private
         */
        var $has_profile;
        /**
         * @var integer
         * @access Private
         */
        var $domain_id;
        var $has_account;
         /**
         * @var char
         * @access Private
         */
         
    /**
     * <code>
     *		$accountObj = new AccountProfileContact($domain_id, $account_id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name AccountProfileContact
     * @access Public
     * @param integer $domain_id
     * @param integer $var
     */
    function __construct($domain_id, $var='') {
        if (is_numeric($var) && ($var)) {
            $this->domain_id = $domain_id;
            $row = DBQuery::execute(function() use ($var){
                $main = DBConnection::getInstance()->getDomain();
                $stmt = $main->prepare('SELECT * FROM AccountProfileContact WHERE account_id=:var');
                $stmt->bindParam(':var', $var);
                $stmt->execute();
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }); 
            $this->makeFromRow($row);
        } 
        else {
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
     * @version 8.0.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row='') {

            if ($row['account_id']) { $this->account_id = $row['account_id']; $this->has_account = 1; }
            else if (!$this->account_id) { $this->account_id = 0; $this->has_account = 0; }
            if ($row['username']) $this->username = $row['username'];
            else if (!$this->username) $this->username = "";
            if ($row['first_name']) $this->first_name = $row['first_name'];
            else if (!$this->first_name) $this->first_name = "";
            if ($row['last_name']) $this->last_name = $row['last_name'];
            else if (!$this->last_name) $this->last_name = "";
            if ($row['nickname']) $this->nickname = $row['nickname'];
            else if (!$this->nickname) $this->nickname = "";
            if ($row['friendly_url']) $this->friendly_url = $row['friendly_url'];
            else if (!$this->friendly_url) $this->friendly_url = "";
            if ($row['image_id']) $this->image_id = $row['image_id'];
            else if (!$this->image_id) $this->image_id = 0;
            if ($row['facebook_image']) $this->facebook_image = $row['facebook_image'];
            else if (!$this->facebook_image) $this->facebook_image = "";
            if ($row['facebook_image_width']) $this->facebook_image_width = $row['facebook_image_width'];
            else if (!$this->facebook_image_width) $this->facebook_image_width = 0;
            if ($row['facebook_image_height']) $this->facebook_image_height = $row['facebook_image_height'];
            else if (!$this->facebook_image_height) $this->facebook_image_height = 0;
            if ($row['has_profile']) $this->has_profile = $row['has_profile'];
            else if (!$this->has_profile) $this->has_profile = "n";
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->Save();
     * <br /><br />
     *		//Using this in AccountProfileContact() class.
     *		$this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */

    function Save() {
        $main = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($main ){

            if ($this->has_account) {
                $stmt = $main->prepare("UPDATE AccountProfileContact SET"
                    //. " username = $this->username," // commented due to security issue.
                    . " first_name = :first_name,"
                    . " last_name = :last_name,"
                    . " nickname = :nickname,"
                    . " friendly_url = :friendly_url,"
                    . " image_id = :image_id,"
                    . " facebook_image = :facebook_image,"
                    . " has_profile = :has_profile"
                    . " WHERE account_id = :account_id");
                $parameters = array(
                    ':first_name'          => $this->first_name,
                    ':last_name'           => $this->last_name,
                    ':nickname'            =>$this->nickname,
                    ':friendly_url'        => $this->friendly_url,
                    ':image_id'            => $this->image_id,
                    ':facebook_image'      => $this->facebook_image,
                    ':has_profile'         => $this->has_profile,
                    ':account_id'          => $this->account_id
                );

            } 
            else {
                $stmt = $main->prepare("INSERT INTO AccountProfileContact"
                        ."(account_id,
                           username,
                           first_name,
                           last_name,
                           nickname,
                           friendly_url,
                           image_id,
                           facebook_image,
                           facebook_image_width,
                           facebook_image_height,
                           has_profile)"
                       . " VALUES"
                       . " (:account_id,
                           :username,
                           :first_name,  
                           :last_name, 
                           :nickname, 
                           :friendly_url,
                            :image_id, 
                            :facebook_image,
                            :facebook_image_width,
                            :facebook_image_height, 
                            :has_profile)");
                $parameters = array(
                    ':account_id'   => $this->account_id,
                    ':username'          => $this->username,
                    ':first_name'          => $this->first_name,
                    ':last_name'          => $this->last_name,
                    ':nickname'          => $this->nickname,
                    ':friendly_url'          => $this->friendly_url,
                    ':image_id'          => $this->image_id,
                    ':facebook_image'          => $this->facebook_image,
                    ':facebook_image_width'    => $this->facebook_image_width,
                    ':facebook_image_height'   => $this->facebook_image_height,
                    ':has_profile'          => $this->has_profile);
            }

            $stmt->execute($parameters);		
        });

    }
		
    function Delete() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("DELETE FROM AccountProfileContact WHERE account_id = :account_id");
            $stmt->bindParam(':account_id', $this->account_id);
            $stmt->execute();
        });
    }
}
?>