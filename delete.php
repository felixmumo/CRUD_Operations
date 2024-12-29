<?php
// Include database connection
include('db_connection.php');

// Check if ID is passed
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // SQL query to delete student by ID
    $sql = "DELETE FROM students WHERE id = $student_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted successfully";
    } else {
        $message = "Error deleting record: " . $conn->error;
    }

    // Close the connection
    $conn->close();
    // Redirect back to the view page with the success message
    header("Location: view_data.php?message=" . urlencode($message));
    exit();
}
?>
