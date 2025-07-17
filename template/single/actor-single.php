<?php
$actors = get_post_meta(get_the_ID(), '_movie_actors', true);
if (!empty($actors)):
?>
<section class="container md:px-0 px-5 my-4">
    <!-- بازیگران -->
    <div class="">
        <h3 class="title-sec mb-5">بازیگران سریال</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <?php foreach ($actors as $actor_id): ?>
                <div class="p-3 flex bg-bluet-600 justify-end rounded-[10px]">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-300"><?= esc_html(get_the_title($actor_id)); ?></p>
                        <p class="text-xs text-gray-500">نقش نامشخص</p> <!-- اگر متای نقش داشتی، اینجا بذار -->
                    </div>
                    <div class="w-20 h-20 bg-gray-700 rounded-[10px] mr-3">
                        <?php if (has_post_thumbnail($actor_id)): ?>
                            <img class="rounded-[10px] h-full object-cover w-full" src="<?= get_the_post_thumbnail_url($actor_id); ?>" alt="<?= esc_attr(get_the_title($actor_id)); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>