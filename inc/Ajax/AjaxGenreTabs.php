<?php
namespace inc\Ajax;

class AjaxGenreTabs
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_ajax_load_genre_movies', [$this, 'handle_ajax']);
        add_action('wp_ajax_nopriv_load_genre_movies', [$this, 'handle_ajax']);
    }

    public function enqueue_assets()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('ajax-genre-tabs', get_template_directory_uri() . '/assets/js/ajax-genre-tabs.js', ['jquery'], null, true);
        wp_localize_script('ajax-genre-tabs', 'genre_ajax_obj', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('load_genre_movies_nonce'),
        ]);
    }

    public function handle_ajax()
    {
        check_ajax_referer('load_genre_movies_nonce', 'nonce');

        $genre_slug = sanitize_text_field($_POST['genre'] ?? '');

        $query = new \WP_Query([
            'post_type' => 'movie',
            'posts_per_page' => 8,
            'tax_query' => [
                [
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => $genre_slug,
                ],
            ],
        ]);

        ob_start();
        if ($query->have_posts()) {
            echo '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">';
            while ($query->have_posts()) {
                $query->the_post();
                $poster = get_post_meta(get_the_ID(), '_movie_poster', true) ?: get_the_post_thumbnail_url();
                ?>
                <div class="image relative">
                    <img class="rounded-[10px] w-full" src="<?= esc_url($poster) ?>" alt="<?= esc_attr(get_the_title()) ?>">
                    <div class="overlay text-start">
                        <h2 class="text-sm"><?= esc_html(get_the_title()) ?></h2>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<div class="text-white text-center">هیچ فیلمی در این ژانر موجود نیست.</div>';
        }
        wp_reset_postdata();

        wp_send_json_success(ob_get_clean());
    }
}
