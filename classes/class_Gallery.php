<?php

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
# * FILE: /classes/class_gallery.php
# ----------------------------------------------------------------------------------------------------

class Gallery extends Handle {

    var $id;
    var $account_id;
    var $title;
    var $entered;
    var $updated;
    var $image;

    function Gallery($var = '', $domain_id = false, $main_image = false) {
        DBQuery::execute(function() use($var, $domain_id, $main_image) {
            if (is_numeric($var) && ($var)) {
                if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                    $db = DBConnection::getInstance()->getDomain();
                } else {
                    $db = DBConnection::getInstance()->getMain();
                }

                $sql = $db->prepare("SELECT * FROM Gallery WHERE id =:id");
                $sql->bindParam(':id', $var);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                
                $sql2 = $db->prepare("SELECT * FROM Gallery_Image WHERE gallery_id =:id order by id desc");
                $sql2->bindParam(':id', $var);
                $r = $sql2->execute();
                $i = 0;
                while ($row_aux = $sql2->fetch(\PDO::FETCH_ASSOC)) {
                    unset($imageAux);
                    unset($imageThumbAux);
                    $imageAux = new Image($row_aux['image_id']);
                    $imageThumbAux = new Image($row_aux['thumb_id']);

                    if ($imageAux->imageExists() && $imageThumbAux->imageExists()) {
                        $image[$i]['id'] = $row_aux['id'];
                        $image[$i]['image_id'] = $row_aux['image_id'];
                        $image[$i]['thumb_id'] = $row_aux['thumb_id'];
                        $image[$i]['image_caption'] = $row_aux['image_caption'];
                        $image[$i]['thumb_caption'] = $row_aux['thumb_caption'];
                        $image[$i]['image_default'] = $row_aux['image_default'];
                        $image[$i]['order'] = $row_aux['order'];
                        $sql3 = $db->prepare("SELECT * FROM Image WHERE id =:img_id");
                        $sql3->bindParam(':img_id', $row_aux[image_id]);
                        $row_aux = $sql3->fetch(\PDO::FETCH_ASSOC);
                        $image[$i]['width'] = $row_aux['width'];
                        $image[$i]['height'] = $row_aux['height'];
                        $i++;
                    }
                }
                $this->makeFromRow($row, $image);
            } else {
                if (!is_array($var)) {
                    $var = array();
                }
                $this->makeFromRow($var);
            }
        });
    }

    function getAllImages($gallery_id, $domain_id = false) {
        return DBQuery::execute(function() use($gallery_id, $domain_id) {

            if (is_numeric($gallery_id) && ($gallery_id)) {
                if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                    $db = DBConnection::getInstance()->getDomain();
                } else {
                    $db = DBConnection::getInstance()->getMain();
                }
                $sql = $db->prepare("SELECT * FROM Gallery WHERE id =:gallery_id");
                $sql->bindParam(':gallery_id', $gallery_id);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                $sql2 = $db->prepare("SELECT * FROM Gallery_Image WHERE gallery_id =:gallery_id ORDER BY image_default DESC, id");
                $sql2->bindParam(':gallery_id', $gallery_id);
                $r = $sql2->execute();
                $i = 0;
                while ($row_aux = $sql2->fetch(\PDO::FETCH_ASSOC)) {
                    $image[$i]['id'] = $row_aux['id'];
                    $image[$i]['image_id'] = $row_aux['image_id'];
                    $image[$i]['thumb_id'] = $row_aux['thumb_id'];
                    $image[$i]['image_caption'] = $row_aux['image_caption'];
                    $image[$i]['thumb_caption'] = $row_aux['thumb_caption'];
                    $image[$i]['image_default'] = $row_aux['image_default'];
                    $image[$i]['order'] = $row_aux['order'];
                    
                    $sql = $db->prepare("SELECT * FROM Image WHERE id = :id");
                    $sql->bindParam(":id", $row_aux[image_id]);
                    $sql->execute();
                    $row_aux=$sql->fetch(\PDO::FETCH_ASSOC);
                    
                    
//                    $row_aux = mysql_fetch_array($dbObj->query($sql));
                    $image[$i]['width'] = $row_aux['width'];
                    $image[$i]['height'] = $row_aux['height'];
                    $i++;
                }
                return $image;
            } else {
                return false;
            }
        });
    }

    function getImagesCount() {
        return count($this->image);
    }

    function makeFromRow($row = '', $image = '') {
        $this->image = $image;
        $row['id'] ? $this->id = $row['id'] : $this->id = 0;
        $row['account_id'] ? $this->account_id = $row['account_id'] : $this->account_id = 0;
        $row['entered'] ? $this->entered = $row['entered'] : $this->entered = 0;
        $row['updated'] ? $this->updated = $row['updated'] : $this->updated = 0;
        $row['title'] ? $this->title = $row['title'] : $this->title = 'NO NAME';
    }

    function Save() {
        DBQuery::execute(function() {

            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            if ($this->id) {
                $sql = $db->prepare("UPDATE Gallery SET title =:title , account_id =:account_id,updated = NOW() WHERE id =:id");
                $sql->bindParam(':title', $this->title);
                $sql->bindParam(':account_id', $this->account_id);
                $sql->bindParam(':id', $this->id);
                $sql->execute();
            } else {
                $sql = $db->prepare("INSERT INTO Gallery"
                        . " (title,"
                        . " account_id,"
                        . " entered,"
                        . " updated)"
                        . " VALUES"
                        . " (:title, "
                        . " :account_id,"
                        . " NOW(), "
                        . " NOW())");
                $sql->bindParam(':title', $this->title);
                $sql->bindParam(':account_id', $this->account_id);
                $sql->execute();
                $this->id = $db->lastInsertId();
            }
        });
    }

    function Delete($domain_id = false) {

        DBQuery::execute(function() use($domain_id) {
            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            $sql = $db->prepare("SELECT * FROM Gallery_Image WHERE gallery_id =:id");
            $sql->bindParam(':id', $this->id);
            $r = $sql->execute();
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                $imageObj = new Image($row['image_id']);
                $imageObj->Delete($domain_id);
                $imageObj = new Image($row['thumb_id']);
                $imageObj->Delete($domain_id);
            }
            $sql2 = $db->prepare("DELETE FROM Gallery_Image WHERE gallery_id =:id");
            $sql2->bindParam(':id', $this->id);
            $sql2->execute();

            $sql3 = $db->prepare("DELETE FROM Gallery WHERE id =:id");
            $sql3->bindParam(':id', $this->id);
            $sql3->execute();

            $sql4 = $db->prepare("DELETE FROM Gallery_Item WHERE gallery_id =:id");
            $sql4->bindParam(':id', $this->id);
            $sql4->execute();
        });
    }

//    // like prepareToSave but only used by AddImage and EditImage
//    function getGalleryToSave($vars = '') {
//        if ($vars) {
//            foreach ($vars as $key => $value)
//                if (is_string($value))
//                    if ((!strstr($value, "\'")) && (!strstr($value, "\\\"")) && (!strstr($value, "\\")))
//                        $vars[$key] = addslashes($value);
//            $result = $vars;
//        } else
//            $result = 0;
//        return $result;
//    }

//    // like prepareToUse but only used by AddImage and EditImage
//    function getGalleryToUse($vars = '') {
//        if ($vars) {
//            foreach ($vars as $key => $value)
//                $vars[$key] = stripslashes($value);
//            $result = $vars;
//        } else
//            $result = 0;
//        return $result;
//    }

    function AddImage($row, $domain_id = false) {
        DBQuery::execute(function() use($row, $domain_id) {

            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            $sql = $db->prepare("INSERT INTO Gallery_Image"
                    . " (gallery_id,
					image_id,
					thumb_id,
					image_caption,
					thumb_caption,
					image_default)"
                    . " VALUES"
                    . " (:gallery_id,"
                    . " :image_id,"
                    . " :thumb_id,"
                    . " :image_caption,"
                    . " :thumb_caption,"
                    . " :image_default)");

            $param = array(
                ':gallery_id' => $this->id,
                ':image_id' => $row[image_id],
                ':thumb_id' => $row[thumb_id],
                ':image_caption' => $row[image_caption],
                ':thumb_caption' => $row[thumb_caption],
                ':image_default' => $row[image_default]
            );
            $sql->execute($param);
        });
    }

    function EditImage($row) {
        DBQuery::execute(function() use($row) {

            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            
               $sql =$db->prepare("UPDATE Gallery_Image SET"
                    . " gallery_id = :gallery_id,"
                    . " image_id = :image_id,"
                    . " thumb_id = :thumb_id,"
                    . " image_caption = :image_caption,"
                    . " thumb_caption = :thumb_caption,"
                    . " image_default = :image_default"
                    . " WHERE id = :id");
               
               $param = array(
                   ':gallery_id' => $this->id,
                   ':image_id' => $row[image_id],
                   ':thumb_id' => $row[thumb_id],
                   ':image_caption' => $row[image_caption],
                   ':thumb_caption' => $row[thumb_caption],
                   ':image_default' => $row[image_default],
                   'id' => $row[id]
               );
               $sql->execute($param);

        });
    }

    function DeleteImage($id) {
        DBQuery::execute(function() use($id) {

            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            $sql = $db->prepare("SELECT * FROM Gallery_Image WHERE image_id =:image_id AND gallery_id =:gallery_id");
            $sql->bindParam(':image_id', $id);
            $sql->bindParam(':gallery_id', $this->id);
            $sql->execute();
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            $image = new Image($row["image_id"]);
            $image->Delete();
            $image = new Image($row["thumb_id"]);
            $image->Delete();

            $sql2 = $db->prepare("DELETE FROM Gallery_Image WHERE image_id =:image_id");
            $sql2->bindParam(':image_id', $id);
            $sql2->execute();
        });
    }

    function deletePerAccount($account_id = 0, $domain_id = false) {
        DBQuery::execute(function() use($account_id, $domain_id) {
            if (is_numeric($account_id) && $account_id > 0) {
                if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                    $db = DBConnection::getInstance()->getDomain();
                } else {
                    $db = DBConnection::getInstance()->getMain();
                }
                $sql = $db->prepare("SELECT * FROM Gallery WHERE account_id =:account_id");
                $sql->bindParam(':account_id', $account_id);
                $result = $sql->execute();
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $this->makeFromRow($row);
                    $this->Delete($domain_id);
                }
            }
        });
    }

    function getItemTitle() {
        DBQuery::execute(function() {
            if ($domain_id || defined("SELECTED_DOMAIN_ID")) {
                $db = DBConnection::getInstance()->getDomain();
            } else {
                $db = DBConnection::getInstance()->getMain();
            }
            $sqlGI = $db->prepare("SELECT item_id,item_type FROM Gallery_Item WHERE gallery_id =:gallery_id");
            $sqlGI->bindParam(':gallery_id', db_formatNumber($this->id));
            $resGI = $sqlGI->execute();
            $resGIRows = $sqlGI->rowCount();

            if ($resGIRows > 0) {
                $rowGI = $sqlGI->fetch(\PDO::FETCH_ASSOC);
                $sqlI = $db->prepare("SELECT title FROM `".string_ucwords($rowGI["item_type"])."` WHERE id =:id");
                $sqlI->bindParam(':id', db_formatNumber($rowGI["item_id"]));
                $resI = $sqlI->execute();
                $resIRowCount = $sqlI->rowCount();
                if ($resIRowCount > 0) {
                    $rowI = $sqlI->fetch(\PDO::FETCH_ASSOC);
                    $this->title = $rowI["title"];
                }
            }
        });
    }

}

?>
