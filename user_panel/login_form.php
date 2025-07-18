<?php

namespace user_panel;

class login_form
{
    public function __construct()
    {
        add_shortcode('custom_login_form' , [$this , 'render_login_form']);
        add_action('init' , [$this , 'handle_login']);
        add_action('init' , [$this , 'script']);
    }

    public function render_login_form()
    {
        if (is_user_logged_in() && is_page('login')) {
            wp_redirect(home_url('/user_dashboard'));
            exit;
        }

        ob_start(); ?>
        <!-- دکمه باز کردن مودال -->
        <button onclick="toggleModal(true)"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            باز کردن مودال
        </button>

        <!-- مودال لاگین -->
        <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

                <!-- دکمه بستن -->
                <button onclick="toggleModal(false)"
                        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;
                </button>

                <div class="bg-[#2c2b3b] p-6 rounded-lg max-w-md w-full relative shadow-lg">
                    <!-- دکمه بستن -->
                    <button onclick="document.getElementById('custom-login-modal').classList.add('hidden')"
                            class="absolute top-2 left-2 text-gray-600 text-xl">&times;
                    </button>

                    <h2 class="font-bold text-center mb-6">ورود به حساب کاربری</h2>
                    <form method="post" class="space-y-4">
                        <input type="hidden" name="custom_login_nonce"
                               value="<?php echo wp_create_nonce('custom_login'); ?>">
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
                    <p class="text-center text-sm mt-4">حساب ندارید؟ <a href="<?php echo site_url('/register'); ?>"
                                                                        class="text-blue-600">ثبت‌نام</a></p>
                </div>
            </div>



        <?php
        return ob_get_clean();

    }

    public function handle_login()
    {
        if (!isset($_POST['custom_login_submit'])) return;

        if (!isset($_POST['custom_login_nonce']) || !wp_verify_nonce($_POST['custom_login_nonce'] , 'custom_login')) {
            wp_die('درخواست نامعتبر است.');
        }

        $creds = [
            'user_login' => sanitize_user($_POST['username']) ,
            'user_password' => $_POST['password'] ,
            'remember' => true ,
        ];

        $user = wp_signon($creds , false);

        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('login_error' , '1' , wp_get_referer()));
            exit;
        }

        wp_redirect(home_url('/user_dashboard'));
        exit;
    }

    public function script()
    {
        ?>
        <script>
            function toggleModal(show) {
                const modal = document.getElementById('modalBackdrop');
                modal.classList.toggle('hidden', !show);
                modal.classList.toggle('flex', show);
            }

            // بستن با کلیک روی پس‌زمینه
            document.getElementById('modalBackdrop').addEventListener('click', function (e) {
                if (e.target === this) toggleModal(false);
            });
        </script>
        <?php
    }
}
