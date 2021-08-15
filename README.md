
------------------------------------
### Books World (E-Commerce Website)
------------------------------------


## Installation

# Run command below:

git clone https://github.com/hridoyraisul/Books-World-E-Commerce.git
cd Books-World-E-Commerce
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan optimize
php artisan serve

## Browse URL

# User Panel:
http://127.0.0.1:8000/

# Admin Panel:
http://127.0.0.1:8000/admin/login

Admin Email: admin@booksworld.com
Admin Password: admin@1234




