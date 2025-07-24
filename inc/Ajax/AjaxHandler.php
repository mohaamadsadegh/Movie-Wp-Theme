<?php
namespace inc\Ajax;

class AjaxHandler
{
    protected string $ajax_dir = __DIR__;
    protected string $script_handle = 'global-ajax';
    protected string $script_src = IMG_URL_js . 'ajax.js';

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        $this->register_all_ajax_classes();
    }

    protected function register_all_ajax_classes()
    {
        foreach (glob($this->ajax_dir . '/*.php') as $file) {
            $class = 'inc\\Ajax\\' . basename($file, '.php');
            if (class_exists($class) && method_exists($class, 'action_name')) {
                $action = $class::action_name();
                add_action("wp_ajax_$action", function () use ($class) {
                    $this->dispatch($class);
                });
                add_action("wp_ajax_nopriv_$action", function () use ($class) {
                    $this->dispatch($class);
                });
            }
        }
    }

    public function enqueue_assets()
    {
        wp_enqueue_script($this->script_handle, $this->script_src, ['jquery'], null, true);

        $nonces = [];
        foreach (glob($this->ajax_dir . '/*.php') as $file) {
            $class = 'inc\\Ajax\\' . basename($file, '.php');
            if (class_exists($class) && method_exists($class, 'action_name')) {
                $action = $class::action_name();
                $nonces[$action] = wp_create_nonce("{$action}_nonce");
            }
        }

        wp_localize_script($this->script_handle, 'ajax_data', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonces' => $nonces,
        ]);
    }

    public function dispatch($class)
    {
        $action = $class::action_name();
        if (!check_ajax_referer("{$action}_nonce", 'nonce', false)) {
            wp_send_json_error(['message' => 'Invalid nonce']);
        }

        $instance = new $class();
        if (method_exists($instance, 'handle')) {
            $instance->handle();
        } else {
            wp_send_json_error(['message' => 'No handle() method in class']);
        }
    }
}
