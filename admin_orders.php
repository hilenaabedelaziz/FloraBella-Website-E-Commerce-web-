<?php

include ('db_config/connect.php');

session_start();



if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($con, "UPDATE orders SET payment_status = '$update_payment' WHERE id = '$order_id'") ;
  
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
   <link rel="stylesheet" href="css/admin_style1.css">
   <link rel="stylesheet" href="css/adminheader.css">
   <link rel="stylesheet" href="css/adminfooter.css">
   
   

</head>
<body>
   
<?php require "adminheader.php"; ?>

<section class="placed-orders">

   <h1 class="title">orders</h1>

   <div class="box-container">
   <?php
     
      $select_orders = mysqli_query($con, "SELECT * FROM  orders ") ;
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      
  
     
      <div class="box">
         <p> Ordered in : <span><?php echo $fetch_orders['date']; ?></span> </p>
         <p>Order Owner Details:</p>
         <p> Name: <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Phone Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> total price <br><span><?php echo $fetch_orders['total_price']; ?>$</span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="delivered">delivered</option>
            </select>
            <input type="submit" name="update_order" value="update" class="option-btn">  
         </form>
         
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
      </div>
         
      

    
</section>
<section class="footer">
<?php require "footer.php";?>
</section>
</body>
</html>