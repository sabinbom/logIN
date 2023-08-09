<!DOCTYPE html>
<html>
<head>
    <title>Hostel Student and Teacher Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: Dashboard.php');
        exit();
    }

    require_once 'db_connection.php';

    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $student_id = $_GET['id'];
        $delete_query = "DELETE FROM students WHERE id = $student_id";
        $result = mysqli_query($conn, $delete_query);
        if ($result) {
            header('Location: Dashboard.php');
            exit();
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'delete_teacher' && isset($_GET['id'])) {
        $teacher_id = $_GET['id'];
        $delete_query = "DELETE FROM teachers WHERE id = $teacher_id";
        $result = mysqli_query($conn, $delete_query);
        if ($result) {
            header('Location: Dashboard.php?teachers=true');
            exit();
        }
    }

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

    $teachers = array();
    if (isset($_GET['teachers'])) {
        $query = "SELECT * FROM teachers";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $teachers[] = $row;
            }
        }
    }
    ?>

    <div class="sidebar">
        <h2>CAREER BUILDING INTERNATIONAL ACADEMY</h2>
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
            <h1><?php echo ($_SESSION['role'] === 'admin') ? "Hostel Management System" : "Student Information"; ?></h1>
        </div>
        <?php if ($_SESSION['role'] === 'admin') { ?>
            <div class="add-new-button">
                <button><a href="add_student.php">Add New Student</a></button>
                <button><a href="add_teacher.php">Add New Warden</a></button>
            </div>
        <?php } ?>
        <?php if ($_SESSION['role'] === 'admin' && isset($_GET['students'])) { ?>
            <?php if (empty($students)) { ?>
                <p>No student data available.</p>
            <?php } else { ?>
                <table>
                </table>
            <?php } ?>
        <?php } ?>

        <?php if ($_SESSION['role'] === 'admin' && isset($_GET['teachers'])) { ?>
            <?php if (empty($teachers)) { ?>
                <p>No teacher data available.</p>
            <?php } else { ?>
                <table>
                </table>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>
