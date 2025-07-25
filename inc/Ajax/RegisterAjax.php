<?php

namespace inc\Ajax;

class RegisterAjax {
    public static function action_name(): string {
        return 'register_user';
    }

    public function handle() {
        $first_name = sanitize_text_field($_POST['first_name'] ?? '');
        $last_name = sanitize_text_field($_POST['last_name'] ?? '');
        $phone = sanitize_text_field($_POST['register_phone'] ?? '');
        $code = sanitize_text_field($_POST['register_sms_code'] ?? '');

        if ($_SESSION['register_code'] !== $code || $_SESSION['register_phone'] !== $phone) {
            wp_send_json_error(['message' => 'کد تأیید نادرست است.']);
        }

        if (username_exists($phone) || email_exists($phone)) {
            wp_send_json_error(['message' => 'کاربری با این شماره قبلاً ثبت شده است.']);
        }

        $user_id = wp_create_user($phone, wp_generate_password(), $phone . '@example.com');
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name'  => $last_name,
        ]);

        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        wp_send_json_success(['message' => 'ثبت‌نام انجام شد.']);
    }
}
