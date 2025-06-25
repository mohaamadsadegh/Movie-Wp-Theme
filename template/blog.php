<!--blog-->
<?php
$options = get_option('moves_options');
if ($options['show_blog'] == 1) { ?>
    <section class="container md:px-0 px-5 mt-2">
        <div class="text-white">
            <div class="flex justify-between items-center mb-[24px]">
                <h3 class="title-sec"><?= $options['blog_title'] ?></h3>
                <div class="relative w-[200px] hidden md:block">
                    <div class="flex justify-between items-center">
                        <div class="swiper-button-next cart-slider-next mt-0 !static"></div>
                        <div class="swiper-button-prev cart-slider-prev mt-0 !static"></div>
                        <a href="#"
                           class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                            بیشتر</a>
                    </div>
                </div>
            </div>
            <div class="swiper blog-slider">
                <div class="swiper-wrapper">
                    <?php $blog = new WP_Query(['post_type' => 'post' , 'posts_per_page' => 12 ,]);
                    if ($blog->have_posts()) : ?>
                        <?php while ($blog->have_posts()) : $blog->the_post(); ?>
                            <!-- Slide blog -->
                            <div class="swiper-slide">
                                <div class="text-center bg-bluet-600 overflow-hidden shadow-md p-3 pb-0">
                                    <a href="<?= get_permalink() ?>"
                                       class="w-full h-[145px] rounded-[10px] object-cover flex"> <?php the_post_thumbnail() ?>
                                    </a>
                                    <div class="p-3 pb-0 space-y-1">
                                        <h3 class="text-sm font-semibold line-clamp-1"><?php the_title() ?></h3>
                                        <div class="inline-block  text-sm font-bold"><?php the_excerpt(''); ?>
                                        </div>
                                        <a href="<?= get_permalink() ?>"
                                           class="inline-block text-sm text-gray-300 bg-bluet-700 px-4 py-2 rounded-t-md">نمایش
                                            بیشتر</a>
                                    </div>
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
<?php } ?>