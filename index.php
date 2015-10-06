<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Basic template variables
$app    = JFactory::getApplication();
$doc    = JFactory::getDocument();
$user   = JFactory::getUser();
$menu 	= $app->getMenu();
$lang 	= JFactory::getLanguage();
// Getting params from template
$params = $app->getTemplate(true)->params;

require_once('inc/head.php');
require_once('inc/layout.php');

?>
<!DOCTYPE html>
<html <?php gkHtmlAtts($this); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<jdoc:include type="head" />
	<?php if(gkIsOldIE()) : ?>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body>
	<!--[if lte IE 8]>
	<div id="ie-toolbar"><div><?php echo JText::_('TPL_GK_PORTFOLIO_IE_BANNER'); ?></div></div>
	<![endif]-->

	<?php if(count($app->getMessageQueue())) : ?>
	<jdoc:include type="message" />
	<?php endif; ?>

	<header class="header">
		<?php gkLogo($params); ?>
		
		<?php if($this->countModules('search')) : ?>
		<div class="header__search">
			<jdoc:include type="modules" name="search" style="none" />
		</div><!-- .header__search -->
		<?php endif; ?>
		
		<?php if($this->countModules('top-menu')) : ?>
		<div class="header__topmenu">
			<jdoc:include type="modules" name="top-menu" style="none" />
		</div><!-- .header__topmenu -->
		<?php endif; ?>
	</header><!-- .header -->

	<div class="hfeed site">
		<div class="site__main">
			<?php if($this->countModules('main-menu')) : ?>
			<nav class="navigation">
				<jdoc:include type="modules" name="main-menu" style="none" />	
			</nav><!-- .navigation -->
			<?php endif; ?>
			
			<?php if($this->countModules('top')) : ?>
			<div class="site__top clearfix subpage" role="complementary" data-mod-num="<?php echo $this->params->get('topCols', 2); ?>">
				<jdoc:include type="modules" name="top" style="xhtml" />
			</div><!-- .site__top -->
			<?php endif; ?>

			<div class="site__content" role="main">
				<?php if(!gkIsPortfolioView() && !gkIsNarrowView() && !gkIsArticleView()) : ?>
				<div class="subpage component">
				<?php endif; ?>

				<?php if($this->countModules('content_top') && !gkIsPortfolioView()) : ?>
				<div class="component__top subpage clearfix" role="complementary">
					<jdoc:include type="modules" name="content_top" style="xhtml" />
				</div><!-- .component__top -->
				<?php endif; ?>
				
				<jdoc:include type="component" />
				
				<?php if($this->countModules('content_bottom') && !gkIsPortfolioView()) : ?>
				<div class="component__bottom subpage clearfix" role="complementary">
					<jdoc:include type="modules" name="content_bottom" style="xhtml" />
				</div><!-- .component__bottom -->
				<?php endif; ?>

				<?php if(!gkIsPortfolioView() && !gkIsNarrowView()) : ?>
				</div><!-- subpage component -->
				<?php endif; ?>
			</div><!-- .site__content -->
		</div><!-- .site__main -->
	</div>

	<?php if($this->countModules('breadcrumb')) : ?>
	<div class="breadcrumb">
		<jdoc:include type="modules" name="breadcrumb" style="none" />
	</div><!-- .breadcrumb -->
	<?php endif; ?>

	<footer class="footer">
		<?php if($this->countModules('bottom')) : ?>
		<div class="footer__bottom" role="complementary" data-mod-num="<?php echo $this->params->get('bottomCols', 2); ?>">
			<jdoc:include type="modules" name="bottom" style="xhtml" />
		</div><!-- .footer__bottom -->
		<?php endif; ?>
		
		<?php if($this->countModules('social-menu')) : ?>
		<div class="footer__social">
			<jdoc:include type="modules" name="social-menu" style="none" />
		</div><!-- .footer__social -->
		<?php endif; ?>
		
		<div class="footer__copyrights">
			<?php if($this->countModules('copyrights')) : ?>
			<div class="footer__copyrights_module">
				<jdoc:include type="modules" name="copyrights" style="none" />
			</div><!-- .footer__copyrights_module -->
			<?php endif; ?>	
			
			<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?> 
				<p class="footer__copyrights_text">Free Joomla Template by <a href="https://www.gavick.com">Gavick.com</a></p>
			<?php else : ?>
				<p class="footer__copyrights_text">Free Joomla Template by Gavick.com</p>
			<?php endif; ?>

		</div><!-- .footer__copyrights -->
	</footer><!-- .footer -->

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
