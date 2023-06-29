<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Logout') { 
    session_destroy(); 
    header('Location: login.php'); 
    die; 
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Login') { 
    header('Location: login.php'); 
    die; 
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['action'] == 'Register Now') { 
    header('Location: register.php'); 
    die; 
} 
?>

<!--header section starts-->
 <!--header section starts--> 
<header> 
  <input type="checkbox" name="" id="toggler"> 
  <label for="toggler" class="fas fa-bars"></label> 
  <a href="#" class="logo">FloraBella<span>.</span></a> 
 
  <nav class="navbar"> 
    <a href="FloraBella.php">Home</a> 
    <a href="shop.php">Shop</a> 
    <a href="user_orders.php">Orders</a>  
  </nav> 
 
  <div class="icons">  
    <a href="cart.php"><i class='bx bx-cart-alt'></i></a> 
    <a href="#" id="user-icon"><i class='bx bx-user'></i></a> 
  </div> 
 
  <?php if (!empty($_SESSION['user_info'])):?>  
    <div class="user-box" id="user-box">  
      <form method="post">  
        <p>username: <span><?php echo $_SESSION['user_info']['name']?></span></p>  
        <p>email: <span><?php echo $_SESSION['user_info']['email']?></span></p>  
        <button type="submit" class="logout-btn" name="action" value="Logout">Logout</button>  
      </form>  
    </div>  
  <?php elseif (empty($_SESSION['user_info'])):?>  
    <div class="user-box" id="user-box">  
      <form method="post">  
        <p><span>YOU ARE NOT LOGGED IN</span></p>  
        <p><span>already have an account</span></p>  
        <button type="submit" class="logout-btn" name="action" value="Login">Login</button>  
        <p><span>Create an account</span></p>  
        <button type="submit" class="logout-btn" name="action" value="Register Now">Register Now</button>  
      </form>  
    </div>  
  <?php endif; ?> 
</header> 
<style>
    .icons:hover + .user-box {
        display: block;
    }
    
    .user-box {
        display: none;
    }
</style>
