<ul>
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>
        <!--搜索表单-->
        <li id="search">
            <?php include(TEMPLATEPATH . '/searchform.php'); ?>
        </li>
        <!--显示日历-->
        <li id="calendar">
            <h2><?php _e('Calendar'); ?></h2>
            <?php get_calendar(); ?>
        </li>
        <!--显示页面导航-->
        <?php wp_list_pages('title_li=<h2>页面</h2>'); ?>
        <li class="catnav">
            <h2><?php _e('Categories'); ?></h2>
        </li>
        <!--显示分类导航-->
        <li><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=o'); ?></li>
        <!--显示存档导航-->
        <li class="archivesnav">
            <h2><?php _e('Archives'); ?></h2>
            <ul><?php wp_get_archives('type=monthly'); ?></ul>
        </li>
        <!--显示导航链接-->
        <li class="blogrollnav">
            <h2><?php _e('Links'); ?></h2>
            <ul><?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?></ul>
        </li>
        <li class="meta">
            <h2><?php _e('Meta'); ?></h2>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
    <?php endif; ?>
</ul>