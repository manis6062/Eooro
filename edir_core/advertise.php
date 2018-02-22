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
	# * FILE: /edir_core/advertise.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<script type="text/javascript">

		function showTab (type) {
			var activeTab = "#tab_" + type;
			var activeTabContent = "#content_" + type;
			
			$("ul.tabs-advertise li").removeClass("active"); //Remove any "active" class
			$(activeTab).addClass("active"); //Add "active" class to selected tab
			$(".tab-content-advertise").hide(); //Hide all tab content
			$(activeTabContent).fadeIn(); //Fade in the active content
            
            $('html, body').animate({
                scrollTop: $(activeTabContent).offset().top
            }, 500);
		}
		
	</script>
    
    <? include(system_getFrontendPath("advertise.php", "frontend")); ?>