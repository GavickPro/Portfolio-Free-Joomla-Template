<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Merging the leading and intro items
$items = array_merge($this->lead_items, $this->intro_items);

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
<div class="content <?php echo $this->pageclass_sfx;?>" itemscope itemtype="http://schema.org/Blog">
	<?php echo $headerLayout->render($headerData); ?>	

	<?php if (!empty($items)) : ?>
	<div class="content__items clearfix">
		<?php foreach ($items as &$item) : ?>
			<?php
				$this->item = &$item;
				$this->item->columns = $this->columns;
				echo $this->loadTemplate('item');
			?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<?php echo $paginationLayout->render($paginationData); ?>
</div>
