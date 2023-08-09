<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Register your details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Student User Registration</h1>
    <table>
        <form action="register_process.php" method="POST">
            <tr>
                <td><label for="username">Username :</label></td>
                <td><input type="text" name="username" id="username" placeholder="Enter username"></td>
            </tr>
            <tr>
                <td><label for="password">Password :</label></td>
                <td><input type="password" name="password" id="password" placeholder="Enter password"></td>
            </tr>
            <tr>
                <td><label for="role">Role :</label></td>
                <td><select name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="Teacher">Teacher</option>
                    
                </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="submit" name="submit">Submit</button>
                </td>
            </tr>
        </form>
    </table>
</body>
</html>