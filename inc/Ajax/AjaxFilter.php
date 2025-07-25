<?php

namespace inc\Ajax;

use core\MovieHelper;

use WP_Query;

class ajaxFilter
{
    /**
     * مقدار اکشن برای این کلاس
     */
    public static function action_name(): string
    {
        return 'filter_movies';
    }

    /**
     * متد هندل کردن درخواست AJAX
     */
    public function handle()
    {
        // بررسی nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'filter_movies_nonce')) {
            wp_send_json_error(['message' => 'Invalid nonce']);
        }

        $args = [
            'post_type' => 'movie',
            'posts_per_page' => 6,
            'meta_query' => ['relation' => 'AND'],
        ];

        // فیلترها
        if (!empty($_POST['type'])) {
            $args['meta_query'][] = [
                'key' => 'movie_type',
                'value' => sanitize_text_field($_POST['type']),
                'compare' => '='
            ];
        }

        if (!empty($_POST['genre'])) {
            $args['meta_query'][] = [
                'key' => 'movie_genre',
                'value' => sanitize_text_field($_POST['genre']),
                'compare' => 'LIKE'
            ];
        }

        if (!empty($_POST['year_from'])) {
            $args['meta_query'][] = [
                'key' => 'movie_year',
                'value' => intval($_POST['year_from']),
                'type' => 'NUMERIC',
                'compare' => '>='
            ];
        }

        if (!empty($_POST['year_to'])) {
            $args['meta_query'][] = [
                'key' => 'movie_year',
                'value' => intval($_POST['year_to']),
                'type' => 'NUMERIC',
                'compare' => '<='
            ];
        }

        if (!empty($_POST['rating'])) {
            $args['meta_query'][] = [
                'key' => 'movie_rating',
                'value' => intval($_POST['rating']),
                'type' => 'NUMERIC',
                'compare' => '>='
            ];
        }

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
                                <div class="box w-[33%] ml-2">
                                    <div class="text-center overflow-hidden shadow-md">
                                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-[285px] rounded-[10px] object-cover']); ?>
                                        </a>
                                        <div class="p-3 space-y-1">
                                            <h3 class="text-sm font-semibold line-clamp-1"><?php the_title(); ?></h3>
                                            <?php echo  MovieHelper::renderBroadcastInfo(get_the_ID()); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                        else :
                            echo '<p class="text-white mt-4">هیچ موردی یافت نشد.</p>';
                        endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        wp_reset_postdata();

        $html = ob_get_clean();


        wp_send_json_success(['html' => $html]);
    }
}
