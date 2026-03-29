<?php
include("../config/db.php");
include("../includes/header.php");

// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
}
?>

<div class="container mt-5">

<div class="card shadow-lg p-4" style="border-radius:15px;">

<h3 class="text-center mb-4">👨‍🎓 Manage Students</h3>

<table class="table table-bordered text-center">
<tr class="table-dark">
    <th>ID</th>
    <th>Name</th>
    <th>PRN</th>
    <th>Contact</th>
    <th>Course</th>
    <th>Room</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("
    SELECT students.*, rooms.room_number 
    FROM students
    LEFT JOIN allocations ON students.id = allocations.student_id
    LEFT JOIN rooms ON allocations.room_id = rooms.room_id
");

while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['prn']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    <td><?php echo $row['course']; ?></td>

    <!-- 🏠 ROOM DISPLAY -->
    <td>
    <?php 
        if($row['room_number']){
            echo "Room " . $row['room_number'];
        } else {
            echo "Not Allocated";
        }
    ?>
    </td>

    <!-- ACTION -->
    <td>
        <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>

        <a href="?delete=<?php echo $row['id']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this student?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

<!-- 🔙 BACK -->
<a href="dashboard.php" class="btn btn-secondary w-100 mt-3">⬅ Back</a>

</div>
</div>

<?php include("../includes/footer.php"); ?>