## please run the following commands in the root directory:
- run: composer install
- run: npm install
- run: npm run dev
- run: php artisan key:generate
- copy the database file to database directory under the name: database.db
- create .env file and put the contents of the .env.example as is into the .env file
- run php aritsan serve and it should show you that your app is available at port 8000, so you need to head over to localhost:8000 in your browser

## before running the tests, you need to run
- php artisan config:clear