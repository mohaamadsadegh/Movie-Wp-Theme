<?php

namespace inc\posttype;

class Movie
{
    public function __construct()
    {
        add_action('init' , [$this , 'register_post_types']);
        add_action('init' , [$this , 'register_taxonomies']);
        add_action('init' , [$this , 'maybe_insert_default_terms']);
        add_action('init', [$this, 'add_default_countries'], 20);

    }

    public function get_api()
    {
        $options = get_option('moves_options');
        $omdb_key = $options['omdb_api_key'] ?? '';
        $tmdb_key = $options['tmdb_api_key'] ?? '';
    }

    public function register_post_types()
    {
        register_post_type('movie' , [
            'labels' => [
                'name' => 'فیلم ها' ,
                'singular_name' => 'فیلم' ,
                'add_new' => 'افزودن فیلم' ,
                'edit_item' => 'ویرایش فیلم' ,
                'all_items' => 'همه فیلم ها'
            ] ,
            'public' => true ,
            'menu_icon' => 'dashicons-video-alt2' ,
            'supports' => ['title' , 'editor' , 'thumbnail', 'comments'] ,
            'rewrite' => ['slug' => 'movies'] ,
            'show_in_rest' => true ,
            'taxonomies' => array('category' , 'tags' , 'post_tag' , 'irani' ) ,
        ]);

        // Series
        register_post_type('series' , [
            'labels' => [
                'name' => 'سریال‌ها' ,
                'singular_name' => 'سریال' ,
                'add_new' => 'افزودن سریال' ,
                'edit_item' => 'ویرایش سریال' ,
                'all_items' => 'همه سریال‌ها'
            ] ,
            'public' => true ,
            'has_archive' => true ,
            'menu_icon' => 'dashicons-video-alt2' ,
            'supports' => ['title' , 'editor' , 'thumbnail'. 'comments'] ,
            'rewrite' => ['slug' => 'series'] ,
            'taxonomies' => array('category' , 'tags' , 'post_tag' ) ,
        ]);

        // Actor
        register_post_type('actor' , [
            'labels' => [
                'name' => 'بازیگران' ,
                'singular_name' => 'بازیگر' ,
                'add_new' => 'افزودن بازیگر' ,
                'edit_item' => 'ویرایش بازیگر' ,
                'all_items' => 'همه بازیگران'
            ] ,
            'public' => true ,
            'has_archive' => true ,
            'menu_icon' => 'dashicons-admin-users' ,
            'supports' => ['title' , 'editor' , 'thumbnail', 'comments'] ,
            'rewrite' => ['slug' => 'actors'] ,
            'taxonomies' => array('category' , 'tags' , 'post_tag' ) ,
        ]);
    }


    public function register_taxonomies()
    {
        register_taxonomy('irani' , ['movie' , 'series'] , [
            'label' => 'ایرانی' ,
            'hierarchical' => true ,
            'public' => true ,
            'rewrite' => ['slug' => 'irani'] ,
        ]);
        register_taxonomy('global' , ['movie' , 'series'] , [
            'label' => 'خارجی' ,
            'hierarchical' => true ,
            'public' => true ,
            'rewrite' => ['slug' => 'global'] ,
        ]);
        register_taxonomy('anime' , ['movie' , 'series'] , [
            'label' => 'انیمیشن' ,
            'hierarchical' => true ,
            'public' => true ,
            'rewrite' => ['slug' => 'anime'] ,
        ]);

        $genre = [
            'name'              => 'ژانرها',
            'singular_name'     => 'ژانر',
            'search_items'      => 'جستجوی ژانرها',
            'all_items'         => 'تمام ژانرها',
            'parent_item'       => null,
            'parent_item_colon' => null,
            'edit_item'         => 'ویرایش ژانر',
            'update_item'       => 'بروزرسانی ژانر',
            'add_new_item'      => 'افزودن ژانر جدید',
            'new_item_name'     => 'نام ژانر جدید',
            'menu_name'         => 'ژانرها',
        ];

        register_taxonomy('genre', ['movie', 'series'], [
            'labels' => $genre,
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'genre'],
        ]);
        $labels = [
            'name'              => 'کشورها',
            'singular_name'     => 'کشور',
            'search_items'      => 'جستجوی کشور',
            'all_items'         => 'همه کشورها',
            'edit_item'         => 'ویرایش کشور',
            'update_item'       => 'بروزرسانی کشور',
            'add_new_item'      => 'افزودن کشور جدید',
            'new_item_name'     => 'نام کشور جدید',
            'menu_name'         => 'کشور سازنده',
        ];

        register_taxonomy('country', ['movie', 'series'], [
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'country'],
        ]);

    }

    public function maybe_insert_default_terms()
    {
        if (!term_exists('ایرانی' , 'irani')) {
            wp_insert_term('ایرانی' , 'irani' , ['slug' => 'irani']);
        }

        if (!term_exists('خارجی' , 'global')) {
            wp_insert_term('خارجی' , 'global' , ['slug' => 'global']);
        }

        if (!term_exists('انیمیشن' , 'anime')) {
            wp_insert_term('انیمیشن' , 'anime' , ['slug' => 'anime']);
        }
    }
    public function add_default_countries() {
        $countries = ['ایران', 'آمریکا', 'فرانسه', 'انگلستان', 'ژاپن', 'آلمان', 'هند', 'کره جنوبی'];

        foreach ($countries as $country) {
            if (!term_exists($country, 'country')) {
                wp_insert_term($country, 'country');
            }
        }
    }

}
