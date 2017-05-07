(function(window, document, jQuery, undefined) {
    var jqmReady    = false,
        pgReady     = false,
        callbacks   = [];

    document.addEventListener("deviceready", onDeviceReady, false);
    function onDeviceReady() {
        pgReady = true;
        checkPhoneReady();
    }

    jQuery(document).bind('pageinit', function() {
        jqmReady = true;
        checkPhoneReady();
    });

    jQuery.phoneReady = jQuery.phoneready = jQuery.fn.phoneReady = jQuery.fn.phoneready = function(cb) {
        if (typeof(cb) !== 'function') throw 'phoneReady must be passed a callback';
        if (pgReady && jqmReady) return cb();
        callbacks.push(cb);
    }

    function checkPhoneReady() {
        if (pgReady && jqmReady && 0 !== callbacks.length) {
            for (var i = 0, il = callbacks.length; i < il; i++) {
                callbacks[i].call();
            }
            callbacks.length = 0;
        }
    }
})(window, document, jQuery);