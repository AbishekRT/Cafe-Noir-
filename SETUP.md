# Cafe Noir - Setup Guide

This guide will help you set up the Cafe Noir e-commerce project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.2 or higher** (with extensions: pdo_mysql, mysqli, mbstring, openssl, json)
- **Composer** (PHP dependency manager)
- **Node.js 18+** and **npm**
- **MySQL 8.0+** or **MariaDB 10.3+**
- **Git**

---

## Step 1: Clone the Repository

```bash
git clone https://github.com/AbishekRT/Cafe-Noir-.git
cd Cafe-Noir-
```

---

## Step 2: Install PHP Dependencies

```bash
composer install
```

---

## Step 3: Install Node Dependencies

```bash
npm install
```

---

## Step 4: Configure Environment

Copy the `.env.example` file to `.env`:

```bash
# On Windows (PowerShell)
copy .env.example .env

# On Linux/Mac
cp .env.example .env
```

---

## Step 5: Generate Application Key

```bash
php artisan key:generate
```

---

## Step 6: Setup MySQL Database

### Option A: Using MySQL Command Line

1. **Open MySQL Command Line:**

    ```bash
    mysql -u root -p
    ```

2. **Create Database:**
    ```sql
    CREATE DATABASE cafe_noir CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    EXIT;
    ```

### Option B: Using phpMyAdmin

1. Open phpMyAdmin in your browser
2. Click "New" in the left sidebar
3. Database name: `cafe_noir`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

### Option C: Using MySQL Workbench

1. Open MySQL Workbench
2. Connect to your local MySQL server
3. Click "Create a new schema" icon
4. Schema name: `cafe_noir`
5. Charset: `utf8mb4`
6. Collation: `utf8mb4_unicode_ci`
7. Click "Apply"

---

## Step 7: Update .env File

Open `.env` file and update the database configuration:

```properties
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe_noir
DB_USERNAME=root
DB_PASSWORD=your_mysql_password_here
```

**Important:** Replace `your_mysql_password_here` with your actual MySQL root password. If you don't have a password, leave it empty.

---

## Step 8: Enable MySQL Extensions in PHP (Windows Users)

If you get "could not find driver" error:

1. **Find your php.ini file:**

    ```bash
    php --ini
    ```

2. **Open php.ini in a text editor (as Administrator)**

3. **Find and uncomment these lines (remove the semicolon `;`):**

    ```ini
    extension=pdo_mysql
    extension=mysqli
    ```

4. **Save the file**

5. **Verify extensions are loaded:**
    ```bash
    php -m | findstr pdo_mysql
    php -m | findstr mysqli
    ```

---

## Step 9: Create Storage Link

```bash
php artisan storage:link
```

---

## Step 10: Run Database Migrations

This will create all the necessary tables:

```bash
php artisan migrate
```

---

## Step 11: Seed the Database (Optional)

This will populate the database with sample data:

```bash
php artisan db:seed
```

This creates:

- 1 Admin user (admin@cafenoir.com / password)
- 4 Product categories
- 20 Sample coffee products

**Note:** Skip this step if you want to start with an empty database.

---

## Step 12: Build Frontend Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

---

## Step 13: Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## Default Credentials

If you ran the seeder (Step 11), you can login to the admin panel with:

- **URL:** http://localhost:8000/admin/dashboard
- **Email:** admin@cafenoir.com
- **Password:** password

---

## Troubleshooting

### Issue: "could not find driver"

**Solution:** Enable MySQL extensions in php.ini (see Step 8)

### Issue: "Access denied for user 'root'@'localhost'"

**Solution:** Check your MySQL username and password in `.env` file

### Issue: "Database does not exist"

**Solution:** Make sure you created the database (see Step 6)

### Issue: "Class 'ZipArchive' not found"

**Solution:** Enable zip extension in php.ini:

```ini
extension=zip
```

### Issue: "npm ERR! code ENOENT"

**Solution:** Make sure Node.js and npm are installed correctly

### Issue: Views not updating

**Solution:** Clear caches:

```bash
php artisan optimize:clear
```

---

## Project Structure

```
cafe-noir/
├── app/                    # Application code
│   ├── Http/
│   │   ├── Controllers/   # Controllers
│   │   └── Middleware/    # Middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── public/                # Public assets
│   └── images/           # Logos and images
├── resources/
│   └── views/            # Blade templates
├── routes/
│   ├── web.php          # Web routes
│   └── api.php          # API routes
└── tests/               # Tests
```

---

## Available Routes

### Public Pages

- Home: http://localhost:8000
- Shop: http://localhost:8000/shop
- Product Details: http://localhost:8000/shop/{product-slug}
- Cart: http://localhost:8000/cart
- Checkout: http://localhost:8000/checkout
- About: http://localhost:8000/about
- Contact: http://localhost:8000/contact
- FAQs: http://localhost:8000/faqs

### Admin Panel

- Dashboard: http://localhost:8000/admin/dashboard
- Products: http://localhost:8000/admin/products
- Categories: http://localhost:8000/admin/categories
- Orders: http://localhost:8000/admin/orders
- Contacts: http://localhost:8000/admin/contacts

---

## Running Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter AdminLoginTest
```

---

## Additional Commands

```bash
# Clear all caches
php artisan optimize:clear

# Clear specific caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Reset database (WARNING: Deletes all data)
php artisan migrate:fresh

# Reset and seed
php artisan migrate:fresh --seed

# List all routes
php artisan route:list
```

---

## Tech Stack

- **Backend:** Laravel 12.x
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL 8.0+
- **Authentication:** Laravel Breeze
- **Payments:** Stripe (test mode)
- **Image Processing:** Intervention Image
- **API:** Laravel Sanctum

---

## Features

✅ User Authentication (Login/Register)  
✅ Guest Checkout  
✅ Shopping Cart (Session-based)  
✅ Product Catalog with Categories  
✅ Product Search & Filtering  
✅ Admin Panel (CRUD for Products, Categories, Orders)  
✅ Order Management  
✅ Contact Form  
✅ Payment Methods (COD + Stripe)  
✅ Image Upload & Auto-resize  
✅ Responsive Design  
✅ RESTful API  
✅ SEO Optimized (Sitemap, Meta tags)

---

## Support

For issues or questions:

1. Check the Troubleshooting section above
2. Review the main README.md file
3. Check Laravel documentation: https://laravel.com/docs

---

## License

This project is developed by **Nexora Solutions** for demonstration purposes.

---

**Last Updated:** February 4, 2026  
**Version:** 1.0.0
