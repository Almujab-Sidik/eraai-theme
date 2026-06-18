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

<!-- Reading Progress Bar -->
<div class="reading-progress-container">
    <div id="reading-progress" class="reading-progress-bar"></div>
</div>

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

                <!-- Sidebar: TOC & slot affiliate -->
                <aside class="sp-sidebar">
                    <!-- Table of Contents -->
                    <div class="sp-toc-container">
                        <h4 class="sp-toc-title">Daftar Isi</h4>
                        <nav id="toc" class="sp-toc-nav"></nav>
                    </div>

                    <?php if ($post_banner): ?>
                        <div class="sp-sidebar__slot" style="padding:0; overflow:hidden;">
                            <img src="<?php echo esc_url($post_banner); ?>" alt="Promotion" style="display:block; width:100%; height:auto; object-fit:cover;">
                        </div>
                    <?php endif; ?>
                </aside>

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

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Reading Progress Bar
    const progressBar = document.getElementById('reading-progress');
    
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressBar.style.width = Math.min(100, Math.max(0, progress)) + '%';
        }, { passive: true });
    }

    // 2. Table of Contents Generator
    const tocContainer = document.getElementById('toc');
    const article = document.querySelector('.entry-content');
    const headings = article ? article.querySelectorAll('h2, h3') : [];
    
    if (tocContainer && headings.length > 0) {
        const tocList = [];
        headings.forEach((heading, index) => {
            let id = heading.id;
            if (!id) {
                id = 'section-' + index;
                heading.id = id;
            }
            
            const text = heading.textContent;
            const isH3 = heading.tagName.toLowerCase() === 'h3';
            
            const link = document.createElement('a');
            link.href = '#' + id;
            link.textContent = text;
            link.className = 'sp-toc-link ' + (isH3 ? 'sp-toc-h3' : 'sp-toc-h2');
            
            tocContainer.appendChild(link);
            tocList.push({ element: heading, linkElement: link });
        });
        
        // Scroll Spy Highlight
        const spyScroll = () => {
            let activeTarget = null;
            const scrollPos = (window.scrollY || document.documentElement.scrollTop) + 120; // offset for navbar
            
            tocList.forEach(item => {
                // Get absolute offset top
                const top = item.element.getBoundingClientRect().top + window.scrollY;
                if (scrollPos >= top) {
                    activeTarget = item.linkElement;
                }
            });
            
            tocList.forEach(item => {
                if (item.linkElement === activeTarget) {
                    item.linkElement.classList.add('active');
                } else {
                    item.linkElement.classList.remove('active');
                }
            });
        };

        window.addEventListener('scroll', spyScroll, { passive: true });
        spyScroll(); // run once on load
    } else if (tocContainer) {
        const tocBox = document.querySelector('.sp-toc-container');
        if (tocBox) tocBox.style.display = 'none';
    }
});
</script>
