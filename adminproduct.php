<?php
include('db_config/connect.php');
$message=" ";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='add_product'){
        $name=$_POST['name'];
        $price=$_POST['price'];
        $discount=$_POST['discount'];
        $categorie=$_POST['flower_categories'];
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'img/'.$image;
        $select_product_name = mysqli_query($con, "SELECT name FROM products WHERE name = '$name'");
        if (mysqli_num_rows($select_product_name) > 0) {
            header("location:adminproduct.php?flag=6");
           
        } else {
            $insert_product = mysqli_query($con, "INSERT INTO products(name,  price, image,discount,cid) VALUES('$name', '$price', '$image_folder','$discount' ,'$categorie')");
            if ($insert_product) {
                if ($image_size > 2000000) {
                    header("location:adminproduct.php?flag=7");
                   
                } else {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    header("location:adminproduct.php?flag=8");
                }
            }
        }}
elseif(!empty($_GET['action']) && $_GET['action'] =='delete_product' && $_GET['id']){
   $delete_id = $_GET['id'];
   $select_delete_image = mysqli_query($con, "SELECT image FROM products WHERE id = '$delete_id'") ;
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink($fetch_delete_image['image']);
   mysqli_query($con, "DELETE FROM products  WHERE id = '$delete_id'") ;
   mysqli_query($con, "DELETE FROM cart WHERE pid = '$delete_id'") ;

}
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action']=='edit_btn') 
{
    $selected_product_id=$_POST['product_id'];
    $_SESSION['selected_product']=$selected_product_id;
    header('location:admin_update_product.php');
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
   <link rel="stylesheet" href="css/admin_style1.css">
   <link rel="stylesheet" href="css/adminfooter.css">
   <link rel="stylesheet" href="css/adminheader.css">
</head>
<body>
<?php require "adminheader.php";?>
<section class="home" id="home">
    <div class="content">
    </div>
</section>
<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3> New Product</h3>
      <?php
        if(isset($_GET['flag'])){
            if($_GET['flag']==6){
                echo 
                    '<div class="message">
                        <span>product name already exist!</span>
                        <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
                    </div> ';
            }
            elseif($_GET['flag']==7){
                echo '
                <div class=" message">
                    <span>Image size is too large!</span>
                    <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
                </div>';
            } 
            elseif($_GET['flag']==8){
                echo '
                <div class=" message">
                    <span>Product added successfully</span>
                    <i class="bx bx-window-close" onclick="this.parentElement.remove()"></i>
                </div>';
            }         
        } ?>
      <input type="text" class="box" required placeholder="name" name="name">
      <input type="text"  class="box" required placeholder="price $" name="price">
      <input type="text"  class="box" required placeholder="discount -%" name="discount"> 
      <select name="flower_categories" class="box">
     
     
      <?php 
        $select_categories = mysqli_query($con, "SELECT * FROM categorie") ;
        if(mysqli_num_rows($select_categories) > 0){
         while($fetch_categories = mysqli_fetch_assoc($select_categories)){
      ?>
       <option value="<?php echo $fetch_categories['cid']; ?>"><?php echo $fetch_categories['name']; ?></option>
       <?php }}?>
       </select><br>
       <input type="file" accept="img/jpg, img/jpeg, img/png" required class="file" name="image">
       <button type="submit" name= action value="add_product" class= "btn">Add Product</button> <br>   
   </form>

</section>
<section class="show-products">
<h1 class="heading"> Products <span> in Store</span></h1>
<div class="box-container">
<?php
         $select_products = mysqli_query($con, "SELECT * FROM products") ;
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
    <div class="box"> 
     <div class="dis">-<?php echo $fetch_products['discount']; ?>%</div>
     <img class="image"src="<?=$fetch_products['image']?>" alt="">
     <div class="price"><?php echo $fetch_products['price']; ?>$</div>
     <div class="name"><?php echo $fetch_products['name']; ?></div>
     
     <form method="post">
     <input type="hidden" name= "product_id" value="<?php echo $fetch_products['id']; ?>">
     <button type="submit" name= action value="edit_btn" class= "option-btn"><i class='bx bx-edit-alt'></i>edit</button> <br>
     </form>
     <a href="adminproduct.php?action=delete_product&id=<?= $fetch_products['id']?>" class="option-btn" onclick="return confirm(' Are you sure you want to delete this product!');"><i class='bx bx-trash'></i>remove</a>
    </div>
  <?php
     }
  }else{
     echo '<p class="empty">no products added yet!</p>';
  }
  ?>
</div>
    
</body>
</html>