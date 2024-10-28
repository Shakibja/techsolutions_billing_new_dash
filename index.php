<?php
session_start();
require_once 'includes/config.php'

?>
<?php
    if (isset($_POST['submit']))
    {
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $password=sha1($password);
        //email validation
        $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($query)>0)
        {
            $_SESSION['email']=$email;
            if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
			}
            echo "<script> window.location='dashboard.php'; </script>";
        }
        else
        {
            echo "<script> alert('Username or Password did not match.') </script>";
        }
    }
  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Customer Database</title>
<meta name="description" content="Customer Database">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" href="apple-icon.png">
<link rel="shortcut icon" href="images/tech_fav.png" >
<link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
<link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
<link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


<link rel="stylesheet" href="assets/css/style.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

   

</head>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <h2 class="text-center">Customer Database</h2>
                        <!-- <img class="align-content" src="images/logo.png" alt=""> -->
                    </a>
                </div>
                <div class="login-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                                <input  type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                                <label for="remember-me">Remember me</label>
                        </div>
                        
                        
                        <div class="social-login-content" style="padding: 50px;">
                            <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30" >Sign in</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>