<?php

namespace core;

class Renderer
{
    public static function render_meta($post_id)
    {
        $meta = [];

        // زبان
        $lang_key = get_post_meta($post_id , '_video_language' , true);
        if ($label = MovieHelper::getLanguageLabel($lang_key)) {
            $meta['زبان'] = $label;
        }

        // وضعیت پخش
        $status_key = get_post_meta($post_id , '_series_status' , true);
        if ($label = MovieHelper::getSeriesStatusLabel($status_key)) {
            $meta['وضعیت پخش'] = $label;
        }

        // ژانر
        if ($genres = MovieHelper::getGenres($post_id)) {
            $meta['ژانر'] = $genres;
        }

        // کشور
        if ($countries = MovieHelper::getCountries($post_id)) {
            $meta['کشور سازنده'] = $countries;
        }

        // نمایش
        echo '<ul class="text-sm text-gray-300 space-y-1">';
        foreach ($meta as $label => $value) {
            echo '<li><strong>' . esc_html($label) . ':</strong> ' . esc_html($value) . '</li>';
        }
        echo '</ul>';
    }

    public static function ff($post_id)
    {

        // روز و ساعت پخش
        $air_day = MovieHelper::getAirDayLabel(get_post_meta($post_id , '_air_day' , true));
        $air_time = get_post_meta($post_id , '_air_time' , true);
        if ($air_day) {
            $meta['روز پخش'] = $air_day;
        }


        // قسمت فعلی
        $episode = get_post_meta($post_id , '_episode' , true);
        if ($episode) {
            $meta['قسمت فعلی'] = $episode;
        }
    }

    public static function render_genres($post_id)
    {
        $genres = MovieHelper::getGenres($post_id);
        $meta[''] = $genres;
        return '  <p class="text-gray-400 mt-1 text-xs text-right"> ' . esc_html($genres) . '</p>';
    }

    public static function video_language($post_id)
    {
        $get_post = get_post_meta(get_the_ID(), '_video_language', true);
        $list = [
            'fa' => 'فارسی',
            'en' => 'انگلیسی',
            'dub-fa' => 'دوبله فارسی',
            'sub-fa' => 'زیرنویس چسبیده',
            'multi' => 'چندزبانه'
        ];

        if (!empty($get_post) && isset($list[$get_post])) {
            echo esc_html($list[$get_post]);
        } else {
            echo 'زبان مشخص نیست';
        }
    }
}
