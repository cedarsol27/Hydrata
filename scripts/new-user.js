$(document).ready(function() {
    $("#signup_form").validate({
        rules: {
            password: {
                minlength: 6
            },
            confirm_password: {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                minlength: "Passwords must be at least 6 characters"
            },
            confirm_password: {
                minlength: "Passwords must be at least 6 characters",
                rqualTo: "Your passwords do not match."
            }
        }
    });
});

function ValidateEmail(inputText) {
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(inputText.value.match(mailformat)) {
        alert("User created. Clicking okay will take you to the login screen.");
        document.signup_form.email.focus();
        return true;
    }
    else {
        alert("You have entered an invalid email address!");
        document.signup_form.email.focus();
        return false;
    }
}