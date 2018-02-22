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
	# * FILE: /mobile/layout/footer.php
	# ----------------------------------------------------------------------------------------------------

    //Get APP information, if availabe
    $auxDevice = mobile_splashScreen(true);
    if ($auxDevice == "iphone" || $auxDevice == "android") {
        if ($auxDevice == "iphone") {
            $auxDevice = "ios";
        }
        if (DEMO_LIVE_MODE) {
            $storelink = @constant("DEMO_MOBILE_APPURL_".strtoupper($type));
        } else {
            setting_get("app_storelink_".$auxDevice, $storelink);
        }
    } else {
        $storelink = "";
    }

?>
		</div>
        
			</div>
            
			<div class="footer">
                
                <div class="control">
                    <a href="javascript:void(0);" onclick="viewFullSite();" class="btn btn-info"><?=system_showText(LANG_MOBILE_FULLSITE);?></a>
                    <? if ($storelink) { ?>
                        <a href="<?=$storelink;?>" class="btn btn-info"><?=system_showText(LANG_MOBILE_DOWNLOAD_APP);?></a>
                    <? } ?>
                </div>
                
				<div class="box-copyright">
					<? if (BRANDED_PRINT == "on") { ?>
                        <p class="basePowered">Powered by <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" accesskey="D">eDirectory Cloud Service</a>&trade;</p>
                    <? } ?>
    
                    <?
                    customtext_get("footer_copyright", $footer_copyright);
                    if (!$footer_copyright) {
                        $footer = "Copyright &copy; ".date("Y").". All Rights Reserved.";
                    } else {
                        $footer = $footer_copyright;
                    }
                    ?>
                    <p class="copyright"><?=$footer?></p>
                </div>

			</div>

		</div>
        
        <script type="text/javascript">
        <? if (string_strpos($_SERVER["PHP_SELF"], "detail.php") !== false) { ?>
            
            var lastHeight = window.innerHeight;
            var lastWidth = window.innerWidth;
            var locationMap = '<?=$location_map?>';
            var locationIcon = '<?=$icon?>';
            
                $(document).ready(function() {
                    $(window).bind('orientationchange resize', function(event){
                        if (window.innerHeight != lastHeight && window.innerWidth != lastWidth) {
                            lastHeight = window.innerHeight;
                            lastWidth = window.innerWidth;
                            if (locationMap && locationIcon) {
                                document.getElementById("imgLocationMap").innerHTML = "<img src=\"http://maps.google.com/maps/api/staticmap?center="+locationMap+"&zoom=15&size=275x130&scale=2&maptype=roadmap&mobile=true&markers=icon:"+locationIcon+"|"+locationMap+"&sensor=false\" class=\"span12 img-polaroid\" />";
                            }
                        }
                    });
                });
            <? } ?>
        </script>

	</body>

</html>