<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicon@2.1.4/css/boxicon.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/register.css" >
    
    
    <title>Registration page</title>
</head>
<body >
    <div style="margin: auto;max-width: 600px" class="form-container">
        <?php
        if(isset($_GET['flag'])){
            if($_GET['flag']==1){
                echo 
                    '<div class="message">
                        <span> User Already Exist!</span>
                        <i class="bi bi-x-circle"  onclick="this.parentElement.remove()"></i>
                    </div> ';
            }
            elseif($_GET['flag']==2){
                echo '
                <div class=" message">
                    <span>Wrong Password!</span>
                    <i class="bi bi-x-circle"  onclick="this.parentElement.remove()"></i>
                </div>';
            }        
        } 
        ?>
        

        <form method="post" action="register_action.php" style="margin: auto;padding:10px;" class="form">
            <h1 style="text-align: center;"><a href="FloraBella.php"><i class='bx bxs-home'></i></a> / Signup / <a href="login.php"> Login</a></h1>
            <div class="box"><i class='bx bxs-user-circle'></i><input type="text" name="name" class="registrationinputs" placeholder="Name" required></div>
            <div class="box"><i class='bx bxs-envelope'></i><input type="email" name="email" class="registrationinputs" placeholder="Email" required></div>
            <div class="box"><i class='bx bxs-lock'></i><input type="password" name="password" class="registrationinputs" placeholder="Password" required></div>
            <div class="box"><i class='bx bxs-lock'></i><input type="password" name="cpassword" class="registrationinputs" placeholder="Confirm password" required></div>
            <input type="submit" name="submit-btn" class="box" value="register now" id="submit" class="btn">
           
        </form>	
    </div>
</body>
</html>