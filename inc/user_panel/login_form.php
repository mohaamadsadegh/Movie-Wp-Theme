<?php
namespace inc\user_panel;

class login_form
{
    public function __construct()
    {
        add_shortcode('custom_login_form', [$this, 'render_login_form']);
        add_action('init', [$this, 'handle_login']);
        add_action('init', [$this, 'handle_register']);
        add_action('init', [$this, 'handle_password_reset']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_send_sms_code', [$this, 'ajax_send_sms_code']);
        add_action('wp_ajax_nopriv_send_sms_code', [$this, 'ajax_send_sms_code']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('custom-login', get_template_directory_uri() . '/assets/js/custom-login.js', ['jquery'], null, true);
        wp_localize_script('custom-login', 'ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('send_sms_code_nonce'),
        ]);
    }

    public function render_login_form()
    {
        if (is_user_logged_in() && is_page('login')) {
            wp_redirect(home_url('/user_dashboard'));
            exit;
        }

        ob_start(); ?>
        <button onclick="toggleModal('loginModal', true)" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">ورود / ثبت‌نام</button>

        <!-- مودال ورود -->
        <div id="loginModal" class="modal hidden fixed inset-0 bg-black/80 items-center justify-center z-50 ">
            <div class="bg-[#2c2b3b] p-6 rounded-lg max-w-md w-full relative shadow-lg border-b-yellow-yellow900 border-b">
                <button onclick="toggleModal('loginModal', false)" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                <h2 class="font-bold text-center mb-6">ورود به حساب کاربری</h2>

                <form method="post" id="loginForm" class="space-y-4">
                    <input type="hidden" name="custom_login_nonce" value="<?php echo wp_create_nonce('custom_login'); ?>">

                    <div class="flex mb-4 justify-center">
                        <label class="p-2 rounded-[10px] m-0"><input type="radio"  name="login_method" value="userpass" checked>ورود با ایمیل/نام کاربری</label>
                        <label class="p-2 rounded-[10px] m-0"><input type="radio"  name="login_method" value="phonecode">ورود شماره موبایل</label>
                    </div>

                    <div id="userpass_fields">
                        <label class="block text-sm mb-1">ایمیل یا نام کاربری</label>
                        <input type="text" name="username_or_email" class="w-full border rounded px-3 py-2" required>
                        <label class="block text-sm mt-4 mb-1">رمز عبور</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div id="phonecode_fields" class="hidden">
                        <label class="block text-sm mb-1">شماره موبایل</label>
                        <input type="text" id="login_phone" name="login_phone" class="w-full border rounded px-3 py-2" placeholder="09xxxxxxxxx">
                        <button type="button" id="sendLoginSmsCode" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">ارسال کد پیامک</button>
                        <div id="loginSmsStatus" class="text-sm mt-1"></div>
                        <label class="block text-sm mt-4 mb-1">کد تایید</label>
                        <input type="text" name="login_sms_code" maxlength="6" class="w-full border rounded px-3 py-2" placeholder="کد ۶ رقمی">
                    </div>

                    <?php if (isset($_GET['login_error'])) : ?>
                        <div class="text-red-600 text-sm mt-2">اطلاعات ورود اشتباه است.</div>
                    <?php endif; ?>

                    <div>
                        <button type="submit" name="custom_login_submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">ورود</button>
                    </div>
                </form>

                <p class="text-center text-sm mt-4">
                    <a href="#" onclick="openResetForm()" class="text-blue-400 hover:underline">فراموشی رمز عبور؟</a>
                </p>
            </div>
        </div>

        <!-- مودال بازیابی رمز عبور -->
        <div id="resetModal" class="modal hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
            <div class="bg-[#2c2b3b] p-6 rounded-lg max-w-md w-full relative shadow-lg">
                <button onclick="toggleModal('resetModal', false)" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                <h2 class="font-bold text-center mb-6">بازیابی رمز عبور</h2>
                <form method="post" class="space-y-4">
                    <input type="hidden" name="custom_reset_nonce" value="<?php echo wp_create_nonce('custom_reset'); ?>">
                    <div>
                        <label class="block text-sm mb-1">ایمیل ثبت‌شده</label>
                        <input type="email" name="reset_email" required class="w-full border rounded px-3 py-2">
                    </div>
                    <?php if (isset($_GET['reset_error'])) : ?>
                        <div class="text-red-600 text-sm">کاربری با این ایمیل یافت نشد.</div>
                    <?php elseif (isset($_GET['reset_success'])) : ?>
                        <div class="text-green-600 text-sm">لینک بازیابی ارسال شد.</div>
                    <?php endif; ?>
                    <div>
                        <button type="submit" name="custom_reset_submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">ارسال لینک بازیابی</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function toggleModal(id, show) {
                const modal = document.getElementById(id);
                if (!modal) return;
                if (show) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                } else {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }
            }

            function openResetForm() {
                toggleModal('loginModal', false);
                toggleModal('resetModal', true);
            }

            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) toggleModal(modal.id, false);
                });
            });

            jQuery(document).ready(function ($) {
                // تغییر نمایش فیلدها بر اساس انتخاب روش ورود
                $('input[name="login_method"]').change(function () {
                    if ($(this).val() === 'phonecode') {
                        $(this).removeClass('active');
                        $('#userpass_fields').hide(500);
                        $('#phonecode_fields').show(500);
                        $('#loginForm input[name="username_or_email"]').prop('required', false);
                        $('#loginForm input[name="password"]').prop('required', false);
                        $('#loginForm input[name="login_phone"]').prop('required', true);
                        $('#loginForm input[name="login_sms_code"]').prop('required', true);
                    } else {
                        $(this).addClass('active');
                        $('#userpass_fields').show(500);
                        $('#phonecode_fields').hide(500);
                        $('#loginForm input[name="username_or_email"]').prop('required', true);
                        $('#loginForm input[name="password"]').prop('required', true);
                        $('#loginForm input[name="login_phone"]').prop('required', false);
                        $('#loginForm input[name="login_sms_code"]').prop('required', false);
                    }
                });

                // ارسال کد پیامک ورود
                $('#sendLoginSmsCode').click(function () {
                    var phone = $('#login_phone').val().trim();
                    if (!phone.match(/^09\\d{9}$/)) {
                        $('#loginSmsStatus').text('شماره موبایل معتبر نیست');
                        return;
                    }
                    $('#loginSmsStatus').text('در حال ارسال کد...');
                    $.post(ajax_object.ajax_url, {
                        action: 'send_sms_code',
                        phone: phone,
                        nonce: ajax_object.nonce
                    }, function (response) {
                        if (response.success) {
                            $('#loginSmsStatus').text('کد تایید ارسال شد.');
                        } else {
                            $('#loginSmsStatus').text(response.data || 'خطا در ارسال کد');
                        }
                    });
                });
            });
        </script>

        <?php
        return ob_get_clean();
    }

    public function ajax_send_sms_code()
    {
        check_ajax_referer('send_sms_code_nonce', 'nonce');

        $phone = sanitize_text_field($_POST['phone']);
        if (!preg_match('/^09\d{9}$/', $phone)) {
            wp_send_json_error('شماره موبایل معتبر نیست');
        }

        if (!session_id()) {
            session_start();
        }
        $code = random_int(100000, 999999);
        $_SESSION['sms_code_' . $phone] = [
            'code' => $code,
            'time' => time()
        ];

        $sent = $this->send_sms($phone, "کد تایید شما: $code");

        if ($sent) {
            wp_send_json_success();
        } else {
            wp_send_json_error('ارسال پیامک ناموفق بود');
        }
    }

    private function send_sms($phone, $message)
    {
        // اینجا API پیامک خودتون رو بزنید
        return true;
    }

    public function handle_login()
    {
        if (!isset($_POST['custom_login_submit'])) return;
        if (!isset($_POST['custom_login_nonce']) || !wp_verify_nonce($_POST['custom_login_nonce'], 'custom_login')) {
            wp_die('درخواست نامعتبر.');
        }

        $method = $_POST['login_method'] ?? 'userpass';

        if ($method === 'phonecode') {
            $phone = sanitize_text_field($_POST['login_phone'] ?? '');
            $code = sanitize_text_field($_POST['login_sms_code'] ?? '');

            if (!preg_match('/^09\d{9}$/', $phone) || empty($code)) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            if (!session_id()) session_start();
            if (!isset($_SESSION['sms_code_' . $phone])) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            $saved = $_SESSION['sms_code_' . $phone];
            if (time() - $saved['time'] > 600 || $saved['code'] !== $code) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            // یافتن کاربر با شماره موبایل
            $user_query = new \WP_User_Query([
                'meta_key' => 'phone_number',
                'meta_value' => $phone,
                'number' => 1,
            ]);
            $users = $user_query->get_results();

            if (empty($users)) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }
            $user = $users[0];

            // ورود بدون پسورد چون با کد تایید پیامکی انجام میشه
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);

            // حذف کد بعد از ورود موفق
            unset($_SESSION['sms_code_' . $phone]);

            wp_redirect(home_url('/user_dashboard'));
            exit;

        } else {
            // ورود با ایمیل یا نام کاربری و پسورد
            $username_or_email = sanitize_text_field($_POST['username_or_email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username_or_email) || empty($password)) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            $user = get_user_by('login', $username_or_email) ?: get_user_by('email', $username_or_email);

            if (!$user) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            $creds = [
                'user_login' => $user->user_login,
                'user_password' => $password,
                'remember' => true,
            ];

            $signon = wp_signon($creds, false);
            if (is_wp_error($signon)) {
                wp_redirect(add_query_arg('login_error', '1', wp_get_referer()));
                exit;
            }

            wp_redirect(home_url('/user_dashboard'));
            exit;
        }
    }

    public function handle_register()
    {
        if (!isset($_POST['custom_register_submit'])) return;

        if (!isset($_POST['custom_register_nonce']) || !wp_verify_nonce($_POST['custom_register_nonce'], 'custom_register')) {
            wp_die('درخواست نامعتبر.');
        }

        $phone = sanitize_text_field($_POST['reg_phone']);
        $sms_code = sanitize_text_field($_POST['sms_code']);
        $email = isset($_POST['reg_email']) ? sanitize_email($_POST['reg_email']) : '';
        $password = $_POST['reg_password'];

        if (!preg_match('/^09\d{9}$/', $phone)) {
            wp_redirect(add_query_arg('register_error', 'شماره موبایل معتبر نیست.', wp_get_referer()));
            exit;
        }

        if (!session_id()) {
            session_start();
        }

        if (!isset($_SESSION['sms_code_' . $phone])) {
            wp_redirect(add_query_arg('register_error', 'کد تایید ارسال نشده است.', wp_get_referer()));
            exit;
        }

        $saved_code = $_SESSION['sms_code_' . $phone]['code'];
        $code_time = $_SESSION['sms_code_' . $phone]['time'];
        if (time() - $code_time > 600) {
            unset($_SESSION['sms_code_' . $phone]);
            wp_redirect(add_query_arg('register_error', 'کد تایید منقضی شده است.', wp_get_referer()));
            exit;
        }

        if ($sms_code !== $saved_code) {
            wp_redirect(add_query_arg('register_error', 'کد تایید اشتباه است.', wp_get_referer()));
            exit;
        }

        $user_exists = get_users([
            'meta_key' => 'phone_number',
            'meta_value' => $phone,
            'number' => 1
        ]);
        if (!empty($user_exists)) {
            wp_redirect(add_query_arg('register_error', 'این شماره موبایل قبلا ثبت شده است.', wp_get_referer()));
            exit;
        }

        $username = $phone;

        if ($email && email_exists($email)) {
            wp_redirect(add_query_arg('register_error', 'ایمیل قبلا استفاده شده است.', wp_get_referer()));
            exit;
        }

        $user_id = wp_create_user($username, $password, $email ?: '');

        if (is_wp_error($user_id)) {
            wp_redirect(add_query_arg('register_error', $user_id->get_error_message(), wp_get_referer()));
            exit;
        }

        update_user_meta($user_id, 'phone_number', $phone);
        unset($_SESSION['sms_code_' . $phone]);

        wp_redirect(add_query_arg('register_success', '1', wp_get_referer()));
        exit;
    }

    public function handle_password_reset()
    {
        if (!isset($_POST['custom_reset_submit'])) return;
        if (!isset($_POST['custom_reset_nonce']) || !wp_verify_nonce($_POST['custom_reset_nonce'], 'custom_reset')) {
            wp_die('درخواست نامعتبر.');
        }

        $email = sanitize_email($_POST['reset_email']);
        $user = get_user_by('email', $email);

        if (!$user) {
            wp_redirect(add_query_arg('reset_error', '1', wp_get_referer()));
            exit;
        }

        $reset_key = get_password_reset_key($user);
        $reset_link = network_site_url("wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login), 'login');

        wp_mail($user->user_email, 'بازیابی رمز عبور', "برای تنظیم رمز جدید، روی لینک زیر کلیک کنید:\n$reset_link");

        wp_redirect(add_query_arg('reset_success', '1', wp_get_referer()));
        exit;
    }
}
