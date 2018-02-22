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
# * FILE: /classes/class_Location4.php
# ----------------------------------------------------------------------------------------------------

class Location4 extends Handle {

    var $id;
    var $location_3;
    var $location_2;
    var $location_1;
    var $name;
    var $abbreviation;
    var $friendly_url;
    var $seo_description;
    var $seo_keywords;

    function Location4($var = '') {
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function () use($var, $main) {
            if (is_numeric($var) && ($var)) {
                $sql = $main->prepare("SELECT * FROM Location_4 WHERE id = :var");
                $sql->bindParam(':var', $var);
                $sql->execute();
                $row = $sql->FETCH(\PDO::FETCH_ASSOC);

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

        if ($row['location_3'])
            $this->location_3 = $row['location_3'];
        else if (!$this->location_3)
            $this->location_3 = 0;

        if ($row['location_2'])
            $this->location_2 = $row['location_2'];
        else if (!$this->location_2)
            $this->location_2 = 0;

        if ($row['location_1'])
            $this->location_1 = $row['location_1'];
        else if (!$this->location_1)
            $this->location_1 = 0;

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
        $this->friendly_url = string_strtolower($this->friendly_url);
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main, $updFullText) {

            if ($this->id) {
               
                system_logLocationChanges($this->id, 4, $this->location_1, 1);
                system_logLocationChanges($this->id, 4, $this->location_2, 2);
                system_logLocationChanges($this->id, 4, $this->location_3, 3);
                $sql = $main->prepare("UPDATE Location_4 SET"
                        . " location_1 = :location_1,"
                        . " location_2= :location_2,"
                        . " location_3 = :location_3,"
                        . " name = :name,"
                        . " abbreviation = :abbreviation,"
                        . " friendly_url = :friendly_url,"
                        . " seo_description = :seo_description,"
                        . " seo_keywords = :seo_keywords "
                        . " WHERE id = :id");
                $parameters = array(
                    ':location_1' => $this->location_1,
                    ':location_2' => $this->location_2,
                    ':location_3' => $this->location_3,
                    ':name' => $this->name,
                    ':abbreviation' => $this->abbreviation,
                    ':friendly_url' => $this->friendly_url,
                    ':seo_description' => $this->seo_description,
                    ":seo_keywords" => $this->seo_keywords,
                    ':id' => $this->id
                );
                $sql->execute($parameters);
                
            } else {
                echo 'insert';
                $sql = $main->prepare("INSERT INTO Location_4"
                        . " (location_1, "
                        . " location_2, "
                        . " location_3, "
                        . " name, "
                        . " abbreviation, "
                        . " friendly_url, "
                        . "seo_description, "
                        . "seo_keywords )"
                        . " VALUES"
                        . " ("
                        . ":location_1,"
                        . ":location_2,"
                        . ":location_3,"
                        . ":name,"
                        . ":abbreviation, "
                        . ":friendly_url, "
                        . ":seo_description, "
                        . ":seo_keywords)"
                );
                $parameters = array(
                    ":location_1" => $this->location_1,
                    ":location_2" => $this->location_2,
                    ":location_3" => $this->location_3,
                    ":name" => $this->name,
                    ":abbreviation" => $this->abbreviation,
                    ":friendly_url" => $this->friendly_url,
                    ":seo_description" => $this->seo_description,
                    ":seo_keywords" => $this->seo_keywords
                );
                $sql->execute($parameters);
                $this->id = $main->lastInsertId();
                
            }
        });
        $this->prepareToUse();
    }

    	function Delete($updFullText = false) {
        $main = DBConnection::getInstance()->getMain();
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($main, $updFullText, $domain) {
            if ($this->id) {

                $sqlDomain = $main->prepare("SELECT `id` FROM `Domain` WHERE `status` = :status");

                $parameters = array(':status' => 'A');
                $sqlDomain->execute($parameters);
                
                while ($row = $sqlDomain->fetch(\PDO::FETCH_ASSOC)) { 
                    //Listing
                    $sql = $domain->prepare("UPDATE Listing SET   location_4 = :location_4, location_5 = :location_5 WHERE location_4 = :con");
                    $parameters = array(
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id
                    );
                   
                    $sql->execute($parameters);
                    //Promotion
                    $sql = $domain->prepare("UPDATE Promotion SET    
                                                    listing_location4 = :listing_location4, 
                                                    listing_location5 = :listing_location5 
                            WHERE listing_location4 = :con");
                    $parameters = array(
                        ':listing_location4' => 0,
                        ':listing_location5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                    //Listing_Summary
                    $sql = $domain->prepare("UPDATE Listing_Summary SET 
                                                        location_4 = 0,
                                                        location_4_title = '',
                                                        location_4_abbreviation = '',
                                                        location_4_friendly_url = '',
                                                        location_5 = 0,
                                                        location_5_title = '',
                                                        location_5_abbreviation = '',
                                                        location_5_friendly_url = ''
							WHERE location_4 = :location_4");
                    $parameters = array(
                        ':location_4' => $this->id
                    );
                    $sql->execute($parameters);
                    //Event
                    $sql = $domain->prepare("UPDATE Event SET  location_4 = :location_4, location_5 = :location_5 WHERE location_4 = :con");
                    $parameters = array(
                        
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                    //Classified
                    
                    $sql = $domain->prepare("UPDATE Classified SET  location_4 = :location_4, location_5 = :location_5 WHERE location_4 = :con");
                    $parameters = array(
                        ':location_4' => 0,
                        ':location_5' => 0,
                        ':con' => $this->id,
                    );
                    $sql->execute($parameters);
                }
                unset($rowDomain);
                $_locations = explode(",", EDIR_LOCATIONS);
                system_retrieveLocationRelationship($_locations, 4, $_location_father_level, $_location_child_level);
                
                if ($_location_child_level) { 
                    $sql = $main->prepare("SELECT id FROM Location_" . $_location_child_level . " WHERE location_4=:location_4");
                    $parameters = array(
                        ':location_4' => $this->id
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
                $sql = $main->prepare("DELETE FROM Location_4 WHERE id = :id");
                $parameters = array(
                    ':id' => $this->id
                );
                    $sql->execute($parameters);
            }
        });
    }

    function updateFullTextItemsLoc($listings_ids = false) {
        $main = DBConnection::getInstance()->getDomain();
        return DBQuery::execute(function() use($listings, $main) {
                    if (!$listings_ids) {
                        if ($this->id) {
                            $sql = $main->prepare("SELECT id FROM Listing WHERE Location_4 = :id");
                            $sql->bindParam(':id', $this->id);
                            $sql->execute();
                            
                            while ($row = $sql->FETCH(\PDO::FETCH_ASSOC)) {
                                if ($row['id']) {
                                    $listingObj = new Listing($row['id']);
                                    $listingObj->setFullTextSearch(true, 4);
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
                                $listingObj->setFullTextSearch(true, 4);
                                unset($listingObj);
                            }
                        }
                        return true;
                    }
                });
    }
    
    
    function retrieveFeatureds($_locations, $default = false, $last_default_level = false, $last_default_id = false) { //okk //pending
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $_locations, $default, $last_default_level, $last_default_id) {
            $locationFeatObj = new LocationFeatured();
            $sql = "";

            $searchReturn["select"] = false;
            $searchReturn["leftjoin"] = false;
            $searchReturn["on"] = false;
            $searchReturn["orderby"] = false;

            foreach ($_locations as $each_location) {

                if ($each_location == 4) {
                    $searchReturn["select"][] = "Location_4.* ";
                    $searchReturn["orderby"][] = "Location_4.name ";
                } else {
                    if ($each_location < 4) {
                        $searchReturn["select"][] = "Location_" . $each_location . ".friendly_url AS location" . $each_location . "_friendly_url ";
                        $searchReturn["leftjoin"][] = "Location_" . $each_location . " ";
                        $searchReturn["on"][] = "Location_4.location_" . $each_location . "=Location_" . $each_location . ".id ";
                        if ($_locations == $_locations[0])
                            $searchReturn["orderby"][] = "Location_4.location_" . $each_location . " ";
                    }
                }
            }
            $sql .= "SELECT ";
            $sql .= implode(" , ", $searchReturn["select"]);
            $sql .= " FROM Location_4 ";
            if ($searchReturn["leftjoin"]) {
                $sql .= " LEFT JOIN ( ";
                $sql .= implode(" , ", $searchReturn["leftjoin"]);
                $sql .= " ) ON ( ";
                $sql .= implode(" AND ", $searchReturn["on"]);
                $sql .= " ) WHERE";
            }

            $domain_id = $locationFeatObj->getFeatureds(SELECTED_DOMAIN_ID, 4);
            
            if ($last_default_id)
                $sql .= " Location_4.location_" . $last_default_level . " = " . $last_default_id . " AND ";
            
            $sql .= " Location_4." . ($default == false ? "id IN (:domain_id)" : "id = $default");

            $sql .= " GROUP BY Location_4.id ";
            $sql .= " ORDER BY ";
            $sql .= implode(" , ", $searchReturn["orderby"]);
           
            $sql = $main->prepare_wherein($sql, ':domain_id', $domain_id);
            if ($default != false) {
                $sql->bindParam(':id', $default);
            }
            $sql->execute();
            
            $rows = array();
            while ($row = $sql->fetch(\PDO::FETCH_BOTH))
                $rows[] = $row;
           
            return $rows;
        });
    }

  
                
    function isRepeated($father_level, &$error_message) {
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $father_level, &$error_message) {
            $sql = "SELECT * FROM Location_4 WHERE name = :name";
            if ($father_level !== false) {
                $father_level_value = "location_" . $father_level;
                if ($this->$father_level_value) {
                    $father_level_value = $this->$father_level_value;
                    $sql .= " AND location_" . $father_level . " = :father_location";
                    $parameters[':father_location'] = $father_level_value;
                }
            }
            if ($this->id) {
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
    
    
    function retrievedIfRepeated($_locations) { //fetch single row
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $_locations) {
            $sql = "SELECT * FROM Location_4 WHERE (friendly_url = :friendly_url OR name = :name) ";

            foreach ($_locations as $key=>$each_location) {
                if ($each_location < 4) {
                    $attribute = "location_" . $each_location;

                    $sql.= " AND location_" . $each_location . " = :location$key";

                    $parameters[":location$key"] = $this->$attribute;
                }
            }


            if ($this->id) {
                $sql .= " AND id != :id";
                $parameters[':id'] = $this->id;
            }
            
            $sql = $main->prepare($sql);
            $parameters[':friendly_url'] = $this->friendly_url;
            $parameters[':name'] = $this->name;
           
            $sql->execute($parameters);
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            if ($row["id"]) {
                return $row["id"];
            } else {
                return false;
            }
        });
    }

//    function changeDefault() {//field Location_4.default not found on database so not changed.
//        $sql = "UPDATE Location_4 SET Location_4.default='n' WHERE Location_4.default='y'";
//        $db = db_getDBObject(DEFAULT_DB, true);
//        $db->query($sql);
//        $this->Save();
//    }


    
    function retrieveAllLocation($ids = false, $fields = "*") {//ok but array 
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function()use($main, $ids, $fields) {
                    $sql = "SELECT $fields FROM Location_4 " . (is_array($ids) ? "WHERE id IN (:location_ids)" : "") . " ORDER BY name";
                    $location_ids = implode(",", $ids);
                    $sql = $main->prepare_wherein($sql, ':location_ids', $location_ids);

                    $sql->execute();
                    while ($row = $sql->FETCH(\PDO::FETCH_ASSOC))
                        $data[] = $row;
                    
                    if ($data)
                        return $data;
                    else
                        return false;
                });
    }
    
    function retrieveAllLocationByLocation1($location1, $location3) {//ok 
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use($location1, $location3, $main) {
                    $sql = $main->prepare("SELECT * FROM Location_4 WHERE location_1 = :location1 AND location_3 = :location3 ORDER BY name");
                    $sql->bindParam(':location1', $location1);
                    $sql->bindParam(':location3', $location3);
                    $sql->execute();
                    while ($row = $sql->FETCH(\PDO::FETCH_ASSOC))
                        $data[] = $row;
                    
                    if ($data)
                        return $data;
                    else
                        return false;
                });
    }
           
    function retrieveLocationById() {//okk
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use($main) {
                    if ($this->id):
                        $sql = $main->prepare("SELECT * FROM Location_4 WHERE id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();
                        $row = $sql->FETCH(\PDO::FETCH_ASSOC);
                        //echo '<pre>';print_r($row);
                        if ($row)
                            return $row;
                        else
                            return false;
                    else:
                        return null;
                    endif;
                });
    }

    function retrieveLocationByLocation($father_level, $allLocations = false, $ids = false) { //pending
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $father_level, $allLocations, $ids) {
            $father_level_value = "location_" . $father_level;
            $father_level_value = $this->$father_level_value;
            if (!$father_level_value)
                return false;

            if ($allLocations) {

                /**
                 * Get locations on domain per module
                 */
                $locations_id = LocationCounter::getLocationIDByLocationLevel(4);


                if (is_array($locations_id)) {
                    $location_ids = implode(",", $locations_id);
                    $sql = "SELECT * FROM Location_4 WHERE location_" . $father_level . " = :father_level_value AND id IN (:location_ids) ORDER BY name";
                    $parameters = array(
                        ':father_level_value'=>$father_level_value
                    );
                    $sql = $main->prepare_wherein($sql, ':location_ids', $location_ids,$parameters);
                    
                } else {
                    return false;
                }
            } else {
                if (is_array($ids)) {
                    $ids_location = implode(",", $ids);
                }
                $sql = "SELECT * FROM Location_4 WHERE location_" . $father_level . " = :father_level_value" . (is_array($ids) ? " AND id IN (:ids_location)" : "") . " ORDER BY name";
                $parameters = array(
                        ':father_level_value'=>$father_level_value
                    );
                if (is_array($ids)) {
                    
                    $sql = $main->prepare_wherein($sql, ':ids_location', $ids_location,$parameters);
                    $sql->execute();
                    
                } else {
                    $sql = $main->prepare($sql);
                    $sql->execute($parameters);
                }
            }

            
            $rows = $sql->rowCount();
            if ($rows > 0) {
                unset($data);
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                if ($data) {
                    return $data;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        });
    }

    function isValidFriendlyUrl($father_level, &$error_message) {
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $father_level, &$error_message) {
            if (!$this->getString("friendly_url")) {
                $error_message = "&#149;&nbsp; Friendly Title is required, please do not leave it blank.";
                return false;
            }
            $sql = "SELECT friendly_url FROM Location_4 WHERE friendly_url = :friendly_url";
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
            $rows = $sql->rowCount();
            
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

//    function updateFullTextItems() {//this function not changed to PDO Because location_4_id fiels isn't find in table
//        //2016-june-16 tuesday by kushal khadka.
//        if ($this->id) {
//
//            $dbObj = db_getDBObject(DEFAULT_DB, true);
//
//            //Listing
//            if (LISTING_SCALABILITY_OPTIMIZATION != 'on') {
//                $sql = "SELECT * FROM Listing WHERE location_4_id = $this->id";
//                $result = $dbObj->query($sql);
//                while ($row = mysql_fetch_array($result)) {
//                    $itemObj = new Listing($row['id']);
//                    $itemObj->setFullTextSearch();
//                    unset($itemObj);
//                }
//            }
//
//            //Event
//            if (EVENT_FEATURE == 'on' && EVENT_SCALABILITY_OPTIMIZATION != 'on') {
//                $sql = "SELECT * FROM Event WHERE location_4_id = $this->id";
//                $result = $dbObj->query($sql);
//                while ($row = mysql_fetch_array($result)) {
//                    $itemObj = new Event($row['id']);
//                    $itemObj->setFullTextSearch();
//                    unset($itemObj);
//                }
//            }
//
//            //Classified
//            if (CLASSIFIED_FEATURE == 'on' && CLASSIFIED_SCALABILITY_OPTIMIZATION != 'on') {
//                $sql = "SELECT * FROM Classified WHERE location_4_id = $this->id";
//                $result = $dbObj->query($sql);
//                while ($row = mysql_fetch_array($result)) {
//                    $itemObj = new Classified($row['id']);
//                    $itemObj->setFullTextSearch();
//                    unset($itemObj);
//                }
//            }
//
//            return true;
//        }
//
//        return false;
//    }
            
    function getFullFriendlyURL() { 
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use($main) {
            /**
             * Get Locations levels enabled
             */
            $locationsLevel = system_retrieveLocationsToShow("array");
            unset($sqlAux);
            for ($i = 0; $i < count($locationsLevel); $i++) {
                if (($locationsLevel[$i] > 1) && ($locationsLevel[$i] < 4)) {
                    $sqlAux .= "IF (location_" . $locationsLevel[$i] . " > 0, concat((SELECT friendly_url FROM Location_" . $locationsLevel[$i] . " WHERE id = :location_level_id), '/'), ''),";
                    $parameters[':location_level_id'] = "Location_4.location_" . $locationsLevel[$i];
                }
            }
            $sql = $main->prepare("SELECT concat((SELECT friendly_url FROM Location_1 WHERE id = Location_4.location_1),'/'," . $sqlAux . "
                                    friendly_url) AS full_friendly_url 
                                 FROM Location_4 WHERE id = :location4_id");
            $parameters[":location4_id"] = $this->id;
            $sql->execute($parameters);
            $rows = $sql->rowCount();           

            if ($rows>0) {
                 $row = $sql->fetch(\PDO::FETCH_ASSOC);
                return $row["full_friendly_url"];
            } else {
                return false;
            }
        });
    }

    public function getIdFromFriendlyURL($friendly_url_from_location3, $friendly_url_from_location4) {//okk
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use($friendly_url_from_location3, $friendly_url_from_location4, $main) {
                    $sql = $main->prepare("SELECT a.id from Location_4 a 
                                                    inner join Location_3 b on a.location_3 = b.id 
                                                    WHERE a.friendly_url = :friendly_url_from_location4 and b.friendly_url =:friendly_url_from_location3");
                    $sql->bindParam(':friendly_url_from_location4', $friendly_url_from_location4);
                    $sql->bindParam(':friendly_url_from_location3', $friendly_url_from_location3);
                    $sql->execute();
                   
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                    
                    return $row['id'];
                });
    }

    public function getNameFromFriendlyURL($friendly_url) {
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use($main, $friendly_url) {
            $sql = $main->prepare("SELECT name FROM Location_4 WHERE friendly_url = :friendly_url");
            $sql->bindParam(':friendly_url', $friendly_url);
            $sql->execute();
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
        });
    }

    public static function getName($id) {
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function()use($id, $main) {
            $sql = $main->prepare("SELECT name FROM Location_4 WHERE id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['name'];
        });
    }

}

?>
