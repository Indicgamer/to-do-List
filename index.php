<?php
include 'config/db_connect.php';
$error = "";

if(isset($_POST['submit'])){
    //success
    $username =  htmlspecialchars( $_POST['username']);
    $password =  htmlspecialchars( $_POST['password']); 

    //sql
    $sql ="SELECT username,password FROM signup";

    //send querry and store results
    $results = mysqli_query($conn,$sql);

    //fetch into array
    $person = mysqli_fetch_all($results,MYSQLI_ASSOC);
    $userfound =0;
    // print_r($person);
    foreach($person as $pes){

        if($pes['username']==$username && $pes['password'] == $password){
            //success
            
            $userfound=1;
            break;
        }
    }
    if($userfound==1){
        $_SESSION['name'] = $username;
        header('Location: main.php');
    }
    else{
        $error ="failed to log-in";
    }
    
  

}

if(isset($_POST['register'])){
   $name =  htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $check = 0;

    $sql3="SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'loginpage'";
    $result=mysqli_query($conn,$sql3);
    $res =mysqli_fetch_all($result,MYSQLI_ASSOC);

    for($i =0; $i<count($res); $i++){
        $item = $res[$i];
        if($item['TABLE_NAME']==$name){
            $check=1;
            break;
        }
    }

    // Free memory by clearing result
    $result->free();


    $sql ="CREATE TABLE $name (id INT(2) PRIMARY KEY AUTO_INCREMENT, task_name VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)";

    if($check!=1){
        if(mysqli_query($conn,$sql)){
            $_SESSION['name'] = $name;
        }
        $sql2 = "INSERT INTO signup (username,email, password) VALUES ('$name', '$email','$password')";
        if(mysqli_query($conn,$sql2)){
            header('Location: main.php');
        }
    }
    else{
        echo "<script>alert('Username already exists')</script>";
    }


   
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="icon" type="image/x-icon" href="to-do-list.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="hero">
       <div class="form-box">
         <div class="botton-box">
            <div id="btn"></div>
             <button type="button" class="togle-btn" onclick="login()">Login</button>
             <button type="button" class="togle-btn" onclick="register()">Register</button>
         </div>
         <div class="social-icon">
            <img src="facebook.png">
            <img src="instagram.jpg">
            <img src="linked.png">
         </div>
      
       <form  id="login" class="input-group" method="POST" action="index.php">
        <input type="text" class="input-field" placeholder="User Id" required name="username">
        <input type="text" class="input-field" placeholder="Enter the Password" required name="password">
        <input type="checkbox" class="check-box"><span>Remember Password</span>
        <p style="color: red;"><?php echo $error; ?></p>
        <button type="submit" class="sumbit-btn" name="submit">Log in</button>
       </form>
       <form id="register" class="input-group" method="POST" action="index.php">
        <input type="text" class="input-field" placeholder="User Id" required name="username">
        <input type="text" class="input-field" placeholder="Email Id" required name="email">
        <input type="text" class="input-field" placeholder="Enter the Password" required name="password">
        <input type="checkbox" class="check-box"><span>I agree to the terms and conditions</span>
        <button type="submit" class="sumbit-btn" name="register">Register</button>
       </form>
    </div>
       
    </div>

</body>
<script>
    var x =document.getElementById("login");
    var y =document.getElementById("register");
    var z =document.getElementById("btn");
    
    function register()
    {
        x.style.left="-400px";
        y.style.left="50px";
        z.style.left="110px";
    }
    function login()
    {
        x.style.left="50px";
        y.style.left="450px";
        z.style.left="0px";
    }
</script>
</html>