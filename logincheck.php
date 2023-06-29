<?php

    include('db_config/connect.php');
    Function check_login(){
    if(empty($_SESSION['user_info'])){
        header('location:login.php');
        die;
    }
}

?>