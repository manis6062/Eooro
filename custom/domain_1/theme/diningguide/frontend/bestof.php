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
	# * FILE: /theme/diningguide/frontend/bestof.php
	# ----------------------------------------------------------------------------------------------------
   
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/bestof.php");

?>

    <div class="row-fluid">

        <? if (count($categoriesSideBar)) { ?>
        
        <div class="sidebar bestof sidebar-resposive hidden-desktop">
            
            <div class="sidebar-title-bestof">
                <a class="btn btn-inverse" data-toggle="collapse" data-parent=".browse-category" href=".browse-category">
                    <?=system_showText(LANG_MENU_BYCUISINE);?> <b class="caret"></b>
                </a>
            </div>
            
            <ul class="browse-category collapse">
               
            <? for ($i = 0; $i < count($categoriesSideBar); $i++) { ?>
                <li <?=($category_id == $categoriesSideBar[$i]["id"] ? "class=\"active\"" : "")?>>
                    <a href="<?=$categoriesSideBar[$i]["url"]?>">
                        <?=$categoriesSideBar[$i]["title"]?>
                    </a>
                </li>
            <? } ?> 
                
            </ul>
            
        </div>
        
        <div class="sidebar bestof visible-desktop">
            
            <ul class="browse-category">
               
            <? for ($i = 0; $i < count($categoriesSideBar); $i++) { ?>
                <li <?=($category_id == $categoriesSideBar[$i]["id"] ? "class=\"active\"" : "")?>>
                    <a href="<?=$categoriesSideBar[$i]["url"]?>">
                        <?=$categoriesSideBar[$i]["title"]?>
                    </a>
                </li>
            <? } ?> 
                
            </ul>
            
        </div>
        
        <? } ?>
        
        <div class="content side-right">
            
            <? if (is_array($array_show_listings) && count($array_show_listings)) { ?>
            
            <div class="top-pagination">
                
                <div class="line-bottom">
                    <? include(system_getFrontendPath("results_filter.php")); ?>
                    <? include(system_getFrontendPath("results_pagination.php")); ?>
                </div>
                
            </div>
                        
            <ul class="thumbnails featured-listing">
                
                <?
                $countClear = 0;

                for ($i = 0; $i < count($array_show_listings); $i++) {
                   
                    if ($i == 0) { ?>
                
                        <li class="span12 row-fluid special-listing hidden-phone">
                            
                            <div class="listing-info">
                                <h2>
                                    <a href="<?=$array_show_listings[$i]["link"];?>"><?=$array_show_listings[$i]["title"];?></a>
                                </h2>
                                
                                <?=$array_show_listings[$i]["review"];?>
                                
                                <? if ($array_show_listings[$i]["location"]) { ?>
                                    <address><?=$array_show_listings[$i]["location"];?></address>
                                <? } ?>
                                
                                <? if ($array_show_listings[$i]["description"]) { ?>
                                    <p><?=$array_show_listings[$i]["description"];?></p>
                                <? } ?>
                                
                                <p class="text-center">
                                    <a class="btn btn-success btn-small" href="<?=$array_show_listings[$i]["link"];?>">
                                        <?=system_showText(LANG_READMORE);?>
                                    </a>                                
                                </p>
                                
                            </div>
                            
                            <?=$array_show_listings[$i]["image"];?>
                            
                        </li>
                        
                        <li class="span12 row-fluid special-listing visible-phone">
                            
                            <div class="listing-info">
                                
                                <?=$array_show_listings[$i]["image"];?>
                                
                                <h2>
                                    <a href="<?=$array_show_listings[$i]["link"];?>"><?=$array_show_listings[$i]["title"];?></a>
                                </h2>
                                
                                <?=$array_show_listings[$i]["review"];?>
                                
                                <? if ($array_show_listings[$i]["location"]) { ?>
                                    <address><?=$array_show_listings[$i]["location"];?></address>
                                <? } ?>
                                
                                <? if ($array_show_listings[$i]["description"]) { ?>
                                    <p><?=$array_show_listings[$i]["description"];?></p>
                                <? } ?>
                                
                                <p class="text-center">
                                    <a class="btn btn-success btn-small" href="<?=$array_show_listings[$i]["link"];?>">
                                        <?=system_showText(LANG_READMORE);?>
                                    </a>                                
                                </p>
                                
                            </div>
                            
                        </li>
                        
                    <? } else { ?>
                        
                        <li class="span6">
                            
                            <div class="thumbnail">
                                
                                <div class="image">
                                    
                                    <?=$array_show_listings[$i]["image"];?>
                                    
                                    <h3>
                                        <a href="<?=$array_show_listings[$i]["link"];?>"><?=$array_show_listings[$i]["title_minor"];?></a>
                                    </h3>
                                    
                                </div>
                                
                                <div class="featured-body">
                                    
                                    <?=$array_show_listings[$i]["review"];?>
                                    
                                    <? if ($array_show_listings[$i]["location"]) { ?>
                                        <address><?=$array_show_listings[$i]["location"];?></address>
                                    <? } ?>
                                    
                                    <? if ($array_show_listings[$i]["description"]) { ?>
                                        <p><?=$array_show_listings[$i]["description"];?></p>
                                    <? } ?>
                                    
                                    <p class="text-right">
                                        <a class="btn btn-success btn-small" href="<?=$array_show_listings[$i]["link"];?>">
                                            <?=system_showText(LANG_READMORE);?>
                                        </a>                                
                                    </p>
                                    
                                </div>
                                
                            </div>
                            
                        </li>
                        <?
                        $countClear++;
                        if ($countClear == 2) { ?>
                            <br class="clear" />
                        <?
                            $countClear = 0;
                        }
                    }
                } ?>

            </ul>
            
            <? } ?>
            
        </div>
        
        <? if (is_array($array_show_listings) && count($array_show_listings)) { ?>
        
        <div class="bottom-pagination">
            <? 
            $pagination_bottom = true;
            $showLetter = false;
            include(system_getFrontendPath("results_pagination.php"));
            ?>
        </div>
        
        <? } ?>
        
    </div>