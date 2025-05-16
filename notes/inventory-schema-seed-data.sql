USE inventory_schema;

-- RBAC

INSERT INTO user_tbl (user_id, username, user_first_name, user_last_name, user_email, password_hash) VALUES
(UUID(), 'jsmith', 'James', 'Smith', 'jsmith@warehouse.com', '$2y$10$yp2X.yqPOwDaLssHJhjuYuDOTj7VaeTQyBdSqGuZk6jBWcMGWHevO'),
(UUID(), 'aolson', 'Abby', 'Olson', 'aolson@warehouse.com', '$2y$10$2JB/kxTlwJNVWUrq9JsM3uDT7kHbH3LCVxEv0duBHGD.Eu/LZiJBi'),
(UUID(), 'rnelson', 'Robert', 'Nelson', 'rnelson@warehouse.com', '$2y$10$cHGnbiZwFCotlEHw.I48w.O.LD4QKgx.Cp9uqY8JmgliRPAAJs8H2'),
(UUID(), 'mjones', 'Mark', 'Jones', 'mjones@warehouse.com', '$2y$10$9iUexixJ049wszvNFNBVo.J1RDHrKeb5tgsTqTGyFSv9MJX/uZe3.'),
(UUID(), 'smiller', 'Sarah', 'Miller', 'sarah012@zmail.com', '$2y$10$BJHW1VJHoDmByDFt1n66ue725SvMFSdBFjGaukEXXy8g..NWv1NQq');

INSERT INTO role_tbl (role_id, role_name, role_desc) VALUES
(UUID(), 'server_admin', 'Has complete control and access over RBAC and all CRUD actions in the employee portal.'),
(UUID(), 'inventory_manager', 'Has complete control and access over inventory items, stock, and stock movements.'),
(UUID(), 'warehouse_staff', 'Able to update and view stock movements as well as view inventory.'),
(UUID(), 'customer_support', 'Able to view inventory and current stock numbers.'),
(UUID(), 'employee', 'Access to employee portal.'),
(UUID(), 'customer', 'Able to view inventory, add products to cart, and view order history (when implemented).');

INSERT INTO user_role_tbl (user_role_id, user_id, role_id) VALUES
(UUID, (SELECT user_id FROM user_tbl WHERE username='jsmith'), (SELECT role_id FROM role_tbl WHERE role_name='server_admin')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='jsmith'), (SELECT role_id FROM role_tbl WHERE role_name='employee')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='aolson'), (SELECT role_id FROM role_tbl WHERE role_name='inventory_manager')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='aolson'), (SELECT role_id FROM role_tbl WHERE role_name='employee')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='rnelson'), (SELECT role_id FROM role_tbl WHERE role_name='warehouse_staff')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='rnelson'), (SELECT role_id FROM role_tbl WHERE role_name='employee')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='mjones'), (SELECT role_id FROM role_tbl WHERE role_name='customer_support')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='mjones'), (SELECT role_id FROM role_tbl WHERE role_name='employee')),
(UUID, (SELECT user_id FROM user_tbl WHERE username='smiller'), (SELECT role_id FROM role_tbl WHERE role_name='customer'));

