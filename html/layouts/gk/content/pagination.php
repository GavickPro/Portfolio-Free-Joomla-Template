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

<?php if ($displayData['params']->def('show_pagination', 2) == 1  || ($displayData['params']->get('show_pagination') == 2 && $displayData['pagination']->pagesTotal > 1)) : ?>
<div class="pagination">	
	<?php echo $displayData['pagination']->getPagesLinks(); ?>
</div>
<?php endif; ?>