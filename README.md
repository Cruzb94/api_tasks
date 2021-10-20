Ejecutar los siguientes comandos y configurar el archivo .env con los datos de la base de datos:

composer install 

php artisan migrate 

php artisan db:seed --class=UserSeeder 

php artisan db:seed --class=TaskSeeder 

php artisan passport:install

Se creo un seed con un usuario de prueba y otro seed con una serie de tareas 

admin@gmail.com contraseña: password
