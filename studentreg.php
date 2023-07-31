<?php
    require_once "pdo.php";
    session_start();
    if(isset($_POST["sem"]) && isset($_POST["course"])) {
		$sql = "INSERT INTO students (user_id, course_id, dept_id, sem_id)
		VALUES (:user, :crse, :dept, :sem)";
		 $stmt = $pdo->prepare($sql);
			if($_POST["course"]=='b'){
                if($_SESSION['dept']=1){
                    $crse=1;
                    $sem=0;
                }
                else{
                    $crse=3;
                    $sem=12;
                }
				if($_POST['sem']=="1"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 1 +$sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="2"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 2 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="3"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 3 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="4"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 4 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
			}
            else{
                if($_SESSION['dept']=1){
                    $crse=2;
                    $sem=4;
                }
                else{
                    $crse=4;
                    $sem=20;
                }
				if($_POST['sem']=="1"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 1 +$sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="2"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 2 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="3"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 3 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
                elseif($_POST['sem']=="4"){
                    $stmt->execute(array(
                        ':user' => $_SESSION['userid'],
                        ':crse' =>$crse,
                        ':dept' => $_SESSION['dept'],
                        ':sem' => 4 + $sem
                        ));
                        header("Location: logout.php");
                    return;
                }
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

                    <div class="wrap-input100 validate-input">
                    <label for="course">Select Course: </label>
						<select class="input100" name="course" style= "padding-left: 5px; padding-right: 10px;">
                            <option value="b">B.tech</option>
                            <option value="m">M.tech</option>
                        </select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
	
						</span>
					</div>


					<div class="wrap-input100 validate-input">
                        <label for="sem"  >Semester  </label>
                    <select class="input100" name="sem" style= "padding-left: 5px; padding-right: 10px;">
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                        </select>
                      
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>

					</div>





					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</button>
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