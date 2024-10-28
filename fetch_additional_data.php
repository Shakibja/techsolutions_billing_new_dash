<?php
include('includes/config.php');

// Get the serial number from POST request
$serialNo = isset($_POST['serial_no']) ? $_POST['serial_no'] : '';

if (!empty($serialNo)) {
    $stmt = $con->prepare("SELECT a.*, b.* FROM com_service_details a,service_name b WHERE a.service_name != '97' and a.service_name = b.id and serial_no = ?");
    $stmt->bind_param("s", $serialNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Fetch all relevant data
        }
        echo json_encode([
            "status" => "success",
            "data" => $data // Return data as an array
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No additional data found."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid serial number."
    ]);
}

$stmt->close();
mysqli_close($con);
?>
