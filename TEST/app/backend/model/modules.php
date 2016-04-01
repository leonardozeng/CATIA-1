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
 * @category   Model 
 * @package    backend
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.0
 * @author Gérits Aurélien <aurelien@magix-cms.com> <aurelien@magix-dev.be> | <gerits.aurelien@gmail.com>
 * @name modules
 * Model modules
 */
class backend_model_modules{
	/**
	 * Tableau des modules
	 * @access public
	 * @staticvar $_array_module
	 */
	private static $_array_module;
    /**
     * @var array
     */
    private static $options_default = array(
		'news'=>'News','catalog'=>'Catalogue'
	);

    /**
     * @param string $arraymods
     */
    public function __construct($arraymods = ''){
		self::$_array_module = $arraymods;
	}

    /**
     * @return array|string
     */
    private function array_module(){
		if(self::$_array_module != null){
			$tabs = self::$_array_module;
		}else{
			$tabs = self::$options_default;
		}
		return $tabs;
	}
	/**
	 * @access public
	 * @static
	 * Menu select pour le choix du module
	 */
	public static function select_menu_module($update=null){
        $default_array = self::array_module();
        $select = backend_model_forms::select_static_row(
            $default_array,
            array(
                'attr_name'     =>  'attribute',
                'attr_id'       =>  'attribute',
                'default_value' =>  $update,
                'empty_value'   =>  'Selectionner le module',
                'class'         =>  'form-control',
                'upper_case'    =>  false
            )
        );
        return $select;
	}
}