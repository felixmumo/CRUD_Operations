<?php
// Include database connection file
include('db_connection.php');

// Process form data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $dob = $_POST['dob'];
    $description = $_POST['description'];

    // Insert data into the database
    $sql = "INSERT INTO students (full_name, gender, course, dob, description) 
            VALUES ('$full_name', '$gender', '$course', '$dob', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='color: green; font-size: 18px;'>Registration Successful!</div>";
    } else {
        echo "<div style='color: red; font-size: 18px;'>Error: " . $conn->error . "</div>";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 50px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        input[type="text"], input[type="date"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        textarea {
            height: 150px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container p {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Student Registration Form</h2>

    <form action="register.php" method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="course">Course:</label>
        <select id="course" name="course" required>
            <option value="Computer Science">Computer Science</option>
            <option value="Business Administration">Business Administration</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <option value="Law">Law</option>
        </select>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="description">More Descriptions:</label>
        <textarea id="description" name="description" required></textarea>

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
