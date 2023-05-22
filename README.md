
## WAREHOUSE-MANAGEMENT-SYSTEM-CHALLENGE-API

## PROJECT-SETUP

### Clone the project
```
git clone

```
### Enter in direcotory where it save
```

cd /path/to/your/project

```

### Install dependencies
```
composer install

```

### Make a copy of the .env.example file and rename it to .env.
```
cp .env.example .env

```
### Generate an application key
```
php artisan key:generate

```
### Set your database
```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

```
### Run your migration to create necessary tables
```
php artisan migrate

```

### sample credential to login / allowed role customer/admin
```
php register:user {role} {name} {email} {password}'

php artisan register:user customer test test@gmail.com test

```
### start server

```
php artisan serve

```








