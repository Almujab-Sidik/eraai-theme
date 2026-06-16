<?php

/**
 * Homepage — category filtered posts section.
 *
 * Excludes posts in the 'hero' category.
 *
 * @package era_ai
 */
$categories = get_categories([
    'hide_empty' => true,
]);

$filter_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 24,
    'orderby' => 'date',
    'order' => 'DESC',
]);

$artikel_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-artikel.php',
    'number' => 1
));
$blog_url = !empty($artikel_pages) ? get_permalink($artikel_pages[0]->ID) : home_url('/');
?>

<?php if ($filter_query->have_posts()): ?>
<section class="posts-section filtered-section">
    <div class="wrapper__border">
        <div class="posts-section__inner container">

            <!-- Header Section -->
            <div class="posts-section__header">
                <span class="posts-section__label">Artikel Kategori</span>
            </div>

            <!-- Category Filter Tabs -->
            <?php if (!empty($categories)): ?>
                <div class="filter-tabs">
                    <button class="filter-tab active" data-slug="all">Semua</button>
                    <?php foreach ($categories as $cat): ?>
                        <button class="filter-tab" data-slug="<?php echo esc_attr($cat->slug); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Cards Grid -->
            <div class="grid-cards filter-grid">
                <?php while ($filter_query->have_posts()):
                    $filter_query->the_post(); ?>

                    <?php
                    $post_author = get_field('author') ?: get_the_author();
                    $post_date = get_field('publish_date') ?: get_the_date('F j, Y');
                    $post_subheadline = get_field('subheadline');

                    // Ambil kategori dari post ini
                    $post_cats = get_the_category();
                    $cat_slugs = [];
                    $primary_cat_name = '';

                    foreach ($post_cats as $pc) {
                        $cat_slugs[] = $pc->slug;
                        if (empty($primary_cat_name)) {
                            $primary_cat_name = $pc->name;
                        }
                    }
                    $cat_slug_str = implode(' ', $cat_slugs);

                    get_template_part('template-parts/content', 'card', [
                        'class' => 'filter-card',
                        'attributes' => 'data-categories="' . esc_attr($cat_slug_str) . '"',
                        'lazy' => false,
                    ]);
                    ?>

                <?php endwhile; ?>
            </div>

            <!-- Footer area containing the button -->
            <div class="posts-section__footer">
                <a href="<?php echo esc_url($blog_url); ?>" class="btn btn--secondary">Lihat Semua Artikel</a>
            </div>

        </div>
    </div>
</section>

<!-- Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.filtered-section .filter-tab');
    const cards = document.querySelectorAll('.filtered-section .filter-card');

    function filterPosts(targetSlug) {
        let count = 0;
        cards.forEach(card => {
            const cardCats = card.getAttribute('data-categories').split(' ');

            // Reset animation state
            card.classList.remove('is-filtered');

            if ((targetSlug === 'all' || cardCats.includes(targetSlug)) && count < 6) {
                card.style.display = '';
                // Trigger reflow to restart keyframe animation
                void card.offsetWidth;
                card.classList.add('is-filtered');
                count++;
            } else {
                card.style.display = 'none';
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active state from all tabs, add to clicked
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const targetSlug = this.getAttribute('data-slug');
            filterPosts(targetSlug);
        });
    });

    // Run initial filter on load (Semua - limit max 6 cards)
    filterPosts('all');
});
</script>
<?php endif;
wp_reset_postdata(); ?>
