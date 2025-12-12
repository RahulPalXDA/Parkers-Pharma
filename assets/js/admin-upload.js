jQuery(document).ready(function ($) {
    // Image upload handler
    function parkers_media_upload(button_class, input_id, wrapper_id, remove_button_id) {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
        $('body').on('click', button_class, function (e) {
            var button = $(this);
            _custom_media = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_custom_media) {
                    $(input_id).val(attachment.id);
                    $(wrapper_id).html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    $(wrapper_id + ' .custom_media_image').attr('src', attachment.url).css('display', 'block');
                    $(remove_button_id).show();
                } else {
                    return _orig_send_attachment.apply(this, [props, attachment]);
                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }

    // Category Image
    parkers_media_upload('.parkers_media_button', '#category-image-id', '#category-image-wrapper', '#parkers_media_remove');
    $('body').on('click', '.parkers_media_remove', function () {
        $('#category-image-id').val('');
        $('#category-image-wrapper').html('');
        $(this).hide();
    });

    // Banner Image
    parkers_media_upload('.parkers_banner_button', '#category-banner-id', '#category-banner-wrapper', '#parkers_banner_remove');
    $('body').on('click', '.parkers_banner_remove', function () {
        $('#category-banner-id').val('');
        $('#category-banner-wrapper').html('');
        $(this).hide();
    });
});
