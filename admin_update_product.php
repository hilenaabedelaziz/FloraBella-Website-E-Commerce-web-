<?php

include ('db_config/connect.php');

session_start();



if(isset($_POST['update_product'])){

  
   $image_added = false;
   if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0){
       //file was uploaded
      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'img/'.$image;
      $old_image = $_POST['update_p_image'];
      unlink($old_image);
      $image_added = true;
     }
     $update_p_id = $_SESSION['selected_product'];
     $name = $_POST['name'];
     $price = $_POST['price'];
     $discount = $_POST['discount'];
     $categorie=$_POST['flower_categories'];
   if($image_added == true){
      $query = "update products set name = '$name',price = '$price',discount = '$discount',image = '$image_folder',cid = '$categorie' where id = '$update_p_id' limit 1";
  }else{
   $query = "update products set name = '$name',price = '$price',discount = '$discount',cid = '$categorie' where id = '$update_p_id' limit 1";
  }

  $result = mysqli_query($con,$query);
  header('location:admin_update_product.php?flag=9');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <!-- font awesome cdn link  -->
  

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style1.css">
   <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
   <link rel="stylesheet" href="css/adminheader.css">
   <link rel="stylesheet" href="css/adminfooter.css">
   


</head>
<body>
   
<?php require "adminheader.php"; ?>
   <!--header section ends-->
<!--home section starts-->
<section class="home" id="home">
    <div class="content">
    </div>
</section>
<!--home section ends-->
<section class="update-product">


<?php

   $update_id = $_SESSION['selected_product'];
   $select_products = mysqli_query($con, "SELECT * FROM products WHERE id ='$update_id'");
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<h2>Edit Product</h2>
<div class="message">

<?php if (isset($_GET['flag']) && $_GET['flag'] == 9): ?>
   <span>successfully updated</span>  
   <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
<?php endif; ?>
 
</div>
<form action="" method="post" enctype="multipart/form-data">
   
   <img src="<?php echo $fetch_products['image']; ?>" class="image"  style="border-radius:50%;margin:10px;width:170px;height:200px;object-fit: cover;border:none;" alt="">
  
 
   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder=" product name" name="name">
  
   <input type="text"  class="box" value="<?php echo $fetch_products['price']; ?>  $ " required placeholder=" product price" name="price"> 
 
   <input type="text"  class="box" value="<?php echo  $fetch_products['discount']; ?> % " required placeholder=" discount" name="discount"> 
   <select name="flower_categories" class="box">
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="file" name="image" >
   
      <?php 
        $select_categories = mysqli_query($con, "SELECT * FROM categorie") ;
        if(mysqli_num_rows($select_categories) > 0){
         while($fetch_categories = mysqli_fetch_assoc($select_categories)){
      ?>
       <option value="<?php echo $fetch_categories['cid']; ?>"><?php echo $fetch_categories['name']; ?></option>
       <?php }}?>
       </select><br>
   
      <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   <input type="submit" value="update product" name="update_product" class="option-btn">
   <a href="adminproduct.php" class="option-btn">go back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">no update product select</p>';
   }
?>

</section>
<section class="footer">
<?php require "footer.php";?>
</section>





</body>
</html>