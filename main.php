<?php
include 'config/db_connect.php'; 
$table_name = $_SESSION['name'];


if(isset($_GET['task_name'])){
    $task_name = $_GET['task_name'];
    
    //write an sql
    $sql = "DELETE FROM $table_name WHERE task_name='$task_name'";

    //make query and check
    if(mysqli_query($conn,$sql)){
        //success
        header('Location: main.php');
    }
    else{
        echo "querry error".mysqli_error($conn);
    }

}
// write sql
$sql = "SELECT * FROM $table_name";

// create query adn get results
$results = mysqli_query($conn,$sql);

//fetch in array
$todos = mysqli_fetch_all($results,MYSQLI_ASSOC);



?>
<?php include 'templates/header.php' ?>
    <div class="container-fluid">
        <h1 class="display-5 my-3">Today's Work</h1>
    </div>

    <div class="container my-5">
        <div class="row">
            <?php foreach ($todos as $todo){?>
                <div class="col-lg-6 iteems mb-3">
                    <div class="container-fluid">
                    <h1><?php echo $todo['task_name']; ?></h1>
                </div>
                    <div class="w-75 mx-auto">
                        <h3 style="color: #112D4E;">Time:<span style="color: #3F72AF; font-size: 1.5rem;"><?php echo "   ".$todo['time'];?></span> </h3>
                        <h3 style="color: #112D4E;">Details:</h3>
                        <ul >
                            <?php $arr = explode(", ",$todo['description']);
                                foreach ($arr as $det){
                            ?>
                                <li><?php echo $det;?></li>
                            <?php }?>
                        </ul>
                    </div>
                    <form action="main.php?ask=yes" method="GET">
                        <input type="hidden" name="task_name" value="<?php echo $todo['task_name']?>">
                        <div class="container-fluid my-5">
                            <a href="insert.php?edit_task=<?php echo $todo['task_name']; ?>">
                                <button class="btn btn-outline-secondary me-3" type="button">Edit task</button>
                            </a>
                            <input type="submit" class="btn btn-primary" name="submit" value="Tick as Completed">
                        </div>
                    </form>
                    
            </div>
            <?php }?>
        </div>
</div>

<div class="container-fluid mb-5">
<a href="insert.php">
    <button class="btn btn-lg btn-outline-primary">Add a New Task</button>
</a>
</div>



<?php include 'templates/footer.php';?>
</html>