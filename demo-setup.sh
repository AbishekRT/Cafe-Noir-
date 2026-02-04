#!/bin/bash

# ============================================================
# Cafe Noir Demo Setup Script
# ============================================================
# This script sets up the Cafe Noir e-commerce demo for local
# development. Run this after cloning the repository.
# ============================================================

set -e

echo ""
echo "╔══════════════════════════════════════════════════════════╗"
echo "║                                                          ║"
echo "║              ☕ CAFE NOIR DEMO SETUP ☕                  ║"
echo "║                                                          ║"
echo "║        Premium Coffee E-Commerce Platform                ║"
echo "║        Developed by Nexora Solutions                     ║"
echo "║                                                          ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo ""

# Check for PHP
echo "🔍 Checking prerequisites..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.2 or higher."
    exit 1
fi

PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "✅ PHP $PHP_VERSION found"

# Check for Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer."
    exit 1
fi
echo "✅ Composer found"

# Check for MySQL
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL CLI not found. Make sure MySQL is running."
else
    echo "✅ MySQL CLI found"
fi

# Check for Node.js
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js 18+."
    exit 1
fi

NODE_VERSION=$(node -v)
echo "✅ Node.js $NODE_VERSION found"

echo ""
echo "📦 Installing PHP dependencies..."
composer install --no-interaction --prefer-dist

echo ""
echo "📦 Installing NPM dependencies..."
npm install

echo ""
echo "⚙️  Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Created .env file from .env.example"
else
    echo "ℹ️  .env file already exists, skipping..."
fi

echo ""
echo "🔑 Generating application key..."
php artisan key:generate --force

echo ""
echo "🔗 Creating storage symbolic link..."
php artisan storage:link --force 2>/dev/null || true

echo ""
echo "📊 Setting up database..."
echo "Please ensure MySQL is running and the database 'cafe_noir' exists."
echo ""
read -p "Do you want to create the database now? (y/n): " CREATE_DB

if [ "$CREATE_DB" = "y" ] || [ "$CREATE_DB" = "Y" ]; then
    read -p "MySQL username (default: root): " MYSQL_USER
    MYSQL_USER=${MYSQL_USER:-root}
    
    read -sp "MySQL password: " MYSQL_PASS
    echo ""
    
    mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "CREATE DATABASE IF NOT EXISTS cafe_noir CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        echo "✅ Database 'cafe_noir' created successfully"
    else
        echo "⚠️  Could not create database. Please create it manually."
    fi
fi

echo ""
echo "🗄️  Running database migrations..."
php artisan migrate --force

echo ""
echo "🌱 Seeding database with demo data..."
php artisan db:seed --force

echo ""
echo "🎨 Building frontend assets..."
npm run build

echo ""
echo "✨ Clearing and optimizing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "╔══════════════════════════════════════════════════════════╗"
echo "║                                                          ║"
echo "║         🎉 SETUP COMPLETE! 🎉                           ║"
echo "║                                                          ║"
echo "╠══════════════════════════════════════════════════════════╣"
echo "║                                                          ║"
echo "║  To start the development server, run:                   ║"
echo "║                                                          ║"
echo "║    php artisan serve                                     ║"
echo "║                                                          ║"
echo "║  Then visit: http://127.0.0.1:8000                       ║"
echo "║                                                          ║"
echo "╠══════════════════════════════════════════════════════════╣"
echo "║                                                          ║"
echo "║  Admin Panel: http://127.0.0.1:8000/admin/dashboard      ║"
echo "║                                                          ║"
echo "║  Admin Credentials:                                      ║"
echo "║    Email:    admin@cafenoir.com                          ║"
echo "║    Password: password                                    ║"
echo "║                                                          ║"
echo "╠══════════════════════════════════════════════════════════╣"
echo "║                                                          ║"
echo "║  Stripe Test Cards:                                      ║"
echo "║    Success: 4242 4242 4242 4242                          ║"
echo "║    Decline: 4000 0000 0000 0002                          ║"
echo "║                                                          ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo ""
echo "Developed with ❤️  by Nexora Solutions"
echo ""
