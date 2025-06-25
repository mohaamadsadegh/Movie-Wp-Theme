<?php

use Core\UserData;

$options = get_option('moves_options'); ?>
<!DOCTYPE html>
<html class="" dir="rtl" lang="fa">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo get_template_directory_uri() . '/style.css' ?>" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() . '/assets/css/swiper.css' ?>" rel="stylesheet"/>
    <link href="<?php echo get_template_directory_uri() . '/assets/css/wc-comma-rtl.css' ?>" rel="stylesheet"/>

    <?php wp_head(); ?>
</head>

<body class="bg-bgc-200 text-white" <?php body_class(); ?>>

<!-- Navbar -->
<nav class="bg-bluet-600 shadow-md border-b-yellow-yellow900 border-b-2">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between ">
        <!-- Right: Logo -->
        <a href="<?php echo home_url(); ?>"
           class="text-2xl font-bold text-yellow-yellow900"><?= $options['title_site'] ?></a>

        <!-- Hamburger Button (Mobile) -->
        <div class="md:hidden">
            <button class="text-white focus:outline-none" id="menu-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
            </button>
        </div>

        <?php
        wp_nav_menu([
            'theme_location' => 'main-menu' ,
            'container' => false ,
            'menu_class' => 'hidden md:flex space-x-6 space-x-reverse text-sm' ,
            'menu_id' => '' ,
            'fallback_cb' => false
        ]);
        ?>

        <!-- Left: Search -->
        <div class="hidden md:flex items-center gap-4">
            <!-- Search -->
            <?php do_shortcode('[search-s]'); ?>
            <!--user-->
            <?php UserData::user_login(); ?>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden px-4 pb-4" id="mobile-menu">
        <?php
        wp_nav_menu([
            'theme_location' => 'main-menu' ,
            'container' => false ,
            'menu_class' => 'space-y-2 text-sm' ,
            'menu_id' => '' ,
            'fallback_cb' => false ,
            'walker' => new class extends Walker_Nav_Menu {
                public function start_el(&$output , $item , $depth = 0 , $args = null , $id = 0)
                {
                    $output .= '<li><a class="block py-1 hover:text-yellow-400" href="' . esc_url($item->url) . '">'
                        . esc_html($item->title) . '</a></li>';
                }
            }
        ]);
        ?>
        <ul>
            <!-- Search -->
            <li><?php do_shortcode('[search-s]'); ?></li>
            <!--user-->
            <li><?php UserData::user_login(); ?></li>
        </ul>
    </div>
</nav>