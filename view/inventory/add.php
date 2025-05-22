<?php

include "../../config/variables.php";

include "../../controller/inventory-controller.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include "../../view/components/css-links.php";
    
    ?>
<style>
    .error {
        color: red;
    }
</style>
</head>
<body>
    <div class="container">
    <?php

    include "../../view/components/navbar.php";

    ?>
    
    

    <div class="container mt-3 mb-3 d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="inventory_name">Product Name</label>
                        <input type="text" class="form-control" name="inventory_name" id="inventory_name"
                            placeholder="Product Name">
                    </div>            
                    <span class="error">
                        <?php echo $inventory_name_error; ?>
                    </span>
                   <div class="mb-3 mt-3">
                        <label for="inventory_upc">UPC Code</label>
                        <input type="text" class="form-control" name="inventory_upc" id="inventory_upc"
                            placeholder="UPC Code">
                    </div>            
                    <span class="error">
                        <?php echo $upc_error; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="inventory_category">Category</label>
                        <input type="text" class="form-control" name="inventory_category" id="inventory_category"
                            placeholder="Category">
                    </div>            
                    <span class="error">
                        <?php echo $category_error; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="unit_price">Unit Price</label>
                        <input type="text" class="form-control" name="unit_price" id="unit_price"
                            placeholder="Unit Price">
                    </div>            
                    <span class="error">
                        <?php echo $unit_price_error; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="inventory_img">Product Image</label>
                        <input type="file" class="form-control" name="inventory_img" id="inventory_img"
                            placeholder="Product Image">
                    </div>            
                    <span class="error">
                        <?php echo $inventory_img_error; ?>
                    </span>
                    <div class="d-grid gap-4">
                        <button type="submit" name="add-product" value="add-product" class="btn btn-success">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    include "../../view/components/js-scripts.php";
    
    ?>
</body>
</html>