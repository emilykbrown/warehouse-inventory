<?php

require "../rbac.php";
checkAccess(['inventory_manager', 'warehouse_staff', 'customer_support']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    include ("../view/components/css-links.php");
    
    ?>
</head>
<body>
    <?php

    include ("../view/components/navbar.php");

    ?>
    test employee dashboard

    <?php

    include ("../view/components/js-scripts.php");
    
    ?>
</body>
</html>