<?php
    include('db_config/connect.php');
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='add-to-cart') 

    {     
           if(!empty($_SESSION['user_info'])){
           $product_id =$_POST['product_id']; 
           echo($product_id);
           $quantity=$_POST['quantity']; 
           $user_id=$_SESSION['user_info']['id']; 
           $date=date('Y-m-d H:i:s'); 
           $query = "select * from cart where pid = '$product_id' AND user_id='$user_id' AND checked='0' "; 
           $result1= mysqli_query($con,$query); 
           if(mysqli_num_rows($result1) > 0){ 
               header('location:shop.php?flag=4'); 
           } 
           else{ 
               $query = "insert into cart (user_id,pid, quantity , date_added) values ('$user_id','$product_id','$quantity','$date')"; 
               $result1= mysqli_query($con,$query); 
           } }
           elseif(empty($_SESSION['user_info'])) { 
           header('location:shop.php?flag=5');
       } 
       }
    
    
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css" >
    <link rel="stylesheet" href="css/shop.css" >
    <link rel="stylesheet" href="css/footer.css" >
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    
    <title>Shop page</title>
</head>
<body>
   
<!--header section starts-->
 <?php require "userheader.php";?>
<!--header section ends-->
 


<!--Product section starts-->
<section class="products" id="products">
    <?php 
                $query = "select * from categorie ";
                $result = mysqli_query($con,$query);
    ?>
    <?php if(mysqli_num_rows($result) > 0):?>
        <?php while ($row = mysqli_fetch_assoc($result)):?>
            <?php 
                $categoriename= $row['name'];
                $parts = explode(" ", $categoriename);
                $part1 = $parts[0];
                $part2 = $parts[1];
            ?>
            <h1 class="heading"> <?=$part1?> <?=$part2?></h1>
            <?php if(isset($_GET['flag']) && ($_GET['flag'] == 4 || $_GET['flag'] == 5)): ?>
                    <div class="message">
                        <?php if($_GET['flag'] == 4 ): ?>
                            <span>Already added to cart</span>
                        <?php elseif($_GET['flag'] == 5): ?>
                            <span>You are  not logging in</span>
                        <?php endif; ?>
                        <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
                    </div>
            <?php endif; ?>
            <div class="box-container">
            <?php 
				$cid=$row['cid'];
				$query = "select * from products where cid = '$cid' ";
				$result2 = mysqli_query($con,$query);	
            ?>
            <?php if(mysqli_num_rows($result2) > 0):?>
                <?php while ($product_row = mysqli_fetch_assoc($result2)):?>                    
                        <div class="box">
                            <span class="discount"> - <?=$product_row['discount']?> %</span>
                            <div class="image">
                                <img src="<?=$product_row['image']?>" alt="">
                                <div class="icons">
                                    <form method="post">
                                        <label>quantity:</label>
                                      <input type="number" value='1' name="quantity" >
                                      <input type="hidden" name= "product_id" value="<?php echo $product_row['id']; ?>">
                                      <button type="submit" name= action value="add-to-cart">Add to Cart</button> <br>
                                      
                                    </form>   
                                </div>
                            </div>
                            <div class="content">
                                <h3><?=$product_row['name']?></h3>
                                <div class="price"><?=$product_row['price']-($product_row['price']*($product_row['discount']/100))?>$ <span><?=$product_row['price']?>$</span></div>
                            </div>
                            
                        </div>   
                <?php endwhile;?>
		    <?php endif;?>
            </div>
            </form>
        <?php endwhile;?>
	<?php endif;?>                         
</section>
<!--Product section ends-->

<!--footer section starts-->
<section class="footer">
<?php require "footer.php";?>
</section>
<!--footer section ends-->

</body>
</html>