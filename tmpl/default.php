<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * SI VES QUE TE PRODUCE ERRORES PUEDE IMPRIMIR:
 *  $mostramos donde tiene que ser superior 1
 *  $cliente['coincideSO'] $cliente['coincideNav'] y si es 1 es que coincide SO y NAV
 *  print_r($params); ves los parametros marcados.
 
 */

// no direct access
defined('_JEXEC') or die;
?>

<!-- Custom para dispositivos -->
<div class="NuevoCustom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
	<?php echo $introtext;	?>
</div>
