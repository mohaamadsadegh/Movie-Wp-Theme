<?php
namespace user_panel;

class login_form {
    public function __construct() {
        add_shortcode('custom_login_form', [$this, 'render_login_form']);
        add_action('init', [$this, 'handle_login']);
//        add_action('template_redirect', [$this, 'redirect_if_logged_in']);
    }
    public function render_login_form() {
        if (is_user_logged_in() && is_page('login')) {
            wp_redirect(home_url('/user_dashboard'));
            exit;
        }

        ob_start(); ?>
        <!-- دکمه نمایش پاپ‌آپ -->
        <div class="text-center my-4">
            <button onclick="document.getElementById('custom-login-modal').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded">ورود به حساب کاربری</button>
        </div>

        <!-- مودال لاگین -->
        <div id="custom-login-modal" class="absolute top-2 inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg max-w-md w-full relative shadow-lg">
                <!-- دکمه بستن -->
                <button onclick="document.getElementById('custom-login-modal').classList.add('hidden')" class="absolute top-2 left-2 text-gray-600 text-xl">&times;</button>

                <h2 class="text-2xl font-bold text-center mb-6">ورود به حساب کاربری</h2>
                <form method="post" class="space-y-4">
                    <input type="hidden" name="custom_login_nonce" value="<?php echo wp_create_nonce('custom_login'); ?>">
                    <div>
                        <label class="block text-sm mb-1">نام کاربری یا ایمیل</label>
                        <input type="text" name="username" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">رمز عبور</label>
                        <input type="password" name="password" required class="w-full border rounded px-3 py-2">
                    </div>
                    <?php if (isset($_GET['login_error'])) : ?>
                        <div class="text-red-600 text-sm">نام کاربری یا رمز عبور اشتباه است.</div>
                    <?php endif; ?>
                    <div>
                        <button type="submit" name="custom_login_submit"
                                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                            ورود
                        </button>
                    </div>
                </form>
                <p class="text-center text-sm mt-4">حساب ندارید؟ <a href="<?php echo site_url('/register'); ?>" class="text-blue-600">ثبت‌نام</a></p>
            </div>
        </div>

        <?php
        return ob_get_clean();

    }

    public function handle_login() {
        if (!isset($_POST['custom_login_submit'])) return;

        if (!isset($_POST['custom_login_nonce']) || !wp_verify_nonce($_POST['custom_login_nonce'], 'custom_login')) {
            wp_die('درخواست نامعتبر است.');
        }

        $creds = [
            'user_login'    => sanitize_user($_POST['username']),
            'user_password' => $_POST['password'],
            'remember'      => true,
        ];

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
            exit;
        }

        wp_redirect(home_url('/user_dashboard'));
        exit;
    }
}
