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
$params = $this->params;
$useDefList = (
	(
		$params->get('show_author') && !empty($item->author )
	) || 
	$params->get('show_modify_date') || 
	$params->get('show_publish_date') || 
	$params->get('show_create_date') || 
	$params->get('show_hits') || 
	$params->get('show_category') || 
	$params->get('show_parent_category')
);

?>

<div class="archive__items">
	<?php foreach ($this->items as $i => $item) : ?>
	<div class="archived" itemscope itemtype="http://schema.org/Article">
		<h2 class="archived__header" itemprop="name">
			<?php if ($params->get('link_titles')) : ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>" itemprop="url" class="archived__header_link">
					<?php echo $this->escape($item->title); ?>
				</a>
			<?php else: ?>
				<?php echo $this->escape($item->title); ?>
			<?php endif; ?>
		</h2>
		
		
		<?php if (!$params->get('show_intro')) : ?>
			<?php echo $item->event->afterDisplayTitle; ?>
		<?php endif; ?>

		<?php if($useDefList) : ?>
		<dl class="archived__info">
			<dt class="archived__info_label"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($params->get('show_author') && !empty($item->author)) : ?>
			<dd class="archived__item archived__item--createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<?php $author = ($item->created_by_alias) ? $item->created_by_alias : $item->author; ?>
				<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
					<?php if (!empty($item->contact_link) && $params->get('link_author') == true) : ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url'))); ?>
					<?php else: ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
					<?php endif; ?>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_parent_category') && !empty($item->parent_slug)) : ?>
			<dd class="archived__item archived__item--parent_category">
				<?php $title = $this->escape($item->parent_title); ?>
				<?php if ($params->get('link_parent_category') && $item->parent_slug) : ?>
					<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)) . '" itemprop="genre">' . $title . '</a>'; ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
				<?php endif; ?>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_category')) : ?>
			<dd class="archived__item archived__item--category">
				<?php $title = $this->escape($item->category_title); ?>
				<?php if ($params->get('link_category') && $item->catslug) : ?>
					<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
				<?php endif; ?>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_publish_date')) : ?>
			<dd class="archived__item archived__item--published">
				<time datetime="<?php echo JHtml::_('date', $item->publish_up, 'c'); ?>" itemprop="datePublished">
					<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_create_date')) : ?>
			<dd class="archived__item  archived__item--created">
				<time datetime="<?php echo JHtml::_('date', $item->created, 'c'); ?>" itemprop="dateCreated">
					<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_modify_date')) : ?>
			<dd class="archived__item archived__item--modified">
				<time datetime="<?php echo JHtml::_('date', $item->modified, 'c'); ?>" itemprop="dateModified">
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
			</dd>
			<?php endif; ?>

			<?php if ($params->get('show_hits')) : ?>
			<dd class="archived__item archived__item--hits">
				<meta content="UserPageVisits:<?php echo $item->hits; ?>" itemprop="interactionCount" />
				<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
			</dd>
			<?php endif; ?>
		</dl>
		<?php endif; ?>

		<?php echo $item->event->beforeDisplayContent; ?>

		<?php if ($params->get('show_intro')) :?>
		<div class="archived__intro" itemprop="articleBody">
			<?php echo str_replace('</p>...', '&hellip;</p>', JHtml::_('string.truncateComplex', $item->introtext, $params->get('introtext_limit'))); ?>
		</div>
		<?php endif; ?>

		<?php echo $item->event->afterDisplayContent; ?>
	</div>
	<?php endforeach; ?>
</div>

<div class="archive__pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
