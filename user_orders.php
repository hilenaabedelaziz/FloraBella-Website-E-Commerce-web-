<?php
include('db_config/connect.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='order_remove'){
    $order_id =$_POST['order_id'];
    $user_id=$_SESSION['user_info']['id'];
    $query= "UPDATE orders set deleted=1 WHERE id='$order_id' AND user_id='$user_id'";
    $result = mysqli_query($con,$query);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders History</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
<!--header section starts-->
<section class="header ">
    <?php require "userheader.php"; ?>
</section>
<!--header section ends-->
<!--home section starts-->
<section class="home" id="home">
<div class="content"> 
    <h3> Your Orders</h3>
</div>
</section>
<!--home section ends-->
<!--Product section starts-->
<section class="all_orders" id="orders">
<?php
         if(!empty($_SESSION['user_info'])){
    ?>
    <h2>Pending Orders List</h2>
    <div class="orders_list">
    <?php 
        $user_id =$_SESSION['user_info']['id'];
        $query = "select * from orders where user_id='$user_id' AND payment_status='pending' AND deleted=0 ";
        $result1 = mysqli_query($con,$query);
        if(mysqli_num_rows($result1) > 0){
        while ($delivered_row = mysqli_fetch_assoc($result1)){         
    ?>
    <div class="order_block">
        <div class="order_details"> Ordered in <?php echo $delivered_row['date']?></div>
        <div class="order_details"> Ordered by  <?php echo $delivered_row['name'] ?> </div>
        <div class="order_details"> Total : <?php echo $delivered_row['total_price'] ?>$</div>
        <div class="order_details"> To  this address: <?php echo $delivered_row['address'] ?></div>
        <form method="post">
            <input type="hidden" value="<?php echo $delivered_row['id'] ; ?>" name="order_id">
            <button type="submit" name= "action" value="order_remove" class="update_quantity"><i class='bx bx-trash'></i> Remove</button> 
        </form>
    </div>
    <?php
     }}
     else {
        echo '<p class="empty">NOTHING!</p>';
     }
     ?>
    </div>
     <h2>Delivered Orders List</h2>
     <div class="orders_list">
     <?php
     $query = "select * from orders where user_id='$user_id' AND payment_status='delivered'AND deleted=0";
     $result2 = mysqli_query($con,$query);
     if(mysqli_num_rows($result2) > 0){
     while ($delivered_row = mysqli_fetch_assoc($result2)){         
    ?>
    <div class="orders_block">
        <div class="order_details"> Ordered in <?php echo $pending_row['date']?></div>
        <div class="order_details"> Ordered by  <?php echo $pending_row['name'] ?> </div>
        <div class="order_details"> Total  <?php echo $pending_row['total_price'] ?></div>
        <div class="order_details"> To address <?php echo $pending_row['address'] ?></div>
        <form method="post">
            <input type="hidden" value="<?php echo $pending_row['id'] ; ?>" name="order_id">
            <button type="submit" name= "action" value="order_remove" class="update_quantity"><i class='bx bx-trash'></i> Remove</button> 
        </form>
    </div>
    <?php
     }}
     else {
        echo '<p class="empty">NOTHING!</p>';
     }}
     elseif(empty($_SESSION['user_info'])){ 
          echo '<p class="empty">EMPTY!</p>';
     }
    ?>
    </div>    
    </section>

<section class="footer">
<?php require "footer.php";?>
</section>   
</body>
</html>