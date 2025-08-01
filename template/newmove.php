<?php

$options = get_option('moves_options');

$genres = get_terms([
    'taxonomy' => 'genre' ,
    'hide_empty' => false
]);

?>
<!--    -->
<section class="new-move py-[40px]">
    <div class="container md:px-0 px-5">
        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="title-sec"><?= $options['newmove_title'] ?></h3>
            <div class="flex flex-wrap gap-3 justify-center my-4" id="genreTabs">
                <?php foreach ($genres as $index => $genre) { ?>
                    <button data-tab="<?php echo $genre->term_id ?>"
                            class="tab-btn border border-gray-300 text-white px-5 py-2 rounded-full">
                        <?php echo $genre->name ?>
                    </button>
                <?php } ?>
            </div>
        </div>
        <div id="tabContent">
            <?php foreach ($genres as $index => $genre): ?>
                <div data-content="<?php echo $genre->term_id ?>" class="tab-content">
                    <div class="grid md:grid-cols-4 grid-cols-1 justify-center gap-4">
                        <?php
                        $query = new WP_Query([
                            'post_type' => ['movie' , 'series'],
                            'posts_per_page' => 8,
                            'tax_query' => [[
                                'taxonomy' => 'genre',
                                'field' => 'slug',
                                'terms' => $genre->slug,
                            ]],
                        ]);

                        if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post(); ?>
                        <div class="image relative md:w-[300px] w-full h-[180px]">
                            <img class="rounded-[10px] h-full w-full object-cover" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>" alt="<?= esc_attr(get_the_title()) ?>">
                            <div class="overlay text-start">
                                <h2 class="text-sm"><?= esc_html(get_the_title()) ?></h2>
                            </div>
                        </div>
                        <?php endwhile;
                        else: ?>
                            <p class="col-span-4 text-center text-gray-400">موردی یافت نشد.</p>
                        <?php endif;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="flex items-center justify-center mt-4">
            <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده
                بیشتر</a>
        </div>
    </div>
</section>
<script>
    // سوئیچ تب‌ها
    $('.tab-btn').click(function () {
        $('.tab-btn').removeClass('border-white text-black').addClass('border-white text-gray-300');
        $(this).removeClass('border-white text-white text-gray-300').addClass('border-white text-black');
    });

    // انتخاب ژانر
    $('.genre-item').click(function () {
        $(this).toggleClass('bg-yellow-500 text-black').toggleClass('bg-[#2c2b3b] text-black');
    });

    document.querySelectorAll(".tab-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".tab-content").forEach(c => c.classList.add("hidden"));
            document.querySelector(`#tab-${btn.dataset.tab}`).classList.remove("hidden");
        });
    });
</script>