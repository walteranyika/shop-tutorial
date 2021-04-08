<?php
session_start();
if (isset($_SESSION["products"])){
    $ids= array_unique($_SESSION["products"]);
    $string = implode(",", $ids);
    require_once '../connect.php';
    $stmt = mysqli_prepare($con , "SELECT * FROM products WHERE id IN($string)");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $products = mysqli_fetch_all($result,1);
    $total=0;
    foreach ($products as $p){
      $total+= $p["price"];
    }
    if ($total==0){
        header("location:cart.php");
    }
}
if (isset($_POST['submit'])){
    $ids= array_unique($_SESSION["products"]);
    unset($_SESSION["products"]);
    header("location:cart.php");
}

if (isset($_GET["remove"])){
    $_SESSION["products"]=array_diff($_SESSION["products"], [$_GET["remove"]] );
    header("location:checkout.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <form action="checkout.php" method="post" class="float-right">
               <span>Total KES <?=$total??0 ?></span>
               <button name="submit" type="submit" class="btn btn-success btn-sm">Complete</button>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>GENRE</th>
                        <th>DESC</th>
                        <th>PRICE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $movie): ?>
                    <tr>
                        <td> <?=$movie["title"]?> </td>
                        <td> <?=$movie["genre"]?> </td>
                        <td> <?=$movie["description"]?> </td>
                        <td> <?=$movie["price"]?> </td>
                        <td><a class="btn btn-danger btn-sm" href="checkout.php?remove=<?= $movie["id"] ?>">Remove</a> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>
</html>