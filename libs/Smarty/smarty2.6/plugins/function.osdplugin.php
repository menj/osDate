<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {osdplugin} function plugin
 *
 * Type:     function<br>
 * Name:     osdplugin<br>
 * Purpose:  Calls an osdate plugin
 * @author Duane Hinkley, Down Home Consulting www.DownHomeConsutlting.com
 * @param string $name the name of the plugin
 * @param string $method  the plugin method to call
 * @param array $param  the plugin method's parameters
 * @return string the results from the plugin
 */
   function smarty_function_osdplugin($param, &$smarty) {
   
      return $GLOBALS['mod']->executePlugin($param['name'], $param['method'], $param);
      //return $param['method'];
   }

?>
