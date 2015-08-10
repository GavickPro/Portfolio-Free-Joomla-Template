<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_media');

// Header layout
$headerData = array(
	'show' => $this->params->get('show_page_heading'),
	'text' => $this->params->get('page_heading')
);
$headerLayout = new JLayoutFile('gk.content.header');

?>
<div class="contact contact_single <?php echo $this->pageclass_sfx?>" itemscope itemtype="http://schema.org/Person">
	<?php echo $headerLayout->render($headerData); ?>	

	<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
		<div class="page-header">
			<h2>
				<span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
			</h2>
		</div>
	<?php endif;  ?>

	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="contact_single__thumbnail">
			<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle', 'itemprop' => 'image')); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
		<h3 class="contact_single__category">
			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
		</h3>
	<?php endif; ?>
	<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
		<h3 class="contact_single__category">
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
		</h3>
	<?php endif; ?>
	<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
		<form action="#" method="get" name="selectForm" id="selectForm" class="contact_single__select_form">
			<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
			<?php echo JHtml::_('select.genericlist', $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
		</form>
	<?php endif; ?>

	<?php  echo '<h3 class="contact_single__subheader">' . JText::_('COM_CONTACT_DETAILS') . '</h3>';  ?>

	<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
		<dl class="contact_single__list">
			<dt class="contact_single__inline_dt">
				<?php echo JText::_('TPL_GK_PORTFOLIO_POSITION'); ?>
			</dt>
			<dd class="contact_single__inline_dd" itemprop="jobTitle">
				<?php echo $this->contact->con_position; ?>
			</dd>
		</dl>
	<?php endif; ?>

	<?php echo $this->loadTemplate('address'); ?>

	<?php if ($this->params->get('allow_vcard')) :	?>
		<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
		<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
		<?php echo JText::_('COM_CONTACT_VCARD');?></a>
	<?php endif; ?>

	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php echo '<h3 class="contact_single__subheader">' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>';  ?>
		<?php echo $this->loadTemplate('form');  ?>
	<?php endif; ?>

	<?php if ($this->params->get('show_links')) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>

	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php echo '<h3 class="contact_single__subheader">' . JText::_('JGLOBAL_ARTICLES') . '</h3>';  ?>
		<?php echo $this->loadTemplate('articles'); ?>
	<?php endif; ?>

	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php echo '<h3 class="contact_single__subheader">' . JText::_('COM_CONTACT_PROFILE') . '</h3>';  ?>
		<?php echo $this->loadTemplate('profile'); ?>
	<?php endif; ?>

	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
		<?php echo '<h3 class="contact_single__subheader">' . JText::_('COM_CONTACT_OTHER_INFORMATION') . '</h3>';  ?>
		
		<div class="contact-miscinfo">
			<?php echo $this->contact->misc; ?>
		</div>
	<?php endif; ?>
</div>
