<?php
/**
 * Template: 48HoursReady Corporate Services
 * Professional pricing page with 3-tier packages.
 */
get_header();

// Get configurable CTA URL
$structured_url = get_option('opphub_structured_url', '');
if (empty($structured_url)) {
    $structured_url = home_url('/apply-business/');
}

// WhatsApp number (configurable)
$whatsapp_number = get_option('opphub_whatsapp_number', '');
$whatsapp_url = $whatsapp_number ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp_number) . '?text=' . urlencode('Hi, I\'m interested in your Corporate Services.') : '#';
?>

<div id="opphub-corporate">

    <!-- ===== HERO SECTION ===== -->
    <section class="opphub-corp-hero">
        <div class="opphub-container">
            <h1 class="opphub-corp-hero-title">Corporate Business Plans, Proposals &amp; Communication Materials</h1>
            <p class="opphub-corp-hero-subtitle">From startup launches to institutional proposals, we help organizations structure their ideas and present them professionally.</p>
            <div class="opphub-corp-hero-cta">
                <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg">Request a Quote</a>
                <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-blue opphub-btn-lg">Start Your Project</a>
                <?php if ($whatsapp_number) : ?>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener" class="opphub-btn opphub-corp-btn-whatsapp opphub-btn-lg">WhatsApp Consultation</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ===== PACKAGES SECTION ===== -->
    <section class="opphub-corp-packages">
        <div class="opphub-container">
            <h2 class="opphub-corp-section-title">Choose Your Package</h2>
            <div class="opphub-corp-packages-grid">

                <!-- Package 0A: Student Special -->
                <div class="opphub-corp-card">
                    <div class="opphub-corp-card-header">
                        <span class="opphub-corp-card-price">$79</span>
                        <h3 class="opphub-corp-card-name">Student Special</h3>
                        <p class="opphub-corp-card-desc">Essential branding to get your business started.</p>
                    </div>
                    <div class="opphub-corp-card-body">
                        <ul class="opphub-corp-features">
                            <li>Logo Design</li>
                            <li>Business Cards</li>
                            <li>Executive Summary</li>
                            <li>One-Page Website (Business Overview, Services &amp; Contact)</li>
                        </ul>
                        <div class="opphub-corp-positioning">
                            <strong>Perfect for:</strong>
                            <span>Students, new entrepreneurs, and small business owners getting started</span>
                        </div>
                        <div class="opphub-corp-delivery">Delivery: 24&#8211;48 hours.</div>
                    </div>
                    <div class="opphub-corp-card-footer">
                        <a href="<?php echo esc_url($structured_url . (strpos($structured_url, '?') !== false ? '&' : '?') . 'package=student-special'); ?>" class="opphub-btn opphub-btn-blue opphub-corp-card-btn">Get Started</a>
                    </div>
                </div>

                <!-- Package 0B: Business Kit -->
                <div class="opphub-corp-card">
                    <div class="opphub-corp-card-header">
                        <span class="opphub-corp-card-price">$199</span>
                        <h3 class="opphub-corp-card-name">Business Kit</h3>
                        <p class="opphub-corp-card-desc">The complete 48HoursReady package to present your business professionally.</p>
                    </div>
                    <div class="opphub-corp-card-body">
                        <ul class="opphub-corp-features">
                            <li>Logo Design</li>
                            <li>Business Cards</li>
                            <li>Executive Summary</li>
                            <li>Project Plan for Banks &amp; Institutions</li>
                            <li>Video Explainer</li>
                            <li>One-Page Website (Business Overview, Services &amp; Contact)</li>
                        </ul>
                        <div class="opphub-corp-positioning">
                            <strong>Perfect for:</strong>
                            <span>Entrepreneurs ready to present to banks, partners, and investors</span>
                        </div>
                        <div class="opphub-corp-delivery">Delivery: 48 hours.</div>
                    </div>
                    <div class="opphub-corp-card-footer">
                        <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-blue opphub-corp-card-btn">Get Started</a>
                    </div>
                </div>

                <!-- Package 1: Business Launch -->
                <div class="opphub-corp-card">
                    <div class="opphub-corp-card-header">
                        <span class="opphub-corp-card-price">$299</span>
                        <h3 class="opphub-corp-card-name">Business Launch Package</h3>
                        <p class="opphub-corp-card-desc">The entry corporate package built on top of the $199 Business Kit.</p>
                    </div>
                    <div class="opphub-corp-card-body">
                        <!-- Business Kit Highlight -->
                        <div class="opphub-corp-kit-highlight">
                            <div class="opphub-corp-kit-label">Includes the 48HoursReady Business Kit</div>
                            <ul class="opphub-corp-kit-list">
                                <li>Logo Design</li>
                                <li>Business Cards</li>
                                <li>Executive Summary</li>
                                <li>Project Plan for Banks &amp; Institutions</li>
                                <li>Video Explainer</li>
                            </ul>
                        </div>
                        <!-- Additional Corporate Items -->
                        <div class="opphub-corp-extras-label">PLUS additional corporate items</div>
                        <ul class="opphub-corp-features">
                            <li>Basic Business Plan</li>
                            <li>Banner Design (for events or promotion)</li>
                            <li>1 Professional Proposal Document</li>
                            <li>One-Page Website (Business Overview, Services &amp; Contact)</li>
                        </ul>
                        <!-- Positioning -->
                        <div class="opphub-corp-positioning">
                            <strong>Perfect for:</strong>
                            <span>Startups, entrepreneurs, small businesses, NGOs launching projects, people preparing for banks or investors</span>
                        </div>
                        <div class="opphub-corp-delivery">Delivery: 48&#8211;72 hours depending on materials.</div>
                    </div>
                    <div class="opphub-corp-card-footer">
                        <a href="https://buy.stripe.com/fZu8wI7SocWs3B67Z3gYU02" class="opphub-btn opphub-btn-blue opphub-corp-card-btn">Get Started</a>
                    </div>
                </div>

                <!-- Package 2: Corporate Growth (Most Popular) -->
                <div class="opphub-corp-card opphub-corp-card-popular">
                    <div class="opphub-corp-card-badge">Most Popular</div>
                    <div class="opphub-corp-card-header">
                        <span class="opphub-corp-card-price">$499</span>
                        <h3 class="opphub-corp-card-name">Corporate Growth Package</h3>
                        <p class="opphub-corp-card-desc">For companies ready to grow or seek funding.</p>
                    </div>
                    <div class="opphub-corp-card-body">
                        <div class="opphub-corp-includes-note">Includes everything in the Business Launch Package PLUS:</div>
                        <ul class="opphub-corp-features">
                            <li>Full Business Plan (15&#8211;20 pages)</li>
                            <li>Investor Pitch Deck</li>
                            <li>Company Profile / Capability Statement</li>
                            <li>Corporate Banner + Marketing Graphics</li>
                            <li>Professional Proposal Design</li>
                            <li>Executive Summary for Investors</li>
                            <li>Business Strategy Update for existing businesses</li>
                            <li>One-Page Website (Business Overview, Services &amp; Contact)</li>
                        </ul>
                        <div class="opphub-corp-positioning">
                            <strong>Best for:</strong>
                            <span>Companies seeking investors, businesses applying for grants, companies expanding operations, organizations preparing presentations</span>
                        </div>
                    </div>
                    <div class="opphub-corp-card-footer">
                        <a href="https://buy.stripe.com/6oUeV62y4bSoc7C6UZgYU03" class="opphub-btn opphub-btn-red opphub-corp-card-btn">Get Started</a>
                    </div>
                </div>

                <!-- Package 3: Enterprise / Institutional -->
                <div class="opphub-corp-card">
                    <div class="opphub-corp-card-header">
                        <span class="opphub-corp-card-price">$899</span>
                        <h3 class="opphub-corp-card-name">Enterprise / Institutional Package</h3>
                        <p class="opphub-corp-card-desc">For corporations, NGOs, institutions and large projects.</p>
                    </div>
                    <div class="opphub-corp-card-body">
                        <ul class="opphub-corp-features">
                            <li>Comprehensive Business Plan (30+ pages)</li>
                            <li>Investor or Board Presentation</li>
                            <li>Funding / Donor Proposal</li>
                            <li>Corporate Communication Materials</li>
                            <li>Conference / Event Branding</li>
                            <li>Corporate Strategy &amp; Expansion Plan</li>
                            <li>Institutional Partnership Deck</li>
                            <li>One-Page Website (Business Overview, Services &amp; Contact)</li>
                        </ul>
                        <div class="opphub-corp-addons">
                            <strong>Optional add-ons:</strong>
                            <ul>
                                <li>UN / donor proposal formatting</li>
                                <li>Investment memorandums</li>
                                <li>Grant submissions</li>
                                <li>Strategic advisory sessions</li>
                            </ul>
                        </div>
                        <div class="opphub-corp-positioning">
                            <strong>Best for:</strong>
                            <span>Corporations, NGOs, institutions, large-scale project owners</span>
                        </div>
                    </div>
                    <div class="opphub-corp-card-footer">
                        <a href="https://buy.stripe.com/5kQ3coc8EbSo9Zu6UZgYU04" class="opphub-btn opphub-btn-blue opphub-corp-card-btn">Get Started</a>
                    </div>
                </div>

            </div><!-- .opphub-corp-packages-grid -->
        </div>
    </section>

    <!-- ===== REVENUE TIERS ===== -->
    <section class="opphub-corp-tiers">
        <div class="opphub-container">
            <div class="opphub-corp-tiers-grid">
                <div class="opphub-corp-tier">
                    <span class="opphub-corp-tier-price">$79</span>
                    <span class="opphub-corp-tier-label">Students</span>
                </div>
                <div class="opphub-corp-tier-arrow">&#8594;</div>
                <div class="opphub-corp-tier">
                    <span class="opphub-corp-tier-price">$199</span>
                    <span class="opphub-corp-tier-label">Entry customers</span>
                </div>
                <div class="opphub-corp-tier-arrow">&#8594;</div>
                <div class="opphub-corp-tier">
                    <span class="opphub-corp-tier-price">$299</span>
                    <span class="opphub-corp-tier-label">Serious entrepreneurs</span>
                </div>
                <div class="opphub-corp-tier-arrow">&#8594;</div>
                <div class="opphub-corp-tier">
                    <span class="opphub-corp-tier-price">$499</span>
                    <span class="opphub-corp-tier-label">Business clients</span>
                </div>
                <div class="opphub-corp-tier-arrow">&#8594;</div>
                <div class="opphub-corp-tier">
                    <span class="opphub-corp-tier-price">$899</span>
                    <span class="opphub-corp-tier-label">Institutional projects</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MOTIVATIONAL TAGLINE ===== -->
    <section class="opphub-corp-tagline">
        <div class="opphub-container">
            <blockquote class="opphub-corp-quote">
                <p>Most businesses fail because they lack structure, not ideas.</p>
                <p><strong>48HoursReady turns ideas into professional, fundable projects.</strong></p>
            </blockquote>
            <a href="<?php echo esc_url($structured_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg">Start Your Project Today</a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
