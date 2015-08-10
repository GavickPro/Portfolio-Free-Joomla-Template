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

<?php if ($displayData['show'] != 0) : ?>
<div class="content__header">
	<h1 class="content__header_title">
		<?php echo $this->escape($displayData['text']); ?>
	</h1>
</div>
<?php endif; ?>