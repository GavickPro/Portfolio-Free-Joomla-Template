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
<div class="content <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">
	<?php echo $headerLayout->render($headerData); ?>	

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<div class="content__header">
		<h2 class="content__header_title"> 
			<?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<?php echo $this->category->title; ?>
			<?php endif; ?>
		</h2>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<div class="content__desc clearfix">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt')); ?>" class="content__desc_img" />
			<?php endif; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('gk.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>

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
	<?php else: ?>
		<?php if ($this->params->get('show_no_articles', 1)) : ?>
			<p class="content__empty_msg"><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php echo $paginationLayout->render($paginationData); ?>
</div>
