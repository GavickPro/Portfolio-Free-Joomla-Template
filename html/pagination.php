<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.gk_portfolio
 *
 * @copyright   Copyright (C) 2015 GavickPro. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function pagination_list_footer($list) {
	$html = "<div class=\"pagination\">\n";
	$html .= $list['pageslinks'];
	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
	$html .= "\n</div>";

	return $html;
}

function pagination_list_render($list) {
	// Calculate to display range of pages
	$currentPage = 1;

	foreach ($list['pages'] as $k => $page) {
		if (!$page['active']) {
			$currentPage = $k;
		}
	}
	
	$html = '<div class="pagination__list">';

	if($list['previous']['active'] == 1) {
		$html .= '<span class="pagination__prev">';
		$html .= strip_tags($list['previous']['data'], '<a>');
		$html .= '</span>';
	}

	$html .= '<span class="pagination__counter">';
	$html .= JText::_('TPL_GK_PORTFOLIO_PAGE');
	$html .= $currentPage;
	$html .= JText::_('TPL_GK_PORTFOLIO_OF');
	$html .= count($list['pages']);
	$html .= '</span>';

	if($list['next']['active'] == 1) {
		$html .= '<span class="pagination__next">';
		$html .= strip_tags($list['next']['data'], '<a>');
		$html .= '</span>';
	}

	$html .= '</div>';

	return $html;
}


function pagination_item_active(&$item) {
	return '<li><a title="' . $item->text . '" href="' . $item->link . '">' . $item->text . '</a></li>';
}

function pagination_item_inactive(&$item) {
	return '<li><a>' . $item->text . '</a></li>';
}
