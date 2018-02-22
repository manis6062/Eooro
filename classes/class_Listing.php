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
	# * FILE: /classes/class_listing.php
	# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$listingObj = new Listing($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name Listing
 * @method Listing
 * @method makeFromRow
 * @method Save
 * @method Delete
 * @method updateImage
 * @method getCategories
 * @method setCategories
 * @method updateCategoryStatusByID
 * @method retrieveListingsbyPromotion_id
 * @method getPrice
 * @method hasRenewalDate
 * @method needToCheckOut
 * @method getNextRenewalDate
 * @method setLocationManager
 * @method getLocationManager
 * @method getLocationString
 * @method setFullTextSearch
 * @method getGalleries
 * @method setGalleries
 * @method setMapTuning
 * @method setNumberViews
 * @method setAvgReview
 * @method hasDetail
 * @method deletePerAccount
 * @method SaveToFeaturedTemp
 * @method removePromotionID
 * @method getListingByFriendlyURL
 * @method getListingToApp
 * @method GetInfoToApp
 * @access Public
 */
class Listing extends Handle {

        /**
         * @var integer
         * @access Private
         */
        var $id;
        /**
         * @var integer
         * @access Private
         */
        var $account_id;
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
         * @var integer
         * @access Private
         */
        var $promotion_id;
        /**
         * @var integer
         * @access Private
         */
        var $location_1;
        /**
         * @var integer
         * @access Private
         */
        var $location_2;
        /**
         * @var integer
         * @access Private
         */
        var $location_3;
        /**
         * @var integer
         * @access Private
         */
        var $location_4;
        /**
         * @var integer
         * @access Private
         */
        var $location_5;
        /**
         * @var date
         * @access Private
         */
        var $renewal_date;
        /**
         * @var integer
         * @access Private
         */
        var $discount_id;
        /**
         * @var integer
         * @access Private
         */
        var $reminder;
        /**
         * @var date
         * @access Private
         */
        var $updated;
        /**
         * @var date
         * @access Private
         */
        var $entered;
        /**
         * @var varchar
         * @access Private
         */
        var $title;
        /**
         * @var varchar
         * @access Private
         */
        var $seo_title;
        /**
         * @var char
         * @access Private
         */
        var $claim_disable;
        /**
         * @var varchar
         * @access Private
         */
        var $friendly_url;
        /**
         * @var varchar
         * @access Private
         */
        var $email;
        /**
         * @var varchar
         * @access Private
         */
        var $url;
        /**
         * @var varchar
         * @access Private
         */
        var $display_url;
        /**
         * @var varchar
         * @access Private
         */
        var $address;
        /**
         * @var varchar
         * @access Private
         */
        var $address2;
        /**
         * @var varchar
         * @access Private
         */
        var $zip_code;
/**
         * @var varchar
         * @access Private
         */
        var $zip5;
        /**
         * @var varchar
         * @access Private
         */
        var $phone;
        /**
         * @var varchar
         * @access Private
         */
        var $fax;
        /**
         * @var varchar
         * @access Private
         */
        var $description;
        /**
         * @var varchar
         * @access Private
         */
        var $seo_description;
        /**
         * @var varchar
         * @access Private
         */
        var $long_description;
        /**
         * @var varchar
         * @access Private
         */
        var $video_snippet;
/**
         * @var varchar
         * @access Private
         */
        var $video_description;
        /**
         * @var varchar
         * @access Private
         */
        var $keywords;
        /**
         * @var varchar
         * @access Private
         */
        var $seo_keywords;
        /**
         * @var varchar
         * @access Private
         */
        var $attachment_file;
        /**
         * @var varchar
         * @access Private
         */
        var $attachment_caption;
/**
         * @var varchar
         * @access Private
         */
        var $features;
/**
         * @var integer
         * @access Private
         */
        var $price;
/**
         * @var varchar
         * @access Private
         */
        var $facebook_page;
        /**
         * @var char
         * @access Private
         */
        var $status;
/**
         * @var char
         * @access Private
         */
        var $suspended_sitemgr;
        /**
         * @var integer
         * @access Private
         */
        var $level;
        /**
         * @var varchar
         * @access Private
         */
        var $locations;
        /**
         * @var varchar
         * @access Private
         */
        var $hours_work;
        /**
         * @var integer
         * @access Private
         */
        var $listingtemplate_id;
/**
         * @var varchar
         * @access Private
         */
        var $custom_text0;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text1;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text2;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text3;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text4;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text5;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text6;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text7;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text8;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_text9;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc0;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc1;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc2;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc3;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc4;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc5;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc6;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc7;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc8;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_short_desc9;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc0;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc1;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc2;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc3;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc4;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc5;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc6;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc7;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc8;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_long_desc9;
/**
         * @var char
         * @access Private
         */
        var $custom_checkbox0;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox1;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox2;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox3;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox4;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox5;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox6;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox7;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox8;
        /**
         * @var char
         * @access Private
         */
        var $custom_checkbox9;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown0;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown1;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown2;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown3;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown4;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown5;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown6;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown7;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown8;
        /**
         * @var varchar
         * @access Private
         */
        var $custom_dropdown9;
        /**
         * @var integer
         * @access Private
         */
        var $number_views;
        /**
         * @var integer
         * @access Private
         */
        var $avg_review;
        
         var $review_count;
    /*
     * @var real
     * @access Private
     */
    var $latitude;
    /*
     * @var real
     * @access Private
     */
    var $longitude;
        /**
         * @var integer
         * @access Private
         */
        var $map_zoom;

        /**
         * @var mixed
         * @access Private
         */
        var $locationManager;

        /**
         * @var array
         * @access Private
         */
        var $data_in_array;
        /**
         * @var integer
         * @access Private
         */
        var $domain_id;
        /**
         * @var integer
         * @access Private
         */
        var $package_id;
        /**
         * @var integer
         * @access Private
         */
        var $package_price;
        /**
         * @var char
         * @access Private
         */
        var $backlink;
/**
         * @var string
         * @access Private
         */
        var $backlink_url;
        /**
         * @var integer
         * @access Private
         */
        var $clicktocall_number;
        /**
         * @var integer
         * @access Private
         */
        var $clicktocall_extension;
        /**
         * @var date
         * @access Private
         */
        var $clicktocall_date;

    /**
     * <code>
     *		$listingObj = new Listing($id);
     *		//OR
     *		$listingObj = new Listing($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Listing
     * @access Public
     * @param mixed $var
     */
    function __construct($var='', $domain_id = false) {

        if (is_numeric($var) && ($var)) {
            
                
            $row = $this->loadListing($var);
            $this->old_account_id = $row["account_id"];
            $this->makeFromRow($row);
            
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }

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
     * @param array $row
     */
    function makeFromRow($row='') {

            $status = new \ItemStatus();
            $level = new ListingLevel();

            $this->id					= isset($row["id"])					? $row["id"]					: ($this->id				? $this->id					: 0);
            $this->account_id			= isset($row["account_id"])			? $row["account_id"]			: 0;
            $this->image_id				= isset($row["image_id"])			? $row["image_id"]				: ($this->image_id			? $this->image_id			: 0);
            $this->thumb_id				= isset($row["thumb_id"])			? $row["thumb_id"]				: ($this->thumb_id			? $this->thumb_id			: 0);
            $this->promotion_id			= isset($row["promotion_id"])		? $row["promotion_id"]			: ($this->promotion_id		? $this->promotion_id		: 0);
            $this->location_1			= isset($row["location_1"])			? $row["location_1"]			: 0;
            $this->location_2			= isset($row["location_2"])			? $row["location_2"]			: 0;
            $this->location_3			= isset($row["location_3"])			? $row["location_3"]			: 0;
            $this->location_4			= isset($row["location_4"])			? $row["location_4"]			: 0;
            $this->location_5			= isset($row["location_5"])			? $row["location_5"]			: 0;
            $this->renewal_date			= isset($row["renewal_date"])		? $row["renewal_date"]			: ($this->renewal_date		? $this->renewal_date		: 0);
            $this->discount_id			= isset($row["discount_id"])			? $row["discount_id"]			: "";
            $this->reminder				= isset($row["reminder"])			? $row["reminder"]				: ($this->reminder			? $this->reminder			: 0);
            $this->entered				= isset($row["entered"])				? $row["entered"]				: ($this->entered			? $this->entered			: "");
            $this->updated				= isset($row["updated"])				? $row["updated"]				: ($this->updated			? $this->updated			: "");
            $this->title				= isset($row["title"])				? $row["title"]					: ($this->title				? $this->title				: "");
            $this->seo_title			= isset($row["seo_title"])			? $row["seo_title"]				: ($this->seo_title			? $this->seo_title			: "");
            $this->claim_disable		= isset($row["claim_disable"])		? $row["claim_disable"]			: "n";
            $this->friendly_url			= isset($row["friendly_url"])		? $row["friendly_url"]			: "";
            $this->email				= isset($row["email"])				? $row["email"]					: "";
            $this->url					= isset($row["url"])					? $row["url"]					: "";
            $this->display_url			= isset($row["display_url"])			? $row["display_url"]			: "";
            $this->address				= isset($row["address"])				? $row["address"]				: "";
            $this->address2				= isset($row["address2"])			? $row["address2"]				: "";
            $this->zip_code				= isset($row["zip_code"])			? $row["zip_code"]				: "";
            $this->zip5                 = isset($row["zip5"])                ? $row["zip5"]                  : "";
            $this->phone				= isset($row["phone"])				? $row["phone"]					: "";
            $this->fax					= isset($row["fax"])					? $row["fax"]					: "";
            $this->description			= isset($row["description"])         ? $row["description"]			: "";
            $this->seo_description		= isset($row["seo_description"])     ? $row["seo_description"]		: ($this->seo_description	? $this->seo_description	: "");
            $this->long_description     = isset($row["long_description"])	? $row["long_description"]		: "";
            $this->video_snippet		= isset($row["video_snippet"])		? $row["video_snippet"]			: "";
            $this->video_description	= isset($row["video_description"])	? $row["video_description"]		: "";
            $this->keywords             = isset($row["keywords"])			? $row["keywords"]				: "";
            $this->seo_keywords         = isset($row["seo_keywords"])		? $row["seo_keywords"]			: ($this->seo_keywords		? $this->seo_keywords		: "");
            $this->attachment_file		= isset($row["attachment_file"])		? $row["attachment_file"]		: ($this->attachment_file	? $this->attachment_file	: "");
            $this->attachment_caption	= isset($row["attachment_caption"])	? $row["attachment_caption"]	: "";
            $this->features             = isset($row["features"])            ? $row["features"]              : "";
            $this->price                = isset($row["price"])               ? $row["price"]                 : ($this->price		? $this->price		: "");
            $this->facebook_page        = isset($row["facebook_page"])       ? $row["facebook_page"]         : "";
            $this->status				= isset($row["status"])				? $row["status"]				: $status->getDefaultStatus();
            $this->suspended_sitemgr	= isset($row["suspended_sitemgr"])   ? $row["suspended_sitemgr"]		: ($this->suspended_sitemgr		? $this->suspended_sitemgr		: "n");
            $this->level				= isset($row["level"])				? $row["level"]					: ($this->level				? $this->level				: $level->getDefaultLevel());
            $this->hours_work			= isset($row["hours_work"])			? $row["hours_work"]			: "";
            $this->locations			= isset($row["locations"])			? $row["locations"]				: "";
            $this->latitude             = isset($row["latitude"])			? $row["latitude"]				: ($this->latitude		? $this->latitude		: "");
            $this->longitude			= isset($row["longitude"])			? $row["longitude"]				: ($this->longitude		? $this->longitude		: "");
            $this->map_zoom             = isset($row["map_zoom"])            ? $row["map_zoom"]              : 0;
            $this->listingtemplate_id	= isset($row["listingtemplate_id"])	? $row["listingtemplate_id"]	: 0;

$this->custom_text0			= isset($row["custom_text0"])		? $row["custom_text0"]			: "";
            $this->custom_text1			= isset($row["custom_text1"])		? $row["custom_text1"]			: "";
            $this->custom_text2			= isset($row["custom_text2"])		? $row["custom_text2"]			: "";
            $this->custom_text3			= isset($row["custom_text3"])		? $row["custom_text3"]			: "";
            $this->custom_text4			= isset($row["custom_text4"])		? $row["custom_text4"]			: "";
            $this->custom_text5			= isset($row["custom_text5"])		? $row["custom_text5"]			: "";
            $this->custom_text6			= isset($row["custom_text6"])		? $row["custom_text6"]			: "";
            $this->custom_text7			= isset($row["custom_text7"])		? $row["custom_text7"]			: "";
            $this->custom_text8			= isset($row["custom_text8"])		? $row["custom_text8"]			: "";
            $this->custom_text9			= isset($row["custom_text9"])		? $row["custom_text9"]			: "";
            $this->custom_short_desc0	= isset($row["custom_short_desc0"])	? $row["custom_short_desc0"]	: "";
            $this->custom_short_desc1	= isset($row["custom_short_desc1"])	? $row["custom_short_desc1"]	: "";
            $this->custom_short_desc2	= isset($row["custom_short_desc2"])	? $row["custom_short_desc2"]	: "";
            $this->custom_short_desc3	= isset($row["custom_short_desc3"])	? $row["custom_short_desc3"]	: "";
            $this->custom_short_desc4	= isset($row["custom_short_desc4"])	? $row["custom_short_desc4"]	: "";
            $this->custom_short_desc5	= isset($row["custom_short_desc5"])	? $row["custom_short_desc5"]	: "";
            $this->custom_short_desc6	= isset($row["custom_short_desc6"])	? $row["custom_short_desc6"]	: "";
            $this->custom_short_desc7	= isset($row["custom_short_desc7"])	? $row["custom_short_desc7"]	: "";
            $this->custom_short_desc8	= isset($row["custom_short_desc8"])	? $row["custom_short_desc8"]	: "";
            $this->custom_short_desc9	= isset($row["custom_short_desc9"])	? $row["custom_short_desc9"]	: "";
            $this->custom_long_desc0	= isset($row["custom_long_desc0"])	? $row["custom_long_desc0"]		: "";
            $this->custom_long_desc1	= isset($row["custom_long_desc1"])	? $row["custom_long_desc1"]		: "";
            $this->custom_long_desc2	= isset($row["custom_long_desc2"])	? $row["custom_long_desc2"]		: "";
            $this->custom_long_desc3	= isset($row["custom_long_desc3"])	? $row["custom_long_desc3"]		: "";
            $this->custom_long_desc4	= isset($row["custom_long_desc4"])	? $row["custom_long_desc4"]		: "";
            $this->custom_long_desc5	= isset($row["custom_long_desc5"])	? $row["custom_long_desc5"]		: "";
            $this->custom_long_desc6	= isset($row["custom_long_desc6"])	? $row["custom_long_desc6"]		: "";
            $this->custom_long_desc7	= isset($row["custom_long_desc7"])	? $row["custom_long_desc7"]		: "";
            $this->custom_long_desc8	= isset($row["custom_long_desc8"])	? $row["custom_long_desc8"]		: "";
            $this->custom_long_desc9	= isset($row["custom_long_desc9"])	? $row["custom_long_desc9"]		: "";
$this->custom_checkbox0		= isset($row["custom_checkbox0"])	? $row["custom_checkbox0"]		: "n";
            $this->custom_checkbox1		= isset($row["custom_checkbox1"])	? $row["custom_checkbox1"]		: "n";
            $this->custom_checkbox2		= isset($row["custom_checkbox2"])	? $row["custom_checkbox2"]		: "n";
            $this->custom_checkbox3		= isset($row["custom_checkbox3"])	? $row["custom_checkbox3"]		: "n";
            $this->custom_checkbox4		= isset($row["custom_checkbox4"])	? $row["custom_checkbox4"]		: "n";
            $this->custom_checkbox5		= isset($row["custom_checkbox5"])	? $row["custom_checkbox5"]		: "n";
            $this->custom_checkbox6		= isset($row["custom_checkbox6"])	? $row["custom_checkbox6"]		: "n";
            $this->custom_checkbox7		= isset($row["custom_checkbox7"])	? $row["custom_checkbox7"]		: "n";
            $this->custom_checkbox8		= isset($row["custom_checkbox8"])	? $row["custom_checkbox8"]		: "n";
            $this->custom_checkbox9		= isset($row["custom_checkbox9"])	? $row["custom_checkbox9"]		: "n";
            $this->custom_dropdown0		= isset($row["custom_dropdown0"])	? $row["custom_dropdown0"]		: "";
            $this->custom_dropdown1		= isset($row["custom_dropdown1"])	? $row["custom_dropdown1"]		: "";
            $this->custom_dropdown2		= isset($row["custom_dropdown2"])	? $row["custom_dropdown2"]		: "";
            $this->custom_dropdown3		= isset($row["custom_dropdown3"])	? $row["custom_dropdown3"]		: "";
            $this->custom_dropdown4		= isset($row["custom_dropdown4"])	? $row["custom_dropdown4"]		: "";
            $this->custom_dropdown5		= isset($row["custom_dropdown5"])	? $row["custom_dropdown5"]		: "";
            $this->custom_dropdown6		= isset($row["custom_dropdown6"])	? $row["custom_dropdown6"]		: "";
            $this->custom_dropdown7		= isset($row["custom_dropdown7"])	? $row["custom_dropdown7"]		: "";
            $this->custom_dropdown8		= isset($row["custom_dropdown8"])	? $row["custom_dropdown8"]		: "";
            $this->custom_dropdown9		= isset($row["custom_dropdown9"])	? $row["custom_dropdown9"]		: "";

            $this->number_views			= isset($row["number_views"])		? $row["number_views"]			: ($this->number_views		? $this->number_views	: 0);
            $this->avg_review			= isset($row["avg_review"])			? $row["avg_review"]			: ($this->avg_review		? $this->avg_review		: 0);
            $this->review_count			= isset($row["review_count"])		? $row["review_count"]			: ($this->review_count		? $this->review_count	: 0);

            $this->package_id			= isset($row["package_id"])			? $row["package_id"]			: ($this->package_id			? $this->package_id				: 0);
            $this->package_price		= isset($row["package_price"])		? $row["package_price"]			: ($this->package_price			? $this->package_price			: 0);
            $this->backlink				= isset($row["backlink"])			? $row["backlink"]				: ($this->backlink				? $this->backlink				: "n");
            $this->backlink_url				= isset($row["backlink_url"])			? $row["backlink_url"]				: ($this->backlink_url				? $this->backlink_url				: "");
            $this->clicktocall_number		= isset($row["clicktocall_number"])		? $row["clicktocall_number"]	: ($this->clicktocall_number	? $this->clicktocall_number			: "");
            $this->clicktocall_extension	= isset($row["clicktocall_extension"])	? $row["clicktocall_extension"]	: ($this->clicktocall_extension	? $this->clicktocall_extension		: 0);
            $this->clicktocall_date			= isset($row["clicktocall_date"])		? $row["clicktocall_date"]		: ($this->clicktocall_date		? $this->clicktocall_date			: "");

            $this->data_in_array = $row;

    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->Save();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save() {
        if(!isset($this->old_account_id)){$this->old_account_id = $this->account_id;}
        $aux_old_account = str_replace("'", "", $this->old_account_id);
        $aux_account = str_replace("'", "", $this->account_id);

        $this->friendly_url = string_strtolower($this->friendly_url);

        if ($this->id) {
            $row = DBQuery::execute(function(){
                $domain = DBConnection::getInstance()->getDomain();
                $sql = $domain->prepare("SELECT status FROM Listing WHERE id = :id");
                $sql->bindParam(':id', $this->id);
                $sql->execute();

                return $sql->fetch(\PDO::FETCH_ASSOC);
            });
            
            if ($row) $last_status = $row["status"];
            $this_status = $this->status;
            $this_id = $this->id;
            
            $this->update();
            
            $last_status = str_replace("\"", "", $last_status);
            $last_status = str_replace("'", "", $last_status);
            $this_status = str_replace("\"", "", $this_status);
            $this_status = str_replace("'", "", $this_status);
            $this_id = str_replace("\"", "", $this_id);
            $this_id = str_replace("'", "", $this_id);

            //TODO : Memory Leak while counting number of listing per category  
            // system_countActiveListingByCategory($this_id);

            if ($last_status != "P" && $this_status == "P"){
                    activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, "listing", $this->title);
            } else if ($last_status == "P" && $this_status != "P") {
                    activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, "listing");
            } else if ($last_status == $this_status){
                    activity_updateRecord(SELECTED_DOMAIN_ID, $this->id, $this->title, "item", "listing");
            }
            /*
             * Populate Listings to front
             */
            unset($listingSummaryObj);
            $listingSummaryObj = new ListingSummary();
            $listingSummaryObj->PopulateTable($this->id, "update");
            $this->updateCategoryStatusByID();

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                $accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
                $accDomain->Save();
                $accDomain->saveOnDomain($aux_account, $this);
            }

        } 
        else {
            $this->insert();

            if (sess_getAccountIdFromSession() || string_strpos($_SERVER["PHP_SELF"],"order_") !== false){
                    activity_newActivity(SELECTED_DOMAIN_ID, $this->account_id, 0, "newitem", "listing", $this->title);
            }

            if ($this->status == "'P'"){
                    activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, "listing", $this->title);
            }

            domain_updateDashboard("number_listings","inc", 0, SELECTED_DOMAIN_ID);

            /*
             * Populate Listings to front
             */
            unset($listingSummaryObj);
            $listingSummaryObj = new ListingSummary();
            /*
             * Used to package
             */
//            $this->prepareToUse(); //prevent some fields to be saved with empty quotes
//            if(is_numeric($this->domain_id)){
//                    $listingSummaryObj->setNumber("domain_id",$this->domain_id);
//            }else{
//                    $listingSummaryObj->domain_id = SELECTED_DOMAIN_ID;
//            }


            $listingSummaryObj->PopulateTable($this->id, "insert");

            //Reload the Listing object variables
            $row = $this->loadListing($this->id);
            $this->makeFromRow($row);
//            $this->prepareToSave();

            $this_status = $this->status;
            $this_id = $this->id;
            $this_status = str_replace("\"", "", $this_status);
            $this_status = str_replace("'", "", $this_status);
            $this_id = str_replace("\"", "", $this_id);
            $this_id = str_replace("'", "", $this_id);
                    //TODO : Memory Leak while counting number of listing per category  
                    // system_countActiveListingByCategory($this_id);
                    /*
                     * Save to featured temp
                     */
            $this->SaveToFeaturedTemp();

            if ($aux_account != 0) {
                    domain_SaveAccountInfoDomain($aux_account, $this);
            }

        }
        // $this->prepareToUse();
        /**
         * Save listing_id on Promotion table
         */
        if($this->promotion_id != "0"){
            unset($promotionObj);
            $promotionObj = new Promotion($this->promotion_id);
            $promotionObj->setListingId($this);
        }

        $this->setFullTextSearch();  
    }
    
    private function loadListing($var){
        return DBQuery::execute(function() use ($var){
                $domain = DBConnection::getInstance()->getDomain();
                $stmt = $domain->prepare("SELECT * FROM Listing WHERE id = :id");
                $stmt->bindParam(':id', $var);
                $stmt->execute();
                
                return $stmt->fetch(\PDO::FETCH_BOTH);
            });
    }
    private function update(){
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE Listing SET"
                . " account_id         = :account_id,"
                . " image_id           = :image_id,"
                . " thumb_id           = :thumb_id,"
                . " promotion_id       = :promotion_id,"
                . " location_1         = :location_1,"
                . " location_2         = :location_2,"
                . " location_3         = :location_3,"
                . " location_4         = :location_4,"
                . " location_5         = :location_5,"
                . " renewal_date       = :renewal_date,"
                . " discount_id        = :discount_id,"
                . " reminder           = :reminder,"
                . " updated            = NOW(),"
                . " title              = :title,"
                . " seo_title          = :seo_title,"
                . " claim_disable      = :claim_disable,"
                . " friendly_url       = :friendly_url,"
                . " email              = :email,"
                . " url                = :url,"
                . " display_url        = :display_url,"
                . " address            = :address,"
                . " address2           = :address2,"
                . " zip_code           = :zip_code,"
                . " phone              = :phone,"
                . " fax                = :fax,"
                . " description        = :description,"
                . " seo_description    = :seo_description,"
                . " long_description   = :long_description,"
                . " video_snippet      = :video_snippet,"
                . " video_description  = :video_description,"
                . " keywords           = :keywords,"
                . " seo_keywords       = :seo_keywords,"
                . " attachment_file    = :attachment_file,"
                . " attachment_caption = :attachment_caption,"
                . " features           = :features,"
                . " price              = :price,"
                . " facebook_page      = :facebook_page,"
                . " status             = :status,"
                . " suspended_sitemgr  = :suspended_sitemgr,"
                . " level              = :level,"
                . " hours_work         = :hours_work,"
                . " locations          = :locations,"
                . " listingtemplate_id = :listingtemplate_id,"
                . " custom_text0       = :custom_text0,"
                . " custom_text1       = :custom_text1,"
                . " custom_text2       = :custom_text2,"
                . " custom_text3       = :custom_text3,"
                . " custom_text4       = :custom_text4,"
                . " custom_text5       = :custom_text5,"
                . " custom_text6       = :custom_text6,"
                . " custom_text7       = :custom_text7,"
                . " custom_text8       = :custom_text8,"
                . " custom_text9       = :custom_text9,"
                . " custom_short_desc0 = :custom_short_desc0,"
                . " custom_short_desc1 = :custom_short_desc1,"
                . " custom_short_desc2 = :custom_short_desc2,"
                . " custom_short_desc3 = :custom_short_desc3,"
                . " custom_short_desc4 = :custom_short_desc4,"
                . " custom_short_desc5 = :custom_short_desc5,"
                . " custom_short_desc6 = :custom_short_desc6,"
                . " custom_short_desc7 = :custom_short_desc7,"
                . " custom_short_desc8 = :custom_short_desc8,"
                . " custom_short_desc9 = :custom_short_desc9,"
                . " custom_long_desc0  = :custom_long_desc0,"
                . " custom_long_desc1  = :custom_long_desc1,"
                . " custom_long_desc2  = :custom_long_desc2,"
                . " custom_long_desc3  = :custom_long_desc3,"
                . " custom_long_desc4  = :custom_long_desc4,"
                . " custom_long_desc5  = :custom_long_desc5,"
                . " custom_long_desc6  = :custom_long_desc6,"
                . " custom_long_desc7  = :custom_long_desc7,"
                . " custom_long_desc8  = :custom_long_desc8,"
                . " custom_long_desc9  = :custom_long_desc9,"
                . " custom_checkbox0   = :custom_checkbox0,"
                . " custom_checkbox1   = :custom_checkbox1,"
                . " custom_checkbox2   = :custom_checkbox2,"
                . " custom_checkbox3   = :custom_checkbox3,"
                . " custom_checkbox4   = :custom_checkbox4,"
                . " custom_checkbox5   = :custom_checkbox5,"
                . " custom_checkbox6   = :custom_checkbox6,"
                . " custom_checkbox7   = :custom_checkbox7,"
                . " custom_checkbox8   = :custom_checkbox8,"
                . " custom_checkbox9   = :custom_checkbox9,"
                . " custom_dropdown0   = :custom_dropdown0,"
                . " custom_dropdown1   = :custom_dropdown1,"
                . " custom_dropdown2   = :custom_dropdown2,"
                . " custom_dropdown3   = :custom_dropdown3,"
                . " custom_dropdown4   = :custom_dropdown4,"
                . " custom_dropdown5   = :custom_dropdown5,"
                . " custom_dropdown6   = :custom_dropdown6,"
                . " custom_dropdown7   = :custom_dropdown7,"
                . " custom_dropdown8   = :custom_dropdown8,"
                . " custom_dropdown9   = :custom_dropdown9,"
                . " number_views	   = :number_views,"
                . " avg_review		   = :avg_review,"
                . " review_count		   = :review_count,"
                . " latitude           = :latitude,"
                . " longitude          = :longitude,"
                . " map_zoom           = :map_zoom,"
                . " package_id		   = :package_id,"
                . " package_price	   = :package_price,"
                . " backlink		   = :backlink,"
                . " backlink_url            = :backlink_url,"
                . " clicktocall_number		= :clicktocall_number,"
                . " clicktocall_extension	= :clicktocall_extension,"
                . " clicktocall_date		= :clicktocall_date"
                . " WHERE id           = :id");
            $parameters = array(
                ":account_id"         => $this->account_id,
                ":image_id"           => $this->image_id,
                ":thumb_id"           => $this->thumb_id,
                ":promotion_id"       => $this->promotion_id,
                ":location_1"         => $this->location_1,
                ":location_2"         => $this->location_2,
                ":location_3"         => $this->location_3,
                ":location_4"         => $this->location_4,
                ":location_5"         => $this->location_5,
                ":renewal_date"       => $this->renewal_date,
                ":discount_id"        => $this->discount_id,
                ":reminder"           => $this->reminder,
                ":title"              => $this->title,
                ":seo_title"          => $this->title,
                ":claim_disable"      => $this->claim_disable,
                ":friendly_url"       => $this->friendly_url,
                ":email"              => $this->email,
                ":url"                => $this->url,
                ":display_url"        => $this->display_url,
                ":address"            => $this->address,
                ":address2"           => $this->address2,
                ":zip_code"           => $this->zip_code,
                ":phone"              => $this->phone,
                ":fax"                => $this->fax,
                ":description"        => $this->description,
                ":seo_description"    => $this->seo_description,
                ":long_description"   => $this->long_description,
                ":video_snippet"      => $this->video_snippet,
                ":video_description"  => $this->video_description,
                ":keywords"           => $this->keywords,
                ":seo_keywords"       => $this->seo_keywords,
                ":attachment_file"    => $this->attachment_file,
                ":attachment_caption" => $this->attachment_caption,
                ":features"           => $this->features,
                ":price"              => $this->price,
                ":facebook_page"      => $this->facebook_page,
                ":status"             => $this->status,
                ":suspended_sitemgr"  => $this->suspended_sitemgr,
                ":level"              => $this->level,
                ":hours_work"         => $this->hours_work,
                ":locations"          => $this->locations,
                ":listingtemplate_id" => $this->listingtemplate_id,
                ":custom_text0"       => $this->custom_text0,
                ":custom_text1"       => $this->custom_text1,
                ":custom_text2"       => $this->custom_text2,
                ":custom_text3"       => $this->custom_text3,
                ":custom_text4"       => $this->custom_text4,
                ":custom_text5"       => $this->custom_text5,
                ":custom_text6"       => $this->custom_text6,
                ":custom_text7"       => $this->custom_text7,
                ":custom_text8"       => $this->custom_text8,
                ":custom_text9"       => $this->custom_text9,
                ":custom_short_desc0" => $this->custom_short_desc0,
                ":custom_short_desc1" => $this->custom_short_desc1,
                ":custom_short_desc2" => $this->custom_short_desc2,
                ":custom_short_desc3" => $this->custom_short_desc3,
                ":custom_short_desc4" => $this->custom_short_desc4,
                ":custom_short_desc5" => $this->custom_short_desc5,
                ":custom_short_desc6" => $this->custom_short_desc6,
                ":custom_short_desc7" => $this->custom_short_desc7,
                ":custom_short_desc8" => $this->custom_short_desc8,
                ":custom_short_desc9" => $this->custom_short_desc9,
                ":custom_long_desc0"  => $this->custom_long_desc0,
                ":custom_long_desc1"  => $this->custom_long_desc1,
                ":custom_long_desc2"  => $this->custom_long_desc2,
                ":custom_long_desc3"  => $this->custom_long_desc3,
                ":custom_long_desc4"  => $this->custom_long_desc4,
                ":custom_long_desc5"  => $this->custom_long_desc5,
                ":custom_long_desc6"  => $this->custom_long_desc6,
                ":custom_long_desc7"  => $this->custom_long_desc7,
                ":custom_long_desc8"  => $this->custom_long_desc8,
                ":custom_long_desc9"  => $this->custom_long_desc9,
                ":custom_checkbox0"   => $this->custom_checkbox0,
                ":custom_checkbox1"   => $this->custom_checkbox1,
                ":custom_checkbox2"   => $this->custom_checkbox2,
                ":custom_checkbox3"   => $this->custom_checkbox3,
                ":custom_checkbox4"   => $this->custom_checkbox4,
                ":custom_checkbox5"   => $this->custom_checkbox5,
                ":custom_checkbox6"   => $this->custom_checkbox6,
                ":custom_checkbox7"   => $this->custom_checkbox7,
                ":custom_checkbox8"   => $this->custom_checkbox8,
                ":custom_checkbox9"   => $this->custom_checkbox9,
                ":custom_dropdown0"   => $this->custom_dropdown0,
                ":custom_dropdown1"   => $this->custom_dropdown1,
                ":custom_dropdown2"   => $this->custom_dropdown2,
                ":custom_dropdown3"   => $this->custom_dropdown3,
                ":custom_dropdown4"   => $this->custom_dropdown4,
                ":custom_dropdown5"   => $this->custom_dropdown5,
                ":custom_dropdown6"   => $this->custom_dropdown6,
                ":custom_dropdown7"   => $this->custom_dropdown7,
                ":custom_dropdown8"   => $this->custom_dropdown8,
                ":custom_dropdown9"   => $this->custom_dropdown9,
                ":number_views"	   => $this->number_views,
                ":avg_review"		   => $this->avg_review,
                 ":review_count"		   => $this->review_count,
                ":latitude"           => $this->latitude,
                ":longitude"          => $this->longitude,
                ":map_zoom"           => $this->map_zoom,
                ":package_id"		   => $this->package_id,
                ":package_price"	   => $this->package_price,
                ":backlink"		   => $this->backlink,
                ":backlink_url"            => $this->backlink_url,
                ":clicktocall_number"		=> $this->clicktocall_number,
                ":clicktocall_extension"	=> $this->clicktocall_extension,
                ":clicktocall_date"		=> $this->clicktocall_date,
                ":id"           => $this->id
            );
            $sql->execute($parameters);
        });

    }
    
    private function insert(){
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $aux_seoDescription = $this->description;
            $aux_seoDescription = str_replace(array("\r\n", "\n"), " ", $aux_seoDescription);
            $aux_seoDescription = str_replace("\\\"", "", $aux_seoDescription);

            $sql = $domain->prepare("INSERT INTO Listing"
                    . " (account_id,"
                    . " image_id,"
                    . " thumb_id,"
                    . " promotion_id,"
                    . " location_1,"
                    . " location_2,"
                    . " location_3,"
                    . " location_4,"
                    . " location_5,"
                    . " renewal_date,"
                    . " discount_id,"
                    . " reminder,"
                    . " fulltextsearch_keyword,"
                    . " fulltextsearch_where,"
                    . " updated,"
                    . " entered,"
                    . " title,"
                    . " seo_title,"
                    . " claim_disable,"
                    . " friendly_url,"
                    . " email,"
                    . " url,"
                    . " display_url,"
                    . " address,"
                    . " address2,"
                    . " zip_code,"
                    . " phone,"
                    . " fax,"
                    . " description,"
                    . " seo_description,"
                    . " long_description,"
                    . " video_snippet,"
                    . " video_description,"
                    . " keywords,"
                    . " seo_keywords,"
                    . " attachment_file,"
                    . " attachment_caption,"
                    . " features,"
                    . " price,"
                    . " facebook_page,"
                    . " status,"
                    . " level,"
                    . " hours_work,"
                    . " locations,"
                    . " listingtemplate_id,"
                    . " custom_text0,"
                    . " custom_text1,"
                    . " custom_text2,"
                    . " custom_text3,"
                    . " custom_text4,"
                    . " custom_text5,"
                    . " custom_text6,"
                    . " custom_text7,"
                    . " custom_text8,"
                    . " custom_text9,"
                    . " custom_short_desc0,"
                    . " custom_short_desc1,"
                    . " custom_short_desc2,"
                    . " custom_short_desc3,"
                    . " custom_short_desc4,"
                    . " custom_short_desc5,"
                    . " custom_short_desc6,"
                    . " custom_short_desc7,"
                    . " custom_short_desc8,"
                    . " custom_short_desc9,"
                    . " custom_long_desc0,"
                    . " custom_long_desc1,"
                    . " custom_long_desc2,"
                    . " custom_long_desc3,"
                    . " custom_long_desc4,"
                    . " custom_long_desc5,"
                    . " custom_long_desc6,"
                    . " custom_long_desc7,"
                    . " custom_long_desc8,"
                    . " custom_long_desc9,"
                    . " custom_checkbox0,"
                    . " custom_checkbox1,"
                    . " custom_checkbox2,"
                    . " custom_checkbox3,"
                    . " custom_checkbox4,"
                    . " custom_checkbox5,"
                    . " custom_checkbox6,"
                    . " custom_checkbox7,"
                    . " custom_checkbox8,"
                    . " custom_checkbox9,"
                    . " custom_dropdown0,"
                    . " custom_dropdown1,"
                    . " custom_dropdown2,"
                    . " custom_dropdown3,"
                    . " custom_dropdown4,"
                    . " custom_dropdown5,"
                    . " custom_dropdown6,"
                    . " custom_dropdown7,"
                    . " custom_dropdown8,"
                    . " custom_dropdown9,"
                    . " number_views,"
                    . " avg_review,"
                    . " review_count,"
                    . " latitude,"
                    . " longitude,"
                    . " map_zoom,"
                    . " package_id,"
                    . " package_price,"
                    . " backlink,"
                    . " backlink_url,"
                    . " clicktocall_number,"
                    . " clicktocall_extension,"
                    . " clicktocall_date)"
                    . " VALUES"
                    . " (:account_id,"
                    . " :image_id,"
                    . " :thumb_id,"
                    . " :promotion_id,"
                    . " :location_1,"
                    . " :location_2,"
                    . " :location_3,"
                    . " :location_4,"
                    . " :location_5,"
                    . " :renewal_date,"
                    . " :discount_id,"
                    . " :reminder,"
                    . " '',"
                    . " '',"
                    . " NOW(),"
                    . " NOW(),"
                    . " :title,"
                    . " :seo_title,"
                    . " :claim_disable,"
                    . " :friendly_url,"
                    . " :email,"
                    . " :url,"
                    . " :display_url,"
                    . " :address,"
                    . " :address2,"
                    . " :zip_code,"
                    . " :phone,"
                    . " :fax,"
                    . " :description,"
                    . " :aux_seoDescription,"
                    . " :long_description,"
                    . " :video_snippet,"
                    . " :video_description,"
                    . " :keywords,"
                    . " :seo_keywords,"
                    . " :attachment_file,"
                    . " :attachment_caption,"
                    . " :features,"
                    . " :price,"
                    . " :facebook_page,"
                    . " :status,"
                    . " :level,"
                    . " :hours_work,"
                    . " :locations,"
                    . " :listingtemplate_id,"
                    . " :custom_text0,"
                    . " :custom_text1,"
                    . " :custom_text2,"
                    . " :custom_text3,"
                    . " :custom_text4,"
                    . " :custom_text5,"
                    . " :custom_text6,"
                    . " :custom_text7,"
                    . " :custom_text8,"
                    . " :custom_text9,"
                    . " :custom_short_desc0,"
                    . " :custom_short_desc1,"
                    . " :custom_short_desc2,"
                    . " :custom_short_desc3,"
                    . " :custom_short_desc4,"
                    . " :custom_short_desc5,"
                    . " :custom_short_desc6,"
                    . " :custom_short_desc7,"
                    . " :custom_short_desc8,"
                    . " :custom_short_desc9,"
                    . " :custom_long_desc0,"
                    . " :custom_long_desc1,"
                    . " :custom_long_desc2,"
                    . " :custom_long_desc3,"
                    . " :custom_long_desc4,"
                    . " :custom_long_desc5,"
                    . " :custom_long_desc6,"
                    . " :custom_long_desc7,"
                    . " :custom_long_desc8,"
                    . " :custom_long_desc9,"
                    . " :custom_checkbox0,"
                    . " :custom_checkbox1,"
                    . " :custom_checkbox2,"
                    . " :custom_checkbox3,"
                    . " :custom_checkbox4,"
                    . " :custom_checkbox5,"
                    . " :custom_checkbox6,"
                    . " :custom_checkbox7,"
                    . " :custom_checkbox8,"
                    . " :custom_checkbox9,"
                    . " :custom_dropdown0,"
                    . " :custom_dropdown1,"
                    . " :custom_dropdown2,"
                    . " :custom_dropdown3,"
                    . " :custom_dropdown4,"
                    . " :custom_dropdown5,"
                    . " :custom_dropdown6,"
                    . " :custom_dropdown7,"
                    . " :custom_dropdown8,"
                    . " :custom_dropdown9,"
                    . " :number_views,"
                    . " :avg_review,"
                    . " :review_count,"
                    . " :latitude,"
                    . " :longitude,"
                    . " :map_zoom,"
                    . " :package_id,"
                    . " :package_price,"
                    . " :backlink,"
                    . " :backlink_url,"
                    . " :clicktocall_number,"
                    . " :clicktocall_extension,"
                    . " :clicktocall_date)");
            $parameter = array(
                    ":account_id" => $this->account_id,
                    ":image_id" => $this->image_id,
                    ":thumb_id" => $this->thumb_id,
                    ":promotion_id" => $this->promotion_id,
                    ":location_1" => $this->location_1,
                    ":location_2" => $this->location_2,
                    ":location_3" => $this->location_3,
                    ":location_4" => $this->location_4,
                    ":location_5" => $this->location_5,
                    ":renewal_date" => $this->renewal_date,
                    ":discount_id" => $this->discount_id,
                    ":reminder" => $this->reminder,
                    ":title" => $this->title,
                    ":seo_title" => $this->seo_title,
                    ":claim_disable" => $this->claim_disable,
                    ":friendly_url" => $this->friendly_url,
                    ":email" => $this->email,
                    ":url" => $this->url,
                    ":display_url" => $this->display_url,
                    ":address" => $this->address,
                    ":address2" => $this->address2,
                    ":zip_code" => $this->zip_code,
                    ":phone" => $this->phone,
                    ":fax" => $this->fax,
                    ":description" => $this->description,
                    ":aux_seoDescription" => $aux_seoDescription,
                    ":long_description" => $this->long_description,
                    ":video_snippet" => $this->video_snippet,
                    ":video_description" => $this->video_description,
                    ":keywords" => $this->keywords,
                    ":seo_keywords" => str_replace(" || ", ", ", $this->keywords),
                    ":attachment_file" => $this->attachment_file,
                    ":attachment_caption" => $this->attachment_caption,
                    ":features" => $this->features,
                    ":price" => $this->price,
                    ":facebook_page" => $this->facebook_page,
                    ":status" => $this->status,
                    ":level" => $this->level,
                    ":hours_work" => $this->hours_work,
                    ":locations" => $this->locations,
                    ":listingtemplate_id" => $this->listingtemplate_id,
                    ":custom_text0" => $this->custom_text0,
                    ":custom_text1" => $this->custom_text1,
                    ":custom_text2" => $this->custom_text2,
                    ":custom_text3" => $this->custom_text3,
                    ":custom_text4" => $this->custom_text4,
                    ":custom_text5" => $this->custom_text5,
                    ":custom_text6" => $this->custom_text6,
                    ":custom_text7" => $this->custom_text7,
                    ":custom_text8" => $this->custom_text8,
                    ":custom_text9" => $this->custom_text9,
                    ":custom_short_desc0" => $this->custom_short_desc0,
                    ":custom_short_desc1" => $this->custom_short_desc1,
                    ":custom_short_desc2" => $this->custom_short_desc2,
                    ":custom_short_desc3" => $this->custom_short_desc3,
                    ":custom_short_desc4" => $this->custom_short_desc4,
                    ":custom_short_desc5" => $this->custom_short_desc5,
                    ":custom_short_desc6" => $this->custom_short_desc6,
                    ":custom_short_desc7" => $this->custom_short_desc7,
                    ":custom_short_desc8" => $this->custom_short_desc8,
                    ":custom_short_desc9" => $this->custom_short_desc9,
                    ":custom_long_desc0" => $this->custom_long_desc0,
                    ":custom_long_desc1" => $this->custom_long_desc1,
                    ":custom_long_desc2" => $this->custom_long_desc2,
                    ":custom_long_desc3" => $this->custom_long_desc3,
                    ":custom_long_desc4" => $this->custom_long_desc4,
                    ":custom_long_desc5" => $this->custom_long_desc5,
                    ":custom_long_desc6" => $this->custom_long_desc6,
                    ":custom_long_desc7" => $this->custom_long_desc7,
                    ":custom_long_desc8" => $this->custom_long_desc8,
                    ":custom_long_desc9" => $this->custom_long_desc9,
                    ":custom_checkbox0" => $this->custom_checkbox0,
                    ":custom_checkbox1" => $this->custom_checkbox1,
                    ":custom_checkbox2" => $this->custom_checkbox2,
                    ":custom_checkbox3" => $this->custom_checkbox3,
                    ":custom_checkbox4" => $this->custom_checkbox4,
                    ":custom_checkbox5" => $this->custom_checkbox5,
                    ":custom_checkbox6" => $this->custom_checkbox6,
                    ":custom_checkbox7" => $this->custom_checkbox7,
                    ":custom_checkbox8" => $this->custom_checkbox8,
                    ":custom_checkbox9" => $this->custom_checkbox9,
                    ":custom_dropdown0" => $this->custom_dropdown0,
                    ":custom_dropdown1" => $this->custom_dropdown1,
                    ":custom_dropdown2" => $this->custom_dropdown2,
                    ":custom_dropdown3" => $this->custom_dropdown3,
                    ":custom_dropdown4" => $this->custom_dropdown4,
                    ":custom_dropdown5" => $this->custom_dropdown5,
                    ":custom_dropdown6" => $this->custom_dropdown6,
                    ":custom_dropdown7" => $this->custom_dropdown7,
                    ":custom_dropdown8" => $this->custom_dropdown8,
                    ":custom_dropdown9" => $this->custom_dropdown9,
                    ":number_views" => $this->number_views,
                    ":avg_review" => $this->avg_review,
                 ":review_count" => $this->review_count,
                    ":latitude" => $this->latitude,
                    ":longitude" => $this->longitude,
                    ":map_zoom" => $this->map_zoom,
                    ":package_id" => $this->package_id,
                    ":package_price" => $this->package_price,
                    ":backlink" => $this->backlink,
                    ":backlink_url" => $this->backlink_url,
                    ":clicktocall_number" => $this->clicktocall_number,
                    ":clicktocall_extension" => $this->clicktocall_extension,
                    ":clicktocall_date" => $this->clicktocall_date
            );
            if($sql->execute($parameter)){
                $this->id = $domain->lastInsertId();
            }
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     */
    function Delete($domain_id = false, $update_count = true) {
        DBQuery::execute(function() use($domain_id, $update_count){
            $domain = DBConnection::getInstance()->getDomain();
            ### LISTING CATEGORY STATUS
            if ($this->status != "P") {
                    $sql = $domain->prepare("UPDATE Listing SET status = 'P' WHERE id = :id");
                    $sql->bindParam(':id', $this->id);
                    $sql->execute();
            }

            if (SHOW_CATEGORY_COUNT == "on" && $update_count) system_countActiveListingByCategory($this->id, false, $domain_id);

            ### REVIEWS
            $sql = $domain->prepare("SELECT id FROM Review WHERE item_type='listing' AND item_id=:item_id");
            $sql->bindParam(':item_id', $this->id);
            $sql->execute();

            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $reviewObj = new Review($row["id"]);
                    $reviewObj->Delete($domain_id);
            }

            ### LISTING_CATEOGRY
            $sql = $domain->prepare("DELETE FROM Listing_Category WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            ### CHOICES
            $sql = $domain->prepare("DELETE FROM Listing_Choice WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            ### GALERY
            $sql = $domain->prepare("SELECT gallery_id FROM Gallery_Item WHERE item_id = :item_id AND item_type = 'listing'");
            $sql->bindParam(':item_id', $this->id);
            $sql->execute();
            $row = $sql->fetch(\PDO::FETCH_BOTH);
            $gallery_id = $row["gallery_id"]; 
            if ($gallery_id) {
                $gallery = new Gallery($gallery_id);
                $gallery->delete();
            }

            ### IMAGE
            if ($this->image_id) {
                    $image = new Image($this->image_id);
                    if ($image) $image->Delete($domain_id);
            }
            if ($this->thumb_id) {
                    $image = new Image($this->thumb_id);
                    if ($image) $image->Delete($domain_id);
            }

            ### ATTACHMENT
            if ($this->attachment_file) {
                    if (file_exists($domain_extra_file_dir.$this->attachment_file)) {
                            @unlink($domain_extra_file_dir.$this->attachment_file);
                    }
            }

            ### INVOICE
            $sql = $domain->prepare("UPDATE Invoice_Listing SET listing_id = '0' WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            ### PAYMENT
            $sql = $domain->prepare("UPDATE Payment_Listing_Log SET listing_id = '0' WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            ### CLAIM
            $sql = $domain->prepare("UPDATE Claim SET status = 'incomplete' WHERE listing_id = :listing_id AND status = 'progress'");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();
            $sql = $domain->prepare("UPDATE Claim SET listing_id = '0' WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            ### CheckIn
            $sql = $domain->prepare("DELETE FROM CheckIn WHERE item_id = :item_id");
            $sql->bindParam(':item_id', $this->id);
            $sql->execute();

            ### Promotion
            $sql = $domain->prepare("UPDATE Promotion SET    fulltextsearch_where = '',
                                            listing_id = 0, 
                                            listing_status = '', 
                                            listing_level = 0, 
                                            listing_location1 = 0, 
                                            listing_location2 = 0, 
                                            listing_location3 = 0, 
                                            listing_location4 = 0, 
                                            listing_location5 = 0, 
                                            listing_address = '', 
                                            listing_address2 = '', 
                                            listing_zipcode = '', 
                                            listing_zip5 = '0', 
                                            listing_latitude = '', 
                                            listing_longitude = ''
                   WHERE listing_id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();

            /*
             * Populate Listings to front
             */
            unset($listingSummaryObj);
            $listingSummaryObj = new ListingSummary();
            $listingSummaryObj->Delete($this->id);

            ### LISTING
            $sql = $domain->prepare("DELETE FROM Listing WHERE id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });



            if ($domain_id){
                    $domain_idDash = $domain_id;
            } else {
                    $domain_idDash = SELECTED_DOMAIN_ID;
            }

            domain_updateDashboard("number_listings", "dec", 0, $domain_idDash);

            activity_deleteRecord($domain_idDash, $this->id, "listing");

    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->updateImage($imageArray);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->updateImage($imageArray);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name updateImage
     * @access Public
     * @param array $imageArray
     */
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

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getCategories(...);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getCategories(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @param boolean $have_data
     * @param array $data
     * @param integer $id
     * @param boolean $getAll
     * @param boolean $object
     * @param boolean $bulk
     * @return array $categories
     */
    function getCategories($have_data = false, $data = false, $id = false, $getAll = false, $object=false, $bulk=false) {
            
        return DBQuery::execute(function() use ($have_data, $data, $id, $getAll, $object, $bulk){
            $domain = DBConnection::getInstance()->getDomain();
            if ($have_data) {
                if (isset($data["cat_1_id"])) $ids[] = $data["cat_1_id"];
                if (isset($data["cat_2_id"])) $ids[] = $data["cat_2_id"];
                if (isset($data["cat_3_id"])) $ids[] = $data["cat_3_id"];
                if (isset($data["cat_4_id"])) $ids[] = $data["cat_4_id"];
                if (isset($data["cat_5_id"])) $ids[] = $data["cat_5_id"];

                if (is_array($ids)) {
                    $ids = array_unique($ids);
                    $no_of_ids = count($ids);
                    $questionMarks = str_repeat('?,', $no_of_ids-1) . '?';
                    $sql = $domain->prepare("SELECT * FROM ListingCategory WHERE id IN (".$questionMarks.")");
                    for($i=0;$i<$no_of_ids;$i++){
                        $sql->bindValue($i+1, $ids[$i]);
                    }
                    $sql->execute();
                    while ($row = $sql->fetch(\PDO::FETCH_BOTH)) {
                        $categories[] = new ListingCategory($row);
                    }
                }

            } 
            else {
                if(!$id){
                    $id = $this->id ;
                }
                if($id){

                    $sql_main = $domain->prepare("SELECT category.root_id,
                        listing_category.category_id
                        FROM Listing_Category listing_category
                        INNER JOIN ListingCategory category ON category.id = listing_category.category_id
                        WHERE listing_category.listing_id = :id AND root_id > 0");
                    $sql_main->bindParam(':id', $id);

                    $result_main = $sql_main->execute();

                    if($result_main){

                        $aux_array_categories = array();
                        while($row = $sql_main->fetch(\PDO::FETCH_ASSOC)){
                                if (!$object && !$bulk) {
                                        $aux_array_categories[] = $row["root_id"];
                                }
                                if ($getAll) {
                                        $aux_array_categories[] = $row["category_id"];
                                }
                        }

                        if(count($aux_array_categories) > 0){
                            $no_of_categories = count($aux_array_categories);
                            $questionMarks = str_repeat('?,', $no_of_categories-1). "?";
                            $sql = $domain->prepare("SELECT	id,
                                title,
                                page_title,
                                friendly_url,
                                enabled,
                                category_id
                            FROM ListingCategory
                            WHERE id IN (".$questionMarks.")");
                            for($i=0; $i<$no_of_categories; $i++){
                                $sql->bindValue($i+1, $aux_array_categories[$i]);
                            }
//                            if(!$object){
//                                $result = $dbObj->unbuffered_query($sql);
//                            }else{
//                                $result = $dbObj->query($sql);
//                            }
                            $result = $sql->execute();
                            //if(mysql_num_rows($result) > 0){
                            if($result){
                                $categories = array();
                                while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                                    if ($object){
                                        $categories[] = new ListingCategory($row);
                                    } else {
                                        $categories[] = $row;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if(count($categories) > 0){
                    return $categories;
            }else{
                    return false;
            }
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setCategories($categories);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setCategories($categories);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setCategories
     * @access Public
     * @param array $array
     */
    function setCategories($array) {
        DBQuery::execute(function() use ($array){
            $domain = DBConnection::getInstance()->getDomain();
            if ($this->id) {
                    //TODO : Memory Leak while counting number of listing per category 
                    // system_countActiveListingByCategory($this->id);

                    $sql = $domain->prepare("DELETE FROM Listing_Category WHERE listing_id = :id");
                    $sql->bindParam(':id', $this->id);
                    $sql->execute();

                    if ($array) {
                        foreach ($array as $category) {
                            if ($category) {

                                    $lCatObj = new ListingCategory($category);
                                    unset($root_id, $left, $right);
                                    $root_id = $lCatObj->getNumber("root_id");
                                    $left = $lCatObj->getNumber("left");
                                    $right = $lCatObj->getNumber("right");

                                    unset($l_catObj);
                                    $l_catObj = new Listing_Category();
                                    $l_catObj->setNumber("listing_id", $this->id);
                                    $l_catObj->setNumber("category_id", $category);
                                    $l_catObj->setString("status", $this->status);
                                    $l_catObj->setNumber("category_root_id", $root_id);
                                    $l_catObj->setNumber("category_node_left", $left);
                                    $l_catObj->setNumber("category_node_right", $right);
                                    $l_catObj->Save();
                            }
                        }
                    }

                    $this->setFullTextSearch();
                    //TODO : Memory Leak while counting number of listing per category 
                    // system_countActiveListingByCategory($this->id);
            }
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->updateCategoryStatusByID($categories);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->updateCategoryStatusByID($categories);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name updateCategoryStatusByID
     * @access Public
     */
    function updateCategoryStatusByID() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql_update = $domain->prepare("UPDATE Listing_Category "
                    . "SET status = :status "
                    . "WHERE listing_id = :listing_id");
            $sql_update->bindParam(':status', $this->status);
            $sql_update->bindParam(':listing_id', $this->id);
            $sql_update->execute();
        });        
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->retrieveListingsbyPromotion_id($promotion_id);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->retrieveListingsbyPromotion_id($promotion_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name retrieveListingsbyPromotion_id
     * @access Public
     * @param integer $promotion_id
     * @return array $listings
     */
    function retrieveListingsbyPromotion_id($promotion_id) {
        return DBQuery::execute(function() use($promotion_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing WHERE promotion_id = :promotion_id");
            $sql->bindParam(':promotion_id', $promotion_id);
            $sql->execute();
            
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                $listings[] = new Listing($row["id"]);
            }
            return $listings;
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getPrice();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getPrice();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getPrice
     * @access Public
     * @return double $price
     */
    function getPrice() {
        
        $price = DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $price = 0;

            /*
             * Check if have price by package
             */
            $levelObj = new ListingLevel();
            if($this->package_id){
                    $price = $this->package_price;
            }else{
                    $price = $price + $levelObj->getPrice($this->level);
            }

            $sql = $domain->prepare("SELECT COUNT(id) AS total FROM Listing_Category WHERE listing_id = :listing_id");
            $sql->execute(array(':listing_id' => $this->id));
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            $category_amount = $row["total"];

            if(isset($this->categories) && !$this->id){
                    $category_amount = $this->categories;
            }

            if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($this->level)) > 0)) {
                    $extra_category_amount = $category_amount - $levelObj->getFreeCategory($this->level);
            } else {
                    $extra_category_amount = 0;
            }

            if ($extra_category_amount > 0) $price = $price + ($levelObj->getCategoryPrice($this->level) * $extra_category_amount);

            if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                if ($this->listingtemplate_id) {
                    $listingTemplateObj = new ListingTemplate($this->listingtemplate_id);
                    if ($listingTemplateObj->getString("status") == "enabled") {
                            $price = $price + $listingTemplateObj->getString("price");
                    } 
                    else {
                        $sql = $domain->prepare("UPDATE Listing SET listingtemplate_id = 0 WHERE id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();

                        /*
                         * Populate Listings to front
                         */
                        $sql = $domain->prepare("UPDATE Listing_Summary SET
                                        listingtemplate_id = 0,
                                        template_layout_id = 0,
                                        template_cat_id = 0,
                                        template_title = '',
                                        template_status = '',
                                        template_price = 0
                                        WHERE id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();
                    }
                }
            }

            if ($this->discount_id) {

                $discountCodeObj = new DiscountCode($this->discount_id);

                if (is_valid_discount_code($this->discount_id, "listing", $this->id, $discount_message, $discount_error)) {

                    if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                        if ($discountCodeObj->getString("type") == "percentage") {
                                $price = $price * (1 - $discountCodeObj->getString("amount")/100);
                        } 
                        elseif ($discountCodeObj->getString("type") == "monetary value") {
                                $price = $price - $discountCodeObj->getString("amount");
                        }

                    } elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {

                        $this->status = 'E';
                        $this->renewal_date = $discountCodeObj->expire_date;
                        $sql = $domain->prepare("UPDATE Listing "
                                . "SET status = 'E', renewal_date = :renewal_date, discount_id = '' "
                                . "WHERE id = :id");
                        $sql->bindParam(':renewal_date', $discountCodeObj->expire_date);
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();

                        $sql = $domain->prepare("UPDATE Promotion SET listing_status = 'E' WHERE listing_id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();

                        /*
                         * Populate Listings to front
                         */
                        $sql = $domain->prepare("UPDATE Listing_Summary SET
                                        status = 'E',
                                        renewal_date = :renewal_date
                                        WHERE id = :id");
                        $sql->bindParam(':renewal_date', $discountCodeObj->expire_date);
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();
                    }

                } 
                else {
                    if ( ($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price) ) {
                        $this->status = 'E';
                        $this->renewal_date = $discountCodeObj->expire_date;
                        $sql = $domain->prepare("UPDATE Listing "
                                . "SET status = 'E', renewal_date = :renewal_date, discount_id = '' "
                                . "WHERE id = :id");
                        $sql->bindParam(':renewal_date', $discountCodeObj->expire_date);
                        $sql->bindParam(':id', $this->id);
                        $sql->execute(); // this line missing in old class i.e query not executed
                        /*
                         * Populate Listings to front
                         */
                        $sql2 = $domain->prepare("UPDATE Listing_Summary SET
                                        status = 'E',
                                        renewal_date = :renewal_date
                                        WHERE id = :id");
                        $sql->bindParam(':renewal_date', $discountCodeObj->expire_date);
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();

                        $sql3 = $domain->prepare("UPDATE Promotion "
                                . "SET listing_status = 'E' "
                                . "WHERE listing_id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();

                    } 
                    else {
                        $sql = $domain->prepare("UPDATE Listing SET discount_id = '' WHERE id = :id");
                        $sql->bindParam(':id', $this->id);
                        $sql->execute();
                    }
                    //$result = $dbObj->query($sql);
                }

            }

            if ($price <= 0) $price = 0;


            $money = \CountryLoader::getPriceListing($this->id, $this->location_1);
            $price = $money['price_listing'];
            
            return $price;
        });
        
        return $price;
    }

public function getDiscountedPrice( $discount_id, $price){
    $account = new Account(sess_getAccountIdFromSession());

    if ($discount_id) {

        $discountCodeObj = new DiscountCode($discount_id);
        if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

            if($this->status == "P"){
                $listingPending = new ListingPending($this->id);
                if($listingPending->custom_checkbox1 == "y"){
                   $forex = CountryLoader::getForexRate("", $account->prefered_currency);
                } 
                else {
                    $forex = CountryLoader::getForexRate($listingPending->location_1, $account->prefered_currency);
                }
            } 
            else {
                //Make discout code's price in local currency format
                if($this->custom_checkbox1 == "y"){
                    $forex = CountryLoader::getForexRate("", $account->prefered_currency);
                } else {
                    $forex = CountryLoader::getForexRate($this->location_1, $account->prefered_currency);
                }
            }

            if ($discountCodeObj->getString("type") == "percentage") {
                $price = $price * (1 - $discountCodeObj->getString("amount")/100);
            } 
            elseif ($discountCodeObj->getString("type") == "monetary value") {
                $discountCodeObj->amount = $discountCodeObj->amount * $forex;
                $price = $price - $discountCodeObj->getString("amount");
            }
        } 
    }

    return $price;
}

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->hasRenewalDate();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->hasRenewalDate();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasRenewalDate
     * @access Public
     * @return boolean
     */
    function hasRenewalDate() {
            if (PAYMENT_FEATURE != "on") return false;
            if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) return false;
            if ($this->getPrice() <= 0) return false;
            return true;
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->needToCheckOut();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->needToCheckOut();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name needToCheckOut
     * @access Public
     * @return boolean
     */
    function needToCheckOut() {

            if ($this->hasRenewalDate()) {

                    $today = date("Y-m-d");
                    $today = explode("-", $today);
                    $today_year = $today[0];
                    $today_month = $today[1];
                    $today_day = $today[2];
                    $timestamp_today = mktime(0, 0, 0, $today_month, $today_day, $today_year);

                    $this_renewaldate = $this->renewal_date;
                    $renewaldate = explode("-", $this_renewaldate);
                    $renewaldate_year = $renewaldate[0];
                    $renewaldate_month = $renewaldate[1];
                    $renewaldate_day = $renewaldate[2];
                    $timestamp_renewaldate = mktime(0, 0, 0, $renewaldate_month, $renewaldate_day, $renewaldate_year);

                    if (($this->status == "E") || ($this_renewaldate == "0000-00-00") || ($timestamp_today > $timestamp_renewaldate)) {
                            return true;
                    }

            }

            return false;

    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getNextRenewalDate($times);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getNextRenewalDate($times);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getNextRenewalDate
     * @access Public
     * @param integer $times
     * @return date $nextrenewaldate
     */
    function getNextRenewalDate($times = 1) {

            $nextrenewaldate = "0000-00-00";

            if ($this->hasRenewalDate()) {

                    if ($this->needToCheckOut()) {

                            $today = date("Y-m-d");
                            $today = explode("-", $today);
                            $start_year = $today[0];
                            $start_month = $today[1];
                            $start_day = $today[2];

                    } else {

                            $this_renewaldate = $this->renewal_date;
                            $renewaldate = explode("-", $this_renewaldate);
                            $start_year = $renewaldate[0];
                            $start_month = $renewaldate[1];
                            $start_day = $renewaldate[2];

                    }

                    $renewalcycle = payment_getRenewalCycle("listing");
                    $renewalunit = payment_getRenewalUnit("listing");

                    if ($renewalunit == "Y") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year+($renewalcycle*$times)));
                    } elseif ($renewalunit == "M") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month+($renewalcycle*$times), (int)$start_day, (int)$start_year));
                    } elseif ($renewalunit == "D") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day+($renewalcycle*$times), (int)$start_year));
                    }

            }

            return $nextrenewaldate;

    }

    function getNextMonthlyRenewalDate($times = 1) {

            $nextrenewaldate = "0000-00-00";

            if ($this->hasRenewalDate()) {

                    if ($this->needToCheckOut()) {

                            $today = date("Y-m-d");
                            $today = explode("-", $today);
                            $start_year = $today[0];
                            $start_month = $today[1];
                            $start_day = $today[2];

                    } else {

                            $this_renewaldate = $this->renewal_date;
                            $renewaldate = explode("-", $this_renewaldate);
                            $start_year = $renewaldate[0];
                            $start_month = $renewaldate[1];
                            $start_day = $renewaldate[2];

                    }

                    $renewalcycle = 1;
                    $renewalunit  = "M";

                    if ($renewalunit == "Y") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year+($renewalcycle*$times)));
                    } elseif ($renewalunit == "M") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month+($renewalcycle*$times), (int)$start_day, (int)$start_year));
                    } elseif ($renewalunit == "D") {
                            $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day+($renewalcycle*$times), (int)$start_year));
                    }

            }

            return $nextrenewaldate;

    }

    /**
     * @ Modification Promocode Duration feature
     */

    function setRenewalDate($date,$id){
        DBQuery::execute(function() use($date, $id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE Listing "
                    . "SET renewal_date =:renewal_date "
                    . "where id =:id") ;
            $sql->bindParam(':renewal_date', $date);
            $sql->bindParam(':id', $id);
            $sql->execute();
        });

    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setLocationManager($locationManager);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setLocationManager($locationManager);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setLocationManager
     * @access Public
     * @param mixed &$locationManager
     */
    function setLocationManager(&$locationManager) {
            $this->locationManager =& $locationManager;
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getLocationManager();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getLocationManager();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationManager
     * @access Public
     * @return mixed &$this->locationManager
     */
    function &getLocationManager() {
            return $this->locationManager; /* NEVER auto-instantiate this*/
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getLocationString(...);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getLocationString(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationString
     * @access Public
     * @param varchar $format
     * @param boolean $forceManagerCreation
     * @return string locationString
     */
    function getLocationString($format, $forceManagerCreation = false, $lineBreak = true) {
            if($forceManagerCreation && !$this->locationManager) $this->locationManager = new LocationManager();
            return db_getLocationString($this, $format, true, $lineBreak);
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setFullTextSearch();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setFullTextSearch();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setFullTextSearch
     * @access Public
     */
    function setFullTextSearch() {

        if ($this->title) {
            $fulltextsearch_keyword_ = $this->title;
        if(strpos($this->title, ".") > -1){

            $fulltextsearch_keyword_ = str_replace("http://", "", $fulltextsearch_keyword_);
            $fulltextsearch_keyword_ = str_replace("ftp://", "", $fulltextsearch_keyword_);
            $fulltextsearch_keyword_ = str_replace("https://", "", $fulltextsearch_keyword_);
            $fulltextsearch_keyword_ = str_replace("www.", "", $fulltextsearch_keyword_);
            $title1 = str_replace(".","",$fulltextsearch_keyword_);
            $title2 = str_replace("."," ",$fulltextsearch_keyword_);
            $fulltextsearch_keyword_ = $title1 . ", " . $title2;

        }

        $fulltextsearch_keyword[] = $fulltextsearch_keyword_;
        //$this->title = $backup;
        $addkeyword  = format_addApostWords($this->title);
        if ($addkeyword) $fulltextsearch_keyword[] = $addkeyword;
        unset($addkeyword);
                }      

        if ($this->keywords) {
            $string=str_replace(" || ", " ", $this->keywords);
            $fulltextsearch_keyword[] = $string;
            $addkeyword=format_addApostWords($string);
            if ($addkeyword!='')  $fulltextsearch_keyword[] =$addkeyword;
            unset($addkeyword);
        }

        if ($this->description) {
            $fulltextsearch_keyword[] = string_substr($this->description, 0, 100);
        }

        if ($this->address) {
                $fulltextsearch_where[] = $this->address;
        }

        if ($this->zip_code) {
                $fulltextsearch_where[] = $this->zip_code;
        }

        $_locations = explode(",", EDIR_LOCATIONS);

        foreach ($_locations as $each_location) {
            unset ($objLocation);
            $objLocationLabel = "Location".$each_location;
            $attributeLocation = 'location_'.$each_location;
            $objLocation = new $objLocationLabel;
            $objLocation->SetString("id", $this->$attributeLocation);
            $locationsInfo = $objLocation->retrieveLocationById();
            if ($locationsInfo["id"]) {
                $fulltextsearch_where[] = $locationsInfo["name"];
                if ($locationsInfo["abbreviation"]) {
                    $fulltextsearch_where[] = $locationsInfo["abbreviation"];
                }
            }
        }

        $categories = $this->getCategories(false, false, $this->id, true, true);

        DBQuery::execute(function() use($fulltextsearch_keyword, $fulltextsearch_where){
            $domain = DBConnection::getInstance()->getDomain();
            if (is_array($fulltextsearch_keyword)) {
                $fulltextsearch_keyword_sql = implode(" ", $fulltextsearch_keyword);
                $sql = $domain->prepare("UPDATE Listing "
                        . "SET fulltextsearch_keyword = :keyword "
                        . "WHERE id = :id");
                $sql->bindParam(':keyword', $fulltextsearch_keyword_sql);
                $sql->bindParam(':id', $this->id);
                $sql->execute();

                $sql = $domain->prepare("UPDATE Listing_Summary "
                        . "SET fulltextsearch_keyword = :keyword "
                        . "WHERE id = :id");
                $sql->bindParam(':keyword', $fulltextsearch_keyword_sql);
                $sql->bindParam(':id', $this->id);
                $sql->execute();

            }

            if (is_array($fulltextsearch_where)) {
                $fulltextsearch_where_sql = (implode(" ", $fulltextsearch_where));
                $sql = $domain->prepare("UPDATE Listing SET fulltextsearch_where = :where WHERE id = :id");
                $sql->bindParam(':where', $fulltextsearch_where_sql);
                $sql->bindParam(':id', $this->id);
                $sql->execute();

                $sql = $domain->prepare("UPDATE Listing_Summary SET fulltextsearch_where = :where WHERE id = :id");
                $sql->bindParam(':where', $fulltextsearch_where_sql);
                $sql->bindParam(':id', $this->id);
                $sql->execute();

                $sql = $domain->prepare("UPDATE Promotion SET fulltextsearch_where = :where WHERE listing_id = :id");
                $sql->bindParam(':where', $fulltextsearch_where_sql);
                $sql->bindParam(':id', $this->id);
                $sql->execute();
            }
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->getGalleries();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->getGalleries();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getGalleries
     * @access Public
     * @return array $galleries
     */
    function getGalleries() {
        return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Gallery_Item "
                    . "WHERE item_type='listing' AND item_id = :item_id "
                    . "ORDER BY gallery_id");
            $sql->bindParam(':item_id', $this->id);
            $sql->execute();
            if ($this->id > 0) {
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                    $galleries[] = $row["gallery_id"];
                }
            }
            
            return isset($galleries) ? $galleries : false;
        });
            
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setGalleries($gallery);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setGalleries($gallery);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setGalleries
     * @access Public
     * @param integer $gallery
     */
    function setGalleries($gallery = false) {
        DBQuery::execute(function() use ($gallery){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("DELETE FROM Gallery_Item "
                    . "WHERE item_type='listing' AND item_id = :item_id");
            $sql->bindParam(':item_id', $this->id);
            $sql->execute();
            
            if ($gallery) {
                $sql = $domain->prepare("INSERT INTO Gallery_Item (item_id, gallery_id, item_type) "
                        . "VALUES (:id, :gallery, 'listing')");
                $sql->bindParam(':id', $this->id);
                $sql->bindParam(':gallery', $gallery);
                $sql->execute();
            }
        });
            
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setMapTuning(...);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setMapTuning(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setMapTuning
     * @access Public
     * @param varchar $latitude_longitude
     * @param integer $map_zoom
     */
    function setMapTuning($latitude_longitude = "", $map_zoom) {
        DBQuery::execute(function() use ($latitude_longitude, $map_zoom){
            $domain = DBConnection::getInstance()->getDomain();
            $auxCoord = explode(",", $latitude_longitude);
            $latitude = $auxCoord[0];
            $longitude = $auxCoord[1];

            $sql = $domain->prepare("UPDATE Listing "
                    . "SET latitude = :latitude, longitude = :longitude, map_zoom = :map_zoom "
                    . "WHERE id = :id");
            $sql->execute(array(
                ':latitude' => $latitude,
                ':longitude'=> $longitude,
                ':map_zoom'     => $map_zoom,
                ':id'       => $this->id
            ));

            $sql = $domain->prepare("UPDATE Promotion "
                    . "SET listing_latitude = :latitude, listing_longitude = :longitude "
                    . "WHERE listing_id = :id");
            $sql->execute(array(
                ':latitude' => $latitude,
                ':longitude'=> $longitude,
                ':id'       => $this->id
            ));
        });
            
        /*
         * Populate Listings to front
         */
        unset($listingSummaryObj);
        $listingSummaryObj = new ListingSummary();
        $listingSummaryObj->PopulateTable($this->id, "update");
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setNumberViews($id);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setNumberViews($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setNumberViews
     * @access Public
     * @param integer $id
     */
    function setNumberViews($id) {
        DBQuery::execute(function() use ($id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE Listing "
                    . "SET number_views = :views "
                    . "WHERE Listing.id = :id");
            $sql->bindValue(':views', $this->number_views + 1);
            $sql->bindParam(':id', $id);
            $sql->execute();
            
            $sql = $domain->prepare("UPDATE Listing_Summary "
                    . "SET number_views = :views "
                    . "WHERE Listing_Summary.id = :id");
            $sql->bindValue(':views', $this->number_views + 1);
            $sql->bindParam(':id', $id);
            $sql->execute();
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->setAvgReview(...);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->setAvgReview(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setAvgReview
     * @access Public
     * @param integer $avg
     * @param integer $id
     */
    function setAvgReview($avg, $id, $count = null ) {
        DBQuery::execute(function() use ($avg, $id, $count){
            $domain = DBConnection::getInstance()->getDomain();
            if($count){
                $sql = $domain->prepare("UPDATE Listing "
                        . "SET avg_review = :avg, review_count = :count, updated = current_timestamp() "
                        . "WHERE Listing.id = :id");
                $sql->execute(array(
                    ':avg' => $avg,
                    ':count' => $count,
                    ':id'   => $id
                ));
                $sql = $domain->prepare("UPDATE Listing_Summary "
                        . "SET avg_review = :avg, review_count = :count, updated = current_timestamp() "
                        . "WHERE Listing_Summary.id = :id");
                $sql->execute(array(
                    ':avg' => $avg,
                    ':count' => $count,
                    ':id'   => $id
                ));
            } 
            else {
                $sql = $domain->prepare("UPDATE Listing SET avg_review = :avg WHERE Listing.id = :id");
                $sql->execute(array(
                    ':avg' => $avg,
                    ':id'   => $id
                ));
                $sql = $domain->prepare("UPDATE Listing_Summary SET avg_review = :avg WHERE Listing_Summary.id = :id");
                $sql->execute(array(
                    ':avg' => $avg,
                    ':id'   => $id
                ));
            }
        });    

        /*
         * Populate Listings to front
         */
        unset($listingSummaryObj);
        $listingSummaryObj = new ListingSummary();
        $listingSummaryObj->PopulateTable($id, "update");
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->hasDetail();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->hasDetail();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasDetail
     * @access Public
     * @return mixed $detail
     */
    function hasDetail() {
            $listingLevel = new ListingLevel();
            $detail = $listingLevel->getDetail($this->level);
            unset($listingLevel);
            return $detail;
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->deletePerAccount($account_id);
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     * @param integer $domain_id
     */
    function deletePerAccount($account_id = 0, $domain_id = false) {
        if (is_numeric($account_id) && $account_id > 0) {
            DBQuery::execute(function() use ($account_id, $domain_id){
                $domain = DBConnection::getInstance()->getDomain();
                $sql = $domain->prepare("SELECT * FROM Listing WHERE account_id = :account_id");
                $sql->bindParam(':account_id', $account_id);
                $sql->execute();
                while ($row = $sql->fetch(\PDO::FETCH_BOTH)) {
                    $this->makeFromRow($row);
                    $this->Delete($domain_id);
                } 
            });
        }
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->SaveToFeaturedTemp();
     * <br /><br />
     *		//Using this in Listing() class.
     *		$this->SaveToFeaturedTemp();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name SaveToFeaturedTemp
     * @access Public
     */
    function SaveToFeaturedTemp() {
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("INSERT INTO Listing_FeaturedTemp (listing_id,status) VALUES (:id,'R')");
            $sql->bindParam(':id', $this->id);
            $sql->execute();
        });
    }

/**
         * <code>
         *		//Using this in forms or other pages.
         *		$listingObj->removePromotionID();
         * <br /><br />
         *		//Using this in Listing() class.
         *		$this->removePromotionID();
         * </code>
         * @copyright Copyright 2005 Arca Solutions, Inc.
         * @author Arca Solutions, Inc.
         * @version 8.0.00
         * @name removePromotionID
         * @access Public
         */
    function removePromotionID() {
        if (!$this->id){
            return false;
        }
        return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            /*
            * Clear Promotion table
            */
           $sql = $domain->prepare("UPDATE Promotion SET    fulltextsearch_where = '',
                        listing_id = 0, 
                        listing_status = '', 
                        listing_level = 0, 
                        listing_location1 = 0, 
                        listing_location2 = 0, 
                        listing_location3 = 0, 
                        listing_location4 = 0, 
                        listing_location5 = 0, 
                        listing_address = '', 
                        listing_address2 = '', 
                        listing_zipcode = '', 
                        listing_zip5 = '0', 
                        listing_latitude = '', 
                        listing_longitude = ''
                   WHERE id = :id");
           $sql->bindParam(':id', $this->promotion_id);
           $sql->execute();

           /**
            * Clear Listing Table
            */
           $sql_1 = $domain->prepare("UPDATE Listing SET promotion_id = 0 WHERE id = :id");
           $sql_1->bindParam(':id', $this->id);
           $res1 = $sql_1->execute();
           
           $sql_2 = $domain->prepare("UPDATE Listing_Summary SET promotion_id = 0, promotion_start_date = '0000-00-00', promotion_end_date = '0000-00-00' WHERE id = :id");
           $sql_2->bindParam(':id', $this->id);
           $res2 = $sql_2->execute();
           
           if($res1 && $res2){
               return true;
           }
        });
        
    }


    /**
    * <code>
    *		//Using this in forms or other pages.
    *		$listingObj->getListingByFriendlyURL($friendly_url);
    * <br /><br />
    *		//Using this in Listing() class.
    *		$this->getListingByFriendlyURL($friendly_url);
    * </code>
    * @copyright Copyright 2005 Arca Solutions, Inc.
    * @author Arca Solutions, Inc.
    * @version 8.0.00
    * @name getListingByFriendlyURL
    * @param string $friendly_url
    * @access Public
    */
    function getListingByFriendlyURL($friendly_url) {
        $result =  DBQuery::execute(function() use ($friendly_url){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing WHERE friendly_url = :friendly_url");
            $sql->bindParam(':friendly_url', $friendly_url);
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_ASSOC);
        });
        if ($result) {
            $this->makeFromRow($result);
            return true;
        } else {
            return false;
        }
    }

    public static function DoGetListingByFriendlyURL($friendly_url) {
        return  DBQuery::execute(function() use ($friendly_url){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing WHERE friendly_url = :friendly_url");
            $sql->bindParam(':friendly_url', $friendly_url);
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_ASSOC); // returns false if unsuccessful
        });
    }
    
    
     public static function GetListing($id) {
        return  DBQuery::execute(function() use ($id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing WHERE id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_ASSOC); // returns false if unsuccessful
        });
    }
    

    public static function GetListingByTitle($title) {
        return  DBQuery::execute(function() use ($title){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing WHERE title = :title");
            $sql->bindParam(':title', $title);
            $sql->execute();
            return $sql->fetch(\PDO::FETCH_ASSOC); // returns false if unsuccessful
        });
    }

    /**
    * <code>
    *		//Using this in forms or other pages.
    *		$listingObj->getListingToApp($array_get, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
    * <br /><br />
    *		//Using this in Listing() class.
    *		$this->getListingToApp($array_get, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
    * </code>
    * @copyright Copyright 2005 Arca Solutions, Inc.
    * @author Arca Solutions, Inc.
    * @version 8.0.00
    * @name getListingToApp
    * @access Public
    */
    function getListingToApp($account_id = false) {

        if ($this->id > 0 && $this->status == 'A') {

            /**
             * Fields to detail page
             */
            unset($aux_detail_fields);

            $aux_detail_fields[] = "id";
            $aux_detail_fields[] = "title";
            $aux_detail_fields[] = "email";
            $aux_detail_fields[] = "phone";
            $aux_detail_fields[] = "url";
            $aux_detail_fields[] = "latitude";
            $aux_detail_fields[] = "longitude";
            $aux_detail_fields[] = "description";
            $aux_detail_fields[] = "long_description";
            $aux_detail_fields[] = "level";
            $aux_detail_fields[] = "fax";
            $aux_detail_fields[] = "avg_review";
            $aux_detail_fields[] = "video_snippet";
            $aux_detail_fields[] = "video_description";
            if (API_IN_USE == "api2") {
                $aux_detail_fields[] = "status";
            }

            /*
             * Number fields
             */
            unset($number_fields);
            $number_fields[] = "latitude";
            $number_fields[] = "longitude";
            $number_fields[] = "level";
            $number_fields[] = "avg_review";
            $number_fields[] = "id";
            $number_fields[] = "promotion_id";

            unset($add_info);
            $locationsToshow = system_retrieveLocationsToShow();
            $locationsParam = "A, B, ".system_formatLocation($locationsToshow.", z");

            $add_info["location_information"] = $this->getLocationString($locationsParam, true);

            foreach ($this->data_in_array as $key => $value) {

                if (strpos($key, "image_id") !== false) {
                    unset($imageObj);
                    $imageObj = new Image($value);
                    if ($imageObj->imageExists()) {
                        $add_info["imageurl"] = $imageObj->getPath();
                    } else {
                        $firstGalImage = system_getImageFromGallery("listing", $this->id);
                        if ($firstGalImage) {
                            $add_info["imageurl"] = $firstGalImage;
                        } else {
                            $add_info["imageurl"] = NULL;
                        }
                    }
                } elseif($key == "promotion_id") {

                    unset($promotionObj, $promotionInfo);
                    $promotionObj = new Promotion($value);
                    $promotionInfo = $promotionObj->getDealByListing($this->id);
                    $arrayDealInfo = array();

                    if ((!validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) || (!validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
                        $add_info["deal_name"]          = "";   
                        $add_info["deal_remaining"]     = 0;
                        $add_info["deal_price"]         = 0;
                        $add_info["deal_description"]   = "";
                        $add_info["deal_realvalue"]     = 0;
                        $add_info["deal_id"]            = 0;
                        $add_info["deal_discount"]      = "";
                        $thisHasDeal = false;
                    } else {

                        $add_info["deal_name"]          = $promotionObj->getString("name");
                        $add_info["deal_remaining"]     = (float)$promotionInfo["deal_info"]["left"];
                        $add_info["deal_price"]         = (float)$promotionObj->getNumber("dealvalue");
                        $add_info["deal_description"]   = $promotionObj->getString("long_description");
                        $add_info["deal_realvalue"]     = (float)$promotionObj->getNumber("realvalue");
                        $add_info["deal_id"]            = (float)$value;
                        $thisHasDeal = true;

                        /**
                         * Calculate percentage
                         */
                        if ($promotionObj->realvalue > 0) {
                            $aux_percentage = round(100-(($promotionObj->dealvalue*100)/$promotionObj->realvalue));
                        } else {
                            $aux_percentage = 0;
                        }
                        $add_info["deal_discount"] = $aux_percentage."%";
                    }

                    if (API_IN_USE == "api3") {

                        $imageObj = new Image($promotionObj->getNumber("image_id"));

                        $arrayDealInfo["id"] = $add_info["deal_id"];
                        $arrayDealInfo["title"] = $add_info["deal_name"];
                        if ($imageObj->imageExists()) {
                            $arrayDealInfo["imageurl"] = $imageObj->getPath();
                        }
                        $arrayDealInfo["remaining"] = $add_info["deal_remaining"];
                        $arrayDealInfo["description"] = $promotionObj->getString("description");
                        $arrayDealInfo["long_description"] = $add_info["deal_description"];
                        $arrayDealInfo["start_date"] = $promotionObj->getString("start_date");
                        $arrayDealInfo["end_date"] = $promotionObj->getString("end_date");
                        $arrayDealInfo["conditions"] = $promotionObj->getString("conditions");
                        $arrayDealInfo["dealvalue"] = $add_info["deal_price"];
                        $arrayDealInfo["realvalue"] = $add_info["deal_realvalue"];
                        $arrayDealInfo["discount"] = $add_info["deal_discount"];
                        $arrayDealInfo["avg_review"] = (int)$promotionObj->getNumber("avg_review");
                        $arrayDealInfo["friendly_url"] = PROMOTION_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$promotionObj->getNumber("listing_id");
                        if ($account_id) {
                            $arrayDealInfo["redeem_code"] = $promotionObj->alreadyRedeemed($promotionObj->getNumber("id"), $account_id);
                        }
                        /**
                        * Get number of Reviews
                        */
                        unset($reviewObj);
                        $reviewObj = new Review();
                        $reviewObj->item_type = "promotion";
                        $reviewObj->item_id = $promotionObj->getNumber("id");
                        $arrayDealInfo["total_reviews"] = (float)$reviewObj->GetTotalReviewsByItemID();
                        $add_info["deal"] = ($thisHasDeal ? $arrayDealInfo : NULL);
                        unset($add_info["deal_name"], $add_info["deal_remaining"], $add_info["deal_price"], $add_info["deal_description"], $add_info["deal_realvalue"], $add_info["deal_id"], $add_info["deal_discount"]);
                    } 

                }

                /**
                 * Get just fields to show on detail App
                 */
                if (!is_numeric($key) && in_array($key, $aux_detail_fields)) {

                    if ($key != "image_id") {
                        if (is_array($aux_fields)) {
                            $add_info[array_search($key, $aux_fields)] = ((is_numeric($value) && in_array($key,$number_fields)) ? (float)$value : $value);
                        } else {
                            $add_info[$key] = ((is_numeric($value) && in_array($key,$number_fields)) ? (float)$value : $value);
                        }
                    }
                }
            }

            /**
             * Get galleries
             */
            unset($aux_galleries);

            $aux_galleries = $this->getGalleries();
            if (is_array($aux_galleries)) {

                $galleryObj = new Gallery();

                for ($i = 0; $i < count($aux_galleries); $i++) {

                    $images = $galleryObj->getAllImages($aux_galleries[$i]);

                    if (is_array($images)) {

                        $k = 0;
                        for ($j = 0; $j < count($images); $j++) {

                            unset($imageObj);
                            $imageObj = new Image($images[$j]["image_id"]);
                            if ($imageObj->imageExists()) {
                                $add_info["gallery"][$k]["imageurl"] = $imageObj->getPath();
                                $add_info["gallery"][$k]["caption"] = $images[$j]["image_caption"];
                                $k++;
                            }    

                        }                       
                    }
                }
            }

            /**
             * Get number of Reviews
             */
            unset($reviewObj);
            $reviewObj = new Review();
            $reviewObj->item_type = "listing";
            $reviewObj->item_id = $this->id;
            $add_info["total_reviews"] = (float)$reviewObj->GetTotalReviewsByItemID();

            /**
             * Get number of Checkins
             */
            unset($checkinObj);
            $checkinObj = new Checkin();
            $checkinObj->item_id = $this->id;
            $add_info["total_checkins"] = (float)$checkinObj->GetTotalCheckinsByItemID();

            /**
             * Get categories 
             */
            unset($listingCategoriesObj);
            $listingCategoriesObj = new Listing_Category();
            $listingCategories = $listingCategoriesObj->getCategoriesByListingID($this->id);
            if ($listingCategories) {
                $add_info["categories"] = $listingCategories;
            } else {
                $add_info["categories"] = NULL;
            }

            /**
             * Preparing friendly URL
             */
            $add_info["friendly_url"] = LISTING_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$this->friendly_url;

            if (is_array($add_info)) {
                return $add_info;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    /**
    * <code>
    *		//Using this in forms or other pages.
    *		$listingObj->GetInfoToApp($array_get, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
    * <br /><br />
    *		//Using this in Listing() class.
    *		$this->GetInfoToApp($array_get, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
    * </code>
    * @copyright Copyright 2005 Arca Solutions, Inc.
    * @author Arca Solutions, Inc.
    * @version 8.0.00
    * @name GetInfoToApp
     * @param array $array_get
     * @param array $aux_returnArray
     * @param array $aux_fields
     * @param array $items
     * @param array $auxTable
     * @param array $aux_Where
    * @access Public
    */
    function GetInfoToApp($array_get, &$aux_returnArray, &$aux_fields, &$items, &$auxTable, &$aux_Where) {

        extract($array_get);

        /**
         * Prepare columns with alias
         */
        if (is_array($aux_fields)) {

            unset($fields_to_map);

            foreach ($aux_fields as $key => $value) {
                if (strpos($value, " AS ") !== false) {
                    $fields_to_map[] = $value;
                } else {
                    $fields_to_map[] = $value." AS `".$key."`";
                }
            }
        }

        if ($id) {

            /*
             * Get Listing
             */
            unset($listingObj, $listingInfo);
            $listingObj = new Listing($id);

            $listingInfo = $listingObj->getListingToApp($account_id);

            if (!is_array($listingInfo)) {

                $aux_returnArray[(API_IN_USE == "api2" ? "error" : "message")]         = "No results found.";
                $aux_returnArray["type"]            = $resource;
                $aux_returnArray["total_results"]   = 0; 
                $aux_returnArray["total_pages"]     = 0; 
                $aux_returnArray["results_per_page"]= 0; 

            } else {
                $items[] = $listingInfo;
                $aux_returnArray["type"]            = $resource;
                $aux_returnArray["total_results"]   = 1; 
                $aux_returnArray["total_pages"]     = 1; 
                $aux_returnArray["results_per_page"]= 1;
            }

        } else {

            $auxTable = "Listing_Summary";
            $aux_Where[] = "status = 'A'";

            if (API_IN_USE == "api2") {
                $aux_orderBy[] = "level";
                $aux_orderBy[] = "title";
            }

            if ($featured) {
                $level = implode(",", system_getLevelDetail("ListingLevel"));
                if ($level) {
                   $aux_Where[] = "level IN ($level)"; 
                } else {
                    $aux_Where[] = "id IN (0)";
                }
            }

        }

        if ($searchBy) {
            if ($searchBy == "keyword" || $searchBy == "keyword_where") {

                unset($searchReturn);
                $searchReturn["from_tables"]    = "Listing_Summary";
                $searchReturn["order_by"]       = "Listing_Summary.level";
                $searchReturn["where_clause"]   = "Listing_Summary.status = 'A' ";
                $searchReturn["select_columns"] = implode(", ", $aux_fields);
                $searchReturn["group_by"]       = false;

                $letterField = "title";
                search_frontListingAppKeyword($array_get, $searchReturn);

                $pageObj = new pageBrowsing($searchReturn["from_tables"], $page, $aux_results_per_page, $searchReturn["order_by"], $letterField, $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing_Summary", $searchReturn["group_by"]);

                $items = $pageObj->retrievePage("array");

                if (!is_array($items)) {
                    $aux_returnArray[(API_IN_USE == "api2" ? "error" : "message")]     = "No results found.";
                }

                $aux_returnArray["type"]            = $resource;
                $aux_returnArray["total_results"]   = $pageObj->record_amount; 
                $aux_returnArray["total_pages"]     = $pageObj->pages; 
                $aux_returnArray["results_per_page"]= $pageObj->limit; 


            } elseif (($searchBy == "map" || $searchBy == "map_review") && ($drawLat0 && $drawLat1 && $drawLong0 && $drawLong1)) {

                /**
                 * Search on map with coordinates and / or keyword
                 */
                $letterField = "title";
                $searchReturn = search_frontListingDrawMap($array_get, "listing_results_api", $fields_to_map, ($searchBy == "map_review" ? true : false));
                $pageObj = new pageBrowsing($searchReturn["from_tables"], $page, $aux_results_per_page, $searchReturn["order_by"], $letterField, $letter, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing_Summary", $searchReturn["group_by"]);

                $items = $pageObj->retrievePage("array");

                if (!is_array($items)) {
                    $aux_returnArray[(API_IN_USE == "api2" ? "error" : "message")]     = "No results found.";
                }

                $aux_returnArray["type"]            = $resource;
                $aux_returnArray["total_results"]   = $pageObj->record_amount; 
                $aux_returnArray["total_pages"]     = $pageObj->pages; 
                $aux_returnArray["results_per_page"]= $pageObj->limit; 


            } elseif ($searchBy == "category" && $category_id) {

                /*
                 * Get Listing by category_id
                 */

                //Create a category object to get hierarchy of categories
                unset($aux_categoryObj, $aux_cat_hierarchy);
                $aux_categoryObj = new ListingCategory($category_id);
                $aux_cat_hierarchy = $aux_categoryObj->getHierarchy($category_id, false, true);
                if ($aux_cat_hierarchy) {
                    unset($listing_CategoryObj);
                    $listing_CategoryObj = new Listing_Category();
                    $listings_id = $listing_CategoryObj->getListingsByCategoryHierarchy($aux_categoryObj->root_id,$aux_categoryObj->left,$aux_categoryObj->right);
                }

                if ($listings_id) {
                    $aux_Where[] = " id in (".$listings_id.")";
                    unset($searchReturn);
                    $searchReturn["from_tables"]    = "Listing_Summary";
    //                        search_prepareFilters($array_get, $searchReturn, "Listing_Summary", $aux_Where);
                } else {
                    $aux_returnArray[(API_IN_USE == "api2" ? "error" : "message")] = "No results found.";
                }

            } else {
                $return["type"]             = $resource;
                $return["total_results"]    = 0;
                $return["total_pages"]      = 0;
                $return["results_per_page"] = 0;
                $return["success"]          = FALSE;
                $return["message"]          = "Wrong Search, check the parameters";
                api_formatReturn($return);
            }
        }
    }

    #----------------------------------------
    # Functions for View Location
    #----------------------------------------

    public function GiveMeNumberOfReviews($location_4, $start_from, $number_of_results_per_page){

        if( !empty($location_4) && is_numeric($location_4) ){
            
            return DBQuery::execute(function() use ($location_4, $start_from, $number_of_results_per_page){
                $domain = DBConnection::getInstance()->getDomain();
                
                $sql = $domain->prepare("SELECT li.id, li.title, li.friendly_url, li.avg_review, li.review_count
                                 FROM Listing li
                                 where li.location_4 = :location4
                                 order by li.avg_review desc, li.title
                                 LIMIT :start, :no_of_res");
                $sql->bindParam(':location4', $location_4);
                $sql->bindValue(':start', (int)$start_from, \PDO::PARAM_INT);
                $sql->bindValue(':no_of_res', (int)$number_of_results_per_page, \PDO::PARAM_INT);
                $sql->execute();
                
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            });
        }
        else{
            return array();
        }

    }


    public function getmeTotalLocationWise($location_4){

        if( !empty($location_4) && is_numeric($location_4) ){
            return DBQuery::execute(function() use ($location_4){
                $domain = DBConnection::getInstance()->getDomain();
                
                $sql = $domain->prepare("SELECT COUNT(*) as total FROM 
                            (SELECT li.id, li.title, li.friendly_url, li.avg_review
                            FROM Listing li
                            where li.location_4 = :location4
                            ) AS subquery");
                $sql->bindParam(':location4', $location_4);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                
                return $row['total'];
            });
        }
        else {
            return 0;
        }

    }


    public function GetTrendingListings($location_1){
        return DBQuery::execute(function() use ($location_1){
            $domain = DBConnection::getInstance()->getDomain();
            $domainDb = DBConnection::getInstance()->getDomainDatabaseName();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
            $query = "SELECT item_id, 
                                    li.title, 
                                    li.location_3_title,
                                    li.location_4_title,
                                    li.friendly_url, 
                                    lis.avg_review as average_rating,
                                    lis.review_count as number_of_review
                FROM $domainDb.Review re
                left outer join $domainDb.Listing_Summary li   on re.item_id = li.id
                left outer join $domainDb.Listing lis  on re.item_id = lis.id    
                left outer join $mainDb.Account ac on ac.id = re.member_id
                where ac.active = 'y'
                and re.is_deleted != 1
                and re.approved = 1 and re.status = 'A'";

            if($location_1 == 0) {	
                $query .= " and li.custom_checkbox1 = :location1 ";
            } else {
                $query .= " and li.location_1 = :location1 ";     			
            }

            $query .= " group by item_id,li.title, li.location_3_title, li.location_4_title, li.friendly_url 
                order by re.added desc
                LIMIT 0, 10";

		$sql = $domain->prepare($query);
		
		if($location_1 == 0) {	
            		$sql->bindValue(':location1', 'y');
		} else {
            		$sql->bindParam(':location1', $location_1);   			
		}
                                
            $sql->execute();
            
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        });
    }
    
      public static function getBusinessNameFromListingId($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT title FROM Listing where id = :listing_id ");
            $sql->bindParam(':listing_id', $listing_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['title'];
        });
    }
    

    public static function getListingCountByAccountId($account_id){
        return DBQuery::execute(function() use ($account_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT count(*) as count FROM Listing WHERE account_id =:account_id");
            $sql->bindParam(":account_id", $account_id);
            $sql->execute();
            $result = $sql->fetch(\PDO::FETCH_ASSOC);
            
            return $result['count'];
        });
    }

 
    
        public static function is_owner($listing_id, $account_id){
        return DBQuery::execute(function() use ($listing_id, $account_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT account_id FROM Listing where id = :id");
            $sql->bindParam(':id', $listing_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            if($row['account_id'] > 0){
                return true;
            }

            return false;
        });      
    }
    
    

    public function getFriendlyUrl($listing_id){

     return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT friendly_url FROM Listing where id = :id ");
            $sql->bindParam(':id', $listing_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['friendly_url'];
        });

    }

    public static function getListingFromSubscriptionID($subscription_id){
        return DBQuery::execute(function() use ($subscription_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT id FROM Listing where custom_text2 = :subs ");
            $sql->bindParam(':subs', $subscription_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['id'];
        });
    }
    
    public static function getListingFromID($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT title FROM Listing where id = :listing_id ");
            $sql->bindParam(':listing_id', $listing_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['title'];
        });
    }
    
    
      public static function getAppIdFromListingId($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql    = $domain->prepare("SELECT custom_dropdown5 FROM Listing where id = :listing_id ");
            $sql->bindParam(':listing_id', $listing_id);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            return $row['custom_dropdown5'];
        });
    }

    public function getCurrencyAndSymbol()
    {
        // if its a global set dollars
        if($this->custom_checkbox1 == 'y'){
            return array('currency' => 'USD', 'symbol' => '$');
        }
        else if($this->location_1){
            return DBQuery::execute(function(){
                $main = DBConnection::getInstance()->getMain();
                $sql = $main->prepare("SELECT currency, symbol FROM Location_1 "
                    . "WHERE id=:id");
                $sql->bindParam(':id', $this->location_1);
                $sql->execute();
                
                return $sql->fetch(\PDO::FETCH_BOTH);
            });
        }
        else{
            return array('currency' => 'USD', 'symbol' => '$');
        }        
    }
    
    public static function GetListingDetails($listing_id){
//        return DBQuery::execute(function() use ($listing_id){
            $domain = DBConnection::getInstance()->getDomain();
            $domainDb = DBConnection::getInstance()->getDomainDatabaseName();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
            $query = "SELECT * 
                FROM $domainDb.Listing li
                left join $mainDb.Location_3 l03 on li.location_3 = l03.id
                left join $mainDb.Location_4 l04 on li.location_4 = l04.id";
		$sql = $domain->prepare($query);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
//        });
    }
    
    
    

}
?>