$(document).ready(function() {
    // Function to validate email address
    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    // Function to validate if a field is empty
    function isEmpty(value) {
        return value.trim() === '';
    }

    // Function to validate if a field contains only alphabetic characters
    function isAlphabetic(value) {
        var re = /^[A-Za-z]+$/;
        return re.test(value);
    }

    // Function to display error message
    function displayError(inputField, errorMessage) {
        var errorElement = $(inputField).siblings('.error-message');
        errorElement.text(errorMessage);
        errorElement.css('color', 'red');
    }

    // Function to clear error message
    function clearError(inputField) {
        var errorElement = $(inputField).siblings('.error-message');
        errorElement.text('');
    }

    // Validate form on submission
    $('#userForm').submit(function(event) {
        var isValid = true;

        // First Name validation (only alphabetic characters, no spaces allowed)
        var firstName = $('#firstName').val();
        if (!isAlphabetic(firstName)) {
            displayError('#firstName', 'First Name should contain only alphabetic characters');
            isValid = false;
        } else {
            clearError('#firstName');
        }

        // Email validation
        var email = $('#email').val();
        if (!validateEmail(email)) {
            displayError('#email', 'Please enter a valid email address');
            isValid = false;
        } else {
            clearError('#email');
        }

        // Gender validation
        var genderSelected = $('input[name="gender"]:checked').length > 0;
        if (!genderSelected) {
            displayError('.form-group.gender', 'Please select a gender');
            isValid = false;
        } else {
            clearError('.form-group.gender');
        }

        // Address Line 1 validation
        var address1 = $('#address1').val();
        if (isEmpty(address1)) {
            displayError('#address1', 'Address Line 1 is required');
            isValid = false;
        } else {
            clearError('#address1');
        }

        // Country validation
        var country = $('#country').val();
        if (isEmpty(country)) {
            displayError('#country', 'Country is required');
            isValid = false;
        } else {
            clearError('#country');
        }

        // State validation
        var state = $('#state').val();
        if (isEmpty(state)) {
            displayError('#state', 'State is required');
            isValid = false;
        } else {
            clearError('#state');
        }

        // City validation
        var city = $('#city').val();
        if (isEmpty(city)) {
            displayError('#city', 'City is required');
            isValid = false;
        } else {
            clearError('#city');
        }

        // Technologies validation
        var technologiesSelected = $('input[name="technologies[]"]:checked').length > 0;
        if (!technologiesSelected) {
            displayError('.form-group.technologies', 'Please select at least one technology');
            isValid = false;
        } else {
            clearError('.form-group.technologies');
        }

        // Username validation
        var username = $('#username').val();
        if (isEmpty(username)) {
            displayError('#username', 'Username is required');
            isValid = false;
        } else {
            clearError('#username');
        }

        // Password validation
        var password = $('#password').val();
        if (isEmpty(password)) {
            displayError('#password', 'Password is required');
            isValid = false;
        } else {
            clearError('#password');
        }

        // Profile Picture validation
        var isNewRegistration = $('#userForm').data('is-new-registration') === 'true';
        var profilePic = $('#profilePic').val();
        if (isEmpty(profilePic)) {
            displayError('#profilePic', 'Profile Picture is required');
            isValid = false;
        } else {
            clearError('#profilePic');
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
});
