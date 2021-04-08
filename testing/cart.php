<?php
require_once '../connect.php';
$stmt = mysqli_prepare($con , "SELECT * FROM products");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$products = mysqli_fetch_all($result, 1);
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
               <?php
                session_start();
                if (isset($_SESSION["products"])){
                    $items= count(array_unique($_SESSION["products"]));
                }
               ?>
               <div>
                   <a href="checkout.php" class="btn btn-success btn-sm mt-2 mb-2 float-right"><?=$items??0 ?> Items In The Cart. Checkout</a>
               </div>
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th>NAME</th>
                      <th>GENRE</th>
                      <th>DESC</th>
                      <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                       <?php foreach ($products as $movie): ?>
                           <tr>
                               <td> <?=$movie["title"]?> </td>
                               <td> <?=$movie["genre"]?> </td>
                               <td> <?=$movie["description"]?> </td>
                               <td><a href="add.php?id=<?=$movie["id"]?>" class="btn btn-info btn-sm">Add To Cart</a> </td>
                           </tr>
                       <?php endforeach; ?>
                  </tbody>
              </table>
           </div>
       </div>
   </div>


</body>
</html>
