/**
 * 48HoursReady Opportunities Hub — Filter & AJAX (v2.9)
 */
(function($) {
    'use strict';

    var $form     = $('#opphub-filter-form');
    var $cards    = $('#opphub-cards');
    var $count    = $('#opphub-count');
    var $clear    = $('#opphub-clear-filters');

    // 1. Dynamically populate filter dropdowns via AJAX (bypasses Cloudflare HTML cache)
    if (typeof opphub_ajax !== 'undefined') {
        $.post(opphub_ajax.ajax_url, {action: 'opphub_get_options'}, function(r) {
            if (!r.success) return;
            var opts = r.data;
            var map = {
                institution: '#filter-institution',
                funding_type: '#filter-funding-type',
                region: '#filter-region',
                sector: '#filter-sector'
            };
            for (var tax in map) {
                var $sel = $(map[tax]);
                if (!$sel.length || !opts[tax]) continue;
                var cur = $sel.val();
                var firstText = $sel.find('option:first').text();
                $sel.empty().append('<option value="">' + firstText + '</option>');
                for (var i = 0; i < opts[tax].length; i++) {
                    $sel.append('<option value="' + opts[tax][i].slug + '">' + opts[tax][i].name + '</option>');
                }
                if (cur) $sel.val(cur);
            }
        });
    }

    // 2. Submit filter form via AJAX
    $form.on('submit', function(e) {
        e.preventDefault();
        applyFilters(true);
    });

    // 3. Clear all filters
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

    // 4. Auto-load opportunities on page load (bypasses Cloudflare page cache)
    applyFilters();

})(jQuery);
