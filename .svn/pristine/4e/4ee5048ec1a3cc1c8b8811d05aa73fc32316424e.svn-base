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
# * FILE: /classes/class_ListingSummary.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$listingObj = new ListingSummary($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name ListingSummary
 * @method ListingSummary
 * @method makeFromRow
 * @method Add
 * @method Update
 * @method Delete
 * @method PopulateTable
 * @method PopulateTableCategory
 * @method PopulateTableLocation
 * @access Public
 */
class ListingSummary extends Handle {
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
        var $location_1;
        /**
         * @var varchar
         * @access Private
         */
        var $location_1_title;
        /**
         * @var varchar
         * @access Private
         */
        var $location_1_abbreviation;
        /**
         * @var varchar
         * @access Private
         */
        var $location_1_friendly_url;
        /**
         * @var integer
         * @access Private
         */
        var $location_2;
        /**
         * @var varchar
         * @access Private
         */
        var $location_2_title;
        /**
         * @var varchar
         * @access Private
         */
        var $location_2_abbreviation;
        /**
         * @var varchar
         * @access Private
         */
        var $location_2_friendly_url;
        /**
         * @var integer
         * @access Private
         */
        var $location_3;
        /**
         * @var varchar
         * @access Private
         */
        var $location_3_title;
        /**
         * @var varchar
         * @access Private
         */
        var $location_3_abbreviation;
        /**
         * @var varchar
         * @access Private
         */
        var $location_3_friendly_url;
        /**
         * @var integer
         * @access Private
         */
        var $location_4;
        /**
         * @var varchar
         * @access Private
         */
        var $location_4_title;
        /**
         * @var varchar
         * @access Private
         */
        var $location_4_abbreviation;
        /**
         * @var varchar
         * @access Private
         */
        var $location_4_friendly_url;
        /**
         * @var integer
         * @access Private
         */
        var $location_5;
        /**
         * @var varchar
         * @access Private
         */
        var $location_5_title;
        /**
         * @var varchar
         * @access Private
         */
        var $location_5_abbreviation;
        /**
         * @var varchar
         * @access Private
         */
        var $location_5_friendly_url;

        /**
         * @var varchar
         * @access Private
         */
        var $title;
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
         * @var char
         * @access Private
         */
        var $show_email;
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
         * @var double
         * @access Private
         */
        var $latitude;
        /**
         * @var double
         * @access Private
         */
        var $longitude;
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
        var $attachment_file;
        /**
         * @var varchar
         * @access Private
         */
        var $attachment_caption;
        /**
         * @var char
         * @access Private
         */
        var $status;
        /**
         * @var date
         * @access Private
         */
        var $renewal_date;
        /**
         * @var integer
         * @access Private
         */
        var $level;
        /**
         * @var integer
         * @access Private
         */
        var $random_number;
        /**
         * @var char
         * @access Private
         */
        var $claim_disable;
        /**
         * @var varchar
         * @access Private
         */
        var $locations;
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

        var $fulltextsearch_keyword;
        /**
         * @var varchar
         * @access Private
         */
        var $fulltextsearch_where;
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
/**
         * @var integer
         * @access Private
         */
        var $price;
        /**
         * @var date
         * @access Private
         */
        var $promotion_start_date;
        /**
         * @var date
         * @access Private
         */
        var $promotion_end_date;
        /**
         * @var integer
         * @access Private
         */
        var $thumb_id;
        /**
         * @var varchar
         * @access Private
         */
        var $thumb_type;
        /**
         * @var integer
         * @access Private
         */
        var $thumb_width;
        /**
         * @var integer
         * @access Private
         */
        var $thumb_height;
        /**
         * @var integer
         * @access Private
         */
        var $listingtemplate_id;
        /**
         * @var integer
         * @access Private
         */
        var $template_layout_id;
        /**
         * @var integer
         * @access Private
         */
        var $template_cat_id;
        /**
         * @var varchar
         * @access Private
         */
        var $template_title;
        /**
         * @var varchar
         * @access Private
         */
        var $template_status;
        /**
         * @var integer
         * @access Private
         */
        var $image_id;
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
         * @var integer
         * @access Private
         */
        var $promotion_id;
        /**
         * @var integer
         * @access Private
         */
        var $domain_id;
        /**
         * @var char
         * @access Private
         */
        var $backlink;
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

        var $fulltextsearch_what;
    /**
     * <code>
     *		$listingObj = new ListingSummary($id);
     *		//OR
     *		$listingObj = new ListingSummary($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name ListingSummary
     * @access Public
     * @param mixed $var
     */
    function __construct($var='') {

        if (is_numeric($var) && ($var)) {
            $row = $this->loadListing($var);
            $this->makeFromRow($row);
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }
    
    private function loadListing($var){
        return DBQuery::execute(function() use ($var){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("SELECT * FROM Listing_Summary WHERE id = :id");
            $sql->bindParam(':id', $var);
            $sql->execute();
            
            return $sql->fetch(\PDO::FETCH_BOTH);
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
         * @param array $row
         */
        function makeFromRow($row='') {
                $this->id								= isset($row["id"])						? $row["id"]							: 0;
                $this->account_id						= isset($row["account_id"])				? $row["account_id"]					: 0;

                $this->location_1						= isset($row["location_1"])				? $row["location_1"]					: 0;
                $this->location_1_title					= isset($row["location_1_title"])		? $row["location_1_title"]				: "";
                $this->location_1_abbreviation			= isset($row["location_1_abbreviation"])	? $row["location_1_abbreviation"]		: "";
                $this->location_1_friendly_url			= isset($row["location_1_friendly_url"])	? $row["location_1_friendly_url"]		: "";

                $this->location_2						= isset($row["location_2"])				? $row["location_2"]					: 0;
                $this->location_2_title					= isset($row["location_2_title"])		? $row["location_2_title"]				: "";
                $this->location_2_abbreviation			= isset($row["location_2_abbreviation"])	? $row["location_2_abbreviation"]		: "";
                $this->location_2_friendly_url			= isset($row["location_2_friendly_url"])	? $row["location_2_friendly_url"]		: "";

                $this->location_3						= isset($row["location_3"])				? $row["location_3"]					: 0;
                $this->location_3_title					= isset($row["location_3_title"])		? $row["location_3_title"]				: "";
                $this->location_3_abbreviation			= isset($row["location_3_abbreviation"])	? $row["location_3_abbreviation"]		: "";
                $this->location_3_friendly_url			= isset($row["location_3_friendly_url"])	? $row["location_3_friendly_url"]		: "";

                $this->location_4						= isset($row["location_4"])				? $row["location_4"]					: 0;
                $this->location_4_title					= isset($row["location_4_title"])		? $row["location_4_title"]				: "";
                $this->location_4_abbreviation			= isset($row["location_4_abbreviation"])	? $row["location_4_abbreviation"]		: "";
                $this->location_4_friendly_url			= isset($row["location_4_friendly_url"])	? $row["location_4_friendly_url"]		: "";

                $this->location_5						= isset($row["location_5"])				? $row["location_5"]					: 0;
                $this->location_5_title					= isset($row["location_5_title"])		? $row["location_5_title"]				: "";
                $this->location_5_abbreviation			= isset($row["location_5_abbreviation"])	? $row["location_5_abbreviation"]		: "";
                $this->location_5_friendly_url			= isset($row["location_5_friendly_url"])	? $row["location_5_friendly_url"]		: "";

                $this->title							= isset($row["title"])					? $row["title"]							: "";
                $this->friendly_url						= isset($row["friendly_url"])			? $row["friendly_url"]					: "";
                $this->email							= isset($row["email"])					? $row["email"]							: "";
                $this->url								= isset($row["url"])						? $row["url"]							: "";
                $this->display_url						= isset($row["display_url"])				? $row["display_url"]					: "";
                $this->address							= isset($row["address"])					? $row["address"]						: "";
                $this->address2							= isset($row["address2"])				? $row["address2"]						: "";
                $this->zip_code							= isset($row["zip_code"])				? $row["zip_code"]						: "";
                $this->phone							= isset($row["phone"])					? $row["phone"]							: "";
                $this->fax								= isset($row["fax"])						? $row["fax"]							: "";

                $this->description						= isset($row["description"])             ? $row["description"]					: "";

                $this->show_email						= isset($row["show_email"])				? $row["show_email"]						: "";
                $this->zip5								= isset($row["zip5"])					? $row["zip5"]								: "";
                $this->latitude							= isset($row["latitude"])				? $row["latitude"]							: "";
                $this->longitude						= isset($row["longitude"])				? $row["longitude"]							: "";

                $this->attachment_file					= isset($row["attachment_file"])			? $row["attachment_file"]					: "";
                $this->attachment_caption				= isset($row["attachment_caption"])		? $row["attachment_caption"]				: "";
                $this->status							= isset($row["status"])					? $row["status"]							: "";
                $this->setDate("renewal_date", isset($row["renewal_date"]) ? $row["renewal_date"] : '0000-00-00');
                $this->level							= isset($row["level"])					? $row["level"]								: "";
                $this->random_number					= isset($row["random_number"])			? $row["random_number"]						: 0;
                $this->claim_disable					= isset($row["claim_disable"])			? $row["claim_disable"]						: "n";
                $this->locations						= isset($row["locations"])				? $row["locations"]							: "";

                $this->keywords                         = isset($row["keywords"])				? $row["keywords"]								: "";

                $this->seo_keywords                     = isset($row["seo_keywords"])			? $row["seo_keywords"]							: ($this->seo_keywords		? $this->seo_keywords		: "");

                $this->fulltextsearch_keyword			= isset($row["fulltextsearch_keyword"])	? $row["fulltextsearch_keyword"]				: "";
                $this->fulltextsearch_where				= isset($row["fulltextsearch_where"])	? $row["fulltextsearch_where"]					: "";

    $this->custom_checkbox0					= isset($row["custom_checkbox0"])		? $row["custom_checkbox0"]		: "";
                $this->custom_checkbox1					= isset($row["custom_checkbox1"])		? $row["custom_checkbox1"]		: "";
                $this->custom_checkbox2					= isset($row["custom_checkbox2"])		? $row["custom_checkbox2"]		: "";
                $this->custom_checkbox3					= isset($row["custom_checkbox3"])		? $row["custom_checkbox3"]		: "";
                $this->custom_checkbox4					= isset($row["custom_checkbox4"])		? $row["custom_checkbox4"]		: "";
                $this->custom_checkbox5					= isset($row["custom_checkbox5"])		? $row["custom_checkbox5"]		: "";
                $this->custom_checkbox6					= isset($row["custom_checkbox6"])		? $row["custom_checkbox6"]		: "";
                $this->custom_checkbox7					= isset($row["custom_checkbox7"])		? $row["custom_checkbox7"]		: "";
                $this->custom_checkbox8					= isset($row["custom_checkbox8"])		? $row["custom_checkbox8"]		: "";
                $this->custom_checkbox9					= isset($row["custom_checkbox9"])		? $row["custom_checkbox9"]		: "";
                $this->custom_dropdown0					= isset($row["custom_dropdown0"])		? $row["custom_dropdown0"]		: "";
                $this->custom_dropdown1					= isset($row["custom_dropdown1"])		? $row["custom_dropdown1"]		: "";
                $this->custom_dropdown2					= isset($row["custom_dropdown2"])		? $row["custom_dropdown2"]		: "";
                $this->custom_dropdown3					= isset($row["custom_dropdown3"])		? $row["custom_dropdown3"]		: "";
                $this->custom_dropdown4					= isset($row["custom_dropdown4"])		? $row["custom_dropdown4"]		: "";
                $this->custom_dropdown5					= isset($row["custom_dropdown5"])		? $row["custom_dropdown5"]		: "";
                $this->custom_dropdown6					= isset($row["custom_dropdown6"])		? $row["custom_dropdown6"]		: "";
                $this->custom_dropdown7					= isset($row["custom_dropdown7"])		? $row["custom_dropdown7"]		: "";
                $this->custom_dropdown8					= isset($row["custom_dropdown8"])		? $row["custom_dropdown8"]		: "";
                $this->custom_dropdown9					= isset($row["custom_dropdown9"])		? $row["custom_dropdown9"]		: "";
                $this->custom_text0						= isset($row["custom_text0"])			? $row["custom_text0"]			: "";
                $this->custom_text1						= isset($row["custom_text1"])			? $row["custom_text1"]			: "";
                $this->custom_text2						= isset($row["custom_text2"])			? $row["custom_text2"]			: "";
                $this->custom_text3						= isset($row["custom_text3"])			? $row["custom_text3"]			: "";
                $this->custom_text4						= isset($row["custom_text4"])			? $row["custom_text4"]			: "";
                $this->custom_text5						= isset($row["custom_text5"])			? $row["custom_text5"]			: "";
                $this->custom_text6						= isset($row["custom_text6"])			? $row["custom_text6"]			: "";
                $this->custom_text7						= isset($row["custom_text7"])			? $row["custom_text7"]			: "";
                $this->custom_text8						= isset($row["custom_text8"])			? $row["custom_text8"]			: "";
                $this->custom_text9						= isset($row["custom_text9"])			? $row["custom_text9"]			: "";
                $this->custom_short_desc0				= isset($row["custom_short_desc0"])		? $row["custom_short_desc0"]	: "";
                $this->custom_short_desc1				= isset($row["custom_short_desc1"])		? $row["custom_short_desc1"]	: "";
                $this->custom_short_desc2				= isset($row["custom_short_desc2"])		? $row["custom_short_desc2"]	: "";
                $this->custom_short_desc3				= isset($row["custom_short_desc3"])		? $row["custom_short_desc3"]	: "";
                $this->custom_short_desc4				= isset($row["custom_short_desc4"])		? $row["custom_short_desc4"]	: "";
                $this->custom_short_desc5				= isset($row["custom_short_desc5"])		? $row["custom_short_desc5"]	: "";
                $this->custom_short_desc6				= isset($row["custom_short_desc6"])		? $row["custom_short_desc6"]	: "";
                $this->custom_short_desc7				= isset($row["custom_short_desc7"])		? $row["custom_short_desc7"]	: "";
                $this->custom_short_desc8				= isset($row["custom_short_desc8"])		? $row["custom_short_desc8"]	: "";
                $this->custom_short_desc9				= isset($row["custom_short_desc9"])		? $row["custom_short_desc9"]	: "";
                $this->custom_long_desc0				= isset($row["custom_long_desc0"])		? $row["custom_long_desc0"]		: "";
                $this->custom_long_desc1				= isset($row["custom_long_desc1"])		? $row["custom_long_desc1"]		: "";
                $this->custom_long_desc2				= isset($row["custom_long_desc2"])		? $row["custom_long_desc2"]		: "";
                $this->custom_long_desc3				= isset($row["custom_long_desc3"])		? $row["custom_long_desc3"]		: "";
                $this->custom_long_desc4				= isset($row["custom_long_desc4"])		? $row["custom_long_desc4"]		: "";
                $this->custom_long_desc5				= isset($row["custom_long_desc5"])		? $row["custom_long_desc5"]		: "";
                $this->custom_long_desc6				= isset($row["custom_long_desc6"])		? $row["custom_long_desc6"]		: "";
                $this->custom_long_desc7				= isset($row["custom_long_desc7"])		? $row["custom_long_desc7"]		: "";
                $this->custom_long_desc8				= isset($row["custom_long_desc8"])		? $row["custom_long_desc8"]		: "";
                $this->custom_long_desc9				= isset($row["custom_long_desc9"])		? $row["custom_long_desc9"]		: "";
                $this->review_count						= isset($row["review_count"])			? $row["review_count"]			: 0;

                $this->number_views						= isset($row["number_views"])			? $row["number_views"]			: 0;
                $this->avg_review						= isset($row["avg_review"])				? $row["avg_review"]			: 0;
                $this->price                            = isset($row["price"])                   ? $row["price"]                 : 0;
                $this->setDate("promotion_start_date", isset($row["promotion_start_date"]) ? $row["promotion_start_date"] : '0000-00-00' );
                $this->setDate("promotion_end_date", isset($row["promotion_end_date"]) ? $row["promotion_end_date"] : '0000-00-00');

                $this->thumb_id							= isset($row["thumb_id"])						? $row["thumb_id"]							: 0;
                $this->image_id							= isset($row["image_id"])						? $row["image_id"]							: 0;
                $this->thumb_type						= isset($row["thumb_type"])						? $row["thumb_type"]						: 0;
                $this->thumb_width						= isset($row["thumb_width"])						? $row["thumb_width"]						: 0;
                $this->thumb_height						= isset($row["thumb_height"])					? $row["thumb_height"]						: 0;
                $this->listingtemplate_id				= isset($row["listingtemplate_id"])				? $row["listingtemplate_id"]				: 0;
                $this->template_layout_id				= isset($row["template_layout_id"])				? $row["template_layout_id"]				: 0;
                $this->template_cat_id					= isset($row["template_cat_id"])					? $row["template_cat_id"]					: 0;
                $this->template_title					= isset($row["template_title"])					? $row["template_title"]					: "";
                $this->template_status					= isset($row["template_status"])					? $row["template_status"]					: "";
                $this->template_price					= isset($row["template_price"])					? $row["template_price"]					: "0.00";

                $this->entered							= isset($row["entered"])							? $row["entered"]							: ($this->entered				? $this->entered					: "");
                $this->updated							= isset($row["updated"])							? $row["updated"]							: ($this->updated				? $this->updated					: "");
                $this->promotion_id						= isset($row["promotion_id"])					? $row["promotion_id"]						: 0;
                $this->backlink							= isset($row["backlink"])						? $row["backlink"]							: ($this->backlink				? $this->backlink					: "n");
                $this->clicktocall_number				= isset($row["clicktocall_number"])				? $row["clicktocall_number"]				: ($this->clicktocall_number	? $this->clicktocall_number			: "");
                $this->clicktocall_extension			= isset($row["clicktocall_extension"])			? $row["clicktocall_extension"]				: ($this->clicktocall_extension	? $this->clicktocall_extension		: 0);
                $this->fulltextsearch_what  = $this->getFulltext_What();
        }




protected function getFulltext_What()
{

    $what = $this->title.' , ';	//add original title

    //Fulltext search what for websites fix
    if(strpos($this->title, ".") > -1){ //If title has "."
                        $backup = $this->title;
            $this->title = str_replace("http://", "", $this->title);
            $this->title = str_replace("ftp://", "", $this->title);
            $this->title = str_replace("https://", "", $this->title);
            $this->title = str_replace("www.", "", $this->title);
                $title1 = str_replace(".","",$this->title);
                $title2 = str_replace("."," ",$this->title);
                $this->title = $title1 . " , " . $title2;
                $title1 = str_replace("-","",$this->title);
                $title2 = str_replace("-"," ",$this->title);
                $this->title = $title1 . " , " . $title2;
            $what .= $this->title.' , '; //Add modified title
        }

    isset($backup) ? $this->title = $backup : null; //Reverse the original title that was modified in if statement above

    $what .= $this->address ? $this->address.' , ' : '';
    $what .= $this->location_4_title ? $this->location_4_title.', ' : '';
    $what .= $this->location_3_title ? $this->location_3_title.', ' : '';
    $what .= $this->location_2_title ? $this->location_2_title.', ' : '';
    $what .= $this->location_1_title ? $this->location_1_title.', ' : '';
    $what .= $this->zip_code ? $this->zip_code .' , ' : '';
    $what .= $this->seo_keywords ? $this->seo_keywords .' , ' : '';

    return rtrim( $what, ' ,' );
}



    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->Update();
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->Update();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Update
     * @access Public
     */
    function Update(){
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE Listing_Summary SET "
                    . " account_id = :account_id,"
                    . " location_1 = :location_1,"
                    . " location_1_title = :location_1_title,"
                    . " location_1_abbreviation = :location_1_abbreviation,"
                    . " location_1_friendly_url = :location_1_friendly_url,"
                    . " location_2 = :location_2,"
                    . " location_2_title = :location_2_title,"
                    . " location_2_abbreviation = :location_2_abbreviation,"
                    . " location_2_friendly_url = :location_2_friendly_url,"
                    . " location_3 = :location_3,"
                    . " location_3_title = :location_3_title,"
                    . " location_3_abbreviation = :location_3_abbreviation,"
                    . " location_3_friendly_url = :location_3_friendly_url,"
                    . " location_4 = :location_4,"
                    . " location_4_title = :location_4_title,"
                    . " location_4_abbreviation = :location_4_abbreviation,"
                    . " location_4_friendly_url = :location_4_friendly_url,"
                    . " location_5 = :location_5,"
                    . " location_5_title = :location_5_title,"
                    . " location_5_abbreviation = :location_5_abbreviation,"
                    . " location_5_friendly_url = :location_5_friendly_url,"
                    . " title = :title,"
                    . " friendly_url = :friendly_url,"
                    . " email = :email,"
                    . " show_email = :show_email,"
                    . " url = :url,"
                    . " display_url = :display_url,"
                    . " address = :address,"
                    . " address2 = :address2,"
                    . " zip_code = :zip_code,"
                    . " zip5 = :zip5,"
                    . " latitude = :latitude,"
                    . " longitude = :longitude,"
                    . " phone = :phone,"
                    . " fax = :fax,"
                    . " description = :description,"
                    . " attachment_file = :attachment_file,"
                    . " attachment_caption = :attachment_caption,"
                    . " status = :status,"
                    . " renewal_date = :renewal_date,"
                    . " level = :level,"
                    . " random_number = :random_number,"
                    . " claim_disable = :claim_disable,"
                    . " locations = :locations,"
                    . " keywords = :keywords,"
                    . " seo_keywords = :seo_keywords,"
                    . " fulltextsearch_keyword = :fulltextsearch_keyword,"
                    . " fulltextsearch_where = :fulltextsearch_where,"
                    . " fulltextsearch_what = :fulltextsearch_what,"
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
                    . " number_views		= :number_views,"
                    . " review_count		= :review_count,"
                    . " avg_review			= :avg_review,"
                    . " price               = :price,"
                    . " promotion_start_date = :promotion_start_date,"
                    . " promotion_end_date = :promotion_end_date,"
                    . " thumb_id = :thumb_id,"
                    . " thumb_type = :thumb_type,"
                    . " thumb_width= :thumb_width,"
                    . " thumb_height = :thumb_height,"
                    . " listingtemplate_id = :listingtemplate_id,"
                    . " template_layout_id = :template_layout_id,"
                    . " template_cat_id = :template_cat_id,"
                    . " template_title = :template_title,"
                    . " template_status = :template_status,"
                    . " template_price = :template_price,"
                    . " image_id = :image_id,"
                    . " updated = :updated,"
                    . " entered = :entered,"
                    . " promotion_id = :promotion_id,"
                    . " backlink = :backlink,"
                    . " clicktocall_number = :clicktocall_number,"
                    . " clicktocall_extension = :clicktocall_extension"
                    . " WHERE id = :id");
            $parameters = array(
                ":account_id" => $this->account_id,
                ":location_1" => $this->location_1,
                ":location_1_title" => $this->location_1_title,
                ":location_1_abbreviation" => $this->location_1_abbreviation,
                ":location_1_friendly_url" => $this->location_1_friendly_url,
                ":location_2" => $this->location_2,
                ":location_2_title" => $this->location_2_title,
                ":location_2_abbreviation" => $this->location_2_abbreviation,
                ":location_2_friendly_url" => $this->location_2_friendly_url,
                ":location_3" => $this->location_3,
                ":location_3_title" => $this->location_3_title,
                ":location_3_abbreviation" => $this->location_3_abbreviation,
                ":location_3_friendly_url" => $this->location_3_friendly_url,
                ":location_4" => $this->location_4,
                ":location_4_title" => $this->location_4_title,
                ":location_4_abbreviation" => $this->location_4_abbreviation,
                ":location_4_friendly_url" => $this->location_4_friendly_url,
                ":location_5" => $this->location_5,
                ":location_5_title" => $this->location_5_title,
                ":location_5_abbreviation" => $this->location_5_abbreviation,
                ":location_5_friendly_url" => $this->location_5_friendly_url,
                ":title" => $this->title,
                ":friendly_url" => $this->friendly_url,
                ":email" => $this->email,
                ":show_email" => $this->show_email,
                ":url" => $this->url,
                ":display_url" => $this->display_url,
                ":address" => $this->address,
                ":address2" => $this->address2,
                ":zip_code" => $this->zip_code,
                ":zip5" => $this->zip5,
                ":latitude" => $this->latitude,
                ":longitude" => $this->longitude,
                ":phone" => $this->phone,
                ":fax" => $this->fax,
                ":description" => $this->description,
                ":attachment_file" => $this->attachment_file,
                ":attachment_caption" => $this->attachment_caption,
                ":status" => $this->status,
                ":renewal_date" => $this->renewal_date,
                ":level" => $this->level,
                ":random_number" => $this->random_number,
                ":claim_disable" => $this->claim_disable,
                ":locations" => $this->locations,
                ":keywords" => $this->keywords,
                ":seo_keywords" => $this->seo_keywords,
                ":fulltextsearch_keyword" => $this->fulltextsearch_keyword,
                ":fulltextsearch_where" => $this->fulltextsearch_where,
                ":fulltextsearch_what" => $this->fulltextsearch_what,
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
                ":price" => $this->price,
                ":promotion_start_date" => $this->promotion_start_date,
                ":promotion_end_date" => $this->promotion_end_date,
                ":thumb_id" => $this->thumb_id,
                ":thumb_type" => $this->thumb_type,
                ":thumb_width" => $this->thumb_width,
                ":thumb_height" => $this->thumb_height,
                ":listingtemplate_id" => $this->listingtemplate_id,
                ":template_layout_id" => $this->template_layout_id,
                ":template_cat_id" => $this->template_cat_id,
                ":template_title" => $this->template_title,
                ":template_status" => $this->template_status,
                ":template_price" => $this->template_price,
                ":image_id" => $this->image_id,
                ":updated" => $this->updated,
                ":entered" => $this->entered,
                ":promotion_id" => $this->promotion_id,
                ":backlink" => $this->backlink,
                ":clicktocall_number" => $this->clicktocall_number,
                ":clicktocall_extension" => $this->clicktocall_extension,
                ":id" => $this->id
            );
            $sql->execute($parameters);
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->Add();
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->Add();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Add
     * @access Public
     */
    function Add(){
        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("INSERT Listing_Summary ("
                            . " id,"
                            . " account_id,"
                            . " location_1,"
                            . " location_1_title,"
                            . " location_1_abbreviation,"
                            . " location_1_friendly_url,"
                            . " location_2,"
                            . " location_2_title,"
                            . " location_2_abbreviation,"
                            . " location_2_friendly_url,"
                            . " location_3,"
                            . " location_3_title,"
                            . " location_3_abbreviation,"
                            . " location_3_friendly_url,"
                            . " location_4,"
                            . " location_4_title,"
                            . " location_4_abbreviation,"
                            . " location_4_friendly_url,"
                            . " location_5,"
                            . " location_5_title,"
                            . " location_5_abbreviation,"
                            . " location_5_friendly_url,"
                            . " title,"
                            . " friendly_url,"
                            . " email,"
                            . " show_email,"
                            . " url,"
                            . " display_url,"
                            . " address,"
                            . " address2,"
                            . " zip_code,"
                            . " zip5,"
                            . " latitude,"
                            . " longitude,"
                            . " phone,"
                            . " fax,"
                            . " description,"
                            . " attachment_file,"
                            . " attachment_caption,"
                            . " status,"
                            . " renewal_date,"
                            . " level,"
                            . " random_number,"
                            . " claim_disable,"
                            . " locations,"
                            . " keywords,"
                            . " seo_keywords,"
                            . " fulltextsearch_keyword,"
                            . " fulltextsearch_where,"
                            . " fulltextsearch_what,"
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
                            . " review_count,"
                            . " avg_review,"
                            . " price,"
                            . " promotion_start_date,"
                            . " promotion_end_date,"
                            . " thumb_id,"
                            . " thumb_type,"
                            . " thumb_width,"
                            . " thumb_height,"
                            . " listingtemplate_id,"
                            . " template_layout_id,"
                            . " template_cat_id,"
                            . " template_title,"
                            . " template_status,"
                            . " template_price,"
                            . " image_id,"
                            . " updated,"
                            . " entered,"
                            . " promotion_id,"
                            . " backlink,"
                            . " clicktocall_number,"
                            . " clicktocall_extension)"
                            . " VALUES"
                            . " (:id,"
                            . ":account_id,"
                            . ":location_1,"
                            . ":location_1_title,"
                            . ":location_1_abbreviation,"
                            . ":location_1_friendly_url,"
                            . ":location_2,"
                            . ":location_2_title,"
                            . ":location_2_abbreviation,"
                            . ":location_2_friendly_url,"
                            . ":location_3,"
                            . ":location_3_title,"
                            . ":location_3_abbreviation,"
                            . ":location_3_friendly_url,"
                            . ":location_4,"
                            . ":location_4_title,"
                            . ":location_4_abbreviation,"
                            . ":location_4_friendly_url,"
                            . ":location_5,"
                            . ":location_5_title,"
                            . ":location_5_abbreviation,"
                            . ":location_5_friendly_url,"
                            . ":title,"
                            . ":friendly_url,"
                            . ":email,"
                            . ":show_email,"
                            . ":url,"
                            . ":display_url,"
                            . ":address,"
                            . ":address2,"
                            . ":zip_code,"
                            . ":zip5,"
                            . ":latitude,"
                            . ":longitude,"
                            . ":phone,"
                            . ":fax,"
                            . ":description,"
                            . ":attachment_file,"
                            . ":attachment_caption,"
                            . ":status,"
                            . ":renewal_date,"
                            . ":level,"
                            . ":random_number,"
                            . ":claim_disable,"
                            . ":locations,"
                            . ":keywords,"
                            . ":seo_keywords,"
                            . ":fulltextsearch_keyword,"
                            . ":fulltextsearch_where,"
                            . ":fulltextsearch_what,"
                            . ":custom_text0,"
                            . ":custom_text1,"
                            . ":custom_text2,"
                            . ":custom_text3,"
                            . ":custom_text4,"
                            . ":custom_text5,"
                            . ":custom_text6,"
                            . ":custom_text7,"
                            . ":custom_text8,"
                            . ":custom_text9,"
                            . ":custom_short_desc0,"
                            . ":custom_short_desc1,"
                            . ":custom_short_desc2,"
                            . ":custom_short_desc3,"
                            . ":custom_short_desc4,"
                            . ":custom_short_desc5,"
                            . ":custom_short_desc6,"
                            . ":custom_short_desc7,"
                            . ":custom_short_desc8,"
                            . ":custom_short_desc9,"
                            . ":custom_long_desc0,"
                            . ":custom_long_desc1,"
                            . ":custom_long_desc2,"
                            . ":custom_long_desc3,"
                            . ":custom_long_desc4,"
                            . ":custom_long_desc5,"
                            . ":custom_long_desc6,"
                            . ":custom_long_desc7,"
                            . ":custom_long_desc8,"
                            . ":custom_long_desc9,"
                            . ":custom_checkbox0,"
                            . ":custom_checkbox1,"
                            . ":custom_checkbox2,"
                            . ":custom_checkbox3,"
                            . ":custom_checkbox4,"
                            . ":custom_checkbox5,"
                            . ":custom_checkbox6,"
                            . ":custom_checkbox7,"
                            . ":custom_checkbox8,"
                            . ":custom_checkbox9,"
                            . ":custom_dropdown0,"
                            . ":custom_dropdown1,"
                            . ":custom_dropdown2,"
                            . ":custom_dropdown3,"
                            . ":custom_dropdown4,"
                            . ":custom_dropdown5,"
                            . ":custom_dropdown6,"
                            . ":custom_dropdown7,"
                            . ":custom_dropdown8,"
                            . ":custom_dropdown9,"
                            . ":number_views,"
                             . ":review_count,"
                            . ":avg_review,"
                            . ":price,"
                            . ":promotion_start_date,"
                            . ":promotion_end_date,"
                            . ":thumb_id,"
                            . ":thumb_type,"
                            . ":thumb_width,"
                            . ":thumb_height,"
                            . ":listingtemplate_id,"
                            . ":template_layout_id,"
                            . ":template_cat_id,"
                            . ":template_title,"
                            . ":template_status,"
                            . ":template_price,"
                            . ":image_id,"
                            . ":updated,"
                            . ":entered,"
                            . ":promotion_id,"
                            . ":backlink,"
                            . ":clicktocall_number,"
                            . ":clicktocall_extension )");
            $parameters = array(
                ":id" => $this->id,
                ":account_id" => $this->account_id,
                ":location_1" => $this->location_1,
                ":location_1_title" => $this->location_1_title,
                ":location_1_abbreviation" => $this->location_1_abbreviation,
                ":location_1_friendly_url" => $this->location_1_friendly_url,
                ":location_2" => $this->location_2,
                ":location_2_title" => $this->location_2_title,
                ":location_2_abbreviation" => $this->location_2_abbreviation,
                ":location_2_friendly_url" => $this->location_2_friendly_url,
                ":location_3" => $this->location_3,
                ":location_3_title" => $this->location_3_title,
                ":location_3_abbreviation" => $this->location_3_abbreviation,
                ":location_3_friendly_url" => $this->location_3_friendly_url,
                ":location_4" => $this->location_4,
                ":location_4_title" => $this->location_4_title,
                ":location_4_abbreviation" => $this->location_4_abbreviation,
                ":location_4_friendly_url" => $this->location_4_friendly_url,
                ":location_5" => $this->location_5,
                ":location_5_title" => $this->location_5_title,
                ":location_5_abbreviation" => $this->location_5_abbreviation,
                ":location_5_friendly_url" => $this->location_5_friendly_url,
                ":title" => $this->title,
                ":friendly_url" => $this->friendly_url,
                ":email" => $this->email,
                ":show_email" => $this->show_email,
                ":url" => $this->url,
                ":display_url" => $this->display_url,
                ":address" => $this->address,
                ":address2" => $this->address2,
                ":zip_code" => $this->zip_code,
                ":zip5" => $this->zip5,
                ":latitude" => $this->latitude,
                ":longitude" => $this->longitude,
                ":phone" => $this->phone,
                ":fax" => $this->fax,
                ":description" => $this->description,
                ":attachment_file" => $this->attachment_file,
                ":attachment_caption" => $this->attachment_caption,
                ":status" => $this->status,
                ":renewal_date" => $this->renewal_date,
                ":level" => $this->level,
                ":random_number" => $this->random_number,
                ":claim_disable" => $this->claim_disable,
                ":locations" => $this->locations,
                ":keywords" => $this->keywords,
                ":seo_keywords" => $this->seo_keywords,
                ":fulltextsearch_keyword" => $this->fulltextsearch_keyword,
                ":fulltextsearch_where" => $this->fulltextsearch_where,
                ":fulltextsearch_what" => $this->fulltextsearch_what,
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
                ":price" => $this->price,
                ":promotion_start_date" => $this->promotion_start_date,
                ":promotion_end_date" => $this->promotion_end_date,
                ":thumb_id" => $this->thumb_id,
                ":thumb_type" => $this->thumb_type,
                ":thumb_width" => $this->thumb_width,
                ":thumb_height" => $this->thumb_height,
                ":listingtemplate_id" => $this->listingtemplate_id,
                ":template_layout_id" => $this->template_layout_id,
                ":template_cat_id" => $this->template_cat_id,
                ":template_title" => $this->template_title,
                ":template_status" => $this->template_status,
                ":template_price" => $this->template_price,
                ":image_id" => $this->image_id,
                ":updated" => $this->updated,
                ":entered" => $this->entered,
                ":promotion_id" => $this->promotion_id,
                ":backlink" => $this->backlink,
                ":clicktocall_number" => $this->clicktocall_number,
                ":clicktocall_extension" => $this->clicktocall_extension
            );
            $sql->execute($parameters);
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->Delete($id);
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->Delete($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     * @param integer $id
     * @param integer $domain_id
     */
    function Delete($id, $domain_id = false){
        DBQuery::execute(function() use ($id, $domain_id){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("DELETE from Listing_Summary where id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->PopulateTableLocation(...);
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->PopulateTableLocation(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name PopulateTableLocation
     * @access Public
     * @param integer $listing_id
     * @param integer $locLevel
     * @param varchar $field
     */
    function PopulateTableLocation($listing_id = false, $locLevel = 0, $field){
        if(is_numeric($listing_id) && is_numeric($locLevel)){
            DBQuery::execute(function() use ($listing_id, $locLevel, $field){
                $domain = DBConnection::getInstance()->getDomain();
                $sql = $domain->prepare("UPDATE Listing_Summary SET "
                            . " location_".$locLevel." = 0,"
                            . " location_".$locLevel."_title = '',"
                            . " location_".$locLevel."_abbreviation = '',"
                            . " location_".$locLevel."_friendly_url = '',"
                            . " fulltextsearch_where = :where"
                            . " WHERE id = :id");
                $sql->bindParam(':where', $field);
                $sql->bindParam(':id', $listing_id);
                $sql->execute();
            });
        }
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->PopulateTableCategory(...);
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->PopulateTableCategory(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name PopulateTableCategory
     * @access Public
     * @param integer $listing_id
     * @param varchar $field
     */
    function PopulateTableCategory($listing_id = false, $field){
        DBQuery::execute(function() use ($listing_id, $field){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE Listing_Summary SET "
                            . " fulltextsearch_keyword = :keyword"
                            . " WHERE id = :id");
            $sql->bindParam(':keyword', $field);
            $sql->bindParam(':id', $listing_id);
            $sql->execute();
        });
    }

    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$listingObj->PopulateTable(...);
     * <br /><br />
     *		//Using this in ListingSummary() class.
     *		$this->PopulateTable(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name PopulateTable
     * @access Public
     * @param integer $listing_id
     * @param varchar $method
     */
    function PopulateTable($listing_id = false, $method){
     DBQuery::execute(function() use ($listing_id, $method){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = "SELECT
                        Listing.id,
                        Listing.account_id,	
                        Listing.location_1,
                        Listing.location_2,
                        Listing.location_3,
                        Listing.location_4,
                        Listing.location_5,
                        Listing.image_id as image_id,
                        Listing.thumb_id as thumb_id,
                        Listing.title,
                        Listing.friendly_url,
                        Listing.email,
                        Listing.show_email,
                        Listing.url,
                        Listing.display_url,
                        Listing.address,
                        Listing.address2,
                        Listing.zip_code,
                        Listing.zip5,
                        Listing.latitude,
                        Listing.longitude,
                        Listing.phone,
                        Listing.fax,
                        Listing.description,
                        Listing.attachment_file,
                        Listing.attachment_caption,
                        Listing.status,
                        Listing.renewal_date,
                        Listing.level,
                        Listing.random_number,
                        Listing.reminder,
                        Listing.fulltextsearch_keyword,
                        Listing.fulltextsearch_where,
                        Listing.locations,
                        Listing.keywords,
                        Listing.seo_keywords,
                        Listing.claim_disable,
                        Listing.listingtemplate_id,
                        Listing.custom_checkbox0,
                        Listing.custom_checkbox1,
                        Listing.custom_checkbox2,
                        Listing.custom_checkbox3,
                        Listing.custom_checkbox4,
                        Listing.custom_checkbox5,
                        Listing.custom_checkbox6,
                        Listing.custom_checkbox7,
                        Listing.custom_checkbox8,
                        Listing.custom_checkbox9,
                        Listing.custom_dropdown0,
                        Listing.custom_dropdown1,
                        Listing.custom_dropdown2,
                        Listing.custom_dropdown3,
                        Listing.custom_dropdown4,
                        Listing.custom_dropdown5,
                        Listing.custom_dropdown6,
                        Listing.custom_dropdown7,
                        Listing.custom_dropdown8,
                        Listing.custom_dropdown9,
                        Listing.custom_text0,
                        Listing.custom_text1,
                        Listing.custom_text2,
                        Listing.custom_text3,
                        Listing.custom_text4,
                        Listing.custom_text5,
                        Listing.custom_text6,
                        Listing.custom_text7,
                        Listing.custom_text8,
                        Listing.custom_text9,
                        Listing.custom_short_desc0,
                        Listing.custom_short_desc1,
                        Listing.custom_short_desc2,
                        Listing.custom_short_desc3,
                        Listing.custom_short_desc4,
                        Listing.custom_short_desc5,
                        Listing.custom_short_desc6,
                        Listing.custom_short_desc7,
                        Listing.custom_short_desc8,
                        Listing.custom_short_desc9,
                        Listing.custom_long_desc0,
                        Listing.custom_long_desc1,
                        Listing.custom_long_desc2,
                        Listing.custom_long_desc3,
                        Listing.custom_long_desc4,
                        Listing.custom_long_desc5,
                        Listing.custom_long_desc6,
                        Listing.custom_long_desc7,
                        Listing.custom_long_desc8,
                        Listing.custom_long_desc9,
                        Listing.number_views,
                        Listing.avg_review,
                        Listing.review_count,
                        Listing.price,
                        Listing.updated,
                        Listing.entered,
                        Listing.promotion_id,
                        Listing.backlink,
                        Listing.clicktocall_number,
                        Listing.clicktocall_extension,
                        Promotion.start_date AS promotion_start_date,
                        Promotion.end_date AS promotion_end_date,
                        Thumb.type AS thumb_type,
                        Thumb.width AS thumb_width,
                        Thumb.height AS thumb_height,
                        ListingTemplate.layout_id AS template_layout_id,
                        ListingTemplate.cat_id AS template_cat_id,
                        ListingTemplate.title AS template_title,
                        ListingTemplate.status AS template_status,
                        ListingTemplate.price AS template_price
                    FROM Listing
                    LEFT OUTER JOIN Promotion ON (Listing.promotion_id = Promotion.id)
                    LEFT OUTER JOIN Image AS Thumb ON (Listing.thumb_id = Thumb.id)
                    LEFT OUTER JOIN ListingTemplate ON (Listing.listingtemplate_id = ListingTemplate.id)";
            if($listing_id){
                $sql .= " where Listing.id = :id";
                $stmt = $domain->prepare($sql);
                $stmt->bindValue(':id', str_replace("'","",$listing_id));
            }
            else {
                $stmt = $domain->prepare($sql);
            }
            
            $stmt->execute();
            
            if($stmt){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                /*
                 * Get location information
                 */
                unset($locationObj);
                if($row["location_1"] > 0){
                    $locationObj = new Location1($row["location_1"]);
                    $row["location_1"] 				= $locationObj->id;
                    $row["location_1_title"]		= $locationObj->name;
                    $row["location_1_abbreviation"]	= $locationObj->abbreviation;
                    $row["location_1_friendly_url"]	= $locationObj->friendly_url;
                }else{
                    $row["location_1"] 				= 0;
                    $row["location_1_title"]		= "";
                    $row["location_1_abbreviation"]	= "";
                    $row["location_1_friendly_url"]	= "";
                }

                unset($locationObj);
                if($row["location_2"] > 0){
                    $locationObj = new Location2($row["location_2"]);
                    $row["location_2"] 				= $locationObj->id;
                    $row["location_2_title"]		= $locationObj->name;
                    $row["location_2_abbreviation"]	= $locationObj->abbreviation;
                    $row["location_2_friendly_url"]	= $locationObj->friendly_url;
                }else{
                    $row["location_2"] 				= 0;
                    $row["location_2_title"]		= "";
                    $row["location_2_abbreviation"]	= "";
                    $row["location_2_friendly_url"]	= "";
                }

                unset($locationObj);
                if($row["location_3"] > 0){
                    $locationObj = new Location3($row["location_3"]);
                    $row["location_3"] 				= $locationObj->id;
                    $row["location_3_title"]		= $locationObj->name;
                    $row["location_3_abbreviation"]	= $locationObj->abbreviation;
                    $row["location_3_friendly_url"]	= $locationObj->friendly_url;
                }else{
                    $row["location_3"] 				= 0;
                    $row["location_3_title"]		= "";
                    $row["location_3_abbreviation"]	= "";
                    $row["location_3_friendly_url"]	= "";
                }

                unset($locationObj);
                if($row["location_4"] > 0){
                    $locationObj = new Location4($row["location_4"]);
                    $row["location_4"] 				= $locationObj->id;
                    $row["location_4_title"]		= $locationObj->name;
                    $row["location_4_abbreviation"]	= $locationObj->abbreviation;
                    $row["location_4_friendly_url"]	= $locationObj->friendly_url;
                }else{
                    $row["location_4"] 				= 0;
                    $row["location_4_title"]		= "";
                    $row["location_4_abbreviation"]	= "";
                    $row["location_4_friendly_url"]	= "";
                }

                unset($locationObj);
                if($row["location_5"] > 0){
                    $locationObj = new Location5($row["location_5"]);
                    $row["location_5"] 				= $locationObj->id;
                    $row["location_5_title"]		= $locationObj->name;
                    $row["location_5_abbreviation"]	= $locationObj->abbreviation;
                    $row["location_5_friendly_url"]	= $locationObj->friendly_url;
                }else{
                    $row["location_5"] 				= 0;
                    $row["location_5_title"]		= "";
                    $row["location_5_abbreviation"]	= "";
                    $row["location_5_friendly_url"]	= "";
                }

                $this->makeFromRow($row);
                if($method == "update"){
                    $this->Update();
                }
                elseif($method == "insert"){
                    $this->Add();
                }
            }
            }
          });
    }
}
?>