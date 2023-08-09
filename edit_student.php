<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Details</title>
    <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require_once 'db_connection.php';

    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    $student_id = $_GET['id'];

    $query = "SELECT * FROM students WHERE id = $student_id";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        echo "Student not found.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["full_name"];
        $school_roll_no = $_POST["school_roll_no"];
        $email = $_POST["email"];
        $phone_no = $_POST["phone_no"];

        $update_query = "UPDATE students SET full_name='$name', school_roll_no='$school_roll_no', email='$email', phone_no='$phone_no' WHERE id=$student_id";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            echo "<p>Student details updated successfully!</p>";
        } else {
            echo "<p>Error updating student details. Please try again.</p>";
        }
    }
    ?>

    <div class="header">
        <h1>Edit Student Details</h1>
    </div>
    <div class="content">
        <div class="edit-student-form">
            <form method="post">
                <label for="full_name">Name:</label>
                <input type="text" name="full_name" value="<?php echo $student['full_name']; ?>" required><br>

                <label for="school_roll_no">School Roll No:</label>
                <input type="text" name="school_roll_no" value="<?php echo $student['school_roll_no']; ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>

                <label for="phone_no">Phone No:</label>
                <input type="text" name="phone_no" value="<?php echo $student['phone_no']; ?>" required><br>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
   
</body>
</html>
