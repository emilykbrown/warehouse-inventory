<?php
require_once '../rbac.php';
checkAccess(['inventory_manager']);

include "../config/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory</title>
    <?php include("../view/components/css-links.php"); ?>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <?php include("../view/components/navbar.php"); ?>

        <a href="inventory/add.php" class="btn btn-success mb-3">Add Product</a>

        <table id="inventory-tbl" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>UPC</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Unit Cost</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $con->prepare("SELECT inventory_id, inventory_name, inventory_upc, inventory_category, unit_price, inventory_img_path FROM inventory_tbl");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['inventory_upc']) ?></td>
                        <td>
                            <a href="inventory/view.php?id=<?= urlencode($row['inventory_id']) ?>">
                                <?= htmlspecialchars($row['inventory_name']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($row['inventory_category']) ?></td>
                        <td><?= htmlspecialchars($row['unit_price']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($row['inventory_img_path']) ?>" width="75" height="110" alt="Product Image">
                        </td>
                        <td>
                            <a href='inventory/edit.php?id=<?= urlencode($row['inventory_id']) ?>' class='btn btn-info btn-sm'>
                                <img src='img/pen-solid.svg' width='16' height='16' alt='Edit'>
                            </a>
                            &nbsp;
                            <button onclick='confirmInventoryDelete("<?= $row['inventory_id'] ?>")' class='btn btn-sm btn-danger'>
                                <img src='img/x-solid.svg' width='16' height='16' style='filter: invert(1);' alt='Delete'>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include "../view/components/js-scripts.php"; ?>
    <!-- DataTables + jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#inventory-tbl').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                order: []
            });
        });

        function confirmInventoryDelete(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = 'inventory/delete.php?id=' + encodeURIComponent(id);
            }
        }
    </script>
</body>
</html>
