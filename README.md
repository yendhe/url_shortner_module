
## URL Shortner App

Welcome to the URL Shortner module!

You can use the following credentials to log in to the application:

    "email": "yendheriddhi@gmail.com",
    "password": "riddhi@121"

## Installation

Follow these steps to install and run the project:
1. Clone the repository: `git clone <repository-url>`

2. Navigate to the project directory: `cd url_shortner_module`

3. Install dependencies: `composer update` or `composer update --ignore-platform-req=ext-sodium`

4. Set up environment variables: `cp .env.example .env`

5. Configure database settings in `.env` file
                                    DB_CONNECTION=mysql
                                    DB_HOST=127.0.0.1
                                    DB_PORT=3306
                                    DB_DATABASE=task_management_app
                                    DB_USERNAME=root
                                    DB_PASSWORD=
    after setup env variables optimize cache

    run ->`php artisan optimize`

    start mysql server and create database url_shortner_module
    
6. Generate application key: `php artisan key:generate`
                              
7. Run migrations and run npm command: `php artisan migrate`, `npm install`, ` npm run dev`


8. Start the development server: `php artisan serve`

9. Access the application in your browser: `http://localhost:8000`

