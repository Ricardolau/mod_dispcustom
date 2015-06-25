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
        # Creamos variables de informacion de la petición actual.
		$info['cliente'] = $_SERVER['HTTP_USER_AGENT'];
        /* Lo primero que hay que tener en cuenta que parece facil obtener la información
         * del SISTEMA OPERATIVO Y NAVEGADOR, pero hay muchos parametros que pueden influir
         * como las versiones ambos 
         * Según encuentro hay opciones mejores como utilizar:
         * get_browser .. pero esta necesita que tengamos en el servidor el archivo browscap.ini
         * algo que no tiene todos los servidores.
         * hay un proyecto github sobre esto : https://github.com/browscap/browscap-php
         * y ademas tiene una web donde van actualizando los sistemas opertativos, navegadores y versiones
         * tiene un fichero xml que pesa 82,5 mg... */
         
         // Bueno de momento intentamos comprobar estas opciones.. 
        # Creamos array con posibles navegadores y sistema operativos
        # Mozilla que esta al principio no lo reconoce,
        # ver informacion instruccion strpos http://php.net/manual/es/function.strpos.php
        # Otra cosa importante es el orden del array ya que por ejemplo:
        # ANDROID es un LINUX , por lo que si ponemos primero linux
		# va dejar de buscar si pondrá como 'os' que es LINUX
		
        
        $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","CHROME","SAFARI");
		$os=array("IPHONE","ANDROID","WIN","MACINTOSH","UBUNTU","LINUX","OS");
 
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
		
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($info['cliente']), $parent);
			$f = $s + strlen($parent);
			$version = substr($info['cliente'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['browser-version'] = $version;
				break;
			}
		}		
 
		# obtenemos el sistema operativo
		foreach($os as $val)
		{
		$s = strpos(strtoupper($info['cliente']), $val);	
		if ($s)
			{
			$info['os'] = $val;
			# Ahora metemos la version del sistema operativo
			$f = $s + strlen($val);
			# Buscamos version 
			$version = substr($info['cliente'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			$info['os-version'] = $version;
			#Salimos de bucle ya que encontramos sistema operativo
			break;
			}
		}
 
		# devolvemos el array de valores
		return $info;
        
        
		
    }
    
    
}
