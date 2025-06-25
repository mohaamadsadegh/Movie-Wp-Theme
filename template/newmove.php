<?php $options = get_option('moves_options'); ?>
<!--    -->
<section class="new-move py-[40px]">
    <div class="container md:px-0 px-5">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['newmove_title'] ?></h3>
            <div class="flex flex-wrap gap-3 justify-center my-4" id="genreTabs">
                <button data-tab="bio" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    بیوگرافی
                </button>
                <button data-tab="war" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">جنگی
                </button>
                <button data-tab="drama" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    درام
                </button>
                <button data-tab="music" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    موسیقی
                </button>
                <button data-tab="funny" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    ترسناک
                </button>
                <button data-tab="action" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    اکشن
                </button>
                <button data-tab="thriller"
                        class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    هیجانی
                </button>
                <button data-tab="doc" class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                    مستند
                </button>
            </div>
        </div>

        <div class="flex items-center justify-center">
            <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                بیشتر</a>
        </div>
    </div>
</section>