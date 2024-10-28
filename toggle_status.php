<?php
include('includes/config.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $newStatus = $_GET['status'] == '0' ? 0 : 1; // Toggle status

    $query = "UPDATE company SET status='$newStatus' WHERE id='$id'";
    mysqli_query($con, $query);
    
    header("Location: company_view.php"); // Redirect back to the company page
    exit();
}
?>