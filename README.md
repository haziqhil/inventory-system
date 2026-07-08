# Inventory & Order Management System

A full-stack Laravel application for managing product inventory and customer orders. 

## Features

- **Product Management** — create, view, edit, and delete products with SKU, price, and stock tracking
- **Order Management** — create orders with multiple line items, view order history per product
- **Stock Validation** — orders are blocked if requested quantity exceeds available stock
- **Automatic Calculations** — stock is deducted and order totals are computed automatically on order creation
- **Authentication** — user registration and login

| Layer | Technology |
|---|---|
| Backend | PHP 8.3, Laravel 12 |
| Frontend | Livewire, Flux UI, Blade |
| Styling | SCSS, Tailwind CSS |
| Database | MySQL |
| Build Tool | Vite |
| Local Environment | Laragon |

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & npm
- MySQL (via Laragon or standalone)

### Installation

```bash
# Clone the repository
git clone https://github.com/haziqhil/inventory-system.git
cd inventory-system

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env
php artisan key:generate

# Configure your database in .env
# DB_DATABASE=inventory_db
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate
```

### Running Locally

Open two terminals:

```bash
# Terminal 1 — compile assets
npm run dev

# Terminal 2 — start the server
php artisan serve
```

Visit `http://127.0.0.1:8000`