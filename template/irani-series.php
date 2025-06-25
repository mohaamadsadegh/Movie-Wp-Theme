<?php use core\MovieHelper;

$options = get_option('moves_options'); ?>
<!--irani series-->
<section class="container md:px-0 px-5 mt-2">
    <div class="text-white">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['irani_series_title'] ?></h3>
            <div class="relative w-[200px] hidden md:block">
                <div class="flex justify-between items-center">
                    <div class="swiper-button-next cart-slider-next mt-0 !static "></div>
                    <div class="swiper-button-prev cart-slider-prev mt-0 !static "></div>
                    <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                        بیشتر</a>
                </div>
            </div>
        </div>

        <div class="swiper cart-slider">
            <div class="swiper-wrapper">
                <?php $irani_series = new WP_Query([
                    'post_type' => 'series' ,
                    'posts_per_page' => 12 ,
                    'tax_query' => [
                        [
                            'taxonomy' => 'irani' ,
                            'field' => 'slug' ,
                            'terms' => 'irani' ,
                        ]
                    ]
                ]);
                if ($irani_series->have_posts()) : ?>
                    <?php while ($irani_series->have_posts()) : $irani_series->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="text-center overflow-hidden shadow-md">
                                <a href="<?php the_permalink() ?>">
                                    <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= esc_attr($title) ?>"
                                         class="w-full h-[285px] rounded-[10px] object-cover"/></a>
                                <div class="p-3 space-y-1">
                                    <h3 class="text-sm font-semibold line-clamp-1"><?= the_title() ?></h3>
                                    <?php echo  MovieHelper::renderBroadcastInfo(get_the_ID()); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
</section>