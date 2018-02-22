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
# * FILE: /classes/class_listingTemplate.php
# ----------------------------------------------------------------------------------------------------

class ListingTemplate extends Handle {

    var $id;
    var $layout_id;
    var $title;
    var $updated;
    var $entered;
    var $status;
    var $price;
    var $editable;
    var $theme;

    function ListingTemplate($var = '', $domain_id = false) {
        DBQuery::execute(function() use($var, $domain) {
            if (is_numeric($var) && ($var)) {
                if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                    $db = DBConnection::getInstance()->getDomain();
                } else {
                    $db = DBConnection::getInstance()->getMain();
                }

                $sql = $db->prepare("SELECT * FROM ListingTemplate WHERE id = :var");
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
        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->layout_id = ($row["layout_id"]) ? $row["layout_id"] : ($this->layout_id ? $this->layout_id : 0);
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->status = ($row["status"]) ? $row["status"] : ($this->status ? $this->status : "");
        $this->price = ($row["price"]) ? $row["price"] : ($this->price ? $this->price : "0.00");
        $this->editable = ($row["editable"]) ? $row["editable"] : "y";
        $this->theme = ($row["theme"]) ? $row["theme"] : "";
    }

    function Save() {
        DBQuery::execute(function () {
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }

            if ($this->id) {
                $sql = $db->prepare("UPDATE ListingTemplate SET layout_id = :layout_id , title = :title , updated = NOW() , status = :status , price = :price WHERE id = :id");
                $param = array(
                    ':layout_id' => $this->layout_id,
                    ':title' => $title,
                    ':status' => $this->status,
                    ':price' => $this->price,
                    ':id' => $id
                );
                $sql->execute($param);
            } else {
                $sql = $db->prepare("INSERT INTO ListingTemplate"
                        . " ("
                        . " layout_id,"
                        . " title,"
                        . " updated,"
                        . " entered,"
                        . " status,"
                        . " price,"
                        . " cat_id"
                        . " )"
                        . " VALUES"
                        . " ("
                        . " :layout_id,"
                        . " :title,"
                        . " NOW(),"
                        . " NOW(),"
                        . " :status,"
                        . " :price,"
                        . " ''"
                        . " )");
                $parameters = array(
                    ':layout_id' => $this->layout_id,
                    'title' => $this->title,
                    ':status' => $this->status,
                    ':price' => $this->price,
                );
                $sql->execute($parameters);
                $this->id = $db->lastInsertId();
            }
        });
    }

    function clearListingTemplateFields() {
        DBQuery::execute(function () {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            $sql = $dbObj->prepare("DELETE FROM ListingTemplate_Field WHERE listingtemplate_id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });
    }

    function addListingTemplateField($ltf) {
        DBQuery::execute(function () use($ltf) {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }

            if ($this->id != THEME_TEMPLATE_ID) {
                $ltf["enabled"] = "y";
            }

            $sql = $dbObj->prepare("INSERT INTO ListingTemplate_Field"
                    . " ("
                    . " listingtemplate_id,"
                    . " field,"
                    . " label,"
                    . " fieldvalues,"
                    . " instructions,"
                    . " required,"
                    . " search,"
                    . " searchbykeyword,"
                    . " searchbyrange,"
                    . " show_order,"
                    . " enabled"
                    . " )"
                    . " VALUES"
                    . " ("
                    . " :listingtemplate_id ,"
                    . " :field ,"
                    . " :label ,"
                    . " :fieldvalues ,"
                    . " :instructions ,"
                    . " :required ,"
                    . " :search ,"
                    . " :searchbykeyword ,"
                    . " :searchbyrange ,"
                    . " :show_order ,"
                    . " :enabled ,"
                    . " )");

            $parameters = array(
                ':listingtemplate_id' => $this->id,
                ':field' => $ltf["field"],
                ':label' => $ltf["label"],
                ':fieldvalues' => $ltf["fieldvalues"],
                ':instructions' => $ltf["instructions"],
                ':required' => $ltf["required"],
                ':search' => $ltf["search"],
                ':searchbykeyword' => $ltf["searchbykeyword"],
                ':searchbyrange' => $ltf["searchbyrange"],
                ':show_order' => $ltf["show_order"],
                ':enabled' => $ltf["enabled"] ? $ltf["enabled"] : "n"
            );
            $sql->execute($parameters);
        });
    }

    function retrieveAllTemplates() {
        return DBQuery::execute(function () {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            $sql = $dbObj->prepare("SELECT * FROM ListingTemplate WHERE 1 ORDER BY title");
            $sql->execute();
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                 $data[] = $row;
            }
            if ($data)
                return $data;
            else
                return false;
        });
    }

    function getListingTemplateFields($field_name = "", $enabled = false) {
       return DBQuery::execute(function () use($field_name, $enabled) {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            $sql = "SELECT * FROM ListingTemplate_Field WHERE listingtemplate_id = :id ".($enabled ? "AND enabled = 'y'" : "");
            if (string_strlen(trim($field_name))>0) {
                    $field_name = db_formatString($field_name);
                    $sql .= " AND field = $field_name ";
            }
            $sql .= " ORDER BY show_order";
            $stmt=$dbObj->prepare($sql);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            $row_count = $stmt->rowCount();
            if ($row_count >= 1) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $fields[] = $row;
                }
                if ($fields) {
                    return $fields;
                }
            }
            return false;
        });
    }

    function getFieldByLabel($label = "", $enabled = true) {
        return DBQuery::execute(function () use($label, $enabled){ 
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            $sql = "SELECT field FROM ListingTemplate_Field WHERE label = :label ".($enabled ? "AND enabled = 'y'" : "");
                $sql .= " ORDER BY show_order";
            $stmt=$dbObj->prepare($sql);
            $stmt->bindParam(':label', $label);
            $stmt->execute();
            $row_count = $stmt->rowCount();
            if ($row_count >= 1) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $fields[] = $row["field"];
                }
                if ($fields) {
                    return $fields;
                }
            }
            return false;
    });
    }

    function Delete() {
        DBQuery::execute(function (){
            $this->clearListingTemplateFields();

            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }

            /*
             * Need make $listingObj->save() to update listing table to front
             */

            $sql = $dbObj->prepare("SELECT id FROM Listing WHERE listingtemplate_id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
            $row_count = $sql->rowCount();
            if ($row_count > 0) {
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    unset($listingObj);
                    $listingObj = new Listing($row["id"]);
                    $listingObj->setNumber("listingtemplate_id", 0);
                    $listingObj->Save();
                }
            }

            $sql = $dbObj->prepare("DELETE FROM ListingTemplate WHERE id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });
    }

    function getCategories() {
        return DBQuery::execute(function (){ 
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }

            $sql = $dbObj->prepare("SELECT cat_id FROM ListingTemplate WHERE id = :id");
            $sql->bindParam(":id", $this->id);
            $sql->execute();
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                if ($row["cat_id"]) {
                    $cat_id = explode(",", $row["cat_id"]);
                    foreach ($cat_id as $catid) {
                        $categories[] = new ListingCategory($catid);
                    }
                }
            }

            return $categories;
        });
    }

    function setCategories($array) {
        DBQuery::execute(function ()use($array){ 
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = DBConnection::getInstance()->getDomain();
            } else {
                $dbObj = DBConnection::getInstance()->getMain();
            }
            $cat_id = "";
            if ($array) {
                foreach ($array as $category) {
                    if ($category) {
                        $catid[] = $category;
                    }
                }
            }
            if ($catid)
            $cat_id = implode(",", $catid);
            $sql = $dbObj->prepare("UPDATE ListingTemplate SET cat_id = :cat_id WHERE id = :id");
            $sql->bindParam(':cat_id', $cat_id);
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });
    }

}

?>
