# GETTING STARTED

## Requirements

Before starting, make sure you have the following installed:

-   **Composer**: To manage PHP dependencies. Download and install from [getcomposer.org](https://getcomposer.org/).
-   **Node.js**: To manage JavaScript dependencies. Download and install from [nodejs.org](https://nodejs.org/).

## Steps to Start the Project

1. **Clone the project repository**

    First, clone the project to your local machine:

    ```bash
    git clone https://github.com/kruizo/sales-record-sys
    ```

2. **Navigate to the project directory**

    Change your current directory to the project folder:

    ```bash
    cd sales-record-sys
    ```

3. **Install PHP dependencies**

    Run the following command to install all required PHP dependencies:

    ```bash
    composer install
    ```

4. **Install Node.js dependencies**

    Run the following command to install all required JavaScript dependencies:

    ```bash
    npm install
    ```

5. **Set up the environment file**

    Copy the `.env.example` file to `.env` and configure your environment variables, such as database connection and mail configuration:

    ```bash
    cp .env.example .env
    ```

    Edit the `.env` file to match your local environment setup.

6. **Run migrations to create tables**

    Run the following Artisan command to create the necessary database tables:

    ```bash
    php artisan migrate
    ```

7. **Run initial SQL queries**

    Execute the initial SQL queries stored in the `initquery.txt` file to fill the tables with initial values:

8. **Start the development server**

    Run the following command to start the Laravel development server:

    ```bash
    php artisan serve
    ```

    This will start the server on `http://localhost:8000`.

9. **Run the frontend development server**

    Run the following command to start the frontend development server:

    ```bash
    npm run dev
    ```

    This will start the frontend server and enable hot reloading during development.

If you run into any issues and potential improvements, feel free to refer to contribute and have pull request 😊.
