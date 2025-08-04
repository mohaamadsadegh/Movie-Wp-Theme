<?php use core\MovieHelper;

$options = get_option('moves_options'); ?>
<!--فیلم های برتر-->
<section class="container md:px-0 px-5 mb-[3]">
    <div class="swiper topMoviesSwiper">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['top_movie_title'] ?></h3>
            <div class="relative w-[200px] hidden md:block">
                <div class="flex justify-end items-center">
                    <a href="#"
                       class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                        بیشتر</a>
                </div>
            </div>
        </div>
        <div class="swiper-wrapper">
            <?php
            $topmoves = new WP_Query(['post_type' => ['movie' , 'series' , 'anime'] , 'posts_per_page' => 16 ,]);
            if ($topmoves->have_posts()) : ?>
                <?php while ($topmoves->have_posts()) : $topmoves->the_post(); ?>
                    <!-- Slide Item -->
                    <div class="swiper-slide">
                        <div class="flex gap-4 p-1 items-center bg-bluet-600 rounded-lg">
                            <img src="<?php the_post_thumbnail_url(); ?>"
                                 class="w-[79px] h-[118px] rounded-md object-cover" alt="poster">
                            <div class="text-white text-sm">
                                <a href="<?php the_permalink() ?>"><h3 class="font-semibold text-right"><?= the_title() ?></h3></a>
                                <p class="text-gray-400 mt-1 text-xs text-right"> <?php echo MovieHelper::getGenres(get_the_ID()) ?></p>
                                <div class="flex items-center gap-2 mt-2 justify-end">
                                    <span class="text-yellow-400 text-xs">IMDB</span>
                                    <span class="text-sm">8.1</span>
                                    <span class="text-gray-400 text-xs">975k رای</span>
                                </div>
                                <div class="flex items-end">
                                    <button class="mt-3 bg-[#2a273f] text-white px-3 py-1 rounded-md text-xs flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v6m0 0l3-3m-3 3l-3-3M12 4v8"/>
                                        </svg>
                                        دانلود
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <img alt="" class="my-5" src="<?php echo IMG_URL . 'Line.svg' ?>">
</section>