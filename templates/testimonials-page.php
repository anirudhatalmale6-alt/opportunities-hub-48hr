<?php
/**
 * Template: Testimonials Page
 * Inherits the active theme's header and footer.
 */
get_header();

$structured_url = get_option('opphub_structured_url', '');
if (empty($structured_url)) {
    $structured_url = home_url('/apply-business/');
}

// Get CF7 form ID
$cf7_id = get_option('opphub_cf7_testimonial_id', '');

// Get approved testimonials (initial load)
$testimonials = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'paged'          => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => [['key' => '_testimonial_approved', 'value' => '1']],
]);
?>

<div id="opphub-testimonials-page">

    <!-- ===== HERO SECTION ===== -->
    <section class="opphub-hero opphub-testimonials-hero">
        <div class="opphub-container">
            <h1 class="opphub-hero-title">What Our Clients Say</h1>
            <p class="opphub-hero-subtitle">Real stories from entrepreneurs and businesses we've helped get structured and funded.</p>
        </div>
    </section>

    <!-- ===== APPROVED TESTIMONIALS ===== -->
    <section class="opphub-testimonials-section" id="opphub-testimonials-list">
        <div class="opphub-container">
            <?php if ($testimonials->have_posts()) : ?>
                <div id="opphub-testimonials-grid" class="opphub-testimonials-grid">
                    <?php while ($testimonials->have_posts()) : $testimonials->the_post();
                        $name    = get_post_meta(get_the_ID(), '_testimonial_name', true);
                        $country = get_post_meta(get_the_ID(), '_testimonial_country', true);
                        $rating  = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                    ?>
                    <div class="opphub-testimonial-card">
                        <?php if ($rating) : ?>
                            <div class="opphub-testimonial-stars">
                                <?php echo str_repeat('&#9733;', intval($rating)) . str_repeat('&#9734;', 5 - intval($rating)); ?>
                            </div>
                        <?php endif; ?>
                        <div class="opphub-testimonial-text">&ldquo;<?php echo esc_html(get_the_content()); ?>&rdquo;</div>
                        <div class="opphub-testimonial-author">
                            <strong><?php echo esc_html($name); ?></strong>
                            <?php if ($country) : ?>
                                <span class="opphub-testimonial-country"><?php echo esc_html($country); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <?php if ($testimonials->max_num_pages > 1) : ?>
                    <div class="opphub-testimonials-loadmore">
                        <button id="opphub-load-more" class="opphub-btn opphub-btn-outline" data-page="2" data-max="<?php echo $testimonials->max_num_pages; ?>">Load More Testimonials</button>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="opphub-testimonials-empty">
                    <p>No testimonials yet. Be the first to share your experience!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ===== SUBMIT TESTIMONIAL FORM ===== -->
    <section class="opphub-testimonial-form-section" id="opphub-submit-testimonial">
        <div class="opphub-container">
            <p class="opphub-testimonial-trust-line">Trusted by entrepreneurs across Haiti, the Caribbean &amp; the diaspora.</p>
            <div class="opphub-testimonial-form-box">
                <h2>Share Your Experience</h2>
                <p>Your feedback helps others discover 48HoursReady. Tell us about your experience!</p>
                <?php if ($cf7_id) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="' . intval($cf7_id) . '" title="48HoursReady Testimonial Form"]'); ?>
                <?php else : ?>
                    <p style="color:#e65100;">Testimonial form is being set up. Please check back shortly.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ===== CTA ===== -->
    <section class="opphub-cta-package">
        <div class="opphub-container">
            <div class="opphub-package-box">
                <h2>Ready to Get Structured?</h2>
                <p style="color:rgba(255,255,255,0.9);margin:0 0 24px;font-size:16px;">Join our growing list of satisfied clients. Get your business investor-ready in 48 hours.</p>
                <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg">Get Started for $199</a>
            </div>
        </div>
    </section>

</div>

<script>
(function(){
    if (typeof jQuery === 'undefined') return;
    jQuery(function($){
        /* Load More testimonials */
        $('#opphub-load-more').on('click', function(){
            var $btn = $(this);
            var page = parseInt($btn.data('page'));
            var max  = parseInt($btn.data('max'));
            $btn.text('Loading...').prop('disabled', true);
            $.post(<?php echo json_encode(admin_url('admin-ajax.php')); ?>, {
                action: 'opphub_load_testimonials',
                page: page
            }, function(r){
                if (r.success && r.data.html) {
                    $('#opphub-testimonials-grid').append(r.data.html);
                    if (page >= max || !r.data.has_more) {
                        $btn.remove();
                    } else {
                        $btn.data('page', page + 1).text('Load More Testimonials').prop('disabled', false);
                    }
                }
            });
        });
    });
})();
</script>
<?php get_footer(); ?>
