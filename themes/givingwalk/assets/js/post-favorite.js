! function(a) {
    "use strict";
    jQuery(document).ready(function(a) {
        a("body").on("click", ".nectar-love", function() {
            var b = a(this),
                c = a(this).attr("id");
            a(this);
            if (b.hasClass("loved")) return !1;
            if (a(this).hasClass("inactive")) return !1;
            var e = {
                action: "nectar-love",
                loves_id: c
            };
            return a.post(nectarLove.ajaxurl, e, function(a) {
                b.find("span").html(a), b.addClass("loved").attr("title", "You already liked this!")
            }), a(this).addClass("inactive"), !1
        })
    })
}(jQuery);