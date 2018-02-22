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
	# * FILE: /classes/class_LocationFeatured.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$locationFeatObj = new LocationFeatured($domain_id, $location_level, $location_id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name LocationFeatured
	 * @method LocationFeatured
	 * @method makeFromRow
	 * @method setFeatured
	 * @method deleteFeatured
	 * @method getFeatureds
	 * @access Public
	 */
	class LocationFeatured extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_level;
		/**
		 * @var integer
		 * @access Private
		 */
		var $location_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $is_featured;

		/**
		 * <code>
		 *		$locationFeatObj = new LocationFeatured();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Account
		 * @access Public
		 * @param integer $domain_id SELECTED_DOMAIN_ID
		 * @param integer $location_level 0
		 * @param integer $location_id 0$parameters = array('');
		 */
		function LocationFeatured($domain_id = SELECTED_DOMAIN_ID, $location_level = 0, $location_id = 0) { 
           $main = DBConnection::getInstance()->getMain();
           DBQuery::execute(function() use ($main,$domain_id,$location_level,$location_id) {
			if (is_numeric($domain_id) && ($domain_id) && is_numeric($location_level) && ($location_level) && is_numeric($location_id) && ($location_id)) {
				$sql = $main->prepare("SELECT `domain_id`, `location_level`, `location_id` FROM `Location_Featured` WHERE `domain_id` = :domain_id AND `location_level` = :location_level AND `location_id` = :location_id");
                $parameters = array(
                    ':domain_id' =>$domain_id,
                    ':location_level'=>$location_level,
                    ':location_id'=>$location_id
                );
                $sql->execute($parameters);
                $res = $sql->rowCount();
                                
				if ($res>0) {
					$this->is_featured = true;
					$row = $sql->fetch(\PDO::FETCH_ASSOC);
                                        
					$this->makeFromRow($row);
				} else {
					$this->is_featured = false;
                    if (!is_array($var)) {
                        $var = array();
				}
                    $this->makeFromRow($var);
				}
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
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row ''
		 */
		function makeFromRow($row='') {
			$this->domain_id		= ($row["domain_id"]		? $row["domain_id"]:		0);
			$this->location_level	= ($row["location_level"]	? $row["location_level"]:	0);
			$this->location_id		= ($row["location_id"]		? $row["location_id"]:		0);
		}
		
		/**
		 * <code>
		 *		$this->checkFeatured($domain_id, $location_level, $location_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name checkFeatured
		 * @access Public
		 * @param integer $domain_id SELECTED_DOMAIN_ID
		 * @param integer $location_level 0
		 * @param integer $location_id 0
		 * @return boolean
		 */
		function checkFeatured($domain_id, $location_level, $location_id){
		$main = DBConnection::getInstance()->getMain();
                    DBQuery::execute(function() use ($main,$domain_id,$location_level,$location_id) {	
			$sql = $main->prepare("SELECT `domain_id`, `location_level`, `location_id` FROM `Location_Featured` WHERE `domain_id` = :domain_id AND `location_level` = :location_level AND `location_id` = :location_id");
            $parameters = array(
                        ':domain_id' =>$domain_id,
                        ':location_level'=>$location_level,
                        ':location_id'=>$location_id
                    );
            $sql->execute($parameters);
            $rows = $sql->rowCount();
                        
			if ($rows) {
				return true;
			} else {
				return false;
			}
                    });
		}

		/**
		 * <code>
		 *		$locationFeatObj->setFeatured();
		 *		//Or
		 *		$locationFeatObj->setFeatured(SELECTED_DOMAIN_ID, $location_level, $location_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setFeatured
		 * @access Public
		 * @param integer $domain_id SELECTED_DOMAIN_ID
		 * @param integer $location_level 0
		 * @param integer $location_id 0
		 */
		function setFeatured ($domain_id = SELECTED_DOMAIN_ID, $location_level = 0, $location_id = 0) {
		$main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main,$domain_id,$location_level,$location_id) {	
            $this->is_featured = false;
			if (!$this->is_featured) {
				if (is_numeric($this->domain_id) && ($this->domain_id) && is_numeric($this->location_level) && ($this->location_level) && is_numeric($this->location_id) && ($this->location_id)) {
					// it will not enter into this condition coz there are not defined $this->domain_id, $this->location_level, $this->location_id
					if (!$this->checkFeatured($this->domain_id, $this->location_level, $this->location_id)){
						$this->prepareToSave();
						$sql = $main->prepare("INSERT INTO `Location_Featured` VALUES (:domain_id, :location_level, :location_id)");
						$parameters = array(
                                            ':domain_id' =>$this->domain_id,
                                            ':location_level'=>$this->location_level,
                                            ':location_id'=>$this->location_id
                                        );
                        $sql->execute($parameters);
						$this->prepareToUse(); 
					} 
					
				} else if (is_numeric($domain_id) && ($domain_id) && is_numeric($location_level) && ($location_level) && is_numeric($location_id) && ($location_id)) {
				
                                    $this->domain_id		= $domain_id;
					$this->location_level	= $location_level;
					$this->location_id		= $location_id;
					
					if (!$this->checkFeatured($this->domain_id, $this->location_level, $this->location_id)){
						$this->prepareToSave();
						$sql = $main->prepare("INSERT INTO `Location_Featured` VALUES (:domain_id, :location_level, :location_id)");
		                $parameters = array(
		                    ':domain_id' =>$this->domain_id,
		                    ':location_level'=>$this->location_level,
		                    ':location_id'=>$this->location_id
		                );
		                $sql->execute($parameters);
						$this->prepareToUse();
					}
				}
			}
    		});
		}

		/**
		 * <code>
		 *		$locationFeatObj->deleteFeatured();
		 *		//Or
		 *		$locationFeatObj->deleteFeatured(SELECTED_DOMAIN_ID, $location_level, $location_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name deleteFeatured
		 * @access Public
		 * @param integer $domain_id SELECTED_DOMAIN_ID
		 * @param integer $location_level 0
		 * @param integer $location_id 0
		 */
		function deleteFeatured ($domain_id = SELECTED_DOMAIN_ID, $location_level = 0, $location_id = 0) { 
		$main = DBConnection::getInstance()->getMain();
                    DBQuery::execute(function() use ($main,$domain_id,$location_level,$location_id) {		
                    if (is_numeric($this->domain_id) && ($this->domain_id) && is_numeric($this->location_level) && ($this->location_level) && is_numeric($this->location_id) && ($this->location_id)) {
                        
				$this->prepareToSave();
				$sql = $main->prepare("DELETE FROM `Location_Featured` WHERE `domain_id` = :domain_id AND `location_level` = :location_level AND `location_id` = :location_id");
                $parameters = array(
                    ':domain_id' =>$this->domain_id,
                    ':location_level'=>$this->location_level,
                    ':location_id'=>$this->location_id
                );
                $sql->execute($parameters);
				$this->prepareToUse();
				$this->domain_id		= 0;
				$this->location_level	= 0;
				$this->location_id		= 0;
			} else if (is_numeric($domain_id) && ($domain_id) && is_numeric($location_level) && ($location_level) && is_numeric($location_id) && ($location_id)) {
                            
				$sql = $main->prepare("DELETE FROM `Location_Featured` WHERE `domain_id` = :domain_id AND `location_level` = :location_level AND `location_id` = :location_id");
                $parameters = array(
                    ':domain_id' =>$domain_id,
                    ':location_level'=>$location_level,
                    ':location_id'=>$location_id
                );
                $sql->execute($parameters);
			}
			if (CACHE_PARTIAL_FEATURE == "on"){
				cachepartial_removecache("sidebar_location_listing");
				
				if (EVENT_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_event");
				}
				
				if (CLASSIFIED_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_classified");
				}
				
				if (PROMOTION_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_promotion");
				}
			}
          });
		}

		/**
		 * <code>
		 *		$locationFeatObj->getFeatureds(SELECTED_DOMAIN_ID, $location_level);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getFeatureds
		 * @access Public
		 * @param integer $domain_id SELECTED_DOMAIN_ID
		 * @param integer $location_level 0
		 * @param string $return_type "string"
		 * @return mixed $return
		 */
                
               	function getFeatureds ($domain_id = SELECTED_DOMAIN_ID, $location_level = 0, $return_type = "string") {
		$main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main,$domain_id,$location_level,$location_id) {		
                    unset($return);
			if (is_numeric($domain_id) && ($domain_id) && is_numeric($location_level) && ($location_level)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = $main->prepare("SELECT `location_id` FROM `Location_Featured` WHERE `domain_id` = :domain_id AND `location_level` = :location_level");
                $parameters = array(
                    ':domain_id' =>$domain_id,
                    ':location_level'=>$location_level,
                   
                );
                $sql->execute($parameters);
                $res = $sql->rowCount();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                                
				if ($res > 0) {
					while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
						switch ($return_type) {
							case "array":
								$return[] = $row["location_id"];
								break;
							case "object":
								$locObj = ${"Location$location_level"};
								$return[] = $locObj($row["location_id"]);
								break;
							default:
								$_aux[] = $row["location_id"];
								break;
						}
					}
					if ($return_type == "string") {
						$return = implode(",", $_aux);
					}
				} else {
					$return = 0;
				}
			} else {
				$return = 0;
			}

    			return $return;
        	});
		}
	}
?>