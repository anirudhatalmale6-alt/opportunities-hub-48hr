<?php
/**
 * About Us page template — 48HoursReady
 */
if (!defined('ABSPATH')) exit;
get_header();
$founder_photo = get_option('opphub_founder_photo', '');
?>
<style>
.opphub-about { max-width: 900px; margin: 0 auto; padding: 40px 20px 60px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #1a1a2e; line-height: 1.7; }
.opphub-about h1 { font-size: 2.2rem; color: #D32F2F; text-align: center; margin-bottom: 5px; }
.opphub-about .about-subtitle { font-size: 1.3rem; color: #1a1a2e; text-align: center; font-weight: 600; margin-bottom: 30px; }
.opphub-about-hero { display: flex; gap: 30px; align-items: flex-start; margin-bottom: 40px; flex-wrap: wrap; }
.opphub-about-photo { flex: 0 0 300px; max-width: 300px; }
.opphub-about-photo img { width: 100%; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
.opphub-about-intro { flex: 1; min-width: 280px; }
.opphub-about h2 { font-size: 1.5rem; color: #1a1a2e; margin: 35px 0 12px; border-bottom: 2px solid #D32F2F; padding-bottom: 6px; display: inline-block; }
.opphub-about p { margin: 0 0 14px; font-size: 1.05rem; }
.opphub-about .highlight { font-weight: 700; }
.opphub-about .quote-block { font-size: 1.15rem; font-weight: 700; color: #D32F2F; margin: 20px 0; padding: 15px 20px; border-left: 4px solid #D32F2F; background: #fff5f5; border-radius: 0 6px 6px 0; }
.opphub-about ul { margin: 10px 0 20px 20px; padding: 0; }
.opphub-about ul li { margin-bottom: 6px; font-size: 1.05rem; }
.opphub-about ul li::marker { color: #D32F2F; }
.opphub-about .belief-box { background: #1a1a2e; color: #fff; padding: 30px; border-radius: 10px; text-align: center; margin-top: 40px; }
.opphub-about .belief-box h2 { color: #D32F2F; border-bottom: none; display: block; margin-top: 0; }
.opphub-about .belief-box p { color: #ccc; font-size: 1.1rem; }
.opphub-about .belief-box .belief-main { color: #fff; font-size: 1.3rem; font-weight: 700; }
@media (max-width: 767px) {
    .opphub-about h1 { font-size: 1.6rem; }
    .opphub-about-photo { flex: 0 0 100%; max-width: 250px; margin: 0 auto 20px; }
    .opphub-about-hero { flex-direction: column; align-items: center; text-align: center; }
}
</style>

<div class="opphub-about">

    <h1>About Us</h1>
    <p class="about-subtitle">From Taxi Driver to Global Platform Builder</p>

    <div class="opphub-about-hero">
        <?php if ($founder_photo) : ?>
        <div class="opphub-about-photo">
            <img src="<?php echo esc_url($founder_photo); ?>" alt="Jeffery Dread — Founder of 48HoursReady">
        </div>
        <?php endif; ?>
        <div class="opphub-about-intro">
            <p><strong>48HoursReady</strong> was founded by <strong>Jeffery Dread</strong>, a Media &amp; Tech Visionary and entrepreneur whose journey began far from boardrooms and global institutions.</p>
            <p>Before building platforms, Jeffery worked as a taxi driver&mdash;an experience that gave him daily exposure to real human struggles, untapped talent, and one recurring truth:</p>
            <div class="quote-block">Talent exists everywhere, but access and structure do not.</div>
            <p>That insight shaped everything that followed.</p>
        </div>
    </div>

    <h2>Global Experience, Cultural Access</h2>
    <p>Jeffery later became the <strong>co-founder of CelebrityVibe</strong>, a global media platform covering major celebrity, cultural, and high-profile events worldwide. Through this work, he traveled extensively and operated on the ground at international events, interacting with globally influential figures as well as senior political leaders and heads of state in the <strong>United States, Haiti,</strong> and across <strong>Africa.</strong></p>
    <p>This exposure offered more than visibility&mdash;it revealed how <strong>networks, documentation, and formal structures</strong> quietly determine who gains access to opportunity.</p>

    <h2>Why 48HoursReady Exists</h2>
    <p>As a founder of <strong>Haitian descent</strong>, Jeffery became increasingly focused on Haiti and other emerging economies facing the same structural challenge: <strong>Over 95% of entrepreneurs operate informally</strong>, making them invisible to banks, investors, grants, institutions, and global partnerships.</p>
    <p>The issue is not lack of ideas.<br>It is lack of <strong>formalization.</strong></p>
    <p>Banks don&rsquo;t fund talent.<br>Institutions don&rsquo;t fund passion.<br>They fund <strong>structure.</strong></p>

    <h2>Our Mission</h2>
    <p><strong>48HoursReady</strong> was built to close that gap. We help entrepreneurs, students, creatives, and organizations move from the <strong>informal economy into formal systems</strong>&mdash;quickly, affordably, and professionally.</p>
    <p>In as little as <strong>48 hours</strong>, we provide:</p>
    <ul>
        <li>Bank- and investor-ready documentation</li>
        <li>Executive summaries and pitch decks</li>
        <li>Branding and business assets</li>
        <li>Video explainers and structured narratives</li>
        <li>Multilingual delivery for global access</li>
    </ul>
    <p>Our work enables access to:</p>
    <ul>
        <li>Banks and microfinance institutions</li>
        <li>Investors and sponsors</li>
        <li>NGOs and international organizations</li>
        <li>Partnerships and funding opportunities</li>
    </ul>

    <h2>The Bigger Vision</h2>
    <p>48HoursReady is not just a service&mdash;it is an <strong>economic infrastructure tool.</strong> By helping individuals and organizations formalize, we support:</p>
    <ul>
        <li>Job creation</li>
        <li>Financial inclusion</li>
        <li>Institutional access</li>
        <li>Long-term economic resilience</li>
    </ul>
    <p>One structured project at a time.</p>

    <div class="belief-box">
        <h2>Our Belief</h2>
        <p class="belief-main">Countries don&rsquo;t lack talent.<br>They lack structure.</p>
        <p>Our role is to change that.</p>
    </div>

</div>

<?php get_footer(); ?>
