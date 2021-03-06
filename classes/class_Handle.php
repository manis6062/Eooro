<?php

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
	# * FILE: /classes/class_handle.php
	# ----------------------------------------------------------------------------------------------------

	class Handle {

		function Handle() {}

		function getString($field, $special_chars=true, $length = 0, $extraChar = "...", $ent_quotes = true) {
			$value = $this->$field;
			if (!is_string($value)) return $value;
			$value = ($length > 0) ? system_showTruncatedText($value, $length, $extraChar, true) : $value;
			$value = ($special_chars) ? ($ent_quotes ? htmlspecialchars($value, ENT_NOQUOTES) : htmlspecialchars($value)) : $value ;
			return $value;
		}

		function getNumber($field, $special_chars=false) {
			$value = $this->$field;
			if (!is_string($value)) return $value;
			$value = ($special_chars) ? htmlspecialchars($value) : $value ;
			return $value;
		}

		function getDate($field) {
			$aux = explode("-", $this->$field);
			if (count($aux) == 3) {
				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					return $aux[1]."/".$aux[2]."/".$aux[0];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					return $aux[2]."/".$aux[1]."/".$aux[0];
				}
			} else {
				return "00/00/0000";
			}
		}

		function getBoolean($field) {
			if ($this->$field) return true;
			else return false;
		}

		function setString($field, $string) {
			$this->$field = $string;
		}

		function setNumber($field, $number) {
			if (is_numeric($number)) $this->$field = $number;
			else $this->$field = 0;
		}

		function setBoolean($field, $bool) {
			if ($bool) $this->$field = 1;
			else $this->$field = 0;
		}

		function setDate($field, $date) {

			if (string_strpos($date, "/")) {

				$aux = explode("/", $date);

				if (count($aux) == 3) {

					if (DEFAULT_DATE_FORMAT == "m/d/Y") {
						$month = $aux[0];
						$day = $aux[1];
						$year = $aux[2];
					} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
						$month = $aux[1];
						$day = $aux[0];
						$year = $aux[2];
					}

					if (checkdate((int)$month, (int)$day, (int)$year)) {
						$this->$field = $year."-".$month."-".$day;
					} else {
						$this->$field = "0000-00-00";
					}

				} else {
					$this->$field = "0000-00-00";
				}

			} else if (string_strpos($date, "-")) {

				$aux = explode("-", $date);

				if (count($aux) == 3) {

					if (checkdate((int)$aux[1], (int)$aux[2], (int)$aux[0])) {
						$this->$field = $date;
					} else {
						$this->$field = "0000-00-00";
					}

				} else {
					$this->$field = "0000-00-00";
				}

			} else {
				$this->$field = "0000-00-00";
			}

		}

		function prepareToSave() {

			## backslashes manage and other stuff manage
			$vars = get_object_vars($this);

			// regular expression to match date
			$regexp_date = "/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/";

			for ($i=0; $i<count($vars); $i++) {
				$key = each($vars);
				if ($key['value'] == "NULL") {
					$this->setString($key['key'], "{$key["value"]}");
				} elseif (is_string($key['value'])) {
					if (preg_match($regexp_date, $key["value"])) {
						$this->setDate($key["key"], $key["value"]);
						$this->setString($key["key"], "'".$this->$key["key"]."'");
					} else {
						//CR 50319
//						if ($this->string_needs_addslashes($key["value"]) || !get_magic_quotes_gpc()){
//							$key["value"] = addslashes($key["value"]);
//						}
						if ((string_strpos($key["value"],"\'") !== false) || (string_strpos($key["value"],"\\") !== false) || (string_strpos($key["value"],"\\\"") !== false) || !get_magic_quotes_gpc()){
							
							$key["value"] =stripcslashes($key["value"]);
						}
						$key["value"]  = addslashes($key["value"]);
						$this->setString($key["key"], "'".$key["value"]."'");
					}
				} elseif (is_numeric($key["value"])) {
					$this->setNumber($key["key"], $key["value"]);
				} else {
					$this->setString($key["key"], "'".$key["value"]."'");
				}
			}

		}

		function prepareToUse() {
			$vars = get_object_vars($this);
			for ($i=0; $i < count($vars); $i++) {
				$key = each($vars);
				if ($key["value"] == "''") $this->setString($key["key"], "");
				else if (!is_numeric($key["value"])) $this->setString($key["key"], string_substr($key["value"], 1, string_strlen($key["value"])-2));
				$this->setString($key["key"], stripslashes($this->getString($key["key"], false)));
			}
		}

		function string_needs_addslashes($str) {
			if (($qp = string_strpos($str,"'")) !== false || ($qp = string_strpos($str,"\"")) !== false) {
				if ($str[$qp-1] != "\\") return true;
				else return $this->string_needs_addslashes(string_substr($str,$qp+1,string_strlen($str)));
			}
			return false;
		}

		function extract() {

			// regular expression to match date
			$regexp_date = "/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/";

			// regular expression to match decimal.
			$regexp_decimal = "/^([0-9]{1,}).([0-9]{2,2})$/";

			// getting the variables for this class
			$vars = get_object_vars($this);

			for ($i=0; $i < count($vars); $i++) {

				$key = each($vars);

				global $$key["key"];
				
				if (count($key["value"]) > 1) {
					$value = $key["value"];
				} else if ($key["value"] && preg_match($regexp_date, $key["value"])){
					$value = $this->getDate("{$key["key"]}");
					if ($value == "00/00/0000") unset($value);
				} elseif ($key["value"] && preg_match($regexp_decimal, $key["value"])) {
					$value = $key["value"];
				} else {
					$value = $key["value"];
				}

				$$key["key"] = (isset($value) && (!is_array($value)) && !is_object($value)) ? htmlspecialchars($value) : $value;

			}

		}        
        
        /**
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @name getFriendlyURL
		 * @access Public
		 * @param boolean $mobile
		 */
		function getFriendlyURL($mobile = false, $module_url = false, $field = "friendly_url", $show_html = "on") {
            
            if ($mobile) {
                
                $getMobileLabel = true;
                include(EDIRECTORY_ROOT."/conf/mobile.inc.php");
                
                $detailURL = str_replace(DEFAULT_URL."/", DEFAULT_URL."/".EDIRECTORY_MOBILE_LABEL."/", $module_url);
                
        		return $detailURL."/".$this->$field;
        	} else {
        		return ($module_url ? $module_url."/" : "").$this->$field;
        	}
        }
        
        /**
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @name getPopularCategories
		 * @access Public
		 * @param boolean $mobile
		 */
        function getPopularCategories($limit, $table = "ListingCategory", $field = "active_listing") {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            
            switch ($table) {
                case 'ListingCategory': $module = "listing"; break;
                case 'ClassifiedCategory': $module = "classified"; break;
                case 'EventCategory': $module = "event"; break;
                case 'ArticleCategory': $module = "article"; break;
                case 'BlogCategory': $module = "blog"; break;
            }
            
            unset($featuredcategory);
            if (FEATURED_CATEGORY == "on") {
                setting_get($module."_featuredcategory", $featuredcategory);
            }
            
            $sql = "SELECT id, title, $field as active_item ".($table == "ListingCategory" ? ", full_friendly_url" : ", friendly_url AS full_friendly_url" )." FROM $table WHERE $field > 0 AND category_id = 0 ".($featuredcategory ? "AND featured = 'y'" : "")." AND enabled = 'y' ORDER BY $field DESC, title LIMIT ".$limit;
            $result = $db->query($sql);
            
            if (mysql_num_rows($result)) {
                unset($auxPopularCategories);
                $i = 0;
                while ($row = mysql_fetch_assoc($result)) {
                    $auxPopularCategories[$i]["id"]                 = $row["id"];
                    $auxPopularCategories[$i]["active_item"]        = $row["active_item"];
                    $auxPopularCategories[$i]["title"]              = $row["title"];
                    $auxPopularCategories[$i]["full_friendly_url"]  = $row["full_friendly_url"];
                    $i++;
                }
                return $auxPopularCategories;
            } else {
                return false;
            }
        }
        
        protected function getDb( $domain_id = false )
        {
            if ( !isset($db) ) {
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                if ($domain_id){
                    $db = db_getDBObjectByDomainID($domain_id, $dbMain);
                }else if (defined("SELECTED_DOMAIN_ID")) {
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $db = db_getDBObject();
                }
                unset($dbMain);
            }

            return $db;
        }
    }

?>