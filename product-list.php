<?php
require ('config.php');

?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Image</th>
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
                    <td><img style="max-width: 100px; max-heigth: 100px" src="uploads/<?= $row['image'] ?>" /></td>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= number_format($row['product_price'], 2) ?></td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>