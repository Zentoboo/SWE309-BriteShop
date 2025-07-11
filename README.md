# 🌿 BriteShop - Sustainable Fashion E-commerce

A cloud-based e-commerce platform for sustainable fashion, built on AWS infrastructure.

## 🏗️ Architecture

```
Web Browser ←→ EC2 (Apache/PHP) ←→ RDS (MySQL)
                     ↓
                S3 (Images)
```

**Components:**
- **EC2:** Ubuntu web server with Apache & PHP
- **RDS:** MySQL database for products and customers  
- **S3:** Cloud storage for product images

## ✨ Features

- 🛍️ Product catalog with sustainable fashion items
- 👤 Customer registration system
- 📱 Responsive design (mobile-friendly)
- ☁️ Cloud image storage and management
- 📊 Real-time inventory tracking

## 🛠️ Tech Stack

- **Backend:** PHP, MySQL, Apache
- **Frontend:** HTML, CSS, JavaScript
- **Cloud:** AWS EC2, RDS, S3
- **Dependencies:** AWS SDK for PHP

## 📁 Project Structure

```
briteshop/
├── index.html              # Landing page
├── app/
│   ├── index.php           # Main store
│   ├── setup.php           # Database setup
│   ├── manage-products.php # Admin panel
│   ├── upload-image.php    # S3 uploads
│   ├── config.example.php  # Database config template
│   └── aws-config.example.php # AWS config template
└── README.md
```

## 🚀 Quick Setup

### 1. Launch EC2 Instance
- AMI: Ubuntu 22.04 LTS
- Type: t2.micro (free tier)
- Security: Allow HTTP (80), SSH (22)

### 2. Install Dependencies
```bash
sudo apt update
sudo apt install apache2 php php-mysql composer -y
```

### 3. Clone & Configure
```bash
cd /var/www/html
git clone https://github.com/ZenRoboo/SWE309-BriteShop.git .
cd app && composer install
```

### 4. Setup Database (RDS)
- Create MySQL RDS instance
- Copy `config.example.php` to `config.php`
- Add your database credentials

### 5. Setup S3 Storage
- Create S3 bucket for images
- Copy `aws-config.example.php` to `aws-config.php`  
- Add your AWS credentials

### 6. Initialize
```bash
# Visit to create tables and sample data
http://your-server-ip/app/setup.php
```

## 🔧 Configuration

**Database (config.php):**
```php
$servername = "your-rds-endpoint";
$username = "admin";
$password = "your-password";
$dbname = "briteshop";
```

**AWS S3 (aws-config.php):**
```php
$bucket_name = 'your-bucket-name';
$region = 'ap-southeast-2';
$access_key = 'your-access-key';
$secret_key = 'your-secret-key';
```

## 🛡️ Security

- Database credentials not in repository
- AWS keys excluded from Git
- SQL injection prevention
- Input validation on all forms

## 📊 Demo Data

Includes 5 sample sustainable fashion products:
- Eco Cotton T-Shirt (£25.99)
- Bamboo Fiber Jeans (£89.99)
- Recycled Polyester Jacket (£129.99)
- Hemp Canvas Sneakers (£79.99)
- Organic Linen Dress (£119.99)

## 🎯 Usage

**Customer View:**
- Browse products at `/app/index.php`
- Register as customer
- View real-time inventory

**Admin View:**
- Manage products at `/app/manage-products.php`
- Upload images directly to S3
- View customer registrations

## 🔗 Links

- **Live Demo:** `http://your-ec2-ip/app/`
- **Admin Panel:** `http://your-ec2-ip/app/manage-products.php`
- **GitHub:** `https://github.com/ZenRoboo/SWE309-BriteShop`

## 📝 Notes

- Built for educational purposes
- Free tier AWS resources used
- Supports UK & Europe expansion
- 24/7 availability design

---
*Sustainable fashion for a better tomorrow* 🌍
