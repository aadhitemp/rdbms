<?php
    require_once "pdo.php";
    session_start();
    if(isset($_SESSION["user_id"])){

		if(isset($_SESSION["teacher_id"])){
			header('Location: teacher.php');
			return;
		}
		elseif(isset($_SESSION['student_id'])){
			header('Location: student.php');
			return;
		}
        
    }
    if(isset($_POST["email"]) && isset($_POST["pass"]) ) {
        $stmt=$pdo->prepare("SELECT user_id, name, password FROM users WHERE email = :xyz");
        $stmt->execute(array(":xyz"=>$_POST["email"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if( $row=== false){
            $_SESSION['error']='Wrong password or email.';
            header('Location: login.php');
            return;
        }
        else{
            if(password_verify($_POST['pass'], $row['password'])){
                $_SESSION["user_id"]=$row['user_id'];
				$_SESSION['name']=$row['name'];

				$stmt1=$pdo->prepare("SELECT teacher_id, dept_id FROM teachers WHERE user_id = :xyz");
        $stmt1->execute(array(":xyz"=>$_SESSION['user_id']));
        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);

				if($row1==false){
					$stmt2=$pdo->prepare("SELECT student_id, course_id, sem_id, dept_id FROM students WHERE user_id = :xyz");
        			$stmt2->execute(array(":xyz"=>$_SESSION['user_id']));
       				$row2=$stmt2->fetch(PDO::FETCH_ASSOC);

					if( $row2=== false){
           						 $_SESSION['error']='Not Registered';
            					header('Location: usertypereg.php');
            					return;
       				 }
					 else{
							$_SESSION['student_id']=$row2['student_id'];
							header('Location: student.php');
							return;
					 }
				}			
				else{
					$_SESSION['teacher_id']=$row1['teacher_id'];
					header('Location: teacher.php');         
               		 return;
				}
                
            }
        $_SESSION['error']='Wrong password or email.';
        header('Location: login.php');
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
						Member Login
					</span>
                    <span >
                        <?php if(isset($_SESSION['error'])){
                        echo('<p color="red">'.$_SESSION['error'].'</p>');
                        unset($_SESSION['error']);
                        }
                         ?>
                    </span>
                    <span >
                        <?php if(isset($_SESSION['success'])){
                        echo('<p color="green">'.$_SESSION['success'].'</p>');
                        unset($_SESSION['success']);
                        }
                         ?>
                    </span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
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
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
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