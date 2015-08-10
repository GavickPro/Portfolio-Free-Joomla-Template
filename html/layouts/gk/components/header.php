<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>

<?php if ($displayData['params']->get('show_page_heading')) : ?>
<div class="content__header">
	<h1 class="content__header_title">
		<?php if ($this->escape($displayData['params']->get('page_heading'))) : ?>
			<?php echo $this->escape($displayData['params']->get('page_heading')); ?>
		<?php else : ?>
			<?php echo $this->escape($displayData['params']->get('page_title')); ?>
		<?php endif; ?>
	</h1>
</div>
<?php endif; ?>