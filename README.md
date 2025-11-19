## Healthcare appointment booking system
A PHP-based project that implements a healthcare appointment scheduling. The main purpose of this project is serving an online healthcare booking system, which might significantly reduce waiting time, and furthermore, optimise hospital workflows.


## Table of contents
1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Usage](#usage)
4. [Acknowledgements](#acknowledgements)

## Installation

### Requirements

Before you begin, please ensure that you have met the following requirements:
1. PHP 8.x or higher.
2. Composer.
3. Laravel 10.x or higher.
4. Nodejs and npm (for front-end development).

### Step-by-step guide

1. Clone the repository:

    ```bash
    https://github.com/steevewu/healthcare-appointment-booking-system.git
    cd healthcare-appointment-booking-system
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install front-end dependencies:

    ```bash
    npm install
    ```
4. Set up your environment file:

    Copy the `.env.example` to a new `.env` file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Set up your database:
    - Create a new database for the application.
    - Update the `.env` file with your database credentials.

7. Run migrations:

    ```bash
    php artisan migrate
    ```

8. Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

9. Compile assets:

    ```bash
    npm run dev
    ```

## Configuration

### Database

Create a new database and update the `.env` file as your database credentials as mentioned in [Installation - step 6](#step-by-step-guide).

### Mail service

Replace your mail service provider credentials in the .env file to make the mailing service work properly.

## Usage

To start the Laravel development server, run:

```bash
php artsian serve
```

This will start the application at [http://localhost:8000](http://localhost:8000).

Use these following credentials to login into system:


```json
{
    // json format:
    // "role": {
    //     "email": "mail@example.com",
    //     "password": "somepassword"
    // }

    "admin": {
        "email": "admin1@pka.com",
        "password": "phenikaa"
    },

    "officer": {
        "email": "officer1@pka.com",
        "password": "phenikaa"
    },

    "scheduler": {
        "email": "scheduler1@pka.com",
        "password": "phenikaa"
    },

    "doctor": {
        "email": "doctor1@pka.com",
        "password": "phenikaa"
    },

    "patient1": {
        "email": "patient1@pka.com",
        "password": "phenikaa"
    },
}
```

## Acknowledgements
- Thanks to the [Laravel](https://laravel.com/) community for providing this awesome framework.
- Also, many thanks to [Filament](https://filamentphp.com/) developer team for making this dynamic, and maintainable tool.