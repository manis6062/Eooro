	
	<?php
	function generate_sitemap() {
		
		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

		$module = "listing";
		$maxData = SITEMAP_MAXURL;
		setting_get("default_url", $url);
		$url_protocol = "http://".(SITEMAP_ADD_WWW == "on" ?  "www." : "");
		$default_url = "$url_protocol";
		
		$item_default_url = "http://www.eooro.com/company-reviews";

        $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url
						from $dbObj->db_name.Listing where custom_checkbox1='y'
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
			$fileCreated = false;

			if ($url_number == $maxData) {
				$fileCreated = true;
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail_global'.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail_global'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail_global".$file_number.".xml";
				$file_number++;
				$url_number = 0;
			}
		}
		if(!$fileCreated && $url_number > 0) {
				$buffer_moduleDetails .= sitemap_printFooter();
				if (!sitemap_writeFile(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail_global'.$name.$file_number.'.xml', $buffer_moduleDetails)) die('ERROR WHILE SAVING THE '.EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail_global'.$file_number.'.xml!'.PHP_EOL);
				$buffer_moduleDetails = "";
				$files[] = $module."detail_global".$file_number.".xml";			
		}


		return $files;
	}
	?>
