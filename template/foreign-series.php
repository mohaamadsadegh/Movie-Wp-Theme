<?php
use core\MovieHelper;

$options = get_option('moves_options'); ?>
<!--foreign series-->
<section class="container md:px-0 px-5 mt-2">
    <div class="text-white">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['foreign_series_title'] ?></h3>
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
                <?php $foreign_series = new WP_Query([
                    'post_type' => 'series' ,
                    'posts_per_page' => 12 ,
                    'tax_query' => [
                        [
                            'taxonomy' => 'global' ,
                            'field' => 'slug' ,
                            'terms' => 'global' ,
                        ]
                    ]
                ]);
                if ($foreign_series->have_posts()) : ?>
                    <?php while ($foreign_series->have_posts()) : $foreign_series->the_post(); ?>
                        <!-- Slide foreign series -->
                        <div class="swiper-slide">
                            <div class="text-center overflow-hidden shadow-md">
                                <a href="<?php the_permalink() ?>"> <img
                                            src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Movie Poster"
                                            class="w-full h-[285px] rounded-[10px] object-cover"/></a>
                                <div class="p-3 space-y-1">
                                    <h3 class="text-sm font-semibold line-clamp-1"><?php the_title() ?></h3>
                                  <?php echo  MovieHelper::renderBroadcastInfo(get_the_ID()); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else : ?>
                    <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                <?php endif; ?>
            </div>

        </div>
        <div class="w-full md:hidden mt-2 mb-5">
            <a href="#"
               class="w-full flex justify-center border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                بیشتر</a>
        </div>
    </div>
</section>