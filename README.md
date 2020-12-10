# BPB - Coding Test 1 (Todo List with Burndown Chart)
Basic todo list, that allows users to register, log in, and create tasks that are saved against their account. It includes the dynamic burndown chart, that displays the number of tasks that were not yet completed at each minute in the last hour.
## Getting Started
To see this app in action, please follow the steps:

**1 .Clone the repo**
```
git clone git@github.com:dxc04/todo-list-laravel-vue.git codingtest && cd codingtest
```
**2. Install PHP packages**
```
composer install
```
**3. Copy .env**
```
cp .env.example .env
```
**4. Configure MySQL connection details in .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database name}
DB_USERNAME={database user}
DB_PASSWORD={database password}
```
**5. Run database migrations and seeders**
```
php artisan migrate:reset
php artisan migrate
php artisan db:seed --class="TodoSeeder"
```
**6. Install node packages and build js**
```
npm install && npm run dev
```
## Running the application
Once the requisite for setting up the app is done, you can run the application with this
```
php artisan serve
```
and visit `http://localhost:8000/`

#### Default user with existing data that can be use
```
Email: test@test.com
Password: password
```
## PHPUnit Test
To run the unit test, go to the project root and run
```
php artisan test
```
