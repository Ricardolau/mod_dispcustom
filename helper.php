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
    
    public static function getCliente()
    {
        /* Lo primero qye hay que tener en cuenta que parece facil obtener la información
         * del SISTEMA OPERATIVO Y NAVEGADOR, pero hay muchos parametros que pueden influir
         * como las versiones ambos 
         * Según encuentro hay opciones mejores como utilizar:
         * get_browser .. pero esta necesita que tengamos en el servidor el archivo browscap.ini
         * algo que no tiene todos los servidores.
         * hay un proyecto github sobre esto : https://github.com/browscap/browscap-php
         * y ademas tiene una web donde van actualizando los sistemas opertativos, navegadores y versiones
         * tiene un fichero xml que pesa 82,5 mg... */
         
         // Bueno de momento intentamos perter estas opciones.. 
        $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
		$os=array("WIN","MAC","LINUX","ANDROID","OS");
 
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
 
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['browser-version'] = $version;
			}
		}		
 
		# obtenemos el sistema operativo
		foreach($os as $val)
		{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
		}
 
		# devolvemos el array de valores
		return $info;
        
        
		
    }
    /* Esta funcion es simplemente para ver que nos muestra  $_SERVER['HTTP_USER_AGENT']
     * luego después de las pruebas tendremos que eliminarla... 
     */
     public static function getBrutocliente()
    {
		$brutoCliente = $_SERVER['HTTP_USER_AGENT'];
		return $brutoCliente;
	}
    
}
