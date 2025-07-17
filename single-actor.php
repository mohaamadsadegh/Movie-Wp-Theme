<?php

get_header();

while (have_posts()) : the_post();
    $id = get_the_ID();
    $trailer_url = get_post_meta($id , '_movie_trailer' , true);
    $poster = get_post_meta($id , '_movie_poster' , true);
    $poster = $poster ?: get_the_post_thumbnail_url();
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
                        <?php
                        if (!empty(get_the_excerpt())) {
                            get_template_part('template/single/excerpt-story');
                        } ?>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <?php

//     excerpt story
    if (!empty(get_the_excerpt())) {
        get_template_part('template/single/excerpt-story');
    }
endwhile;
// slider section
get_template_part('template/irani-series');
get_footer();