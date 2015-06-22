<?php
/**
 * @package    dispcustom
 * @subpackage 
 * @author     
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');
/**
 * Helper class for dispcustom.
 * Recuerda que el nombre clase de un modulo tiene el siguiente formato.
 * Mod[nombremodulo]Helper 
 */
class ModdispcustomHelper
{
    
    public static function getItems(&$params)
    {
        $db = JFactory::getDBO();

        //-- Hacemos la busqueda articulos
        $db->setQuery($db->getQuery(true)
            ->select('#__content.*')
			->from('#__content')
			->where('#__content.id' . '=' . $params->get('article_id', ''))
			->order('ordering ASC')
        );
        $items = $db->loadObjectList();
	
        return ($items);
		
    }
}
