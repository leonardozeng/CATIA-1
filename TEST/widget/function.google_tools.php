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
 * @category   extends 
 * @package    Smarty
 * @subpackage function
 * @copyright  MAGIX CMS Copyright (c) 2014 Gerits Aurelien,
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    plugin version
 * @author Gérits Aurélien <aurelien@magix-cms.com> <aurelien@magix-dev.be>
 *
 */
/**
 * Smarty {google_tools} function plugin
 *
 * Type:     function
 * Name:     google_tools
 * Date:     Décember 18, 2009
 * Update:   09 Septembre, 2014
 * Purpose:  
 * Examples: {google_tools tools="webmaster"}
 * Output:   
 * @link 
 * @author   Gerits Aurelien
 * @version  1.5
 * @param array
 * @param Smarty
 * @return string
 *
 */
function smarty_function_google_tools($params, $template){
	$type = $params['tools'];
	if (!isset($type)) {
	 	trigger_error("type: missing 'type' parameter");
		return;
	}
	switch ($type){
		case 'analytics':
		$analyticsdata = frontend_model_setting::select_uniq_setting('analytics');
		$analytics = $analyticsdata['setting_value'];
		if($analytics != null){
$tools = <<<EOT
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '$analytics', 'auto');
  ga('send', 'pageview');
</script>
EOT;
		}else{
			$tools = '';
		}
			break;
		case 'webmaster':
			$webmasterdata = frontend_model_setting::select_uniq_setting('webmaster');
			$tools = $webmasterdata['setting_value'];
			break;
        case 'robots':
            $robotsdata = frontend_model_setting::select_uniq_setting('robots');
            $tools = $robotsdata['setting_value'];
	}
	return $tools;
}