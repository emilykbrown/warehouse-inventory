CREATE TABLE restaurant_tbl (
    restaurant_id VARCHAR(40) PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    restaurant_contact_name VARCHAR(255),
    restaurant_phone_number VARCHAR(20),
    restaurant_email VARCHAR(255),
    restaurant_billing_address TEXT,
    restaurant_shipping_address TEXT
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
    record_id INT NOT NULL,
    audit_desc TEXT,
    FOREIGN KEY (user_id) REFERENCES user_tbl(user_id)
);