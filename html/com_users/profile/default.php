<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Header layout
$headerData = array(
	'show' => $this->params->get('show_page_heading'),
	'text' => $this->params->get('page_heading')
);
$headerLayout = new JLayoutFile('gk.content.header');

?>
<div class="profile<?php echo $this->pageclass_sfx?>">
	<?php echo $headerLayout->render($headerData); ?>

	<?php echo $this->loadTemplate('core'); ?>
	<?php echo $this->loadTemplate('params'); ?>
	<?php echo $this->loadTemplate('custom'); ?>

	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
	<a class="button" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id);?>">
		<?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
	</a>
	<?php endif; ?>
</div>
