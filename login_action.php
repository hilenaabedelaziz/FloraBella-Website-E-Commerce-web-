<?php
    session_start();
    include('db_config/connect.php');
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * from users where email = '$email' AND password = '$password' ";
    $result= mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if ($row['usertype'] == 'user'){
           
           $_SESSION['user_info']=$row ;
            header('location:FloraBella.php');
        }
        elseif($row['usertype' ]== 'admin'){
            $_SESSION['user_info']=$row ;
            header('location:admin_page.php');
        }
    }else{

        header("location:login.php?flag=3");
     
    }
    

?>