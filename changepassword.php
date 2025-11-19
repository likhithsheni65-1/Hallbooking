<?php
require 'includes/db_connect.php';
include "includes/dashboard-nav.php";
// your DB connection
$page_title = "Change Password | Admin Panel";

// Ensure admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: login.php");
    exit();
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    $admin_id = $_SESSION['admin_id'];
    $old_password = mysqli_real_escape_string($connection, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);

    $query = "SELECT password FROM admin WHERE id = '$admin_id' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && md5($old_password) == $row['password']) {
        if ($old_password === $new_password) {
            $error = "New password cannot be the same as old password.";
        } else {
            $hashed = md5($new_password);
            $update = "UPDATE admin SET password = '$hashed' WHERE id = '$admin_id'";
            mysqli_query($connection, $update);
            $success = "Password successfully updated!";
        }
    } else {
        $error = "Old password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Admin - Change Password</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="old_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>