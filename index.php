<?php
$options = get_option('moves_options');
get_header();

//hero sec
get_template_part('template/hero-sec' , 'hero');

//filter
get_template_part('template/filter' , 'filter');

//irani series
get_template_part('template/irani-series' , 'irani-series');

//foreign series
get_template_part('template/foreign-series' , 'foreign-series');

//new moves
get_template_part('template/newmove' , 'newmove');

//anime
get_template_part('template/anime' , 'anime');

// top-move
get_template_part('template/top-move' , 'top-move');

// actor
get_template_part('template/actor' , 'actor');

// listmove
get_template_part('template/listmove' , 'listmove');

// blog
get_template_part('template/blog' , 'blog');

get_footer();