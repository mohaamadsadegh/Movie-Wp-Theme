<?php

use core\Renderer;

get_header();

while (have_posts()) : the_post();
    $id = get_the_ID();
    $trailer_url = get_post_meta($id , '_movie_trailer' , true);
    $poster = get_post_meta($id , '_movie_poster' , true);
    $poster = $poster ?: get_the_post_thumbnail_url();
    $summary = get_post_meta($id , '_video_summary' , true);
    ?>
    <!---->
    <section class="">
        <div class="h-[482px] relative hidden md:block"
             style="background-image: url('<?php echo esc_url($poster); ?>') ; background-position: center; background-repeat: no-repeat; background-size: cover;">
            <div class="overlay-poster">
            </div>
        </div>
        <div class="container relative md:px-0 px-5 md:-mt-60 mt-5 z-50">
            <div class="text-white space-y-10">
                <!-- اطلاعات کلی سریال -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- پوستر -->
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="poster"
                         class="md:w-60 w-full h-auto rounded-lg shadow-lg">
                    <!-- جزئیات -->
                    <div class="flex-1 text-center md:text-start space-y-3">
                        <h1 class="md:text-3xl font-medium"><?php the_title(); ?></h1>
                        <p class="text-sm text-gray-400 italic">The Lord of the Rings: The Rings of Power (2022)</p>
                        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
                        <div class="flex gap-3 text-yellow-400 justify-center md:justify-start">
                            <span>امتیاز IMDb: 7.2</span>
                            <span>|</span>
                            <span>امتیاز کاربران: 4.2 / 5</span>
                        </div>
                        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
                        <?php Renderer::render_meta(get_the_ID()); ?>
                        <div class="flex gap-3 flex-wrap mt-4">
                            <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
                            <button class="bg-green-600 px-2 py-1 rounded hover:bg-green-500">دانلود اختصاصی</button>
                            <button class="bg-red-600 px-2 py-1 rounded hover:bg-red-500">دوبله فارسی</button>
                            <button class="bg-gray-700 px-2 py-1 rounded hover:bg-gray-600">زیرنویس چسبیده</button>
                        </div>
                    </div>
                </div>

                <!-- ویدیو تریلر -->
                <div class="flex justify-between flex-wrap">
                    <div class="md:w-[60%] w-full border rounded border-[#2A2933] p-3 flex flex-col justify-between">

                        <h3 class="title-sec mb-5">گزیده داستان</h3>
                        <?php if (!empty($summary)) { ?>
                            <p class="font-DanaMedium text-sm line-clamp-3 text-[#C3C6D9] leading-[2rem]"><?= $summary ?></p>
                            <div class="mt-4 flex justify-end">
                                <a href="#" class="bg-yellow-yellow900 rounded-[7px] px-[8px] py-[6px]  text-white">شرح
                                    بیشتر</a>
                            </div>
                        <?php } else {
                            echo "متاسفانه اطلاعاتی یافت نشد";
                        } ?>
                    </div>

                    <?php if ($trailer_url):
                        if (str_contains($trailer_url , 'youtube.com') !== false || str_contains($trailer_url , 'youtu.be') !== false || str_contains($trailer_url , 'aparat.com') !== false):
                            ?>
                            <iframe class="md:w-[38%] mt-5 w-full aspect-video rounded-lg"
                                    src="<?php echo esc_url($trailer_url); ?>" allowfullscreen></iframe>
                        <?php
                        else:
                            ?>
                            <video class="md:w-[38%] mt-5 w-full rounded-lg" src="<?php echo esc_url($trailer_url); ?>"
                                   controls></video>
                        <?php
                        endif;
                    endif;
                    ?>
                </div>
            </div>
            <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
        </div>
    </section>
    <?php
//    links download
    get_template_part('template/single/link-download');

//    actor single
    get_template_part('template/single/actor-single');

//     excerpt story
    if (!empty(get_the_excerpt())) {
        get_template_part('template/single/excerpt-story');
    }
    // comments
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
endwhile;
// slider section
get_template_part('template/irani-series');
get_footer();