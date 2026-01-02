# Ecommerce Project Setup Guide

This guide provides step-by-step instructions for setting up the ecommerce project.

## 1. Introduction

This project is a Laravel-based ecommerce application with a Vue.js frontend. This guide will walk you through the process of setting up your development environment and running the application.

## 2. Prerequisites

Before you begin, ensure you have the following software installed on your system:

*   **PHP >= 8.1**
*   **Composer**
*   **Node.js & npm**
*   **A database server (e.g., MySQL, PostgreSQL)**

## 3. Getting Started

### 3.1. Clone the Repository

First, clone the project repository to your local machine:

```sh
git clone <repository-url>
cd <project-directory>
```

### 3.2. Install Dependencies

Next, install the required PHP and Node.js dependencies:

*   **PHP Dependencies**:

    ```sh
    composer install
    ```

*   **Node.js Dependencies**:

    ```sh
    npm install
    ```

### 3.3. Environment Configuration

The project requires an environment file to store sensitive information and configuration settings.

*   **Create the `.env` file**:

    ```sh
    cp .env.example .env
    ```

*   **Generate the application key**:

    ```sh
    php artisan key:generate
    ```

*   **Configure your database**:

    Open the `.env` file and update the following variables with your database credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

### 3.4. Database Migration

Run the database migrations to create the necessary tables:

```sh
php artisan migrate
```

## 4. Running the Application

### 4.1. Compile Frontend Assets

Compile the frontend assets using Laravel Mix:

```sh
npm run dev
```

### 4.2. Start the Development Server

Start the Laravel development server:

```sh
php artisan serve
```

The application will be available at `http://localhost:8000`.

## 5. Additional Information

This guide covers the basic setup process. For more advanced topics, such as running tests or deploying the application, refer to the official Laravel documentation.
