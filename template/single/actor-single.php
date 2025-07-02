<?php
$actors = get_post_meta(get_the_ID() , '_movie_actors' , true);
$director = get_post_meta(get_the_ID() , '_movie_director' , true);
?>
<section class="container md:px-0 px-5 my-4">
    <!-- بازیگران -->
    <div class="">
        <h3 class="title-sec mb-5">بازیگران سریال</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <?php $actor = new WP_Query(['post_type' => 'actor' , 'orderby' => 'title']);
            if ($actor->have_posts()) : ?>
                <?php while ($actor->have_posts()) : $actor->the_post(); ?>
                    <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                        <div class="flex flex-col">
                            <p class="text-sm text-gray-300"><?= the_title() ?></p>
                            <p class="text-xs text-gray-500">نقش نامشخص</p>
                        </div>
                        <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3"><img class="rounded-[10px] h-full object-cover w-full" src="<?php the_post_thumbnail_url()?>"/></div>
                    </div>
                <?php endwhile;
            else : ?>
                <p><?php esc_html_e('متاسفانه محتوایی یافت نشد'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>