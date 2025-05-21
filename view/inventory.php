<?php

include "../config/database.php";

//  var_dump($inventory_img_path);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include ("../view/components/css-links.php");
    
    ?>
</head>
<body>
    <div class="container">

    
    <?php

    include ("../view/components/navbar.php");
    ?>
    <div class="container mt-5">
        <a href="inventory/add.php" class="btn btn-success mb-3">Add Product</a>
        <table id="inventory-tbl" class="table table-striped">
            <thead>
                <tr>
                    <th>UPC</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Unit Cost</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $inventory_tbl = $con->prepare("SELECT inventory_name, inventory_upc, inventory_category, unit_price, inventory_img_path FROM inventory_tbl");
                $inventory_tbl->execute();
                while ($row = $inventory_tbl->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['inventory_upc'] . '</td>';
                    echo '<td><a href="inventory/view.php?id=' . $row['inventory_upc'] . '">' . htmlspecialchars($row['inventory_name']) . '</a></td>';
                    echo '<td>' . $row['inventory_category'] . '</td>';
                    echo '<td>' . $row['unit_price'] . '</td>';
                    echo '<td><img src="' . $row['inventory_img_path'] . '" width="75" height="110"></td>';
                    echo '<td>';
                    // Add edit/delete/view buttons here if needed
                    echo '</td>';
                    echo '</tr>';
                }
                

                ?>
            </tbody>
        </table>
    </div>
    <?php

    include "../view/components/js-scripts.php";
    
    ?>
<script>
    $(document).ready(function () {
        $('#inventory-tbl').DataTable();
    });
</script>
</body>
</html>