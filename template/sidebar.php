<!--sidebar-->
<div class="sidebar w-full md:w-[29%]">
    <div class="genre-box bg-bluet-600 p-4 pb-0 rounded-xl text-white max-w-md mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec">ژانر</h3>
            <div>
                <button class="tab-btn border-white text-gray-300 px-4 py-1 rounded-md"
                        data-tab="serial">
                    سریال
                </button>
                <button class="tab-btn text-black px-4 py-1 rounded-md" data-tab="film">فیلم</button>
            </div>
        </div>


        <!-- Genres Grid -->
        <div class="grid grid-cols-2 gap-3 text-sm genre-list">
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>اکشن</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>ترسناک</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>تاریخی</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>ترسناک</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>تاریخی</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>ترسناک</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن</span><span class="text-gray-400">23</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span> علمی تخیلی </span><span class="text-gray-400">23</span>
            </button>
        </div>

        <!-- Show More -->
        <div class="mt-4 text-center">
            <button class="text-sm text-gray-300 bg-bluet-700 px-4 py-2 rounded-t-md">نمایش بیشتر
            </button>
        </div>
    </div>
    <div class="bg-bluet-600 p-4 rounded-xl text-white max-w-md mx-auto mt-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec">جدیدترین دوبله ها</h3>
            <div>
                <a href="#"
                   class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                    بیشتر</a>
            </div>
        </div>
        <!-- slider -->
        <div>
            <div class="swiper sidebar-slider">
                <div class="swiper-wrapper">
                    <?php $blog = new WP_Query(['post_type' => 'movie' , 'posts_per_page' => 12 ,]);
                    if ($blog->have_posts()) : ?>
                        <?php while ($blog->have_posts()) : $blog->the_post(); ?>
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="text-center overflow-hidden shadow-md">
                                    <img src="<?php the_post_thumbnail_url() ?>"
                                         alt="Movie Poster"
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
    </div>
    <div class="bg-bluet-600 p-4 rounded-xl text-white max-w-md mx-auto mt-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec">سریال های آپدیت شده</h3>
            <div>
                <a href="#"
                   class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                    بیشتر</a>
            </div>
        </div>
        <?php $blog = new WP_Query(['post_type' => 'series' , 'posts_per_page' => 4 ,]);
        if ($blog->have_posts()) : ?>
            <?php while ($blog->have_posts()) : $blog->the_post(); ?>
                <div class="image relative w-full mb-2">
                    <a href="<?php the_permalink();?>"><img class="rounded-[10px] w-full h-24 object-cover"
                                                            src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title() ?>">
                        <div class="overlay text-start">
                            <h2 class="text-sm"><?php echo the_title() ?></h2>
                        </div>
                    </a>
                </div>
            <?php endwhile;
        else : ?>
            <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
        <?php endif; ?>

    </div>
    <div class="bg-bluet-600 p-4 rounded-xl text-white max-w-md mx-auto mt-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-[24px]">
            <div>
                <div>
                    <button class="tab-btn border-white text-gray-300 px-4 py-1 rounded-md"
                            data-tab="serial">
                        سریال
                    </button>
                    <button class="tab-btn text-black px-4 py-1 rounded-md" data-tab="film">فیلم
                    </button>
                </div>
            </div>
        </div>
        <!-- slider -->
        <div>
            <div class="swiper sidebar-slider">
                <div class="swiper-wrapper">
                    <?php $blog = new WP_Query(['post_type' => 'movie' , 'posts_per_page' => 4 ,]);
                    if ($blog->have_posts()) : ?>
                        <?php while ($blog->have_posts()) : $blog->the_post(); ?>
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <a href="<?php the_permalink();?>">
                                    <div class="text-center overflow-hidden shadow-md">
                                        <img src="<?php the_post_thumbnail_url() ?>" alt="Movie Poster"
                                             class="w-full rounded-[10px] object-cover"/>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                    else : ?>
                        <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="genre-box bg-bluet-600 p-4 rounded-xl text-white max-w-md mx-auto mt-4">

        <!-- Header -->
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec">دوبله های فارسی</h3>

        </div>

        <!-- Genres Grid -->
        <div class="grid grid-cols-2 gap-3 text-sm genre-list">

            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن های دوبله</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن های دوبله</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن های دوبله</span>
            </button>
            <button class="genre-item bg-bluet-700 text-white px-4 py-2 rounded-lg flex justify-between">
                <span>انیمیشن های دوبله</span>
            </button>

        </div>

    </div>
</div>