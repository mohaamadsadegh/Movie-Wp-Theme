<?php $options = get_option('moves_options'); ?>
<!---->
<footer>
    <div class="container px-0 mt-5 bg-bluet-700 -mb-1">
        <div class="flex justify-center items-center py-3 px-4 border-t-2 rounded border-t-yellow-yellow900">
            <a href="<?php echo home_url(); ?>" class="text-2xl font-bold text-yellow-yellow900 text-center"><?= $options['title_site'] ?></a>
        </div>
    </div>
    <div class="bg-bluet-600 p-5">
    </div>
</footer>
<!-- JS for toggle -->
<script src="<?php echo get_template_directory_uri() . '/assets/js/jquery.js'?>"></script>
<script src="<?php echo get_template_directory_uri() . '/assets/js/swiper.js'?>"></script>
<script src="<?php echo get_template_directory_uri() . '/assets/js/script.js'?>"></script>
<?php wp_footer(); ?>
<div id="site-preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-black">
    <div class="text-white text-sm animate-pulse">در حال بارگذاری...</div>
</div>
<style>
    #site-preloader {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: #000;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</body>
</html>
