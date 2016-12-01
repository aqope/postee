document.observe("dom:loaded", function() {
    if ($('login-form') != null) {
        $$('input[name="pass"]')[0].value = "";
        new loginForm();
    }
});

var loginForm = Class.create();
loginForm.prototype = {
    initialize: function () {
        var _this = this,
            submitButton = $('submit-form'),
            submitForm = $('login-form');
        Event.observe(submitButton, 'click', function (event) {
            Event.stop(event);
            if (_this.verify()) {
                var passHolder = $$('input[type="password"]')[0];
                var pass = $$('input[name="pass"]')[0];
                pass.value = hex_md5(passHolder.value);
                submitForm.submit();
            }
        });
    },
    // Verifies Input fields
    verify: function() {
        return $$('input[name="user"]')[0].value !== "" && 
            $$('input[type="password"]')[0].value !== "";
    }
};
