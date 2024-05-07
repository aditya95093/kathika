<?php
session_start();
include ('includes/config.php');

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email']; 


    $sql = "SELECT UserName FROM tbladmin WHERE UserName=:username OR Email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        
        $sql = "INSERT INTO tbladmin (UserName, Password, Email) VALUES (:username, :password, :email)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Registration successful. You can now login.');</script>";
    } else {
        
        echo "<script>alert('Username or email already exists. Please choose a different username or email.');</script>";
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin Signup</title>
	<link rel="icon" href="img\icon.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
    
        <div class="form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1 class="text-center text-bold text-light mt-4x">Sign Up</h1>
                        <div class="well row pt-2x pb-3x bk-light">
                            <div class="col-md-8 col-md-offset-2">
                                <form method="post">
                                    <label for="" class="text-uppercase text-sm">Username</label>
                                    <input type="text" placeholder="Username" name="username" class="form-control mb">
                                    <label for="" class="text-uppercase text-sm">Password</label>
                                    <input type="password" placeholder="Password" name="password"
                                        class="form-control mb">
                                    <label for="" class="text-uppercase text-sm">Email</label>
                                    <input type="email" placeholder="Email" name="email" class="form-control mb">
                                    
                                    <button class="btn btn-primary btn-block" name="signup" type="submit">Sign
                                        Up</button>
                                </form>
                                <div class="card-footer text-center" style="padding-top: 30px;">
                                    <div class="small"><a href="index.php" class="btn btn-primary">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>