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
 * @category   DB CLass 
 * @package    Magix CMS
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.1
 * @author Gérits Aurélien <aurelien@magix-cms.com> <aurelien@magix-dev.be>
 *
 */
class frontend_db_config{
	/**
	 * singleton dbconfig
	 * @access public
	 * @var void
	 */
	static public $frontenddbconfig;
	/**
	 * instance backend_db_config with singleton
	 */
	public static function frontendDCconfig(){
        if (!isset(self::$frontenddbconfig)){
         	self::$frontenddbconfig = new frontend_db_config();
        }
    	return self::$frontenddbconfig;
    }
    /**
     * selectionne la réécriture des métas par langue
     * @param $idconfig
     * @param $idmetas
     * @param $codelang
     */
	function s_plugin_rewrite_meta($idconfig,$idmetas,$level,$codelang){
		$sql = 'SELECT r.strrewrite FROM mc_metas_rewrite as r
		JOIN mc_lang AS lang ON(r.idlang = lang.idlang)
		WHERE r.idconfig = :idconfig
		AND r.idmetas = :idmetas
		AND r.level = :level
		AND lang.codelang = :codelang';
		return magixglobal_model_db::layerDB()->selectOne($sql,array(
			':idconfig'	=>	$idconfig,
			':idmetas'	=>	$idmetas,
			':level'	=>	$level,
			':codelang'	=>	$codelang
		));
	}
	/**
	 * selectionne la réécriture des métas sans langue
	 * @param $idconfig
	 * @param $idmetas
	 */
	function s_plugin_rewrite_meta_emptylanguage($idconfig,$idmetas,$level){
		$sql = 'SELECT r.strrewrite FROM mc_metas_rewrite as r
		JOIN mc_lang AS lang ON(r.idlang = lang.idlang)
		WHERE r.idconfig = :idconfig
		AND r.idmetas = :idmetas
		AND r.level = :level
		AND r.idlang = 0';
		return magixglobal_model_db::layerDB()->selectOne($sql,array(
			':idconfig'	=>	$idconfig,
			':idmetas'	=>	$idmetas,
			':level'	=>	$level
		));
	}
	/**
     * Selectionne la configuration global suivant la variable
     * @param $named
     */
    function s_public_config_named($attr_name){
    	$sql = 'SELECT * FROM mc_config WHERE attr_name = :attr_name';
		return magixglobal_model_db::layerDB()->selectOne($sql,array(
			':attr_name' =>	$attr_name
		));
    }
    /**
     * @return array
     */
    protected function s_data_setting(){
        $sql = 'SELECT * FROM mc_setting';
        return magixglobal_model_db::layerDB()->select($sql);
    }
}