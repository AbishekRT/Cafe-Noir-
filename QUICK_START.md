# Cafe Noir - Quick Start Guide

## For Your Friend: Setup in 5 Minutes

### Prerequisites
- PHP 8.2+ (with MySQL extensions enabled)
- Composer installed
- Node.js 18+ and npm
- MySQL Server running
- Git installed

---

## Quick Setup Commands

```bash
# 1. Clone the repository
git clone https://github.com/AbishekRT/Cafe-Noir-.git
cd Cafe-Noir-

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
copy .env.example .env
php artisan key:generate

# 4. Create MySQL database
# Open MySQL and run: CREATE DATABASE cafe_noir;

# 5. Update .env file
# Set your MySQL password in DB_PASSWORD=

# 6. Run migrations
php artisan storage:link
php artisan migrate
php artisan db:seed

# 7. Build assets and start server
npm run build
php artisan serve
```

---

## Access the Application

- **Website:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin/dashboard
- **Admin Login:** admin@cafenoir.com / password

---

## Important Notes

✅ The `.env` file is NOT in the repository (for security)  
✅ You need to configure your own MySQL credentials  
✅ Run `php artisan db:seed` to get sample products and admin user  
✅ Make sure MySQL extensions are enabled in php.ini  

---

## Troubleshooting

**"Could not find driver"**
- Enable `extension=pdo_mysql` and `extension=mysqli` in php.ini

**"Access denied for user"**
- Check DB_PASSWORD in .env matches your MySQL password

**"Database does not exist"**
- Create database: `CREATE DATABASE cafe_noir;`

---

## Full Documentation

See **SETUP.md** for detailed step-by-step instructions.

---

**Repository:** https://github.com/AbishekRT/Cafe-Noir-.git  
**Developed by:** Nexora Solutions
