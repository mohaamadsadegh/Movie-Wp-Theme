<?php
namespace inc\metabox;

class seriesmeta {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'register_metabox']);
        add_action('save_post', [$this, 'save_metabox']);

        add_action('admin_footer', [$this, 'admin_scripts']);
    }

    public function register_metabox() {
        add_meta_box('series_meta_box', 'اطلاعات سریال', [$this, 'render_metabox'], 'series', 'normal', 'high');
    }

    public function render_metabox($post) {
        $selected_day = get_post_meta($post->ID, '_air_day', true);
        $selected_time = get_post_meta($post->ID, '_air_time', true);
        $episode = get_post_meta($post->ID, '_episode', true);
        $status = get_post_meta($post->ID, '_series_status', true);

        $days = ['شنبه', 'یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];
        $statuses = ['ongoing' => 'در حال پخش', 'ended' => 'تمام شده', 'paused' => 'در حال توقف'];

        ?>

        <div class="series-meta-tabs">
            <ul class="tabss">
                <li class="active"><a href="#tab-air">زمان پخش</a></li>
                <li><a href="#tab-episode">قسمت فعلی</a></li>
                <li><a href="#tab-status">وضعیت پخش</a></li>
            </ul>

            <div class="tab-contentt actived" id="tab-air">
                <label for="air_day">روز پخش:</label>
                <select name="air_day" id="air_day" class="widefat">
                    <option value="">انتخاب کنید</option>
                    <?php foreach ($days as $day): ?>
                        <option value="<?= esc_attr($day); ?>" <?= selected($selected_day, $day, false); ?>><?= esc_html($day); ?></option>
                    <?php endforeach; ?>
                </select>

                <br><br>
                <label for="air_time">ساعت پخش (مثلاً 22:00):</label>
                <input type="text" name="air_time" id="air_time" class="widefat" value="<?= esc_attr($selected_time); ?>">
            </div>

            <div class="tab-contentt" id="tab-episode">
                <label for="episode">شماره قسمت فعلی:</label>
                <input type="number" name="episode" id="episode" class="widefat" value="<?= esc_attr($episode); ?>">
            </div>

            <div class="tab-contentt" id="tab-status">
                <label for="series_status">وضعیت پخش:</label>
                <select name="series_status" id="series_status" class="widefat">
                    <option value="">انتخاب کنید</option>
                    <?php foreach ($statuses as $key => $label): ?>
                        <option value="<?= esc_attr($key); ?>" <?= selected($status, $key, false); ?>><?= esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <?php
    }

    public function save_metabox($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['air_day'])) {
            update_post_meta($post_id, '_air_day', sanitize_text_field($_POST['air_day']));
        }

        if (isset($_POST['air_time'])) {
            update_post_meta($post_id, '_air_time', sanitize_text_field($_POST['air_time']));
        }

        if (isset($_POST['episode'])) {
            update_post_meta($post_id, '_episode', intval($_POST['episode']));
        }

        if (isset($_POST['series_status'])) {
            update_post_meta($post_id, '_series_status', sanitize_text_field($_POST['series_status']));
        }
    }
    public function admin_scripts()
    {
        ?>

        <script>
            jQuery(document).ready(function ($) {
                $('.series-meta-tabs .tabss li a').on('click', function (e) {
                    e.preventDefault();
                    var tabId = $(this).attr('href');

                    $(this).parent().addClass('actived').siblings().removeClass('actived');
                    $(tabId).addClass('actived').siblings('.tab-contentt').removeClass('actived');
                });
            });
        </script>
        <style>
            .series-meta-tabs .tabss {
                display: flex;
                list-style: none;
                margin-bottom: 1em;
                padding: 0;
            }
            .series-meta-tabs .tabss li {
                margin-left: 10px;
            }
            .series-meta-tabs .tabss li a {
                display: block;
                padding: 5px 10px;
                background: #f1f1f1;
                border-radius: 4px;
                text-decoration: none;
            }
            .series-meta-tabs .tabss li.actived a {
                background: #0073aa;
                color: #fff;
            }
            .series-meta-tabs .tab-contentt {
                display: none;
                background: #fafafa;
                padding: 10px;
                border: 1px solid #ddd;
            }
            .series-meta-tabs .tab-contentt.actived {
                display: block;
            }
        </style>
        <?php
    }
}
