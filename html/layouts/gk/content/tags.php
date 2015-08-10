<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

?>
<?php if (!empty($displayData)) : ?>
<ul class="content__info content__info--tags">
	<li class="content__info_label"><?php echo JText::_('TPL_GK_PORTFOLIO_TAGGED_AS'); ?></li>
	<?php foreach ($displayData as $i => $tag) : ?>
		<?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
			<?php $tagParams = new Registry($tag->params); ?>
			<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
			<li class="content__info_item tags__item" itemprop="keywords">
				<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>" class="item__info_link tag__link <?php echo $link_class; ?>">
					<?php echo $this->escape($tag->title); ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>