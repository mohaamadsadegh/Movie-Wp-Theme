<?php
$download_links = get_post_meta(get_the_ID(), '_download_links_by_quality');
?>
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
        <?php // TODO ADD IF FOR REPEATER ?>
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
                        <?php foreach ($download_links[0] as  $download_link){ ?>
                        <a href="<?=$download_link['url'] ?>" class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-400"><?= $download_link['quality']?></a>
                        <?php } ?>
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