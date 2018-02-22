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
	# * FILE: /theme/default/frontend/detail_fanpage.php
	# ----------------------------------------------------------------------------------------------------

if ($listingtemplate_twpage) { ?>
<div class="tweet">
    <a class="twitter-timeline" href="<?=$listingtemplate_twpage?>" width="500" data-widget-id="<?=$listingtemplate_twid?>"></a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<style>
iframe#twitter-widget-0 > .SandboxRoot{
	
/*	display: none !important;*/
/*max-width: 100% !important; */

/*max-width: 100% !important; */

}
</style>
<? } ?>



<!-- <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" class="twitter-timeline twitter-timeline-rendered" allowfullscreen="" style="border: none; max-width: 100%; min-width: 180px; margin: 0px; padding: 0px; display: inline-block; position: static; visibility: visible; width: 520px;" title="Twitter Timeline" height="600"></iframe> -->