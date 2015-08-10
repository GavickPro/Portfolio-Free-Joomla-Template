<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>
	<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
		<?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>
		<div class="newsfeeds__item">
			<h3 class="newsfeeds__header_title">
				<a href="<?php echo JRoute::_(NewsfeedsHelperRoute::getCategoryRoute($child->id));?>">
					<?php echo $this->escape($child->title); ?>
				</a>

				<?php if ($this->params->get('show_cat_items') == 1) :?>
				<span title="<?php echo JHtml::tooltipText('COM_NEWSFEEDS_NUM_ITEMS'); ?>" class="newsfeeds__header_count">
					<?php echo $child->numitems; ?>
				</span>
				<?php endif; ?>
			</h3>

			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
				<?php if ($child->description) : ?>
				<div class="newsfeeds__desc">
					<?php echo JHtml::_('content.prepare', $child->description, '', 'com_newsfeeds.category'); ?>
				</div>
				<?php endif; ?>
            <?php endif; ?>

			<?php if (count($child->getChildren()) > 0) : ?>
				<?php 
					$this->children[$child->id] = $child->getChildren();
					$this->category = $child;
					$this->maxLevel--;
					echo $this->loadTemplate('children');
					$this->category = $child->getParent();
					$this->maxLevel++;
				?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; 