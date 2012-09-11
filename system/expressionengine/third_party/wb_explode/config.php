<?php

if (! defined('EXPLODE_NAME'))
{
	define('EXPLODE_NAME', 'WB Explode');
	define('EXPLODE_VER',  '1.2.1');
	define('EXPLODE_DESC', 'Given a string, a value to look for, and optionally an offset, will take a string separated by pipes (e.g. |) and return the first or first value or the odd or even values.');
	define('EXPLODE_DOCS', 'http://github.com/wesbaker/wb.explode.ee2_addon');
	define('EXPLODE_AUTHOR', 'Wes Baker');
	define('EXPLODE_URL', 'http://github.com/wesbaker/wb.explode.ee2_addon');
}

$config['name']    = EXPLODE_NAME;
$config['version'] = EXPLODE_VER;
// $config['nsm_addon_updater']['versions_xml'] = '';