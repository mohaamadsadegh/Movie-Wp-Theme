<?php
namespace inc\user_panel;


class user_dashboard
{
    public function __construct()
    {
        add_shortcode('user_dashboard' , [$this , 'dashboard_shortcode']);
//        add_action('wp_enqueue_scripts' , [$this , 'enqueue_assets']);
        add_action('wp_ajax_change_password' , [$this , 'change_password']);
        add_action('wp_ajax_upload_avatar' , [$this , 'upload_avatar']);
    }

    public function enqueue_assets()
    {
        wp_localize_script('user-panel-js' , 'userPanelData' , [
            'ajax_url' => admin_url('admin-ajax.php') ,
            'nonce' => wp_create_nonce('user_panel_nonce')
        ]);
    }

    public function dashboard_shortcode()
    {
        if (!is_user_logged_in()) return '<p class="text-center mt-6">برای مشاهده پنل کاربری، وارد شوید.</p>';

        ob_start();
        include __DIR__ . '/dashboard/layout.php';
        return ob_get_clean();
    }

    public function change_password()
    {
        check_ajax_referer('user_panel_nonce' , 'nonce');

        $current = $_POST['current'] ?? '';
        $new = $_POST['new'] ?? '';

        $user = wp_get_current_user();
        if (!wp_check_password($current , $user->user_pass , $user->ID)) {
            wp_send_json_error(['message' => 'رمز فعلی نادرست است.']);
        }

        wp_set_password($new , $user->ID);
        wp_send_json_success(['message' => 'رمز عبور با موفقیت تغییر یافت.']);
    }

    public function upload_avatar()
    {
        check_ajax_referer('user_panel_nonce' , 'nonce');

        if (!function_exists('wp_handle_upload')) require_once ABSPATH . 'wp-admin/includes/file.php';

        $uploaded = $_FILES['avatar'];
        $user_id = get_current_user_id();

        $upload_overrides = ['test_form' => false];
        $movefile = wp_handle_upload($uploaded , $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            update_user_meta($user_id , 'custom_avatar' , esc_url($movefile['url']));
            wp_send_json_success(['url' => esc_url($movefile['url'])]);
        } else {
            wp_send_json_error(['message' => $movefile['error']]);
        }
    }
}

