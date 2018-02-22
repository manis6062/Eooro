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
# * FILE: /classes/class_forgotPassword.php
# ----------------------------------------------------------------------------------------------------

class forgotPassword extends Handle {

    var $account_id;
    var $unique_key;
    var $entered;
    var $section;

    function forgotPassword($var = '') {
        DBQuery::execute(function() use($var) {
            if (!is_array($var) && ($var)) {
                $mainDb = DBConnection::getInstance()->getMain();
                $sql = $mainDb->prepare("SELECT * FROM Forgot_Password WHERE unique_key = :var");
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

    function makeFromRow($row = '') {
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : ($this->account_id ? $this->account_id : 0);
        $this->unique_key = ($row["unique_key"]) ? $row["unique_key"] : ($this->unique_key ? $this->unique_key : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : 0);
        $this->section = ($row["section"]) ? $row["section"] : ($this->section ? $this->section : "");
    }

    function Save() {
        DBQuery::execute(function() {
            $mainDb = DBConnection::getInstance()->getMain();
            $sql = $mainDb->prepare("INSERT INTO Forgot_Password"
                    . "(account_id,"
                    . "unique_key,"
                    . "entered,"
                    . "section)"
                    . "VALUES"
                    . "(:account_id,"
                    . ":unique_key,"
                    . ":entered,"
                    . ":section)");
            $parameters = array(
                ":account_id" => $this->account_id,
                ":unique_key" => $this->unique_key,
                ":entered" => $this->entered,
                ":section" => $this->section
            );
            $result = $sql->execute($parameters);
            if ($result) {
                $this->account_id = $mainDb->lastInsertId();
            }
        });
    }

    function Delete() {
        DBQuery::execute(function() {

            $mainDb = DBConnection::getInstance()->getMain();
            $sql = $mainDb->prepare(
                    "DELETE FROM Forgot_Password WHERE unique_key = :unique_key AND section = :section AND account_id = :account_id"
            );
            $parameter = array(
                ":unique_key" => $this->unique_key,
                ":section" => $this->section,
                ":account_id" => $this->account_id
            );
            $sql->execute($parameter);
        });
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$fgtPassObj->deletePerAccount($account_id);
     * <br /><br />
     * 		//Using this in ForgotPassword() class.
     * 		$this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     */
    function deletePerAccount($account_id = 0) {
        DBQuery::execute(function() use($account_id) {
            if (is_numeric($account_id) && $account_id > 0) {
                $mainDb = DBConnection::getInstance()->getMain();
                $sql = $mainDb->prepare("SELECT * FROM Forgot_Password WHERE account_id = :account_id");
                $sql->bindParam(':account_id', $account_id);
                $sql->execute();
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $this->makeFromRow($row);
                    $this->Delete();
                }
            }
        });
    }

}

?>