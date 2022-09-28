<?php 

include 'config/db_connect.php';
$table_namee = $_SESSION['name'];
$taskyy_name ="";
$timyy ="";
$descyy = "";
if(isset($_GET['edit_task'])){


    $tasky = $_GET['edit_task'];
    // writing a sql
    $sql ="SELECT task_name,time,description FROM $table_namee WHERE task_name='$tasky'";

    //send querry and store results
    $results = mysqli_query($conn,$sql);

    $res = mysqli_fetch_array($results,MYSQLI_ASSOC);

    // print_r($res);
    $taskyy_name =$res['task_name'];
    $timyy =$res['time'];
    $descyy = $res['description'];
    


}
if(isset($_GET['Edit'])){
    $desript = $_GET['details'];
    $task_named = $_GET['task_name'];
    $sql4 = "UPDATE $table_namee SET description='$desript' WHERE task_name='$task_named'";

    if (mysqli_query($conn, $sql4)) {
        header('Location: main.php');
      } 
      else {
        echo "Error updating record: " . mysqli_error($conn);
      }
}
if(isset($_GET['submit'])){
    $task_name = $_GET['task_name'];
    $time = $_GET['time'];
    $details = $_GET['details'];

    //writing a sql querry

    $sql = "INSERT INTO $table_namee (task_name, time, description) VALUES('$task_name','$time','$details')";

    if(mysqli_query($conn,$sql)){
        header('Location: main.php');
    }
    else{
        echo "Error ". mysqli_error($con);
    }

    }
   



?>






<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'?>
<section class="container grey-text">
    <div class="container-fluid">
    <h1 class="display-5 my-3">Add a Task</h1>

    </div>
    <form action="insert.php" method="GET" class="mt-3 mb-5 needs-validation" novalidate>
        <div class="mx-auto w-50 mb-3 formx-1">
            <label for="username" class="form-label">Task-name</label>
            <input type="text" class="form-control" id="username" name="task_name" value="<?php echo $taskyy_name; ?>" required>
        </div>
        <div class="mx-auto w-50 mb-3 formx-2">
            <label for="password" class="form-label">Time</label>
            <input type="text" class="form-control" id="password" name="time" value="<?php echo $timyy; ?>" required>
        </div>
        <div class="mb-5 w-50 mx-auto formx-3">
            <label for="exampleFormControlTextarea1" class="form-label ">Details</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details" value="<?php echo $descyy; ?>"></textarea>
        </div>
        <div class="w-50 mx-auto mb-3">
            <input type="submit" class="btn btn-primary" name="<?php 
            if(isset($_GET['edit_task'])){ 
                echo "Edit";
                }
                else{echo "submit";
                }
                 ?>">
        </div>
    </form>
</section>

<?php include 'templates/footer.php'?>
</body>
</html>