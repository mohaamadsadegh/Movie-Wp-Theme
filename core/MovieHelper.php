<?php
namespace core;

class MovieHelper {

    public static function getSeriesStatusLabel($key) {
        $statuses = [
            'ongoing' => 'در حال پخش',
            'ended'   => 'تمام شده',
            'paused'  => 'در حال توقف',
        ];
        return $statuses[$key] ?? 'نامشخص';
    }

    public static function getLanguageLabel($key) {
        $languages = [
            'fa'      => 'فارسی',
            'en'      => 'انگلیسی',
            'dub-fa'  => 'دوبله فارسی',
            'sub-fa'  => 'زیرنویس چسبیده',
            'multi'   => 'چندزبانه',
        ];
        return $languages[$key] ?? 'نامشخص';
    }

    public static function getAirDayLabel($key) {
        $days = [
            'شنبه'     => 'شنبه',
            'یک‌شنبه'  => 'یک‌شنبه',
            'دوشنبه'   => 'دوشنبه',
            'سه‌شنبه'  => 'سه‌شنبه',
            'چهارشنبه' => 'چهارشنبه',
            'پنج‌شنبه' => 'پنج‌شنبه',
            'جمعه'     => 'جمعه',
        ];
        return $days[$key] ?? 'نامشخص';
    }

    public static function getGenres($post_id) {
        $terms = get_the_terms($post_id, 'genre');
        if (!empty($terms) && !is_wp_error($terms)) {
            return join(', ', wp_list_pluck($terms, 'name'));
        }
        return 'نامشخص';
    }

    public static function getCountries($post_id) {
        $terms = get_the_terms($post_id, 'country');
        if (!empty($terms) && !is_wp_error($terms)) {
            return join(', ', wp_list_pluck($terms, 'name'));
        }
        return 'نامشخص';
    }
    public static function getEpisode($post_id) {
        return get_post_meta($post_id, '_episode', true) ?: ' - ';
    }

    public static function getAirTime($post_id) {
        return get_post_meta($post_id, '_air_time', true) ?: ' - ';
    }

    public static function getAirDay($post_id) {
        $key = get_post_meta($post_id, '_air_day', true);
        return self::getAirDayLabel($key) ?: 'نامشخص';
    }
    public static function renderBroadcastInfo($post_id) {
        $episode  = self::getEpisode($post_id);
        $air_time = self::getAirTime($post_id);
        $air_day  = self::getAirDay($post_id);

        return '<div class="inline-block text-xs font-bold">'
            . 'قسمت ' . esc_html($episode)
            . ' <span class="text-gray-500">|</span> '
            . 'ساعت ' . esc_html($air_time)
            . ' <span class="text-gray-500">|</span> '
            . '<span class="text-yellow-400">' . esc_html($air_day) . '</span>'
            . '</div>';
    }


}
