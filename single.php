<?php
use core\Renderer;

get_header();

while (have_posts()) : the_post();
    $trailer_url = get_post_meta(get_the_ID() , '_movie_trailer' , true);
    $poster = get_post_meta(get_the_ID(), '_movie_poster', true);
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
                        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
                        <div class="flex gap-3 text-yellow-400 justify-center md:justify-start">
                            <span>امتیاز IMDb: 7.2</span>
                            <span>|</span>
                            <span>امتیاز کاربران: 4.2 / 5</span>
                        </div>
                        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
                        <?php Renderer::render_meta(get_the_ID());?>
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

                        <h3 class="title-sec mb-5">انمیشن های جدید</h3>

                        <p class="font-DanaMedium text-sm line-clamp-3 text-[#C3C6D9] leading-[2rem]"><?php the_content(); ?></p>
                        <div class="mt-4 flex justify-end">
                            <a href="#" class="bg-yellow-yellow900 rounded-[7px] px-[8px] py-[6px]  text-white">شرح
                                بیشتر</a>
                        </div>
                    </div>

                    <?php if ($trailer_url):
                        if (strpos($trailer_url , 'youtube.com') !== false || strpos($trailer_url , 'youtu.be') !== false || strpos($trailer_url , 'aparat.com') !== false):
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

    <!---->
    <section class="container md:px-0 px-5">
        <h3 class="title-sec mb-5">لینک های دانلود</h3>
        <div class="flex justify-between flex-wrap">
            <div class="flex flex-wrap justify-center md:flex-nowrap">
                <div class="flex rounded border-bluet-700 border p-2 md:ml-2 text-[9px] md:text-[12px] items-center w-full md:w-max">
                    <svg class="ml-2" width="25" height="25" viewBox="0 0 25 25" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.7083 17.7083H17.7187M18.125 14.5833H18.75C19.7207 14.5833 20.2061 14.5833 20.5889 14.7419C21.0994 14.9533 21.505 15.3589 21.7164 15.8694C21.875 16.2522 21.875 16.7376 21.875 17.7083C21.875 18.679 21.875 19.1644 21.7164 19.5472C21.505 20.0577 21.0994 20.4633 20.5889 20.6747C20.2061 20.8333 19.7207 20.8333 18.75 20.8333H6.25C5.27929 20.8333 4.79393 20.8333 4.41108 20.6747C3.9006 20.4633 3.49503 20.0577 3.28358 19.5472C3.125 19.1644 3.125 18.679 3.125 17.7083C3.125 16.7376 3.125 16.2522 3.28358 15.8694C3.49503 15.3589 3.9006 14.9533 4.41108 14.7419C4.79393 14.5833 5.27929 14.5833 6.25 14.5833H6.875M12.5 15.625V4.16663M12.5 15.625L9.375 12.5M12.5 15.625L15.625 12.5"
                              stroke="#FFC107" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p>دانلود شما از این سایت به صورت <span class="text-yellow-yellow900">نیم بها</span> حساب می شود.
                    </p>
                </div>
                <div class="flex rounded border-bluet-700 border p-2 text-[9px] md:text-[12px] mt-3 md:mt-0 items-center w-full md:w-max">
                    <svg class="ml-2" width="25" height="25" viewBox="0 0 25 25" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.29167 19.7917C7.78409 17.4143 9.92882 15.625 12.5 15.625C15.0712 15.625 17.2159 17.4143 17.7083 19.7917M21.875 12.5C21.875 17.6777 17.6777 21.875 12.5 21.875C7.32233 21.875 3.125 17.6777 3.125 12.5C3.125 7.32233 7.32233 3.125 12.5 3.125C17.6777 3.125 21.875 7.32233 21.875 12.5ZM14.5833 10.4167C14.5833 11.5673 13.6506 12.5 12.5 12.5C11.3494 12.5 10.4167 11.5673 10.4167 10.4167C10.4167 9.26607 11.3494 8.33333 12.5 8.33333C13.6506 8.33333 14.5833 9.26607 14.5833 10.4167Z"
                              stroke="#FFC107" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p>محتوای سایت مناسب جمع خانواده بوده و بازبینی شده.</p>
                </div>
            </div>
            <a href="#" class="hidden md:block border border-[#D26161] rounded-[7px] px-[8px] py-[6px] text-[#D26161]">گزارش
                خرابی</a>
        </div>

        <!-- تب فصل‌ها -->
        <div class=" rounded-lg mt-5">
            <div class="flex gap-2 flex-wrap mb-4">
                <button class="bg-yellow-500 px-4 py-1 rounded text-sm font-semibold">فصل اول</button>
                <button class="bg-bluet-600 px-4 py-1 rounded text-sm hover:bg-yellow-500">فصل دوم</button>
                <button class="bg-bluet-600 px-4 py-1 rounded text-sm hover:bg-yellow-500">فصل سوم</button>
            </div>

            <!-- قسمت‌های فصل فعال -->
            <div class="space-y-2">
                <!-- قسمت 01 -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span>قسمت 01 | کیفیت‌ها:</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">1080p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">720p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">480p</button>
                        </div>
                    </div>
                </div>
                <!-- تکرار برای سایر قسمت‌ها -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span>قسمت 01 | کیفیت‌ها:</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">1080p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">720p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">480p</button>
                        </div>
                    </div>
                </div>
                <!-- تکرار برای سایر قسمت‌ها -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span>قسمت 01 | کیفیت‌ها:</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">1080p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">720p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">480p</button>
                        </div>
                    </div>
                </div>
                <!-- تکرار برای سایر قسمت‌ها -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span>قسمت 01 | کیفیت‌ها:</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">1080p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">720p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">480p</button>
                        </div>
                    </div>
                </div>
                <!-- تکرار برای سایر قسمت‌ها -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span>قسمت 01 | کیفیت‌ها:</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">1080p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">720p</button>
                            <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400">480p</button>
                        </div>
                    </div>
                </div>
                <!-- تکرار برای سایر قسمت‌ها -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <span class="text-[#6898F8]">دانلود زیرنویس فصل اول</span>
                        <div class="flex gap-2 flex-wrap">
                            <button class="bg-[#336DE0] px-3 py-1 rounded text-sm hover:bg-blue-800">مشاهده لینک های
                                دانلود
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
    </section>
    <!---->

    <!---->
    <section class="container md:px-0 px-5 my-4">
        <!-- بازیگران -->
        <div class="">
            <h3 class="title-sec mb-5">بازیگران سریال</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>

                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300">Lenny Henry</p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p>
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!---->
    <section class="container md:px-0 px-5 my-5">
        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
        <!-- خلاصه داستان -->
        <div class="">
            <h3 class="title-sec mb-5">درباره سریال <?php the_title(); ?></h3>
            <div class="text-gray-300 text-sm leading-relaxed">
               <?php the_excerpt();?>
            </div>
        </div>
        <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
    </section>

    <!-- دیدگاه کاربران -->
    <section class="container md:px-0 px-5 my-4">
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="title-sec mb-5">دیدگاه ها</h3>
                <button class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm py-1 px-3 rounded-lg flex items-center justify-around">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.7598 15H11.2598M15.0098 11.25V18.75M3.75489 15C3.75489 21.2132 8.79168 26.25 15.0049 26.25C17.5504 26.25 26.254 26.25 26.254 26.25C26.254 26.25 24.305 21.5702 25.085 20.001C25.8338 18.4945 26.2549 16.7964 26.2549 15C26.2549 8.7868 21.2181 3.75 15.0049 3.75C8.79168 3.75 3.75489 8.7868 3.75489 15Z"
                              stroke="#131A29" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    ارسال دیدگاه
                </button>
            </div>
            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
//             TODO TEST GITHUB dd
            endif;
            ?>
            <!-- فرم ارسال دیدگاه -->
            <div>
            <textarea placeholder="دیدگاه خود را بنویسید..."
                      class="w-full p-3 bg-bluet-600 rounded-lg text-sm text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                      rows="3"></textarea>
            </div>

            <!-- لیست دیدگاه‌ها -->
            <div class="space-y-4">
                <!-- یک دیدگاه -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gray-600 rounded-full"></div>
                            <span class="text-sm font-bold">کاربر ناشناس</span>
                        </div>
                        <span class="text-xs text-gray-400">۱۴۰۲/۰۷/۰۵</span>
                    </div>
                    <p class="text-sm text-gray-300">داستان خیلی جذاب بود. فقط دوبله کیفیت لازم رو نداشت.</p>
                </div>

                <!-- یک دیدگاه دیگر -->
                <div class="bg-bluet-600 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gray-600 rounded-full"></div>
                            <span class="text-sm font-bold">مهمان</span>
                        </div>
                        <span class="text-xs text-gray-400">۱۴۰۲/۰۷/۱۰</span>
                    </div>
                    <p class="text-sm text-gray-300">واقعا ارزش دیدن داره. لطفا فصل دوم رو هم سریع‌تر بزارید.</p>
                </div>
            </div>
            <div class="flex items-center justify-center" style="background: url('<?php echo IMG_URL . 'linet.png'?>') no-repeat center;">
                <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                    بیشتر</a>
            </div>

        </div>
    </section>
<?php endwhile;
get_template_part('template/irani-series');;
get_footer()
?>
