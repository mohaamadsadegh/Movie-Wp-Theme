<?php
namespace metabox;

class VideoInfo
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_metabox']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('admin_footer', [$this, 'admin_scripts']);
        if (is_admin()) {
            add_action('wp_ajax_fetch_movie_data', [$this, 'fetch_imdb_data']);
        }
    }

    public function register_metabox()
    {
        add_meta_box(
            'video_info_metabox',
            'اطلاعات ویدیو',
            [$this, 'render_metabox'],
            ['movie', 'series'],
            'normal',
            'high'
        );
    }

    public function render_metabox($post)
    {
        $meta = [
            'language'      => get_post_meta($post->ID, '_video_language', true),
            'release_date'  => get_post_meta($post->ID, '_video_release_date', true),
            'duration'      => get_post_meta($post->ID, '_video_duration', true),
            'summary'       => get_post_meta($post->ID, '_video_summary', true),
            'imdb_id'       => get_post_meta($post->ID, '_video_imdb_id', true),
            'poster'        => get_post_meta($post->ID, '_movie_poster', true),
            'trailer'       => get_post_meta($post->ID, '_movie_trailer', true),
            'download_links'=> get_post_meta($post->ID, '_download_links_by_quality', true),
            ''
        ];

        wp_nonce_field('save_video_info_metabox', 'video_info_nonce');

        // تب‌ها
        ?>
        <div class="video-tabs">
            <ul class="tabs">
                <li class="active" data-tab="imdb">اطلاعات IMDb</li>
                <li data-tab="general">اطلاعات عمومی</li>
                <li data-tab="links">لینک‌های دانلود</li>
                <li data-tab="poster">پوستر و تریلر</li>
                <li data-tab="fomentation">عوامل سازنده</li>
            </ul>

            <div class="tab-content" id="tab-general">
                <label>زبان:</label>
                <select name="video_language">
                    <option value="">-- انتخاب کنید --</option>
                    <?php
                    foreach ([
                        'fa' => 'فارسی', 'en' => 'انگلیسی',
                        'dub-fa' => 'دوبله فارسی', 'sub-fa' => 'زیرنویس چسبیده', 'multi' => 'چندزبانه'
                    ] as $key => $label) {
                        $selected = selected($meta['language'], $key, false);
                        echo "<option value='$key' $selected>$label</option>";
                    }
                    ?>
                </select>

                <label>تاریخ انتشار:</label>
                <input type="date" name="video_release_date" value="<?php echo esc_attr($meta['release_date']); ?>" />

                <label>مدت زمان:</label>
                <input type="text" name="video_duration" value="<?php echo esc_attr($meta['duration']); ?>" placeholder="مثلاً 120 دقیقه" />

                <label>خلاصه داستان:</label>
                <textarea name="video_summary" rows="5" style="width:100%;"><?php echo esc_textarea($meta['summary']); ?></textarea>
            </div>

            <div class="tab-content" id="tab-links">
                <div id="download-links-wrapper">
                    <?php
                    $qualities = ['1080p', '720p', '480p', '360p'];
                    if (!empty($meta['download_links'])) {
                        foreach ($meta['download_links'] as $index => $item) {
                            echo '<div class="download-link-item">';
                            echo '<select name="video_download_links[' . $index . '][quality]">';
                            foreach ($qualities as $q) {
                                $selected = selected($item['quality'], $q, false);
                                echo "<option value='$q' $selected>$q</option>";
                            }
                            echo '</select>';
                            echo '<input type="url" name="video_download_links[' . $index . '][url]" value="' . esc_url($item['url']) . '" style="width: 60%;" />';
                            echo '<button type="button" class="remove-link">حذف</button>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
                <button type="button" id="add-download-link" class="button button-primary">+ افزودن لینک</button>
            </div>

            <div class="tab-content" id="tab-poster">
                <label>آدرس پوستر:</label>
                <input type="text" name="movie_poster" id="movie_poster" class="widefat" value="<?php echo esc_attr($meta['poster']); ?>" />
                <button type="button" class="button upload-movie-poster">آپلود پوستر</button>
                <div id="movie-poster-preview"><?php if ($meta['poster']) echo '<img src="' . esc_url($meta['poster']) . '" style="max-width:100%;">'; ?></div>
                <hr>
                <label>آدرس تریلر:</label>
                <input type="text" name="movie_trailer" id="movie_trailer" class="widefat" value="<?php echo esc_attr($meta['trailer']); ?>" />
            </div>

            <div class="tab-content active" id="tab-imdb">
                <p>دریافت خودکار اطلاعات با API</p>
                <input type="text" id="video_title_search" placeholder="نام فیلم (مثلاً Inception)" />
                <button type="button" id="fetch-by-title" class="button">دریافت با نام فیلم</button>

                <input type="text" name="video_imdb_id" id="video_imdb_id" value="<?php echo esc_attr($meta['imdb_id']); ?>" placeholder="مثلاً tt1234567" />
                <button type="button" id="fetch-by-id" class="button">دریافت با IMDb ID</button>
            </div>

            <div class="tab-content" id="tab-fomentation">
            <?php
        $selected_actors = get_post_meta($post->ID, '_movie_actors', true) ?: [];
        $selected_director = get_post_meta($post->ID, '_movie_director', true);

        $persons = get_posts([
            'post_type' => 'actor',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ]);
        ?>
        <p>از طربق پست تایپ بازیگران می توانید بازیگران را اضافه یا ویرایش کنید</p>
        <label style="margin-bottom: 10px;display: block"><strong>بازیگران (قابل انتخاب چندتایی):</strong></label>
        <select name="movie_actors[]" multiple style="width:100%;height:140px;">
        <option value="">-- انتخاب کنید --</option>
            <?php foreach ($persons as $person): ?>
                <option value="<?= esc_attr($person->ID); ?>" <?= in_array($person->ID, (array) $selected_actors) ? 'selected' : ''; ?>>
                    <?= esc_html($person->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>
        <label><strong>کارگردان:</strong></label>
        <select name="movie_director" style="width:100%;">
            <option value="">-- انتخاب کنید --</option>
            <?php foreach ($persons as $person): ?>
                <option value="<?= esc_attr($person->ID); ?>" <?= selected($selected_director, $person->ID, false); ?>>
                    <?= esc_html($person->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>
        <?php
    }

    public function save_metabox($post_id)
    {
        if (!isset($_POST['video_info_nonce']) || !wp_verify_nonce($_POST['video_info_nonce'], 'save_video_info_metabox')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $fields = [
            '_video_language'     => sanitize_text_field($_POST['video_language'] ?? ''),
            '_video_release_date' => sanitize_text_field($_POST['video_release_date'] ?? ''),
            '_video_duration'     => sanitize_text_field($_POST['video_duration'] ?? ''),
            '_video_summary'      => sanitize_textarea_field($_POST['video_summary'] ?? ''),
            '_video_imdb_id'      => sanitize_text_field($_POST['video_imdb_id'] ?? ''),
            '_movie_poster'       => esc_url_raw($_POST['movie_poster'] ?? ''),
            '_movie_trailer'      => esc_url_raw($_POST['movie_trailer'] ?? '')
        ];

        foreach ($fields as $key => $value) {
            update_post_meta($post_id, $key, $value);
        }
        // بازیگران
         if (isset($_POST['movie_actors'])) {
        $actors = array_map('intval', $_POST['movie_actors']);
        update_post_meta($post_id, '_movie_actors', $actors);
        } else {
        delete_post_meta($post_id, '_movie_actors');
        }

    // کارگردان
        if (isset($_POST['movie_director'])) {
        $director = intval($_POST['movie_director']);
        update_post_meta($post_id, '_movie_director', $director);
        }
            // دانلود لینک‌ها
        $submitted_links = $_POST['video_download_links'] ?? [];
        $cleaned = [];
        foreach ($submitted_links as $item) {
            if (!empty($item['quality']) && !empty($item['url'])) {
                $cleaned[] = [
                    'quality' => sanitize_text_field($item['quality']),
                    'url'     => esc_url_raw($item['url']),
                ];
            }
        }
        update_post_meta($post_id, '_download_links_by_quality', $cleaned);
    }

    public function fetch_imdb_data()
    {
        $options = get_option('moves_options');
        $api_key = $options['omdb_api_key'] ?? '';
        $imdb_id = sanitize_text_field($_GET['imdb_id'] ?? '');
        $title = sanitize_text_field($_GET['title'] ?? '');

        if (!$api_key) wp_send_json(['success' => false, 'message' => 'کلید API تنظیم نشده است.']);

        $url = $imdb_id ? "https://www.omdbapi.com/?i=" . urlencode($imdb_id) . "&apikey=$api_key&plot=full"
                        : "https://www.omdbapi.com/?t=" . urlencode($title) . "&apikey=$api_key&plot=full";

        $response = wp_remote_get($url);
        if (is_wp_error($response)) wp_send_json(['success' => false, 'message' => 'خطا در ارتباط با OMDb API.']);

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($body['Title'])) {
            wp_send_json([
                'success'  => true,
                'title'    => $body['Title'],
                'plot'     => $body['Plot'],
                'runtime'  => $body['Runtime'],
                'released' => date('Y-m-d', strtotime($body['Released'] ?? '')),
                'language' => $body['Language'],
                'imdb_id'  => $body['imdbID'],
            ]);
        } else {
            wp_send_json(['success' => false, 'message' => 'فیلمی با این اطلاعات یافت نشد.']);
        }
    }

    public function admin_scripts()
    {
        wp_enqueue_media();
        ?>

        <style>
            .tabs { display: flex; gap: 10px; margin-bottom: 10px; }
            .tabs li { background: #eee; padding: 5px 10px; cursor: pointer; }
            .tabs li.active { background: #0073aa; color: white; }
            .tab-content { display: none; }
            .tab-content.active { display: block; padding: 10px; background: #f9f9f9; border: 1px solid #ccc; }
            .download-link-item { margin-bottom: 10px; }
            .remove-link { background: darkred; color: white; padding: 3px 10px; }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // تب‌ها
                document.querySelectorAll('.tabs li').forEach(tab => {
                    tab.addEventListener('click', function () {
                        document.querySelectorAll('.tabs li').forEach(t => t.classList.remove('active'));
                        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        document.getElementById('tab-' + this.dataset.tab).classList.add('active');
                    });
                });

                // دانلود لینک‌ها
                const wrapper = document.getElementById('download-links-wrapper');
                const addBtn = document.getElementById('add-download-link');
                const qualities = ['1080p', '720p', '480p', '360p'];
                addBtn.addEventListener('click', function () {
                    const count = wrapper.querySelectorAll('.download-link-item').length;
                    const div = document.createElement('div');
                    div.className = 'download-link-item';
                    let opts = qualities.map(q => `<option value="${q}">${q}</option>`).join('');
                    div.innerHTML = `<select name="video_download_links[${count}][quality]">${opts}</select>
                                     <input type="url" name="video_download_links[${count}][url]" placeholder="لینک دانلود" style="width: 60%;" />
                                     <button type="button" class="remove-link">حذف</button>`;
                    wrapper.appendChild(div);
                });
                wrapper.addEventListener('click', e => {
                    if (e.target.classList.contains('remove-link')) {
                        e.target.parentElement.remove();
                    }
                });

                // IMDb
                const fetchMovieData = (query, by = 'id') => {
                    fetch(ajaxurl + '?action=fetch_movie_data&' + (by === 'id' ? 'imdb_id=' : 'title=') + encodeURIComponent(query))
                        .then(res => res.json()).then(data => {
                        if (data.success) {
                            document.querySelector('input[name="post_title"]').value = data.title;
                            document.querySelector('textarea[name="video_summary"]').value = data.plot;
                            document.querySelector('input[name="video_duration"]').value = data.runtime;
                            document.querySelector('input[name="video_release_date"]').value = data.released;
                            document.querySelector('input[name="video_imdb_id"]').value = data.imdb_id;
                            const langSelect = document.querySelector('select[name="video_language"]');
                            for (const opt of langSelect.options) {
                                if (data.language.includes(opt.text)) {
                                    opt.selected = true; break;
                                }
                            }
                        } else alert(data.message || 'خطایی رخ داد.');
                    });
                };
                document.getElementById('fetch-by-title')?.addEventListener('click', () => {
                    const title = document.getElementById('video_title_search').value;
                    if (!title) return alert('نام فیلم را وارد کنید');
                    fetchMovieData(title, 'title');
                });
                document.getElementById('fetch-by-id')?.addEventListener('click', () => {
                    const imdbId = document.getElementById('video_imdb_id').value;
                    if (!imdbId) return alert('IMDb ID را وارد کنید');
                    fetchMovieData(imdbId, 'id');
                });
            });
            let mediaUploader;
            document.querySelector('.upload-movie-poster')?.addEventListener('click', function (e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media({
                    title: 'انتخاب یا آپلود پوستر',
                    button: { text: 'استفاده از این تصویر' },
                    multiple: false
                });

                mediaUploader.on('select', function () {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    document.getElementById('movie_poster').value = attachment.url;
                    document.getElementById('movie-poster-preview').innerHTML = `<img src="${attachment.url}" style="max-width:100%;" />`;
                });

                mediaUploader.open();
            });
        </script>
        <?php
    }
}
