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

<?php wp_footer(); ?>
</body>
</html>
