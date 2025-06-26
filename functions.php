<?php


define('THEME_PATH', get_template_directory());
define('IMG_URL' ,  get_template_directory_uri() . '/assets/image/');
define('IMG_URL_js' ,  get_template_directory_uri() . '/assets/js/');

require_once THEME_PATH . '/inc/Autoloader.php';
require_once get_template_directory() . '/inc/SettingsPanel.php';

use inc\Autoloader;
Autoloader::register();

use inc\Theme;
new Theme();

new SettingsPanel();
