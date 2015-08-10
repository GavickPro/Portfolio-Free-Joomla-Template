<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::stylesheet('com_finder/finder.css', false, true, false);

// Header layout
$headerData = array(
	'params' => $this->params
);
$headerLayout = new JLayoutFile('gk.components.header');

?>

<div class="search finder<?php echo $this->pageclass_sfx; ?>">
	<?php echo $headerLayout->render($headerData); ?>

	<?php if ($this->params->get('show_search_form', 1)) : ?>
	<?php echo $this->loadTemplate('form'); ?>
	<?php endif; ?>
	
	<?php if ($this->query->search === true): ?>
	<?php echo $this->loadTemplate('results'); ?>
	<?php endif; ?>
</div>
