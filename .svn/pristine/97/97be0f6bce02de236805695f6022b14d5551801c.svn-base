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
	# * FILE: /classes/class_Cache.php
	# ----------------------------------------------------------------------------------------------------
	
	class cache {

		var $caching = false;
		var $file = "";

		function cache($filename, $expireTime = false) {
			if (CACHE_PARTIAL_FEATURE == "off") {
				$this->caching = true;
				return;
			}

			//Constructor of the class
			clearstatcache();

			$this->file = CACHE_PARTIAL_DIR.rtrim($filename, ".php").".php";
			
			if (file_exists($this->file)) {
                
				//Grab the cache
				if (!$expireTime) {
                    $data = file_get_contents($this->file);
                    if ($data) echo $data;
                } else {
                    $checkPastFile = validate_pastDate(date(DEFAULT_DATE_FORMAT, filemtime($this->file)));
                    $timedif = @(time() - filemtime($this->file));
                    //Use cached file if it's version is newer than CACHE_PARTIAL_TIME (12hours)
                    if ($timedif < CACHE_PARTIAL_TIME && $checkPastFile) {
                        //Grab the cache
                        $data = file_get_contents($this->file);
                        if ($data) echo $data;
                    } else {
                        //Create cache
                        $this->caching = true;
                        ob_start();
                    }
                    
                }
                
			} else {
				//Create cache
				$this->caching = true;
				ob_start();
			}
		}

		function close() {
			if (CACHE_PARTIAL_FEATURE == "off") return;

			//You should have this at the end of each page
			if ($this->caching) {
				//You were caching the contents so display them, and write the cache file
				$data = ob_get_clean();
				echo $data;
				$fp = fopen($this->file, "w");
				fwrite($fp, $data);
				fclose($fp);
			}
		}
	}
?>