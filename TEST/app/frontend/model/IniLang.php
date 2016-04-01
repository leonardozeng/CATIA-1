<?php
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2013 magix-cms.com <support@magix-cms.com>
 #
 # OFFICIAL TEAM :
 #
 #   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
 #
 # Redistributions of files must retain the above copyright notice.
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.

 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <http://www.gnu.org/licenses/>.
 #
 # -- END LICENSE BLOCK -----------------------------------

 # DISCLAIMER

 # Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
 # versions in the future. If you wish to customize MAGIX CMS for your
 # needs please refer to http://www.magix-cms.com for more information.
 */
/**
 * MAGIX CMS
 * @category   MODEL 
 * @package    frontend
 * @copyright  MAGIX CMS Copyright (c) 2011 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.0
 * @author Gérits Aurélien <aurelien@magix-cms.com> | <gerits.aurelien@gmail.com>
 * @name IniLang
 *
 */
class frontend_model_IniLang{
	/**
	 * lang setting conf
	 *
	 * @var string 'fr', ' 'en', ...
	 */
	public $loadlang;
	/**
	 * function construct class
	 *
	 */
	function __construct(){
		if (isset($_GET['strLangue'])) {
			$this->loadlang = magixcjquery_filter_join::getCleanAlpha($_GET['strLangue'],3);
		}
	}
	/**
	 * function display home backend
	 *
	 */
	private function loadGlobalLang(){
		$langue = explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		$langue = strtolower(substr(chop($langue[0]),0,2));
		switch ($langue){
			case 'en':
				$langue = 'en';
				break;
			case 'fr':
				$langue = 'fr';
				break;
			case 'de':
				$langue = 'de';
				break;
			case 'nl':
				$langue = 'nl';
				break;
			case 'es':
				$langue = 'es';
				break;
			case 'it':
				$langue = 'it';
				break;
			default:
				$langue = 'fr';
		}
		if (empty($_SESSION['strLangue']) || !empty($this->loadlang)) {
			
	 		 return $_SESSION['strLangue'] = empty($this->loadlang) ? $langue : $this->loadlang;
	 		 
		}else{
			if (isset($this->loadlang)) {
	 		 	return $this->loadlang  = $langue;
	 		 }
		}
	}
	/**
	 * Retourne l'OS courant si windows
	 */
	private function getOS(){
		if(stripos($_SERVER['HTTP_USER_AGENT'],'win')){
			return 'windows';
		}
	}
	/**
	 * Modification du setlocale suivant la langue courante pour les dates
	 */
	private function setTimeLocal(){
		if(frontend_model_template::current_Language() == 'nl'){
			if($this->getOS() === 'windows'){
				setlocale(LC_TIME, 'nld_nld','nl');
			}else{
				setlocale(LC_TIME, 'nl_NL.UTF8','nl');
			}
		}elseif(frontend_model_template::current_Language() == 'fr'){
			setlocale(LC_TIME, 'fr_FR.UTF8', 'fra');
		}elseif(frontend_model_template::current_Language() == 'de'){
			setlocale(LC_TIME, 'de_DE.UTF8', 'de');
		}elseif(frontend_model_template::current_Language() == 'es'){
			setlocale(LC_TIME, 'es_ES.UTF8', 'es');
		}elseif(frontend_model_template::current_Language() == 'it'){
			setlocale(LC_TIME, 'it_IT.UTF8', 'it');
		}else{
			setlocale(LC_TIME, 'en_US.UTF8', 'en');
		}
	}
	/**
	 * @access public
	 * autoLangSession
	 */
	public function autoLangSession(){
		$this->setTimeLocal();
		$this->loadGlobalLang();
	}
    /**
     * Construction du tableau contenant la structure html
     * @params array $default
     * @params array $custom
     */
    public function set_html_struct($default,$custom){
        // *** Merge default and custom structure
        if (is_array($custom)){
            $default['display'] = array();
            foreach($custom AS $k => $v){
                foreach($v AS $sk => $sv){
                    if ($sv != null){
                        $default[$k][$sk] = $sv;
                    }
                }
                if (array_search($k,$default['allow']))
                    $default['display'][1][] = $k;
            }
        }
        // *** push null value on case[0] (allow array search on format function)
        foreach($default['display'] AS $k => $v){
            array_unshift($default['display'][$k],null);
        }
        return $default;
    }
}
?>