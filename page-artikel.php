<?php

/**
 * Template Name: Halaman Artikel
 *
 * @package era_ai
 */
get_header();

$categories = get_categories([
    'hide_empty' => true,
]);

$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC',
];

$query = new WP_Query($args);
?>

<main id="primary" class="site-main blog-page">
    
    <!-- ═══ HEADER SECTION ═══ -->
    <section class="blog-hero">
        <div class="wrapper__border">
            <div class="blog-hero__inner container">
                <span class="posts-section__label">Kumpulan Artikel</span>
                <h1 class="blog-title"><?php the_title(); ?></h1>
                <?php if (get_the_content()): ?>
                    <p class="blog-subheading"><?php echo wp_strip_all_tags(get_the_content()); ?></p>
                <?php else: ?>
                    <p class="blog-subheading">Temukan berbagai ulasan, tips, dan wawasan seputar teknologi, kecerdasan buatan, dan pembuatan website modern.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══ POSTS SECTION ═══ -->
    <section class="blog-posts-section">
        <div class="wrapper__border">
            <div class="blog-posts__inner container">
                
                <!-- Mobile Toggle Filter -->
                <div class="blog-mobile-filter-toggle-wrapper">
                    <button id="blog-mobile-filter-toggle" class="btn btn--secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
                        Filter Kategori
                    </button>
                </div>

                <div class="blog-layout">
                    <!-- SIDEBAR FILTER -->
                    <aside class="blog-sidebar" id="blog-sidebar">
                        <div class="blog-sidebar__header">
                            <span class="blog-sidebar__title">Kategori</span>
                            <button id="blog-sidebar-close" class="blog-sidebar__close">&times;</button>
                        </div>
                        <div class="blog-sidebar__content">
                            <div class="blog-filter-group">
                                <label class="blog-checkbox-label blog-checkbox-all">
                                    <input type="checkbox" id="category-select-all" checked>
                                    <span class="blog-checkbox-custom"></span>
                                    <span class="blog-checkbox-text">Semua Artikel</span>
                                </label>
                                
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): 
                                        if ($cat->slug === 'uncategorized') continue;
                                    ?>
                                        <label class="blog-checkbox-label">
                                            <input type="checkbox" class="blog-category-checkbox" value="<?php echo esc_attr($cat->slug); ?>">
                                            <span class="blog-checkbox-custom"></span>
                                            <span class="blog-checkbox-text"><?php echo esc_html($cat->name); ?></span>
                                            <span class="blog-checkbox-count">(<?php echo esc_html($cat->count); ?>)</span>
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </aside>

                    <!-- MAIN POSTS CONTENT -->
                    <div class="blog-main-content">
                        <!-- Grid Cards Container -->
                        <div class="grid-cards filter-grid blog-grid">
                            <?php if ($query->have_posts()): ?>
                                <?php while ($query->have_posts()):
                                    $query->the_post(); ?>
                                    <?php
                                    get_template_part('template-parts/content', 'card', [
                                        'class' => 'is-filtered',
                                    ]);
                                    ?>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            <?php else: ?>
                                <p class="error-msg">Belum ada artikel yang dipublikasikan.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Load More / Spinner Pagination -->
                        <div class="blog-pagination">
                            <span class="blog-loader-spinner"></span>
                            <button id="blog-load-more" class="btn btn--secondary" <?php echo ($query->max_num_pages <= 1) ? 'style="display:none;"' : ''; ?>>
                                Lihat Lebih Banyak
                            </button>
                        </div>
                    </div>
                </div>
                <div class="blog-sidebar-overlay" id="blog-sidebar-overlay"></div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
