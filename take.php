<?php
    require_once "pdo.php";
    session_start();
    if(isset($_GET['sess_id'])){
        $stmt=$pdo->prepare("SELECT `semester`.`sem_id` FROM `sessions` INNER JOIN `modules` ON `sessions`.`mod_id`=`modules`.`mod_id` INNER JOIN `subject` ON `subject`.`sub_id`=`modules`.`sub_id` INNER JOIN `semester` ON `semester`.`sem_id`=`subject`.`sem_id` WHERE `sessions`.sess_id= :xyz");
        $stmt->execute(array(":xyz"=>$_GET["sess_id"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['sem']=$row['sem_id'];
        $_SESSION['sess']=$_GET['sess_id'];
        $stmt1=$pdo->prepare("SELECT `students`.`student_id`, `users`.`name` FROM `students` INNER JOIN `users` ON `students`.`user_id`=`users`.user_id  WHERE `students`.`sem_id` = :xyz");
        $stmt1->execute(array(":xyz"=>$_SESSION['sem']));
        $row=$stmt1->fetch(PDO::FETCH_ASSOC);
    }
    elseif(isset($_GET['stuid'])&& isset($_GET['abs'])){
        if($_GET['abs']=='1'){
            $sql = "INSERT INTO attendence (student_id, sess_id, present)
            VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
      ':name' => $_GET['stuid'],
      ':email' => $_SESSION['sess'],
      ':password' => 0));
        }
        else{
            if($_GET['abs']=='1'){
                $sql = "INSERT INTO attendence (student_id, sess_id, present)
                VALUES (:name, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
          ':name' => $_GET['stuid'],
          ':email' => $_SESSION['sess'],
          ':password' => 1));
        }
        $_SESSION['pdo']->execute(array(":xyz"=>$_SESSION['sem']));
        $row=$_SESSION['pdo']->fetch(PDO::FETCH_ASSOC);
        if( $row=== false){
            $_SESSION['success']='Attendence Recorded';
            header('Location: takeat.php');
            return;
        }
    }
}
    
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Present/Absent</title>
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

				<div class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						Present/Absent
					</span>
                    <span >
                        <?php if(isset($_SESSION['error'])){
                        echo('<p color="red">'.$_SESSION['error'].'</p>');
                        unset($_SESSION['error']);
                        }
                         ?>
                    </span>
                    <span >
                        <?php 
                        if(isset($_SESSION['success'])){
                        echo('<p color="green">'.$_SESSION['success'].'</p>');
                        unset($_SESSION['success']);
                        }
                         ?>
                    </span>

					<div class="wrap-input100 " >
                    <p>Student id: <?php 
                            print($row['student_id']);
                            ?>
                        </p>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							
						</span>
                        
					</div>

					<div class="wrap-input100 " >
						<p>Name: <b><?php 
                            print($row['name']);
                        ?></b>
                        </p>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							
						</span>
					</div>
					
					<div class="container-login100-form-btn">
                        <?php
						echo('<button class="login100-form-btn" onclick= "window.location.href =');
                        echo("'take.php?stuid=".$row['student_id']."&abs=0';");
                        echo('">');
						echo('Present');
						echo('</button>');
                        ?>
					</div>
                    <div class="container-login100-form-btn">
                    <?php
						echo('<button class="login100-form-btn" style="background: red" onclick= "window.location.href =');
                        echo("'take.php?stuid=".$row['student_id']."&abs=1';");
                        echo('">');
						echo('Absent');
						echo('</button>');
                        ?>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							
						</span>
						<a class="txt2" href="#">
							
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							
							
						</a>
					</div>
                    </div>
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