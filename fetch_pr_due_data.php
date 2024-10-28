

<?php
include('includes/config.php');

// Get the user ID from POST request
$company_id = isset($_POST['company_id']) ? intval($_POST['company_id']) : 0;

if ($company_id > 0) {
    // Prepare and execute the SQL statement
    $stmt = $con->prepare("SELECT * FROM billing WHERE company_id = ? ORDER BY id DESC
LIMIT 1");
    $stmt->bind_param("i", $company_id);
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




