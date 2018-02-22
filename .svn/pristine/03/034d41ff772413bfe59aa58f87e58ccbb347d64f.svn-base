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
# * FILE: /classes/class_Listing_Category.php
# ----------------------------------------------------------------------------------------------------

class Listing_Category extends Handle {

    var $id;
    var $listing_id;
    var $category_id;
    var $status;
    var $category_root_id;
    var $category_node_left;
    var $category_node_right;

    /*
     * Dont save this field
     */
    var $total_listings;

    function __construct($var='') {
        if (is_numeric($var) && ($var)) {
            $row = $this->loadListing_Category($var);
            $this->makeFromRow($row);
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }
    private function loadListing_Category($var){
        return DBQuery::execute(function() use ($var) {
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing_Category WHERE id = :id");
            $sql->bindParam(':id', $var);
            $sql->execute();
            
            return $sql->fetch(\PDO::FETCH_ASSOC);
        });
    }
    function makeFromRow($row='') {
            if (isset($row['id'])) $this->id = $row['id'];
            else if (!$this->id) $this->id = 0;
            if (isset($row['listing_id'])) $this->listing_id = $row['listing_id'];
            else if (!$this->listing_id) $this->listing_id = 0;
            if (isset($row['category_id'])) $this->category_id = $row['category_id'];
            else if (!$this->category_id) $this->category_id = 0;
            if (isset($row['status'])) $this->status = $row['status'];
            else if (!$this->status) $this->status = "";
            if (isset($row['category_root_id'])) $this->category_root_id = $row['category_root_id'];
            else if (!$this->category_root_id) $this->category_root_id = 0;
            if (isset($row['category_node_left'])) $this->category_node_left = $row['category_node_left'];
            else if (!$this->category_node_left) $this->category_node_left = 0;
            if (isset($row['category_node_right'])) $this->category_node_right = $row['category_node_right'];
            else if (!$this->category_node_right) $this->category_node_right = 0;
    }

    function Save() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            //$insert_password = $this->password;
            
            if ($this->id) { 
                    $sql  = $domain->prepare("UPDATE Listing_Category SET"
                            . " listing_id = :listing_id,"
                            . " category_id = :category_id,"
                            . " status = :status,"
                            . " category_root_id = :category_root_id,"
                            . " category_node_left = :category_node_left,"
                            . " category_node_right = :category_node_right"
                            . " WHERE id = :id");
                    $parameters = array(
                        ":listing_id" => $this->listing_id,
                        ":category_id" => $this->category_id,
                        ":status" => $this->status,
                        ":category_root_id" => $this->category_root_id,
                        ":category_node_left" => $this->category_node_left,
                        ":category_node_right" => $this->category_node_right,
                        ":id" => $this->id
                    );
                    $sql->execute($parameters);
            } else {
                    $sql = $domain->prepare("INSERT INTO Listing_Category"
                            . " (listing_id, category_id, status, category_root_id, category_node_left, category_node_right)"
                            . " VALUES"
                            . " (:listing_id, :category_id, :status, :category_root_id, :category_node_left, :category_node_right)");
                    $parameters = array(
                        ":listing_id" => $this->listing_id, 
                        ":category_id" => $this->category_id, 
                        ":status" => $this->status, 
                        ":category_root_id" => $this->category_root_id, 
                        ":category_node_left" => $this->category_node_left, 
                        ":category_node_right" => $this->category_node_right
                    );
                    $sql->execute($parameters);
                    $this->id = $domain->lastInsertId();
            }
//            $this->prepareToUse();
        });    
        
    }

    function Delete() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("DELETE FROM Listing_Category WHERE id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });
    }
    
    function getListings($category_id){
        return DBQuery::execute(function() use ($category_id){
            $domain = DBConnection::getInstance()->getDomain();
            $category_ids = explode(',', $category_id);
            $no_of_ids = count($category_ids);
            $questionMarks = str_repeat('?,', $no_of_ids - 1).'?';
            
            $sql = $domain->prepare("SELECT DISTINCT listing_id FROM Listing_Category use index (category_status) "
                    . "WHERE category_id IN (".$questionMarks.") AND status = 'A'");
            for($i=0; $i<$no_of_ids; $i++){
                $sql->bindParam($i + 1, $category_ids[$i]);
            }
            $sql->execute();
            /*
             * Total of listings
             */
            $total = 0;
            $string_listings = "";
            $listings = array();
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                    $total++;
//                    $string_listings .= $row["listing_id"].($lines > 0 ? "," : "");
                    $listings[] = $row['listing_id'];
            }
            $this->total_listings = $total;
            $string_listings = implode(',', $listings);
            if($string_listings){
                    return $string_listings;
            }else{
                    return 0;
            }
        });
            
            
    }

    /**
     * @todo some parts may still be broken. looks a bit complex. See old code.
     *          Query transform to PDO works properly but logic seems to be puzzling.
     */
    function getListingsByCategoryHierarchy($root_id, $left, $right, $letter = false){
        return DBQuery::execute(function() use ($root_id, $left, $right, $letter) {
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT Listing_Category.listing_id
                    FROM Listing_Category Listing_Category
                    WHERE Listing_Category.category_root_id = :root_id AND
                        Listing_Category.category_node_left >= :left AND
                        Listing_Category.category_node_right <= :right AND
                        Listing_Category.status = 'A'");
            $sql->bindParam(':root_id', $root_id);
            $sql->bindParam(':left', $left);
            $sql->bindParam(':right', $right);
            $sql->execute();

            /*
             * Total of listings
             */
            $aux_count_listings = 0;
            $aux_listing_id = 0;
            
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                if($row["listing_id"] != $aux_listing_id){
//                    $string_listings .= $row["listing_id"].($lines > 0 ? "," : "");
                    $aux_count_listings++;
                    $aux_listing_id = $row["listing_id"];
                    $listings[] = $row["listing_id"];
                }
            }
            $this->total_listings = $aux_count_listings;
//            $string_listings = implode(',', $listings);
            if( $aux_count_listings > 0 ){
                $questionMarks = str_repeat('?,', $aux_count_listings -1).'?';
            }
//            if (string_substr($string_listings, -1) == ",") {
//                    $string_listings = string_substr($string_listings, 0, -1);
//            }

            if ($letter && isset($questionMarks)) {
                if (!isset($string_listings)) {
                    $string_listings = "0";
                }
                    $sql = $domain->prepare("SELECT id FROM Listing_Summary "
                            . "WHERE id IN ($questionMarks) AND title LIKE ?");
                    for($i=0; $i<$aux_count_listings; $i++){
                        $sql->bindParam($i+1, $listings[$i]);
                    }
                    $sql->bindValue($aux_count_listings+1, $letter."%");
                    $sql->execute();
                    
                    $count = count($sql->fetchAll(\PDO::FETCH_ASSOC));
                    $this->total_listings = $count;
            }

            if (isset($listings)) {
                    return implode(',', $listings);
            } else {
                    return 0;
            }
        });
    }

    function getCategoriesByListingID($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT ListingCategory.title , 
                       Listing_Category.category_id
                FROM Listing_Category Listing_Category
                INNER JOIN ListingCategory ListingCategory on ListingCategory.id = Listing_Category.category_id
                WHERE Listing_Category.listing_id =:listing_id order by ListingCategory.title");
            $sql->bindParam(':listing_id', $listing_id);
            $sql->execute();
            
            $i=0;
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                $categories_array[$i][(API_IN_USE == "api2" ? "category_id" : "id")] = $row["category_id"];
                $categories_array[$i]["name"] = $row["title"];
                $i++;
            }
            if(isset($categories_array)){
                return $categories_array;
            } 
            else{
                return false;
            }
        });
    }


    function checkListingSubCategoryAndAdd($category, $listing_id, $add = false){
        $row = DBQuery::execute(function() use ($category, $listing_id, $add) {
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT * FROM SubCategory where name = :name");
            $sql->bindParam(':name', $category);
            $sql->execute();
            
            return $sql->fetch(\PDO::FETCH_ASSOC);
        });
//        $listing_id = mysql_real_escape_string($listing_id);

        if($add){
            if($row){
                $this->listing_id  			= $listing_id;
                $this->category_id 			= $row['category_id'];
                $this->status      			= "A";
                $this->category_root_id 	= $row['subcategory_id'];
                $this->category_node_left   = $row['category_id'];
                $this->category_node_right  = $row['subcategory_id'];
                $this->save();
            }
        } 
        else {
                return $row;
        }
    }


    function getCatDetailsFromSubcategory2($subcategory){
        return DBQuery::execute(function() use ($subcategory){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare_wherein("SELECT cat.category_id, cat.name cat_name, sub.subcategory_id, sub.name sub_name FROM SubCategory sub 
                LEFT OUTER JOIN Category cat ON sub.category_id = cat.category_id
                WHERE sub.name IN (:sub)",":sub" , $subcategory);
            $subcategories = '';
            foreach ($subcategory as $key => $value) {
                $subcategories .="'".$value."',"; 
                
            }
            $subcategories = "'".implode("','" ,$subcategory)."'";
//            $sql->bindParam(':sub', $subcategories);
            $sql->execute();
           $return =  $sql->fetchAll(\PDO::FETCH_ASSOC);
            
            return $return;
        });
    }
    
        function getCatDetailsFromSubcategory($subcategory){
        return DBQuery::execute(function() use ($subcategory){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT cat.category_id, cat.name cat_name, sub.subcategory_id, sub.name sub_name FROM SubCategory sub 
                LEFT OUTER JOIN Category cat ON sub.category_id = cat.category_id
                WHERE sub.name = :sub LIMIT 1");
            $sql->bindParam(':sub', $subcategory);
            $sql->execute();
            
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        });
    }
    
    
    
     function getAllCategories($cat_name){
        return DBQuery::execute(function() use ($cat_name){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("select a.category_id,a.name,b.name as sub_name ,subcategory_id, concat(a.name, ' , ', b.name) as dispcat from Category a
            inner join SubCategory b on a.category_id = b.category_id
            where concat(a.name, ' -> ', b.name) like :cat_name");
            $cat_name = '%'.$cat_name.'%';
            $sql->bindParam(':cat_name', $cat_name);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        });
    }

}

?>
