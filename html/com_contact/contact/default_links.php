<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php echo '<h3>' . JText::_('COM_CONTACT_LINKS') . '</h3>';  ?>

<ul class="contact_single__links">
	<?php
	// Letters 'a' to 'e'
	foreach (range('a', 'e') as $char) :
		$link = $this->contact->params->get('link' . $char);
		$label = $this->contact->params->get('link' . $char . '_name');

		if (!$link) :
			continue;
		endif;

		// Add 'http://' if not present
		$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

		// If no label is present, take the link
		$label = ($label) ? $label : $link;
		?>
		<li class="contact_single__links_item">
			<a href="<?php echo $link; ?>" itemprop="url">
				<?php echo $label; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
