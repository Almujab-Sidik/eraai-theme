<?php

/**
 * Template part for displaying a single post.
 *
 * Fields (SCF): headline, subheadline, author, publish_date, banner_hero
 *
 * @package era_ai
 */
$post_author = get_field('author') ?: get_the_author();
$post_date = get_field('publish_date') ?: get_the_date('F j, Y');
$post_subheadline = get_field('subheadline') ?: '';
$post_banner = get_field('banner_hero') ?: '';
$cats = get_the_category();
$cat_name = !empty($cats) ? $cats[0]->name : '';
$cat_url = !empty($cats) ? get_category_link($cats[0]->term_id) : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

    <!-- ═══ HERO HEADER ═══ -->
    <header class="sp-header">
        <div class="wrapper__border">
            <div class="sp-header__inner container">

                <!-- Meta row -->
                <div class="sp-meta">
                    <?php if ($cat_name): ?>
                        <a href="<?php echo esc_url($cat_url); ?>" class="sp-meta__cat"><?php echo esc_html($cat_name); ?></a>
                        <span class="sp-meta__sep">—</span>
                    <?php endif; ?>
                    <span class="sp-meta__date"><?php echo esc_html($post_date); ?></span>
                </div>

                <div class="line"></div>

                <!-- Headline -->
                <h1 class="sp-headline"><?php the_title(); ?></h1>

                <!-- Subheadline -->
                <?php if ($post_subheadline): ?>
                    <p class="sp-subheadline"><?php echo esc_html($post_subheadline); ?></p>
                <?php endif; ?>

                <!-- Author -->
                <div class="sp-byline">
                    <span class="sp-byline__label">oleh</span>
                    <span class="sp-byline__name"><?php echo esc_html($post_author); ?></span>
                </div>

            </div>
        </div>
    </header>

    <!-- ═══ CONTENT ═══ -->
    <div class="sp-body">
        <div class="wrapper__border">
            <div class="sp-body__inner container">

                <!-- Artikel -->
                <div class="sp-content entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- Sidebar: slot affiliate -->
                <?php if ($post_banner): ?>
                    <aside class="sp-sidebar">
                        <div class="sp-sidebar__slot">
                        </div>
                    </aside>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- ═══ POST NAVIGATION ═══ -->
    <nav class="sp-nav" aria-label="Navigasi Artikel">
        <div class="wrapper__border">
            <div class="sp-nav__inner container">
                <?php
                the_post_navigation([
                    'prev_text' => '<span class="sp-nav__label">← Sebelumnya</span><span class="sp-nav__title">%title</span>',
                    'next_text' => '<span class="sp-nav__label">Selanjutnya →</span><span class="sp-nav__title">%title</span>',
                ]);
                ?>
            </div>
        </div>
    </nav>

</article>
