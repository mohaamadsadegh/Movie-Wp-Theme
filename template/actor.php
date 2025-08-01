<?php $options = get_option('moves_options') ?>
<!-- actor -->
<section class="bg-bluet-600 md:px-0 px-5 my-[40px]">
    <div class="container px-0 py-5  text-white ">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['irani_title'] ?></h3>
            <div class="relative w-[200px] hidden md:block">
                <div class="flex justify-between items-center">
                    <div class="swiper-button-next cart-slider-next mt-0 !static "></div>
                    <div class="swiper-button-prev cart-slider-prev mt-0 !static "></div>
                    <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                        بیشتر</a>
                </div>
            </div>
        </div>
        <div class="swiper info-slider">
            <div class="swiper-wrapper">
                <?php $actor = new WP_Query([
                    'post_type' => 'actor' ,
                    'posts_per_page' => 12 ,
                ]);
                if ($actor->have_posts()) : ?>
                <?php while ($actor->have_posts()) : $actor->the_post(); ?>
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="text-center overflow-hidden shadow-md">
                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>" alt="Movie Poster"
                             class="w-full rounded-[10px] object-cover"/>
                    </div>
                </div>
                    <?php endwhile;
                else : ?>
                    <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!--        -->
        <div class="flex justify-between items-center mt-[40px] mb-[24px]">
            <h3 class="title-sec"><?= $options['global_title'] ?></h3>
            <div class="relative w-[200px] hidden md:block">
                <div class="flex justify-between items-center">
                    <div class="swiper-button-next cart-slider-next mt-0 !static "></div>
                    <div class="swiper-button-prev cart-slider-prev mt-0 !static "></div>
                    <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                        بیشتر</a>
                </div>
            </div>
        </div>
        <div class="swiper info-slider">
            <div class="swiper-wrapper">
                <?php $actor = new WP_Query([
                    'post_type' => 'actor' ,
                    'posts_per_page' => 12 ,
                ]);
                if ($actor->have_posts()) : ?>
                <?php while ($actor->have_posts()) : $actor->the_post(); ?>
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="text-center overflow-hidden shadow-md">
                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>"  alt="Movie Poster"
                             class="w-full rounded-[10px] object-cover"/>
                    </div>
                </div>
                    <?php endwhile;
                else : ?>
                    <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>