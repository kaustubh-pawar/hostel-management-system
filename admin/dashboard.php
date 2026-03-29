<?php
session_start();
include("../config/db.php");

// 🔒 Session check
if(!isset($_SESSION['admin'])){
    header("Location: ../auth/login.php");
    exit();
}

// 📊 Stats
$students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
$rooms = $conn->query("SELECT COUNT(*) as total FROM rooms")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: #f4f6f9;
}

/* Sidebar */
.sidebar {
    height: 100vh;
    background: #343a40;
    color: white;
    padding: 20px;
    transition: 0.3s;
}
.sidebar a {
    color: white;
    display: block;
    margin: 10px 0;
    text-decoration: none;
}
.sidebar a:hover {
    background: #495057;
    padding-left: 10px;
}

/* Mobile */
@media(max-width:768px){
    .sidebar {
        position: absolute;
        left: -250px;
        width: 250px;
    }
    .sidebar.active {
        left: 0;
    }
}

/* Content */
.content {
    padding: 30px;
}

/* Animation */
.card {
    transition: transform 0.3s;
}
.card:hover {
    transform: scale(1.05);
}

/* Image */
img {
    max-height: 300px;
    object-fit: cover;
}
</style>

</head>

<body>

<!-- 📱 Mobile Menu Button -->
<button class="btn btn-dark d-md-none m-2" onclick="toggleMenu()">☰ Menu</button>

<div class="container-fluid">
<div class="row">

<!-- 📋 SIDEBAR -->
<div class="col-md-3 sidebar">

<h4>🏠 STANZA LEAVING HOSTEL </h4>
<hr>

<a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
<a href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a>
<a href="manage_students.php"><i class="fas fa-users"></i> Manage Students</a>
<a href="add_room.php"><i class="fas fa-building"></i> Add Room</a>
<a href="allocate_room.php"><i class="fas fa-bed"></i> Allocate Room</a>
<div>
    <a href="#" onclick="toggleFeeMenu()" class="fw-bold">
        💰 Fee Management ▼
    </a>

    <!-- Submenu -->
    <div id="feeMenu" style="display:none; margin-left:15px;">
        <a href="fee_management.php">💳 Make Payment</a>
        <a href="payment_history.php">📊 Payment History</a>
    </div>
</div>
<a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>

</div>

<!-- 🏠 CONTENT -->
<div class="col-md-9 content">

<h2>Welcome to Hostel Management System</h2>

<!-- 🏫 IMAGE -->
<img src="../assets/images/myhostel.jpg" class="img-fluid rounded shadow mb-4">

<h4>🏫 About Hostel</h4>
<p>
This Hostel Management System helps manage student accommodation, room allocation, and fee tracking efficiently.
</p>

<h4>📌 Features</h4>
<ul>
<li>Student Registration</li>
<li>Room Allocation</li>
<li>Fee Management</li>
<li>Secure Login</li>
</ul>

<!-- 📊 STATS -->
<div class="row mt-4">

<div class="col-md-6">
<div class="card bg-primary text-white p-3">
<h5>Total Students</h5>
<h3><?php echo $students; ?></h3>
</div>
</div>

<div class="col-md-6">
<div class="card bg-success text-white p-3">
<h5>Total Rooms</h5>
<h3><?php echo $rooms; ?></h3>
</div>
</div>

</div>

<!-- 📊 CHART -->
<div class="mt-5">
<canvas id="myChart"></canvas>
</div>

</div>

</div>
</div>

<!-- JS -->
<script>
function toggleMenu(){
    document.querySelector('.sidebar').classList.toggle('active');
}

// Chart
var ctx = document.getElementById('myChart').getContext('2d');

var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Students', 'Rooms'],
        datasets: [{
            label: 'Hostel Data',
            data: [<?php echo $students; ?>, <?php echo $rooms; ?>],
            borderWidth: 1
        }]
    }
});
</script>

<script>
function toggleFeeMenu(){
    var menu = document.getElementById("feeMenu");
    if(menu.style.display === "none"){
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}
</script>

</body>
</html>
