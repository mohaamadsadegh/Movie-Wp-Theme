<?php use core\Renderer;?>
<!--list move-->
<section class="container md:px-0 px-5">
    <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
    <div class="flex items-start flex-wrap justify-between">
        <div class="">
            <?php $listmoves = new WP_Query(['post_type' => 'movie' , 'posts_per_page' => 4 ,]);
            if ($listmoves->have_posts()) : ?>
                <?php while ($listmoves->have_posts()) : $listmoves->the_post(); ?>
                    <div class="max-w-4xl mx-auto bg-bluet-600 mb-2 rounded-lg overflow-hidden shadow-lg  p-4 space-y-4 md:space-y-0 md:space-x-6">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-1/3 ml-2 h-[325px]">
                                <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                    <?php the_post_thumbnail('medium_large' , ['class' => 'w-full h-full object-cover rounded-lg']); ?>
                                </a>
                            </div>
                            <!-- Info -->
                            <div class="flex-1 flex justify-around">
                                <div class="flex md:mt-0 mt-3">
                                    <div class="pl-3">
                                        <div class="title-box">
                                            <h2 class="text-xl font-bold mb-1">
                                                <?= the_title() ?>
                                            </h2>
                                            <p class="text-sm text-gray-400 mb-2">The Lord of the Rings: The Rings
                                                of Power
                                                2022</p>
                                            <div class="border-white border-1"></div>
                                        </div>

                                        <div class="flex flex-col flex-wrap text-sm text-gray-300 gap-2 mb-4">
                                            <?php Renderer::render_meta(get_the_ID());?>
                                        </div>

                                        <div class="text-sm text-gray-400 mb-4">
                                            بازیگران: Lenny Henry, Markella Kavenagh, Morfydd Clark <br>
                                            کارگردان: Wayne Yip
                                        </div>
                                        <div class="text-sm text-gray-400 line-clamp-2 rounded border-2 border-bluet-700 p-3"><?php the_excerpt(); ?></div>
                                    </div>
                                    <div class="h-auto w-1/6">
                                        <div class="bg-bluet-700 rounded flex items-center flex-col mb-4 p-2">
                                            <span class="text-sm font-Dana">7.2/10</span>
                                            <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded">IMDB</span>
                                        </div>
                                        <div class="bg-bluet-700 rounded flex items-center flex-col p-2">
                                             <span class="text-lg font-semibold">
                                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M17.5 13.6732C16.3225 13.7099 14.5857 14.1993 14.5833 15.5858C14.5808 17.0629 16.0417 17.4999 17.5 17.4999C18.9583 17.4999 20.4167 17.837 20.4167 19.4139C20.4167 20.599 18.9677 21.1188 17.5 21.2908M17.5 13.6732C18.4991 13.6665 19.6875 13.6732 20.4167 13.854M17.5 13.6732L17.5 11.6667M17.5 21.2908C16.3333 21.2908 16.0417 21.328 14.5833 21.1457M17.5 21.2908V23.3333M11.3756 6.76204C12.4306 6.67785 13.4322 6.26298 14.2377 5.57649C16.1176 3.9745 18.8824 3.9745 20.7623 5.57649C21.5678 6.26298 22.5694 6.67785 23.6244 6.76204C26.0864 6.95851 28.0415 8.91355 28.238 11.3756C28.3222 12.4306 28.737 13.4322 29.4235 14.2377C31.0255 16.1176 31.0255 18.8824 29.4235 20.7623C28.737 21.5678 28.3222 22.5694 28.238 23.6244C28.0415 26.0864 26.0864 28.0415 23.6244 28.238C22.5694 28.3222 21.5678 28.737 20.7623 29.4235C18.8824 31.0255 16.1176 31.0255 14.2377 29.4235C13.4322 28.737 12.4306 28.3222 11.3756 28.238C8.91355 28.0415 6.95851 26.0864 6.76204 23.6244C6.67785 22.5694 6.26298 21.5678 5.57649 20.7623C3.9745 18.8824 3.9745 16.1176 5.57649 14.2377C6.26298 13.4322 6.67785 12.4306 6.76204 11.3756C6.95851 8.91355 8.91355 6.95851 11.3756 6.76204Z"
                                                             stroke="#65AA40" stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"/>
                                                            </svg>
                                            </span>
                                            <span class="text-[#65AA40] text-center  font-Danabold text-xs px-2 py-1 rounded">اشـتـراک اختصاصی</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <!-- Buttons -->
                            <div class="flex justify-between items-center mt-4 flex-col md:flex-row">
                                <div>
                                    <button class="bg-bluet-700 px-4 py-2 text-sm rounded hover:bg-blue-700">مشاهده
                                        تریلر
                                        فیلم
                                    </button>
                                    <button class="bg-bluet-700 px-4 py-2 text-sm rounded hover:bg-blue-700"><?php Renderer::video_language(get_the_ID());?></button>
                                    <button class="bg-bluet-700 px-4 py-2 text-sm rounded hover:bg-blue-700">
                                        زیرنویس
                                    </button>

                                </div>
                                <div class="flex gap-2 w-full md:w-max mt-3">
                                    <button class="bg-yellow-500 px-4 py-2 text-sm w-full rounded hover:bg-yellow-600 text-black">
                                        دانلود سریال
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
     <?php get_template_part('template/sidebar')?>
    </div>
    <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
</section>