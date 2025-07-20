<?php

namespace inc\Ajax;

class CommentHandler {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_ajax_comment', [$this, 'handle_ajax']);
        add_action('wp_ajax_nopriv_ajax_comment', [$this, 'handle_ajax']);
    }

    public function enqueue_scripts() {
        if (is_singular() && comments_open()) {
            wp_enqueue_script('comment-ajax', IMG_URL_js . 'script.js', [], null, true);
            wp_localize_script('comment-ajax', 'CommentAjax', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);
            wp_enqueue_script('comment-reply');
        }
    }

    public static function handle_ajax() {
        $errors = [];

        $post_id = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
        if (!$post_id || !get_post($post_id)) {
            $errors[] = 'پست معتبر نیست.';
        }

        $author = sanitize_text_field($_POST['author'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $comment = sanitize_textarea_field($_POST['comment'] ?? '');

        if (empty($author)) $errors[] = 'نام الزامی است.';
        if (!is_email($email)) $errors[] = 'ایمیل معتبر نیست.';
        if (empty($comment)) $errors[] = 'متن دیدگاه نباید خالی باشد.';

        if (!empty($errors)) {
            wp_send_json_error(['messages' => $errors]);
        }

        $commentdata = [
            'comment_post_ID'      => $post_id,
            'comment_author'       => $author,
            'comment_author_email' => $email,
            'comment_content'      => $comment,
            'comment_type'         => '',
            'comment_parent'       => (int) ($_POST['comment_parent'] ?? 0),
            'user_id'              => get_current_user_id(),
        ];

        $comment_id = wp_new_comment($commentdata);

        if (!$comment_id) {
            wp_send_json_error(['messages' => ['خطا در ثبت دیدگاه.']]);
        }

        ob_start();
        $comment = get_comment($comment_id);
        ?>
        <div class="bg-bluet-600 p-4 rounded-lg fade-in">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <?php echo get_avatar($comment, 40, '', '', ['class' => 'rounded-full']); ?>
                    <span class="text-sm font-bold"><?php echo get_comment_author($comment); ?></span>
                </div>
                <span class="text-xs text-gray-400"><?php echo \core\jdate('Y/m/d' , strtotime($comment->comment_date)); ?></span>
            </div>
            <p class="text-sm text-gray-300"><?php echo esc_html($comment->comment_content); ?></p>
        </div>
        <?php
        $html = ob_get_clean();

        wp_send_json_success(['html' => $html]);
    }
    public static  function get_comments() {}
}
