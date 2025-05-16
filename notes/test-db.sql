INSERT INTO inventory_category_tbl (category_id, category_name, category_desc) VALUES
(UUID(), 'Proteins', 'Meats, seafood, and protein-based ingredients'),
(UUID(), 'Dairy & Eggs', 'Milk products, cheeses, and eggs'),
(UUID(), 'Dry Goods & Baking', 'Flours, sugars, grains, and baking supplies'),
(UUID(), 'Produce - Vegetables', 'Fresh vegetables and herbs'),
(UUID(), 'Produce - Fruits', 'Fresh fruits and berries'),
(UUID(), 'Oils & Condiments', 'Cooking oils, sauces, and condiments'),
(UUID(), 'Spices & Seasonings', 'Spices, herbs, and seasonings'),
(UUID(), 'Canned & Jarred', 'Canned goods and jarred ingredients'),
(UUID(), 'Frozen Goods', 'Frozen vegetables, fruits, and prepared foods'),
(UUID(), 'Stocks & Broths', 'Prepared stocks, broths, and bases'),
(UUID(), 'Sweeteners & Syrups', 'Honey, syrups, and sweet extracts');

INSERT INTO inventory_tbl (inventory_id, inventory_sku, inventory_name, inventory_desc, inventory_unit, unit_price, min_stocked_level) VALUES
(UUID(), 'SKU-0001', 'Chicken Breast', 'Fresh boneless skinless chicken breast', 'kg', 7.50, 10),
(UUID(), 'SKU-0002', 'Ground Beef', 'Fresh ground beef 80/20', 'kg', 8.00, 10),
(UUID(), 'SKU-0003', 'Salmon Fillet', 'Fresh Atlantic salmon fillet', 'kg', 15.00, 5),
(UUID(), 'SKU-0004', 'Pork Belly', 'Fresh pork belly, skinless', 'kg', 9.00, 5),
(UUID(), 'SKU-0005', 'Olive Oil', 'Extra virgin olive oil', 'liter', 12.00, 5),
(UUID(), 'SKU-0006', 'Canola Oil', 'Refined canola oil', 'liter', 4.50, 10),
(UUID(), 'SKU-0007', 'All-Purpose Flour', 'Premium all-purpose wheat flour', 'kg', 1.80, 20),
(UUID(), 'SKU-0008', 'Granulated Sugar', 'Fine white granulated sugar', 'kg', 2.20, 20),
(UUID(), 'SKU-0009', 'Brown Sugar', 'Light brown sugar', 'kg', 2.50, 10),
(UUID(), 'SKU-0010', 'Sea Salt', 'Coarse sea salt', 'kg', 1.50, 5),
(UUID(), 'SKU-0011', 'Black Pepper', 'Ground black pepper', 'kg', 18.00, 2),
(UUID(), 'SKU-0012', 'Butter (Salted)', 'Salted dairy butter', 'kg', 6.50, 10),
(UUID(), 'SKU-0013', 'Heavy Cream', 'Heavy whipping cream 35%', 'liter', 5.50, 5),
(UUID(), 'SKU-0014', 'Milk (Whole)', 'Whole cow’s milk', 'liter', 1.20, 10),
(UUID(), 'SKU-0015', 'Eggs (Large)', 'Fresh large eggs', 'dozen', 3.00, 5),
(UUID(), 'SKU-0016', 'Mozzarella Cheese', 'Low moisture mozzarella cheese block', 'kg', 9.50, 5),
(UUID(), 'SKU-0017', 'Parmesan Cheese', 'Grated parmesan cheese', 'kg', 14.00, 2),
(UUID(), 'SKU-0018', 'Cheddar Cheese', 'Sharp cheddar cheese block', 'kg', 10.00, 5),
(UUID(), 'SKU-0019', 'Tomatoes (Roma)', 'Fresh Roma tomatoes', 'kg', 3.50, 10),
(UUID(), 'SKU-0020', 'Lettuce (Romaine)', 'Fresh Romaine lettuce heads', 'each', 1.80, 15),
(UUID(), 'SKU-0021', 'Spinach (Fresh)', 'Fresh baby spinach', 'kg', 4.00, 5),
(UUID(), 'SKU-0022', 'Onions (Yellow)', 'Yellow onions', 'kg', 2.00, 10),
(UUID(), 'SKU-0023', 'Garlic (Fresh)', 'Whole garlic bulbs', 'kg', 5.00, 3),
(UUID(), 'SKU-0024', 'Basil (Fresh)', 'Fresh basil bunch', 'bunch', 2.50, 2),
(UUID(), 'SKU-0025', 'Parsley (Fresh)', 'Fresh flat-leaf parsley', 'bunch', 1.50, 2),
(UUID(), 'SKU-0026', 'Ketchup', 'Tomato ketchup', 'liter', 3.00, 5),
(UUID(), 'SKU-0027', 'Mayonnaise', 'Real egg mayonnaise', 'liter', 4.50, 5),
(UUID(), 'SKU-0028', 'Soy Sauce', 'Naturally brewed soy sauce', 'liter', 6.00, 3),
(UUID(), 'SKU-0029', 'Balsamic Vinegar', 'Aged balsamic vinegar', 'liter', 10.00, 2),
(UUID(), 'SKU-0030', 'Red Wine Vinegar', 'Red wine vinegar', 'liter', 5.00, 2),
(UUID(), 'SKU-0031', 'Pasta (Spaghetti)', 'Dried spaghetti pasta', 'kg', 2.20, 10),
(UUID(), 'SKU-0032', 'Rice (Basmati)', 'Long grain basmati rice', 'kg', 3.00, 15),
(UUID(), 'SKU-0033', 'Chili Flakes', 'Crushed red chili flakes', 'kg', 12.00, 1),
(UUID(), 'SKU-0034', 'Honey', 'Raw wildflower honey', 'liter', 9.00, 2),
(UUID(), 'SKU-0035', 'Vanilla Extract', 'Pure vanilla extract', 'liter', 25.00, 1),
(UUID(), 'SKU-0036', 'Baking Powder', 'Double acting baking powder', 'kg', 4.00, 2),
(UUID(), 'SKU-0037', 'Yeast (Active Dry)', 'Active dry baker’s yeast', 'kg', 15.00, 1),
(UUID(), 'SKU-0038', 'Cornstarch', 'Fine cornstarch powder', 'kg', 3.00, 3),
(UUID(), 'SKU-0039', 'Lemon Juice', 'Bottled lemon juice', 'liter', 4.50, 3),
(UUID(), 'SKU-0040', 'Beef Stock (Premade)', 'Prepared beef stock concentrate', 'liter', 6.00, 5),
(UUID(), 'SKU-0041', 'Chicken Stock (Premade)', 'Prepared chicken stock concentrate', 'liter', 5.50, 5),
(UUID(), 'SKU-0042', 'Maple Syrup', 'Pure maple syrup', 'liter', 15.00, 2),
(UUID(), 'SKU-0043', 'Canned Tomatoes', 'Whole peeled canned tomatoes', 'kg', 3.80, 10),
(UUID(), 'SKU-0044', 'Canned Black Beans', 'Canned black beans', 'kg', 2.50, 8),
(UUID(), 'SKU-0045', 'Canned Chickpeas', 'Canned garbanzo beans', 'kg', 2.60, 8),
(UUID(), 'SKU-0046', 'Tuna (Canned)', 'Canned tuna in oil', 'kg', 8.00, 5),
(UUID(), 'SKU-0047', 'Frozen French Fries', 'Pre-cut frozen French fries', 'kg', 3.50, 10),
(UUID(), 'SKU-0048', 'Frozen Peas', 'Frozen green peas', 'kg', 3.00, 5),
(UUID(), 'SKU-0049', 'Frozen Mixed Berries', 'Frozen assorted berries', 'kg', 6.50, 3),
(UUID(), 'SKU-0050', 'Chocolate Chips', 'Semi-sweet chocolate chips', 'kg', 7.00, 4);



-- Proteins (1111)
UPDATE inventory_tbl SET category_id = '1111' WHERE inventory_name = 'Chicken Breast';
UPDATE inventory_tbl SET category_id = '1111' WHERE inventory_name = 'Ground Beef';
UPDATE inventory_tbl SET category_id = '1111' WHERE inventory_name = 'Salmon Fillet';
UPDATE inventory_tbl SET category_id = '1111' WHERE inventory_name = 'Shrimp';

-- Dairy & Eggs (2222)
UPDATE inventory_tbl SET category_id = '2222' WHERE inventory_name = 'Whole Milk';
UPDATE inventory_tbl SET category_id = '2222' WHERE inventory_name = 'Butter';
UPDATE inventory_tbl SET category_id = '2222' WHERE inventory_name = 'Cheddar Cheese';
UPDATE inventory_tbl SET category_id = '2222' WHERE inventory_name = 'Heavy Cream';
UPDATE inventory_tbl SET category_id = '2222' WHERE inventory_name = 'Eggs';

-- Dry Goods & Baking (3333)
UPDATE inventory_tbl SET category_id = '3333' WHERE inventory_name = 'All-purpose Flour';
UPDATE inventory_tbl SET category_id = '3333' WHERE inventory_name = 'Granulated Sugar';
UPDATE inventory_tbl SET category_id = '3333' WHERE inventory_name = 'Rice';
UPDATE inventory_tbl SET category_id = '3333' WHERE inventory_name = 'Pasta';
UPDATE inventory_tbl SET category_id = '3333' WHERE inventory_name = 'Baking Powder';

-- Produce - Vegetables (4444)
UPDATE inventory_tbl SET category_id = '4444' WHERE inventory_name = 'Onion';
UPDATE inventory_tbl SET category_id = '4444' WHERE inventory_name = 'Garlic';
UPDATE inventory_tbl SET category_id = '4444' WHERE inventory_name = 'Bell Pepper';
UPDATE inventory_tbl SET category_id = '4444' WHERE inventory_name = 'Carrot';
UPDATE inventory_tbl SET category_id = '4444' WHERE inventory_name = 'Spinach';

-- Produce - Fruits (5555)
UPDATE inventory_tbl SET category_id = '5555' WHERE inventory_name = 'Lemon';
UPDATE inventory_tbl SET category_id = '5555' WHERE inventory_name = 'Apple';
UPDATE inventory_tbl SET category_id = '5555' WHERE inventory_name = 'Banana';
UPDATE inventory_tbl SET category_id = '5555' WHERE inventory_name = 'Strawberry';
UPDATE inventory_tbl SET category_id = '5555' WHERE inventory_name = 'Lime';

-- Oils & Condiments (6666)
UPDATE inventory_tbl SET category_id = '6666' WHERE inventory_name = 'Olive Oil';
UPDATE inventory_tbl SET category_id = '6666' WHERE inventory_name = 'Soy Sauce';
UPDATE inventory_tbl SET category_id = '6666' WHERE inventory_name = 'Ketchup';
UPDATE inventory_tbl SET category_id = '6666' WHERE inventory_name = 'Mayonnaise';
UPDATE inventory_tbl SET category_id = '6666' WHERE inventory_name = 'Vinegar';

-- Spices & Seasonings (7777)
UPDATE inventory_tbl SET category_id = '7777' WHERE inventory_name = 'Black Pepper';
UPDATE inventory_tbl SET category_id = '7777' WHERE inventory_name = 'Salt';
UPDATE inventory_tbl SET category_id = '7777' WHERE inventory_name = 'Cinnamon';
UPDATE inventory_tbl SET category_id = '7777' WHERE inventory_name = 'Paprika';
UPDATE inventory_tbl SET category_id = '7777' WHERE inventory_name = 'Oregano';

-- Canned & Jarred (8888)
UPDATE inventory_tbl SET category_id = '8888' WHERE inventory_name = 'Tomato Paste';
UPDATE inventory_tbl SET category_id = '8888' WHERE inventory_name = 'Canned Beans';
UPDATE inventory_tbl SET category_id = '8888' WHERE inventory_name = 'Peanut Butter';
UPDATE inventory_tbl SET category_id = '8888' WHERE inventory_name = 'Jam';
UPDATE inventory_tbl SET category_id = '8888' WHERE inventory_name = 'Canned Tuna';

-- Frozen Goods (9999)
UPDATE inventory_tbl SET category_id = '9999' WHERE inventory_name = 'Frozen Peas';
UPDATE inventory_tbl SET category_id = '9999' WHERE inventory_name = 'Frozen Fries';
UPDATE inventory_tbl SET category_id = '9999' WHERE inventory_name = 'Frozen Berries';
UPDATE inventory_tbl SET category_id = '9999' WHERE inventory_name = 'Frozen Pizza Dough';
UPDATE inventory_tbl SET category_id = '9999' WHERE inventory_name = 'Frozen Chicken Wings';

-- Stocks & Broths (aaaa)
UPDATE inventory_tbl SET category_id = 'aaaa' WHERE inventory_name = 'Chicken Stock';
UPDATE inventory_tbl SET category_id = 'aaaa' WHERE inventory_name = 'Beef Stock';

-- Sweeteners & Syrups (bbbb)
UPDATE inventory_tbl SET category_id = 'bbbb' WHERE inventory_name = 'Honey';
UPDATE inventory_tbl SET category_id = 'bbbb' WHERE inventory_name = 'Maple Syrup';
