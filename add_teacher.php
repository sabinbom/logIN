<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: login.php');
        exit();
    }

    require_once 'db_connection.php';

    $full_name = $teacher_no = $section = $level = '';
    $photo_error = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $full_name = $_POST['full_name'];
        $teacher_no = $_POST['teacher_no'];
        $section = $_POST['section'];
        $level = $_POST['level'];

       
    }
    ?>

    <div class="sidebar">
        <h2>School Web App</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="student.php?students=true">Student</a></li>
            <li><a href="teacher.php?teachers=true">Warden</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Add Teacher</h1>
        </div>
        <div class="form-container">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" required value="<?php echo $full_name; ?>">
                </div>
                <div class="form-group">
                    <label for="teacher_no">Teacher No:</label>
                    <input type="text" name="teacher_no" id="teacher_no" required value="<?php echo $teacher_no; ?>">
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <input type="text" name="section" id="section" required value="<?php echo $section; ?>">
                </div>
                <div class="form-group">
                    <label for="level">Level:</label>
                    <input type="text" name="level" id="level" required value="<?php echo $level; ?>">
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" name="photo" id="photo" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Teacher">
                </div>
            </form>
            <?php if ($photo_error) { ?>
                <p class="error"><?php echo $photo_error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
