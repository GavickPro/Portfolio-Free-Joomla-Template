<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_wrapper
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
<script type="text/javascript">
function iFrameHeight() {
	var h = 0;
	if (!document.all) {
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if (document.all) {
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
</script>

<div class="wrapper <?php echo $this->pageclass_sfx; ?>">
	<?php echo $headerLayout->render($headerData); ?>

	<iframe <?php echo $this->wrapper->load; ?>
		id="blockrandom"
		name="iframe"
		src="<?php echo $this->escape($this->wrapper->url); ?>"
		width="<?php echo $this->escape($this->params->get('width')); ?>"
		height="<?php echo $this->escape($this->params->get('height')); ?>"
		scrolling="<?php echo $this->escape($this->params->get('scrolling')); ?>"
		frameborder="<?php echo $this->escape($this->params->get('frameborder', 1)); ?>"
		class="wrapper<?php echo $this->pageclass_sfx; ?>">
		<?php echo JText::_('COM_WRAPPER_NO_IFRAMES'); ?>
	</iframe>
</div>
