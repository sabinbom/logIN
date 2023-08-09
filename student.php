<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require_once 'db_connection.php';

    $students = array();
    if (isset($_GET['students'])) {
        $query = "SELECT * FROM students";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }
    }
    ?>

    <div class="sidebar">
        <h2>Student Management System</h2>
        <ul>
            <li><a href="Dashboard.php">Home</a></li>
            <li><a href="student.php?students=true">Student</a></li>
            <?php if ($_SESSION['role'] === 'admin') { ?>
                <li><a href="teacher.php?teachers=true">Warden</a></li>
            <?php } ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Student Information</h1>
        </div>
        <?php if (isset($_GET['students']) && !empty($students)) { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>School Roll No</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                    <?php } ?>
                    <th>Actions</th>
                </tr>
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo isset($student['full_name']) ? $student['full_name'] : ''; ?></td>
                        <td><?php echo isset($student['school_roll_no']) ? $student['school_roll_no'] : ''; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><?php echo $student['phone_no']; ?></td>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                        <?php } ?>
                        <td>
                            <a href='view_student.php?id=<?php echo $student['id']; ?>'>View</a>
                            <a href='edit_student.php?id=<?php echo $student['id']; ?>'>Edit</a>
                            <a href='student.php?action=delete_student&id=<?php echo $student['id']; ?>' onclick='return confirm("Are you sure you want to delete this student?")'>Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No student data available.</p>
        <?php } ?>
    </div>
</body>
</html>
