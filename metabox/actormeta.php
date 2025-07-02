<?php
namespace metabox;
class actormeta{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_metabox']);
        add_action('save_post', [$this, 'save_actor_role_metabox']);
    }
        public function register_metabox()
    {
        add_meta_box(
            'actor_role_metabox',
            'نقش فرد',
            [$this , 'render_actor_role_metabox'],
            'actor',
            'side',
            'default'
        );
    }

    public function render_actor_role_metabox($post) {
        $value = get_post_meta($post->ID, '_actor_role', true);
        ?>
        <label for="actor_role">نوع نقش:</label>
        <select name="actor_role" id="actor_role" class="postbox">
            <option value="actor" <?php selected($value, 'actor'); ?>>بازیگر</option>
            <option value="director" <?php selected($value, 'director'); ?>>کارگردان</option>
        </select>
        <?php
    }
   public function save_actor_role_metabox($post_id) {
        if (array_key_exists('actor_role', $_POST)) {
            update_post_meta($post_id, '_actor_role', sanitize_text_field($_POST['actor_role']));
        }
    }
}