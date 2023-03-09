--  insert categories 
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Electronics',
        'Category for electronic products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Furniture',
        'Category for furniture products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Sports',
        'Category for sports products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Clothing',
        'Category for clothing products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Food',
        'Category for food products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Books',
        'Category for book products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Toys',
        'Category for toy products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Beauty',
        'Category for beauty products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Home Appliances',
        'Category for home appliance products',
        NOW(),
        NOW()
    );
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Automotive',
        'Category for automotive products',
        NOW(),
        NOW()
    );
-- insert tax 
INSERT INTO tax (name, rate, created, modified)
VALUES (
        'ICMS',
        18.00,
        '2023-03-07 09:00:00',
        '2023-03-07 09:00:00'
    ),
    (
        'IPI',
        10.00,
        '2023-03-07 09:00:00',
        '2023-03-07 09:00:00'
    ),
    (
        'PIS',
        1.65,
        '2023-03-07 09:00:00',
        '2023-03-07 09:00:00'
    ),
    (
        'COFINS',
        7.60,
        '2023-03-07 09:00:00',
        '2023-03-07 09:00:00'
    ),
    (
        'ISS',
        3.00,
        '2023-03-07 09:00:00',
        '2023-03-07 09:00:00'
    );
--  insert products 
INSERT INTO products (
        name,
        description,
        price,
        category_id,
        tax_id,
        created,
        modified
    )
VALUES (
        'iPhone 13 Pro',
        'New Apple iPhone',
        10999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Samsung Galaxy S21 Ultra',
        'New Samsung smartphone',
        7999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Sony PlayStation 5',
        'The latest Sony console',
        4999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Xbox Series X',
        'The latest Microsoft console',
        4699,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Canon EOS R6',
        'New Canon camera',
        11999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Nikon Z7 II',
        'New Nikon camera',
        13999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'LG OLED TV',
        'New LG TV',
        9999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Samsung QLED TV',
        'New Samsung TV',
        8999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Lenovo ThinkPad X1 Carbon',
        'New Lenovo laptop',
        9999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    ),
    (
        'Dell XPS 13',
        'New Dell laptop',
        8999,
        (
            SELECT id
            FROM categories
            ORDER BY RANDOM()
            LIMIT 1
        ), (
            SELECT id
            FROM tax
            ORDER BY RANDOM()
            LIMIT 1
        ), NOW(),
        NOW()
    );
-- sales insert
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'John Doe',
        '12345678901',
        '2023-03-07 14:30:00',
        '[{"item": "Product 1", "quantity": 2, "price": 10.50}, {"item": "Product 2", "quantity": 1, "price": 7.90}]',
        28.90
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Jane Smith',
        '09876543210',
        '2023-03-07 15:00:00',
        '[{"item": "Product 3", "quantity": 1, "price": 15.75}]',
        15.75
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Bob Johnson',
        '45678901234',
        '2023-03-07 16:30:00',
        '[{"item": "Product 4", "quantity": 3, "price": 5.00}]',
        15.00
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Maria Silva',
        '98765432100',
        '2023-03-07 17:15:00',
        '[{"item": "Product 2", "quantity": 2, "price": 7.90}, {"item": "Product 5", "quantity": 1, "price": 25.00}]',
        40.80
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Joe Black',
        '33333333333',
        '2023-03-07 18:00:00',
        '[{"item": "Product 1", "quantity": 4, "price": 10.50}]',
        42.00
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Julia Garcia',
        '22222222222',
        '2023-03-07 19:45:00',
        '[{"item": "Product 6", "quantity": 2, "price": 8.00}, {"item": "Product 7", "quantity": 1, "price": 12.50}]',
        28.50
    );
INSERT INTO sales (
        buyer_name,
        buyer_cpf,
        purchase_date,
        items_list,
        total_value
    )
VALUES (
        'Carlos Oliveira',
        '77777777777',
        '2023-03-07 20:30:00',
        '[{"item": "Product 8", "quantity": 1, "price": 18.99}, {"item": "Product 9", "quantity": 1, "price": 7.00}]',
        25.99
    );