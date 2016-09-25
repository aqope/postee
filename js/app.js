document.observe("dom:loaded", function() {
    if ($('login-form') != null) {
        $$('input[name="pass"]')[0].value = "";
        new loginForm();
    }
});

var loginForm = Class.create();
loginForm.prototype = {
    initialize: function () {
        var _this = this;
        var submitButton = $('submit-form');
        var submitForm = $('login-form');
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
        var userInput = $$('input[name="user"]')[0];
        var passInput = $$('input[type="password"]')[0];

        if (userInput.value == "") {
            console.log('Username is empty');
            return false;
        }

        if(passInput.value == "") {
            console.log('Password is empty');
            return false;
        }

        return true;
    }
};