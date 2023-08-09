<?php
require_once("db_connection.php");
if(isset($_POST['submit'])){
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['role'])){
        header("location:index.php");
    }
    else{
        $u = $_POST['username'];
        $p= $_POST['password'];
        $r = $_POST['role'];
        $query = "INSERT INTO `users`(`username`, `password`, `role`) VALUES ('$u','$p','$r'); ";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<h1>A new user created successfully.</h1>";
            echo "<script>setTimeout(\"location.href = 'Dashboard.php'; \",2000); </script>";
        }
        else{
            header("location:index.php");
        }
    }
}
?>