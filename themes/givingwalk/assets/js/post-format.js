/**
 * Created by FOX on 2/22/2016.
 */
jQuery(document).ready(function($) {
    "use strict";
    $('#post-formats-select').on('click', '.post-format', function () {
        var post_formart = $(this).val();
        get_post_fields(post_formart);
    });

    $(window).on('load', function(){
        setTimeout(function(){
            $('.post-format').each(function(){
                if($(this).prop( "checked" )){
                    get_post_fields($(this).val());
                }
            });
        }, 0);
    });

    function get_post_fields(_formart){
        switch (_formart){
            case 'video':
                $('#_box__page_post_format_options').css('display', 'block');
                $('#_box__page_post_format_options').find('table tr').css('display', 'none');
                $('#opt_format_video_type-select').val($('#opt_format_video_type-select').val());
                $('#opt_format_video_type-select').trigger('change');
                $('fieldset[data-id="opt_format_video_type"]').parents('tr').attr('style', '');
                break;
            case 'audio':
                $('#_box__page_post_format_options').css('display', 'block');
                $('#_box__page_post_format_options').find('table tr').css('display', 'none');
                $('#opt_format_audio_type-select').val($('#opt_format_audio_type-select').val());
                $('#opt_format_audio_type-select').trigger('change');
                $('fieldset[data-id="opt_format_audio_type"]').parents('tr').attr('style', '');
                break;
            case 'gallery':
                $('#_box__page_post_format_options').css('display', 'block');
                $('#_box__page_post_format_options').find('table tr').css('display', 'none');
                $('fieldset[data-id="opt_format_gallery"]').parents('tr').attr('style', '');
                break;
            case 'quote':
                $('#_box__page_post_format_options').css('display', 'block');
                $('#_box__page_post_format_options').find('table tr').css('display', 'none');
                $('fieldset[data-id="opt_format_quote_title"]').parents('tr').attr('style', '');
                $('fieldset[data-id="opt_format_quote_content"]').parents('tr').attr('style', '');
                break;
            case 'link':
                $('#_box__page_post_format_options').css('display', 'block');
                $('#_box__page_post_format_options').find('table tr').css('display', 'none');
                $('fieldset[data-id="opt_format_link_text"]').parents('tr').attr('style', '');
                $('fieldset[data-id="opt_format_link_url"]').parents('tr').attr('style', '');
                break;
            default:
                $('#_box__page_post_format_options').css('display', 'none');
        }
    }
});