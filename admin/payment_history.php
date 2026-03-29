<?php
include("../config/db.php");
include("../includes/header.php");
?>

<div class="container mt-5">
<div class="card p-4 shadow">

<h3 class="text-center mb-4">📊 Payment History</h3>

<table class="table table-bordered text-center">
<tr class="table-dark">
    <th>Student ID</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM fees ORDER BY fee_id DESC");
while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['date']; ?></td>
</tr>
<?php } ?>

</table>

<a href="fee_management.php" class="btn btn-primary w-100">💳 Back to Payment</a>
<a href="dashboard.php" class="btn btn-secondary w-100 mt-2">⬅ Dashboard</a>

</div>
</div>

<?php include("../includes/footer.php"); ?>