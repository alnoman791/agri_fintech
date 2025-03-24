<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirect if already logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Fintech Agriculture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Custom Styles -->
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 450px;">
        <h4 class="text-center mb-3">Create an Account</h4>
        
        <!-- Alert Box (Hidden by Default) -->
        <div id="alertBox" class="alert alert-danger d-none"></div>

        <form id="signupForm" action="process_registration.php" method="POST">
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="user_role" class="form-label">Register As</label>
                <select class="form-select" id="user_role" name="user_role" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <option value="farmer">Farmer</option>
                    <option value="investor">Investor</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">Sign Up</button>
        </form>

        <p class="text-center mt-3">
            Already have an account? <a href="login.php">Login</a>
        </p>
    </div>
</div>

<script>
document.getElementById("signupForm").addEventListener("submit", function(event) {
    let fullname = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let userRole = document.getElementById("user_role").value;
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirm_password").value.trim();
    let alertBox = document.getElementById("alertBox");

    if (fullname === "" || email === "" || password === "" || confirmPassword === "" || userRole === "") {
        event.preventDefault();
        alertBox.innerHTML = "All fields are required!";
        alertBox.classList.remove("d-none");
    } else if (password.length < 6) {
        event.preventDefault();
        alertBox.innerHTML = "Password must be at least 6 characters!";
        alertBox.classList.remove("d-none");
    } else if (password !== confirmPassword) {
        event.preventDefault();
        alertBox.innerHTML = "Passwords do not match!";
        alertBox.classList.remove("d-none");
    }
});
</script>

</body>
</html>
