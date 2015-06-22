<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//-- Include the helper file
require_once dirname(__FILE__).'/helper.php';
// Cargamos datos de item que seleccionamos en parametros (helper)
$items = ModdispcustomHelper::getItems($params);
// Cargamos datos de cliente en bruto( datos sistema opertativo y mas de usuario)
$brutoclient = ModdispcustomHelper::getBrutocliente();
$cliente = ModdispcustomHelper::getcliente();

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_dispcustom.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_dispcustom', $params->get('layout', 'default'));
