<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<!-- Custom para dispositivos -->
<div class="NuevoCustom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
	<?php 
		
	echo '<h2>Ver datos de Cliente</h2>';
	echo '<pre>';
	echo print_r($cliente);
	echo '</pre>';
	
	//~ echo '<h2>Ver datos de Articulo</h2>';
	//~ echo '<pre>';
	//~ echo print_r($items);
	//~ echo '</pre>';
	//~ 
	echo '<h2>Mostramos parametros de modulo</h2>';
	echo '<pre>';
	echo print_r($params);
	echo '</pre>';
	echo '<h2>Variable mostramos modulo</h2>';
	if ($mostramos == "NO+NO"){
	echo 'NO se debería mostrar';
	} else{
	echo 'SI se debería mostrar';
	}
	?>
</div>
