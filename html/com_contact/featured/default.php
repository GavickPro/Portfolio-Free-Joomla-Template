<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');


// Header layout
$headerData = array(
	'show' => $this->params->get('show_page_heading'),
	'text' => $this->params->get('page_heading')
);
$headerLayout = new JLayoutFile('gk.content.header');

// Pagination layout
$paginationData = array(
	'params' => $this->params,
	'pagination' => $this->pagination
);
$paginationLayout = new JLayoutFile('gk.content.pagination');

?>
<div class="blog-featured<?php echo $this->pageclass_sfx;?>">
	<?php echo $headerLayout->render($headerData); ?>	

	<?php echo $this->loadTemplate('items'); ?>

	<?php echo $paginationLayout->render($paginationData); ?>
</div>
