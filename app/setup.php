<?php
require_once 'config.php';

try {
    // Create products table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        category VARCHAR(100),
        stock_quantity INT DEFAULT 0,
        image_url VARCHAR(500),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);

    // Create customers table
    $sql = "CREATE TABLE IF NOT EXISTS customers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        phone VARCHAR(20),
        address TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);

    // Insert sample data
    $sql = "INSERT IGNORE INTO products (name, description, price, category, stock_quantity, image_url) VALUES 
        ('Eco Cotton T-Shirt', 'Sustainable organic cotton t-shirt', 25.99, 'Tops', 100, 'https://via.placeholder.com/300x300?text=Eco+T-Shirt'),
        ('Bamboo Fiber Jeans', 'Comfortable jeans made from bamboo fiber', 89.99, 'Bottoms', 50, 'https://via.placeholder.com/300x300?text=Bamboo+Jeans'),
        ('Recycled Polyester Jacket', 'Warm jacket made from recycled materials', 129.99, 'Outerwear', 25, 'https://via.placeholder.com/300x300?text=Recycled+Jacket'),
        ('Hemp Canvas Sneakers', 'Durable sneakers with hemp canvas', 79.99, 'Footwear', 75, 'https://via.placeholder.com/300x300?text=Hemp+Sneakers'),
        ('Organic Linen Dress', 'Elegant dress made from organic linen', 119.99, 'Dresses', 30, 'https://via.placeholder.com/300x300?text=Linen+Dress')";
    $pdo->exec($sql);

    echo "<h2>✅ Database setup completed successfully!</h2>";
    echo "<p>Tables created and sample data inserted.</p>";
    echo "<p><a href='index.php'>Go to BriteShop App</a></p>";

} catch(PDOException $e) {
    echo "<h2>❌ Database setup failed!</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
