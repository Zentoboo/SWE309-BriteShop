<?php
require_once 'config.php';

// Handle new customer registration
if ($_POST['action'] == 'add_customer') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    try {
        $sql = "INSERT INTO customers (name, email, phone, address) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, $address]);
        $message = "✅ Customer registered successfully!";
    } catch(PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}

// Fetch products
$products = $pdo->query("SELECT * FROM products ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$customer_count = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
$product_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BriteShop - Sustainable Fashion Store</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f8f9fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .stats { display: flex; justify-content: space-around; margin: 20px 0; }
        .stat { text-align: center; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 10px; }
        .main-content { padding: 40px 0; }
        .section { margin-bottom: 40px; }
        .section h2 { color: #333; margin-bottom: 20px; font-size: 2em; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .product-card:hover { transform: translateY(-5px); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; }
        .product-info { padding: 20px; }
        .product-info h3 { color: #333; margin-bottom: 10px; }
        .product-info p { color: #666; margin-bottom: 10px; }
        .price { font-size: 1.5em; color: #27ae60; font-weight: bold; }
        .stock { color: #e74c3c; font-weight: bold; }
        .form-section { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-group { flex: 1; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #667eea; }
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: transform 0.3s; }
        .btn:hover { transform: translateY(-2px); }
        .message { padding: 15px; margin-bottom: 20px; border-radius: 5px; font-weight: bold; }
        .message.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>🌿 BriteShop</h1>
            <p>Sustainable Fashion Store - Connected to Cloud Database</p>
            <div class="stats">
                <div class="stat">
                    <h3><?php echo $product_count; ?></h3>
                    <p>Products Available</p>
                </div>
                <div class="stat">
                    <h3><?php echo $customer_count; ?></h3>
                    <p>Registered Customers</p>
                </div>
                <div class="stat">
                    <h3>✅</h3>
                    <p>Database Connected</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container main-content">
        <?php if (isset($message)): ?>
            <div class="message <?php echo strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="section">
            <h2>🛍️ Our Sustainable Products</h2>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                            <p class="price">£<?php echo number_format($product['price'], 2); ?></p>
                            <p class="stock">Stock: <?php echo $product['stock_quantity']; ?> units</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="section">
            <h2>👤 Join Our Community</h2>
            <div class="form-section">
                <form method="POST">
                    <input type="hidden" name="action" value="add_customer">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn">Register as Customer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
