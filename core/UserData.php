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
        }else
        {
            echo '<div class="w-full bg-yellow-400 text-black text-sm  py-2 px-5 rounded hover:bg-yellow-300"> ' . $current_user->user_firstname . ' ' . $current_user->first_name . '</div>';
        }
    }
    public static function user_login()
    {
        $login = is_user_logged_in();
        $re =  home_url('my-account');
        if (!$login) {
            echo '<a href="'.$re.'" class="w-full bg-yellow-400 text-black text-sm  py-2 px-5 rounded hover:bg-yellow-300">ورود</a>';
        }else{
           self::get_user_login();
        }
    }
}