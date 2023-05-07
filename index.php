 <?php require('header.php'); ?>
 <h1>Home Page</h1>
 <?php
    if (!isset($_SESSION['USER_ID'])) {
        header("Location: login.php");
    }
    ?>
    <a href="order.php" >Add New Order</a>
 <div class="container">
     <div class="row">
         <div class="col-lg-6">
             <form id="form-product" enctype="multipart/form-data">
                 <input type="text" class="form-control" name="save-product" hidden>
                 <div class="form-group">
                     <label>Image</label>
                     <input type="file" class="form-control-file" name="product_image" accept=".png, .jpg, .jpeg" required>
                 </div>
                 <div class="form-group mt-2">
                     <label>Porduct Name</label>
                     <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                 </div>
                 <div class="form-group mt-2">
                     <label>Porduct Price</label>
                     <input type="number" name="product_price" class="form-control" placeholder="Product Price" required>
                 </div>
                 <button type="submit" class="btn btn-primary mt-4">Submit</button>
             </form>
         </div>
         <div class="col-lg-6">
             <div class="card">
                 <div class="card-body">
                   <h5 class="card-title">Products</h5>
                    <div id="product-list"></div>
                 </div>
             </div>

         </div>
     </div>
 </div>

 <?php //include('sample.php')  ?>
 <div id="sample-load"></div>
 <a href="actions.php?type=logout">Logout</a>
 <input id="num1" value="2" />
 <?php require('footer.php');  ?>

 <script>
     $("#sample-load").load('sample.php?name=jhon')

     const num1 = document.getElementById("num1").value;
     const num1b = $("#num1").val();
     // console.log({num1});
     // console.log({num1b})

     function apiCall() {
         $.ajax({
             url: 'actions.php',
             type: "POST",
             data: {
                 testApi: '',
                 num1: num1,
                 name: 'Niel',
             },
             success: function(response) {

             },
             error: function(e) {
                 alert("Error");
             }
         });
     }
     // apiCall();
    $("#product-list").load('product-list.php')

     $("#form-product").on('submit', (function(e) {
         e.preventDefault();
         //const formdata = $("#form-product").serialize();
         $.ajax({
             url: 'actions.php',
             type: "POST",
             data: new FormData(this),
             contentType: false,
             cache: false,
             processData: false,
             success: function(response) {
                $("#product-list").load('product-list.php')
             },
             error: function(e) {
                 console.log(e);
                 alert("Error");
             }
         });
         return false;
     }));
 </script>