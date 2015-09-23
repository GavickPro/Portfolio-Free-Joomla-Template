<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Load helpr functions
require_once('layout.php');

// Path variables
$tplUrl = JUri::base() . 'templates/' . $this->template;

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($tplUrl . '/js/jquery.fitvids.js');
$doc->addScript($tplUrl . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet($tplUrl . '/css/normalize.css');
$doc->addStyleSheet($tplUrl . '/css/font-awesome.css');
$doc->addStyleSheet($tplUrl . '/css/template.css');

//
// Load the fonts if necessary
//

// Body   
$bodyFont = $this->params->get('fontBody', 'google');
$bodyFontUrl = '//fonts.googleapis.com/css?family=' . $this->params->get('googleFontBody', 'Open+Sans:400');
$bodyFontFamily = $bodyFont;

if($bodyFont == 'google') {
	$bodyFontFamily = gkResolveGoogleFont($this->params->get('googleFontBody', 'Open+Sans:400'));;
	$doc->addStyleSheet($bodyFontUrl);
}

// Header
$headerFont = $this->params->get('fontHeader', 'google');
$headerFontUrl = '//fonts.googleapis.com/css?family=' . $this->params->get('googleFontHeader', 'Open+Sans:700');
$headerFontFamily = $headerFont;

if($headerFont == 'google') {
	$headerFontFamily = gkResolveGoogleFont($this->params->get('googleFontHeader', 'Open+Sans:700'));
	$doc->addStyleSheet($headerFontUrl);
}

// Other elements
$otherFont = $this->params->get('fontOther', 'google');
$otherFontUrl = '//fonts.googleapis.com/css?family=' . $this->params->get('googleFontOther', 'Open+Sans:300');
$otherFontFamily = $otherFont;

if($otherFont == 'google') {
	$otherFontFamily = gkResolveGoogleFont($this->params->get('googleFontOther', 'Open+Sans:300'));
	$doc->addStyleSheet($otherFontUrl);
}

//
// Creating custom CSS
// 
$customCSS = '
body { 
	font-family: '.$bodyFontFamily.'; 
}

h1,
h2,
h3,
h4,
h5,
h6
.site-title { 
	font-family: '.$headerFontFamily.'; 
}

.btn,
button,
input[type="submit"],
input[type="button"],
input[type="reset"],
.logo__description {
	font-family: '.$otherFontFamily.';
}

.site {
	background: '.$this->params->get('bgColor', '#f1f1f1').';
}

.pager > .previous > a:hover,
.pager > .next > a:hover {
	background: '.$this->params->get('primaryColor', '#5cc1a9').';
}

.site__main {
	max-width: '.$this->params->get('portfolioWidth', '1240').'px;
}

.subpage,
.breadcrumb > ul {
	max-width: '.$this->params->get('contentWidth', '700').'px;	
}

a,
a.inverse:active,
a.inverse:focus,
a.inverse:hover,
.btn.btn-primary,
button,
input[type="submit"],
input[type="button"],
input[type="reset"] {
	color: '.$this->params->get('primaryColor', '#5cc1a9').';
}
.navigation .nav > li > a:active,
.navigation .nav > li > a:focus,
.navigation .nav > li > a:hover,
.navigation .nav > li.current > a,
.navigation .nav-child a:active,
.navigation .nav-child a:focus,
.navigation .nav-child a:hover,
.item__title_link:active,
.item__title_link:focus,
.item__title_link:hover,
.item__info_link:active,
.item__info_link:focus,
.item__info_link:hover,
a[class^="icon-"]:hover:before,
.pagination__next > a:active,
.pagination__next > a:focus,
.pagination__next > a:hover,
.pagination__prev > a:active,
.pagination__prev > a:focus,
.pagination__prev > a:hover,
.social__buttons_btn:active:before,
.social__buttons_btn:focus:before,
.social__buttons_btn:hover:before,
.navigation > .nav li.active > a,
.navigation > .nav li.active > span {
	color: '.$this->params->get('primaryColor', '#5cc1a9').'!important;
}

.btn.btn-primary,
button,
input[type="submit"],
input[type="button"],
input[type="reset"],
.navigation > .nav > li.active > a,
.navigation > .nav > li.active > span {
	border-color: '.$this->params->get('primaryColor', '#5cc1a9').';
}

.post__content blockquote {
	border-left: 4px solid '.$this->params->get('primaryColor', '#5cc1a9').';
}

.item__preview--featured:after {
	background: '.$this->params->get('primaryColor', '#5cc1a9').';	
}

.item {
	height: '.$this->params->get('itemHeight', '418').'px;
}

.item__helper {
	height: '.(intval($this->params->get('itemHeight', '418')) - 38).'px;
}

.item__preview {
	padding: '.$this->params->get('itemPadding', '56px 36px 36px 36px').';	
}

@media (max-width: 1140px) {
	.item {
		height: '.$this->params->get('itemMobileHeight', '336').'px;
	}

	.item__helper {
		height: '.(intval($this->params->get('itemMobileHeight', '336')) - 16).'px;
	}

	.item__preview {
		padding: '.$this->params->get('itemMobilePadding', '20px 16px 36px 16px').';	
	}
}

@media (max-width: 720px) {
	.navigation .active {
		background: '.$this->params->get('primaryColor', '#5cc1a9').';
	}
}
';

if($this->params->get('wordBreak', '0') == '1') {
	$customCSS .= '
body {
    -ms-word-break: break-all;
    word-break: break-all;
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
}
';
}

if($this->params->get('bgImage', '') !== '') {
	$customCSS .= '
.site {
	background-image: url(\''.$this->params->get('bgImage', '').'\');
	background-repeat: '.$this->params->get('bgRepeat', 'repeat').';
	background-position: '.$this->params->get('bgPosition', 'center center').';
}
'; 
}

$doc->addStyleDeclaration($customCSS);
// Add CSS overrides
$doc->addStyleDeclaration($this->params->get('customCSS'));
$doc->addStyleSheet($tplUrl . '/css/override.css');