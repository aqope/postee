/**
 * Object with functions for form validation.
 *
 * @type {{validateForm: validate.validateForm}}
 */
var validate = {
    validateForm: function(formClass, className) {
        jQuery("." + formClass).submit(function (form) {
            var formInput;
            jQuery(":input.required").each(function () {
                formInput = jQuery(this);
                if(!formInput.val()) {
                    formInput.addClass(className);
                    form.preventDefault();
                } else {
                    formInput.removeClass(className)
                }
            });
        })
    }
};
