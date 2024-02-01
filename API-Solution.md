# Random Fact Generator API (Random K9s)

This API provides a solution to retrieve random facts based on the user's preference to have or not have numbers with the facts.

## Installation

To set up the project, follow these steps:

1. Clone the repository.
2. Install project dependencies using Composer:

   ```bash
   composer install

1. Copy the `.env.example` file to `.env` and configure your environment settings, including the database connection.

2. Generate an application key:
   ```bash
   php artisan key:generate

3. Run the database migrations to create the `facts` table:
   ```bash
   php artisan migrate

4. Seed the `facts` table by accessing data from the `facts-list.json` file:
   ```bash
   php artisan db:seed

5. Generate the API Documentation using Laravel Swagger (if not already installed):
    ```bash
   php artisan l5-swagger:generate

## Usage

To access the API documentation, use the following URL:

    /api/documentation

The API provides an endpoint to retrieve random facts based on user preferences. Necessary feature tests have been written to ensure the functionality of the API.

## Testing

To run the tests, execute the following command:

    php artisan test

This will run the available tests and provide you with the test results.
