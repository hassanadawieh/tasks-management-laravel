# Laravel products-api

Welcome to the Laravel products-api! This project is built using the Laravel framework.

## Getting Started

To get started with this project, follow these steps:

1. Clone the repository:

```bash
git clone https://github.com/hassanadawieh/exam-isolution.git
```

2. Install dependencies:
```bash
composer install
```

3. Copy the .env.example file to .env and configure your database connection and other settings:   
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password`

4. generate secret token:
```bash
php artisan jwt:secret
```
In the .env file add the key to:

JWT_SECRET=your-generated-secret-key 

5. Run database migrations:

```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

7. Open http://localhost:8000 in your browser.

