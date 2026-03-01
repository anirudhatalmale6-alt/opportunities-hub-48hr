<?php
/**
 * Template: Opportunities Hub Landing Page
 * Inherits the active theme's header and footer.
 */
get_header();

// Get configurable CTA URL
$structured_url = get_option('opphub_structured_url', '');
if (empty($structured_url)) {
    $structured_url = home_url('/');
}

// Gather taxonomy terms for filters
$institutions  = get_terms(['taxonomy' => 'institution', 'hide_empty' => false]);
$funding_types = get_terms(['taxonomy' => 'funding_type', 'hide_empty' => false]);
$regions       = get_terms(['taxonomy' => 'region', 'hide_empty' => false]);
$sectors       = get_terms(['taxonomy' => 'sector', 'hide_empty' => false]);

// Query opportunities
$opportunities = new WP_Query([
    'post_type'      => 'opportunity',
    'posts_per_page' => 50,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<div id="opphub-landing">

    <!-- ===== HERO SECTION ===== -->
    <section class="opphub-hero">
        <div class="opphub-container">
            <h1 class="opphub-hero-title">Access Global Funding Opportunities &mdash; Structured &amp; Ready</h1>
            <p class="opphub-hero-subtitle">Grants, loans, sponsorships, and programs from IDB, World Bank, UN, banks, and microfinance institutions &mdash; updated weekly.</p>
            <div class="opphub-hero-cta">
                <a href="#opphub-opportunities" class="opphub-btn opphub-btn-red">Explore Opportunities</a>
                <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-blue">Get Structured in 48 Hours</a>
            </div>
        </div>
    </section>

    <!-- ===== SMART FILTER BAR ===== -->
    <section class="opphub-filter-bar" id="opphub-filters">
        <div class="opphub-container">
            <form id="opphub-filter-form" class="opphub-filters">
                <div class="opphub-filter-group">
                    <select name="institution" id="filter-institution">
                        <option value="">Institution</option>
                        <?php if ($institutions && !is_wp_error($institutions)) : foreach ($institutions as $term) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <select name="funding_type" id="filter-funding-type">
                        <option value="">Funding Type</option>
                        <?php if ($funding_types && !is_wp_error($funding_types)) : foreach ($funding_types as $term) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <select name="region" id="filter-region">
                        <option value="">Country / Region</option>
                        <?php if ($regions && !is_wp_error($regions)) : foreach ($regions as $term) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <select name="sector" id="filter-sector">
                        <option value="">Sector</option>
                        <?php if ($sectors && !is_wp_error($sectors)) : foreach ($sectors as $term) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <select name="deadline_status" id="filter-deadline">
                        <option value="">Deadline</option>
                        <option value="open">Open</option>
                        <option value="closing_soon">Closing Soon</option>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <select name="funding_size" id="filter-funding-size">
                        <option value="">Funding Size</option>
                        <option value="under_50k">Under $50K</option>
                        <option value="50k_100k">$50K – $100K</option>
                        <option value="100k_500k">$100K – $500K</option>
                        <option value="over_500k">Over $500K</option>
                    </select>
                </div>
                <div class="opphub-filter-group">
                    <button type="submit" class="opphub-btn opphub-btn-blue opphub-btn-filter">Apply Filters</button>
                    <button type="button" id="opphub-clear-filters" class="opphub-btn opphub-btn-outline">Clear</button>
                </div>
            </form>
        </div>
    </section>

    <!-- ===== OPPORTUNITIES LIST ===== -->
    <section class="opphub-opportunities" id="opphub-opportunities">
        <div class="opphub-container">
            <div class="opphub-results-count">
                <span id="opphub-count"><?php echo $opportunities->found_posts; ?></span> opportunities found
            </div>
            <div id="opphub-cards" class="opphub-cards-grid">
                <?php if ($opportunities->have_posts()) :
                    while ($opportunities->have_posts()) : $opportunities->the_post();
                        include OPP_HUB_PATH . 'templates/partials/opportunity-card.php';
                    endwhile;
                else : ?>
                    <div class="opphub-no-results">
                        <p>No opportunities available yet. Check back soon!</p>
                    </div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <!-- ===== WHY THIS HUB EXISTS ===== -->
    <section class="opphub-why">
        <div class="opphub-container">
            <h2>Why This Hub Exists</h2>
            <div class="opphub-why-grid">
                <div class="opphub-why-item">
                    <div class="opphub-why-icon">&#127970;</div>
                    <h3>Institutions fund structure, not ideas</h3>
                    <p>Funders want to see a real business with documents, compliance, and a plan — not just a concept.</p>
                </div>
                <div class="opphub-why-item">
                    <div class="opphub-why-icon">&#9889;</div>
                    <h3>We organize projects in 48 hours</h3>
                    <p>Our team helps you structure your business documents and applications at speed.</p>
                </div>
                <div class="opphub-why-item">
                    <div class="opphub-why-icon">&#127758;</div>
                    <h3>One hub, global opportunities</h3>
                    <p>Access funding from IDB, World Bank, UN, local banks, and microfinance — all in one place.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== 48HOURSREADY PACKAGE CTA ===== -->
    <section class="opphub-cta-package">
        <div class="opphub-container">
            <div class="opphub-package-box">
                <h2>Found an opportunity but not ready?</h2>
                <ul class="opphub-package-list">
                    <li>&#10004; Business structure</li>
                    <li>&#10004; Executive summary</li>
                    <li>&#10004; Pitch deck (GPT-verified)</li>
                    <li>&#10004; Bank &amp; institution-ready</li>
                </ul>
                <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg">Get Ready for $199</a>
            </div>
        </div>
    </section>

    <!-- ===== LIVE UPDATES / RSS SECTION ===== -->
    <section class="opphub-rss-section">
        <div class="opphub-container">
            <h2>Latest Funding Updates</h2>
            <p>Auto-updated feed pulling from IDB, World Bank, UN Agencies, Chambers of Commerce, and Microfinance Institutions.</p>
            <a href="<?php echo esc_url(home_url('/?feed=opportunities-feed')); ?>" class="opphub-btn opphub-btn-blue" target="_blank">
                &#128266; Subscribe to Updates (RSS)
            </a>
        </div>
    </section>

    <!-- ===== PARTNERS & INSTITUTIONS LOGO STRIP ===== -->
    <section class="opphub-partners">
        <div class="opphub-container">
            <h2>Partners &amp; Institutions</h2>
            <div class="opphub-logos">
                <span class="opphub-logo-text">IDB</span>
                <span class="opphub-logo-text">World Bank</span>
                <span class="opphub-logo-text">UN</span>
                <span class="opphub-logo-text">BRH</span>
                <span class="opphub-logo-text">Unibank</span>
                <span class="opphub-logo-text">Chambers of Commerce</span>
                <span class="opphub-logo-text">Microfinance Networks</span>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
