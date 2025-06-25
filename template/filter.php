<!--filter-->
<section class="container md:px-0 px-5 my-5">
    <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
    <form id="movie-filter-form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="GET">
        <div class="bg-bluet-600 p-4 rounded-xl shadow-md flex flex-col md:flex-row flex-wrap items-center gap-3 justify-between border-x-2 border-x-yellow-yellow900">
            <!-- فیلتر: فیلم و سریال -->
            <select name="type" id="type" aria-label="نوع محتوا"
                    class="bg-bluet-700 md:w-[14%] w-full text-white px-4 py-2 rounded-md">
                <option value="">فیلم و سریال</option>
                <option value="movie">فیلم</option>
                <option value="series">سریال</option>
            </select>

            <!-- ژانر -->
            <select name="genre" id="genre" aria-label="ژانر"
                    class="bg-bluet-700 md:w-[14%] w-full text-white px-4 py-2 rounded-md">
                <option value="">ژانر</option>
                <option value="action">اکشن</option>
                <option value="comedy">کمدی</option>
                <option value="drama">درام</option>
            </select>

            <!-- از سال -->
            <select name="year_from" id="year_from" aria-label="از سال"
                    class="bg-bluet-700 md:w-[14%] w-full text-white px-4 py-2 rounded-md">
                <option value="">از سال</option>
                <option value="2000">2000</option>
                <option value="2010">2010</option>
                <option value="2020">2020</option>
            </select>

            <!-- تا سال -->
            <select name="year_to" id="year_to" aria-label="تا سال"
                    class="bg-bluet-700 md:w-[14%] w-full text-white px-4 py-2 rounded-md">
                <option value="">تا سال</option>
                <option value="2010">2010</option>
                <option value="2020">2020</option>
                <option value="2025">2025</option>
            </select>

            <!-- امتیاز -->
            <select name="rating" id="rating" aria-label="امتیاز"
                    class="bg-bluet-700 md:w-[13%] w-full text-white px-4 py-2 rounded-md">
                <option value="">امتیاز</option>
                <option value="9">+9</option>
                <option value="8">+8</option>
                <option value="7">+7</option>
            </select>

            <!-- مرتب‌سازی -->
            <select name="order" id="order" aria-label="مرتب‌سازی"
                    class="bg-bluet-700 md:w-[13%] w-full text-white px-4 py-2 rounded-md">
                <option value="">به ترتیب</option>
                <option value="newest">جدیدترین</option>
                <option value="popular">محبوب‌ترین</option>
            </select>

            <!-- دکمه جستجو -->
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 hover:text-gray-50 w-full md:w-max text-black font-semibold px-4 py-2 rounded-md">
                جستجوی پیشرفته
            </button>

            <input type="hidden" name="action" value="movie-filter-form">
        </div>
    </form>

    <div id="movie-results" class="mt-6">
        <!-- نتایج AJAX اینجا جایگزین می‌شود -->
    </div>
    <img alt="" class="my-4" src="<?php echo IMG_URL . 'Line.svg' ?>">
</section>