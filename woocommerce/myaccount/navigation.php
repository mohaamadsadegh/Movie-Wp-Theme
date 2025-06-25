<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');

use inc\model\tabels\dashboard;

$db = dashboard::connection();
$db = $db->getdata('photo_myaccount_url');
?>

<nav class="woocommerce-MyAccount-navigation text-center col-3 px-4">
    <div class="d-flex justify-content-center flex-column align-items-center py-5 w-100 profile-account">
        <div class="position-relative comma-form-myaccount-photo">
            <img class="bg-light" style="border-radius: 22px ; width:116px ; height: 116px ; object-fit: cover;"
                 src="<?= $db ?>" alt="">
            <a class="edit-profile position-absolute start-0">
                <img class="comma-myaccount-pen-edit-photo" alt=""
                     src="<?= COMMA_THEME_ASSETS . 'image/wc/dashboard/pen.svg' ?>">
            </a>
            <input class="comma-form-myaccount-edit-photo-btn" type="file">

        </div>
        <div class="mt-3">
            <?php if (is_user_logged_in()) {
                $current_user = get_userdata(get_current_user_id());
                ?>
                <p class="fw-bold"><?= $current_user->first_name . ' ' . $current_user->last_name; ?> </p>
                <p><?= $current_user->display_name; ?> </p>
                <p><?= $current_user->user_email; ?>  </p>
            <?php } else {
                return;
            } ?>
        </div>
    </div>
    <ul>
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
                   class="my-2 py-3 d-block"><?php echo esc_html($label); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<script>
    //$('.comma-myaccount-pen-edit-photo').click(function () {
    //    $(".comma-form-myaccount-edit-photo-btn").click();
    //});
    //
    //$(".comma-form-myaccount-edit-photo-btn").change(function () {
    //    var formData = new FormData();
    //    formData.append("file", $(this)[0].files[0]);
    //    formData.append("namedataindb", 'photo_myaccount_url');
    //    formData.append("action", "sendwidgetdata");
    //    $.ajax({
    //        url: '<?php //= admin_url('admin-ajax.php')?>//',
    //        type: 'POST',
    //        data: formData,
    //        contentType: false,
    //        processData: false,
    //        success: function (response) {
    //            alert('پرفایل شما با موفقیت تقییر یافت.');
    //            $(".comma-form-myaccount-photo .bg-light").attr("src", response);
    //        }
    //    });
    //});
</script>
<?php do_action('woocommerce_after_account_navigation'); ?>
