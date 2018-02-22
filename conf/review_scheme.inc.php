<?php
	//set default scheme
	$edir_default_scheme = "review";

	//set all available schemes separated by comma
	$edir_schemes = "review";
	$edir_schemenames = "Review";

	//code to setup one specific scheme from all available schemes
	$edir_scheme = "review";

	if (DEMO_LIVE_MODE == 0) {
		@include_once(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme/review_scheme.inc.php');
	} else {
		if ($_COOKIE["edir_scheme"] && (strpos($edir_schemes, $_COOKIE["edir_scheme"]) !== false)) {
			$edir_scheme = $_COOKIE["edir_scheme"];
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	define("EDIR_DEFAULT_SCHEME",       $edir_default_scheme);
	define("EDIR_SCHEMES",              $edir_schemes);
	define("EDIR_SCHEMENAMES",          $edir_schemenames);
	define("EDIR_SCHEME",               $edir_scheme);
	define("EDIR_CURR_SCHEME_VALUES",   serialize($arrayScheme));
	
	if (is_array($arrayScheme[EDIR_SCHEME])){
		foreach($arrayScheme[EDIR_SCHEME] as $key=>$value){
			if (strpos($value, "SCHEME_") === false){
				define("SCHEME_".strtoupper($key), $value);
			}
		}
	}

	unset($edir_default_scheme);
	unset($edir_schemes);
	unset($edir_schemenames);
	unset($edir_scheme);

	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>