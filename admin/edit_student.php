<?php
include("../config/db.php");
include("../includes/header.php");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $prn = $_POST['prn'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];

    $conn->query("UPDATE students SET 
        name='$name', prn='$prn', contact='$contact', course='$course'
        WHERE id=$id");

    echo "<div class='alert alert-success'>Updated Successfully</div>";
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
<div class="card p-4 shadow" style="width:400px;">

<h3>Edit Student</h3>

<form method="post">
<input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control mb-2">
<input type="text" name="prn" value="<?php echo $data['prn']; ?>" class="form-control mb-2">
<input type="text" name="contact" value="<?php echo $data['contact']; ?>" class="form-control mb-2">
<input type="text" name="course" value="<?php echo $data['course']; ?>" class="form-control mb-2">

<button name="update" class="btn btn-success w-100">Update</button>
</form>

<a href="manage_students.php" class="btn btn-secondary mt-2 w-100">Back</a>

</div>
</div>

<?php include("../includes/footer.php"); ?>