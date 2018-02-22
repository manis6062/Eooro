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
	# * FILE: /theme/diningguide/frontend/detail_fanpage.php
	# ----------------------------------------------------------------------------------------------------

    if ($listingtemplate_fbpage) { ?>
    
        <script language="javascript" type="text/javascript">
            //<![CDATA[
            (function(d){
            var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
            d.getElementsByTagName('head')[0].appendChild(js);
            }(document));

            document.write('<div class="fb-like-box" data-href="<?=$listingtemplate_fbpage?>" data-width="292" data-show-faces="true" data-stream="true" data-header="true"></div>');
            //]]>
        </script>
    
    <? } elseif ($signUpListing) {
        
        $signUpListing = false;
    ?>
        
        <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/structure/facebook-fanpage-sample.png"?>" alt="Sample" />
        
    <? } ?>
