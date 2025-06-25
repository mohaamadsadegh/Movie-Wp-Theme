<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>
<div class="container-md d-flex justify-content-around my-5">

    <?php
    do_action('woocommerce_account_navigation'); ?>

    <div class="woocommerce-MyAccount-content col-9 px-1">
        <div class="row justify-content-between woocommerce_account_dashboard_customized-section1">
            <div class="col-4">
                <div class="dashboard-order">
                    <div class="d-flex">
                        <img alt="" src="<?= COMMA_THEME_ASSETS . '/image/wc/dashboard/frame2.svg' ?>">
                        <div>
                            <h5>سفارش ها</h5>
                            <p>1402</p>
                        </div>
                    </div>
                    <div class="dashboard-order-num"><span>1</span></div>
                </div>
            </div>
            <div class="col-4">
                <div class="dashboard-order">
                    <div class="d-flex">
                        <img alt="" src="<?= COMMA_THEME_ASSETS . '/image/wc/dashboard/cart.svg' ?>">
                        <div>
                            <h5>سفارش ها</h5>
                            <p>1402</p>
                        </div>
                    </div>
                    <div class="dashboard-order-num"><span>1</span></div>
                </div>
            </div>
            <div class="col-4">
                <div class="dashboard-order">
                    <div class="d-flex">
                        <img alt="" src="<?= COMMA_THEME_ASSETS . '/image/wc/dashboard/cart.svg' ?>">
                        <div>
                            <h5>سفارش ها</h5>
                            <p>1402</p>
                        </div>
                    </div>
                    <div class="dashboard-order-num"><span>1</span></div>
                </div>
            </div>
        </div>
        <div class="woocommerce-content-style p-3">

            <?php
            /**
             * My Account content.
             *
             * @since 2.6.0
             */
            do_action('woocommerce_account_content');
            ?>
        </div>
    </div>
</div>