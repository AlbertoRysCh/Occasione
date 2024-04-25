 
/*============================================================================*/
/* Shop-page JavaScript functions
/*============================================================================*/
(function ($, window, document, undefined) {
    'use strict'; 


    /**
     * Price Range Slider
     */
    const priceRangeSlider = function () {
        $('.price-slider-range').each(function () {
            // Get original minimum data value
            let queryMin = parseFloat($(this).data('min'));
            // Get original maximum data value
            let queryMax = parseFloat($(this).data('max'));
            // Get currency unit
            let currecyUnit = $(this).data('currency');
            // Get default minimum data value
            let defaultLow = parseFloat($(this).data('default-low'));
            // Get default maximum data value
            let defaultHigh = parseFloat($(this).data('default-high'));
            // Taking this
            let $instance = $(this);
            // Plugin invocation
            $('.price-filter').slider({
                range: true,
                min: queryMin,
                max: queryMax,
                values: [ defaultLow, defaultHigh ],
                slide: function (event, ui) {
                    let result = '<div class="price-from">'+ currecyUnit + ui.values[ 0 ] + '</div>\n<div class="price-to">' + currecyUnit + ui.values[ 1 ] + '</div>\n';
                    $instance.parent().find('.amount-result').html(result);
                }
            });


        });
    };
    

    $(function () {
        // Price Range Slider
        priceRangeSlider();
         
    });

})(jQuery, window, document);
