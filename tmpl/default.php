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
	echo 'Ver print module;';
	echo '<pre>';
	echo print_r($module);
	echo '</pre>';
	//~ echo 'Ver print items;';
	//~ echo '<pre>';
	//~ echo print_r($items);
	//~ echo '</pre>';
	echo 'Ver en bruto datos de Cliente';
	echo '<pre>';
	echo print_r($brutoclient);
	echo '</pre>';
	echo 'Ver datos de Cliente';
	echo '<pre>';
	echo print_r($cliente);
	echo '</pre>';
	
	
	?>
</div>
