DROP SCHEMA IF EXISTS inventory_schema;

CREATE SCHEMA inventory_schema;

USE inventory_schema;

-- ==== RBAC ====

CREATE TABLE role_tbl (
	role_id VARCHAR(40) PRIMARY KEY,
    role_name VARCHAR(40) NOT NULL,
    role_desc TEXT NOT NULL
);

CREATE TABLE user_tbl (
    user_id VARCHAR(40) PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    user_first_name VARCHAR(40) NOT NULL,
    user_last_name VARCHAR(55) NOT NULL,
    user_email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role_id VARCHAR (40) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES role_tbl(role_id)
);

-- ==== Inventory ====

CREATE TABLE inventory_tbl (
	inventory_id VARCHAR(40) PRIMARY KEY,
    inventory_sku VARCHAR(50) UNIQUE NOT NULL,
    inventory_name VARCHAR(100),
    inventory_desc TEXT NOT NULL,
    inventory_unit VARCHAR (20),
    unit_price DECIMAL (10,2),
    min_stocked_level INT NOT NULL
);

CREATE TABLE inventory_stock_tbl (
	inventory_stock_id VARCHAR(40) PRIMARY KEY,
	inventory_id VARCHAR(40) NOT NULL,
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
