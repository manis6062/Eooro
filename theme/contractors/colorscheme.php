<!--Marker--><?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2011 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /theme/contractors/colorscheme.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-type: text/css");
	
?><!--Marker-->
/**
* eDirectory - Color Scheme
*
* @package			design
* @filesource		colorscheme.php
* @author			Arca Solutions
* @copyright		Copyright (c) 2013, Arca Solutions Inc.
* @version			eDirectory 10.0.0.00
* @since			September, 1, 2013
*			
*/

/**
* Typography
*/

body { font-family:<?=SCHEME_FONTOPTION?>; }

[class*="flex-box"] h2,
[class*="flex-box"] section h5 a,
[class*="flex-box"] section p,
[class*="flex-box"] section b,
.flex-box-group .featured-item-preview p,
.flex-box-group .featured-item-preview,
.flex-box-underline.box-statement blockquote p,
.flex-box-underline.box-statement blockquote small,
.footer-row .flex-box-list li a,
.flex-box-group .featured-item-preview b a,
.summary .title h3 a,
.post-summary section h2 a,
.flex-box .blog-item .item h3 a, 
.flex-box-group .blog-item .item h3 a {
	color:#<?=SCHEME_COLORTEXT?>;
}


/*
* LINKS
*/


a, a:link, a:visited, .btn, a.btn, .user-info p a, [class*="sidebar"] a,
a:hover, a:focus,
section.item-preview a, 
section.item-preview h5 a,
.info-advertise a, .advertisement p a,
.flex-box-list .browse-category li a,
.post-summary section h2 a:hover,
.flex-box .blog-item .item h3 a:hover,
.flex-box-group .blog-item .item h3 a:hover,
[class*="flex-box"] time a {
	color: #<?=SCHEME_COLORLINK?>;
}

.list-favorites .item-favorite h4 a {
    color: #<?=SCHEME_COLOR3?>;
}

section.item-preview a:hover, 
section.item-preview h5 a:hover ,
.flex-box-list .browse-category li a:hover,
.footer-row .flex-box-list li a:hover,
[class*="flex-box"] section h5 a:hover,
.flex-box-group .featured-item-preview b a:hover,
.flex-box-group .item-preview h5 a:hover,
.flex-box-list a:hover,
.summary .title h3 a:hover,
.info-advertise a:hover, .advertisement p a:hover,
[class*="flex-box"] time a:hover,
.memberMenu a:hover ,
.user-info p a:hover,
member-activity a:hover,
domainItemsList a:hover,
[class*="standard-table"] a:hover,
.login-underbox a:hover,
.login-box form a:hover {
	color: #<?=SCHEME_COLORLINK?>;
	opacity:0.7;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
}


/*
* Text Colors
*/

.text-success, a.text-success, a.text-success:hover {
	color:#<?=SCHEME_COLOR3?>;
}

.text-warning, a.text-warning, .text-warning, a.text-warning , a.text-warning:hover {
	color:#<?=SCHEME_COLOR4?>;
}

.text-info, a.text-info, a.text-info:hover {
	color:#<?=SCHEME_COLOR2?>;
}

h2 a.view-more, h2 a.view-more:hover {
    color: #<?=SCHEME_COLOR3?>;
}



/*
* Opacity 
*/

.flex-box-underline.box-statement blockquote p,
.flex-box-group .featured-item-preview b a,
[class*="sidebar"] a:hover,
.summary section a:hover, .summary .review a:hover,
h2 a.view-more:hover,
.member-activity a:hover {
	opacity:0.7;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
}



/**
* Body
*/

body {
    background-color: #<?=SCHEME_COLORBACKGROUND?>;
}

body.allpopup, body.previewmember {
    background-color: white;
}

body, body p, .content-custom, 
.flex-box-list ul li a,
section.item-preview b ,
.content-custom h1, .content-custom h2, .content-custom h3, .content-custom h4, .content-custom h5, .content-custom h6 {
	color:#<?=SCHEME_COLORTEXT?>;
}

/*Color 1*/

.listing-tag-deal, .deal-tag-small, 
.calendar-event li.active, .calendar-event li:hover {
	background-color:#<?=SCHEME_COLOR1?>;
}

.calendar-event li.active:after, .calendar-event li:hover:after {
    border-color: #<?=SCHEME_COLOR1?> transparent transparent;
}

.pagination ul > li a.active,
.pagination ul > li a.active:hover {
	background-color:#<?=SCHEME_COLOR1?>;
	border-color: #<?=SCHEME_COLOR1?>
}

/*
* Color 2
*/

.flex-box-group .total-reviews,
.footer-row .flex-box-list li span,
[class*="sidebar"] [class*="icon-caret"],
[class*="sidebar"] h3 [class*="icon-caret"],
.list-home li span  {
	color:#<?=SCHEME_COLOR2?>;
}

.flex-box-group .span9.reviewcounter .featured-item-preview {
	border-color:#<?=SCHEME_COLOR2?>;
}



/*
* Navbar
*/

.navbar .navbar-inner {
	background-image:none;
	background-color:#<?=SCHEME_COLOR7?>;
}

/**
* Header
*/

.navbar-static-top .nav > li > a {
    color: #<?=SCHEME_COLORNAVBARLINK?>;
}

.navbar-static-top {
	background-color: #<?=SCHEME_COLORHEADER?>;
}

.navbar-static-top .navbar-inner {
    background-image: none;
    filter:none;
	background-color: #<?=SCHEME_COLORNAVBAR?> ;    
}

.navbar-static-top .nav > .menuActived > a, .navbar-static-top .nav > .menuActived > a:hover, .navbar-static-top .nav > .menuActived > a:focus, .nav-collapse-members .nav > .menuActived > a, .nav-collapse-members .nav > .menuActived > a:hover, .nav-collapse-members .nav > .menuActived > a:focus ,
.nav-collapse-members.in .nav > li > a:hover, .nav-collapse .nav > li > a:hover {
	background-color: #<?=SCHEME_COLORNAVBAR?>
}


.navbar-static-top .nav > .menuActived > a, .navbar-static-top .nav > .menuActived > a:hover, .navbar-static-top .nav > .menuActived > a:focus, .nav-collapse-members .nav > .menuActived > a, .nav-collapse-members .nav > .menuActived > a:hover, .nav-collapse-members .nav > .menuActived > a:focus,
.nav-collapse-members .nav > li > a:hover, .navbar-static-top .nav > li > a:hover,
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a,
.navbar-static-top .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar-static-top .nav li.dropdown.open.active > .dropdown-toggle,
.navbar-static-top .btn-navbar:active, .navbar-static-top .btn-navbar.active, .navbar .btn-navbar:focus, .nav-collapse .nav > li > a:focus {
	color: #<?=SCHEME_COLORNAVBARLINK?>;
	background-color: #<?=SCHEME_COLORNAVBARLINKACTIVE?>;
	opacity:1;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	
}

.advanced-search-box {
	background-color:#<?=SCHEME_COLOR7?>;
	border-color:#<?=SCHEME_COLOR7?>;
}


/**
* Footer
*/
.socialbar {
	background-color:#<?=SCHEME_COLORFOOTER?>;
	opacity:0.8;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}

.socialbar p {
	color:#<?=SCHEME_COLORFOOTERTEXT?>;
}

.socialbar .row-fluid > a:hover {
	color:#<?=SCHEME_COLORFOOTERLINK?>;
	opacity:0.7;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
}

.footer-row {
    background-color: #<?=SCHEME_COLORBACKGROUND?>;
}


.footer-wrapper .breadcrumb a {
	color:#<?=SCHEME_COLORFOOTERLINK?>;
}

.footer-wrapper {
	background-color:#<?=SCHEME_COLORFOOTER?>;
	border-color:#<?=SCHEME_COLORFOOTER?>;
	color:#<?=SCHEME_COLORFOOTERTEXT?>;
}

.footer-wrapper p, .footer-wrapper h5, .footer-wrapper h3, .footer-wrapper h4, .footer-wrapper .nav a {
	color:#<?=SCHEME_COLORFOOTERTEXT?>;
	border-color:#<?=SCHEME_COLORFOOTERTEXT?>;
}

.footer-wrapper .nav a:hover, .footer-wrapper a,  .footer-wrapper a:active ,  .footer-wrapper a:focus {
	color:#<?=SCHEME_COLORFOOTERLINK?>;
	background-color:transparent;
}

.footer-wrapper a:hover {
	color:#<?=SCHEME_COLORFOOTERLINK?>;
	opacity:1;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}


/**
* Buttons
*/

a.btn {
	color:white;
}

.btn.btn-primary,
.btn.btn-primary:hover,
.btn.btn-primary:focus,
.btn.btn-primary:active,
.minor-nav ul li a:hover, 
.minor-nav ul li a.active,
.btn.btn-primary.active {
  color:white;
  background-color: #<?=SCHEME_COLOR1?>;
}

.btn.btn-info,
.btn.btn-info:hover,
.btn.btn-info:focus,
.btn.btn-info:active,
.btn.btn-info.active,
.modal-content .button-profile h2 a, 
.modal-content .button-profile h2 a:hover {
  color:white;
  background-color: #<?=SCHEME_COLOR2?>;
}

.btn.btn-danger,
.btn.btn-danger:hover,
.btn.btn-danger:focus,
.btn.btn-danger:active,
.btn.btn-danger.active {
  color:white;
  background-color: #<?=SCHEME_COLOR4?>;
}

.btn.btn-success ,
.btn.btn-success:hover,
.btn.btn-success:focus,
.btn.btn-success:active,
.btn.btn-success.active,
.top-info.top-review .rate > small a,
.top-info.top-review .rate > small a:hover,
.modal-content button[type="submit"], 
.modal-content button[type="submit"]:hover,
.input-button-form, a.input-button-form, .bt-highlight button, .standardButton button, .button h2 a, .content-faq button, .standardButton > a,
.input-button-form:hover, a.input-button-form:hover, .bt-highlight button:hover, .standardButton button:hover, .button h2 a:hover, .content-faq button:hover, .standardButton > a:hover {
  color:white;
  background-color: #<?=SCHEME_COLOR3?>;
}
.btn.btn-warning, 
.btn.btn-warning:hover,
.btn.btn-warning:focus,
.btn.btn-warning:active,
.btn.btn-warning.active {
  color:white;
  background-color: #<?=SCHEME_COLOR5?>;
}
.btn.btn-inverse,
.btn.btn-inverse:hover,
.btn.btn-inverse:focus,
.btn.btn-inverse:active,
.btn.btn-inverse.active,
.btn-group.open 
.btn.dropdown-toggle {
  color:white;
  background-color: #<?=SCHEME_COLOR5?>;
}

.btn:active, 
.btn.active,
.btn.active:hover {
	color:black;
}

.btn,
.btn:hover {
	color:black;
	background-color: #<?=SCHEME_COLOR7?>;
}

.btn.active, .btn:active {
	background-color: #<?=SCHEME_COLOR6?>;
}

.login-button a ,
.login-button a:hover ,
.button.button-profile h2 a:hover,
.btn.btn-inverse:hover,
.btn.btn-warning:hover,
.btn.btn-success:hover,
.btn.btn-danger:hover, 
.btn.btn-info:hover,
.btn.btn-primary:hover,
.input-button-form:hover, a.input-button-form:hover, 
.bt-highlight button:hover, .standardButton button:hover,
.button h2 a:hover, .content-faq button:hover, .standardButton > a:hover,
.modal-content button[type="submit"]:hover, .modal-content .button-profile h2 a:hover,
.top-info.top-review .rate > small a:hover {
	opacity:0.8;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
	color:white;
}

.modal-content .button-google h2 a, .modal-content .button-google h2 a:hover,
.button-google h2 a, a.btn-google, .button.button-google h2 a  {
	background-color:#E8E8E8;
	color:#111;
}

.button.button-google h2 a:hover  {
	opacity:0.8;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}

.button-facebook h2 a, a.btn-facebook, div.btn-facebook, a.btn-facebook:focus, a.btn-facebook:active, 
.button-facebook h2 a:hover {
	background-color:#5C6A90;
}


/*
* TABS
*/

.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus {
    background-color: #<?=SCHEME_COLOR2?>;
    border-color: -moz-use-text-color -moz-use-text-color #<?=SCHEME_COLOR2?>;
}

.nav-tabs {
    border-color: #<?=SCHEME_COLOR2?>;
}

.tabs-advertise > .active > a, .tabs-advertise > .active > a:hover, .tabs-advertise > .active > a:focus,
.profile-tabs > .active > a, .profile-tabs > .active > a:hover, .profile-tabs > .active > a:focus {
	background-color:#<?=SCHEME_COLOR1?>;
}

.nav-tabs > li > a:hover, .nav-tabs > li > a:focus, .tabs-advertise > li > a:hover, .tabs-advertise > li > a:focus, .profile-tabs > li > a:hover, .profile-tabs > li > a:focus {
    background-color: #<?=SCHEME_COLOR1?>;
    border-color: #<?=SCHEME_COLOR1?>;
}

.tabsBase .tabs > li.tabActived > a, .tabsBase .tabs > li > a:hover {
    background-color: #<?=SCHEME_COLOR2?>; 
}


/*
* Grays 
* Color 6 and Color 7 
*/



.flex-box-list, [class*="flex-box"] > .row-fluid, .span12 .flex-box-group,
.newsletter, .flex-box-inline, .searchbar,
[class*="sidebar"] h3,
.faq-search,
.contactus {
	background-color:#<?=SCHEME_COLOR7?>;
	border-color:#<?=SCHEME_COLOR6?>;
}

.box-calendar, 
.flex-box, 
.flex-box-group, 
.zebra section, 
.flex-box-group .item-preview, 
.top-info,
.flex-box-title h4 {
	border-color:#<?=SCHEME_COLOR6?>;
}

.flex-box-underline {
    border-color: transparent transparent #<?=SCHEME_COLOR6?>;
}

.calendar-event li {
	background-color:#<?=SCHEME_COLOR6?>;
	color:#000;
}

.box-calendar {
	background-color:#<?=SCHEME_COLOR7?>
}

.summary.summary-backlink {
	border-color:#<?=SCHEME_COLOR1?>;
}

select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	background-color:#fff;
}

.all_reviews_preview.row-fluid, .flex-box-title > .row-fluid {
	background-color:transparent;
}

/*
* RESULTS
*/

.name-tag-deal, .name-tag-deal a, .name-tag-deal a:hover {
	color:white;
}

/*PROFILE*/
a.delete {
    background-color: #<?=SCHEME_COLOR5?>;
    color:white;
}

a.delete:hover {
    background-color: #<?=SCHEME_COLOR5?>;
    opacity:0.8;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}



/* MEMBERS*/


.notify, .alert-new {
	background-color:#<?=SCHEME_COLOR1?>;
}
.dashboard section.stats-summary h5, .dashboard section.stats-summary h1, .webitem .desc p span {
	color:#<?=SCHEME_COLOR1?>;
}


.status-active {
    background-color:#<?=SCHEME_COLOR2?>;
}

.status-suspended {
    background-color:#<?=SCHEME_COLOR5?>;
}

.status-expired {
    background-color:#<?=SCHEME_COLOR4?>;
}

.status-pending {
    background-color:#<?=SCHEME_COLOR1?>;
}


.levelTitle {
    background-color:#<?=SCHEME_COLOR1?>;
}

.levelTable .tableOption {
    background-color:#f3f3f3;
}

.levelTopdetail {
    background-color:#<?=SCHEME_COLOR1?>;
    opacity:0.8;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}

.standard-table span.categorySuccessMessage, .categorySuccessMessage {
	color:#<?=SCHEME_COLOR1?>;
}


/*CLAIM*/
.steps-ui.stepActived > span {
    background-color: #<?=SCHEME_COLOR5?>;    
}

.steps-ui.stepActived, .order-head li.active,
a.mainImageLink.mainImageLinkBK {
    background-color: #<?=SCHEME_COLOR3?>;
}

a.ImageEditCaptions:hover, a.ImageDelete:hover, a.mainImageLinkBK:hover {
	background-color:white;
}

/*ORDER*/
.orderTotalAmount {
	color:#<?=SCHEME_COLOR1?>;
}


/*Extra*/
a.btn-facebook{
	color:white;
}