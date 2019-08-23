/**
 * Custom OWL in theme
 */
(function ($) {
    "use strict";
        function givingwalk_owl_flc(e) {
            var idx = $(e.target).find('.owl-item');
            idx.removeClass('crs-first crs-last'),
            idx.eq(e.item.index).addClass('crs-first'),
            idx.eq(e.item.index + idx.filter('.active').length -1).addClass('crs-last');
        }
        function is_story_carousel(owl)
        {
              var check_class = '.red-story-carousel-wrap';
                var owl = $(owl);
            if(!owl.closest(check_class).is(check_class))
                return false;
            return true;
        }
        function givingwalk_owl_fix_center_lagre(e)
        {
            var window_width = window.innerWidth;
            var owl = $(e.target);
            if(!is_story_carousel(owl))
                return;
            if(window_width < 577)
                return;
            var stage = owl.find('.owl-stage');
            var transform = stage.attr('style');
            var reg = new RegExp('translate3d\((.*)\)');
            var translate = reg.exec(transform)[0];
            var arr = translate.split('(')[1].split(')')[0];
            var xyz = arr.split(',');
            var x = parseFloat(xyz[0]);
            var center_item = stage.find('.center');
            var large_width = center_item.find('.large img').attr('width');
            var small_width = center_item.find('.small img').attr('width');
            var size_change =  ( parseFloat(large_width) - parseFloat(small_width));
            var new_x = x- size_change/2 ;
            xyz[0] = new_x+'px';
            arr = xyz.join(',');
            var new_translate = 'translate3d('+ arr +')';
            transform = transform.replace(translate,new_translate);
            stage.css('transform',new_translate);
            var width = stage.css('width');
            var new_width =( parseFloat(width)+ size_change );
            stage.css('width',new_width+'px');
        }

        function change_next_prev_background(target) {
            var next_btn = target.find('.owl-nav .owl-next')
                ,prev_item = target.find('.owl-item.active').first().prev()
                ,prev_btn = target.find('.owl-nav .owl-prev')
                ,next_item =  target.find('.owl-item.active').last().next();
            var c_item,url;
            if( next_btn.length > 0 && next_item.is('.owl-item'))
            {
                c_item = next_item.find('.entry-thumbnail img');
                if( c_item.length > 0 )
                {
                    url = 'url('+ c_item.attr('src')+')';
                }
                else{
                    url =  next_item.find('.entry-thumbnail').css('background-image');
                }
                next_btn.css('background-image',url);
            }
            else
            {
                next_btn.css('background-image','none');
            }
             if( prev_btn.length > 0 && prev_item.is('.owl-item'))
            {
                c_item = prev_item.find('.entry-thumbnail img');
                if( c_item.length > 0 )
                {
                    url = 'url('+ c_item.attr('src')+')';
                }
                else{
                    url =  prev_item.find('.entry-thumbnail').css('background-image');
                }
                prev_btn.css('background-image',url);
            }
            else
            {
                prev_btn.css('background-image','none');
            }
        }
        function init_carousel(owl)
        {
            var window_width = window.innerWidth;
            if(!owl)
                owl =  $(".red-carousel");
            owl.each(function () {
            var $this = $(this),
                slide_id = $this.attr('id'),
                slider_settings = cmscarousel[slide_id];
            if( $this.data('red-event-inited') !== 'yes')
            {
                $this.on("initialized.owl.vccarousel", function(e) {
                    var $owl =  $(e.target);
                    givingwalk_owl_flc(e);
                    givingwalk_owl_fix_center_lagre(e);
                });
            }
            
            if(window_width < 577){
                slider_settings.center = false;
                slider_settings.autoWidth = false;
            }
             
            if(is_story_carousel($this) && window_width > 576){
                slider_settings.center = true;
                slider_settings.autoWidth = true;
            }
 
            $this.vcOwlCarousel(slider_settings);
            if( $this.data('red-event-inited') == 'yes')
                return;
            $this.data('red-event-inited','yes');
            
            var changed_trigger;
            
            $this.on("changed.owl.vccarousel", function(e) {
                changed_trigger = true;
                 var $owl =  $(e.target);
                givingwalk_owl_flc(e)
            
            })
            $this.on("translated.owl.vccarousel resized.owl.vccarousel", function(e) {
                if(changed_trigger)
                {
                    changed_trigger = false;
                    givingwalk_owl_fix_center_lagre(e);
                }
            })
            if($this.hasClass('next-prev-image'))
            {
                change_next_prev_background($this);
                $this.on('translated.owl.vccarousel', function () {
                    change_next_prev_background($this);
                });
            }
        });
        }
    var refresh_carousel = '';
    function trigger_refresh_carousel()
    {
        clearTimeout(refresh_carousel);
        refresh_carousel = setTimeout(function () {
            $(".red-carousel").each(function () {
               var owl = $(this);
               if(is_story_carousel(owl))
               {
                    owl.trigger('destroy.owl.vccarousel');
                    init_carousel(owl);
               }
            });
  
        },300);
    }
    $(window).on('resize',function(e) {
        trigger_refresh_carousel();
    })
    $(window).on('load',function () {
        init_carousel();
    });
})(jQuery)
