<?php

/**
 * Template part for displaying post cards.
 *
 * @package era_ai
 */
$card_class = isset($args['class']) ? $args['class'] : '';
$card_attributes = isset($args['attributes']) ? $args['attributes'] : '';
$lazy_load = isset($args['lazy']) ? $args['lazy'] : true;

$post_author = get_field('author') ?: get_the_author();
$post_date = get_field('publish_date') ?: get_the_date('F j, Y');
$post_subheadline = get_field('subheadline');
$cats = get_the_category();
$cat_name = !empty($cats) ? $cats[0]->name : '';
$excerpt = get_the_excerpt();

?>

<article class="card <?php echo esc_attr($card_class); ?>" <?php echo $card_attributes; ?>>
    <a href="<?php the_permalink(); ?>" class="cover">
        <?php if (has_post_thumbnail()) : ?>
            <?php 
            if ($lazy_load) {
                the_post_thumbnail('medium_large', ['loading' => 'lazy']);
            } else {
                the_post_thumbnail('medium_large');
            }
            ?>
        <?php endif; ?>
        <?php if ($cat_name) : ?>
            <span class="ctag"><?php echo esc_html($cat_name); ?></span>
        <?php endif; ?>
    </a>

    <div class="body">
        <h3 class="ttl">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ($excerpt) : ?>
            <p class="dek"><?php echo esc_html(wp_trim_words($excerpt, 18, '...')); ?></p>
        <?php endif; ?>

        <div class="byl">
            <span><b>oleh <?php echo esc_html($post_author); ?></b></span>
            <span><?php echo esc_html($post_date); ?></span>
        </div>
    </div>
</article>
