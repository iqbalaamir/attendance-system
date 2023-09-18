# Attendance System

## Overview

The Attendance System is a Laravel-based web application that tracks employee attendance. It includes an "attendances" table and implements a unique "sandwich" leave system that marks leaves without pay based on specific conditions.

## Requirements

- PHP >= 7.4
- MySQL
- Composer
- Laravel >= 8.0

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/iqbalaamir/attendance-system.git
```

## Install Dependencies

```bash
composer install
```

## Environment Setup

Copy the .env.example to .env and configure your database settings.

```bash
cp .env.example .env

```
## Generate Key

```bash
php artisan key:generate

```

## Run the migration

```bash
php artisan migrate
```

## Seed Data

```bash
php artisan db:seed --class=AttendanceSeeder
```

## Run Server

```bash
 php artisan serve
```
## Features

- Attendance tracking
- Sandwich system
- Dynamic table with search, sort, and pagination

## Usage

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your web browser.
