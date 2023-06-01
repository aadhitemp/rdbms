<?php
    require_once "pdo.php";
    session_start();
    if(isset($_SESSION["userid"])){
        header('Location: indexcop.html');
    }
    if(isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST['name'])) {
        $stmt=$pdo->prepare("SELECT user_id FROM users WHERE email = :xyz");
        $stmt->execute(array(":xyz"=>$_POST["email"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if ( strlen($_POST['name']) < 1 || strlen($_POST['pass']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: register.php");
            return;
        }    
        if ( strpos($_POST['email'],'@') === false ) {
            $_SESSION['error'] = 'Bad data';
            header("Location: register.php");
            return;
        }
        if( $row=== false){
            $pas=password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
      ':name' => $_POST['name'],
      ':email' => $_POST['email'],
      ':password' => $pas));
            $_SESSION['success'] = 'User registered, login here.';
             header( 'Location: index.php' ) ;
            return;
        }
        else{
            $_SESSION['error']='Email already in use.';
            header('Location: register.php');
            return;
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						Member Registration
					</span>
                    <span >
                        <?php if(isset($_SESSION['error'])){
                        echo('<p color="red">'.$_SESSION['error'].'</p>');
                        unset($_SESSION['error']);
                        }
                         ?>
                    </span>


					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Name:">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</button>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="index.php">
							Already registered? Login here
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>