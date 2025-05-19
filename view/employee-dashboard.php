<?php

require "../rbac.php";
checkAccess(['inventory_manager', 'warehouse_staff', 'customer_support']);

echo "employee dashboard";

?>