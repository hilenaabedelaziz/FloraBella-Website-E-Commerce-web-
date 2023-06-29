<?php 
    include('db_config/connect.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpass = $_POST['cpassword'];
    
    $query = "SELECT * from users where email = '$email' ";
    $result1= mysqli_query($con,$query);

    if(mysqli_num_rows($result1) > 0){
        header("location:register.php?flag=1");
    }
    else{
        if($password != $confpass){
            header("location:register.php?flag=2");
        }
        else{
            $query="INSERT  into users (name,email,password) values ('$name','$email','$password')"; 
            mysqli_query($con,$query); 
            header('location:login.php');   
        }
    }
    


?>