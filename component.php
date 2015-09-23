<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$this->language  = $doc->language;
$this->direction = $doc->direction;
$tplUrl = JUri::base() . 'templates/' . $this->template;

if(JRequest::getCmd('option') == 'com_mailto') {
	$doc->addStyleSheet($tplUrl . '/css/mailto.css');
}

if(JRequest::getCmd('print') == '1') {
	$doc->addStyleSheet($tplUrl . '/css/print.css');
}

if(JRequest::getCmd('option') == 'com_media' || JRequest::getCmd('view') == 'history') {
	$doc->addStyleSheet($tplUrl . '/css/image-popup.css');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<!--[if lt IE 9]>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
<![endif]-->
</head>
<body class="contentpane modal">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
