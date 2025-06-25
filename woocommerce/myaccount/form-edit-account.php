<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

use inc\model\tabels\dashboard;

$db = dashboard::connection();
$db = $db->getdata('photo_myaccount_url');
defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action=""
      method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?> >
    <!--  TODO start -->
    <?php

    $db = dashboard::connection();
    $db = $db->getdata('photo_myaccount_url');
    ?>
    <div class="comma-form-myaccount-photo d-flex justify-content-center py-3 w-100 position-relative">
        <img draggable="false" class="bg-light"
             style="border-radius: 50% ; width:120px ; height: 120px ; object-fit: cover;" src="<?= $db ?>" alt="">
        <svg class="comma-myaccount-pen-edit-photo position-absolute bottom-2" width="24" height="24"
             viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path fill="white"
                  d="M15.4998 5.5L18.3282 8.32843M3 20.9998L3.04745 20.6676C3.21536 19.4922 3.29932 18.9045 3.49029 18.3559C3.65975 17.869 3.89124 17.406 4.17906 16.9783C4.50341 16.4963 4.92319 16.0766 5.76274 15.237L17.4107 3.58902C18.1918 2.80797 19.4581 2.80797 20.2392 3.58902C21.0202 4.37007 21.0202 5.6364 20.2392 6.41745L8.37744 18.2792C7.61579 19.0408 7.23497 19.4216 6.8012 19.7245C6.41618 19.9933 6.00093 20.216 5.56398 20.388C5.07171 20.5818 4.54375 20.6883 3.48793 20.9013L3 20.9998Z"
                  stroke="#131A29" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <!--    <input class="comma-form-myaccount-edit-photo-btn" type="file">-->
    <!--    TODO end-->
    <div>
        <?php do_action('woocommerce_edit_account_form_start'); ?>
        <div class="tab">
            <ul class="tabs">
                <li><a href="#">ویرایش اطلاعات</a></li>
                <li><a href="#">تفییر رمز عبور</a></li>
            </ul> <!-- / tabs -->
            <div class="tab_content">
                <div class="tabs_item">
                    <div class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                        <label for="account_first_name"><?php esc_html_e('First name' , 'woocommerce'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_first_name" id="account_first_name" autocomplete="given-name"
                               value="<?php echo esc_attr($user->first_name); ?>"/>
                    </div>
                    <div class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                        <label for="account_last_name"><?php esc_html_e('Last name' , 'woocommerce'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_last_name" id="account_last_name" autocomplete="family-name"
                               value="<?php echo esc_attr($user->last_name); ?>"/>
                    </div>
                    <div class="clear"></div>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="account_display_name"><?php esc_html_e('Display name' , 'woocommerce'); ?>
                            &nbsp;<span
                                    class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="account_display_name" id="account_display_name"
                               value="<?php echo esc_attr($user->display_name); ?>"/>
                        <span><em><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews' , 'woocommerce'); ?></em></span>
                    </div>
                    <div class="clear"></div>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="account_email"><?php esc_html_e('Email address' , 'woocommerce'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
                               name="account_email" id="account_email" autocomplete="email"
                               value="<?php echo esc_attr($user->user_email); ?>"/>
                    </div>
                </div>

                <div class="tabs_item">
                    <fieldset>
                        <legend><?php esc_html_e('Password change' , 'woocommerce'); ?></legend>

                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)' , 'woocommerce'); ?></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                   name="password_current" id="password_current" autocomplete="off"/>
                        </div>
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)' , 'woocommerce'); ?></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                   name="password_1" id="password_1" autocomplete="off"/>
                        </div>
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password_2"><?php esc_html_e('Confirm new password' , 'woocommerce'); ?></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                                   name="password_2" id="password_2" autocomplete="off"/>
                        </div>
                    </fieldset>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php do_action('woocommerce_edit_account_form'); ?>

        <div class="mt-2">
            <?php wp_nonce_field('save_account_details' , 'save-account-details-nonce'); ?>
            <button type="submit"
                    class="woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                    name="save_account_details"
                    value="<?php esc_attr_e('Save changes' , 'woocommerce'); ?>"><?php esc_html_e('Save changes' , 'woocommerce'); ?></button>
            <input type="hidden" name="action" value="save_account_details"/>
        </div>

        <?php do_action('woocommerce_edit_account_form_end'); ?>
    </div>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>
<style>
    .tabs_item {
        display: none;
        padding: 10px 20px;
        background: #ededed80;
        margin: 15px 0;
        border-radius: 10px;
        border-top: 2px solid var(--bs-red);
    }

    .tabs_item:first-child {
        display: block;
        border-top: 2px solid var(--first-color);
    }

    .tabs_item fieldset legend {
        font-size: 15px;
        font-weight: 700;
    }

    .tabs_item fieldset legend:after {
        content: "";
        display: block;
        width: 30px;
        height: 2px;
        background: var(--first-color);
        border-radius: 10px;
    }
</style>
<script>
    (function ($) {
        $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');

        $('.tab ul.tabs li a').click(function (g) {
            var tab = $(this).closest('.tab'),
                index = $(this).closest('li').index();

            tab.find('ul.tabs > li').removeClass('current');
            $(this).closest('li').addClass('current');

            tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
            tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();

            g.preventDefault();
        });
    })(jQuery);
</script>