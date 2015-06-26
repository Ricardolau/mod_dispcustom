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
    
    public static function getCliente(&$params)
    {
        # Creamos variables de informacion de la petición actual.
		$info['cliente'] = $_SERVER['HTTP_USER_AGENT'];
        /* Lo primero que hay que tener en cuenta que parece facil obtener la información
         * del SISTEMA OPERATIVO Y NAVEGADOR, pero estos datos pueden influir según navegador
         * que se utilice.
         * ver más info en : https://github.com/Ricardolau/mod_dispcustom/wiki/Cosas-curiosas-que-aprendo#_serverhttp_user_agent
        */ 
        # Array de posibles Navegadores y Sistemas Operativos.
        $browser=array("IE","OPERA","FIREFOX","CHROME","SAFARI");
		$os=array("IPHONE","ANDROID","WIN","MACINTOSH","LINUX");
		/* Teniendo en cuenta: 
		 * - La primera palabra que nos genera $info['cliente] no la tiene en cuenta
		 *   por causa del funcionamiento la instrucción strpos , ver más info en http://php.net/manual/es/function.strpos.php
		 * - Tener en cuenta que el orden en el que se ponga los sistemas opertativo y navegadores es importante, ya que la funcion
		 *   cuando encuentra uno ellos, no sigue buscando los siguientes.
		 *   Ejemplo: Ponemos ANDROID primero ya que $info['cliente'] contiene tambien LINUX, fijo.
		 * - La version del sistema opertativo, no siempre funciona.
		 * */
              
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
		###############################################################
		# Ahora comprobamos si NAVEGADOR o SO está incluido o excluido#
		###############################################################
		
		
		# Comprobamos si está seleccionado el Sistema Operativo de cliente.
		$SistemasOperativos = $params->get('sistemaoperativo');
		foreach($SistemasOperativos as $SistemaOperativo)
			{
				
				if ($SistemaOperativo == $info['os'])
				{
				$info['coincideSO'] = 'SI';
				break;
				}
			}
		# Comprobamos si está seleccionado el Navegador de cliente.
		$Navegadores = $params->get('navegador');
		foreach($Navegadores as $Navegador)
			{
				
				if ($Navegador == $info['browser'])
				{
				$info['coincideNav'] = 'SI';
				break;
				}
			}
		
		
		
		# devolvemos el array de valores
		return $info;
        
        
		
    }
    
    
}
