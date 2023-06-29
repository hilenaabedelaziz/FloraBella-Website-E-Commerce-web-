<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - my website</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

</head>
<body>

	

<div style="margin: auto;max-width: 600px">

  <?php

        if(isset($_GET['flag'])){
            if($_GET['flag']==3){
                    echo 
                        '<div class="message">
                            <span> email or pass is wrong !!</span>
                            <i class="bi bi-x-circle"  onclick="this.parentElement.remove()"></i>
                        </div> ';
                }
                
        } 
     

    ?>
			
			
			<form method="post" action="login_action.php" style="margin: auto;padding:10px;" class="form">
				
                <h1 style="text-align: center;"><a href="FloraBella.php"><i class='bx bxs-home'></i></a> / Login / <a href="register.php"> Signup</a></h1>
                <div class="box"><i class='bx bxs-envelope'></i><input type="email" name="email" class="registrationinputs" placeholder="Email" required></div>
            <div class="box"><i class='bx bxs-lock'></i><input type="password" name="password" class="registrationinputs" placeholder="Password" required></div>
				<button class="submit-btn">Login</button>
			</form>	
		</div>
	

</body>
</html>