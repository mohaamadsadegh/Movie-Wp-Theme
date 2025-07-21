<?php $options = get_option('moves_options'); ?>
<!---->
<footer>
    <div class="container px-0 mt-5 bg-bluet-700 -mb-1">
        <div class="flex justify-center items-center py-3 px-4 border-t-2 rounded border-t-yellow-yellow900">
            <a href="<?php echo home_url(); ?>"
               class="text-2xl font-bold text-yellow-yellow900 text-center"><?= $options['title_site'] ?></a>
        </div>
    </div>
    <div class="bg-bluet-600 p-5">
    </div>

    <div class="w-8 fixed bottom-2 right-2  flex size-5 animate-bounce items-center justify-center rounded-full bg-bluet-600 p-2 ring-1 ring-gray-900/5 dark:bg-white/5 dark:ring-white/20">
        <svg class="size-6 rotate-180 text-violet-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
             viewBox="0 0 24 24" stroke="currentColor">
            <path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</footer>



<?php wp_footer(); ?>
</body>
</html>
