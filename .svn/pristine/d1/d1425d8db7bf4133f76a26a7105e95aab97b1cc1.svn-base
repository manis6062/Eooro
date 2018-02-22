<?

	/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_Account_Activation.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 * 		$acc_ActObj = new Account_Activation($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 9.8.20
 * @package Classes
 * @name Account_Activation
 * @method Account_Activation
 * @method makeFromRow
 * @method Save
 * @method Delete
 * @method deletePerAccount
 * @access Public
 */
class Account_Activation extends Handle {

    /**
     * @var integer
     * @access Private
     */
    var $account_id;

    /**
     * @var string
     * @access Private
     */
    var $unique_key;

    /**
     * @var date
     * @access Private
     */
    var $entered;

    /**
     * <code>
     * 		$acc_ActObj = new Account_Activation($id);
     * 		//OR
     * 		$acc_ActObj = new Account_Activation($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.8.20
     * @name Account_Activation
     * @access Public
     * @param mixed $var
     */
    function Account_Activation($var = '') {
        DBQuery::execute(function() use($var) {
            if (!is_array($var) && ($var)) {
                $db = DBConnection::getInstance()->getMain();
                $sql = $db->prepare("SELECT * FROM Account_Activation WHERE unique_key =:var");
                $sql->bindParam(':var', $var);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                $this->makeFromRow($row);
            } else {
                if (!is_array($var)) {
                    $var = array();
                }
                $this->makeFromRow($var);
            }
        });
    }

    /**
     * <code>
     * 		$this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.8.20
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row = '') {
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : ($this->account_id ? $this->account_id : 0);
        $this->unique_key = ($row["unique_key"]) ? $row["unique_key"] : ($this->unique_key ? $this->unique_key : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : 0);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$acc_ActObj->Save();
     * <br /><br />
     * 		//Using this in Account_Activation() class.
     * 		$this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.8.20
     * @name Save
     * @access Public
     */
    function Save() {
        DBQuery::execute(function() {

            $dbObj = DBConnection::getInstance()->getMain();


            $sql = $dbObj->prepare("INSERT INTO Account_Activation"
                    . " (account_id, unique_key, entered)"
                    . " VALUES"
                    . " (:account_id, :unique_key, :entered)");

            $param = array(
                ':account_id' => $this->account_id,
                ':unique_key' => $this->unique_key,
                ':entered' => $this->entered
            );

            $sql->execute($param);
            $this->account_id = $dbObj->lastInsertId();
        });
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$acc_ActObj->Delete();
     * <br /><br />
     * 		//Using this in Account_Activation() class.
     * 		$this->Delete();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.8.20
     * @name Delete
     * @access Public
     */
    function Delete() {
        DBQuery::execute(function() {


            $dbObj = DBConnection::getInstance()->getMain();
            $sql = $dbObj->prepare("DELETE FROM Account_Activation WHERE unique_key =:unique_key");
            $sql->bindParam(':unique_key', $this->unique_key);
            $sql->execute();



            $sql2 = $dbObj->prepare("DELETE FROM Account_Activation WHERE account_id =:account_id");
            $sql2->bindParam(':account_id', db_formatNumber($this->account_id));
            $sql2->execute();
        });
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$acc_ActObj->deletePerAccount($account_id);
     * <br /><br />
     * 		//Using this in Account_Activation() class.
     * 		$this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.8.20
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     */
    function deletePerAccount($account_id = 0) {

        DBQuery::execute(function() use($account_id) {

            if (is_numeric($account_id) && $account_id > 0) {
                $dbObj = DBConnection::getInstance()->getMain();
                $sql = $dbObj->prepare("SELECT * FROM Account_Activation WHERE account_id =:account_id");
                $sql->bindParam(':account_id', $account_id);
                $result = $sql->execute();
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $this->makeFromRow($row);
                    $this->Delete();
                }
            }
        });
    }

}

?>