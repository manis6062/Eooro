<?php

if( strpos( $_SERVER['REQUEST_URI'], 'location') ){
    
}
else {
    include(EDIRECTORY_ROOT."/includes/code/breadcrumb.php");
   
    if ($show_breadcrumb) { ?>
		<p class="breadcrumb"><?=$breadcrumb->show_breadcrumb()?></p>
	<? } elseif ($show_auxbreadcrumb) { ?>
		<p class="breadcrumb"><?=$show_auxbreadcrumb?></p>
	<? }
    unset($page);
}