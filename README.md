## notes for running the app on your machine:

1. run composer install
2. copy the database file to database directory under the name: database.sqlite
3. create .env file and put the contents of the .env.example as is into the .env file
4. run php aritsan serve

## before running the tests, you need to run
1. php artisan config:clear
2. create an empty file to be used for database testing in the database directory and lets call it test.sqlite