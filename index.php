<?php get_header(); ?>
    <div id="content">
        <!--while 语句通过测试 have_posts() 决定是否调用 the_post() 函数-->
        <!--the_ID()：返回博文 ID；-->
        <!--the_permalink()：返回博文固定链接 URL；-->
        <!--the_title()：返回博文标题；-->
        <!--the_time(’M’)：返回发表日期中的月份；-->
        <!--the_time(’d’)：返回发表日期中的天；-->
        <!--the_author()：返回博文作者；-->
        <!--the_category()：返回博文的类别；-->
        <!--the_content()：返回博文的内容，其中的参数表示用于“更多内容”的链接文本；-->
        <!--_e() 函数是一个包装函数，这个函数主要用于语言的转换，如果调用该函数并传递标准的 WP 术语，如：Author 或 Categories，则返回你相应语言包中的译文，在中文包中分别是“作者”和“类别”。-->
        <?php if (have_posts()) : while (have_posts()) :the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
                <!--博文标题及链接-->
                <h2>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <!--发表日期-->
                <div class="post-date">
                    <span class="post-month"><?php the_time('M'); ?></span>
                    <span class="post-day"><?php the_time('d'); ?></span>
                </div>
                <!--作者-->
                <span class="post-author"><?php _e('Author'); ?> : <?php the_author(’, ‘); ?></span>
                <!--注释-->
                <span class="post-comments"><?php comments_popup_link('No Comments?', '1 Comment ?', '% Comments ?'); ?></span>
                <!--内容-->
                <div class="entry">
                    <?php
                    //这是为了在单篇文章(或页面)直接显示全部内容,而不使用以下的判断
                    if (is_singular()) {
                        the_content();
                    } else {
                        //定义两个$
                        $pc = $post->post_content;
                        $st = strip_tags(apply_filters('the_content', $pc));
                        //判断是否存在 内置摘要
                        if (has_excerpt()) the_excerpt();
                        elseif (preg_match('/<!--more.*?-->/', $pc) || mb_strwidth($st) < 150) the_content('继续阅读');
                        elseif (function_exists('mb_strimwidth'))
                            echo '' . mb_strimwidth($st, 0, 150, '。') . ' ';
                        else the_content();
                    }
                    ?>
                </div>
                <!--其它元数据 编辑链接-->
                <div class="post-meta"><?php edit_post_link('编辑', ’ | ‘, ”); ?></div>
            </div>
        <?php endwhile; ?>
            <div class="navigation">
                <!--分页导航链接-->
                <span class="previous-entries">
                <?php next_posts_link('前一篇'); ?>
            </span>
                <span class="next-entries">
                <?php previous_post_link('后一篇'); ?>
            </span>
            </div>
        <?php else : ?>
            <div class="post">
                <h2><?php _e('Not Found'); ?></h2>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>