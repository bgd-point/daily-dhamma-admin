# Daily Dhamma - Web Admin

This is web admin site for daily-dhamma app

this site using : 

- Laravel 5.4 as a framework
- Firebase for NoSQL database and notification
- Datatables
- Bootstrap 3.x

## Installation
1. clone this repo into your local folder
2. run composer install
3. add `.env` into your root folder, you can copy `.env.example` as reference
```
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```
4. migrate your database `php artisan migrate`
5. seed your database `php artisan db:seed`
now you have your default credential, username `admin` password `password`
6. register into https://firebase.google.com and create authentication method.
follow this guide : https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app
7. rename your generated authentication file into `google-service-account.json` and then copy your json file into `storage` folder

your initial setup is complete.


