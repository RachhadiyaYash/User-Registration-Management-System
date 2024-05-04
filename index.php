
<?php
include "connection.php";
// Check if the delete request is sent via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    // Prepare delete query
    $deleteQuery = "DELETE FROM users WHERE id = '$id'";

    // Execute the delete query
    if (mysqli_query($connection, $deleteQuery)) {
        echo 'success';
    } else {
        echo 'error';
    }
    exit; // Terminate the script after handling the AJAX request
}

// Initialize variables for search and user count
$searchQuery = '';
$userCount = 0;

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchKeyword'])) {
    // Get search keyword
    $searchKeyword = $_POST['searchKeyword'];

    // Prepare search query
    $searchQuery = " WHERE u.first_name LIKE '%$searchKeyword%' OR u.last_name LIKE '%$searchKeyword%'";

    // Retrieve user count based on search
    $userCountQuery = "SELECT COUNT(*) AS total FROM users u" . $searchQuery;
    $userCountResult = mysqli_query($connection, $userCountQuery);
    $userCountData = mysqli_fetch_assoc($userCountResult);
    $userCount = $userCountData['total'];
}

// Query to retrieve user records with actual country, state, and city names
$query = "SELECT u.*, 
            c.name AS country_name, 
            s.name AS state_name, 
            ci.name AS city_name 
          FROM users u
          LEFT JOIN country c ON u.country = c.id
          LEFT JOIN state s ON u.state = s.id
          LEFT JOIN city ci ON u.city = ci.id
          $searchQuery"; 
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">

</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-2  text-center" id="textheader">User Data</h1>
        <p class="text-right"> <strong>User Count:</strong>
            <?php echo $userCount; ?>
        </p>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <button class="btn btn-outline-primary btn-sm" type="button" onclick="clearSearch()">Show All</button>
            <a href="register.php" class="btn btn-sm btn-outline-primary">Register</a>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="searchKeyword">
                    <div class="input-group-append">
                        <button class="btn  btn-sm btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
     
    </div>


        <div class="container-fluid">
            <div class="table-responsive" >

                <table class='table table-striped table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Technology</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $address = $row['address1'] . ", " . $row['address2'] . ", " . $row['city_name'] . ", " . $row['state_name'] . ", " . $row['country_name'] . " ." ;
                            $technologies = implode(", ", explode(",", $row['technologies']));

                            echo "<tr>
                                    <td>{$row['first_name']} {$row['last_name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$address}</td>
                                    <td>{$technologies}</td>
                                    <td>{$row['username']}</td>
                                    <td>
                                    <a href='register.php?id={$row['id']}' class='btn btn-primary btn-sm btn-block' id='updatebutton'>Edit</a>

                                   
                                    <button class='btn btn-danger btn-sm btn-block' id='deletebutton' onclick='deleteUser({$row['id']})'>Delete</button>
                                </td>
                                
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No user records found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    
    <script>
        function clearSearch() {
            document.querySelector("input[name='searchKeyword']").value = '';
            document.querySelector("form").submit();
        }

        // Function to delete a user record
        function deleteUser(id) {
            // Display a confirmation dialog with Cancel and Continue options
            if (confirm('Are you sure you want to delete this user?')) {
                // If the user chooses to continue (by clicking OK)
                // AJAX request to delete the user record
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            if (xhr.responseText === 'success') {
                                // Reload the page after successful deletion
                                location.reload();
                            } 
                        }
                    }
                };
                xhr.send('action=delete&id=' + id);
            }
        }

    </script>

</body>

</html>