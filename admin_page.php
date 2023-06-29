<?php
    include('db_config/connect.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin dashboard</title>

   <!-- font awesome cdn link  -->
  
   <!-- custom admin css file link  -->
  
   <link rel="stylesheet" href="css/adminheader.css">
   <link rel="stylesheet" href="css/admin_style1.css">
   <link rel="stylesheet" href="css/adminfooter.css" >
   <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 


</head>
<body>
   
<!--header section starts-->
<?php require "adminheader.php";?>
<!--header section ends-->
<!--home section starts-->
<section class="home" id="home">
    <div class="content">
    </div>
</section>
<!--home section ends-->

<section class="dashboard">

 

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($con, "SELECT * FROM orders WHERE payment_status = 'pending' ");
            while($fetch_pendings = mysqli_fetch_assoc($select_pendings)){
               $total_pendings += $fetch_pendings['total_price'];
            };
         ?>
         <h3><?php echo $total_pendings; ?> $</h3>
         <p>Total of pendings orders</p>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = mysqli_query($con, "SELECT * FROM orders WHERE payment_status = 'delivered'") ;
            while($fetch_completes = mysqli_fetch_assoc($select_completes)){
               $total_completes += $fetch_completes['total_price'];
            };
         ?>
         <h3><?php echo $total_completes; ?> $</h3>
         <p>Total of delivered orders</p>
      </div>

      
      <div class="box">
         <?php
            $select_products = mysqli_query($con, "SELECT * FROM products");
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

      <div class="box">
         <?php
            $select_users = mysqli_query($con, "SELECT * FROM users WHERE usertype = 'user'") ;
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php
            $select_admin = mysqli_query($con, "SELECT * FROM users WHERE usertype = 'admin'") ;
            $number_of_admin = mysqli_num_rows($select_admin);
         ?>
         <h3><?php echo $number_of_admin; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php
            $select_account = mysqli_query($con, "SELECT * FROM users") ;
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      

   </div>

</section>

<section class="footer">
<?php require "footer.php";?>
</section>





</body>
</html>