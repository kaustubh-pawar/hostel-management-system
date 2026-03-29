<?php
include("../config/db.php");
include("../includes/header.php");

$message = "";

if(isset($_POST['pay'])){
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];

    if(isset($_POST['confirm'])){
        $conn->query("INSERT INTO fees (student_id, amount, status, date)
                      VALUES ($student_id, $amount, 'Paid', CURDATE())");

        $message = "<div id='successMsg' class='alert alert-success'>Payment Successful!</div>";
    } else {
        $message = "<div id='errorMsg' class='alert alert-danger'>Please confirm payment!</div>";
    }
}
?>

<div class="container mt-5">
<div class="card p-4 shadow">

<h3 class="text-center mb-4">💳 Make Payment</h3>

<?php echo $message; ?>

<div class="row">

<!-- QR -->
<div class="col-md-4 text-center">
    <h5>Scan QR</h5>
    <img src="../assets/images/qr.png" width="200">
    <p><b>UPI:</b> gaurav@upi</p>
</div>

<!-- Bank -->
<div class="col-md-4">
    <h5>Bank Details</h5>
    <p><b>Bank:</b> SBI</p>
    <p><b>Account:</b> 1234567890</p>
    <p><b>IFSC:</b> SBIN0001234</p>
</div>

<!-- Form -->
<div class="col-md-4">
    <form method="post">

        <input type="number" name="student_id" class="form-control mb-2" placeholder="Student ID" required>

        <input type="number" name="amount" class="form-control mb-2" placeholder="Amount" required>

        <div class="form-check mb-2">
            <input type="checkbox" name="confirm" required>
            <label>I have completed payment</label>
        </div>

        <button name="pay" class="btn btn-success w-100">Confirm Payment</button>
    </form>
</div>

</div>

<hr>

<a href="payment_history.php" class="btn btn-info w-100 mb-2">📊 View Payment History</a>
<a href="dashboard.php" class="btn btn-secondary w-100">⬅ Back</a>

</div>
</div>

<script>
setTimeout(()=>{
    let s=document.getElementById('successMsg');
    let e=document.getElementById('errorMsg');
    if(s) s.style.display='none';
    if(e) e.style.display='none';
},3000);
</script>

<?php include("../includes/footer.php"); ?>