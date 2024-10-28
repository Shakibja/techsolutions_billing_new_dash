

<?php
include('includes/config.php');

// Get the user ID from POST request
$userId = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($userId > 0) {
    // Prepare and execute the SQL statement
    $stmt = $con->prepare("SELECT * FROM service_name WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $userData = $result->fetch_assoc();
        // Return the data as JSON
        echo json_encode([
            "status" => "success",
            "data" => $userData
        ]);
    } else {
        // No user found
        echo json_encode([
            "status" => "error",
            "message" => "User not found."
        ]);
    }
} else {
    // Invalid user ID
    echo json_encode([
        "status" => "error",
        "message" => "Invalid user ID."
    ]);
}


?>




