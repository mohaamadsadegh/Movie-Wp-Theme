<?php
/*
Template Name: archive
*/

use core\MovieHelper;

get_header();
//filter
get_template_part('template/filter');
?>
    <!--cart -->
    <section class="container md:px-0 px-5 mt-2">
        <div class="flex">
            <div class="text-white">
                <div class="flex justify-center items-center mb-[24px]">
                    <h3 class="title-sec">سریال های ایرانی به روز شده</h3>
                </div>
                <div class="flex justify-between">
                    <div class="sidebar md:w-[18%]">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-[24px]">
                            <h3 class="title-sec">فیلتر ها</h3>
                        </div>

                        <!-- Genres Grid -->
                        <div class="flex w-full flex-wrap">
                            <label class="bg-bluet-600 p-3 w-full flex justify-between rounded-xl">
                                به روز ترین
                                <input type="radio" value="">
                            </label>
                            <label class="bg-bluet-600 mt-3 p-3 w-full flex justify-between rounded-xl">
                                به روز ترین
                                <input type="radio" value="">
                            </label>
                            <label class="bg-bluet-600 mt-3 p-3 w-full flex justify-between rounded-xl">
                                به روز ترین
                                <input type="radio" value="">
                            </label>
                            <label class="bg-bluet-600 mt-3 p-3 w-full flex justify-between rounded-xl">
                                به روز ترین
                                <input type="radio" value="">
                            </label>
                        </div>

                    </div>
                    <div class="flex flex-wrap gap-4 md:w-[81%]">
                        <?php $archive = new WP_Query(['post_type' => 'movie' , 'posts_per_page' => 12 ,]);
                        if ($archive->have_posts()) : ?>
                            <?php while ($archive->have_posts()) : $archive->the_post(); ?>
                                <div class="archive-box">
                                    <div class="text-center overflow-hidden shadow-md">
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="Movie Poster"
                                             class="w-full h-[285px] rounded-[10px] object-cover"/>
                                        <div class="p-3 space-y-1">
                                            <h3 class="text-sm font-semibold line-clamp-1"><?php the_title() ?></h3>
                                            <?php if (get_post_type() === 'series')
                                            { echo MovieHelper::renderBroadcastInfo(get_the_ID());}
                                            ?>
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

<?php
get_template_part('template/listmove');

 get_footer();
?>