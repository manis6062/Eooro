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
	# * FILE: /layout/themenavbar.php
	# ----------------------------------------------------------------------------------------------------

    unset($edir_themes);
    unset($edir_themenames);
    unset($edir_schemes);
    unset($edir_schemenames);

    //Themes
    $edir_themes = explode(",", EDIR_THEMES);
    $edir_themenames = explode(",", EDIR_THEMENAMES);

    //Schemes
    $edir_schemes = explode(",", EDIR_SCHEMES);
    $edir_schemenames = explode(",", EDIR_SCHEMENAMES);

    if (count($edir_schemes) > 2) {

        $navbarOptions .= "
            <div class=\"live-list wlink\" id=\"schemes-list\">
            
                <a class=\"live-dropdown live-arrow\"> ".system_showText(LANG_MENU_CHOOSESCHEME)." </a>
                    
                <ul>";

                    $edir_i = 0;
                    for ($edir_i = 0; $edir_i < count($edir_schemes); $edir_i++) {
                        if ($edir_schemes[$edir_i] != "custom") {
                            $selected = (EDIR_SCHEME == $edir_schemes[$edir_i]) ? "selected" : "";
                            
                            if (EDIR_LANGUAGE == "pt_br") {
                                
                                if ($edir_schemenames[$edir_i] == "Real Estate") {
                                    $edir_schemenames[$edir_i] = "Guia de Imobiliárias";
                                } elseif ($edir_schemenames[$edir_i] == "Dining Guide") {
                                    $edir_schemenames[$edir_i] = "Guia de Restaurantes";
                                }
                                
                            }
                            
                            $navbarOptions .= "<li onclick=\"Redirect($(this).find('a').attr('href'));\"><a href=\"".NON_SECURE_URL."/settheme.php?theme=".$edir_schemes[$edir_i]."&amp;changeScheme=true&amp;destiny=".system_denyInjections($_SERVER["PHP_SELF"])."&amp;query=".system_denyInjections(string_htmlentities($_SERVER["QUERY_STRING"]))."\">".$edir_schemenames[$edir_i]."</a></li>";
                            unset($selected);
                        }
                    }
                    
                    if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
                        $domainThemeURL = "http://www.edirectory.com.br/recursos-diretorios-online/temas-do-edirectory/";
                    } else {
                        $domainThemeURL = "http://www.edirectory.com/edirectory-themes.php";
                    }
                    
                    $navbarOptions .= "<li><a href=\"$domainThemeURL\" target=\"_blank\">".system_showText(ucfirst(LANG_MORE))." &raquo;</a></li>
                </ul>
                
            </div>";
    }
    
    if (count($edir_themes) > 1) {
        $navbarOptions .= "
            <div class=\"live-list wlink\" id=\"themes-list\">
            
                <a class=\"live-dropdown live-arrow\">".system_showText(LANG_MENU_CHOOSETHEME)."</a>
                    
                <ul>";
                    $edir_i = 0;
                    $domainURL = "";
                    for ($edir_i = 0; $edir_i < count($edir_themes); $edir_i++) {
                        if ($edir_themes[$edir_i] == "default") {
                            if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
                                $domainURL = "http://www.demodirectory.com.br";
                            } else {
                                $domainURL = "http://www.demodirectory.com";
                            }
                        } elseif ($edir_themes[$edir_i] == "realestate") {
                            if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
                                $domainURL = "http://guiadeimobiliaria.demodirectory.com.br/";
                            } else {
                                $domainURL = "http://realestate.demodirectory.com/";
                            }
                        } elseif ($edir_themes[$edir_i] == "diningguide") {
                            if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
                                $domainURL = "http://guiaderestaurante.demodirectory.com.br/";
                            } else {
                                $domainURL = "http://diningguide.demodirectory.com/";
                            }
                        } else {
                            $domainURL = "http://demodirectory.com";
                        }
                        
                        if (EDIR_LANGUAGE == "pt_br") {
                                
                            if ($edir_themenames[$edir_i] == "Real Estate") {
                                $edir_themenames[$edir_i] = "Guia de Imobiliarias";
                            } elseif ($edir_themenames[$edir_i] == "Dining Guide") {
                                $edir_themenames[$edir_i] = "Guia de Restaurantes";
                            }

                        }
                        
                        if ($edir_themes[$edir_i] != "custom"){
                            $selected = (EDIR_THEME == $edir_themes[$edir_i]) ? "selected" : "";
                            $navbarOptions .= "<li onclick=\"Redirect($(this).find('a').attr('href'));\"><a href=\"".$domainURL."\">".$edir_themenames[$edir_i]."</a></li>";
                            unset($selected);
                        }
                        
                        if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
                            $domainThemeURL = "http://www.edirectory.com.br/recursos-diretorios-online/temas-do-edirectory/";
                        } else {
                            $domainThemeURL = "http://www.edirectory.com/edirectory-themes.php";
                        }
                    }
                    $navbarOptions .= "<li><a href=\"$domainThemeURL\" target=\"_blank\">".system_showText(ucfirst(LANG_MORE))." &raquo;</a></li>
                </ul>
            </div>";

    }

    unset($edir_themes);
    unset($edir_themenames);
    unset($edir_schemes);
    unset($edir_schemenames);
?>