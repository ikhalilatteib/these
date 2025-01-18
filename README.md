# How to Run the Project Locally

## Prerequisites

- Docker
- Docker Compose
- Laravel Sail

## Steps to Run the Project

1. **Clone the repository**:

   ```sh
   git clone https://github.com/ikhalilatteib/these.git
   ```

2. **Navigate to the project directory**:

   ```sh
   cd these
   ```

3. **Copy the example environment file and update the environment variables if necessary**:

   ```sh
   cp .env.example .env
   ```

4. **Install the dependencies**:

   ```sh
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php83-composer:latest \
       composer install --ignore-platform-reqs
   ```

5. **Generate the application key**:

   ```sh
   ./vendor/bin/sail artisan key:generate
   ```

6. **Start the Docker containers**:

   ```sh
   ./vendor/bin/sail up
   ```

The application should now be running at [http://localhost](http://localhost).

## Accessing Services

- **Laravel application**: [http://localhost](http://localhost)
- **Adminer (Database management)**: [http://localhost:8080](http://localhost:8080)
