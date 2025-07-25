<?php

namespace Core;

class UserData
{
    public function __construct()
    {
        $user_id = get_current_user_id();
    }

    public static function get_user_login()
    {
        $current_user = wp_get_current_user();
        if (empty($current_user->first_name)) {
            echo '<div class="w-full bg-yellow-400 text-black text-sm  py-2 px-5 rounded hover:bg-yellow-300"> ' . $current_user->display_name . '</div>';
        } else {
            echo '<div class="w-full bg-yellow-400 text-black text-sm  py-2 px-5 rounded hover:bg-yellow-300"> ' . $current_user->user_firstname . ' ' . $current_user->first_name . '</div>';
        }
    }

    public static function register_user()
    {
      ?>
        <!-- مودال ثبت‌نام چند مرحله‌ای -->
        <div id="registerModal" class="modal hidden fixed inset-0 bg-black/80 items-center justify-center z-50">
            <div class="bg-bluet-600 p-6 rounded-lg max-w-md w-full relative shadow-lg border-b-yellow-yellow900 border-b">
                <button onclick="toggleModal('registerModal', false)"
                        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;
                </button>
                <h2 class="font-bold text-start my-5 title-sec">ثبت‌نام</h2>

                <form id="registerForm" class="space-y-4">
                    <!-- مرحله ۱: نام و نام خانوادگی -->
                    <div class="step" data-step="1">
                        <label class="block text-sm mb-1">نام</label>
                        <input type="text" name="first_name" required class="w-full bg-bluet-700 rounded px-3 py-2">
                        <label class="block text-sm mt-4 mb-1">نام خانوادگی</label>
                        <input type="text" name="last_name" required class="w-full bg-bluet-700 rounded px-3 py-2">
                        <button type="button" class="next-step bg-yellow-500 text-white px-4 py-2 rounded mt-4 w-full">
                            ادامه
                        </button>
                    </div>

                    <!-- مرحله ۲: شماره همراه -->
                    <div class="step hidden" data-step="2">
                        <label class="block text-sm mb-1">شماره موبایل</label>
                        <input type="text" name="register_phone" required class="w-full bg-bluet-700 rounded px-3 py-2"
                               placeholder="09xxxxxxxxx">
                        <button type="button" id="sendRegisterCode"
                                class="bg-yellow-yellow900 text-white px-4 py-2 rounded mt-4 w-full">ارسال کد تایید
                        </button>
                        <button type="button" class="prev-step text-sm text-blue-300 mt-2">بازگشت</button>
                    </div>

                    <!-- مرحله ۳: وارد کردن کد -->
                    <div class="step hidden" data-step="3">
                        <label class="block text-sm mb-1">کد تایید</label>
                        <input type="text" name="register_sms_code" maxlength="6" required
                               class="w-full bg-bluet-700 rounded px-3 py-2" placeholder="کد ۶ رقمی">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-4 w-full">تایید و
                            ثبت‌نام
                        </button>
                        <button type="button" class="prev-step text-sm text-blue-300 mt-2">بازگشت</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
    }
    public static function get_user_register()
    {
        self::register_user();
    }
    public static function user_login()
    {
        $login = is_user_logged_in();
        if (!$login) {

            echo do_shortcode('[custom_login_form]');
        } else {
            self::get_user_login();
        }
    }


}