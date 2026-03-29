<?php
include("../config/db.php");
include("../includes/header.php");

$message = "";

if(isset($_POST['add'])){
    $room = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $conn->query("INSERT INTO rooms (room_number, capacity, occupied)
                  VALUES ('$room','$capacity',0)");

    $message = "<div id='successMsg' class='alert alert-success text-center'>
                    Room Added Successfully!
                </div>";
}
?>

<div class="container mt-5">

<div class="card p-4 shadow">

<h3 class="text-center mb-4">🏢 Add Room</h3>

<?php echo $message; ?>

<form method="post">

    <input type="text" name="room_number" class="form-control mb-3" placeholder="Enter Room Number" required>

    <input type="number" name="capacity" class="form-control mb-3" placeholder="Enter Capacity" required>

    <button name="add" class="btn btn-warning w-100">Add Room</button>

</form>

<hr>

<!-- 📊 ROOM LIST -->
<h4 class="text-center mt-4">📊 Existing Rooms</h4>

<table class="table table-bordered text-center mt-3">
<tr class="table-dark">
    <th>ID</th>
    <th>Room Number</th>
    <th>Capacity</th>
    <th>Occupied</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM rooms");

while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?php echo $row['room_id']; ?></td>
    <td><?php echo $row['room_number']; ?></td>
    <td><?php echo $row['capacity']; ?></td>
    <td><?php echo $row['occupied']; ?></td>
</tr>
<?php } ?>

</table>

<!-- 🔙 BACK -->
<a href="dashboard.php" class="btn btn-secondary w-100 mt-3">⬅ Back</a>

</div>
</div>

<!-- ⏱️ POPUP AUTO HIDE -->
<script>
setTimeout(()=>{
    let msg=document.getElementById('successMsg');
    if(msg) msg.style.display='none';
},3000);
</script>

<style>
#successMsg {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 260px;
}
</style>

<?php include("../includes/footer.php"); ?>