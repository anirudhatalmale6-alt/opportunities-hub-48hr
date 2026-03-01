/**
 * 48HoursReady Opportunities Hub — Filter & AJAX
 */
(function($) {
    'use strict';

    var $form     = $('#opphub-filter-form');
    var $cards    = $('#opphub-cards');
    var $count    = $('#opphub-count');
    var $clear    = $('#opphub-clear-filters');

    // Submit filter form via AJAX
    $form.on('submit', function(e) {
        e.preventDefault();
        applyFilters(true);
    });

    // Clear all filters
    $clear.on('click', function() {
        $form.find('select').val('');
        applyFilters();
    });

    function applyFilters(scrollToResults) {
        var data = {
            action:          'opphub_filter',
            nonce:           opphub_ajax.nonce,
            institution:     $('#filter-institution').val(),
            funding_type:    $('#filter-funding-type').val(),
            region:          $('#filter-region').val(),
            sector:          $('#filter-sector').val(),
            deadline_status: $('#filter-deadline').val(),
            funding_size:    $('#filter-funding-size').val()
        };

        $cards.html('<div class="opphub-loading" style="text-align:center;padding:40px;color:#666;">Loading...</div>');

        $.post(opphub_ajax.ajax_url, data, function(response) {
            if (response.success) {
                $cards.html(response.data.html);
                $count.text(response.data.count);
                if (scrollToResults) {
                    $('html, body').animate({
                        scrollTop: $('#opphub-opportunities').offset().top - 20
                    }, 400);
                }
            } else {
                $cards.html('<div class="opphub-no-results"><p>Something went wrong. Please try again.</p></div>');
            }
        }).fail(function() {
            $cards.html('<div class="opphub-no-results"><p>Connection error. Please try again.</p></div>');
        });
    }

    // Smooth scroll for "Explore Opportunities" button
    $('a[href="#opphub-opportunities"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#opphub-opportunities').offset().top - 80
        }, 500);
    });

    // Auto-load opportunities on page load (bypasses Cloudflare page cache)
    applyFilters();

})(jQuery);
