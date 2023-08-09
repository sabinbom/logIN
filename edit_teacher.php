<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher Details</title>
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
        header('Location: teachers.php');
        exit();
    }

    $teacher_id = $_GET['id'];

    $query = "SELECT * FROM teachers WHERE id = $teacher_id";
    $result = mysqli_query($conn, $query);
    $teacher = mysqli_fetch_assoc($result);

    if (!$teacher) {
        echo "Teacher not found.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($_SESSION['role'] === 'admin') {
            $full_name = $_POST["full_name"];
            $teacher_no = $_POST["teacher_no"];
            $section = $_POST["section"];
            $level = $_POST["level"];
            $photo = $_POST["photo"];

            $update_query = "UPDATE teachers SET full_name='$full_name', teacher_no='$teacher_no', section='$section', level='$level', photo='$photo' WHERE id=$teacher_id";
            $result = mysqli_query($conn, $update_query);

            if ($result) {
                echo "<p>Teacher details updated successfully!</p>";
            } else {
                echo "<p>Error updating teacher details. Please try again.</p>";
            }
        }
    }
    ?>

    <div class="header">
        <h1>Edit Teacher Details</h1>
    </div>
    <div class="content">
        <div class="edit-teacher-form">
            <form method="post">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $teacher['full_name']; ?>" required><br>

                <label for="teacher_no">Teacher No:</label>
                <input type="text" name="teacher_no" value="<?php echo $teacher['teacher_no']; ?>" required><br>

                <label for="section">Section:</label>
                <input type="text" name="section" value="<?php echo $teacher['section']; ?>" required><br>

                <label for="level">Level:</label>
                <input type="text" name="level" value="<?php echo $teacher['level']; ?>" required><br>

                <label for="photo">Photo URL:</label>
                <input type="text" name="photo" value="<?php echo $teacher['photo']; ?>" required><br>

                <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
                <input type="submit" value="Update Teacher">
            </form>
        </div>
    </div>
    
</body>
</html>
