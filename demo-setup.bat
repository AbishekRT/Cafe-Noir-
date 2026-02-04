@echo off
REM ============================================================
REM Cafe Noir Demo Setup Script for Windows
REM ============================================================
REM This script sets up the Cafe Noir e-commerce demo for local
REM development. Run this after cloning the repository.
REM ============================================================

echo.
echo ============================================================
echo.
echo              CAFE NOIR DEMO SETUP
echo.
echo        Premium Coffee E-Commerce Platform
echo        Developed by Nexora Solutions
echo.
echo ============================================================
echo.

REM Check for PHP
echo Checking prerequisites...
where php >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: PHP is not installed. Please install PHP 8.2 or higher.
    pause
    exit /b 1
)
echo [OK] PHP found

REM Check for Composer
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Composer is not installed. Please install Composer.
    pause
    exit /b 1
)
echo [OK] Composer found

REM Check for Node.js
where node >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Node.js is not installed. Please install Node.js 18+.
    pause
    exit /b 1
)
echo [OK] Node.js found

echo.
echo Installing PHP dependencies...
call composer install --no-interaction --prefer-dist

echo.
echo Installing NPM dependencies...
call npm install

echo.
echo Setting up environment...
if not exist .env (
    copy .env.example .env
    echo [OK] Created .env file from .env.example
) else (
    echo [INFO] .env file already exists, skipping...
)

echo.
echo Generating application key...
call php artisan key:generate --force

echo.
echo Creating storage symbolic link...
call php artisan storage:link --force 2>nul

echo.
echo ============================================================
echo DATABASE SETUP
echo ============================================================
echo.
echo Please ensure MySQL is running and create the database:
echo.
echo   CREATE DATABASE cafe_noir CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo.
echo Update your .env file with the correct database credentials.
echo.
pause

echo.
echo Running database migrations...
call php artisan migrate --force

echo.
echo Seeding database with demo data...
call php artisan db:seed --force

echo.
echo Building frontend assets...
call npm run build

echo.
echo Clearing and optimizing caches...
call php artisan optimize:clear
call php artisan config:cache
call php artisan route:cache
call php artisan view:cache

echo.
echo ============================================================
echo.
echo         SETUP COMPLETE!
echo.
echo ============================================================
echo.
echo   To start the development server, run:
echo.
echo     php artisan serve
echo.
echo   Then visit: http://127.0.0.1:8000
echo.
echo ============================================================
echo.
echo   Admin Panel: http://127.0.0.1:8000/admin/dashboard
echo.
echo   Admin Credentials:
echo     Email:    admin@cafenoir.com
echo     Password: password
echo.
echo ============================================================
echo.
echo   Stripe Test Cards:
echo     Success: 4242 4242 4242 4242
echo     Decline: 4000 0000 0000 0002
echo.
echo ============================================================
echo.
echo Developed with love by Nexora Solutions
echo.
pause
