<?php
session_start();
require_once 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password
    if (strlen($new_password) < 6) {
        $_SESSION['reset_error'] = "Password must be at least 6 characters.";
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    }
    if ($new_password !== $confirm_password) {
        $_SESSION['reset_error'] = "Passwords do not match.";
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    }

    // Check if token is valid
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['reset_error'] = "Invalid or expired reset link.";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in users table
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();
    $stmt->close();

    // Delete reset token after successful password change
    $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();

    $_SESSION['reset_msg'] = "Your password has been reset successfully. You can now login.";
    header("Location: login.php");
    exit();
} else {
    header("Location: forgot_password.php");
    exit();
}
?>
