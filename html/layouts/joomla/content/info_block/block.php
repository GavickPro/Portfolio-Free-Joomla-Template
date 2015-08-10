<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$canEdit = $displayData['params']->get('access-edit');

?>
<ul class="post__info">
	<?php if ($displayData['params']->get('show_publish_date')) : ?>
		<li class="post__info_item post__info_item--published">
			<time datetime="<?php echo JHtml::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
				<?php echo JHtml::_('date', $displayData['item']->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
			</time>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
		<li class="post__info_item post__info_item--createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
			<?php $author = ($displayData['item']->created_by_alias ? $displayData['item']->created_by_alias : $displayData['item']->author); ?>
			<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
			<?php if (!empty($displayData['item']->contact_link ) && $displayData['params']->get('link_author') == true) : ?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $displayData['item']->contact_link, $author, array('itemprop' => 'url'))); ?>
			<?php else :?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
		<li class="post__info_item post__info_item--parent-category">
			<?php $title = $this->escape($displayData['item']->parent_title); ?>
			<?php if ($displayData['params']->get('link_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
				<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->parent_slug)) . '" itemprop="genre">' . $title . '</a>'; ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
			<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
			<?php endif; ?>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_category')) : ?>
		<li class="post__info_item post__info_item--category">
			<?php $title = $this->escape($displayData['item']->category_title); ?>
			<?php if ($displayData['params']->get('link_category') && $displayData['item']->catslug) : ?>
				<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
			<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
			<?php endif; ?>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_create_date')) : ?>
		<li class="post__info_item post__info_item--create">
			<time datetime="<?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?>" itemprop="dateCreated">
				<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $displayData['item']->created, JText::_('DATE_FORMAT_LC3'))); ?>
			</time>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_modify_date')) : ?>
		<li class="post__info_item post__info_item--modified">
			<time datetime="<?php echo JHtml::_('date', $displayData['item']->modified, 'c'); ?>" itemprop="dateModified">
				<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $displayData['item']->modified, JText::_('DATE_FORMAT_LC3'))); ?>
			</time>
		</li>
	<?php endif; ?>

	<?php if ($displayData['params']->get('show_hits')) : ?>
		<li class="post__info_item post__info_item--hits">
			<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $displayData['item']->hits; ?>" />
			<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $displayData['item']->hits); ?>
		</li>
	<?php endif; ?>

	<?php if (!$displayData['print']) : ?>
		<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
			<?php if ($displayData['params']->get('show_print_icon')) : ?>
				<li class="post__info_item post__info_item--print-icon"> <?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?> </li>
			<?php endif; ?>
			<?php if ($displayData['params']->get('show_email_icon')) : ?>
				<li class="post__info_item post__info_item--email-icon"> <?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?> </li>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
				<li class="post__info_item post__info_item--edit-icon"> <?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']); ?> </li>
			<?php endif; ?>
		<?php endif; ?>
	<?php else : ?>
		<li class="post__info_item post__info_item--printscreen">
			<?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params']); ?>
		</li>
	<?php endif; ?>
</ul>
