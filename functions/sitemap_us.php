	
	<?php
	function generate_sitemap() {

		$location_1 = 234;
		
		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

		$module = "listing";
		$maxData = SITEMAP_MAXURL;
		setting_get("default_url", $url);
		$url_protocol = "http://".(SITEMAP_ADD_WWW == "on" ?  "www." : "");
		$default_url = "$url_protocol";
		
		$item_default_url = "http://www.eooro.com/company-reviews";
		$id_query = "select id, replace(name, ' ', '_') as name from Location_3 where  location_1 = $location_1";
       		$get_id   = $dbObjMain->query($id_query);

        while($id = mysql_fetch_array($get_id)) {

            $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url, row_cnt
							from $dbObj->db_name.Listing AS a
							inner join 
							(select location_3, location_4, count(*) as row_cnt from $dbObj->db_name.Listing
							where 
							location_1 = $location_1 and location_3 =  " . $id['id'] . " 
							group by location_3, location_4) AS b on a.location_3 = b.location_3 and a.location_4 = b.location_4
							order by row_cnt desc
							limit 0, ". $maxData ;  
        $items_result = $dbObj->query($items_query);
		$buffer_moduleDetails = "";
		$files = false;
		$file_number = 0;
		$url_number = 0;
		while ($item = mysql_fetch_array($items_result)) {
			if ($url_number <= 0) {
				$buffer_moduleDetails .= sitemap_printHeader();
			}
			$loc = $item_default_url."/".$item['friendly_url'];
			$lastmod = $item['updated'];
			$buffer_moduleDetails .= sitemap_printNodeUrl($loc, $lastmod);
			$url_number++;
			if ($url_number == $maxData) {
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$id['name'].$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail".$id['name'].$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}

        }


		return $files;
	}
	?>