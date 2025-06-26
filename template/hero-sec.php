<!-- hero Slider -->
<section class="container md:px-0 px-5 mt-5">
    <div class="flex md:justify-between md:flex-nowrap flex-wrap justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <?php $hero_sec = new WP_Query([
                'post_type' => ['series' , 'movie' , 'anime'] ,
                'posts_per_page' => 4 ,
            ]);
            if ($hero_sec->have_posts()) : ?>
            <?php while ($hero_sec->have_posts()) : $hero_sec->the_post(); ?>
            <div class="image-hero relative md:w-[300px] w-full">
                <img alt="" class="rounded-[10px] w-full h-auto" src="<?php the_post_thumbnail_url() ?>">
                <div class="overlay text-start">
                    <h2 class="text-sm"><?= the_title() ?></h2>
                </div>
            </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
            <?php endif; ?>
        </div>
        <div class="md:w-1/2 w-full mt-4 md:mt-0">
            <div class="hero-slide swiper">
                <div class="swiper-wrapper">
                    <?php
                    $hero_sec = new WP_Query([
                        'post_type' => [ 'movie' , 'anime'] ,
                        'posts_per_page' => 4 ,
                    ]);
                    if ($hero_sec->have_posts()) : ?>
                    <?php while ($hero_sec->have_posts()) : $hero_sec->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="image relative">
                            <img alt="" class="rounded-[10px] w-full" src="<?php the_post_thumbnail_url() ?>">
                            <div class="overlay text-start">
                                <h2 class="text-base"><?php the_title(); ?></h2>
                                <div class="tags">
                                    <span>اکشن، درام</span>
                                    <span class="imdb">IMDB</span>
                                    <span>7.2 / 10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                    <?php endif; ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>