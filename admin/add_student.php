<?php
include("../config/db.php");
include("../includes/header.php");

$message = "";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $prn = $_POST['prn'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];

    $conn->query("INSERT INTO students (name, prn, contact, course)
                  VALUES ('$name','$prn','$contact','$course')");

    // ✅ Success Message
    $message = "<div id='successMsg' class='alert alert-success text-center'>
                    Student Added Successfully!
                </div>";
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

<div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">

<h3 class="text-center mb-4">➕ Add Student</h3>

<!-- ✅ Popup Message -->
<?php echo $message; ?>

<form method="post">

    <input type="text" name="name" class="form-control mb-3" placeholder="Enter Name" required>

    <input type="text" name="prn" class="form-control mb-3" placeholder="Enter PRN" required>

    <input type="text" name="contact" class="form-control mb-3" placeholder="Enter Contact" required>

    <input type="text" name="course" class="form-control mb-3" placeholder="Enter Course" required>

    <button name="add" class="btn btn-primary w-100">Add Student</button>

</form>

<!-- 🔙 Back Button -->
<a href="dashboard.php" class="btn btn-secondary mt-3 w-100">⬅ Back</a>

</div>
</div>

<!-- ⏱️ AUTO HIDE SCRIPT -->
<script>
setTimeout(function(){
    var msg = document.getElementById('successMsg');
    if(msg){
        msg.style.display = 'none';
    }
}, 3000);
</script>

<!-- 🎨 POPUP STYLE -->
<style>
#successMsg {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 260px;
    z-index: 1000;
}
</style>

<?php include("../includes/footer.php"); ?>