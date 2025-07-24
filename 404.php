<?php
$options = get_option('moves_options');
get_header();
if (empty($options['text_404_btn_link'])){
    $options['text_404_btn_link'] = home_url();
}
?>

<section class="">
    <div class="container">
        <div class="flex flex-col justify-center items-center h-[75vh]">
            <h4><?= $options['text_404']  ?></h4>
            <?php if(!empty($options['text_404_btn'])){ ?>
            <a href="<?= $options['text_404_btn_link']?>" class="px-6 text-sm ring-1 ring-slate-600 mt-5  py-2 bg-bluet-700 text-white rounded hover:bg-bluet-600 transition relative"><?= $options['text_404_btn'];?></a>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>