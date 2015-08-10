<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?></p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
	<fieldset class="newsfeed__fieldset">
		<?php if ($this->params->get('filter_field') != 'hide') :?>
		<input type="text" name="filter-search" id="filter-search" class="newsfeed__form_left" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" onchange="document.adminForm.submit();" placeholder="<?php echo JText::_('COM_NEWSFEEDS_FILTER_SEARCH_DESC'); ?>" />
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="newsfeed__form_right">
			<label for="limit">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<?php endif; ?>
	</fieldset>
	<?php endif; ?>
	
	<div class="newsfeed__list">
		<?php foreach ($this->items as $i => $item) : ?>
			<li class="newsfeed__item">
				<?php if ($this->params->get('show_articles')) : ?>
				<span class="newsfeed__count">
					<?php echo JText::sprintf('COM_NEWSFEEDS_NUM_ARTICLES_COUNT', $item->numarticles); ?>
				</span>
				<?php endif; ?>
				
				<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>" class="newsfeed__header">
					<?php echo $item->name; ?>
				</a>
			
				<?php  if ($this->params->get('show_link')) : ?>
					<?php $link = JStringPunycode::urlToUTF8($item->link); ?>
					<a href="<?php echo $item->link; ?>" class="newsfeed__url">
						<?php echo $link; ?>
					</a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</div>

	<?php // Add pagination links ?>
	<?php if (!empty($this->items)) : ?>
		<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
			<div class="newsfeed__pagination">
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	<?php  endif; ?>
</form>
<?php endif; ?>
