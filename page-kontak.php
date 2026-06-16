<?php

/**
 * Template Name: Halaman Kontak
 *
 * @package era_ai
 */
get_header();
?>

<main id="primary" class="site-main contact-page">

    <!-- ═══ HERO SECTION ═══ -->
    <section class="contact-hero">
        <div class="wrapper__border">
            <div class="contact-hero__inner container">
                <span class="posts-section__label"><?php esc_html_e('Hubungi Kami', 'era-ai'); ?></span>
                <h1 class="contact-title"><?php esc_html_e('Mari Mulai Berkolaborasi', 'era-ai'); ?></h1>
                <p class="contact-subheading"><?php esc_html_e('Punya ide proyek, pertanyaan, atau ingin berkonsultasi? Kirimkan pesan Anda melalui formulir di bawah ini.', 'era-ai'); ?></p>
            </div>
        </div>
    </section>

    <!-- ═══ CONTENT SECTION (INFO & FORM) ═══ -->
    <section class="contact-content">
        <div class="wrapper__border">
            <div class="contact-grid container">
                
                <!-- Left: Contact Details -->
                <div class="contact-info">
                    <div class="info-block">
                        <span class="info-label"><?php esc_html_e('Email Langsung', 'era-ai'); ?></span>
                        <a href="mailto:info@era-ai.id" class="info-link">info@eraai.id</a>
                    </div>
                    <div class="info-block">
                        <span class="info-label"><?php esc_html_e('Media Sosial', 'era-ai'); ?></span>
                        <ul class="info-socials">
                            <li><a href="https://www.instagram.com/eraai.official/" target="_blank" rel="noopener">Instagram</a></li>
                            <li><a href="https://www.threads.com/@eraai.official?hl=en" target="_blank" rel="noopener">Threads</a></li>
                        </ul>
                    </div>
                    <div class="info-block decor-block">
                        <span class="info-label"><?php esc_html_e('Jam Kerja', 'era-ai'); ?></span>
                        <p class="info-text"><?php esc_html_e('Senin — Jumat', 'era-ai'); ?><br><?php esc_html_e('09.00 — 17.00 WIB', 'era-ai'); ?></p>
                    </div>
                </div>

                <!-- Right: AJAX Contact Form -->
                <div class="contact-form-container">
                    <form id="era-contact-form" class="contact-form" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullname"><?php esc_html_e('Nama Lengkap', 'era-ai'); ?> <span class="required">*</span></label>
                                <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email"><?php esc_html_e('Alamat Email', 'era-ai'); ?> <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="contoh@domain.com" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="subject"><?php esc_html_e('Subjek / Perihal', 'era-ai'); ?> <span class="required">*</span></label>
                                <input type="text" id="subject" name="subject" placeholder="Apa perihal pesan Anda?" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="message"><?php esc_html_e('Pesan Anda', 'era-ai'); ?> <span class="required">*</span></label>
                                <textarea id="message" name="message" rows="6" placeholder="Tuliskan pesan Anda secara detail..." required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-feedback" id="form-feedback" style="display: none;"></div>

                        <div class="form-row action-row">
                            <button type="submit" class="btn btn--primary btn-submit" id="btn-submit">
                                <span class="btn-text"><?php esc_html_e('Kirim Pesan', 'era-ai'); ?></span>
                                <span class="btn-spinner" style="display: none;"></span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
