<?php
include "connection.php";

$userId = '';
$firstName = '';
$lastName = '';
$email = '';
$gender = '';
$address1 = '';
$address2 = '';
$countryId = '';
$stateId = '';
$cityId = '';
$technologies = [];
$username = '';
$profilePic = '';
$password = ''; 

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data based on user ID
    $selectQuery = "SELECT u.*, c.name AS country_name, s.name AS state_name, ci.name AS city_name 
                    FROM users u
                    LEFT JOIN country c ON u.country = c.id
                    LEFT JOIN state s ON u.state = s.id
                    LEFT JOIN city ci ON u.city = ci.id
                    WHERE u.id = '$userId'";
    $result = mysqli_query($connection, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $firstName = $userData['first_name'];
        $lastName = $userData['last_name'];
        $email = $userData['email'];
        $gender = $userData['gender'];
        $address1 = $userData['address1'];
        $address2 = $userData['address2'];
        $countryId = $userData['country']; // Set country Id
        $stateId = $userData['state']; // Set state Id
        $cityId = $userData['city']; // Set city Id
        $technologies = explode(', ', $userData['technologies']);
        $username = $userData['username'];
        $profilePic = $userData['profile_pic'];
        $password = $userData['password']; 
    } else {
       
        echo "User not found.";
    }
}


$countriesQuery = "SELECT * FROM country";
$countriesResult = mysqli_query($connection, $countriesQuery);

$statesQuery = "SELECT * FROM state WHERE country_id = '$countryId'";
$statesResult = mysqli_query($connection, $statesQuery);


$citiesQuery = "SELECT * FROM city WHERE state_id = '$stateId'";
$citiesResult = mysqli_query($connection, $citiesQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">User Registration</h1>
        <!-- Registration Form -->
        <form id="userForm" action="operation.php" method="POST" enctype="multipart/form-data"
            data-is-new-registration="<?php echo $userId ? 'false' : 'true'; ?>">
            <!-- Include a hidden field for userId -->
            <input type="hidden" name="userId" value="<?php echo $userId; ?>">

            <!-- First Name -->
            <div class="form-group">
                <label for="firstName">First Name<span class="text-danger">*</span></label>
                <input type="text" id="firstName" name="firstName" class="form-control"
                    value="<?php echo $firstName; ?>">
                <p class="error-message"></p>
            </div>
            <!-- Last Name -->
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <p class="error-message"></p>
            </div>
            <!-- Gender -->
            <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" require <?php if
                        ($gender==='male' ) echo 'checked' ; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php if
                        ($gender==='female' ) echo 'checked' ; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <p class="error-message"><small>required</small></p>

            </div>
            <!-- Address -->
            <div class="form-group">
                <label for="address1">Address Line 1<span class="text-danger">*</span></label>
                <input type="text" id="address1" name="address1" class="form-control" value="<?php echo $address1; ?>">
                <p class="error-message"></p>

            </div>
            <div class="form-group">
                <label for="address2">Address Line 2</label>
                <input type="text" id="address2" name="address2" class="form-control" value="<?php echo $address2; ?>">
            </div>

            <!-- Country  -->
            <div class="form-group">
                <label for="country">Country<span class="text-danger">*</span></label>
                <select id="country" name="country" class="form-control">
                    <option value="">Select Country</option>
                    <?php
                    while ($country = mysqli_fetch_assoc($countriesResult)) {
                        $selected = ($country['id'] == $countryId) ? 'selected' : '';
                        echo "<option value='{$country['id']}' $selected>{$country['name']}</option>";
                    }
                    ?>
                </select>
                <p class="error-message"></p>

            </div>


            <!-- State  -->
            <div class="form-group">
                <label for="state">State<span class="text-danger">*</span></label>
                <select id="state" name="state" class="form-control">
                    <option value="">Select State</option>
                    <?php
                    while ($state = mysqli_fetch_assoc($statesResult)) {
                    $selected = ($state['id'] == $stateId) ? 'selected' : '';
                    echo "<option value='{$state['id']}' $selected>{$state['name']}</option>";
                    }
                ?>
                </select>
                <p class="error-message"></p>
            </div>

            <!-- City  -->
            <div class="form-group">
                <label for="city">City<span class="text-danger">*</span></label>
                <select id="city" name="city" class="form-control">
                    <option value="">Select City</option>
                    <?php
                        while ($city = mysqli_fetch_assoc($citiesResult)) {
                        $selected = ($city['id'] == $cityId) ? 'selected' : '';
                        echo "<option value='{$city['id']}' $selected>{$city['name']}</option>";
                        }
                    ?>
                </select>
                <p class="error-message"></p>
            </div>

            <!-- Technology-->
            <div class="form-group">
                <label>Technologies</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="html" name="technologies[]" value="HTML" <?php
                        if (in_array('HTML', $technologies)) echo 'checked' ; ?>>
                    <label class="form-check-label" for="html">HTML</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="css" name="technologies[]" value="CSS" <?php if
                        (in_array('CSS', $technologies)) echo 'checked' ; ?>>
                    <label class="form-check-label" for="css">CSS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="js" name="technologies[]" value="JavaScript"
                        <?php if (in_array('JavaScript', $technologies)) echo 'checked' ; ?>>
                    <label class="form-check-label" for="js">JavaScript</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="php" name="technologies[]" value="PHP" <?php if
                        (in_array('PHP', $technologies)) echo 'checked' ; ?>>
                    <label class="form-check-label" for="php">PHP</label>
                </div>
                <p class="error-message"><small>required</small></p>

            </div>


            <!-- Username -->
            <div class="form-group">
                <label for="username">Username<span class="text-danger">*</span></label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>">
                <p class="error-message"></p>

            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <p class="error-message"></p>

            </div>
            <!-- Profile-->
            <div class="form-group">
                <label for="profilePic">Profile Picture</label><br>
                <?php if (!empty($profilePic)): ?>
                <img src="<?php echo $profilePic; ?>" alt="Profile Picture" width="100"><br>
                <label>Current Picture</label>
                <?php else: ?>
                <p>No profile picture available</p>
                <?php endif; ?>
                <input type="file" id="profilePic" name="profilePic" class="form-control-file" require>
                <p class="error-message"></p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="get_data.js"></script>
    <script src="form.js"></script>


</body>

</html>