<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

<h1 align="center">Mini Inventory Management System</h1>

<p align="center">
A Laravel-based mini inventory management system built as a code test assignment for Unity Source.
</p>

---

## Features

- **Authentication**: Only authenticated users can access inventory modules.
- **Models & Relationships**: Products, Categories, and Brands with proper Eloquent relationships.
- **Product Management**: Full CRUD for products, including image upload and validation.
- **Category & Brand Management**: CRUD for categories and brands, with product counts.
- **Search & Filter**: Search products by name/code, filter by category and brand.
- **Stock Handling**: Increase/decrease stock, display total stock value.
- **(Optional)**: Export products to Excel/CSV, pagination, soft deletes.

## Setup Instructions

1. **Clone the repository**
    ```bash
    git clone https://github.com/your-username/inventory-system.git
    cd inventory-system
    ```

2. **Install dependencies**
    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Environment setup**
    - Copy `.env.example` to `.env` and update database credentials.
    - Generate application key:
      ```bash
      php artisan key:generate
      ```

4. **Run migrations and seeders**
    ```bash
    php artisan migrate --seed
    ```

5. **Storage link (for image uploads)**
    ```bash
    php artisan storage:link
    ```

6. **Start the development server**
    ```bash
    php artisan serve
    ```

7. **Access the app**
    - Visit [http://localhost:8000](http://localhost:8000)
    - Register a new user and log in.

## Usage

- Manage products, categories, and brands from the dashboard.
- Upload product images.
- Search and filter products.
- Adjust stock and view total stock value.
- (Optional) Export product list and use pagination.

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or compatible database

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

---

**Assignment by Unity Source**  
For any questions, contact [aungnaingphyoe.unitysource@gmail.com](mailto:aungnaingphyoe.unitysource@gmail.com).
