//quantity number field custom
jQuery(document).ready(function ($) {
    "use strict";
    $('<span class="quantity-button quantity-up"><i class="fa fa-caret-up"></i></span>').insertBefore('.quantity input');
    $('<span class="quantity-button quantity-down"><i class="fa fa-caret-down"></i></span>').insertAfter('.quantity input');
    $(document).on('click','.quantity .quantity-button',function () {
        var $this = $(this),
            spinner = $this.closest('.quantity'),
            input = spinner.find('input[type="number"]'),
            step = input.attr('step'),
            min = input.attr('min'),
            max = input.attr('max'),value = parseInt(input.val());
        if(!value) value = 0;
        if(!step) step=1;
        step = parseInt(step);
        if (!min) min = 0;
        var type = $this.hasClass('quantity-up') ? 'up' : 'down' ;
        switch (type)
        {
            case 'up':
                if(!(max && value >= max))
                    input.val(value+step).change();
                break;
            case 'down':
                if (value > min)
                    input.val(value-step).change();
                break;
        }
        if(max && (parseInt(input.val()) > max))
            input.val(max).change();
        if(parseInt(input.val()) < min)
            input.val(min).change();
    });
});
