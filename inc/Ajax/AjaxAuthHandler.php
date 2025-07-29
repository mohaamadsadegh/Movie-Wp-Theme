<?php

namespace Inc\Ajax;

use WP_User;

class AjaxAuthHandler
{

    public function __construct()
    {
        add_action('wp_ajax_nopriv_register_user', [$this, 'handle_register']);
        add_action('wp_ajax_nopriv_send_register_code', [$this, 'handle_send_register_code']);
        add_action('wp_ajax_nopriv_login_user', [$this, 'handle_login']);
    }

    public function handle_send_register_code()
    {
        $phone = sanitize_text_field($_POST['register_phone'] ?? '');

        if (!$phone || !preg_match('/^09\d{9}$/', $phone)) {
            wp_send_json_error('شماره موبایل معتبر نیست');
        }

        $code = rand(100000, 999999);
        set_transient('reg_code_' . $phone, $code, 5 * MINUTE_IN_SECONDS);

        // در اینجا باید کد را از طریق پیامک ارسال کنید
        // مثال: sms_service()->send($phone, "کد تایید شما: $code");

        wp_send_json_success('کد تایید ارسال شد.');
    }

    public function handle_register()
    {
        $first_name = sanitize_text_field($_POST['first_name'] ?? '');
        $last_name = sanitize_text_field($_POST['last_name'] ?? '');
        $phone = sanitize_text_field($_POST['register_phone'] ?? '');
        $code = sanitize_text_field($_POST['register_sms_code'] ?? '');

        $saved_code = get_transient('reg_code_' . $phone);

        if ($saved_code != $code) {
            wp_send_json_error('کد تایید نادرست است');
        }

        $username = 'user_' . substr($phone, -4) . wp_rand(1000, 9999);
        $password = wp_generate_password();
        $user_id = wp_create_user($username, $password);

        if (is_wp_error($user_id)) {
            wp_send_json_error('ثبت‌نام با خطا مواجه شد');
        }

        update_user_meta($user_id, 'register_phone', $phone);
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        wp_signon([ 'user_login' => $username, 'user_password' => $password ], false);

        delete_transient('reg_code_' . $phone);

        wp_send_json_success('ثبت‌نام با موفقیت انجام شد');
    }

    public function handle_login()
    {
        $method = sanitize_text_field($_POST['login_method'] ?? 'userpass');

        if ($method === 'userpass') {
            $username = sanitize_user($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = wp_signon(['user_login' => $username, 'user_password' => $password], false);

            if (is_wp_error($user)) {
                wp_send_json_error('نام کاربری یا رمز عبور اشتباه است');
            }

            wp_send_json_success('با موفقیت وارد شدید');
        } elseif ($method === 'phonecode') {
            $phone = sanitize_text_field($_POST['login_phone'] ?? '');
            $code = sanitize_text_field($_POST['login_sms_code'] ?? '');
            $saved_code = get_transient('login_code_' . $phone);

            if ($saved_code != $code) {
                wp_send_json_error('کد تایید نادرست است');
            }

            $user_query = get_users([
                'meta_key' => 'register_phone',
                'meta_value' => $phone,
                'number' => 1,
                'count_total' => false
            ]);

            if (empty($user_query)) {
                wp_send_json_error('کاربری با این شماره یافت نشد');
            }

            wp_set_auth_cookie($user_query[0]->ID);
            delete_transient('login_code_' . $phone);
            wp_send_json_success('با موفقیت وارد شدید');
        }

        wp_send_json_error('درخواست نامعتبر');
    }
}
