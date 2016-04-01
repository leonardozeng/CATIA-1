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
 * @category   DB lang
 * @package    backend block
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @id $Id: cms.php 379 2011-07-06 15:00:29Z aurelien $
 * @version  $Rev: 379 $
 * @author Gérits Aurélien <aurelien@magix-cms.com> <aurelien@magix-dev.be> $Author: aurelien $
 * @name lang
 *
 */
class backend_db_block_lang{
	/**
	 * @access public
     * @static
     * retourne la liste des langues disponible
     */
    public static function s_data_lang($active_lang=false){
    	if($active_lang != false){
    		$sql = 'SELECT lang.* FROM mc_lang AS lang
    		WHERE lang.active_lang = 1
    		ORDER BY lang.default_lang DESC,lang.idlang ASC';
    	}else{
    		$sql = 'SELECT lang.* FROM mc_lang AS lang
    		ORDER BY lang.default_lang DESC,lang.idlang ASC';
    	}
		return magixglobal_model_db::layerDB()->select($sql);
    }
    /**
     * @access public
     * @static
     * retourne la langue sélectionné via son identifiant
     * @param integer $getlang
     */
	public static function s_data_iso($getlang){
    	$sql = 'SELECT lang.idlang,lang.iso,lang.language 
    	FROM mc_lang AS lang WHERE idlang = :getlang';
		return magixglobal_model_db::layerDB()->selectOne($sql,array(
			':getlang'	=>	$getlang
		));
    }
    /**
     * @access public
     * @static 
     * Sélectionne toutes les autres langues
     * @param integer $getlang
     */
	public static function s_exclude_language_data($getlang){
    	$sql = 'SELECT lang.idlang,lang.iso,lang.language 
    	FROM mc_lang AS lang WHERE idlang != :getlang';
		return magixglobal_model_db::layerDB()->select($sql,array(
			':getlang'	=>	$getlang
		));
    }
}