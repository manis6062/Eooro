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
# * FILE: /classes/class_ListingLevel.php
# ----------------------------------------------------------------------------------------------------

class ListingLevel {

    ##################################################
    # PRIVATE
    ##################################################

    var $default;
    var $value;
    var $name;
    var $detail;
    var $images;
    var $has_promotion;
    var $has_review;
    var $has_sms;
    var $has_call;
    var $backlink;
    var $price;
    var $free_category;
    var $category_price;
    var $content;
    var $active;
    var $popular;

    /**
     * Contains y or n if user can reply to review or not
     * @modification
     * @var string
     */    
    var $reply_review;
    var $open_case;

    function __construct($listAll = false, $domain_id = false) {

            if (!defined("ALL_LISTINGLEVEL_INFORMATION") || !defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
                $stmt = DBQuery::execute(function(){
                    $domain = DBConnection::getInstance()->getDomain();
                    $sql = $domain->prepare("SELECT * FROM ListingLevel WHERE theme = :theme ORDER BY value DESC");
                    $sql->bindValue(':theme', EDIR_THEME ? EDIR_THEME : "default");
                    $sql->execute();
                    
                    return $sql;
                });
                
                unset($listingLevelAux);
                unset($listingLevelAuxAll);
                $i = 0;
                $j = 0;
                
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    foreach ($row as $key => $value) {
                        if ($row["active"] == "y"){
                            if ($key == "defaultlevel" && $value == "y") $listingLevelAuxAll[$j]["default"] = $row["value"];
                            $listingLevelAuxAll[$j][$key] = $value;

                        } 
                        if ($key == "defaultlevel" && $value == "y") $listingLevelAux[$i]["default"] = $row["value"];
                        $listingLevelAux[$i][$key] = $value; 
                    }
                    $i++;
                    $j++;
                }
            }

            if (isset($listingLevelAux) && is_array($listingLevelAux)) {
                if (!defined("ALL_LISTINGLEVEL_INFORMATION")) {
                    define("ALL_LISTINGLEVEL_INFORMATION", serialize($listingLevelAux));
                }
            }

            if (isset($listingLevelAuxAll) && is_array($listingLevelAuxAll)) {
                if (!defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
                    define("ACTIVE_LISTINGLEVEL_INFORMATION", serialize($listingLevelAuxAll));
                }
            }

            if ($listAll) {
                $listingLevelAux = unserialize(ALL_LISTINGLEVEL_INFORMATION);
            } else {
                $listingLevelAux = unserialize(ACTIVE_LISTINGLEVEL_INFORMATION);
            }

            if (is_array($listingLevelAux)) {
                foreach ($listingLevelAux as $listingLevel) {
                    if ($listingLevel["defaultlevel"] == "y") $this->default = $listingLevel["value"];
                    $this->value[] = $listingLevel["value"];
                    $this->name[] = $listingLevel["name"];
                    $this->detail[] = $listingLevel["detail"];
                    $this->images[] = $listingLevel["images"];
                    $this->has_promotion[] = $listingLevel["has_promotion"];
                    $this->has_review[] = $listingLevel["has_review"];
                    $this->has_sms[] = $listingLevel["has_sms"];
                    $this->has_call[] = $listingLevel["has_call"];
                    $this->backlink[] = $listingLevel["backlink"];
                    $this->price[] = $listingLevel["price"];
                    $this->free_category[] = $listingLevel["free_category"];
                    $this->category_price[] = $listingLevel["category_price"];
                    $this->content[] = $listingLevel["content"];
                    $this->active[] = $listingLevel["active"];
                    $this->popular[] = $listingLevel["popular"];

                    /**
                     * modification
                     */
                    $this->reply_review[] = $listingLevel['reply_review'];
                    $this->open_case[]  = $listingLevel['open_case'];
                }
            }
    }

    function getValues() {
        return $this->value;
    }

    function getNames() {
        return $this->name;
    }

    function union($key, $value) {
        for ($i=0; $i<count($key); $i++) {
                $aux[$key[$i]] = $value[$i];
        }
        return $aux;
    }

    function getValueName() {
            return $this->union($this->getValues(), $this->getNames());
    }

    function getDefault() {
        $activeArray =  array_filter($this->union($this->value, $this->active), 'validateActive');
        if(array_key_exists($this->default, $activeArray)) {
            return $this->default;
        } else {
            krsort($activeArray);
            $newActiveArray = array_keys($activeArray);
            return $newActiveArray[0];
        }
    }

    function getName($value) {
            if (is_numeric($value)){
                    $value_name = $this->getValueName();
                    return $value_name[$value];
            }
    }

    ##################################################
    # PRIVATE
    ##################################################

    ##################################################
    # PUBLIC
    ##################################################

    function getLevel($value) {
            if ($this->getName($value)) return $this->getName($value);
            else return $this->getLevel($this->getDefaultLevel());
    }

    function getDetail($value) {
            $detailArray = $this->union($this->value, $this->detail);
            if (isset($detailArray[$value])) return $detailArray[$value];
            else return $detailArray[$this->default];
    }

    function getBacklink($value) {
            $backlinkArray = $this->union($this->value, $this->backlink);
            if (isset($backlinkArray[$value])) return $backlinkArray[$value];
            else return $backlinkArray[$this->default];
    }

    function getImages($value) {
            $imagesArray = $this->union($this->value, $this->images);
            if (isset($imagesArray[$value])) return $imagesArray[$value];
            else return $imagesArray[$this->default];
    }

    function getHasPromotion($value) {
            $haspromotionArray = $this->union($this->value, $this->has_promotion);
            if (isset($haspromotionArray[$value])) return $haspromotionArray[$value];
            else return $haspromotionArray[$this->default];
    }

    function getHasReview($value) {
            $hasreviewArray = $this->union($this->value, $this->has_review);
            if (isset($hasreviewArray[$value])) return $hasreviewArray[$value];
            else return $hasreviewArray[$this->default];
    }

    function getHasSms($value) {
            $hassmsArray = $this->union($this->value, $this->has_sms);
            if (isset($hassmsArray[$value])) return $hassmsArray[$value];
            else return $hassmsArray[$this->default];
    }

    function getHasCall($value) {
            $hascallArray = $this->union($this->value, $this->has_call);
            if (isset($hascallArray[$value])) return $hascallArray[$value];
            else return $hascallArray[$this->default];
    }

    function getPrice($value) {
            $priceArray = $this->union($this->value, $this->price);
            if (isset($priceArray[$value])) return $priceArray[$value];
            else return $priceArray[$this->default];
    }

    function getFreeCategory($value) {
            $freeCategoryArray = $this->union($this->value, $this->free_category);
            if (isset($freeCategoryArray[$value])) return $freeCategoryArray[$value];
            else return $freeCategoryArray[$this->default];
    }

    function getCategoryPrice($value) {
            $categoryPriceArray = $this->union($this->value, $this->category_price);
            if (isset($categoryPriceArray[$value])) return $categoryPriceArray[$value];
            else return $categoryPriceArray[$this->default];
    }

    function getContent($value) {

            $contentArray = $this->union($this->value, $this->content);
            if (isset($contentArray[$value])) return $contentArray[$value];
            else return $contentArray[$this->default];

    }

    /**
     * modification
     */
    function getReplyReview($value)
    {
        $replyReviewArray = $this->union( $this->value, $this->reply_review );
        if ( isset($replyReviewArray[$value]) ) {
            return $replyReviewArray[$value];
        }
        else{
            return $replyReviewArray[$this->default];
        }
    }

    function getOpenCase($value)
    {
        $openCaseArray = $this->union( $this->value, $this->open_case );
        if ( isset($openCaseArray[$value]) ) {
            return $openCaseArray[$value];
        }
        else{
            return $openCaseArray[$this->default];
        }
    }

    function getDefaultLevel() {
            return $this->getDefault();
    }

    function getLevelValues() {
            return $this->getValues();
    }

    function getLevelNames() {
            return $this->getNames();
    }

    function showLevel($value) {            
        if ($this->getName($value)) return string_ucwords($this->getName($value));
        else return string_ucwords($this->getLevel($this->getDefaultLevel()));
    }

    function showLevelNames() {
            $names = $this->getNames();
            foreach ($names as $name) {
                    $array[] = string_ucwords($name);
            }
            return $array;
    }

    function getActive($value) {
        $activeArray = $this->union($this->value, $this->active);
        return $activeArray[$value];
    }

    function getLevelActive($value) {
        if ($this->getActive($value) == 'y') return $value;
        else return $this->getDefaultLevel();
    }

    function getPopular($value) {
        $popularArray = $this->union($this->value, $this->popular);
        return $popularArray[$value];
    }

    function getLevelOrdering($value) {
        switch ( $value ) {
            case 10:
                return system_showText(LANG_SITEMGR_FIRST);
                break;
            case 30:
                return system_showText(LANG_SITEMGR_SECOND);
                break;
            case 50:
                return system_showText(LANG_SITEMGR_THIRD);
                break;
            case 70:
                return system_showText(LANG_SITEMGR_FOURTH);
                break;
        }
    }

    function convertTableToArray(){
        $array_fields = get_object_vars($this);

        unset($level_values);
        for($i=0;$i<count($array_fields["value"]);$i++){
                $level_values[] = $array_fields["value"][$i];

        }

        if(count($level_values) && is_array($array_fields)){
            $aux_new_array_fields = array();
            foreach($array_fields as $key => $value){
                if(is_array($value)){
                    for($i=0;$i<count($level_values);$i++){
                        $aux_new_array_fields[$key][$level_values[$i]] = $value[$i];
                    }
                }

            }

            return $aux_new_array_fields;
        }
        else{
            return false;
        }

    }

    // modification
    function updateValues($name = "", $active = "", $has_promotion = "", $has_review = "", $has_sms = "", $has_call = "", $backlink = "", $detail = "", $images = "", $levelValue, $type = "names", $popular = "", $replyReview = "", $openCase = "" ){
        DBQuery::execute(function() use ($name, $active, $has_promotion, $has_review, $has_sms, $has_call, $backlink, $detail, $images, $levelValue, $type, $popular, $replyReview, $openCase){
            $domain = DBConnection::getInstance()->getDomain();
            $reply_review = !empty($replyReview) ? $replyReview : "";
            $open_case = !empty($openCase) ? $openCase : "";
            if ($type == "names") {
                $sql = $domain->prepare("UPDATE ListingLevel "
                        . "SET name = :name, active = :active, popular = :popular "
                        . "WHERE value = :levelValue AND theme = :theme");
                $sql->bindParam(':name', $name);
                $sql->bindParam(':active', $active);
                $sql->bindParam(':popular', $popular);
                $sql->bindParam(':levelValue', $levelValue);
                $sql->bindValue(':theme', (EDIR_THEME ? EDIR_THEME : "default"));
                $sql->execute();
            } elseif ($type == "fields") {
                $sql = $domain->prepare("UPDATE ListingLevel "
                        . "SET detail = :detail, has_promotion = :has_promotion, "
                        . "has_review = :has_review, has_sms = :has_sms, "
                        . "has_call = :has_call, backlink = :backlink, "
                        . "images = :images, reply_review = :reply_review, open_case = :open_case "
                        . "WHERE value = :value AND theme = :theme");
                $sql->execute(array(
                    ':detail' => $detail,
                    ':has_promotion' => $has_promotion,
                    ':has_review' => $has_review,
                    ':has_sms' => $has_sms,
                    ':has_call' => $has_call,
                    ':backlink' => $backlink,
                    ':images' => $images,
                    ':reply_review' => $reply_review,
                    ':open_case' => $open_case,
                    ':value' => $levelValue,
                    ':theme' => (EDIR_THEME ? EDIR_THEME : "default")
                ));
            }
        });

    }

    function updatePricing($field, $fieldValue, $level){
        DBQuery::execute(function () use ($field, $fieldValue, $level) {
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE ListingLevel "
                    . "SET $field = :field "
                    . "WHERE value = :value AND theme = :theme");
            $sql->bindParam(':field', $fieldValue);
            $sql->bindParam(':value', $level);
            $sql->bindValue(':theme', (EDIR_THEME ? EDIR_THEME : "default"));
            $sql->execute();
        });
    }


            ##################################################
            # PUBLIC
            ##################################################

    public static function getPriceDuration($duration){
        return DBQuery::execute(function() use ($duration){
            $domain = DBConnection::getInstance()->getDomain();
            if($duration == "yearly"){
                $sql 	= "SELECT price FROM ListingLevel "
                        . "WHERE value = 10 and theme = 'review'";
            }
            else{
                $sql 	= "SELECT price_listing_monthly as price FROM ListingLevel "
                        . "WHERE value=10 and`theme`='review'";
            }
            $stmt = $domain->prepare($sql);
            $stmt->execute();
            $row    = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row['price'];

        });    
    }


}
	
	

?>