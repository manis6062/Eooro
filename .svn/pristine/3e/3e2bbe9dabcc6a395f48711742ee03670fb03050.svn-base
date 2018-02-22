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
# * FILE: /classes/class_ListingCategory.php
# ----------------------------------------------------------------------------------------------------

class ListingCategory extends Handle {

/**
         * @var integer
         * @access Private
         */
        var $id;
/**
         * @var string
         * @access Private
         */
        var $title;
/**
         * @var string
         * @access Private
         */
        var $page_title;
/**
         * @var string
         * @access Private
         */
        var $friendly_url;
/**
         * @var integer
         * @access Private
         */
        var $category_id;
/**
         * @var integer
         * @access Private
         */
        var $image_id;
        /**
         * @var integer
         * @access Private
         */
        var $thumb_id;
/**
         * @var char
         * @access Private
         */
        var $featured;
/**
         * @var string
         * @access Private
         */
        var $summary_description;
/**
         * @var string
         * @access Private
         */
        var $seo_description;
/**
         * @var string
         * @access Private
         */
        var $keywords;
/**
         * @var string
         * @access Private
         */
        var $seo_keywords;
/**
         * @var string
         * @access Private
         */
        var $content;
/**
         * @var integer
         * @access Private
         */
        var $active_listing;
/**
         * @var integer
         * @access Private
         */
        var $left;
/**
         * @var integer
         * @access Private
         */
        var $right;
/**
         * @var integer
         * @access Private
         */
        var $root_id;
/**
         * @var string
         * @access Private
         */
        var $full_friendly_url;
/**
         * @var char
         * @access Private
         */
var $enabled;
/**
         * @var integer
         * @access Private
         */
var $count_sub;

    function __construct($var='') {
        if (is_numeric($var) && ($var)) {
            $row = DBQuery::execute(function() use ($var){
                $domain = DBConnection::getInstance()->getDomain();
                $sql = $domain->prepare("SELECT * FROM ListingCategory WHERE id = $var");
                $sql->bindParam(':id', $var);
                $sql->execute();
                return $sql->fetch();
            });
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

    function makeFromRow($row='') {
        $this->id					= isset($row["id"])					? $row["id"]					: ($this->id				? $this->id             : 0);
        $this->title				= isset($row["title"])				? $row["title"]					: "";
        $this->page_title			= isset($row["page_title"])			? $row["page_title"]			: "";
        $this->friendly_url         = isset($row["friendly_url"])		? $row["friendly_url"]			: "";
        $this->category_id			= isset($row["category_id"])			? $row["category_id"]			: ($this->category_id		? $this->category_id    : 0);
        $this->summary_description  = isset($row["summary_description"]) ? $row["summary_description"]	: "";
        $this->featured				= isset($row["featured"])			? $row["featured"]				: ($this->featured			? $this->featured       : "n");
        $this->seo_description		= isset($row["seo_description"])     ? $row["seo_description"]		: "";
        $this->keywords             = isset($row["keywords"])			? $row["keywords"]				: ($this->keywords			? $this->keywords       : "");
        $this->seo_keywords         = isset($row["seo_keywords"])		? $row["seo_keywords"]			: "";
        $this->content				= isset($row["content"])             ? $row["content"]				: "";
        $this->active_listing		= isset($row["active_listing"])		? $row["active_listing"]		: ($this->active_listing	? $this->active_listing : 0);
        $this->left					= isset($row["left"])				? $row["left"]					: ($this->left				? $this->left			: 1);
        $this->right				= isset($row["right"])				? $row["right"]					: ($this->right				? $this->right			: 2);
        $this->root_id				= isset($row["root_id"])				? $row["root_id"]				: ($this->root_id			? $this->root_id		: 0);
        $this->full_friendly_url	= isset($row["full_friendly_url"])   ? $row["full_friendly_url"]     : "";
        $this->enabled				= isset($row["enabled"])             ? $row["enabled"]				: ($this->enabled			? $this->enabled       : "n");
        $this->count_sub			= isset($row["count_sub"])			? $row["count_sub"]				: ($this->count_sub			? $this->count_sub     : 0);
        if (isset($row["image_id"])) $this->image_id = $row["image_id"];
        else if (!$this->image_id) $this->image_id = 0;
        if (isset($row["thumb_id"])) $this->thumb_id = $row["thumb_id"];
        else if (!$this->thumb_id) $this->thumb_id = 0;

    }

    function Save($update_friendlyurl = true) {
        DBQuery::execute(function() use ($update_friendlyurl){
            $domain = DBConnection::getInstance()->getDomain();
            $this->friendly_url = string_strtolower($this->friendly_url);
            if ($this->id) {
                $sql = $domain->prepare("UPDATE ListingCategory SET"
                    . " title = :title,"
                    . " page_title = :page_title,"
                    . " friendly_url = :friendly_url,"
                    . " category_id = :category_id,"
                    . " image_id = :image_id,"
                    . " thumb_id = :thumb_id,"
                    . " featured = :featured,"
                    . " summary_description = :summary_description,"
                    . " seo_description = :seo_description,"
                    . " keywords = :keywords,"
                    . " seo_keywords = :seo_keywords,"
                    . " content = :content,"
                    . " active_listing = :active_listing,"
                    . " root_id = :root_id,"
                    . " enabled = :enabled"
                    . " WHERE id = :id");
                $parameters = array(
                    ":title" => $this->title,
                    ":page_title" => $this->page_title,
                    ":friendly_url" => $this->friendly_url,
                    ":category_id" => $this->category_id,
                    ":image_id" => $this->image_id,
                    ":thumb_id" => $this->thumb_id,
                    ":featured" => $this->featured,
                    ":summary_description" => $this->summary_description,
                    ":seo_description" => $this->seo_description,
                    ":keywords" => $this->keywords,
                    ":seo_keywords" => $this->seo_keywords,
                    ":content" => $this->content,
                    ":active_listing" => $this->active_listing,
                    ":root_id" => $this->root_id,
                    ":enabled" => $this->enabled,
                    ":id" => $this->id
                );
                $sql->execute($parameters);
            } else {
                $sql = $domain->prepare("INSERT INTO ListingCategory"
                    . " (title,"
                    . " page_title,"
                    . " friendly_url,"
                    . " category_id,"
                    . " image_id,"
                    . " thumb_id,"
                    . " featured,"
                    . " summary_description,"
                    . " seo_description,"
                    . " keywords,"
                    . " seo_keywords,"
                    . " content,"
                    . " enabled,"
                    . " active_listing)"
                    . " VALUES"
                    . " (:title,"
                    . " :page_title,"
                    . " :friendly_url,"
                    . " :category_id,"
                    . " :image_id,"
                    . " :thumb_id,"
                    . " :featured,"
                    . " :summary_description,"
                    . " :seo_description,"
                    . " :keywords,"
                    . " :seo_keywords,"
                    . " :content,"
                    . " :enabled,"
                    . " :active_listing)");
                $parameters = array(
                    ":title" => $this->title,
                    ":page_title" => $this->page_title,
                    ":friendly_url" => $this->friendly_url,
                    ":category_id" => $this->category_id,
                    ":image_id" => $this->image_id,
                    ":thumb_id" => $this->thumb_id,
                    ":featured" => $this->featured,
                    ":summary_description" => $this->summary_description,
                    ":seo_description" => $this->seo_description,
                    ":keywords" => $this->keywords,
                    ":seo_keywords" => $this->seo_keywords,
                    ":content" => $this->content,
                    ":enabled" => $this->enabled,
                    ":active_listing" => $this->active_listing);
                $sql->execute($parameters);
                $this->id = $domain->lastInsertId();
            }	
        });
        
        $this->root_id = $this->findRootCategoryId($this->id);
        $this->rebuildCategoryTree($this->root_id, 1);
        $this->prepareToUse();

        /*
         * Update full path to categories
         */
        if ($update_friendlyurl){
            $this->updateFullFriendlyURL();
        }
        /*
         * Count Sub Categories to APP
         */
        $this->countSubCatToApp();

    }

    /**
    *
    * @see http://articles.sitepoint.com/article/hierarchical-data-database/3
    * @param integer $category_id
    * @param integer $node_left
    * @return integer
    */
    function rebuildCategoryTree($category_id, $node_left) {
        if (($category_id > 0) or ($this->id > 0)) {
            return DBQuery::execute(function() use ($category_id, $node_left){
                $domain = DBConnection::getInstance()->getDomain();
                // initializing variables
                $category_id = ($category_id>0)?$category_id:$this->id;
                $node_left = ($node_left>0)?$node_left:1;
                $root_category_id = $this->findRootCategoryId($category_id);

                // saving / adjusting root id
                $sql = $domain->prepare('UPDATE ListingCategory '
                        . 'SET root_id = :root_id WHERE id=:id');
                $sql->bindParam(':root_id', $root_category_id);
                $sql->bindParam(':id', $category_id);
                $sql->execute();

                // the right value of this node is the left value + 1
                $node_right = $node_left+1;

                // get all children of this node
                $sql = $domain->prepare('SELECT id FROM ListingCategory '
                        . 'WHERE category_id= :category_id');
                $sql->bindParam(':category_id', $category_id);
                $sql->execute();
                //.' and root_category_id='.$root_category_id
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                        // recursive execution of this function for each
                        // child of this node
                        // $node_right is the current right value, which is
                        // incremented by the rebuild_tree function
                        $node_right = $this->rebuildCategoryTree($row['id'], $node_right);
                }

                // we've got the left value, and now that we've processed
                // the children of this node we also know the right value
                $sql = $domain->prepare('UPDATE ListingCategory '
                        . 'SET `left` = :left, `right` = :right, root_id = :root_id '
                        . 'WHERE  id = '.$category_id);
                $sql->bindParam(':left', $node_left);
                $sql->bindParam(':right', $node_right);
                $sql->bindParam(':root_id', $root_category_id);
                $sql->execute();

                $sql = $domain->prepare('UPDATE Listing_Category '
                        . 'SET `category_node_left` = :node_left, `category_node_right` = :node_right, `category_root_id` = :root_id '
                        . 'WHERE `category_id` = '.$category_id);
                $sql->bindParam(':node_left', $node_left);
                $sql->bindParam(':node_right', $node_left);
                $sql->bindParam(':root_id', $root_category_id);
                $sql->execute();

                // return the right value of this node + 1
                return $node_right+1;
            });

        }
    }

    function findRootCategoryId($category_id) {
        return DBQuery::execute(function() use ($category_id){
            $category_id = str_replace("'","",$category_id);
            $domain = DBConnection::getInstance()->getDomain();

            while($category_id != 0) {
                $sql = $domain->prepare("SELECT category_id, id FROM ListingCategory WHERE id = :id");
                $sql->bindParam(':id', $category_id);
                $sql->execute();

                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                $category_id = $row["category_id"];
                $root_category_id = $row["id"];
            }
            return $root_category_id;
        });

    }


    /*
     * Function to get the entire hierarchy of categories
     */
    function getHierarchy($id, $get_parents=false, $get_children=false) {
        return DBQuery::execute(function() use ($id, $get_parents, $get_children){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT listingcategory.id,
                                       listingcategory.root_id,
                                       listingcategory.left,
                                       listingcategory.right,
                                       listingcategory.category_id
                                    FROM ListingCategory listingcategory
                                    WHERE listingcategory.id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();

            if($aux_array = $sql->fetch(\PDO::FETCH_ASSOC)){

                //To keep the old rules
                if (!$get_parents && !$get_children) {
                    if ($aux_array["category_id"] == 0) {
                            $get_parents = false;
                            $get_children = true;
                    }
                    else {
                            $get_parents = true;
                            $get_children = false;
                    }
                }

                if ($get_children) {
                    // Get children
                    $sql_aux = $domain->prepare("SELECT listingcategory.id
                                FROM ListingCategory listingcategory
                                WHERE listingcategory.root_id = :root_id AND
                                              listingcategory.left    > :left AND
                                              listingcategory.right   < :right");
                }
                else if ($get_parents) {
                    // Get Parents
                    $sql_aux = $domain->prepare("SELECT listingcategory.id
                                FROM ListingCategory listingcategory
                                WHERE listingcategory.root_id = :root_id AND
                                              listingcategory.left    < :left AND
                                              listingcategory.right   > :right");
                }
                $sql_aux->bindParam(':root_id', $aux_array["root_id"]);
                $sql_aux->bindParam(':left', $aux_array["left"]);
                $sql_aux->bindParam(':right', $aux_array["right"]);
                $sql_aux->execute();
            //$result_hierarchy = $dbObj->query($sql_aux);
//                $result_hierarchy = $dbObj->unbuffered_query($sql_aux);
            //if(mysql_num_rows($result_hierarchy) > 0){
                
                while($row = $sql_aux->fetch(\PDO::FETCH_ASSOC)){
                    $array_hierarchy[] = $row["id"];
                }
                if (isset($array_hierarchy) && is_array($array_hierarchy)){
                    $string_hierarchy = implode(',',$array_hierarchy);
                }
                
                if(isset($string_hierarchy) && string_strlen($string_hierarchy) > 0){
                        $string_hierarchy .= ','.$id;
                }else{
                        $string_hierarchy = $id;
                }
                return $string_hierarchy;
            }else{
                    return false;
            }
        });
    }


    /*
     * Function to get the highest level of a category
     */
    function getHighestLevel($id) {
        return DBQuery::execute(function() use ($id) {
            $domain = DBConnection::getInstance()->getDomain();
            $ids_children = $this->getHierarchy($id, false, true);
            $max_sublevel = 1;		
            
            if ($ids_children) {
                $ids = explode(',', $ids_children);
                $no_of_ids = count($ids);
                $questionMarks = str_repeat('?,', $no_of_ids -1).'?';
                
                $sql = $domain->prepare("SELECT 
                            COUNT(DISTINCT category_id) as max_sublevel
                            FROM
                            ListingCategory
                            WHERE
                            id IN ($questionMarks) AND
                            id != ?");
                for($i=0; $i<$no_of_ids; $i++){
                    $sql->bindParam($i+1, $ids[$i]);
                }
                $sql->bindParam($no_of_ids + 1, $id);
                $sql->execute();
                
                $row = $sql->fetch();
                $max_sublevel += $row["max_sublevel"];
            }
            return $max_sublevel;
        });			
    }


    function Delete() {

        if ($this->id != 0) {
            DBQuery::execute(function() {
                $domain = DBConnection::getInstance()->getDomain();
                foreach($this->getFullPath() as $cat_path){
                    $cat_id[] = $cat_path["id"];
                }

                $category_ids = $this->getHierarchy($this->id, $get_parents=false, $get_children=true);

                if($category_ids){
                        $sql = "SELECT listing_id FROM Listing_Category WHERE category_id IN (:placeholder)";
                        $stmt = $domain->prepare_wherein($sql, ':placeholder', $category_ids);
                        $stmt->execute();
                        $listings_ids = array();
                        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                                $listings_ids[] = $row["listing_id"];				
                        }

                        $sql_delete = "DELETE FROM Listing_Category WHERE category_id IN (:placeholder)";
                        $stmt = $domain->prepare_wherein($sql_delete, ':placeholder', $category_ids);
                        $stmt->execute();

                        $sql_delete = "DELETE FROM ListingCategory WHERE id IN (:placeholder)";
                        $stmt = $domain->prepare_wherein($sql_delete, ':placeholder', $category_ids);
                        $stmt->execute();
                }				
                $sql = $domain->prepare("UPDATE Banner SET category_id = 0 WHERE category_id = :cat_id AND section = 'listing'");
                $sql->bindParam(':cat_id', $this->id);
                $sql->execute();

                $this->updateFullTextItems($listings_ids);
                system_countActiveListingByCategory("", $cat_id);
            });
                    

            /*
             * Count subcategories to APP
             */
            $this->countSubCatToApp();

            ### IMAGE
            if ($this->image_id) {
                $image = new Image($this->image_id);
                if ($image) $image->Delete();
            }
            if ($this->thumb_id) {
                $image = new Image($this->thumb_id);
                if ($image) $image->Delete();
            }

        }
    }

    function updateImage($imageArray) {
        unset($imageObj);
        if ($this->image_id) {
                $imageobj = new Image($this->image_id);
                if ($imageobj) $imageobj->delete();
        }
        $this->image_id = $imageArray["image_id"];
        unset($imageObj);
        if ($this->thumb_id) {
                $imageObj = new Image($this->thumb_id);
                if ($imageObj) $imageObj->delete();
        }
        $this->thumb_id = $imageArray["thumb_id"];
        unset($imageObj);
    }

    function retrieveAllCategories($featured='') {
        $data = DBQuery::execute(function() use ($featured) {
            $domain = DBConnection::getInstance()->getDomain();
            $sql = "SELECT * FROM ListingCategory WHERE category_id = '0'";
            if ($featured == "on"){
                $sql .= " AND featured = 'y'";
            }
            $sql .= "  AND enabled = 'y' ORDER BY title";
            $stmt = $domain->prepare($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * @todo dont know what to do
     */
    function retrieveAllCategoriesXML($featured="", $category_id=0) {
            $sql = "SELECT * FROM ListingCategory WHERE category_id = '".$category_id."'";

            if ($featured == "on"){
                    $sql .= " AND featured = 'y'";
            }

            $sql .= "  AND enabled = 'y' ORDER BY title LIMIT ".MAX_SHOW_ALL_CATEGORIES;

            return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
    }

    /**
     * @todo dont know what to do
     */
    function getAllCategoriesHierarchyXML($featured="", $category_id=0, $id=0, $domain_id = false) {

        $sql = "SELECT 
            ListingCategory_1.id,
            ListingCategory_1.title,
            ListingCategory_1.page_title,
            ListingCategory_1.friendly_url,
            ListingCategory_1.category_id,
            ListingCategory_1.root_id,
            ListingCategory_1.left,
            ListingCategory_1.active_listing,
            ListingCategory_1.enabled,
            (	SELECT COUNT(ListingCategory_2.id)
                    FROM
                            ListingCategory ListingCategory_2
                    WHERE ListingCategory_2.left < ListingCategory_1.left
                    AND ListingCategory_2.right > ListingCategory_1.right
                    AND ListingCategory_2.root_id = ListingCategory_1.root_id
            ) level,
            (	SELECT
                            COUNT(DISTINCT category_id) as max_sublevel
                    FROM
                            ListingCategory
                    WHERE category_id IN (ListingCategory_1.id)
                    AND id != ListingCategory_1.id
                    AND title <> ''
            AND enabled = 'y'
                ) children
                FROM
                        ListingCategory ListingCategory_1
                WHERE ListingCategory_1.root_id > 0
            ";

        $sql .= " AND ListingCategory_1.category_id = ".$category_id;

        if ($id) {
                $sql .= " AND ListingCategory_1.id IN (".$id.")";
        }
        if ($featured == "on") {
                $sql .= " AND ListingCategory_1.featured = 'y'";
        }
        $sql .= " AND ListingCategory_1.title <> '' AND ListingCategory_1.enabled = 'y'";

        $sql .= " ORDER BY ListingCategory_1.title LIMIT ".MAX_SHOW_ALL_CATEGORIES;

        return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
    }		


    function retrieveAllSubCatById($id='', $featured='') {
        $data = DBQuery::execute(function() use ($id, $featured){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = "SELECT * FROM ListingCategory WHERE category_id = :id";
            if ($featured == "on") {$sql .= " AND featured = 'y'";}
            $sql .= "  AND enabled = 'y' ORDER BY title";
            
            $stmt = $domain->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
        if($data){
            return $data; 
        }
        else{
            return false;
        }
    }

    function getLevel() {
        return DBQuery::execute(function() {
            $domain = DBConnection::getInstance()->getDomain();
            $cat_level = 0;
            $category_id = $this->getString("id");
            while($category_id != 0) {
                    $sql = $domain->prepare("SELECT category_id FROM ListingCategory WHERE id = :id");
                    $sql->bindParam(':id', $category_id);
                    $sql->execute();
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                    $category_id = $row["category_id"];
                    $cat_level++;
            }
            return $cat_level;
        });
            
    }

    function getFullPath() {
        return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $fields = "`id`, `category_id`,  `active_listing`, `featured`, `enabled`, `friendly_url`, `title`";

            $category_id = $this->id;
            $i=0;
            while ($category_id != 0) {
                $sql = $domain->prepare("SELECT $fields FROM ListingCategory WHERE id = :id");
                $sql->bindParam(':id', $category_id);
                $sql->execute();
                //$result = $dbObj->query($sql);
//                    $result = $dbObj->unbuffered_query($sql);
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                $path[$i]["id"] = $row["id"];
                $path[$i]["dad"] = $row["category_id"];
                $path[$i]["title"] = $row["title"];
                $path[$i]["friendly_url"] = $row["friendly_url"];
                $path[$i]["active_listing"] = $row["active_listing"];
                $path[$i]["featured"] = $row["featured"];
                $path[$i]["enabled"] = $row["enabled"];
                $i++;
                $category_id = $row["category_id"];
            }
            if (isset($path) && !empty($path)) {
                    $path = array_reverse($path);
                    for($i=0; $i < count($path); $i++) $path[$i]["level"] = $i+1;
                    return($path);
            } else {
                    return false;
            }
        });
    }

    function updateFullTextItems($listings_ids=false) {

        if (!$listings_ids) {

            if ($this->id) {		
                $category_ids = $this->getHierarchy($this->id, $get_parents=true, $get_children=false);
                $category_ids .= (string_strlen($category_ids) ? "," :"");
                $category_ids .= $this->getHierarchy($this->id, $get_parents=false, $get_children=true);

                if($category_ids){
                    DBQuery::execute(function() use ($category_ids){
                        $domain = DBConnection::getInstance()->getDomain();
                        $sql = "SELECT listing_id FROM Listing_Category WHERE category_id IN (:categories)";
                        $stmt = $domain->prepare_wherein($sql, ':categories', $category_ids);
                        $stmt->execute();

                        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                            if ($row['listing_id']) {
                                $listingObj = new Listing($row['listing_id']);
                                $listingObj->setFullTextSearch();
                                unset($listingObj);
                            }
                        }
                    });
                }
                return true;
            }
            return false;				
        }
        else {
            foreach ($listings_ids as $listing_id) {
                if ($listing_id) {
                    $listingObj = new Listing($listing_id);
                    $listingObj->setFullTextSearch();
                    unset($listingObj);
                }
            }
            return true;
        }
    }

    function setFeatured() {
        if (!$this->id) return false;
        return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE ListingCategory SET featured = 'y' WHERE id = :id");
            $sql->bindParam(':id', $this->id);
            return $sql->execute();    
        });
    }

    /**
     * Function to prepare url of each category
     */
    function updateFullFriendlyURL() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            /*
              * Get correct info of category
              */
             $sql = $domain->prepare("SELECT ListingCategory.root_id,
                                            ListingCategory.left, 
                                            ListingCategory.right 
                            FROM ListingCategory WHERE id = :id");
             $sql->bindParam(':id', $this->root_id);
             $sql->execute();
             if($row_father = $sql->fetch(\PDO::FETCH_ASSOC)){
                /*
                 * Get all children
                 */
                //$row_father = mysql_fetch_assoc($result);
                $sql_children = $domain->prepare("SELECT * FROM ListingCategory
                           WHERE ListingCategory.root_id= :root_id AND
                               ListingCategory.left >= :left AND
                               ListingCategory.right <= :right");
                $sql_children->bindParam(':root_id', $row_father["root_id"]);
                $sql_children->bindParam(':left', $row_father["left"]);
                $sql_children->bindParam(':right', $row_father["right"]);
                $sql_children->execute();

                while($row_children = $sql_children->fetch(\PDO::FETCH_ASSOC)){
                    $cat_aux = new ListingCategory($row_children);
                    $sql = $domain->prepare("SELECT friendly_url
                            FROM ListingCategory
                            WHERE root_id = :root_id AND
                                    ListingCategory.left <= :left AND
                                    ListingCategory.right >= :right
                            ORDER BY root_id,
                                    ListingCategory.left,
                                    ListingCategory.right");
                    $sql->bindParam(':root_id', $cat_aux->root_id);
                    $sql->bindParam(':left', $cat_aux->left);
                    $sql->bindParam(':right', $cat_aux->right);
                    $sql->execute();


                    $aux_friendly_url = "";
                    while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                        if($row["friendly_url"]){
                            $aux_friendly_url  .= $row["friendly_url"]. "/";
                        }
                    }
                    $aux_friendly_url = rtrim($aux_friendly_url, '/');
                    /*
                     * Save full friendly_url
                     */
                    $sql_update = $domain->prepare("UPDATE ListingCategory "
                            . "SET full_friendly_url = :friendly_url "
                            . "WHERE id = :id");
                    $sql_update->bindParam(':friendly_url', $aux_friendly_url);
                    $sql_update->bindParam(':id', $cat_aux->id);
                    $sql_update->execute();
                } 	
            }
        });

    }
    
    /**
     * @todo this function recurses so its hard to debug.
     *          I've tested once, but might need more attention.
     */
    function countActiveListingByCategory ($category_id = "", $domain_id = false) {
        return DBQuery::execute(function() use ($category_id, $domain_id){
            $domain = DBConnection::getInstance()->getDomain();
            $category_id = ($category_id != "")? $category_id: $this->id;
            $active_listings = 0;

            // counting listings of this category
            $sql_counter = $domain->prepare("SELECT count(distinct a.id) counter
                             FROM Listing a
                                INNER JOIN Listing_Category b on (a.id = b.listing_id)
                                INNER JOIN ListingCategory c on (b.category_id = c.id)
                             WHERE (a.status = 'A') 
                               AND c.`left` >= (select cl.`left` from ListingCategory cl where cl.id = :left)
                               AND c.`right` <= (select cr.`right` from ListingCategory cr where cr.id = :right)
                               AND c.root_id = (select root.root_id from ListingCategory root where root.id = :root)");
            $sql_counter->bindParam(':left', $category_id);
            $sql_counter->bindParam(':right', $category_id);
            $sql_counter->bindParam(':root', $category_id);
            $sql_counter->execute();
            $row_counter = $sql_counter->fetch(\PDO::FETCH_ASSOC);
            $active_listings = $row_counter["counter"];

            // counting listings of all subcategories (not only the immediatelly below this)
            $sql_sub = $domain->prepare("SELECT id FROM ListingCategory WHERE category_id = :cat_id");
            $sql_sub->bindParam(':cat_id', $category_id);
            $sql_sub->execute();

            while ($row_sub = $sql_sub->fetch(\PDO::FETCH_ASSOC)) {
                    $this->countActiveListingByCategory($row_sub["id"]);
            }

            $sql_update = $domain->prepare("UPDATE ListingCategory SET active_listing = :active WHERE id = :id");
            $sql_update->bindParam(':active', $active_listings);
            $sql_update->bindParam(':id', $category_id);
            $sql_update->execute();

            if ($this->id == $category_id) {
                $this->active_listing = $active_listings;
            }

            return $active_listings;
        });    

    }

    /*
     * Function to number of subcategories to App
     */
    function countSubCatToApp() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT id FROM ListingCategory WHERE category_id = :id");
            if ($this->category_id == 0) {
//                $sql = "SELECT id FROM ListingCategory WHERE category_id = ".$this->id;
                $aux_id = $this->id;
            } elseif ($this->id) {
//                $sql = "SELECT id FROM ListingCategory WHERE category_id = ".$this->category_id;
                $aux_id = $this->category_id;
            }
            $sql->bindParam(':id', $aux_id);
            
            $sql->execute();
            $total = count($sql->fetchAll(\PDO::FETCH_ASSOC));

            $update_sql = $domain->prepare("UPDATE ListingCategory SET count_sub = :sub WHERE id = :id");
            $update_sql->bindParam(':sub', $total);
            $update_sql->bindParam(':id', $aux_id);
            $result_update = $update_sql->execute();
        });
        
    }

    /**
     * Function to prepare content to App
     * @return array
     */
    function GetInfoToApp($array_get, &$aux_returnArray ,&$aux_fields ,&$items, &$auxTable, &$aux_Where) {

        extract($array_get);

        $auxTable = "ListingCategory";

        /**
        * Fields to Listing
        */
        // Label = value (field on DB);
        $aux_fields[(API_IN_USE == "api2" ? "category_id" : "id")] = "id";
        $aux_fields[(API_IN_USE == "api2" ? "name" : "title")] = "title";
        $aux_fields[(API_IN_USE == "api2" ? "active_listings" : "active_items")] = "active_listing";
        $aux_fields["father_id"]        = "category_id";
        $aux_fields["total_sub"]        = "count_sub";
        $aux_fields["image"]            = "image_id";

        $aux_Where[] = "enabled = 'y'";

        if ($father_id && is_numeric($father_id)) {
            $aux_Where[] = "category_id =".$father_id;
        } else {
            $aux_Where[] = "category_id = 0";
        }
    }

    function getImagePath() {
        if (is_numeric($this->image_id)) {
            $imageObj = new Image($this->image_id);
            if ($imageObj->imageExists()) {
                return $imageObj->getPath();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function getObjectByFullFriendlyURL($full_friendlyURL) {
        return DBQuery::execute(function() use ($full_friendlyURL){
             /**
            * Preparing to select
            */
           if (string_substr($full_friendlyURL, 0, 1) == "/") {
               $full_friendlyURL = string_substr($full_friendlyURL, 1);
           }

           if (string_substr($full_friendlyURL, -1) == "/") {
               $full_friendlyURL = string_substr($full_friendlyURL, 0,  string_strlen($full_friendlyURL)-1);
           }
           $domain = DBConnection::getInstance()->getDomain();
           $sql = $domain->prepare("SELECT id, title FROM ListingCategory "
                   . "WHERE full_friendly_url = :friendly_url LIMIT 1");
           $sql->bindParam(':friendly_url', $full_friendlyURL);
           if ($sql->execute()) {
               $row = $sql->fetch(\PDO::FETCH_ASSOC);
               return $row["id"];    
           } else {
               return false;
           }
        });
    }

    function getListingsByCategoryID() {
        return DBQuery::execute(function() {
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT distinct listing_id FROM Listing_Category "
                    . " WHERE category_root_id =:cat_root_id AND category_node_left >= :left "
                    . " AND category_node_right <= :right AND status = 'A'");
            $sql->bindParam(':cat_root_id', $this->root_id);
            $sql->bindParam(':left', $this->left);
            $sql->bindParam(':right', $this->right);
            
            if($sql->execute()){
                while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                    $listingIds[] = $row["listing_id"];
                }
                return implode(',', $listingIds);
            }
        });
    }

     function getIDByCategoryTitle($title) {
         return DBQuery::execute(function() use ($title){
            $domain = DBConnection::getInstance()->getDomain(); 
            $sql = $domain->prepare("SELECT id FROM ListingCategory where title = :title");
            $sql->bindParam(':title', $title);
            $sql->execute();

            
                $id = $sql->fetch(\PDO::FETCH_ASSOC);	
                $id = $id['id'];
            

            return $id;
         });

    }

    function getCategoryTitleByID($id) {
        return DBQuery::execute(function() use ($id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT title FROM ListingCategory where id = :id");
            $sql->bindParam(':id', $id);

            if($sql->execute()){
                $title = $sql->fetch(\PDO::FETCH_ASSOC);	
                $title = $title['title'];
            }

           return $title;
        });
        
    }

}

?>