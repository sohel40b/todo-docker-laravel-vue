<a name="readme-top"></a>

<!-- GETTING STARTED -->
## Getting Started

This repository provides you a development environment without requiring you to install PHP, a web server, and any other server software on your local machine. For this, it requires only Docker.

### Installation

This is an example of how you may give instructions on setting up your project locally. To get a local copy up and running follow these simple example steps.

1. Clone the repo
   ```sh
   git clone https://github.com/sohel40b/todo-docker-laravel-vue.git
   ```
2. Switch to the project folder and open terminal 
   ```sh
   docker-compose build
   ```
   ```sh
   docker-compose up -d
   ```
3. Open Docker-Desktop app and run command in php image terminal
   ```sh
   cp .env.example .env
   ```
   ```sh
   composer install
   ```
   ```sh
   php artisan key:generate 
   ```
   Edit .env file
   ```sh
   DB_HOST: mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=root
   ```
   ```sh
   php artisan migrate
   ```
5. Finally install and run server in php image terminal
   ```sh
   npm install
   ```
   ```sh
   npm run dev
   ```
   
 ### For Windows user only change your code in `vite.config.js`
   ```sh
   server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
   ```
<!-- Documentation -->
## Documentation

Documentation URL provide below.
```sh
http://localhost:8000/request-docs/
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>
