<?php

#Readme

//Initialize
# $listing_pending = new ListingPending();
# or $listing_pending = new ListingPending(123);

//Set Value
#$listing_pending->id = "123";

//Save
#$listing_pending->save();

class ListingPending extends Handle
{
	
		public $id;
		public $account_id;
		public $image_id;
		public $thumb_id;
		public $promotion_id;
		public $location_1;
		public $location_2;
		public $location_3;
		public $location_4;
		public $location_5;
		public $renewal_date;
		public $discount_id;
		public $reminder;
		public $updated;
		public $entered;
		public $title;
		public $seo_title;
		public $claim_disable;
		public $friendly_url;
		public $email;
		public $url;
		public $display_url;
		public $address;
		public $address2;
		public $zip_code;
		public $zip5;
		public $phone;
		public $fax;
		public $description;
		public $seo_description;
		public $long_description;
		public $video_snippet;
		public $video_description;
		public $keywords;
		public $seo_keywords;
		public $attachment_file;
		public $attachment_caption;
		public $features;
		public $price;
		public $facebook_page;
		public $status;
		public $suspended_sitemgr;
		public $level;
		public $locations;
		public $hours_work;
		public $listingtemplate_id;
		public $custom_text0;
		public $custom_text1;
		public $custom_text2;
		public $custom_text3;
		public $custom_text4;
		public $custom_text5;
		public $custom_text6;
		public $custom_text7;
		public $custom_text8;
		public $custom_text9;
		public $custom_short_desc0;
		public $custom_short_desc1;
		public $custom_short_desc2;
		public $custom_short_desc3;
		public $custom_short_desc4;
		public $custom_short_desc5;
		public $custom_short_desc6;
		public $custom_short_desc7;
		public $custom_short_desc8;
		public $custom_short_desc9;
		public $custom_long_desc0;
		public $custom_long_desc1;
		public $custom_long_desc2;
		public $custom_long_desc3;
		public $custom_long_desc4;
		public $custom_long_desc5;
		public $custom_long_desc6;
		public $custom_long_desc7;
		public $custom_long_desc8;
		public $custom_long_desc9;
		public $custom_checkbox0;
		public $custom_checkbox1;
		public $custom_checkbox2;
		public $custom_checkbox3;
		public $custom_checkbox4;
		public $custom_checkbox5;
		public $custom_checkbox6;
		public $custom_checkbox7;
		public $custom_checkbox8;
		public $custom_checkbox9;
		public $custom_dropdown0;
		public $custom_dropdown1;
		public $custom_dropdown2;
		public $custom_dropdown3;
		public $custom_dropdown4;
		public $custom_dropdown5;
		public $custom_dropdown6;
		public $custom_dropdown7;
		public $custom_dropdown8;
		public $custom_dropdown9;
		public $number_views;
		public $avg_review;
                public $review_count;
                public $latitude;
                public $longitude;
		public $map_zoom;
		public $package_id;
		public $package_price;
		public $backlink;
		public $backlink_url;
		public $clicktocall_number;
		public $clicktocall_extension;
		public $clicktocall_date;
                public $created_date;


	public function ListingPending($id)
	{
		$domain = DBConnection::getInstance()->getDomain();
                DBQuery::execute(function() use ($domain,$id) {
  		$dbObj  = db_getDBObject();
  		if(is_numeric($id) && $id){
  			$sql    = $domain->prepare("SELECT * FROM ListingPending WHERE id=:id");
                        $parameters = array(':id' => $id);
                        $sql->execute($parameters);
  		
  		while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
  			$return[] = $row;
  		}
		$array = $return[0];
		foreach ($array as $key => $value) {
			$this->$key = $value;
		}
		//so that id is not null when initializing : ListingPending(99999);
		if(is_numeric($id) && $id){
			$this->id = ($id);
		}
                }
                });
	}


	public function save()
	{
        $result = DBQuery::execute(function(){
        $domain = DBConnection::getInstance()->getDomain();
		if(is_numeric($this->id) && $this->id){
			//Check if this->id is present, if no insert, if yes update
			// $sql 	= "SELECT count(*) as total FROM ListingPending WHERE id = " . mysql_real_escape_string($this->id);
			// $result = mysql_fetch_assoc(db_getDBObject()->query($sql));

            
                $sql = $domain->prepare("SELECT count(*) as total FROM ListingPending WHERE id = :id");
                $sql->bindParam(':id', $this->id);
                $sql->execute();
                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                
			$row['total'] > 0 ? $this->update() : $this->insert();
		} else {
			return false;
		}
        });
	}


	public function insert()
	{
		foreach ($this as $key => $value){
			if(!$value)
				$this->$key = ''; //since table has not null attributes
		}
        
            $domain = DBConnection::getInstance()->getDomain();
        return DBQuery::execute(function() use($domain){
            $aux_seoDescription = $this->description;
            $aux_seoDescription = str_replace(array("\r\n", "\n"), " ", $aux_seoDescription);
            $aux_seoDescription = str_replace("\\\"", "", $aux_seoDescription);

            $sql = $domain->prepare("INSERT INTO ListingPending"
                    . " (id,"
                    . " account_id,"
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
                    . " review_count,"
                    . " number_views,"
                    . " avg_review,"
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
                    . " (:id,"
                    . " :account_id,"
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
                    . " :review_count,"
                    . " :number_views,"
                    . " :avg_review,"
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
                    ":id" => $this->id,
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
            $sql->execute($parameter);
        });


	}

	public function update()
	{

        DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("UPDATE ListingPending SET"
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
                . " review_count       = :review_count,"
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
                ":review_count"	   => $this->review_count,
                ":avg_review"		   => $this->avg_review,
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

	public function delete($id)
	{
        return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $sql = $domain->prepare("DELETE FROM ListingPending WHERE id = :listing_id");
            $sql->bindParam(':listing_id', $this->id);
            $sql->execute();
        });
		
	}

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


	function hasRenewalDate(){
		return true;
	}

	function needToCheckOut(){
		return true;
	}

	function getNextRenewalDate($times = 1){
		$today = date("Y-m-d");
		$today = explode("-", $today);
		$start_year = $today[0];
		$start_month = $today[1];
		$start_day = $today[2];

		$renewalcycle = payment_getRenewalCycle("listing");
		$renewalunit = payment_getRenewalUnit("listing");

		if ($renewalunit == "Y") {
			$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year+($renewalcycle*$times)));
		} elseif ($renewalunit == "M") {
			$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month+($renewalcycle*$times), (int)$start_day, (int)$start_year));
		} elseif ($renewalunit == "D") {
			$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day+($renewalcycle*$times), (int)$start_year));
		}

		return $nextrenewaldate;
	}


	function getCategories($have_data = false, $data = false, $id = false, $getAll = false, $object=false, $bulk=false) {//tested
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

}