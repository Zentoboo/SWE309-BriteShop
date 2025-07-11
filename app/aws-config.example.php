<?php
require_once 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// AWS Configuration - REPLACE WITH YOUR VALUES
$bucket_name = 'YOUR_BUCKET_NAME_HERE';
$region = 'YOUR_REGION_HERE';
$access_key = 'YOUR_ACCESS_KEY_HERE';
$secret_key = 'YOUR_SECRET_KEY_HERE';

$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => $region,
    'credentials' => [
        'key'    => $access_key,
        'secret' => $secret_key,
    ]
]);
?>
