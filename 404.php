<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package era_ai
 */

get_header();
?>

<main id="primary" class="site-main error-page">
    <div class="wrapper__border">
        <div class="error-container container">
            
            <div class="error-code">404</div>
            <h1 class="error-title"><?php esc_html_e( 'Halaman Tidak Ditemukan', 'era-ai' ); ?></h1>
            <p class="error-description"><?php esc_html_e( 'Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan. Silakan kembali ke beranda atau cari artikel yang Anda butuhkan.', 'era-ai' ); ?></p>
            
            <div class="error-search">
                <?php get_search_form(); ?>
            </div>
            
            <div class="error-actions">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn--primary">Kembali Ke Beranda</a>
            </div>

        </div>
    </div>
</main>

<?php
get_footer();
