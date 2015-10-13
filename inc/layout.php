<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/*
	Function used to generate the <html> element attributes
 */
function gkHtmlAtts($tpl) {
	$output  = ' lang="' . $tpl->language .'"';
	$output .= ' dir="'. $tpl->direction .'"';
	return $output;
}

/*
	Function used to detect old IE versions ( <= IE9 )
 */
function gkIsOldIE() {
	jimport('joomla.environment.browser');

    $browser = JBrowser::getInstance();

    $ie6 = preg_match('/msie\s(5\.[5-9]|[6]\.[0-9]*).*(win)/i', $browser->
            getAgentString()) && !preg_match('/msie\s([7-9]\.[0-9]*).*(win)/i', $browser->
            getAgentString());
    $ie7 = preg_match('/msie\s[7]/i', $browser->getAgentString());
    $ie8 = preg_match('/msie\s[8]/i', $browser->getAgentString());
    $ie9 = preg_match('/msie\s[9]/i', $browser->getAgentString());
    
    return $ie6 || $ie7 || $ie8 || $ie9;
}

/*
	Function used to create the template logo
 */
function gkLogo($params) {
	$logoClass = 'logo logo--text';

	if($params->get('logoFile', '') !== '') {
		$logo_class = 'logo logo--image';
	}

	$title = $params->get('siteTitle', '');
	$desc = $params->get('siteDescription', '');
	$file = $params->get('logoFile', '');
	$isLogoFile = $params->get('logoFile', '') !== '';
	$isDescription = $params->get('siteDescription', '') != '';

	?>
	<a class="<?php echo $logoClass; ?>" href="/" title="<?php echo $title; ?>" rel="home">
		<?php if($isLogoFile) : ?>
			<img src="<?php echo $file; ?>" class="logo__image" alt="<?php echo $title; ?>" />
		<?php else: ?>
			<h1 class="logo__title"><?php echo $title; ?></h1>
			<?php if($isDescription) : ?>
			<h2 class="logo__description"><?php echo $desc; ?></h2>
			<?php endif; ?>
		<?php endif; ?>
	</a>
	<?php
}

/*
	Function used to create an excerpt
 */
function gkExcerpt($text, $len, $more = '&hellip;') {
	// Getting params from template
	$app = JFactory::getApplication();
	$params = $app->getTemplate(true)->params;
	
	$useMore = false;
	
	// Remove HTML tags from excerpt if option for tags stripping is enabled
	if($params->get('excerptStripTags', '1') == '1') {
		$text = strip_tags($text);
	}
	
	$text = explode(' ', $text);

	if(count($text) > $len) {
		$useMore = true;
	}

	$text = array_slice($text, 0, $len);
	$text = implode(' ', $text);

	if($useMore) {
		$text .= $more;
	}

	return $text;
}

/*
	Function used to get Google Font Family name
 */
function gkResolveGoogleFont($param) {
	$param = preg_replace('@&.+@', '', $param);
	$param = preg_replace('@:.+@', '', $param);
	$param = str_replace('+', ' ', $param);
	
	return "'" . $param . "', sans-serif";
}

/*
	Function used to detect portfolio layouts
 */
function gkIsPortfolioView() {
	$input = JFactory::getApplication()->input;

	return 
		$input->getCmd('option', '') === 'com_content' && 
		(
			$input->getCmd('view', '') === 'featured' || 
			(
				$input->getCmd('view', '') === 'category' && 
				$input->getCmd('layout', '') === 'blog'
			)
		);
}

function gkIsArticleView() {
	$input = JFactory::getApplication()->input;

	return $input->getCmd('option', '') === 'com_content' && $input->getCmd('view', '') === 'article';
}

function gkIsNarrowView() {
	$input = JFactory::getApplication()->input;
	
	return $input->getCmd('option', '') === 'com_users' && $input->getCmd('view', '') === 'login';
}

function gkModuleNumber($tpl, $count, $default = 2) {
	$count = intval($tpl->countModules($count));
	$max = intval($tpl->params->get($count . 'Cols', $default));
	
	if($count > $max) {
		return $max;
	}
	
	return $count;
}

// EOF