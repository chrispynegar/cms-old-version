<?php

/**
 * Develop21
 *
 * @package Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

$page = Page::find_by_id($menuitem->parameters);

echo strip_tags($page->content, '<b><strong><i><em><u><style><p><span><div><table><th><tr><td><a><blockquote><pre><ol><ul><li><h1><h2><h3><h4><h5><h6><header><article><aside><section><footer>');

//echo $page->content;

?>