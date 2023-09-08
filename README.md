# Kashier integration Demo

This repository contains a Kashier integration Demo. It includes the following features and components:

## Features

- Feature 1: Simple Ui of a demo store that contain product, cart, order, and user modules.
  

- Feature 2: Authenticated users and guests can place orders.
  

- Feature 3: Checkout component that's fully integrated with Kashier payment ui.
  

- Feature 4: Webhook implementation to sync orders status with Kashier transactions.
  

- Feature 5: Signature validation to ensure that requests aren't tampered with

## Requirements

- PHP 7.4 or higher
- Composer
-  MySQL 8 or higher

## Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/AhmedDaoud1620/Kashier-demo.git
   ```

2. Navigate to the project directory:

   ```bash
   cd kashier_integration
   ```
3. Install the project dependencies using Composer:

   ```bash
   composer install
   ```
4. Create a copy of the .env.example file and rename it to .env:
   
   ```bash
   cp .env.example .env
   ```
5. Generate an application key:

   ```bash
   php artisan key:generate
   ```
   
6. Configure the database connection in the .env file with your database credentials:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name #don't forget to create a db with that name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
7. Configure Kashier information in .env file with your Kashier credentials:

    ```dotenv
    KASHIER_BASE_URL=https://test-api.kashier.io
    CURRENCY=your_prefered_currency
    KASHIER_PUBLIC_KEY=your_kashier_account_public_key
    KASHIER_SECRET_KEY=your_kashier_account_secret_key
    SUB_DOMAIN_URL=https://checkout.kashier.io
    KASHIER_MERCHANT_ID=your-Kashier-merchantId
    STORE_NAME=your_store_name
    MODE=mode:_either_test_or_live
    ```   
8. Run the database migrations :
   
   ```bash
   php artisan migrate
   ```
9. Seed the database: 
   
   ```bash
   php artisan db:seed
   ```
10. Start the development server:

    ```bash
    php artisan serve
    ```
The application will be available at 

`http://localhost:8000`.

## License

Kashier Demo is open-sourced software licensed under the [MIT license](https://github.com/laravel/cashier-stripe/blob/14.x/LICENSE.md).
