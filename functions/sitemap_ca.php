	
	<?php
	function generate_sitemap() {

		$location_1 = 237;
		
		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

		$module = "listing";
		$maxData = SITEMAP_MAXURL;
		setting_get("default_url", $url);
		$url_protocol = "http://".(SITEMAP_ADD_WWW == "on" ?  "www." : "");
		$default_url = "$url_protocol";
		$item_default_url = constant(string_strtoupper($module)."_DEFAULT_URL");
		if (!$_SERVER["HTTP_HOST"]){
			if (string_strpos($item_default_url, $default_url) === false) {
				$item_default_url = $default_url.str_replace("http://", "", $item_default_url);
			}
		}
		$id_query = "select id, name from Location_2 where  location_1 = $location_1";
        $get_id   = $dbObjMain->query($id_query);

        while($id = mysql_fetch_array($get_id)) {

            $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url, row_cnt
							from $dbObj->db_name.Listing AS a
							inner join 
							(select location_1, location_2, count(*) as row_cnt from $dbObj->db_name.Listing
							where 
							location_1 = $location_1 and location_2 =  " . $id['id'] . " 
							group by location_1, location_2) AS b on a.location_1 = b.location_1 and a.location_2 = b.location_2
							where a.location_1 = $location_1
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
			$loc = "".$item_default_url."/".$item['friendly_url'];
			$lastmod = $item['updated'];
			$buffer_moduleDetails .= sitemap_printNodeUrl($loc, $lastmod);
			$url_number++;
			$fileCreated = false;
			$name = $id['name'];

			if ($url_number == $maxData) {
				$fileCreated = true;
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$name.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail".$name.$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}
		if(!$fileCreated && $url_number > 0) {
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$name.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail".$name.$file_number.".xml";			
		}

        }


		return $files;
	}
	?>