<?php
include 'protect.php';
if ( isset($_REQUEST["phone"]) )
{
    //Get our form data
    $names = $_REQUEST["names"]; //$_GET $_POST
    $phone = $_REQUEST["phone"];
    require_once 'connect.php';
    //$sql = "INSERT INTO `customers`(`id`, `names`, `phone`) VALUES (null,'$names','$phone')";
    //mysqli_query($con, $sql) or die( mysqli_error($con) );// executing the query
    $stmt = mysqli_prepare($con , "INSERT INTO `customers`(`names`, `phone`) VALUES (?,?)");
    //bind data
    mysqli_stmt_bind_param($stmt, "ss", $names, $phone);
    mysqli_stmt_execute($stmt);
    mysqli_close($con);//close the connection
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers Form</title>
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
            <h4>Add Customer</h4>
            <form action="register-customer.php" method="post">

                <div class="form-group">
                    <label>Names</label>
                    <input type="text" class="form-control" name="names" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>

                <button class="btn btn-danger">Add Customer</button>

            </form>
        </div>
    </div>
</div>


</body>
</html>
