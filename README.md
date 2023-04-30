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
2. Run command with terminal
   ```sh
   docker-compose build
   ```
3. Run command with terminal
   ```sh
   docker-compose up -d
   ```
4. Open Docker-Desktop app and run command in php image terminal
   ```sh
   cp .env.example .env
   ```
   ```sh
   composer install
   ```
   ```sh
   php artisan key:generate 
   ```
   ```sh
   php artisan migrate
   ```
5. Change your code in `.env`
   ```js
   DB_HOST: mysql
   APP_URL: http://localhost:8000
   ```
6. Finally install and run server
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

<p align="right">(<a href="#readme-top">back to top</a>)</p>
