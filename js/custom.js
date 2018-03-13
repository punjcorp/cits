$(function() {
    // Bind to the submit event of our form
    $('#submitBtn').click(function() {
        // setup some local variables
        var $form = $('#contactForm');
        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");
        // Serialize the data in the form
        var serializedData = $form.serialize();
        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);
        $.post("pages/messages/verify.php", serializedData).done(function(results) {
            try {
                var item = JSON.parse(results);
                if (item[0].status) {
                    $('#resultSpan').attr({
                        class: "alert alert-success"
                    });
                    $('#resultSpan').html(item[0].status);
                } else {
                    $('#resultSpan').attr({
                        class: "alert alert-danger"
                    });
                    $('#resultSpan').html(item[0].error);
                    $inputs.prop("disabled", false);
                }
            } catch (e) {
                $('#resultSpan').attr({
                    class: "alert alert-danger"
                });
                $('#resultSpan').html('Error saving your message!!');
                $inputs.prop("disabled", false);
            }

        });
    });


    var mapUrl='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1714.5526009670846!2d76.64734762473206!3d30.743546298089093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feffbc5ea9bed%3A0x499ff51496e7d471!2sConsult+for+IT+Solutions!5e0!3m2!1sen!2sin!4v1519463191046';
    $('#workMapLocation').attr('src', mapUrl);


});