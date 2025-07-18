<?php
// orders.php (if WooCommerce is active)
//if (class_exists('WooCommerce')) {
//  $orders = wc_get_orders(['customer_id' => get_current_user_id()]);
//  echo '<h2 class="text-xl font-bold mb-4">سفارشات من</h2>';
//  if ($orders) {
//    echo '<ul class="space-y-2">';
//    foreach ($orders as $order) {
//      echo '<li class="border p-3 rounded"><strong>سفارش #' . $order->get_id() . '</strong> - ' . wc_price($order->get_total()) . '</li>';
//    }
//    echo '</ul>';
//  } else {
//    echo '<p>سفارشی یافت نشد.</p>';
//  }
//}
