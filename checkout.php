<?php
   include('db_config/connect.php');
   session_start();
   $sub_total= $_SESSION['grand_total'];
   $user_id= $_SESSION['user_info']['id'];
   if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='place_order'){
    $user_id= $_SESSION['user_info']['id'];
    $name=$_POST['customer_name'];
    $email=$_POST['email'];
    $phonenumber=$_POST['phone_number'];
    $method=$_POST['payment_method'];
    $street_address=$_POST['street_address'];
    $city=$_POST['city'];
    
    $zip_postalcode=$_POST['zip_postalcode'];
    $country=$_POST['country'];
    $full_address= $street_address. " ". $city ." "  . $zip_postalcode . " " . $country ;
    $total_price=$sub_total;
    $date = date('Y-m-d H:i:s');
    $query = "insert into orders (user_id, name , number, email , method , address , total_price , date,zip) values ('$user_id','$name','$phonenumber','$email','$method','$full_address','$total_price','$date','$zip_postalcode')"; 
    $result1= mysqli_query($con,$query); 
    $query= "UPDATE cart set checked=1 WHERE user_id = '$user_id' AND checked='0'";
    $result = mysqli_query($con,$query);
    header('location:cart.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Ysabeau+Infant:ital,wght@1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/checkout.css">
    
</head>
<body>

<?php require "userheader.php"; ?>

<section class="checkout">
    <h2> CHECKOUT </h2>
    <h3>Please review your checkout details below .If everything is correct , place your order and you will receive more information via email</h3>
    <form action="" method = "post">
        <div class="customer_info">
            <h4>Customer Info</h4>
                <input type="text" name="customer_name"  class="box"  placeholder="Full Name" required>
                <input type="email" name="email" class="box" placeholder="Email" required>
                <input type="text" name="phone_number"  class="box"  placeholder="Phone Number" required>
        </div>
        <div class="address">
            <h4>Shipping Address</h4>
                <input type="text" name="street_address"  class="box"  placeholder="Street Name" required>
                <input type="text" name="city" class="box" placeholder="City" required>
                
                <input type="text" name="zip_postalcode"  class="box"  placeholder="Zip/Postal Code" required>
                <input type="text" name="country"  class="box"  placeholder="Country" required>   
        </div>
        <div class="payment">
            <h4>Payment Method</h4>         
                <input type="radio" name="payment_method" value="cash_on_delivery"> Cash on delivery<br>
                <input type="radio" name="payment_method" value="credit_card">Credit Card<br>
                <input type="radio" name="payment_method" value="paypal">PayPal<br>
        </div>
       <div class= "order_summary">
            <?php
              $checked=0;
              $user_id=$_SESSION['user_info']['id'];
              $select_cart = mysqli_query($con, "SELECT *FROM cart WHERE user_id ='$user_id' AND checked='$checked'") ;
              if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $product_id =$fetch_cart['pid'];
                    $select_products = mysqli_query($con, "SELECT *FROM products WHERE id = '$product_id'") ;
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
              <img src="<?=$fetch_products['image']?>" style="border-radius:50%;margin:10px;width:80px;height:80px;object-fit: cover;">
              <p><?php echo $fetch_products['name']; ?></p>
            <?php 
                   }}  }     
            ?>
            <label for="p"> Subtotal</label>
            <p><?php echo $sub_total ?> </p>
            <label for="p"> Total</label>
            <p><?php echo $sub_total ?> </p>
       </div>
       <div>
       <button type="submit" name= "action" value="place_order" class="update_quantity">Place Order</button> 
       </div>
    </form>
    </section>
<section class="footer">
<?php require "footer.php";?>
</section>
</body>
</html>