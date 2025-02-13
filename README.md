<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## INSTALLATION

### Step 1

## Prerequisites

Ensure you have the following installed on your system:

-   **XAMPP** (for Apache and MySQL)
-   **Node.js** (for NPM)
-   **Composer** (for Laravel dependencies)

Once installed, open the **Start Menu**, search for **XAMPP Control Panel**, and launch it. Start **Apache** and **MySQL** services.

---

## Project Setup

## 1. Clone the Repository

Download the GitHub repository and extract the folder to your desired location.

Alternatively, you can clone it using Git:

```sh
git clone <repository url>
cd <the assessment folder>
```

### Step 2

### Open the Project

Rename .env.example to .env.
Open VS Code (or your preferred code editor).
Open the extracted/cloned project folder.

### Step 3

## Frontend Setup

## Open a terminal in VS Code and install the Node.js dependencies:

```sh
npm install
```

(Wait for it to finish)

## Then, compile the front-end assets:

```sh
npm run dev
```

### Step 4

## Backend Setup

## Open another terminal (do not close the previous one) and install the Laravel dependencies using Composer:

```sh
composer install
```

(Wait for it to finish)

## Generate the application key:

```sh
php artisan key:generate
```

## Run the database migrations:

```sh
php artisan migrate
```

(Allow migration if prompted)

## Start the Laravel development server:

```sh
php artisan serve
```

### Running the Application

Once the server starts, a link will appear, typically: http://127.0.0.1:8000/

Press Ctrl + Click on the link to open it in your browser.

AND NOW YOU'RE ALL SET!!

### PS: Use the mailtrap.io as for forgot password functionality

## Configure Mailtrap.io settings for email functionality:

```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

# Note: You can find your Mailtrap credentials after signing up and creating a new inbox at Mailtrap.io.
