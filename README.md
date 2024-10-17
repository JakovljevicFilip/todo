# Laravel Sail + Vue 3 Project

This project is built with **Laravel** (backend) and **Vue 3** (frontend), using **Laravel Sail** for Docker-based development. The Vue 3 frontend integrates with Laravel's backend and is powered by Quasar for UI components.

## Prerequisites

Make sure you have the following installed on your machine:
- [Docker](https://www.docker.com/get-started) and Docker Compose (Docker Compose is bundled with Docker Desktop)
- [Node.js](https://nodejs.org/) (version 16 or higher) and [npm](https://www.npmjs.com/)

## Setup Instructions

### 1. Clone the Repository

Clone this repository to your local machine:

```bash
git clone https://github.com/JakovljevicFilip/todo.git
chmod -R 777 todo #Optional
cd todo
```

### 2. Install required composer dependencies via Docker
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

### 3. Install Backend Dependencies (Laravel)
Laravel Sail uses Docker, so you don't need to install PHP or MySQL locally.

#### Step 1: Create a .env file:
Copy the .env.example file to .env:
```bash
cp .env.example .env
```

#### Step 2: Install Laravel dependencies via Docker:
```bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
```

#### Step 3: Generate the application key:
```bash
./vendor/bin/sail artisan key:generate
```

#### Step 4: Run migrations:
```bash
./vendor/bin/sail artisan migrate
```

#### Step 5: Seed database (optional):
```bash
./vendor/bin/sail artisan db:seed
```

### 3. Set Up Frontend (Vue 3)
#### Step 1: Install Node.js dependencies:
Run the following command to install the Vue 3 dependencies:
```bash
npm install
```

#### Step 2: Set up Vite and Quasar:
Make sure that vite.config.ts or vite.config.js is correctly configured with Quasar and Laravel's Vite plugin. These steps should already be configured if you're using this template.

### 4. Run the Application
#### Step 1: Start Laravel Sail (Docker) for the backend:
```bash
./vendor/bin/sail up -d
```

#### Step 2: Run Vite for the frontend (Vue 3):
```bash
npm run dev
```

### 5. Access the Application
Once Sail and Vite are running, you can access the app at:

- Backend (Laravel API): http://localhost
- Frontend (Vue 3 with Vite): Usually, Vite will run on http://localhost:3000

### 6. Running Tests
You can run Laravel's tests using Sail:
```bash
./vendor/bin/sail artisan test
```
### 7. Build for Production
To build the project for production, run:
```bash
npm run build
```
This will bundle the Vue 3 assets and integrate them with the Laravel backend.

### 8. Stop the Docker Containers
To stop the running Sail containers:
```bash
./vendor/bin/sail down
```

## Additional Information
### Laravel Sail
Sail is a lightweight command-line interface for interacting with Laravel's Docker configuration. It makes setting up Docker containers for local development much simpler.

### Vue 3 + Vite
This project uses Vite for fast development and build tools for the Vue 3 frontend. Vite ensures quick hot module replacement (HMR) and efficient builds.
