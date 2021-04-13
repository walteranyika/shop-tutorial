<?php
if ( isset($_REQUEST["email"]) )
{
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];//abc123
    require_once 'connect.php';
    $stmt = mysqli_prepare($con , "SELECT * FROM users WHERE email=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1)
    {
       $user = mysqli_fetch_assoc($result);
       $hash = $user["password"];
       if (password_verify($password, $hash))
       {//success 123456
          session_start();
          $_SESSION["names"] = $user["names"];//store users data in a session
          $_SESSION["id"] = $user["id"];
          $_SESSION["admin"] = $user["admin"];
          //redirect to 'home' page
          header("location:add-product.php"); //TODO go to sales.php
       }else{
          //failed
           setcookie("error","Wrong username or password", time()+3);
           header("location:login.php");
       }
    }
    else{
        setcookie("error","Wrong username or password", time()+3);
        header("location:login.php");
    }
    mysqli_close($con);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>Sign In</h4>

            <?php include 'alert.php'?>

            <form action="login.php" method="post">

                <div class="form-group">
                    <label>Username</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button class="btn btn-dark btn-block">Login</button>

            </form>
        </div>
    </div>
</div>


</body>
</html>