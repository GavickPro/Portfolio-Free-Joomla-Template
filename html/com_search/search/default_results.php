<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<dl class="search__results result">
<?php foreach ($this->results as $result) : ?>
	<dt class="result__title">
		<span class="result__counter"><?php echo $this->pagination->limitstart + $result->count; ?></span>
		<?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?> class="result__title_link">
				<?php echo $this->escape($result->title);?>
			</a>
		<?php else:?>
			<?php echo $this->escape($result->title);?>
		<?php endif; ?>
	</dt>
	<dd class="result__text">
		<p><?php echo $result->text; ?></p>

		<?php if ($result->section) : ?>
		<span class="result__category">(<?php echo $this->escape($result->section); ?>)</span>
		<?php endif; ?>

		<?php if ($this->params->get('show_date') && $result->created) : ?>
		<span class="result__created">
			<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
		</span>
		<?php endif; ?>
	</dd>
<?php endforeach; ?>
</dl>

<div class="result__pagination pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
