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
# * FILE: /classes/class_googleSettings.php
# ----------------------------------------------------------------------------------------------------

class GoogleSettings extends Handle {

    var $id;
    var $name;
    var $value;

    function GoogleSettings($var = '', $domain = false) {
        DBQuery::execute(function() use($var, $domain) {
            if (is_numeric($var) && ($var)) {
                $dbMain = DBConnection::getInstance()->getMain();
                if ($domain) {
                    $db = DBConnection::getInstance()->getDomain();
                } else {
                    if (defined("SELECTED_DOMAIN_ID")) {
                        $db = DBConnection::getInstance()->getDomain();
                    } else {
                        $db = $dbMain;
                    }
                    unset($dbMain);
                }
                $sql = $db->prepare("SELECT * FROM Setting_Google WHERE id = :var");
                $sql->bindParam(':var', $var);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                $this->makeFromRow($row);
            }
        });
    }

    function makeFromRow($row = '') {

        $this->id = ($row['id']) ? $row['id'] : 0;
        $this->name = ($row['name']) ? $row['name'] : 0;
        $this->value = ($row['value']) ? $row['value'] : "";
    }

    function Save() {
        DBQuery::execute(function(){
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            if ($this->id) {
                $sql = $dbObj->prepare("UPDATE Setting_Google SET name= :name,value= :value WHERE id= :id");
                $parameter = array(
                    ':name' => $this->name,
                    ':value' => $this->value,
                    ':id' => $this->id
                );
                $sql->execute($parameter);
            }
        });
    }

    /* --------- chars not allowed => " ' \ /  ---------- */

    function formatValue($value) {

        if ($value) {
            /* replacing bad characters */
            $value = str_replace("\"", "", $value);
            $value = str_replace("'", "", $value);
            $value = str_replace("/", "", $value);
            $value = str_replace("\\\\", "", $value);

            if ($value)
                return $value;
            else
                return false;
        } else {
            return false;
        }
    }

}

?>
