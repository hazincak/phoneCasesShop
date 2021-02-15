# E-commerce website

## Description
This e-commerce website was created as a project for my portfolio (www.jhportfolio.me) and to enhance my skills with Javascript and PHP frameworks (Vuejs and Laravel) in realistic project. It implements basic features of both - modern website and e-commerce solution

## How to run
1. Download composer https://getcomposer.org/download/
2. Pull this project.
3. Rename .env.example file to .env inside your project root and fill the database information. (windows wont let you do it, so you have to open your console cd your project root directory and run mv .env.example .env )
4. Configure other env configurations: mailer and STRIPE. 
5. Open the console and cd your project root directory
6. Run "npm install" inside this project folder to install all dependencies.
7. Run composer install or php composer.phar install
8. Run php artisan key:generate
9. Run php artisan migrate
10. Run php artisan db:seed to run seeders
11. Run php artisan serve
12. Don't forget to start your MySQL and Apache servers
