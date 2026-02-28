<?php
/**
 * Partial: Single Opportunity Card
 */
$funding_min   = get_post_meta(get_the_ID(), '_opphub_funding_min', true);
$funding_max   = get_post_meta(get_the_ID(), '_opphub_funding_max', true);
$deadline      = get_post_meta(get_the_ID(), '_opphub_deadline', true);
$status        = get_post_meta(get_the_ID(), '_opphub_status', true) ?: 'open';
$apply_url     = get_post_meta(get_the_ID(), '_opphub_apply_url', true);
$institutions  = get_the_terms(get_the_ID(), 'institution');
$regions       = get_the_terms(get_the_ID(), 'region');
$funding_types = get_the_terms(get_the_ID(), 'funding_type');
$sectors       = get_the_terms(get_the_ID(), 'sector');

$status_labels = [
    'open'         => 'Open',
    'closing_soon' => 'Closing Soon',
    'closed'       => 'Closed',
];
$status_label = $status_labels[$status] ?? 'Open';
?>
<div class="opphub-card">
    <div class="opphub-card-header">
        <?php if ($institutions && !is_wp_error($institutions)) : ?>
            <span class="opphub-card-institution"><?php echo esc_html($institutions[0]->name); ?></span>
        <?php endif; ?>
        <span class="opphub-card-status opphub-status-<?php echo esc_attr($status); ?>"><?php echo esc_html($status_label); ?></span>
    </div>

    <h3 class="opphub-card-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <?php if (has_excerpt()) : ?>
        <p class="opphub-card-desc"><?php echo esc_html(get_the_excerpt()); ?></p>
    <?php endif; ?>

    <div class="opphub-card-meta">
        <?php if ($funding_min || $funding_max) : ?>
            <div class="opphub-card-meta-item">
                <span class="opphub-meta-icon">&#128176;</span>
                <span>$<?php echo number_format((int)$funding_min); ?> &ndash; $<?php echo number_format((int)$funding_max); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($regions && !is_wp_error($regions)) : ?>
            <div class="opphub-card-meta-item">
                <span class="opphub-meta-icon">&#127758;</span>
                <span><?php echo esc_html(implode(', ', wp_list_pluck($regions, 'name'))); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($deadline) : ?>
            <div class="opphub-card-meta-item">
                <span class="opphub-meta-icon">&#128197;</span>
                <span><?php echo esc_html(date('F j, Y', strtotime($deadline))); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($funding_types && !is_wp_error($funding_types)) : ?>
            <div class="opphub-card-meta-item">
                <span class="opphub-meta-icon">&#128204;</span>
                <span><?php echo esc_html(implode(', ', wp_list_pluck($funding_types, 'name'))); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($sectors && !is_wp_error($sectors)) : ?>
            <div class="opphub-card-meta-item">
                <span class="opphub-meta-icon">&#127981;</span>
                <span><?php echo esc_html(implode(', ', wp_list_pluck($sectors, 'name'))); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="opphub-card-actions">
        <a href="<?php the_permalink(); ?>" class="opphub-btn opphub-btn-red opphub-btn-sm">View Details</a>
        <?php if ($apply_url) : ?>
            <a href="<?php echo esc_url($apply_url); ?>" class="opphub-btn opphub-btn-blue opphub-btn-sm" target="_blank">Apply Now</a>
        <?php endif; ?>
    </div>
</div>
