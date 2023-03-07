CREATE TABLE IF NOT EXISTS categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(256) NOT NULL,
    description TEXT NOT NULL,
    created TIMESTAMP NOT NULL,
    modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS tax (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    rate NUMERIC(5, 2) NOT NULL,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(32) NOT NULL,
    description TEXT NOT NULL,
    price NUMERIC(10, 0) NOT NULL,
    category_id INT NOT NULL,
    tax_id INT,
    created TIMESTAMP NOT NULL,
    modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories (id),
    FOREIGN KEY (tax_id) REFERENCES tax (id)
);
--  insert tax 
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
        1,
        1,
        NOW(),
        NOW()
    ),
    (
        'Samsung Galaxy S21 Ultra',
        'New Samsung smartphone',
        7999,
        1,
        2,
        NOW(),
        NOW()
    ),
    (
        'Sony PlayStation 5',
        'The latest Sony console',
        4999,
        2,
        3,
        NOW(),
        NOW()
    ),
    (
        'Xbox Series X',
        'The latest Microsoft console',
        4699,
        2,
        2,
        NOW(),
        NOW()
    ),
    (
        'Canon EOS R6',
        'New Canon camera',
        11999,
        3,
        1,
        NOW(),
        NOW()
    ),
    (
        'Nikon Z7 II',
        'New Nikon camera',
        13999,
        2,
        2,
        NOW(),
        NOW()
    ),
    (
        'LG OLED TV',
        'New LG TV',
        9999,
        2,
        3,
        NOW(),
        NOW()
    ),
    (
        'Samsung QLED TV',
        'New Samsung TV',
        8999,
        3,
        2,
        NOW(),
        NOW()
    ),
    (
        'Lenovo ThinkPad X1 Carbon',
        'New Lenovo laptop',
        9999,
        2,
        1,
        NOW(),
        NOW()
    ),
    (
        'Dell XPS 13',
        'New Dell laptop',
        8999,
        2,
        2,
        NOW(),
        NOW()
    );
--  insert categories 
INSERT INTO categories (name, description, created, modified)
VALUES (
        'Eletrônicos',
        'Categoria para produtos eletrônicos',
        NOW(),
        NOW()
    ),
    (
        'Móveis',
        'Categoria para produtos de móveis',
        NOW(),
        NOW()
    ),
    (
        'Esportes',
        'Categoria para produtos de esportes',
        NOW(),
        NOW()
    ),
    (
        'Roupas',
        'Categoria para produtos de roupas',
        NOW(),
        NOW()
    ),
    (
        'Alimentos',
        'Categoria para produtos de alimentos',
        NOW(),
        NOW()
    );