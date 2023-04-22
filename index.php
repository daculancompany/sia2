 <?php require('header.php'); ?>
 <h1>Home Page</h1>
<?php
    if(!isset($_SESSION['USER_ID'])){
        header("Location: login.php");
    }
?>
 <div class="container">
     <div class="row">
         <div class="col-lg-6">
             <form action="">
             </form>
         </div>
         <div class="col-lg-6">
             <div class="card">
                 <div class="card-body">
                     <h5 class="card-title">Products</h5>
                     <table class="table">
                         <thead>
                             <tr>
                                 <th scope="col">Name</th>
                                 <th scope="col">Price</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $sql = "SELECT * FROM products";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {;
                                ?>
                                     <tr>
                                         <td><?= $row['product_name'] ?></td>
                                         <td><?= number_format($row['product_price'],2) ?></td>
                                     </tr>
                             <?php }
                                } ?>
                         </tbody>
                     </table>
                 </div>
             </div>

         </div>
     </div>
 </div>
<a  href="actions.php?type=logout" >Logout</a>
 <?php require('footer.php');  ?>