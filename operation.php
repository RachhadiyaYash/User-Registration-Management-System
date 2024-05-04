<?php
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form data includes a userId (for update) or not (for registration)
    if (!empty($_POST['userId'])) {
        // Update existing user data
        $userId = $_POST['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $countryId = $_POST['country'];
        $stateId = $_POST['state'];
        $cityId = $_POST['city'];
        $technologies = isset($_POST['technologies']) ? implode(', ', $_POST['technologies']) : '';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $profilePic = '';

        // Upload profile picture if provided
        if ($_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
            $profilePicName = $_FILES['profilePic']['name'];
            $profilePicTmpName = $_FILES['profilePic']['tmp_name'];
            $profilePic = "uploads/" . $profilePicName;
            move_uploaded_file($profilePicTmpName, $profilePic);
        }

        // Update user data in the database
        $updateQuery = "UPDATE users SET 
                        first_name = '$firstName', 
                        last_name = '$lastName', 
                        email = '$email', 
                        gender = '$gender', 
                        address1 = '$address1', 
                        address2 = '$address2', 
                        country = '$countryId', 
                        state = '$stateId', 
                        city = '$cityId', 
                        technologies = '$technologies', 
                        username = '$username', 
                        password = '$password', 
                        profile_pic = '$profilePic' 
                        WHERE id = '$userId'";

        if (mysqli_query($connection, $updateQuery)) {
            echo "User updated successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating user: " . mysqli_error($connection);
        }
    } else {
        // Register new user
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $countryId = $_POST['country'];
        $stateId = $_POST['state'];
        $cityId = $_POST['city'];
        $technologies = isset($_POST['technologies']) ? implode(', ', $_POST['technologies']) : '';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $profilePic = '';

        // Upload profile picture if provided
        if ($_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
            $profilePicName = $_FILES['profilePic']['name'];
            $profilePicTmpName = $_FILES['profilePic']['tmp_name'];
            $profilePic = "uploads/" . $profilePicName;
            move_uploaded_file($profilePicTmpName, $profilePic);
        }

        // Insert user data into the database
        $insertQuery = "INSERT INTO users (first_name, last_name, email, gender, address1, address2, country, state, city, technologies, username, password, profile_pic) 
                        VALUES ('$firstName', '$lastName', '$email', '$gender', '$address1', '$address2', '$countryId', '$stateId', '$cityId', '$technologies', '$username', '$password', '$profilePic')";

        if (mysqli_query($connection, $insertQuery)) {
            echo "User registered successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error registering user: " . mysqli_error($connection);
        }
    }
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: register.php");
    exit;
}
?>
