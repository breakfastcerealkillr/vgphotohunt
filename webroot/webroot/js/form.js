$(document).ready(function () {
    $('#form-submit').click(function () {
        var form = $(this).closest('.modal-content').find('form');
        var url = form.attr('action');
        var data = form.serialize();
        $.ajax({
            url: url,
            type: "POST",
            // Note => explicit X-CSRF header disabled for now because we are
            // passing the token as part of the form fields as well.
            // headers: {
            // 'X-CSRF-Token': $('input[name="_csrfToken"]').attr('value')
            // },
            data: data
        })
                .fail(function (msg) {
                    var response = msg.responseJSON;
                    var validationErrors = response.validation_errors;
                    clearFormFeedback(form);
                    // Display error message only if all fields validated
                    if (!validationErrors) {
                        setFormToValidated(form);
                        form.find('.alert > span').html(response.message);
                        form.find('.alert').show();
                        return;
                    }
                    // One or more fields did not pass validation
                    var inputs = form.find(".form-group.has-feedback :input");
                    $.each(inputs, function (index, input) {
                        var formGroup = $('input[name="' + input.name + '"]').closest('.form-group');
                        // set to success if no validation errors are set
                        if (!validationErrors[input.name]) {
                            formGroup.addClass('has-success');
                            formGroup.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>');
                            return true;
                        }
                        // set validation errors
                        var list = '';
                        $.each(validationErrors[input.name], function (validationRule, validationMessage) {
                            list += '<li>' + validationMessage + '</li>';
                        });
                        formGroup.addClass('has-error');
                        formGroup.append('<span class="fa fa-times form-control-feedback" aria-hidden="true"></span>');
                        formGroup.append('<span class="help-block"><ul class="list-unstyled">' + list + '</span>');
                    });
                })
                .success(function (msg) {
                    window.location.href = window.location.href + "?success";
                    location.reload();
                });
    });
});
