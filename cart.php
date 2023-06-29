
<!--- order section starts-->
<?php
    include('db_config/connect.php');
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='update'){
        $updated_quantity=$_POST['cart_quantity'];
        $product_id=$_POST['prdct_id'];
        $user_id=$_SESSION['user_info']['id'];
        $chck=0;
        if(!$updated_quantity<=0){
            $query= "UPDATE cart set quantity='$updated_quantity' WHERE pid = '$product_id' AND user_id='$user_id' AND checked='$chck'";
            $result = mysqli_query($con,$query);
        }
        elseif($updated_quantity<=0){
            $query="DELETE FROM cart WHERE pid ='$product_id' AND user_id='$user_id' and checked='$chck' limit 1";
            $result1 = mysqli_query($con,$query);
        }
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='delete'){ 
        $product_id=$_POST['prdct_id'];
        $user_id=$_SESSION['user_info']['id'];
        $chck=0;
        $query="DELETE FROM cart WHERE pid ='$product_id' AND user_id='$user_id' and checked='$chck' limit 1";
        $result2 = mysqli_query($con,$query);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='checkout'){
        if(!empty($_SESSION['user_info'])){
            $grndtotal=$_POST['grandtotal'];
            $_SESSION['grand_total']=$grndtotal;
            header('location:checkout.php');
        }
        elseif(empty($_SESSION['user_info'])) { 
            header('location:login.php');
        }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Ysabeau+Infant:ital,wght@1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/cart.css">

</head>
<body>
   
<?php require "userheader.php"; ?>

<section class="shopping-cart">

    <h3 class="title" >SHOPPING CART</h3>

    <div class="box-container">

    <?php
        if(!empty($_SESSION['user_info'])){
        $user_id=$_SESSION['user_info']['id'];
        $grand_total = 0;
        $Total=0;
        $checked = 0;
        $select_cart = mysqli_query($con, "SELECT *FROM cart WHERE user_id ='$user_id' AND checked='$checked'") ;
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $quantity= $fetch_cart['quantity'];
                $product_id =$fetch_cart['pid'];
                $select_products = mysqli_query($con, "SELECT *FROM products WHERE id = '$product_id'") ;
                while($fetch_products = mysqli_fetch_assoc($select_products)){
                    $price= $fetch_products['price']; 
                    $total = $quantity * $price; 
                    $grand_total = $grand_total +$total     
    ?>
    <div  class="box">
        <img src="<?=$fetch_products['image']?>" style="border-radius:50%;margin:10px;width:100px;height:115px;object-fit: cover;">
        
        <div class="name"><?php echo $fetch_products['name']; ?></div>
       
        <form method = "post">
        <input value="<?php echo $price?>$" type="text" name="price" required class="price">
        <div class="subtotal"> Total: <?php echo $total ?> $ </div>
        <input type="number" min="0" value="<?php echo $quantity; ?>" name="cart_quantity" class="qty">
        <input type="hidden" value="<?php echo $product_id; ?>" name="prdct_id">
        
        <button type="submit" name= "action" value="update" class="update_quantity"><i class='bx bx-edit-alt'></i></button> 
        <button type="submit" name= "action" value="delete" class="deletefrom_cart"><i class='bx bx-trash'></i></button> 
        </form>
        
        
    </div>
   
    </div>
    
    <?php
    }}
    ?>
    <div class="cart-total">
        <form action="" method="post">
        <br><input value="<?php echo $grand_total ?>$ " type="text" name="grandtotal" required class="grandtotal"><br>
        <button type="submit" name= "action" value="checkout" class="update_quantity">Checkout</button> <br>
        <a href="shop.php" class="option-btn">  Continue shopping  </a>
        </form>
    </div>
    <?php
    }else{
            echo '<p class="empty">your cart is empty</p>';
        }}

    elseif(empty($_SESSION['user_info'])){
        echo '<p class="empty">your cart is empty</p>';
    }?>

</section>




<section class="footer">
<?php require "footer.php";?>
</section>
</body>
</html>