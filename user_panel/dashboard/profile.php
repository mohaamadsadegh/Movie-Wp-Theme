<?php
// profile.php
$current_user = wp_get_current_user();
$avatar = get_user_meta($current_user->ID, 'custom_avatar', true);
?>
<div>
    <h2 class="text-xl font-bold mb-4">پروفایل</h2>
    <p>نام کاربری: <strong><?php echo esc_html($current_user->user_login); ?></strong></p>
    <p>ایمیل: <strong><?php echo esc_html($current_user->user_email); ?></strong></p>
    <img src="<?php echo $avatar ?: get_avatar_url($current_user->ID); ?>" class="w-24 h-24 mt-4 rounded-full" />
</div>
