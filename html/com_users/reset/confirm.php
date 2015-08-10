<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

// Header layout
$headerData = array(
	'show' => $this->params->get('show_page_heading'),
	'text' => $this->params->get('page_heading')
);
$headerLayout = new JLayoutFile('gk.content.header');

?>
<div class="reset-confirm<?php echo $this->pageclass_sfx?>">
	<?php echo $headerLayout->render($headerData); ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.confirm'); ?>" method="post" class="form-validate">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<p><?php echo JText::_($fieldset->label); ?></p>
			<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
				<?php if($field->label !== '') : ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo str_replace('hasTooltip', '', $field->label); ?>
					</div>
					<div class="controls">
						<?php echo $field->input; ?>
						<button type="submit" class="validate"><?php echo JText::_('JSUBMIT'); ?></button>
					</div>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>

		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
