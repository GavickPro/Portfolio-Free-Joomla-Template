<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post" class="search__form <?php echo $this->params->get('pageclass_sfx'); ?>">
	<div class="search__inputs clearfix">
		<input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="search__input" />
		<button name="Search" onclick="this.form.submit()" class="search__btn">
			<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>
		</button>
		<input type="hidden" name="task" value="search" />
	</div>

	<fieldset class="search__phrases search__fieldset">
		<legend class="search__fieldset_legend"><?php echo JText::_('COM_SEARCH_FOR');?></legend>
		<div class="search__phrases_box">
			<?php echo $this->lists['searchphrase']; ?>
		</div>
		<div class="search__ordering_box">
			<label for="ordering" class="search__ordering_label">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label>
			<?php echo $this->lists['ordering'];?>
		</div>
	</fieldset>

	<?php if ($this->params->get('search_areas', 1)) : ?>
	<fieldset class="search__only search__fieldset">
		<legend class="search__fieldset_legend"><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></legend>
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
		?>
		<label for="area-<?php echo $val;?>" class="search__checkbox_label">
			<input type="checkbox" name="areas[]" class="search__checkbox" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
			<?php echo JText::_($txt); ?>
		</label>
		<?php endforeach; ?>
	</fieldset>
	<?php endif; ?>

	<div class="search__intro">
		<?php if (!empty($this->searchword)):?>
		<p class="search__intro_text"><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="search__intro_badge">' . $this->total . '</span>');?></p>
		<?php endif;?>
	</div>

	<?php if ($this->total > 0) : ?>
	<div class="search__limit">
		<label for="limit" class="search__limit_label">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
	<p class="search__counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php endif; ?>
</form>
