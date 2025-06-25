<?php

namespace core;

use WP_Query;

class ajax
{

    public function __construct()
    {
        add_action('wp_ajax_filter_movies' , [$this , 'handle_ajax']);
        add_action('wp_ajax_nopriv_filter_movies' , [$this , 'handle_ajax']);
        add_action('wp_enqueue_scripts' , [$this , 'enqueue_assets']);
    }

    public function enqueue_assets()
    {
        wp_enqueue_script('movie-filter-js' , IMG_URL_js . 'script.js' , ['jquery'] , null , true);
        wp_localize_script('movie-filter-js' , 'movie_filter_ajax' , [
            'ajax_url' => admin_url('admin-ajax.php') ,
            'nonce' => wp_create_nonce('movie_filter_nonce')
        ]);
    }

    public function handle_ajax()
    {
        check_ajax_referer('movie_filter_nonce' , 'nonce');

        $args = [
            'post_type' => 'movie' ,
            'posts_per_page' => 6 ,
            'meta_query' => ['relation' => 'AND']
        ];

// فیلتر نوع
        if (!empty($_POST['type'])) {
            $args['meta_query'][] = [
                'key' => 'movie_type' ,
                'value' => sanitize_text_field($_POST['type']) ,
                'compare' => '='
            ];
        }

// فیلتر ژانر
        if (!empty($_POST['genre'])) {
            $args['meta_query'][] = [
                'key' => 'movie_genre' ,
                'value' => sanitize_text_field($_POST['genre']) ,
                'compare' => 'LIKE'
            ];
        }

// سال شروع
        if (!empty($_POST['year_from'])) {
            $args['meta_query'][] = [
                'key' => 'movie_year' ,
                'value' => intval($_POST['year_from']) ,
                'type' => 'NUMERIC' ,
                'compare' => '>='
            ];
        }

// سال پایان
        if (!empty($_POST['year_to'])) {
            $args['meta_query'][] = [
                'key' => 'movie_year' ,
                'value' => intval($_POST['year_to']) ,
                'type' => 'NUMERIC' ,
                'compare' => '<='
            ];
        }

// امتیاز
        if (!empty($_POST['rating'])) {
            $args['meta_query'][] = [
                'key' => 'movie_rating' ,
                'value' => intval($_POST['rating']) ,
                'type' => 'NUMERIC' ,
                'compare' => '>='
            ];
        }

// مرتب‌سازی
        if ($_POST['order'] === 'popular') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'movie_views';
            $args['order'] = 'DESC';
        } else {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        }

        $query = new WP_Query($args);

        ob_start(); ?>

        <section class="container md:px-0 px-5 mt-2">
            <div class="text-white">
                <div class="swiper cart-slider-ajax">
                    <div class="swiper-wrapper">
                        <?php if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                                <!-- Slide 1 -->
                                <div class="box w-[33%] ml-2">
                                    <div class="text-center overflow-hidden shadow-md">
                                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover rounded-lg']); ?>
                                        </a>
                                        <div class="p-3 space-y-1">
                                            <h3 class="text-sm font-semibold line-clamp-1"><?= the_title() ?></h3>
                                            <div class="inline-block  text-sm font-bold">قسمت 4
                                                <span class="text-gray-500">|</span>
                                                <span class="text-yellow-400">جمعه ها</span></div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        else :
                            echo '<p class="text-white mt-4">هیچ موردی یافت نشد.</p>';
                        endif;

                        wp_reset_postdata();

                        echo ob_get_clean();
                        wp_die();
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <script>
            const cart_slider_ajax = new Swiper(".cart-slider-ajax", {
                slidesPerView: 6,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".cart-slider-next",
                    prevEl: ".cart-slider-prev"
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.9,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    640: {
                        slidesPerView: 6,
                        spaceBetween: 10,
                    }
                }
            });</script>
 <?php } } ?>
