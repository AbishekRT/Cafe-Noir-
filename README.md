# Cafe Noir - Premium Coffee E-Commerce Website

A beautiful, production-ready e-commerce website for a premium coffee brand, built with Laravel 12, Blade templates, and Tailwind CSS.

**Developed by Nexora Solutions**

## Features

### Storefront

- 🏠 Elegant homepage with featured products and brand story
- 🛍️ Product catalog with category filtering and search
- 📦 Detailed product pages with image galleries
- 🛒 Session-based shopping cart (works for guests)
- 💳 Checkout with Cash on Delivery and Stripe payments
- 📱 Fully responsive design for all devices
- 💬 Contact form with subject categories
- ❓ FAQ page with accordion sections
- 📖 About us page with team section
- 💬 WhatsApp floating button for quick contact

### Admin Panel

- 📊 Dashboard with sales statistics and quick actions
- 📦 Product management (CRUD, image uploads, SEO settings)
- 🏷️ Category management
- 📋 Order management with status updates
- 📬 Contact message management
- 📈 Low stock alerts
- 🔐 Admin-only access via middleware

### Technical Features

- 🔐 Laravel Breeze authentication (login, register, password reset)
- 🖼️ Automatic image resizing (1200/600/300px)
- 🔌 RESTful API with Laravel Sanctum
- ⚡ Cached featured products (60s TTL)
- 🔍 SEO-optimized pages with meta tags
- ♿ Accessibility-focused markup
- 🎨 Consistent design system

## Design System

| Element      | Color                    |
| ------------ | ------------------------ |
| Primary      | `#4E342E` (Coffee Brown) |
| Secondary    | `#F5EFE6` (Cream)        |
| Accent       | `#C9A24D` (Gold)         |
| Heading Text | `#2E1F1A`                |
| Body Text    | `#4A3B36`                |
| Muted Text   | `#8B7355`                |

**Typography:**

- Headings: Playfair Display
- Body: Inter

## Requirements

- PHP 8.2+
- Composer 2.x
- Node.js 18+ & npm
- MySQL 8.0+ or SQLite
- Git

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd "Cafe Noir demo website"
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

For quick setup with SQLite (default):

```bash
touch database/database.sqlite
```

Or edit `.env` file for MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe_noir
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Build Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 9. Start the Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Demo Accounts

| Role     | Email                | Password |
| -------- | -------------------- | -------- |
| Admin    | admin@cafenoir.com   | password |
| Customer | customer@example.com | password |

## Stripe Configuration

For payment testing, add your Stripe test keys to `.env`:

```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

Get your test keys from the [Stripe Dashboard](https://dashboard.stripe.com/apikeys).

### Test Card Numbers

| Card          | Number              |
| ------------- | ------------------- |
| Success       | 4242 4242 4242 4242 |
| Requires Auth | 4000 0025 0000 3155 |
| Declined      | 4000 0000 0000 0002 |

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   ├── Api/            # API controllers
│   │   │   └── *.php           # Storefront controllers
│   │   └── Middleware/
│   │       └── EnsureUserIsAdmin.php
│   ├── Models/                 # Eloquent models
│   └── Services/               # Business logic services
├── config/
│   └── cafe.php                # App-specific configuration
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Demo data seeders
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/              # Admin panel views
│       ├── components/         # Blade components
│       ├── layouts/            # Layout templates
│       ├── pages/              # Static pages
│       ├── shop/               # Shop views
│       ├── cart/               # Cart views
│       └── checkout/           # Checkout views
├── routes/
│   ├── web.php                 # Web routes
│   └── api.php                 # API routes
└── tailwind.config.js          # Tailwind configuration
```

## API Endpoints

### Products

| Method | Endpoint               | Description         |
| ------ | ---------------------- | ------------------- |
| GET    | `/api/products`        | List all products   |
| GET    | `/api/products/{slug}` | Get product details |

### Orders (Requires Auth)

| Method | Endpoint           | Description        |
| ------ | ------------------ | ------------------ |
| GET    | `/api/orders`      | List user's orders |
| GET    | `/api/orders/{id}` | Get order details  |

## Testing

```bash
php artisan test
```

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Run `composer install --optimize-autoloader --no-dev`
3. Run `npm run build`
4. Configure your web server (Nginx/Apache)
5. Set up SSL certificate
6. Configure proper cache and session drivers
7. Set up queue worker for background jobs

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Built with ❤️ by Nexora Solutions**
