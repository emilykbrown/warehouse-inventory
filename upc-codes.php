<?php
$categories = array(
    array("Cleaning Supplies", "Sanitizers, detergents, and cleaning tools"),
    array("Kitchen Equipment", "Utensils, small appliances, and tools"),
    array("Packaging Supplies", "To-go containers, bags, and wraps"),
    array("Office Supplies", "Pens, paper, printers, and related items"),
    array("Maintenance Tools", "Tools and parts for facility maintenance"),
    array("Safety Equipment", "Gloves, masks, first aid kits, and PPE"),
    array("Uniforms", "Aprons, chef coats, hats, and other garments"),
    array("Beverage Equipment", "Coffee machines, blenders, and dispensers"),
    array("Waste Management", "Trash bins, liners, and recycling supplies"),
    array("Miscellaneous", "General items not covered by other categories")
);

$file_path = "/mnt/data/non_food_inventory_category.csv";

$file = fopen($file_path, "w");
fputcsv($file, array("category_id", "category_name", "category_desc"));
foreach ($categories as $category) {
    fputcsv($file, array(uniqid(), $category[0], $category[1]));
}
fclose($file);

echo $file_path;