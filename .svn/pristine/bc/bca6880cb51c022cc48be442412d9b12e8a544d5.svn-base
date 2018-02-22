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
# * FILE: /classes/class_Location_1.php
# ----------------------------------------------------------------------------------------------------

class Location1 extends Handle {

    var $id;
    var $name;
    var $abbreviation;
    var $friendly_url;
    var $seo_description;
    var $seo_keywords;

    function Location1($var = '') {
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main,$var) {
            if (is_numeric($var) && ($var)) {
                $db = db_getDBObject(DEFAULT_DB, true);
                $sql = $main->prepare("SELECT * FROM Location_1 WHERE id = :id");
                $parameters = array(
                    ':id' => $var
                );
                $sql->execute($parameters);
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

        if ($row['id'])
            $this->id = $row['id'];
        else if (!$this->id)
            $this->id = 0;

        if ($row['name'])
            $this->name = $row['name'];
        else if (!$this->name)
            $this->name = "";

        $this->abbreviation = $row['abbreviation'];

        if ($row['friendly_url'])
            $this->friendly_url = $row['friendly_url'];
        else if (!$this->friendly_url)
            $this->friendly_url = "";

        $this->seo_description = $row['seo_description'];
        $this->seo_keywords = $row['seo_keywords'];
    }

     function Save($updFullText = false) {
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main, $father_level, $updFullText) {
            $this->friendly_url = string_strtolower($this->friendly_url);

            if ($this->id) {
                system_logLocationChanges($this->id,  1, 0, 0);

                $sql = $main->prepare("UPDATE Location_1 SET"
                        . " name = :name,"
                        . " abbreviation = :abbreviation,"
                        . " friendly_url = :friendly_url,"
                        . " seo_description = :seo_description,"
                        . " seo_keywords = :seo_keywords"
                        . " WHERE id = :id");
                $parameters = array(
                    ':id' => $this->id,
                    ':name' => $this->name,
                    ':abbreviation' => $this->abbreviation,
                    ':friendly_url' => $this->friendly_url,
                    ':seo_description' => $this->seo_description,
                    ':seo_keywords' => $this->seo_keywords
                );
                $sql->execute($parameters);
            } else {
                $sql = $main->prepare("INSERT INTO Location_1"
                        . " ( name, abbreviation, friendly_url, seo_description, seo_keywords)"
                        . " VALUES"
                        . " (:name, :abbreviation, :friendly_url, :seo_description, :seo_keywords)");
                $parameters = array(
                    ':name' => $this->name,
                    ':abbreviation' => $this->abbreviation,
                    ':friendly_url' => $this->friendly_url,
                    ':seo_description' => $this->seo_description,
                    ':seo_keywords' => $this->seo_keywords
                );
                $sql->execute($parameters);
               
                $this->id = $main->lastInsertId();
            }

            if ($updFullText)
                $this->updateFullTextItems();
        });
    }


     function Delete($updFullText = false) {//tested
         
        $main = DBConnection::getInstance()->getMain();
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($main, $updFullText, $domain) {
            if ($this->id) {

                $sqlDomain = $main->prepare("SELECT `id` FROM `Domain` WHERE `status` = :status");

                $parameters = array(':status' => 'A');
                $sqlDomain->execute($parameters);
                
                while ($row = $sqlDomain->fetch(\PDO::FETCH_ASSOC)) {
                    $sql = $domain->prepare("UPDATE Listing SET location_1 = :location_1, location_2 = :location_2 , location_3 = :location_3, location_4 = :location_4, location_5 = :location_5 WHERE location_1 = :con");
                    $parameters = array(
                        ':location_1' => 0,
                        ':location_2' => 0,
                        ':location_3' => 0,
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id
                    );
                    $sql->execute($parameters);
                    //Promotion
                    $sql = $domain->prepare("UPDATE Promotion SET    
                                                    listing_location1 = :listing_location1,
                                                    listing_location2 = :listing_location2, 
                                                    listing_location3 = :listing_location3, 
                                                    listing_location4 = :listing_location4, 
                                                    listing_location5 = :listing_location5 
                            WHERE listing_location1 = :con");
                    $parameters = array(
                        ':listing_location1'=>0,
                        ':listing_location2' => 0,
                        ':listing_location3' => 0,
                        ':listing_location4' => 0,
                        ':listing_location5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                    //Listing_Summary
                        $sql = $domain->prepare("UPDATE Listing_Summary SET 
                                                                                                           location_1 = 0,
                                                                                                           location_1_title = '',
                                                                                                           location_1_abbreviation = '',
                                                                                                           location_1_friendly_url = '',
                                                                                                           location_2 = 0,
													   location_2_title = '',
													   location_2_abbreviation = '',
													   location_2_friendly_url = '',
													   location_3 = 0,
													   location_3_title = '',
													   location_3_abbreviation = '',
													   location_3_friendly_url = '',
													   location_4 = 0,
													   location_4_title = '',
													   location_4_abbreviation = '',
													   location_4_friendly_url = '',
													   location_5 = 0,
													   location_5_title = '',
													   location_5_abbreviation = '',
													   location_5_friendly_url = ''
							WHERE location_1 = :location_1");
                    $parameters = array(
                        ':location_1' => $this->id
                    );
                    $sql->execute($parameters);
                    //Event
                    $sql = $domain->prepare("UPDATE Event SET location_1 = :location_1,location_2 = :location_2, location_3 = :location_3, location_4 = :location_4, location_5 = :location_5 WHERE location_1 = :con");
                    $parameters = array(
                        ':location_1' => 0,
                        ':location_2' => 0,
                        ':location_3' => 0,
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                    //Classified
                    $sql = $domain->prepare("UPDATE Classified SET location_1 = :location_1,location_2 = :location_2, location_3 = :location_3, location_4 = :location_4, location_5 = :location_5 WHERE location_1 = :con");
                    $parameters = array(
                        ':location_1' => 0,
                        ':location_2' => 0,
                        ':location_3' => 0,
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                }
                unset($rowDomain);

                $_locations = explode(",", EDIR_LOCATIONS);
               
                system_retrieveLocationRelationship($_locations, 1, $_location_father_level, $_location_child_level);
                
                if ($_location_child_level) { 
                    $sql = $main->prepare("SELECT id FROM Location_" . $_location_child_level . " WHERE location_1=:location_1");
                    $parameters = array(
                        ':location_1' => $this->id
                    );
                   
                    $sql->execute($parameters);
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                   
                    if (count($row) > 0) {
                        while ($row) {
                            $objLocationLabel = "Location" . $_location_child_level;
                            unset(${"Location" . $_location_child_level});
                            ${"Location" . $_location_child_level} = new $objLocationLabel;
                            ${"Location" . $_location_child_level}->SetNumber("id", $row["id"]);
                            ${"Location" . $_location_child_level}->Delete();
                        }
                    }
                }
                $sql = $main->prepare("DELETE FROM Location_1 WHERE id = :id");
                $parameters = array(
                    ':id' => $this->id
                );
                $sql->execute($parameters);
            }
        });
    }

    function updateFullTextItemsLoc($listings_ids = false) {
        $main = DBConnection::getInstance()->getMain();
        $domain = DBConnection::getInstance()->getDomain();
       return DBQuery::execute(function() use ($domain,$listings_ids) {
            if (!$listings_ids) {
                if ($this->id) { 
                    $sql = $domain->prepare("SELECT id FROM Listing WHERE Location_1 = :id");
                    $parameters = array(
                        ':id' => $this->id
                    );
                    $sql->execute($parameters);
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                    
                    while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                        if ($row['id']) {
                            $listingObj = new Listing($row['id']);
                            $listingObj->setFullTextSearch(true, 1);
                            unset($listingObj);
                        }
                    }
                    return true;
                }
                return false;
            } else {
                foreach ($listings_ids as $listing_id) {
                    if ($listing_id) {
                        $listingObj = new Listing($listing_id);
                        $listingObj->setFullTextSearch(true, 1);
                        unset($listingObj);
                    }
                }
                return true;
            }
        });
    }

    function retrieveFeatureds($_locations = false, $default = false, $last_default_level = false, $last_default_id = false) {
        
        $main = DBConnection::getInstance()->getMain();
       return DBQuery::execute(function() use ($main,$_locations ,$default,$last_default_level,$last_default_id) {
           $locationFeatObj = new LocationFeatured();
            $domain_id = $locationFeatObj->getFeatureds(SELECTED_DOMAIN_ID, 1);
            
            $sql1 = "
				SELECT
					Location_1.*
				FROM
					Location_1
				WHERE
					Location_1." . ($default == false ? "id IN (:domain_id)" : "id = :id") . "
				GROUP BY
					Location_1.id
				ORDER BY
					Location_1.name ";
            
            $sql1 = $main->prepare_wherein($sql1, ':domain_id', $domain_id);
            
            if($default !=false){
                $sql1->bindParam(':id',$default);
            }
            $sql1->execute();
                                                    
            $rows = array();
           
            while ($row1 = $sql1->fetch(\PDO::FETCH_BOTH))
                $rows[] = $row1;
            
            return $rows;
        });
    }

    function isRepeated($father_level, &$error_message) {//PENDING anup dai told
        $main = DBConnection::getInstance()->getMain();
     return   DBQuery::execute(function() use ($main,$father_level, &$error_message) {
            $sql = "SELECT * FROM Location_1 WHERE name = :name";
            if ($father_level !== false) {
                $father_level_value = "location_" . $father_level;
                if ($this->$father_level_value) {
                    $father_level_value = $this->$father_level_value;
                    $sql .= " AND location_" . $father_level . " = :father_level_value";
                    $parameters[':father_level_value'] = $father_level_value;
                }
            }

            if ($this->id){
                $sql .= " AND id != :id";
                $parameters[':id'] = $this->id;
            }
            $sql = $main->prepare($sql);
            $parameters[':name'] = $this->name;
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if ($row) {
                $error_message = string_ucwords(LOCATION_TITLE) . " " . $this->name . " " . system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
                return true;
            }
            return false;
        });
    }

    function retrievedIfRepeated($_locations) {
        $main = DBConnection::getInstance()->getMain();
       return DBQuery::execute(function() use ($main,$_locations) {
            $sql1 = "SELECT * FROM Location_1 WHERE (friendly_url = :url OR name = :name) ";

            if ($this->id)
                $sql .= " AND id != $this->id";

            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare($sql1);
            $parameters = array(
                ':url' => $this->friendly_url,
                ':name' => $this->name
            );
            $sql->execute($parameters);
         
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if ($row["id"]) {
                return $row["id"];
            } else {
                return false;
            }
        });
    }

    function retrieveAllLocation($ids = false, $fields = "*") {
       
        $main = DBConnection::getInstance()->getMain();
       return DBQuery::execute(function() use ($main,$ids,$fields) {
          
          
          //  $ids = implode(",", $ids);
           $location_ids = $ids; 
            $sql = "SELECT $fields FROM Location_1 " . (is_array($ids) ? "WHERE id IN (:ids)" : "") . " ORDER BY name";
            if(is_string($ids)||  is_array($ids)){
                $sql = $main->prepare_wherein($sql,':ids',$location_ids);
            }
            else{
                $sql=$main->prepare($sql);
            }
            $sql->execute();
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC))
                $data[] = $row;
            
            if ($data)
                return $data;
            else
                return false;
        });
    }

    function retrieveLocationById() {
        $main = DBConnection::getInstance()->getMain();
     return   DBQuery::execute(function() use ($main) {
           
            if (is_numeric($this->id)) {
                $sql = $main->prepare("SELECT * FROM Location_1 WHERE id = :id");
                $parameters = array(
                    ':id' => $this->id
                );
                $sql->execute($parameters);
                //$result = $dbObj->query($sql);
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                
            }
            if ($row)
                return $row;
            else
                return false;
        });
    }

    function isValidFriendlyUrl($father_level, &$error_message) { 
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main, $father_level, &$error_message) {
            if (!$this->getString("friendly_url")) {
                $error_message = "&#149;&nbsp; Friendly Title is required, please do not leave it blank.";
                return false;
            }
            $sql = "SELECT friendly_url FROM Location_1 WHERE friendly_url = :friendly_url";
            
            if ($father_level !== false) {
                $father_level_value = "location_$main->prepare" . $father_level;
                if ($this->$father_level_value) {
                    $father_level_value = $this->$father_level_value;
                    $sql .= " AND location_" . $father_level . " = :father_level";
                    $parameters[':father_level'] = $father_level_value;
                }
            }
            if ($this->getString("id")) {
                $sql .= " AND id != :id";
                $parameters [':id'] = $this->getString("id");
            }
            $sql .= " LIMIT 1";
            $parameters[':friendly_url'] = $this->getString("friendly_url");
            $sql = $main->prepare($sql);
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            $rows = $sql -> rowCount();
            if ($rows > 0) {
                $error_message = "&#149;&nbsp; Friendly Title already in use, please choose another Friendly Title";
                return false;
            }
            if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, $this->getString("friendly_url"))) {
                $error_message = "&#149;&nbsp; Friendly Url contain invalid chars";
                return false;
            }
            return true;
        });
    }
    // function updateFullTextItems() {
    //     //TODO :: location_1_id doesnot exist so this function was not tested. 
    //     //Kushal khadka june-8 2016
        
    //     $main = DBConnection::getInstance()->getMain();
    //     $domain = DBConnection::getInstance()->getDomain();

    //     DBQuery::execute(function() use ($main,$domain) {
    //         if ($this->id) {

    //             $dbObj = db_getDBObject(DEFAULT_DB, true);

    //             //Listing
    //             if (LISTING_SCALABILITY_OPTIMIZATION != 'on') {
    //                 $sql = $main->prepare("SELECT * FROM Listing WHERE location_1_id = :id");
    //                 $parameters = array(
    //                     ':id' => $this->id
    //                 );
    //                 $sql->execute($parameters);
    //                 //$result = $dbObj->query($sql);
    //                 while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
    //                     $itemObj = new Listing($row['id']);
    //                     $itemObj->setFullTextSearch();
    //                     unset($itemObj);
    //                 }
    //             }

    //             //Event
    //             if (EVENT_FEATURE == 'on' && EVENT_SCALABILITY_OPTIMIZATION != 'on') {
    //                 $sql = $domain->prepare("SELECT * FROM Event WHERE location_1_id = :id");
    //                 $parameters = array(
    //                     ':id' => $this->id
    //                 );
    //                 $sql->execute($parameters);
    //                 //$result = $dbObj->query($sql);
    //                 while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
    //                     $itemObj = new Event($row['id']);
    //                     $itemObj->setFullTextSearch();
    //                     unset($itemObj);
    //                 }
    //             }

    //             //Classified
    //             if (CLASSIFIED_FEATURE == 'on' && CLASSIFIED_SCALABILITY_OPTIMIZATION != 'on') {
    //                 $sql = $main->prepare("SELECT * FROM Classified WHERE location_1_id = :id");
    //                 $parameters = array(
    //                     ':id' => $this->id
    //                 );
    //                 $sql->execute($parameters);
    //                 //$result = $dbObj->query($sql);
    //                 while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
    //                     $itemObj = new Classified($row['id']);
    //                     $itemObj->setFullTextSearch();
    //                     unset($itemObj);
    //                 }
    //             }

    //             return true;
    //         }

    //         return false;
    //     });
    // }

    function getFullFriendlyURL() {
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main) {
          
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT friendly_url AS full_friendly_url FROM Location_1 WHERE id = :id");
            $parameters = array(
                ':id' => $this->id
            );
            
            $result = $sql->execute($parameters);
             $row = $sql->fetch(\PDO::FETCH_ASSOC);
          
               if ($row) {
            
                return $row["full_friendly_url"];
            } else {
                return false;
            }
        });
    }

    
    function GiveMeLocation3($location_1, $start_from, $number_of_results_per_page) {
        $main = DBConnection::getInstance()->getMain();
     return   DBQuery::execute(function() use ($main,$location_1, $start_from, $number_of_results_per_page) {
            
            $sql = $main->prepare("SELECT * FROM Location_3 WHERE location_1 = :location 
            		ORDER BY name, id ASC LIMIT $start_from, $number_of_results_per_page");
            $parameters = array(
                ':location' => $location_1
            );
            $sql->execute($parameters);
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                
                $states[] = $row;
                
            }
           
            return $states;
        });
    }

    function GiveMeLocation3Total($location_1) {
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main,$location_1) {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT count(*) as total FROM Location_3 WHERE location_1 = :location");
            $parameters = array(
                ':location' => $location_1
            );
            $sql->execute($parameters);

            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $row['total'];
        });
    }

    function GiveMeLocation4($location_1, $location_3, $start_from, $number_of_results_per_page) {//okk
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main,$location_1,$location_3, $start_from, $number_of_results_per_page) {

            $sql = $main->prepare("SELECT * FROM Location_4 WHERE location_1 = :location_1 AND location_3 = :location_3 
            		ORDER BY name, id ASC LIMIT $start_from, $number_of_results_per_page");

            $parameters = array(
                ':location_1' => $location_1,
                ':location_3' => $location_3
            );
            $sql->execute($parameters);
         
         
            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
             
                $cities[] = $row;
            }
            
            return $cities;
        });
    }

    function GiveMeLocation4Total($location_1, $location_3) {//okk
        $main = DBConnection::getInstance()->getMain();
        return  DBQuery::execute(function() use ($main,$location_1, $location_3) {
            $sql = $main->prepare("SELECT count(*) as total FROM Location_4 WHERE location_1 = :location_1 AND location_3 = :location_3");
            $parameters = array(
                ':location_1' => $location_1,
                ':location_3' => $location_3
            );
            $sql->execute($parameters);

            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $row['total'];
        });
    }

    function Givemepagination() {
        $main = DBConnection::getInstance()->getDomain();
       return DBQuery::execute(function() use ($main) {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT id, title, avg_review, total_review, location_4 , friendly_url from Listing a
					LEFT OUTER JOIN ( select item_id, count(*) 
					AS total_review from Review WHERE is_deleted<>1 AND status = 'A' group by item_id)b on a.id = b.item_id 
					WHERE location_4 = 4 AND title like 'a%' LIMIT 5 ");

            $sql->execute();
            

            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                $paginate[] = $row;
            }
            return $paginate;
        });
    }

    public function getIdFromFriendlyURL($friendly_url) {
        $main = DBConnection::getInstance()->getMain();
       return DBQuery::execute(function() use ($main,$friendly_url) {
            
            $sql = $main->prepare("SELECT id FROM Location_1 WHERE friendly_url = :friendly_url");
            $parameters = array(
                ':friendly_url' => $friendly_url
            );
            $sql->execute($parameters);
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if (!empty($row)) {
                return $row['id'];
            } else {
                return 0;
            }
        });
    }

    public static function getIDFromName($name) {
        $main = DBConnection::getInstance()->getMain();
        return  DBQuery::execute(function() use ($main,$name) {
            $sql = $main->prepare("SELECT id FROM Location_1 WHERE name = :name");
            $parameters = array(
                ':name' => mysql_real_escape_string($name)
            );
            $sql->execute($parameters);
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $row['id'];
        });
    }

    public function getNameFromFriendlyURL($friendly_url) {
        $main = DBConnection::getInstance()->getMain();
       return DBQuery::execute(function() use ($main,$friendly_url) {
            
            $sql = $main->prepare("SELECT name FROM Location_1 WHERE friendly_url = :friendly_url");
            $parameters = array(
                ':friendly_url' => $friendly_url
            );
            $sql->execute($parameters);
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $row['name'];
        });
    }

    public function getNameFromId($id) {
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main,$id) {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT name FROM Location_1 WHERE id = :id");
            $parameters = array(
                ':id' => mysql_real_escape_string($id)
            );
            $sql->execute($parameters);
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['name'];
        });
    }

    public static function getAbbreviationFromId($id) {
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main,$id) {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT abbreviation FROM Location_1 WHERE id = :id");
            $parameters = array(
                ':id' => mysql_real_escape_string($id)
            );
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $row['abbreviation'];
        });
    }

    public static function getIdFromAbbreviation($abb) {
        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main,$abb) {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = $main->prepare("SELECT id FROM Location_1 WHERE abbreviation = :abb");
            $parameters = array(
                ':abb' => $abb
            );
           
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
           
            return $row['id'];
        });
    }

    public static function getPrice($location_1, $duration) {// okk

        $main = DBConnection::getInstance()->getMain();
      return  DBQuery::execute(function() use ($main,$location_1, $duration) {

            if ($duration == "yearly"):
                $sql = $main->prepare("SELECT price_listing as price FROM Location_1 WHERE id = :id");
            else:
                $sql = $main->prepare("SELECT price_listing_monthly as price FROM Location_1 WHERE id = :id");
            endif;
            $parameters = array(
                ':id' => $location_1
            );
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
           
            $price = $row['price'];

            return $price;
        });
    }

}

?>