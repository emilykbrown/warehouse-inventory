DROP SCHEMA IF EXISTS warehouse_inventory;

CREATE SCHEMA warehouse_inventory;

USE warehouse_inventory;

-- ==== RBAC ====

CREATE TABLE user_tbl (
    user_id VARCHAR(40) PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    user_first_name VARCHAR(40) NOT NULL,
    user_last_name VARCHAR(55) NOT NULL,
    user_email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE role_tbl (
	role_id VARCHAR(40) PRIMARY KEY,
    role_name VARCHAR(40) NOT NULL,
    role_desc TEXT NOT NULL
);

CREATE TABLE user_role_tbl (
	user_role_id VARCHAR(40) PRIMARY KEY,
    user_id VARCHAR (40) NOT NULL,
    role_id VARCHAR (40) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_tbl(user_id),
    FOREIGN KEY (role_id) REFERENCES role_tbl(role_id)
);

	
-- ==== Inventory ====

CREATE TABLE inventory_category_tbl (
	inventory_category_id VARCHAR(40) PRIMARY KEY,
    inventory_category_name VARCHAR(40) NOT NULL,
    inventory_category_desc TEXT NOT NULL
);

CREATE TABLE inventory_tbl (
	inventory_id VARCHAR(40) PRIMARY KEY,
    inventory_sku VARCHAR(50) UNIQUE NOT NULL,
    inventory_category_id VARCHAR(40) NOT NULL,
    inventory_name VARCHAR(100),
    inventory_desc TEXT NOT NULL,
    inventory_unit VARCHAR (20),
    unit_price DECIMAL (10,2),
    min_stocked_level INT NOT NULL,
    inventory_img_path VARCHAR(255),
    FOREIGN KEY (inventory_category_id) REFERENCES inventory_category_tbl(inventory_category_id)
);

CREATE TABLE inventory_stock_tbl (
	inventory_stock_id VARCHAR(40) PRIMARY KEY,
	inventory_id VARCHAR(40) NOT NULL,
    inventory_stocked_qty INT NOT NULL,
   FOREIGN KEY (inventory_id) REFERENCES inventory_tbl(inventory_id)
);


CREATE TABLE stock_movement_tbl (
    stock_movement_id VARCHAR(40) PRIMARY KEY,
    inventory_stock_id VARCHAR(40) NOT NULL,
    movement_type ENUM('in', 'out') NOT NULL,
    movement_qty INT NOT NULL,
    movement_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id VARCHAR(40) NOT NULL,
    movement_note TEXT,
    FOREIGN KEY (inventory_stock_id) REFERENCES inventory_stock_tbl(inventory_stock_id),
    FOREIGN KEY (user_id) REFERENCES user_tbl(user_id)
);

CREATE TABLE location_tbl (
    location_id VARCHAR(40) PRIMARY KEY,
    location_name VARCHAR(100) NOT NULL,
    location_desc TEXT,
    parent_location_id VARCHAR(40) NULL,
    FOREIGN KEY (parent_location_id) REFERENCES location_tbl(location_id)
);

CREATE TABLE inventory_location_tbl (
	inventory_location_id VARCHAR(40) PRIMARY KEY,
    inventory_id VARCHAR(40) NOT NULL,
    location_id VARCHAR(40) NOT NULL,
    units_stocked INT,
   FOREIGN KEY (inventory_id) REFERENCES inventory_tbl(inventory_id),
   FOREIGN KEY (location_id) REFERENCES location_tbl(location_id)
);

CREATE TABLE address_tbl (
  address_id VARCHAR(40) PRIMARY KEY,
  street_line_one VARCHAR(255) NOT NULL,
  street_line_two VARCHAR(255) NULL,
  street_line_three VARCHAR(255) NULL,
  city VARCHAR(100) NOT NULL,
  state VARCHAR(100) NOT NULL,
  postal_code VARCHAR(20) NOT NULL,
  country VARCHAR(100) NOT NULL,
  address_type ENUM('billing', 'shipping', 'physical') NOT NULL
);

CREATE TABLE supplier_tbl (
    supplier_id VARCHAR(40) PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    supplier_contact_name VARCHAR(100),
    supplier_phone_number VARCHAR(20),
    supplier_email VARCHAR(255),
    supplier_address VARCHAR(40),
    supplier_website VARCHAR(255),
    FOREIGN KEY (supplier_address) REFERENCES address_tbl(address_id)
);

CREATE TABLE inventory_supplier_tbl (
	inventory_supplier_id VARCHAR(40) PRIMARY KEY,
    inventory_id VARCHAR(40) NOT NULL,
    supplier_id VARCHAR(40) NOT NULL,
    unit_price DECIMAL (10,2),
    min_order_qty INT,
   FOREIGN KEY (inventory_id) REFERENCES inventory_tbl(inventory_id),
   FOREIGN KEY (supplier_id) REFERENCES supplier_tbl(supplier_id)
);

CREATE TABLE inventory_order_tbl (
    inventory_order_id VARCHAR(40) PRIMARY KEY,
    supplier_id VARCHAR(40) NOT NULL,
    order_date DATE NOT NULL,
    expected_delivery_date DATE NULL,
    delivery_date DATE NULL,
    status ENUM('pending', 'ordered', 'received', 'stocked', 'cancelled') DEFAULT 'pending',
    total_amount DECIMAL(10,2) DEFAULT 0.00,
    placed_by VARCHAR(40) NOT NULL,
    approved_by VARCHAR(40) NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier_tbl(supplier_id),
    FOREIGN KEY (placed_by) REFERENCES user_tbl(user_id),
    FOREIGN KEY (approved_by) REFERENCES user_tbl(user_id)
);

CREATE TABLE inventory_order_item_tbl (
    inventory_order_item_id VARCHAR(40) NOT NULL,
    inventory_id VARCHAR(40) NOT NULL,
    inventory_order_id VARCHAR(40) NOT NULL,
    qty_ordered INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2), -- qty_ordered * unit_price
    FOREIGN KEY (inventory_order_id) REFERENCES inventory_order_tbl(inventory_order_id),
    FOREIGN KEY (inventory_id) REFERENCES inventory_tbl(inventory_id)
);

-- Above is debugged

CREATE TABLE restaurant_tbl (
    restaurant_id VARCHAR(40) PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    restaurant_contact_name VARCHAR(255),
    restaurant_phone_number VARCHAR(20),
    restaurant_email VARCHAR(255),
    restaurant_website VARCHAR(255),
    restaurant_billing_address VARCHAR(40),
    restaurant_shipping_address VARCHAR(40),
    FOREIGN KEY (restaurant_billing_address) REFERENCES address_tbl(address_id),
    FOREIGN KEY (restaurant_shipping_address) REFERENCES address_tbl(address_id)
);

CREATE TABLE restaurant_order_tbl (
    restaurant_order_id VARCHAR(40) PRIMARY KEY,
    restaurant_id VARCHAR(40), 
    order_date DATE NOT NULL,
    delivery_date DATE,
    order_status ENUM('pending', 'confirmed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    total_amount DECIMAL(10,2) DEFAULT 0.00,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant_tbl(restaurant_id)
);

CREATE TABLE restaurant_order_item_tbl (
    restaurant_order_item_id VARCHAR(40) PRIMARY KEY,
    restaurant_order_id VARCHAR(40) NOT NULL,
    inventory_id VARCHAR(40) NOT NULL,
    qty_ordered INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2), -- qty_ordered * unit_price
    FOREIGN KEY (restaurant_order_id) REFERENCES restaurant_order_tbl(restaurant_order_id),
    FOREIGN KEY (inventory_id) REFERENCES inventory_tbl(inventory_id)
);

CREATE TABLE invoice_tbl (
    invoice_id VARCHAR(40) PRIMARY KEY,
    restaurant_id VARCHAR(40) NOT NULL, 
    invoice_date DATE NOT NULL,
    invoice_due_date DATE NOT NULL,
    invoice_total_amount DECIMAL(10,2) NOT NULL,
    invoice_status ENUM('unpaid', 'paid', 'partially_paid', 'overdue') DEFAULT 'unpaid',
    FOREIGN KEY (restaurant_id) REFERENCES restaurant_tbl(restaurant_id)
);

CREATE TABLE payment_tbl (
    payment_id VARCHAR(40) PRIMARY KEY,
    invoice_id VARCHAR(40) NOT NULL, 
    payment_date DATE NOT NULL,
    payment_amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('cash', 'check', 'credit_card', 'bank_transfer') NOT NULL,
    reference_number VARCHAR(100),
    FOREIGN KEY (invoice_id) REFERENCES invoice_tbl(invoice_id)
);  

CREATE TABLE audit_log_tbl (
    audit_id VARCHAR(40) PRIMARY KEY,
    user_id VARCHAR(40) NOT NULL,
    audit_action VARCHAR(50) NOT NULL,
    table_name VARCHAR(100) NOT NULL,
    record_id VARCHAR(40) NOT NULL,
    audit_desc TEXT,
    FOREIGN KEY (user_id) REFERENCES user_tbl(user_id)
);