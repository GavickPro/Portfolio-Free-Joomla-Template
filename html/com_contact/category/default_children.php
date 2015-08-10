<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) :
?>
<div>
<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
	<?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>
	<div class="contacts__item">
			<h4 class="contacts__header_title">
				<a href="<?php echo JRoute::_(ContactHelperRoute::getCategoryRoute($child->id)); ?>">
					<?php echo $this->escape($child->title); ?>
				</a>

				<?php if ($this->params->get('show_cat_items') == 1) :?>
					<span class="contacts__header_count" title="<?php echo JText::_('COM_CONTACT_CAT_NUM'); ?>"><?php echo $child->numitems; ?></span>
				<?php endif; ?>
			</h4>

			<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
				<?php if ($child->description) : ?>
					<div class="contacts__desc">
						<?php echo JHtml::_('content.prepare', $child->description, '', 'com_contact.category'); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (count($child->getChildren()) > 0 ) : ?>
			<div class="contacts__categories">
			<?php
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				echo $this->loadTemplate('children');
				$this->category = $child->getParent();
				$this->maxLevel++;
			?>
			</div>
			<?php endif; ?>
	</div>
	<?php endif; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
