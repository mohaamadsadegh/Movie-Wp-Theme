<?php


namespace inc\Ajax;

class RegisterSendCode
{
    public static function action_name(): string
    {
        return 'register_send_code';
    }

    public function handle()
    {
        $phone = sanitize_text_field($_POST['phone'] ?? '');

        if (!$phone || !preg_match('/^09\d{9}$/' , $phone)) {
            wp_send_json_error(['message' => 'شماره موبایل معتبر نیست.']);
        }

        // کد را بساز و در Session ذخیره کن
        $code = rand(100000 , 999999);
        $_SESSION['register_code'] = $code;
        $_SESSION['register_phone'] = $phone;

        // در اینجا می‌تونی کد رو ارسال کنی (مثلاً پیامک)

        wp_send_json_success(['message' => 'کد ارسال شد.']);
    }
}
