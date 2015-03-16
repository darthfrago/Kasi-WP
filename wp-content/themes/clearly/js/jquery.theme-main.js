/**
 * Main theme Javascript - (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */
jQuery(function($){
    // Initialize the flex slider
    $('.flexslider').flexslider({});
    
    /* Setup fitvids for entry content and panels */
    $('.entry-content, .entry-content .panel' ).fitVids();

    $('#top-slider:has(.nivoSlider)').each(function(){
        var $$ = $(this);
        var nivo = $$.find('.nivoSlider');
        nivo.nivoSlider({
            pauseTime : 60000,
            beforeChange: function(){
                $$.find('.nav-box span').animate({'opacity': 0}, 1000);
            },
            afterChange: function(){
                $$.find('.nav-box span').html(nivo.data('nivo:vars').currentImage.attr('alt')).animate({'opacity': 1}, 500);
            },
            afterLoad: function(){
                $$.find('.nav-box span').html(nivo.data('nivo:vars').currentImage.attr('alt')).animate({'opacity': 1}, 500);
            }
        });

        $$.find('.nextNav').click(function(){
            $$.find('.nivo-nextNav').click();
            return false;
        });

        $$.find('.prevNav').click(function(){
            $$.find('.nivo-prevNav').click();
            return false;
        });
    });


});