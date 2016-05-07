jQuery(document).ready(function() {
	jQuery('.teo_upload_image_button').on('click', function(e) {
		e.preventDefault();
	    var formfield = null;
     	var wireframe;
     	var $this = jQuery(this);
     	if (wireframe) {
            wireframe.open();
            return;
        }
        wireframe = wp.media.frames.wireframe = wp.media({
            title: 'Choose image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        wireframe.on('select', function() {
            attachment = wireframe.state().get('selection').first().toJSON();
            $this.parent().find('.image-input').val(attachment.url);
        });

        wireframe.open();
	});
});