<?php

namespace inc\Auth;

class AuthController
{
    public function __construct()
    {
        add_shortcode('custom_login_form', [$this, 'render_auth_modal']);
    }

    public function render_auth_modal()
    {
        ob_start();
        ?>
        <div id="authModal" class="modal hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg max-w-md w-full relative shadow-lg">
                <button onclick="toggleModal('authModal', false)" class="absolute top-2 right-2 text-black text-xl">&times;</button>

                <!-- انتخاب فرم -->
                <div id="authTypeSelect" class="space-y-4">
                    <h2 class="text-center text-lg font-bold">نوع ورود/عضویت</h2>
                    <button type="button" data-target="registerStep1" class="auth-type-btn bg-blue-600 text-white py-2 rounded w-full">ثبت‌نام</button>
                    <button type="button" data-target="loginForm" class="auth-type-btn bg-green-600 text-white py-2 rounded w-full">ورود</button>
                </div>

                <!-- فرم ثبت‌نام چند مرحله‌ای -->
                <form id="registerForm" class="auth-form hidden space-y-4">
                    <div class="step" data-step="registerStep1">
                        <label>نام</label>
                        <input type="text" name="first_name" class="input" required>
                        <label>نام خانوادگی</label>
                        <input type="text" name="last_name" class="input" required>
                        <button type="button" class="next-step btn">ادامه</button>
                    </div>

                    <div class="step hidden" data-step="registerStep2">
                        <label>شماره موبایل</label>
                        <input type="text" name="phone" class="input" required>
                        <button type="button" class="send-code btn">ارسال کد تایید</button>
                        <button type="button" class="prev-step text-sm text-blue-600 mt-2">بازگشت</button>
                    </div>

                    <div class="step hidden" data-step="registerStep3">
                        <label>کد تایید</label>
                        <input type="text" name="sms_code" class="input" required>
                        <button type="submit" class="btn">ثبت‌نام</button>
                        <button type="button" class="prev-step text-sm text-blue-600 mt-2">بازگشت</button>
                    </div>
                </form>

                <!-- فرم ورود -->
                <form id="loginForm" class="auth-form hidden space-y-4">
                    <label>نام کاربری یا شماره موبایل</label>
                    <input type="text" name="login_user" class="input" required>
                    <label>رمز عبور</label>
                    <input type="password" name="login_pass" class="input" required>
                    <button type="submit" class="btn">ورود</button>
                    <button type="button" class="text-sm text-blue-600 mt-2" onclick="switchToRegister()">ثبت‌نام نکرده‌اید؟</button>
                </form>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
