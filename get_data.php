<?php

include_once('connection.php');


if(isset($_POST['request_type']) && !empty($_POST['request_type'])) {
    $requestType = $_POST['request_type'];

    // Fetch data
    switch ($requestType) {
        case 'countries':
            $countryQuery = "SELECT id, name FROM country";
            $countryResult = $connection->query($countryQuery);

            if ($countryResult) {
                $countries = $countryResult->fetch_all(MYSQLI_ASSOC);
                echo json_encode($countries);
            } else {
                echo json_encode(array()); 
            }
            break;

        case 'states':
            if(isset($_POST['country_id'])) {
                $countryId = $_POST['country_id'];
                $stateQuery = "SELECT id, name FROM state WHERE country_id = ?";
                $stateStmt = $connection->prepare($stateQuery);
                $stateStmt->bind_param("i", $countryId);
                $stateStmt->execute();
                $stateResult = $stateStmt->get_result();

                if ($stateResult) {
                    $states = $stateResult->fetch_all(MYSQLI_ASSOC);
                    echo json_encode($states);
                } else {
                    echo json_encode(array()); 
                }
                $stateStmt->close();
            } else {
                echo json_encode(array()); 
            }
            break;

        case 'cities':
            if(isset($_POST['state_id'])) {
                $stateId = $_POST['state_id'];
                $cityQuery = "SELECT id, name FROM city WHERE state_id = ?";
                $cityStmt = $connection->prepare($cityQuery);
                $cityStmt->bind_param("i", $stateId);
                $cityStmt->execute();
                $cityResult = $cityStmt->get_result();

                if ($cityResult) {
                    $cities = $cityResult->fetch_all(MYSQLI_ASSOC);
                    echo json_encode($cities);
                } else {
                    echo json_encode(array()); 
                }
                $cityStmt->close();
            } else {
                echo json_encode(array()); 
            }
            break;

        default:
            echo json_encode(array()); 
            break;
    }
} else {
    echo json_encode(array()); 
}


$connection->close();
?>
