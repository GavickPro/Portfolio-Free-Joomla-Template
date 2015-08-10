<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Header layout
$headerData = array(
	'params' => $this->params
);
$headerLayout = new JLayoutFile('gk.components.header');

?>

<div class="search<?php echo $this->pageclass_sfx; ?>">
	<?php echo $headerLayout->render($headerData); ?>

	<?php echo $this->loadTemplate('form'); ?>

	<?php if ($this->error == null && count($this->results) > 0) :
		echo $this->loadTemplate('results');
	else :
		echo $this->loadTemplate('error');
	endif; ?>
</div>
