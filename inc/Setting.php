<?php
// File: Setting.php
?>
<div class="wrap">
    <h1>تنظیمات قالب</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#general" class="nav-tab nav-tab-active">عمومی</a>
        <a href="#colors" class="nav-tab">رنگ‌ها</a>
        <a href="#images" class="nav-tab">لوگو و تصاویر</a>
        <a href="#categories" class="nav-tab">دسته‌بندی و صفحه</a>
        <a href="#homepage" class="nav-tab">صفحه اصلی</a>
        <a href="#api" class="nav-tab">تنظیمات API</a>
    </h2>

    <form method="post" action="options.php">
        <?php settings_fields('theme_options_group'); ?>
        <?php $name = 'moves_options'; ?>

        <div id="general" class="tab-content active">
            <table class="form-table">
                <tr>
                    <th><label for="title_site">عنوان سایت</label></th>
                    <td><input type="text" name="<?= $name ?>[title_site]" class="regular-text" value="<?= esc_attr($options['title_site'] ?? ' ') ?>" /></td>
                </tr>

                <tr>
                    <th><label for="site_notice">اعلان بالای سایت</label></th>
                    <td><input type="text" name="<?= $name ?>[site_notice]" value="<?= esc_attr($options['site_notice'] ?? '') ?>" class="regular-text" /></td>
                </tr>

                <tr>
                    <th>فعال‌سازی حالت تاریک</th>
                    <td><input type="checkbox" name="<?= $name ?>[dark_mode]" value="1" <?php checked($options['dark_mode'] ?? '', 1); ?> /></td>
                </tr>

                <tr>
                    <th>متن هنگام بارگزاری سایت</th>
                    <td><input type="text" name="<?= $name ?>[text_preloder]" value="<?= esc_attr($options['text_preloder'] ?? '') ?>" class="regular-text" /></td>
                </tr>

                <tr>
                    <th>متن صفحه 404 سایت</th>
                    <td><input type="text" name="<?= $name ?>[text_404]" value="<?= esc_attr($options['text_404'] ?? '') ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th>متن دکمه 404 سایت</th>
                    <td><input type="text" name="<?= $name ?>[text_404_btn]" value="<?= esc_attr($options['text_404_btn'] ?? '') ?>" class="regular-text" /></td>

                    <th>لینک دکمه 404 سایت(درصورت خالی بودن به صفحه اصلی رجوع داده می شود.)</th>
                    <td><input type="url" name="<?= $name ?>[text_404_btn_link]" value="<?= esc_attr($options['text_404_btn_link'] ?? home_url()) ?>" class="regular-text" /></td>
                </tr>
            </table>
        </div>

        <div id="colors" class="tab-content">
            <table class="form-table">
                <tr>
                    <th><label for="primary_color">رنگ اصلی</label></th>
                    <td><input type="color" name="<?= $name ?>[primary_color]" value="<?= esc_attr($options['primary_color'] ?? '#222222') ?>" /></td>
                </tr>
                <tr>
                    <th><label for="secondary_color">رنگ ثانویه</label></th>
                    <td><input type="color" name="<?= $name ?>[secondary_color]" value="<?= esc_attr($options['secondary_color'] ?? '#ffffff') ?>" /></td>
                </tr>
            </table>
        </div>

        <div id="images" class="tab-content">
            <table class="form-table">
                <tr>
                    <th><label for="logo">لوگوی سایت</label></th>
                    <td>
                        <input type="text" id="logo" name="<?= $name ?>[logo]" value="<?= esc_attr($options['logo'] ?? '') ?>" class="regular-text" />
                        <button class="button upload-logo-button">آپلود</button>
                        <div class="preview" style="margin-top:10px;">
                            <?php if (!empty($options['logo'])): ?>
                                <img src="<?= esc_url($options['logo']) ?>" style="max-height:60px; max-width: 60px"  alt=""/>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label for="background_image">تصویر پس‌زمینه</label></th>
                    <td>
                        <input type="text" id="background_image" name="<?= $name ?>[background_image]" value="<?= esc_attr($options['background_image'] ?? '') ?>" class="regular-text" />
                        <button class="button upload-logo-button">آپلود</button>
                    </td>
                </tr>
            </table>
        </div>

        <div id="categories" class="tab-content">
            <table class="form-table">
                <tr>
                    <th><label>دسته‌بندی‌های پیش‌ فرض</label></th>
                    <td>
                        <?php
                        $categories = ['فیلم', 'سریال', 'انیمه']; ?>
                        <?php foreach ($categories as $cat): ?>
                            <label><input type="checkbox" name="<?= $name ?>[default_categories][]" value="<?= $cat ?>" <?php if (!empty($options['default_categories']) && in_array($cat, $options['default_categories'])) echo 'checked'; ?> /> <?= $cat ?></label><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <th><label for="layout">چینش صفحه</label></th>
                    <td>
                        <select name="<?= $name ?>[layout]">
                            <option value="full" <?php selected($options['layout'] ?? '', 'full'); ?>>تمام عرض</option>
                            <option value="boxed" <?php selected($options['layout'] ?? '', 'boxed'); ?>>جعبه‌ای</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <div id="homepage" class="tab-content">
            <h2>تنظیمات صفحه اصلی</h2>

            <!-- بخش فیلم‌های جدید -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>فیلم‌های جدید</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_home_new]" value="1" <?= checked($options['show_home_new'] ?? '', 1, false); ?> />نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[home_new_title]" value="<?= esc_attr($options['home_new_title'] ?? 'جدیدترین فیلم‌ها') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد نمایش</label></th>
                        <td><input type="number" name="<?= $name ?>[home_new_count]" value="<?= esc_attr($options['home_new_count'] ?? 10) ?>" /></td>
                    </tr>
                    <tr>
                        <th><label>مرتب‌سازی</label></th>
                        <td>
                            <select name="<?= $name ?>[home_sort]">
                                <option value="date" <?= selected($options['home_sort'] ?? '', 'date') ?>>تاریخ</option>
                                <option value="rating" <?= selected($options['home_sort'] ?? '', 'rating') ?>>امتیاز IMDb</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label>رنگ عنوان</label></th>
                        <td><input type="color" name="<?= $name ?>[home_title_color]" value="<?= esc_attr($options['home_title_color'] ?? '#ffffff') ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش اسلایدر -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>اسلایدر بالای صفحه</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_slider]" value="1" <?= checked($options['show_slider'] ?? '', 1, false); ?> />
                    نمایش اسلایدر
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان اسلایدر</label></th>
                        <td><input type="text" name="<?= $name ?>[slider_title]" value="<?= esc_attr($options['slider_title'] ?? 'پیشنهاد ویژه') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>شناسه پست‌های اسلایدر (با کاما)</label></th>
                        <td><input type="text" name="<?= $name ?>[slider_posts]" value="<?= esc_attr($options['slider_posts'] ?? '') ?>" class="regular-text" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش سریال های ایرانی -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>سریال های ایرانی (سکشن اول)</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_irani_series]" value="1" <?= checked($options['show_irani_series'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[irani_series_title]" value="<?= esc_attr($options['irani_series_title'] ?? 'سریال های ایرانی به روز شده') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[irani_series_count]" value="<?= esc_attr($options['irani_series_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش سریال های خارجی -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>سریال های خارجی (سکشن دوم)</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_foreign_series]" value="1" <?= checked($options['show_foreign_series'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[foreign_series_title]" value="<?= esc_attr($options['foreign_series_title'] ?? 'سریال های خارجی به روز شده') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[foreign_series_count]" value="<?= esc_attr($options['foreign_series_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش فیلم‌های محبوب -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>فیلم‌های محبوب</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_popular]" value="1" <?= checked($options['show_popular'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[popular_title]" value="<?= esc_attr($options['popular_title'] ?? 'محبوب‌ترین‌ها') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[popular_count]" value="<?= esc_attr($options['popular_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>


            <!-- بخش فیلم‌های محبوب -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>فیلم های جدید</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_popular]" value="1" <?= checked($options['show_popular'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[newmove_title]" value="<?= esc_attr($options['newmove_title'] ?? 'فیلم های جدید') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[popular_count]" value="<?= esc_attr($options['popular_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش انیمیشن محبوب -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>انمیشن ها</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_anime]" value="1" <?= checked($options['show_anime'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[anime_title]" value="<?= esc_attr($options['anime_title'] ?? 'انمیشن ها') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[anime_count]" value="<?= esc_attr($options['anime_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش فیلم های برتر -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>فیلم های برتر</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[top_movie]" value="1" <?= checked($options['top_movie'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[top_movie_title]" value="<?= esc_attr($options['top_movie_title'] ?? 'فیلم های برتر') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[popular_count]" value="<?= esc_attr($options['top_movie_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش بازیگران ایرانی -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>بازیگران ایرانی</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[irani_popular]" value="1" <?= checked($options['irani_popular'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[irani_title]" value="<?= esc_attr($options['irani_title'] ?? 'بازیگران ایرانی') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[irani_count]" value="<?= esc_attr($options['irani_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش بازیگران خارجی -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>بازیگران خارجی</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[global_popular]" value="1" <?= checked($options['global_popular'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[global_title]" value="<?= esc_attr($options['global_title'] ?? 'بازیگران خارجی') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[global_count]" value="<?= esc_attr($options['global_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>

            <!-- بخش مقالات -->
            <fieldset style="border:1px solid #ccc;padding:15px;margin-bottom:20px;">
                <legend><strong>بخش مقالات</strong></legend>
                <label>
                    <input type="checkbox" name="<?= $name ?>[show_blog]" value="1" <?= checked($options['show_blog'] ?? '', 1, false); ?> />
                    نمایش این بخش
                </label>
                <table class="form-table">
                    <tr>
                        <th><label>عنوان بخش</label></th>
                        <td><input type="text" name="<?= $name ?>[blog_title]" value="<?= esc_attr($options['blog_title'] ?? 'اخبار روز هنرمندان') ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label>تعداد آیتم</label></th>
                        <td><input type="number" name="<?= $name ?>[blog_count]" value="<?= esc_attr($options['blog_count'] ?? 8) ?>" /></td>
                    </tr>
                </table>
            </fieldset>
        </div>

        <!--API-->
        <div id="api" class="tab-content">
            <table class="form-table">
                <tr>
                    <th><label for="omdb_api_key">کلید API برای OMDb</label></th>
                    <td><input type="text" name="<?= $name ?>[omdb_api_key]" value="<?= esc_attr($options['omdb_api_key'] ?? '') ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="tmdb_api_key">کلید API برای TMDb</label></th>
                    <td><input type="text" name="<?= $name ?>[tmdb_api_key]" value="<?= esc_attr($options['tmdb_api_key'] ?? '') ?>" class="regular-text" /></td>
                </tr>
            </table>
        </div>

        <!-- footer -->
        <div id="footer" class="tab-content">
            <table class="form-table">
                <tr>

                </tr>
                <tr>

                </tr>
            </table>
        </div>
        <?php submit_button(); ?>
    </form>
</div>
<style>
    .tab-content { display: none; }
    .tab-content.active { display: block; }
</style>


<script>
    jQuery(document).ready(function($) {
        $('.nav-tab').click(function(e) {
            e.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');

            var tabID = $(this).attr('href');
            $('.tab-content').removeClass('active');
            $(tabID).addClass('active');
        });

        $('.upload-logo-button').click(function(e) {
            e.preventDefault();
            let button = $(this);
            let input = button.prev();
            let custom_uploader = wp.media({
                title: 'انتخاب لوگو',
                button: { text: 'استفاده از این تصویر' },
                multiple: false
            }).on('select', function () {
                let attachment = custom_uploader.state().get('selection').first().toJSON();
                input.val(attachment.url);
                button.next('.preview').html('<img src="'+attachment.url+'" style="max-height:60px; max-width: 60px;" />');
            }).open();
        });
    });
</script>
