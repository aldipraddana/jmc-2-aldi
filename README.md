# jmc-aldi-task-2

# Instalasi
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. pastikan telah mengonfigurasi database di file .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```
5. php artisan migrate
6. php artisan db:seed
7. npm install
8. npm run build
