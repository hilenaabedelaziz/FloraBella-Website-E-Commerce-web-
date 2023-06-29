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
            header('location:FloraBella.php?flag=4'); 
        } 
        else{ 
            $query = "insert into cart (user_id,pid, quantity , date_added) values ('$user_id','$product_id','$quantity','$date')"; 
            $result1= mysqli_query($con,$query); 
        } }
        elseif(empty($_SESSION['user_info'])) { 
        header('location:FloraBella.php?flag=5');
    } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css" >
    <link rel="stylesheet" href="css/dashboard.css" >
    <link rel="stylesheet" href="css/footer.css" >
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    </head>
    <title>FloraBella</title>
</head>
<body >

<!--header section starts-->
<?php require "userheader.php";?>
<!--header section ends-->


<!--home section starts-->
<section class="home" id="home">
<div class="content">
    <h3>fresh flowers</h3>
    <span> natural & beautiful flowers </span>
    <p>Lorem ipsum dolor sit amet consectetur adipsicing elit. Beatae laborum ut minus corrupti
        dolorum dolore assumenda iste voluptate dolorum pariatur.</p>
    <a href="shop.php" class="btn">shop now</a>
</div>
</section>
<!--home section ends-->

<!--products section starts-->
<section class="products" id="products">
    <h1 class="heading"> BEST<span> SELLERS</span></h1>
    <?php if(isset($_GET['flag']) && ($_GET['flag'] == 4 || $_GET['flag'] == 5)): ?>
                    <div class="message">
                        <?php if($_GET['flag'] == 4 ):?>
                            <span>Already added to cart</span>
                        <?php elseif($_GET['flag'] == 5): ?>
                            <span>You are  not logging in</span>
                        <?php endif; ?>
                        <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
                    </div>
            <?php endif; ?>
    <div class="box-container">
        <?php 
                $query = "select * from products limit 4";
                $result = mysqli_query($con,$query);
        ?>
        <?php if(mysqli_num_rows($result) > 0):?>
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                    <div class="box">                  
                        <span class="discount"> - <?=$row['discount']?> %</span>
                        <div class="image">
                            <img src="<?=$row['image']?>" alt="">
                            <div class="icons">
                                <form method="post">
                                   <button type="submit" name= action value="add-to-cart">Add to Cart</button>
                                   <input type="hidden" name= "product_id" value="<?php echo $row['id']; ?>">
                                   <label>Quantity:</label>
                                   <input type="number" value="1" name="quantity" class="quantity">
                                </form>
                            </div>
                        </div>
                        <div class="content">
                            <h3><?=$row['name']?></h3>
                            
                            <div class="price"><?=$row['price']-($row['price']*($row['discount']/100))?>$ <span><?=$row['price']?>$</span></div>
                        </div>
                    </div>    
    
                     
                <?php endwhile;?>
		<?php endif;?>

    </div>
</section>
<!--products section ends-->

<!--about section starts-->
<section class="about" id="about">
    <h1 class="heading"><span> About </span> Us </h1>
    <div class="row">
        <div class="video-container">
            <image src="./img/photo1687648563.jpeg" ></image>
            <h3>best flower sellers</h3>
        </div>
        <div class="content">
            <h3>why choose us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipsicing elit. Rem cumque sit nemo pariatur corporis perspisciatis
                aspernatur a ullam repudiandae autem asperiores quibusdam omis comodi alias repellat illum, unde optio temporibus.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipsicing elit. Accusantium ea est comodi incidunt magni quia 
                molestias perspisciatis, unde repudiandae quidem.
            </p>
            
        </div>
    </div>
</section>
<!--about section ends-->

<!--icons section starts-->
<section class="icons-container">
    <div class="icons">
        <img src="img/delver.jpg" alt="">
        <div class="info">
            <h3>free delivery</h3>
            <span>on all orders</span>
        </div>
    </div>
    <div class="icons">
        <img src="img/dolars.jpg" alt="">
        <div class="info">
            <h3>days return</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>
    <div class="icons">
        <img src="img/offer.png" alt="">
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>
    <div class="icons">
        <img src="img/payment.jpg" alt="">
        <div class="info">
            <h3>secure payments</h3>
            <span>protected by paypal</span>
        </div>
    </div>
</section>
<!--icons section ends-->

<!--Footer section starts-->
<section class="footer">
<?php require "footer.php";?>
</section>
<!--Footer section ends-->

</body>  
</html>