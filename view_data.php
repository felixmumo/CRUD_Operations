<?php
// Include database connection
include('db_connection.php');

// Fetch data from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Check if any data is returned
if ($result->num_rows > 0) {
    $students = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all students as an associative array
} else {
    $students = [];
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Data</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .table-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #e9f7e9;
        }

        table a {
            display: inline-block;
            margin: 5px;
            padding: 6px 12px;
            color: #fff;
            background-color: #007BFF;
            border-radius: 4px;
            text-decoration: none;
        }

        table a:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: green;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table {
                font-size: 14px;
            }

            table th, table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Student Registration Data</h2>

    <?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <?php if (count($students) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Date of Birth</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['gender']); ?></td>
                        <td><?php echo htmlspecialchars($student['course']); ?></td>
                        <td><?php echo $student['dob']; ?></td>
                        <td><?php echo htmlspecialchars($student['description']); ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="update.php?id=<?php echo $student['id']; ?>">Edit</a>
                            <!-- Delete button -->
                            <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No student data found.</p>
    <?php endif; ?>
</div>

</body>
</html>
