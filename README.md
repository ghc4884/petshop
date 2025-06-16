# 🐾 PetShop - Dog Breed Gallery

A Laravel-based web application that displays dog breeds using data from TheDogAPI. Users can browse, search, and view detailed information about various dog breeds.

## 🚀 Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or compatible database
- Laravel 10+
- [TheDogAPI](https://thedogapi.com) (for seeding the dog breed data)
- Laravel CLI (Artisan)
- Vite (used to build frontend assets)

## 📦 Installation

### 1. Clone the repository

```bash
git clone https://github.com/tu_usuario/petshop.git
cd petshop
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Copy the `.env` file and generate application key

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure `.env`

Update the following lines with your own database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petshop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create the database

Create a database in MySQL:

```sql
CREATE DATABASE petshop;
```

### 6. Run migrations and seeders

```bash
php artisan migrate --seed
```

The seeder will pull data from TheDogAPI and store it in your local database.

If you want to start from scratch:

```bash
php artisan migrate:fresh --seed
```

### 7. Serve the application

```bash
php artisan serve
```

Visit in your browser:  
👉 http://localhost:8000

## 🔍 Features

- View over 150 dog breeds with images
- Search by name or breed group
- View breed details in a modal
- Responsive UI with Bootstrap
- Data seeded from TheDogAPI

## 🧪 Useful Commands

```bash
php artisan migrate:fresh --seed     # Reset and reseed the database
npm run dev                          # Compile frontend assets
php artisan serve                    # Start local server
```

## ⚙️ Technologies Used

- Laravel 10
- PHP 8.1+
- MySQL
- Vite
- Bootstrap 5
- JavaScript
- Blade Templating Engine
- TheDogAPI

## 📸 Credits

Dog breed data and images provided by [TheDogAPI](https://thedogapi.com)  
Built with ❤️ using Laravel

## 📄 License

This project is open-source and available under the MIT License.
