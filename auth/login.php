<?php
session_start();

// ✅ If already logged in → go dashboard
if(isset($_SESSION['admin'])){
    header("Location: ../admin/dashboard.php");
    exit();
}

include("../config/db.php");

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $result = $conn->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");

    if($result->num_rows > 0){
        $_SESSION['admin'] = $user;   // ✅ SESSION STORE
        header("Location: ../admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center" style="height:100vh; background:#f0f0f0;">

<div class="card p-4 shadow" style="width:300px;">
<h3 class="text-center">Login</h3>

<img src="../assets/images/user.png" width="80" class="mx-auto d-block"><br>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="post" autocomplete="off">

    <!-- 🔒 Fake fields (prevents autofill) -->
    <input type="text" style="display:none">
    <input type="password" style="display:none">

    <input type="text" name="username" 
           class="form-control mb-2" 
           placeholder="Username" 
           autocomplete="off" required>

    <input type="password" name="password" 
           class="form-control mb-2" 
           placeholder="Password" 
           autocomplete="new-password" required>

    <button name="login" class="btn btn-primary w-100">Login</button>
</form>

</div>

</body>
</html>