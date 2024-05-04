
    $(document).ready(function () {
        // Fetch countries and populate the country dropdown
        // $.ajax({
        //     url: 'get_data.php',
        //     type: 'POST',
        //     data: { request_type: 'countries' },
        //     dataType: 'json',
        //     success: function (data) {
        //         var countryDropdown = $('#country');
        //         countryDropdown.empty();
        //         countryDropdown.append('<option value="">Select Country</option>');
        //         $.each(data, function (index, country) {
        //             countryDropdown.append('<option value="' + country.id + '">' + country.name + '</option>');
        //         });
        //     }
        // });

        // Event handler for country dropdown change
        $('#country').on('change', function () {
            var countryId = $(this).val();
            if (countryId) {
                // Fetch states based on the selected country
                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { request_type: 'states', country_id: countryId },
                    dataType: 'json',
                    success: function (data) {
                        var stateDropdown = $('#state');
                        stateDropdown.empty();
                        stateDropdown.append('<option value="">Select State</option>');
                        $.each(data, function (index, state) {
                            stateDropdown.append('<option value="' + state.id + '">' + state.name + '</option>');
                        });
                    }
                });
            }
        });

        // Event handler for state dropdown change
        $('#state').on('change', function () {
            var stateId = $(this).val();
            if (stateId) {
                // Fetch cities based on the selected state
                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { request_type: 'cities', state_id: stateId },
                    dataType: 'json',
                    success: function (data) {
                        var cityDropdown = $('#city');
                        cityDropdown.empty();
                        cityDropdown.append('<option value="">Select City</option>');
                        $.each(data, function (index, city) {
                            cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    }
                });
            }
        });
    });
