# Laravel Order Management API

A modern Laravel 13 application demonstrating asynchronous order processing with queue jobs, API resources, and best practices for building scalable web applications.

## Features

- **RESTful API** for order management
- **Asynchronous Processing** with Laravel queues
- **API Resources** for consistent JSON responses
- **Form Request Validation** for data integrity

## Tech Stack

- **PHP**: 8.3+
- **Laravel Framework**: 13.0
- **Laravel Sanctum**: 4.0
- **Pest PHP**: 4.6
- **Tailwind CSS**: 4.0
- **Vite**: 8.0
- **Database**: SQLite (default)

## Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js & NPM
- [Laravel Herd](https://herd.laravel.com/) (recommended) or another local development environment

## Installation

### Quick Setup

```bash
# Clone the repository
git clone <repository-url>
cd <project-directory>

# Run the automated setup script
composer setup
```

The `composer setup` script will:
- Install PHP dependencies
- Copy `.env.example` to `.env`
- Generate application key
- Run database migrations
- Install NPM dependencies
- Build frontend assets

### Manual Setup

If you prefer manual setup:

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Install NPM dependencies
npm install

# Build frontend assets
npm run build
```

## Configuration

### Environment Variables

The application uses SQLite by default. Key configuration in `.env`:

```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite

QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database
```

### Database

The application uses SQLite for simplicity. The database file is located at `database/database.sqlite`.

To use MySQL or PostgreSQL instead, update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Running the Application

### Using Laravel Herd (Recommended)

If you're using Laravel Herd, the application is automatically served at:

```
https://<project-directory>.test
```

Use the Laravel Boost tool to get the exact URL:
```bash
# The application is always available through Herd
herd sites
```

### Using Composer Dev Script

Run all development services concurrently:

```bash
composer run dev
```

This starts:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite dev server

### Manual Start

Start services individually:

```bash
# Start the development server
php artisan serve

# In a separate terminal, start the queue worker
php artisan queue:work

# In another terminal, start Vite
npm run dev
```

## API Documentation

### Base URL

```
http://localhost:8000/api
```

Or with Herd:
```
https://<project-directory>.test/api
```

### Endpoints

#### Create Order

```http
POST /api/orders
Content-Type: application/json

{
  "product_name": "Example Product",
  "quantity": 2,
  "price": 29.99
}
```

**Response** (201 Created):
```json
{
  "message": "Order created and queued for processing.",
  "order": {
    "id": 1,
    "product_name": "Example Product",
    "quantity": 2,
    "price": "29.99",
    "status": "pending",
    "created_at": "2026-04-16T10:30:00.000000Z",
    "updated_at": "2026-04-16T10:30:00.000000Z"
  }
}
```

#### Get Order

```http
GET /api/orders/{id}
```

**Response** (200 OK):
```json
{
  "order": {
    "id": 1,
    "product_name": "Example Product",
    "quantity": 2,
    "price": "29.99",
    "status": "processed",
    "created_at": "2026-04-16T10:30:00.000000Z",
    "updated_at": "2026-04-16T10:30:15.000000Z"
  }
}
```

### Order Statuses

- `pending` - Order created, awaiting processing
- `processed` - Order successfully processed
- `failed` - Order processing failed

## Development

### Code Formatting

This project uses Laravel Pint for code formatting:

```bash
# Format all files
vendor/bin/pint

# Format only modified files
vendor/bin/pint --dirty

# Check formatting without making changes
vendor/bin/pint --test
```

### Running Tests

```bash
# Run all tests
php artisan test

# Run tests with compact output
php artisan test --compact

# Run specific test
php artisan test --filter=testOrderCreation

# Run with coverage
php artisan test --coverage
```

### Creating New Components

Use Artisan commands to generate new components:

```bash
# Create a new model with migration, factory, and seeder
php artisan make:model Product -mfs

# Create a controller
php artisan make:controller Api/ProductController

# Create a form request
php artisan make:request StoreProductRequest

# Create a resource
php artisan make:resource ProductResource

# Create a job
php artisan make:job ProcessProductJob

# Create a Pest test
php artisan make:test ProductTest --pest
```

### Database Management

```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Seed the database
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Queue Management

```bash
# Start queue worker
php artisan queue:work

# Process only one job
php artisan queue:work --once

# Restart queue workers
php artisan queue:restart

# List failed jobs
php artisan queue:failed

# Retry failed job
php artisan queue:retry {id}

# Retry all failed jobs
php artisan queue:retry all
```

### Inspecting the Application

```bash
# List all routes
php artisan route:list

# Filter routes by method
php artisan route:list --method=GET

# Filter routes by name
php artisan route:list --name=orders

# View configuration
php artisan config:show app.name
php artisan config:show database.default

# Interactive PHP shell
php artisan tinker
```

### Viewing Logs

```bash
# Real-time log viewer
php artisan pail

# Filter by log level
php artisan pail --level=error
```

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── OrderController.php
│   ├── Requests/
│   │   └── StoreOrderRequest.php
│   └── Resources/
│       └── OrderResource.php
├── Jobs/
│   └── ProcessOrderJob.php
└── Models/
    ├── Order.php
    └── User.php

database/
├── migrations/
│   ├── 2026_04_16_132909_create_orders_table.php
│   └── ...
└── factories/
    └── UserFactory.php

routes/
├── api.php
├── web.php
└── console.php

tests/
├── Feature/
└── Unit/
```

## Laravel Boost

This project includes Laravel Boost, an MCP server with specialized tools for Laravel development:

- `database-query` - Run read-only database queries
- `database-schema` - Inspect table structures
- `search-docs` - Search Laravel documentation
- `get-absolute-url` - Get correct project URLs
- `browser-logs` - Read browser console logs

## Skills & Best Practices

This project follows Laravel best practices with specialized skills:

- **Laravel Best Practices** - Applied to all PHP code
- **Pest Testing** - For elegant test writing
- **Tailwind CSS Development** - For modern styling

## Building for Production

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build frontend assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

## Deployment

Laravel applications can be deployed using:

- **[Laravel Cloud](https://cloud.laravel.com/)** - Official Laravel hosting platform (recommended)
- **Laravel Forge** - Server management and deployment
- **Laravel Vapor** - Serverless deployment on AWS
- Traditional hosting with PHP support

## Contributing

1. Follow existing code conventions
2. Run `vendor/bin/pint` before committing
3. Write tests for new features
4. Update documentation as needed

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For Laravel documentation and support:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts](https://laracasts.com)
- [Laravel News](https://laravel-news.com)

## Troubleshooting

### Vite Manifest Error

If you see "Unable to locate file in Vite manifest":
```bash
npm run build
# or
npm run dev
```

### Queue Jobs Not Processing

Make sure the queue worker is running:
```bash
php artisan queue:work
```

### Frontend Changes Not Reflecting

Run the development server:
```bash
npm run dev
# or
composer run dev
```

### Permission Issues

Ensure storage and cache directories are writable:
```bash
chmod -R 775 storage bootstrap/cache
```
