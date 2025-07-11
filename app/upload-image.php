<?php
require_once 'config.php';
require_once 'aws-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['product_image'])) {
    $file = $_FILES['product_image'];
    $product_id = $_POST['product_id'];
    
    // Validate file
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        die('❌ Error: Only image files are allowed');
    }
    
    if ($file['size'] > 5 * 1024 * 1024) { // 5MB limit
        die('❌ Error: File too large (max 5MB)');
    }
    
    try {
        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'product_' . $product_id . '_' . time() . '.' . $file_extension;
        
        // Upload to S3
        $result = $s3Client->putObject([
            'Bucket' => $bucket_name,
            'Key'    => 'products/' . $filename,
            'SourceFile' => $file['tmp_name'],
            'ContentType' => $file['type'],
            'ACL'    => 'public-read'
        ]);
        
        // Get the S3 URL
        $s3_url = $result['ObjectURL'];
        
        // Update database with new image URL
        $sql = "UPDATE products SET image_url = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$s3_url, $product_id]);
        
        echo "✅ Image uploaded successfully! <a href='manage-products.php'>Back to Products</a>";
        
    } catch (AwsException $e) {
        echo "❌ AWS Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }
}
?>
