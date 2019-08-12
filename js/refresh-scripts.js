(function ($) {
    function forceReloadJS(srcUrlContains) {
        $.each($('script:empty[src*="' + srcUrlContains + '"]'), function(index, el) {
            var oldSrc = $(el).attr('src');
            var t = +new Date();
            var newSrc = oldSrc + '?' + t;

            console.log(oldSrc, ' to ', newSrc);

            $(el).remove();
            $('<script/>').attr('src', newSrc).appendTo('head');
        });
    }
    forceReloadJS('/maps/');
})(jQuery);