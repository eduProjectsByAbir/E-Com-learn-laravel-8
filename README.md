## Installation Process

- Clone this repo `git clone https://github.com/eduProjectsByAbir/Ecom-ZS.git`
- Change Directory to `cd Ecom-ZS`
- Create a database in your database server
- Copy the .env.example file Windows: `copy .env.example .env` Linux: `cp .env.example .env`
- Open .env file and add database information previously created on step-3
- install laravel files `composer install`
- Generate key `php artisan key:generate`
- Install Node Modules `npm install`, `npm run dev`
- Migrate Database `php artisan migrate:fresh --seed`
- Run Server `php artisan serve`
- Browse http://localhost:8000

## User Login
- Browse http://localhost:8000/login
- Email: `user@mail.com`
- Password: `password`

## Admin Login
- Browse http://localhost:8000/admin/login
- Email: `admin@mail.com`
- Password: `password`

Thank You