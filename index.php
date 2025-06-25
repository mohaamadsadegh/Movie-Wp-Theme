<?php
$options = get_option('moves_options');
get_header();

//hero sec

get_template_part('template/hero-sec' , 'hero');

//filter
get_template_part('template/filter');

//irani series
get_template_part('template/irani-series');

//foreign series
get_template_part('template/foreign-series');

//new moves
get_template_part('template/newmove');

//anime
get_template_part('template/anime');

// top-move
get_template_part('template/top-move');

// actor
get_template_part('template/actor');

// listmove
get_template_part('template/listmove');

// blog
get_template_part('template/blog');

get_footer();