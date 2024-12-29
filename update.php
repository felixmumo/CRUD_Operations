<?php
// Include database connection
include('db_connection.php');

// Initialize variables
$message = '';

// Check if form is submitted
if (isset($_POST['submit'])) {
    $student_id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $dob = $_POST['dob'];
    $description = $_POST['description'];

    // SQL query to update student information
    $sql = "UPDATE students SET full_name='$full_name', gender='$gender', course='$course', dob='$dob', description='$description' WHERE id=$student_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }

    // Close the connection
    $conn->close();

    // Redirect back to the view page with the success message
    header("Location: view_data.php?message=" . urlencode($message));
    exit();
}

// If student ID is provided, fetch existing data to prefill the form
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = $student_id";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Data</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>

<h2>Update Student Information</h2>

<?php if ($message): ?>
    <p style="color: green;"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" required><br>

    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
    </select><br>

    <label for="course">Course:</label>
    <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $student['dob']; ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" cols="50" required><?php echo htmlspecialchars($student['description']); ?></textarea><br>

    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>
