<!DOCTYPE html>
<html>
<head>
    <title>Teacher</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require_once 'db_connection.php';

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
            <h1>Warden Information</h1>
        </div>
        <?php if ($_SESSION['role'] === 'admin' && isset($_GET['teachers'])) { ?>
            <?php if (empty($teachers)) { ?>
                <p>No teacher data available.</p>
            <?php } else { ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Teacher No</th>
                        <th>Section</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($teachers as $teacher) {
                        echo "<tr>";
                        echo "<td>{$teacher['id']}</td>";
                        echo "<td>{$teacher['full_name']}</td>";
                        echo "<td>{$teacher['teacher_no']}</td>";
                        echo "<td>{$teacher['section']}</td>";
                        echo "<td>{$teacher['level']}</td>";
                        echo "<td>";
                        echo "<a href='view_teacher.php?id={$teacher['id']}'>View</a> ";
                        echo "<a href='edit_teacher.php?id={$teacher['id']}'>Edit</a> ";
                        echo "<a href='teacher.php?action=delete_teacher&id={$teacher['id']}' onclick='return confirm(\"Are you sure you want to delete this teacher?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>
