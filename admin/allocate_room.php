<?php
include("../config/db.php");
include("../includes/header.php");

$message = "";

if(isset($_POST['allocate'])){
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];

    $check = $conn->query("SELECT * FROM rooms WHERE room_id=$room_id");
    $room = $check->fetch_assoc();

    if($room && $room['occupied'] < $room['capacity']){

        $conn->query("UPDATE rooms SET occupied = occupied + 1 WHERE room_id=$room_id");

        $conn->query("INSERT INTO allocations (student_id, room_id, date)
                      VALUES ($student_id, $room_id, CURDATE())");

        $message = "<div id='successMsg' class='alert alert-success text-center'>
                        Room Allocated Successfully!
                    </div>";

    } else {
        $message = "<div id='errorMsg' class='alert alert-danger text-center'>
                        Room Full!
                    </div>";
    }
}
?>

<div class="container mt-5">
<div class="card p-4 shadow">

<h3 class="text-center mb-4">🛏️ Allocate Room</h3>

<?php echo $message; ?>

<form method="post">

<!-- 👨‍🎓 STUDENT DROPDOWN -->
<select name="student_id" class="form-control mb-3" required>
    <option value="">Select Student</option>
    <?php
    $students = $conn->query("SELECT * FROM students");
    while($s = $students->fetch_assoc()){
        echo "<option value='{$s['id']}'>{$s['name']} (PRN: {$s['prn']})</option>";
    }
    ?>
</select>

<!-- 🏢 ROOM DROPDOWN -->
<select name="room_id" class="form-control mb-3" required>
    <option value="">Select Room</option>
    <?php
    $rooms = $conn->query("SELECT * FROM rooms WHERE occupied < capacity");
    while($r = $rooms->fetch_assoc()){
        echo "<option value='{$r['room_id']}'>Room {$r['room_number']} (Available: ".($r['capacity']-$r['occupied']).")</option>";
    }
    ?>
</select>

<button name="allocate" class="btn btn-primary w-100">Allocate Room</button>

</form>

<hr>

<!-- 📊 HISTORY -->
<h4 class="text-center mt-4">📊 Allocation History</h4>

<table class="table table-bordered text-center">
<tr class="table-dark">
    <th>Student ID</th>
    <th>Room ID</th>
    <th>Date</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM allocations ORDER BY id DESC");
while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo $row['room_id']; ?></td>
    <td><?php echo $row['date']; ?></td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php" class="btn btn-secondary w-100 mt-3">⬅ Back</a>

</div>
</div>

<!-- ⏱️ AUTO HIDE -->
<script>
setTimeout(()=>{
    let s=document.getElementById('successMsg');
    let e=document.getElementById('errorMsg');
    if(s) s.style.display='none';
    if(e) e.style.display='none';
},3000);
</script>

<style>
#successMsg, #errorMsg {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 260px;
}
</style>

<?php include("../includes/footer.php"); ?>