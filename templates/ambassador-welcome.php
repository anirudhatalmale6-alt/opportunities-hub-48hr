<?php
/**
 * Template: Ambassador Welcome / Next Steps Page
 * Shown after successful ambassador signup.
 */
get_header();
$payout_url = home_url('/affiliate-payout-information/');
?>

<div id="opphub-ambassador-welcome">

    <!-- ===== HERO ===== -->
    <section class="opphub-amb-hero">
        <div class="opphub-container">
            <div class="opphub-amb-check">&#10003;</div>
            <h1 class="opphub-amb-title">You're In! Welcome to the Team.</h1>
            <p class="opphub-amb-subtitle">Your ambassador application has been received. Let's get you set up so you can start earning.</p>
        </div>
    </section>

    <!-- ===== NEXT STEPS ===== -->
    <section class="opphub-amb-steps">
        <div class="opphub-container">
            <h2 class="opphub-amb-steps-title">Complete Your Setup</h2>
            <div class="opphub-amb-steps-grid">
                <div class="opphub-amb-step opphub-amb-step-done">
                    <div class="opphub-amb-step-num">1</div>
                    <h3>Sign Up</h3>
                    <p>Application submitted successfully.</p>
                    <span class="opphub-amb-step-badge">&#10003; Done</span>
                </div>
                <div class="opphub-amb-step opphub-amb-step-active">
                    <div class="opphub-amb-step-num">2</div>
                    <h3>Set Up Payout</h3>
                    <p>Tell us how you'd like to receive your commissions (MonCash, NatCash, Bank Transfer, or PayPal).</p>
                    <a href="<?php echo esc_url($payout_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg opphub-amb-cta-btn">Complete Your Payout Setup</a>
                </div>
                <div class="opphub-amb-step">
                    <div class="opphub-amb-step-num">3</div>
                    <h3>Start Referring</h3>
                    <p>Share your link and earn commissions on every successful referral.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== KEY INFO ===== -->
    <section class="opphub-amb-info">
        <div class="opphub-container">
            <div class="opphub-amb-info-grid">
                <div class="opphub-amb-info-card">
                    <div class="opphub-amb-info-icon">&#128176;</div>
                    <h3>Monthly Payouts</h3>
                    <p>Commissions are paid monthly via your chosen payout method.</p>
                </div>
                <div class="opphub-amb-info-card">
                    <div class="opphub-amb-info-icon">&#128279;</div>
                    <h3>Your Referral Link</h3>
                    <p>You'll receive your unique referral link via email shortly.</p>
                </div>
                <div class="opphub-amb-info-card">
                    <div class="opphub-amb-info-icon">&#128231;</div>
                    <h3>Check Your Email</h3>
                    <p>A confirmation email with next steps has been sent to you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FINAL CTA ===== -->
    <section class="opphub-cta-package">
        <div class="opphub-container">
            <div class="opphub-package-box">
                <h2>Don't Forget: Set Up Your Payout</h2>
                <p style="color:rgba(255,255,255,0.9);margin:0 0 24px;font-size:16px;">Complete this step now so we can pay you as soon as your first referral converts.</p>
                <a href="<?php echo esc_url($payout_url); ?>" class="opphub-btn opphub-btn-red opphub-btn-lg">Complete Payout Setup Now</a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
