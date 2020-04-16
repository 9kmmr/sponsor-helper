
<div>
    <div>
        <div id="img_preview_sponsor"></div>
        <button class="sponsor_helper_upload_image_button button" type="button" ><?=$button?></button>
        <input type="hidden" name="sponsor_logo" value="<?=$sponsor_logo?>">
        <button class="sponsor_helper_remove_image_button button" style="display:<?=$display?>;" type="button">Remove sponsor image</button>
    </div>
    <div>
        <div for="sponsor_name">Sponsor Name (optional):</div>
        <input type="text" name="sponsor_name" id="sponsor_name" class="newtag form-input-tip ui-autocomplete-input" value="<?=$sponsor_name?>">
    </div>
    <div>
        <div for="sponsor_url">Sponsor Link (optional):</div>
        <input type="text" name="sponsor_url" id="sponsor_url" class="newtag form-input-tip ui-autocomplete-input" value="<?=$sponsor_url?>">
    </div>
</div>

<script>

jQuery(function($){
    /*
     * Select/Upload image(s) event
     */
    $('body').on('click', '.sponsor_helper_upload_image_button', function(e){
        e.preventDefault();

            var button = $(this),
                custom_uploader = wp.media({
            title: 'Insert image',
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
        }).on('select', function() { // it also has "open" and "close" events 
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.url).next().show();
            console.log(attachment)
            /* if you sen multiple to true, here is some code for getting the image IDs
            var attachments = frame.state().get('selection'),
                attachment_ids = new Array(),
                i = 0;
            attachments.each(function(attachment) {
                attachment_ids[i] = attachment['id'];
                console.log( attachment );
                i++;
            });
            */
        })
        .open();
    });

    /*
     * Remove image event
     */
    $('body').on('click', '.sponsor_helper_remove_image_button', function(){
        $(this).hide().prev().val('').prev().addClass('button').html('Choose Sponsor Logo');
        return false;
    });

});
</script>