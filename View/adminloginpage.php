<?php
require_once '../Config/database.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffUsername = $_POST['STAFFUNAME'];
    $password = $_POST['STAFFPASS'];

    // Prepare the SQL query to fetch the user
    $sql = 'SELECT STAFFPASS FROM staff WHERE STAFFUNAME = :staffUsername';
    $stid = oci_parse($dbconn, $sql);

    if (!$stid) {
        $e = oci_error($dbconn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    oci_bind_by_name($stid, ':staffUsername', $staffUsername);

    // Execute the query
    $r = oci_execute($stid);

    if (!$r) {
        $e = oci_error($stid);
        echo "<p>Error: " . htmlentities($e['message']) . "</p>";
    } else {
        $row = oci_fetch_array($stid, OCI_ASSOC);

        // For demonstration, assuming passwords are stored as plain text. Use password_verify for hashed passwords.
        if ($row && $password == $row['STAFFPASS']) {
            // Login successful
            echo 'Login successful! Welcome, ' . htmlspecialchars($staffUsername) . '!';
            header('Location: /ShaFood/View/adminpage.php');

            session_start();
            $_SESSION['STAFFUNAME'] = $staffUsername;
        } else {
            // Login failed
            $login_error = 'Invalid username or password!';
        }

        // Free the statement
        oci_free_statement($stid);
    }
}

// Close the database connection
CloseConn($dbconn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('adminback.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Ensure the padding is included in the width */
        }

        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($login_error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($login_error); ?></p>
            <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="STAFFUNAME" placeholder="Username" required>
            <input type="password" name="STAFFPASS" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
