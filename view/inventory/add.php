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
    
    

    <div class="container mt-3 mb-3 d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
    2               <div class="mb-3 mt-3">
                        <label for="inventory-name">Product Name</label>
                        <input type="text" class="form-control" name="inventory-name" id="inventory-name"
                            placeholder="Product Name">
                    </div>            
                    <span class="error">
                        <?php echo $product_error; ?>
                    </span>
                </form>


        </div>
        </div>
    </div>
    <?php

    include ("../view/components/js-scripts.php");
    
    ?>
</body>
</html>