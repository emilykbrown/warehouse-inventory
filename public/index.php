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

<?php
include '../config/database.php';


$query = "SELECT inventory_id, inventory_name, inventory_upc, inventory_category, unit_price, inventory_img_path
          FROM inventory_tbl";
$stmt = $con->prepare($query);
$stmt->execute();
?>

<div class="container py-4">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="col">
                <div class="card book-card h-100">
                    <div class="img-container position-relative">
                        <img src="../view/<?= htmlspecialchars($product['inventory_img_path']) ?>" class="card-img-top img book-cover" alt="Product Image" width="161.367" height="243">
                        
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($row['inventory_name']) ?></h5>
                        <p class="card-text text-muted"><?= htmlspecialchars($row['inventory_category']) ?></p>
                        <p class="fw-bold">$<?= htmlspecialchars($row['unit_price']) ?></p>
                    </div>
                    <div class="card-footer text-center d-flex justify-content-around">
                        Add to cart
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <!-- 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="descModalLabel<?= $row['inventory_id'] ?>"><?= htmlspecialchars($row['inventory_name']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= nl2br(htmlspecialchars($row['inventory_desc'])) ?>
                        </div>
                    </div>
                </div>
            </div> -->
        <?php endwhile; ?>
    </div>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    </div>
    <?php

    include ("../view/components/js-scripts.php");
    
    ?>
</body>
</html>