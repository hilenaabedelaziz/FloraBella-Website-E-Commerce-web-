
<?php
session_start();
?>
<form action="" method="post"  enctype="multipart/form-data">
<div class="account-box">
         <p>username : <span><?php echo $_SESSION['user_info']['name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['user_info']['email']; ?></span></p>
         <a href="login.php" class="delete-btn">logout</a>
         <div><a href="register.php">Add another account</a> </div>
      </div>