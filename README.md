# Task Management Application

This is a Laravel-based task management application that allows users to register, log in, and manage their tasks. Users can create, read, update, and delete tasks. The application also includes API endpoints and jQuery-based AJAX integration.

## Table of Contents
- [Installation](#installation)
- [Database Configuration](#database-configuration)
- [Authentication](#authentication)
- [CRUD Operations](#crud-operations)
- [API Development](#api-development)
- [jQuery Integration](#jquery-integration)
- [Real-Time Updates](#real-time-updates)
- [Notifications](#notifications)


## Installation

1. **Clone the Repository**
    ```sh
    git clone https://github.com/LPyadav/taskManger.git
    cd taskManger
    ```

2. **Install Dependencies**
    ```sh
    composer install
    npm install
    npm run dev
    ```

3. **Environment Configuration**
    Copy the `.env.example` file to `.env` and configure the necessary environment variables.
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

## Database Configuration

1. **Database Setup**
    Configure your database connection in the `.env` file. Set the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables according to your MySQL setup.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

2. **Run Migrations**
    ```sh
    php artisan migrate
    ```

## Authentication

1. **Install Laravel Breeze**
    ```sh
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev
    php artisan migrate
    ```

2. **Routes and Views**
    Laravel Breeze sets up authentication routes and views automatically.

## CRUD Operations

1. **Task Model and Migration**
    Generate the Task model and migration.
    ```sh
    php artisan make:model Task -m
    ```

    Define the `tasks` table schema in the migration file.
   
    

2. **Run Migrations**
    ```sh
    php artisan migrate
    ```

3. **Task Controller**
    Generate the Task controller.
    ```sh
    php artisan make:controller TaskController --resource
    ```

4. **Routes**
    Add the resource route to `routes/web.php`.
    ```php
    Route::resource('tasks', TaskController::class);
    ```

5. **Views**
    Create Blade templates for listing, creating, editing, and deleting tasks:
   

## API Development

1. **API Routes**
    Add API routes to `routes/api.php`.
    ```php
   
    Route::apiResource('tasks',TaskApiController::class);
   
    ```

2. **Task API Controller**
    Generate the Task API controller.
    ```sh
    php artisan make:controller TaskApiController --api
    ```

    Implement CRUD operations in the API controller.



## jQuery Integration

1. **Task List**
    Fetch tasks from the API and display them in a table using jQuery.
    ```javascript
    $.get('/api/tasks', function(tasks) {
        // Populate table with tasks
    });
    ```

2. **Add Task**
    Handle form submission via AJAX to create a new task.
    

3. **Edit Task**
    Handle form submission via AJAX to update a task.
    

4. **Delete Task**
    Confirm and delete a task via AJAX.


## Real-Time Updates

1. **Pusher Setup**
    Configure Pusher or Laravel Echo to broadcast events for real-time updates (https://beyondco.de/docs/laravel-websockets/getting-started/introduction).
     ```php
     // Laravel WebSockets can be installed via composer:

     composer require beyondcode/laravel-websockets

     // The package will automatically register a service provider.

     php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"

    // Run the migrations

    php artisan migrate

    //Next, you need to publish the WebSocket configuration file:

    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"

     //  Laravel WebSockets package in combination with Pusher
     composer require pusher/pusher-php-server


     //environment variable in your .env file:
     BROADCAST_DRIVER=pusher

     // build 
     npm run build

     
     // for listen 
     php artisan websockets:serve
     
     // for dispatch 
     php artisan queue:work
    
    ```


2. **Broadcast Events**
    Broadcast events when tasks are created or updated.

## Notifications

1. **Email Notifications**
    Send email notifications to users when tasks are assigned using Laravel’s notification system using observer.

2. **Queue Jobs**
    Dispatch email notifications to the queue.
     ```php   
     // for dispatch 
     php artisan queue:work
    
    ```




### Author

[Lalu Yadav]