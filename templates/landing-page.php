<?php
/**
 * Template: Opportunities Hub Landing Page
 * Inherits the active theme's header and footer.
 */
get_header();

// Get configurable CTA URL
$structured_url = get_option('opphub_structured_url', '');
if (empty($structured_url)) {
    $structured_url = home_url('/apply-business/');
}

// Gather taxonomy terms for filters
$institutions  = get_terms(['taxonomy' => 'institution', 'hide_empty' => false]);
$funding_types = get_terms(['taxonomy' => 'funding_type', 'hide_empty' => false]);
$regions       = get_terms(['taxonomy' => 'region', 'hide_empty' => false]);
$sectors       = get_terms(['taxonomy' => 'sector', 'hide_empty' => false]);
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
                <span id="opphub-count">...</span> opportunities found
            </div>
            <div id="opphub-cards" class="opphub-cards-grid">
                <div class="opphub-loading" style="text-align:center;padding:40px;color:#666;">Loading opportunities...</div>
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
            <a href="#opphub-opportunities" class="opphub-btn opphub-btn-blue" onclick="document.getElementById('opphub-opportunities').scrollIntoView({behavior:'smooth'});return false;">
                &#128266; View Latest Updates
            </a>
        </div>
    </section>

    <!-- ===== PARTNERS & INSTITUTIONS LOGO STRIP ===== -->
    <section class="opphub-partners">
        <div class="opphub-container">
            <h2>Partners &amp; Institutions</h2>
            <div class="opphub-logos">
                <a href="https://www.iadb.org/" target="_blank" rel="noopener" class="opphub-logo-text">IDB</a>
                <a href="https://www.worldbank.org/" target="_blank" rel="noopener" class="opphub-logo-text">World Bank</a>
                <a href="https://www.un.org/" target="_blank" rel="noopener" class="opphub-logo-text">UN</a>
                <a href="https://www.greenclimate.fund/" target="_blank" rel="noopener" class="opphub-logo-text">Green Climate Fund</a>
                <a href="https://www.brh.ht/" target="_blank" rel="noopener" class="opphub-logo-text">BRH</a>
                <a href="https://www.unibankhaiti.com/" target="_blank" rel="noopener" class="opphub-logo-text">Unibank</a>
                <a href="https://www.usaid.gov/" target="_blank" rel="noopener" class="opphub-logo-text">USAID</a>
                <a href="https://www.adb.org/" target="_blank" rel="noopener" class="opphub-logo-text">ADB</a>
            </div>
        </div>
    </section>

</div>

<script>
/* Inline auto-loader v2.9 — bypasses Cloudflare page & JS cache */
(function(){
    if (typeof jQuery === 'undefined' || typeof opphub_ajax === 'undefined') return;
    jQuery(function($){
        var $cards = $('#opphub-cards');
        var $count = $('#opphub-count');

        /* 1. Dynamically populate filter dropdowns via AJAX (bypasses Cloudflare HTML cache) */
        $.post(opphub_ajax.ajax_url, {action:'opphub_get_options'}, function(r){
            if(!r.success) return;
            var opts = r.data;
            var map = {institution:'#filter-institution', funding_type:'#filter-funding-type', region:'#filter-region', sector:'#filter-sector'};
            for(var tax in map){
                var $sel = $(map[tax]);
                if(!$sel.length || !opts[tax]) continue;
                var cur = $sel.val();
                var first = $sel.find('option:first').text();
                $sel.empty().append('<option value="">' + first + '</option>');
                for(var i=0;i<opts[tax].length;i++){
                    $sel.append('<option value="'+opts[tax][i].slug+'">'+opts[tax][i].name+'</option>');
                }
                if(cur) $sel.val(cur);
            }
        });

        /* 2. Auto-load opportunities on page load */
        if ($cards.length && ($count.text() === '...' || $count.text() === '0' || $cards.find('.opphub-loading').length)) {
            $.post(opphub_ajax.ajax_url, {action:'opphub_filter', nonce:opphub_ajax.nonce}, function(r){
                if(r.success){$cards.html(r.data.html);$count.text(r.data.count);}
            });
        }

        /* 3. Filter form submit */
        $('#opphub-filter-form').off('submit.opphub').on('submit.opphub', function(e){
            e.preventDefault();
            var data = {action:'opphub_filter', nonce:opphub_ajax.nonce,
                institution:$('#filter-institution').val(), funding_type:$('#filter-funding-type').val(),
                region:$('#filter-region').val(), sector:$('#filter-sector').val(),
                deadline_status:$('#filter-deadline').val(), funding_size:$('#filter-funding-size').val()};
            $cards.html('<div style="text-align:center;padding:40px;color:#666;">Loading...</div>');
            $.post(opphub_ajax.ajax_url, data, function(r){
                if(r.success){$cards.html(r.data.html);$count.text(r.data.count);
                    $('html,body').animate({scrollTop:$('#opphub-opportunities').offset().top-20},400);}
            });
        });
        $('#opphub-clear-filters').off('click.opphub').on('click.opphub', function(){
            $('#opphub-filter-form').find('select').val('');
            $('#opphub-filter-form').trigger('submit');
        });
    });
})();
</script>
<?php get_footer(); ?>
