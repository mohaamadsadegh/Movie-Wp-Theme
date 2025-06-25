<?php


namespace core;

class Setup
{
    public function __construct()
    {
        $post_types = ['movie' , 'series' , 'actor'];
        add_action('after_setup_theme' , [$this , 'init']);

        foreach ($post_types as $type) {
            add_filter("manage_{$type}_posts_columns" , [$this , 'add_movie_thumbnail_column']);
            add_action("manage_{$type}_posts_custom_column" , [$this , 'show_movie_thumbnail_column'] , 10 , 2);
        }
        add_action('admin_head' , [$this , 'style_thumbnail']);
    }

    public function init()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        register_nav_menu('main-menu' , 'منوی اصلی');
        add_theme_support('title-tag');
        add_theme_support('html5' , ['search-form' , 'gallery' , 'caption']);
    }

    public function add_movie_thumbnail_column($columns)
    {
        $new = [];
        foreach ($columns as $key => $value) {
            if ($key === 'title') {
                $new['thumbnail'] = 'تصویر';
            }
            $new[$key] = $value;
        }
        return $new;
    }


    public function show_movie_thumbnail_column($column , $post_id): void
    {
        if ($column === 'thumbnail') {
            $thumbnail = get_the_post_thumbnail($post_id , [50 , 50]);
            echo $thumbnail ?: '—';
        }
    }

    public function style_thumbnail()
    {
        echo '<style>
        .column-thumbnail {
            width: 60px !important;
            text-align: center;
        }
        .column-thumbnail img {
            max-width: 40px;
            height: auto;
            border-radius: 4px;
        }
    </style>';
    }
}
