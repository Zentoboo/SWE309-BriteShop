<?php
require_once 'config.php';

// Fetch products
$products = $pdo->query("SELECT * FROM products ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BriteShop - Manage Products</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .product-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px; }
        .upload-form { margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 5px; }
        .upload-form input[type="file"] { margin: 10px 0; }
        .btn { background: #667eea; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #5a6fd8; }
        .current-image { font-size: 12px; color: #666; word-break: break-all; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌿 BriteShop - Product Image Management</h1>
            <p>Upload product images to AWS S3 Cloud Storage</p>
            <p><a href="index.php" style="color: #ffd700;">← Back to Store</a></p>
        </div>
        
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><strong>Price:</strong> £<?php echo number_format($product['price'], 2); ?></p>
                    <p><strong>Stock:</strong> <?php echo $product['stock_quantity']; ?> units</p>
                    
                    <div class="current-image">
                        <strong>Current Image URL:</strong><br>
                        <?php echo htmlspecialchars($product['image_url']); ?>
                    </div>
                    
                    <div class="upload-form">
                        <form action="upload-image.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <label for="image_<?php echo $product['id']; ?>">Upload New Image:</label>
                            <input type="file" id="image_<?php echo $product['id']; ?>" name="product_image" accept="image/*" required>
                            <button type="submit" class="btn">Upload to S3</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
