<?php if (post_password_required()) return; ?>

<section class="container md:px-0 px-5 my-4">
    <div class="space-y-6">

        <!-- هدر و دکمه -->
        <div class="flex justify-between items-center">
            <h3 class="title-sec mb-5">دیدگاه ها</h3>
            <a href="#custom-comment-form"
               class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm py-1 px-3 rounded-lg flex items-center justify-around">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path d="M18.7598 15H11.2598M15.0098 11.25V18.75M3.75489 15C3.75489 21.2132 8.79168 26.25 15.0049 26.25C17.5504 26.25 26.254 26.25 26.254 26.25C26.254 26.25 24.305 21.5702 25.085 20.001C25.8338 18.4945 26.2549 16.7964 26.2549 15C26.2549 8.7868 21.2181 3.75 15.0049 3.75C8.79168 3.75 3.75489 8.7868 3.75489 15Z"
                          stroke="#131A29" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                ارسال دیدگاه
            </a>
        </div>

        <!-- فرم AJAX دیدگاه -->
        <div id="commentform-wrapper">
            <?php
            comment_form([
                'id_form'           => 'custom-comment-form',
                'title_reply'       => 'پاسخ',
                'label_submit'      => 'ارسال',
                'class_submit'      => 'bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm py-1 px-3 rounded-lg mt-3',
                'comment_field'     => '<textarea name="comment" placeholder="دیدگاه خود را بنویسید..." class="w-full p-3 bg-bluet-600 rounded-lg text-sm text-white focus:outline-none focus:ring-2 focus:ring-yellow-500" rows="3" required></textarea>',
                'fields'            => [
                    'author' => '<input type="text" name="author" placeholder="نام" class="w-1/2 p-2 mt-2 rounded bg-gray-800 text-white text-sm" required>',
                    'email'  => '<input type="email" name="email" placeholder="ایمیل" class="w-1/2 p-2 mt-2 rounded bg-gray-800 text-white text-sm" required>',
                ],
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
            ]);
            ?>
            <div id="reply-wrapper" class="hidden mt-4">
                <form id="reply-form" class="space-y-2">
                    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                    <input type="hidden" name="comment_parent" id="reply_parent_id" value="0">
                    <input type="text" name="author" placeholder="نام" class="w-full p-2 rounded bg-gray-800 text-white text-sm" required>
                    <input type="email" name="email" placeholder="ایمیل" class="w-full p-2 rounded bg-gray-800 text-white text-sm" required>
                    <textarea name="comment" placeholder="پاسخ خود را بنویسید..." rows="3" class="w-full p-3 bg-bluet-600 rounded-lg text-sm text-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required></textarea>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium text-sm py-1 px-3 rounded-lg">
                        ارسال پاسخ
                    </button>
                    <div id="reply-message" class="text-sm mt-2"></div>
                </form>
            </div>

        </div>
        <div id="ajax-comment-message" class="text-sm mt-2"></div>

        <!-- لیست دیدگاه‌ها -->
        <div class="space-y-4">
            <?php if (have_comments()) : ?>
                <?php
                wp_list_comments([
                    'style' => 'div',
                    'avatar_size' => 40,
                    'callback' => function ($comment, $args, $depth) {
                        ?>
                        <div class="bg-bluet-600 p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <?php echo get_avatar($comment, 40, '', '', ['class' => 'rounded-full']); ?>
                                    <span class="text-sm font-bold"><?php echo get_comment_author(); ?></span>
                                </div>
                                <span class="text-xs text-gray-400"><?php strtotime($comment->comment_date); ?></span>
                            </div>
                            <p class="text-sm text-gray-300"><?php echo esc_html($comment->comment_content); ?></p>
                            <button class="reply-btn text-yellow-400 text-xs mt-2" data-commentid="<?php echo $comment->comment_ID; ?>">
                                پاسخ
                            </button>

                        </div>
                        <?php
                    }
                ]);
                ?>
            <?php else : ?>
                <p class="text-gray-400 text-sm">هنوز دیدگاهی ثبت نشده است.</p>
            <?php endif; ?>
        </div>

        <!-- دکمه مشاهده بیشتر (اختیاری) -->
        <div class="flex items-center justify-center" style="background: url('<?php echo IMG_URL . 'linet.png'?>') no-repeat center;">
            <a href="#" class="border-2 rounded-[7px] px-[8px] py-[6px] border-bluet-700 text-bluet-400">مشاهده بیشتر</a>
        </div>

    </div>
</section>
