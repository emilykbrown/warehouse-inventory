<?php

include "../config/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ("../view/components/css-links.php"); ?>
</head>
<body>
    <div class="container">

    <?php include ("../view/components/navbar.php"); ?>

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
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $inventory_tbl = $con->prepare("SELECT inventory_id, inventory_name, inventory_upc, inventory_category, unit_price, inventory_img_path FROM inventory_tbl");
                $inventory_tbl->execute();
                while ($row = $inventory_tbl->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['inventory_upc']) . '</td>';
                    echo '<td><a href="inventory/view.php?id=' . urlencode($row['inventory_id']) . '">' . htmlspecialchars($row['inventory_name']) . '</a></td>';
                    echo '<td>' . htmlspecialchars($row['inventory_category']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['unit_price']) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($row['inventory_img_path']) . '" width="75" height="110"></td>';
                    echo '<td>';
                    echo "<a href='inventory/edit.php?id=" . urlencode($row['inventory_id']) . "' name='edit-inventory' class='btn btn-warning btn-sm'><img src='img/pen-solid.svg' width='16' height='16' style='filter: invert(1);' alt='Edit icon'></a>&nbsp;&nbsp;";
                    echo "<button onclick='confirmInventoryDelete(\"" . $row['inventory_id'] . "\")' class='btn btn-sm btn-danger deleteBtn'>";
                    echo "<img src='img/x-solid.svg' width='16' height='16' style='filter: invert(1);' alt='Delete icon'>";
                    echo "</button>";
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include "../view/components/js-scripts.php"; ?>

<script>
    $(document).ready(function () {
        $('#inventory-tbl').DataTable();
    });

    function confirmInventoryDelete(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = 'inventory/delete.php?id=' + encodeURIComponent(id);
        }
    }
</script>
</body>
</html>
