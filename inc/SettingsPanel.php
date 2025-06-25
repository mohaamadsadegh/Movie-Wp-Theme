<?php

class SettingsPanel {
    private $option_name = 'moves_options';
    private $settings_page_slug = 'theme-settings';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_media']);
    }

    public function enqueue_media() {
        wp_enqueue_media();
    }

    public function add_settings_page() {
        add_menu_page(
            'تنظیمات قالب',
            'تنظیمات قالب',
            'manage_options',
            $this->settings_page_slug,
            [$this, 'render_settings_page'],
            'dashicons-admin-generic',
            99
        );
    }

    public function register_settings() {
        register_setting('theme_options_group', $this->option_name);
    }

    public function render_settings_page() {
        $options = get_option($this->option_name);
        include_once 'Setting.php';

    }

    public static function get_option($key, $default = null) {
        $options = get_option('moves_options');
        return $options[$key] ?? $default;
    }
}
