<?php

/**
 * Develop21
 *
 * @package Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

class Website extends Core {
	
	public function head() {
		global $database;
		if(isset($_GET['a'])) {
			if($menuitem = MenuItem::find_by_alias($_GET['a'])) {
				$menutype = MenuType::find_by_id($menuitem->type);
				$title = $menuitem->website_title;
			}
		} elseif(isset($_GET['system'])) {
			$title = NULL;
		} elseif(!$_GET) {
			$menuitem = MenuItem::find_by_id(1);
			$menutype = MenuType::find_by_id($menuitem->type);
			$title = $menuitem->website_title;
		}
		$head = '<title>'.$title.'</title>';
		echo $head;
	}
	
	public function admin($built_in_css = TRUE) {
		global $database;
		global $session;
		if(!$session->is_logged_in()) {
			// do nothing
		} else {
			// check permission
			$permission = Permission::get_access_level();
			if($permission < 4) {
				// do nothing
			} else {
				ob_start();
				include('views/admin.php');
				$view = ob_get_clean();
				echo $view;
			}
		}
	}
	
	public function name() {
		global $database;
		$settings = Setting::find_by_id(1);
		echo $settings->website_name;
	}
	
	public function main_menu($menuclass = 'nav', $itemclass = 'item') {
		global $database;
		$menu = Menu::find_by_id(1);
		$items = MenuItem::find_permitted_items(1);
		ob_start();
		include('views/main-menu.php');
		$view = ob_get_clean();
		echo $view;
	}
	
	public function content() {
		global $database;
		if(isset($_GET['a'])) {
			if($menuitem = MenuItem::find_by_alias($_GET['a'])) {
				$menutype = MenuType::find_by_id($menuitem->type);
				$view = '<h2>'.$menuitem->name.'</h2>';
				ob_start();
				include(SITE_ROOT.'components/'.$menutype->directory.'/menu-output.php');
				$view .= ob_get_clean();
				echo $view;
			} else {
				redirect('404.php');
			}
		} elseif(isset($_GET['system'])) {
			if($menutype = MenuType::find_by_alias($_GET['system'])) {
				ob_start();
				include(SITE_ROOT.'components/'.$menutype->directory.'/system-output.php');
				$view = ob_get_clean();
				echo $view;
			} else {
				redirect('404.php');
			}
		} elseif(!$_GET) {
			$menuitem = MenuItem::find_by_id(1);
			$menutype = MenuType::find_by_id($menuitem->type);
			$view = '<h2>'.$menuitem->name.'</h2>';
			ob_start();
			include(SITE_ROOT.'components/'.$menutype->directory.'/menu-output.php');
			$view .= ob_get_clean();
			echo $view;
		}
	}
	
	public function modules() {
		global $database;
		$modules = ModuleItem::find_permitted_items();
		ob_start();
		include('views/modules.php');
		$view = ob_get_clean();
		echo $view;
	}
	
	public function module($alias, $param) {
		global $database;
		$module = Module::find_by_alias($alias);
		ob_start();
		include('components/'.$module->directory.'/module-output.php');
		$view = ob_get_clean();
		echo $view;
	}
	
}

$website = new Website();

?>