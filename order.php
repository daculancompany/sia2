<?php require('header.php'); ?>
<h1>Home Page</h1>
<?php
if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php");
}
?>
<style>
    .product-list {
        display: flex;
        flex-wrap: wrap;
    }

    .product-list .product {
        padding: 10px;
        background: #d5d5d5;
        margin: 20px;
        width: 200px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="product-list">
                <?php
                $products = [];
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($products, $row);
                ?>
                        <div class="product" onclick="addcart(<?= $row['id'] ?>)">
                            <p><img style="max-width: 100px; max-heigth: 100px" src="uploads/<?= $row['image'] ?>" /></p>
                            <p><?= $row['product_name'] ?></p>
                            <p><?= number_format($row['product_price'], 2) ?></p>
                            </tr>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Order</h4>
            <table class="table" style="max-width: 700px">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="view-order"></tbody>
        </table>
            <p>Items  <span id="total-items">0</span></p>
            <p>Total Amout  <span id="total-amount">0.00</span></p>
            <button class="btn btn-primary" type="button" onclick="submitOrder()" >Submit Order</button>
        </div>
    </div>

</div>
<a href="actions.php?type=logout">Logout</a>
<?php require('footer.php');  ?>
<?php
$toJSONProducts = json_encode($products);
?>
<script>
    let products =  <?= $toJSONProducts ?>;
    let orders = []
    function addcart(id){
       let productIndex = products.findIndex((item) => parseInt(item.id) === parseInt(id) );
        // note:  if product is exist just add current qty of that product this function is not yet included.
       if(productIndex !== -1){
           products[productIndex].qty = 1;
           orders.push(products[productIndex])
       }
       viewCart()
    }

    function viewCart(){
        let order_table = ""
        let total_order_amount = 0;
        for (let index = 0; index < orders.length; index++) {
            const item = orders[index]; 
            let total = parseInt(item?.qty) * parseFloat(item?.product_price);
            total_order_amount+=total
            order_table += 
                `<tr class="${index}">
                    <th scope="row">${index + 1}</th>
                    <td>${item?.product_name}</td>
                    <td>${parseInt(item?.qty)}</td>
                    <td>${parseFloat(item?.product_price)}</td>
                    <td>${total}</td>
                    <td>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>`;
        }
        $("#total-items").text(orders.length);
        $("#total-amount").text(total_order_amount);
        $("#view-order").html(order_table);
        
    }

    function submitOrder(){
        $.ajax({
             url: 'actions.php',
             type: "POST",
             data: {
                saveOrder: '',
                orders: orders,
                total_amount:  $("#total-amount").text()
             },
             success: function(response) {

             },
             error: function(e) {
                 alert("Error");
             }
         });
    }

   
</script>