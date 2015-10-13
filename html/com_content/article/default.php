<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$urlForSharing = urlencode(JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
$titleForSharing = join('+', explode(' ', $this->escape($this->item->title))); 
// Header layout
$headerData = array(
	'show' => $this->params->get('show_page_heading'),
	'text' => $this->params->get('page_heading')
);
$headerLayout = new JLayoutFile('gk.content.header');

JHtml::_('behavior.caption');
?>

<?php echo $headerLayout->render($headerData); ?>

<div class="subpage post <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />

	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
	<div class="post__image"> 
		<img 
			class="post__image_img"
			title="<?php echo htmlspecialchars($images->image_fulltext_caption); ?>" 
			src="<?php echo htmlspecialchars($images->image_fulltext); ?>" 
			alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" 
			itemprop="image"
		/> 
	</div>
	<?php endif; ?>

	<?php if ($params->get('show_title')) : ?>
	<div class="post__header">
		<h2 class="post__header_title" itemprop="name">
			<?php echo $this->escape($this->item->title); ?>
		</h2>
	</div>
	<?php endif; ?>

	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'print' => $this->print, 'position' => 'above')); ?>

	<?php if (!$params->get('show_intro')) : ?> 
		<?php echo $this->item->event->afterDisplayTitle; ?>
	<?php endif; ?>
	
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if ($params->get('access-view')):?>
		<div class="post__content" itemprop="articleBody">
			<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position))) || (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
				<?php echo $this->loadTemplate('links'); ?>
			<?php endif; ?>

			<?php if (isset ($this->item->toc)) : ?>
				<?php echo $this->item->toc; ?>
			<?php endif; ?>

			<?php echo $this->item->text; ?>

			<?php echo $this->item->event->afterDisplayContent; ?>
	
			<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
				<?php echo $this->loadTemplate('links'); ?>
			<?php endif; ?>

			<?php 
				$app = JFactory::getApplication();
				$templateParams = $app->getTemplate(true)->params;
				
				if($templateParams->get('showSocialIcons', 0) == 1) :
			?>
			<div class="social__buttons">
				<span class="social__buttons_label"><?php echo JText::_('TPL_GK_PORTFOLIO_SHARE'); ?></span>
				
				<a class="social__buttons_btn social__buttons_btn--twitter" href="http://twitter.com/share?text=<?php echo $titleForSharing; ?>&amp;url=<?php echo $urlForSharing; ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">
		            <span class="social__buttons--hidden"><?php echo JText::_('TPL_GK_PORTFOLIO_TWITTER'); ?></span>
		        </a>    
					
				<a class="social__buttons_btn social__buttons_btn--fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlForSharing; ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">
				    <span class="social__buttons--hidden"><?php echo JText::_('TPL_GK_PORTFOLIO_FB'); ?></span>
				</a>
				
				<a class="social__buttons_btn social__buttons_btn--gplus" href="https://plus.google.com/share?url=<?php echo $urlForSharing; ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;">
		            <span class="social__buttons--hidden"><?php echo JText::_('TPL_GK_PORTFOLIO_GPLUS'); ?></span>
		        </a>
			</div>
			<?php endif; ?>

			<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render(array('tags' => $this->item->tags->itemTags, 'class' => 'post__tags item__info')); ?>
			<?php endif; ?>
		</div>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
		<?php echo $this->item->introtext; ?>
		
		<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
			<?php $menu = JFactory::getApplication()->getMenu(); ?>
			<?php $active = $menu->getActive(); ?>
			<?php $itemId = $active->id; ?>
			<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
			<?php $link->setVar('return', base64_encode(JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language), false))); ?>
			<p class="readmore">
				<a href="<?php echo $link; ?>" class="register">
				<?php $attribs = json_decode($this->item->attribs); ?>
				<?php
				if ($attribs->alternative_readmore == null) :
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				elseif ($readmore = $this->item->alternative_readmore) :
					echo $readmore;
					if ($params->get('show_readmore_title', 0) != 0) :
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif;
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
				else :
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				endif; ?>
				</a>
			</p>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if (!empty($this->item->pagination) && $this->item->pagination): ?>
	<?php echo preg_replace('@rel="next">.*?</a>@mis', 'rel="next"><i class="fa fa-arrow-right"></i></a>', preg_replace('@rel="prev">.*?</a>@mis', 'rel="prev"><i class="fa fa-arrow-left"></i></a>', $this->item->pagination)); ?>
<?php endif; ?>