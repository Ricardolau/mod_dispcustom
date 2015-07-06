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
$cliente = ModdispcustomHelper::getcliente($params);

# Ahora simplente comprobamos si hay coincidencia en SO o Nav , si la hay
# mostramos o excluimos según nos indique el params->filtro
# creando variables $mostramos donde 0 es Excluir
# y 1 mayor es mostrar.
$mostramos = 0;
if ($params->get('filtro')>0){
	$mostramos = 1;
} 
$sumaCoincidencia = $cliente['coincideSO'] + $cliente['coincideNav'];
if (($sumaCoincidencia > 0) & ($mostramos == 1)) {
	
	$mostramos = ($mostramos -$sumaCoincidencia);
} else {
	$mostramos = ($mostramos +$sumaCoincidencia);
	}
# Ahora según resultado mostramos o no debemos continuar cargar o no el modulo.


if (($mostramos>0)){

foreach ($items as $row) {
$images = json_decode($row->images);
$id = $row->id;
$category = $row->category;
$title = $row->title;
$introtext = $row->introtext;
$alias = $row->alias;
$articulo = $row;
}



$module->content = $introtext;

# En la linea anterior añadimos el contenido items en module -> content 

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_dispcustom', $params->get('layout', 'default'));
}

